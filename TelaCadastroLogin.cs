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

namespace Projeto_integrador
{
    public partial class TelaCadastroLogin : Form
    {

        private Buscas busca = new Buscas();

        public TelaCadastroLogin()
        {
            InitializeComponent();
            busca.teste();
        }

        private void TelaCadastroLogin_Load(object sender, EventArgs e)
        {

        }

        private void label8_Click(object sender, EventArgs e)
        {

        }

        private void url_foto_Click(object sender, EventArgs e)
        {
            OpenFileDialog x = new OpenFileDialog();
            x.Filter = "Arquivos de Imagem|*.jpg;*.jpeg;*";

            if (x.ShowDialog() == DialogResult.OK)
            {
                // Exibe a imagem escolhida em um PictureBox
                pictureBox1.Image = Image.FromFile(x.FileName);
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Conexao conexao = new Conexao();
            Buscas busca = new Buscas();

            string varemail = email.Text.Trim();
            string varnome = nome.Text.Trim();
            string varnick = nome_user.Text.Trim();
            string varcpf = cpf.Text.Trim();
            string vartipouser = tipo_user.Text.Trim();
            string varsenha = senha.Text.Trim();
            string varsenha2 = confsenha.Text.Trim();

            // Verifica se e-mail já existe
            if (busca.busca_email(varemail))
            {
                MessageBox.Show("Este e-mail já está cadastrado!");
                return; // interrompe o cadastro
            }

            if (busca.busca_cpf(varcpf))
            {
                MessageBox.Show("Este cpf já está cadastrado em uso!!!");
                return;
            }

            // Verifica se senhas conferem
            if (varsenha != varsenha2)
            {
                MessageBox.Show("As senhas não conferem!");
                return;
            }

            if (varsenha.Length < 8)
            {
                MessageBox.Show("A senha deve ter pelo menos 8 caracteres.");
                return;
            }
            // 2 - Pelo menos 1 número
            else if (!varsenha.Any(char.IsDigit))
            {
                MessageBox.Show("A senha deve conter pelo menos 1 número.");
                return;
            }
            // 3 - Pelo menos 1 letra maiúscula
            else if (!varsenha.Any(char.IsUpper))
            {
                MessageBox.Show("A senha deve conter pelo menos 1 letra maiúscula.");
                return;
            }
            // pelo memnos 1 letra menoscola
            else if (!varsenha.Any(char.IsLower))
            {
                MessageBox.Show("A senha deve conter pelo menos 1 letra minuscula.");
                return;
            }
            // 4 - Pelo menos 1 caractere especial
            else if (!varsenha.Any(ch => !char.IsLetterOrDigit(ch)))
            {
                MessageBox.Show("A senha deve conter pelo menos 1 caractere especial.");
                return;
            }

            // Aqui você insere o usuário no banco
            using (var conn = conexao.GetConnection())
            {
                string sql = @"INSERT INTO cadastro 
                      (email, nome, nome_user, cpf, tipo_user, senha) 
                      VALUES (@Email, @Nome, @Nick, @Cpff, @TipoUser, @Senha)";

                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@Email", varemail);
                    cmd.Parameters.AddWithValue("@Nome", varnome);
                    cmd.Parameters.AddWithValue("@Nick", varnick);
                    cmd.Parameters.AddWithValue("@Cpff", varcpf);
                    cmd.Parameters.AddWithValue("@TipoUser", vartipouser);
                    cmd.Parameters.AddWithValue("@Senha", varsenha);

                    conn.Open();
                    cmd.ExecuteNonQuery();
                }
            }

            MessageBox.Show("Usuário cadastrado com sucesso!");
        }

        private void tipo_user_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
