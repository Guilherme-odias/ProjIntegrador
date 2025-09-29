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
        public TelaCadastroLogin()
        {
            InitializeComponent();
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

            // Aqui você insere o usuário no banco
            using (var conn = conexao.GetConnection())
            {
                string sql = @"INSERT INTO cadastro 
                      (email, nome, nome_user, cpf, tipo_user, senha) 
                      VALUES (@Email, @Nome, @Nick, @Cpf, @TipoUser, @Senha)";

                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@Email", varemail);
                    cmd.Parameters.AddWithValue("@Nome", varnome);
                    cmd.Parameters.AddWithValue("@Nick", varnick);
                    cmd.Parameters.AddWithValue("@Cpf", varcpf);
                    cmd.Parameters.AddWithValue("@TipoUser", vartipouser);
                    cmd.Parameters.AddWithValue("@Senha", varsenha);

                    conn.Open();
                    cmd.ExecuteNonQuery();
                }
            }

            MessageBox.Show("Usuário cadastrado com sucesso!");
        }
    }
}
