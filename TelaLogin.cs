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
        public string EmailOuUsuario { get; private set; }
        public string TipoUsuario { get; private set; }

        public TelaLogin()
        {
            InitializeComponent();
        }


        private void TelaLogin_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            string login = textEmail.Text.Trim();
            string senha = textSenha.Text.Trim();

            if (string.IsNullOrEmpty(login) || string.IsNullOrEmpty(senha))
            {
                lblAviso.Text = "Preencha usuário e senha!";
                return;
            }

            Conexao conexao = new Conexao();
            using (MySqlConnection conn = conexao.GetConnection())
            {
                try
                {
                    conn.Open();
                    string query = "SELECT tipo_user FROM cadastro WHERE (email=@login OR nome_user=@login) AND senha=@senha";
                    MySqlCommand cmd = new MySqlCommand(query, conn);
                    cmd.Parameters.AddWithValue("@login", login);
                    cmd.Parameters.AddWithValue("@senha", senha);

                    var tipo = cmd.ExecuteScalar();

                    if (tipo != null)
                    {
                        EmailOuUsuario = login;
                        TipoUsuario = tipo.ToString();
                        DialogResult = DialogResult.OK;
                        Close();
                    }
                    else
                    {
                        lblAviso.Text = "Email ou senha incorretos!";
                        esqueciSenha.Visible = true;
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao conectar ao banco: " + ex.Message);
                }
            }
        }


        private void textSenha_TextChanged(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {
            TelaCadastroLogin Tela = new TelaCadastroLogin();
            TelaCadastroLogin tela = new TelaCadastroLogin();
            tela.ShowDialog();
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

        private void esqueciSenha_Click(object sender, EventArgs e)
        {

            EsqueciSenha novoForm = new EsqueciSenha(); // substitua pelo nome do seu Form
            novoForm.Show();

        }

        private void lblAviso_Click(object sender, EventArgs e)
        {

        }
    }
}
