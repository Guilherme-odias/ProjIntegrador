using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net.Mail;
using System.Net;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.ListView;
using MySql.Data.MySqlClient;

namespace Projeto_integrador
{
    public partial class ValidacaoEmail : Form
    {
        public ValidacaoEmail()
        {
            InitializeComponent();
        }

        private bool validacaoConcluida = false;

        private void textBox1_Leave(object sender, EventArgs e)
        {
            string emailDigitado = txtEmail.Text.Trim();
            string padrao = @"^[^@\s]+@[^@\s]+\.[^@\s]+$";

            if (!Regex.IsMatch(emailDigitado, padrao))
            {
                lblMensagem.Text = "Formato de e-mail inválido!";
                lblMensagem.ForeColor = Color.Red;
            }
            else
            {
                lblMensagem.Text = "";
            }
        }

        private void label2_Click(object sender, EventArgs e)
        {

        }
        string codigoGerado;
        private void button1_Click(object sender, EventArgs e)
        {

            Conexao conexao = new Conexao(); // sua classe de conexão
            using (MySqlConnection conn = conexao.GetConnection())
            {
                string sql = "SELECT COUNT(*) FROM cadastro WHERE email = @Email";
                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@Email", txtEmail);
                    conn.Open();

                    int resultado = Convert.ToInt32(cmd.ExecuteScalar());

                    if (resultado > 0)
                    {
                        lblMensagem.Text = "Cadastro encontrado!";
                        lblMensagem.ForeColor = Color.Green;
                    }
                    else
                    {
                        lblMensagem.Text = "Cadastro não encontrado.";
                        lblMensagem.ForeColor = Color.Red;
                    }


                    Random rnd = new Random();
                    codigoGerado = rnd.Next(100000, 999999).ToString();

                    MailMessage mail = new MailMessage();
                    mail.From = new MailAddress("quimeraggames@gmail.com");
                    mail.To.Add(txtEmail.Text);
                    mail.Subject = "Código de Verificação";
                    mail.Body = $"Seu código de verificação é: {codigoGerado}";

                    SmtpClient smtp = new SmtpClient("smtp.gmail.com", 587);
                    smtp.Credentials = new NetworkCredential("quimeraggames@gmail.com", "juoo dqyy kyda zhap");
                    smtp.EnableSsl = true;

                    try
                    {
                        smtp.Send(mail);
                        lbl.Text = ("Código enviado para o email.");
                    }
                    catch (Exception ex)
                    {
                        lbl.Text = ("Erro ao enviar email: " + ex.Message);


                    }
                }
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {


            if (txtCodigo.Text == codigoGerado)
            {
                validacaoConcluida = true; // Marca como validado
                MessageBox.Show("Código validado com sucesso!");

                // Abre o próximo formulário
                Sorteador novo = new Sorteador();
                this.Hide(); // Esconde este form
                novo.Show();
            }
            else
            {
                lblCodigo.Text = "Código incorreto. Verifique seu email.";
            }


        }

        private void FormValidacao_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (!validacaoConcluida)
            {
                MessageBox.Show("Você precisa validar o código antes de sair!");
                e.Cancel = true; // Impede o fechamento
            }
        }
        private void ValidacaoEmail_Load(object sender, EventArgs e)
        {

        }
    }
}
