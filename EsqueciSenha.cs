using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net.Mail;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Projeto_integrador
{
    public partial class EsqueciSenha : Form
    {
        public EsqueciSenha()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            string codigoGerado;



            Random rnd = new Random();
            codigoGerado = rnd.Next(100000, 999999).ToString();

            MailMessage mail = new MailMessage();
            mail.From = new MailAddress("seuemail@gmail.com");
            mail.To.Add(txtEmail.Text);
            mail.Subject = "Código de Verificação";
            mail.Body = $"Seu código de verificação é: {codigoGerado}";

            SmtpClient smtp = new SmtpClient("smtp.gmail.com", 587);
            smtp.Credentials = new NetworkCredential("seuemail@gmail.com", "sua_senha_app");
            smtp.EnableSsl = true;

            try
            {
                smtp.Send(mail);
                MessageBox.Show("Código enviado para o email.");
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro ao enviar email: " + ex.Message);
            }
        }

        private void button1_Click_1(object sender, EventArgs e)
        {

        }
    }
}

