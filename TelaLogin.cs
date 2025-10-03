using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.Button;

namespace Projeto_integrador
{
    public partial class TelaLogin : Form
    {
        public TelaLogin()
        {
            InitializeComponent();
        }

        private void TelaLogin_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            string email = textEmail.Text;
            string senha = textSenha.Text;

            Conexao conexao = new Conexao();

            using (MySqlConnection conn = conexao.GetConnection())
            {
                try
                {
                    conn.Open();
                    string query = "SELECT COUNT(*) FROM cadastro WHERE (email = @login OR nome_user = @login) AND senha = @senha";
                    MySqlCommand cmd = new MySqlCommand(query, conn);
                    cmd.Parameters.AddWithValue("@login", email);
                    cmd.Parameters.AddWithValue("@senha", senha);
                    int count = Convert.ToInt32(cmd.ExecuteScalar());

                    if (count > 0)
                    {
                        lblAviso.Text = ("Login Realizado com Sucesso!");
                        CadastroJogos sorte = new CadastroJogos();
                        sorte.Show();
                        this.Hide();
                    }
                    else
                    {
                        lblAviso.Text = ("Email ou senha \n incorretos.");

                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao fazer login: " + ex.Message);
                }
            }
        }

        private void textSenha_TextChanged(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {
            TelaCadastroLogin Tela = new TelaCadastroLogin();
            Tela.Show();
            this.Hide();
        }

        private void radioButton1_CheckedChanged(object sender, EventArgs e)
        {
           
        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {

            if (verSenha.TabStop == true)
            {
                if (textSenha.PasswordChar == '*')
                {
                    textSenha.PasswordChar = '\0'; // Mostra a senha
                }
                else
                {
                    textSenha.PasswordChar = '*'; // Oculta a senha
                }
            }


        }
    }
}
