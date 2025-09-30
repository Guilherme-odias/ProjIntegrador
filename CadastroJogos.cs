using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace Projeto_integrador
{
    public partial class CadastroJogos : Form
    {
        public CadastroJogos()
        {
            InitializeComponent();
            AtualizarGrid();
        }

        private void btnCadastrar_Click(object sender, EventArgs e)
        {
            string nome = txtNomeJogo.Text;
            string genero = txtGenero.Text;
            string precoTexto = txtPreco.Text;
            decimal preco;

            if (string.IsNullOrWhiteSpace(nome) || string.IsNullOrWhiteSpace(genero) || !decimal.TryParse(precoTexto, out preco))
            {
                MessageBox.Show("Por favor, preencha todos os campos corretamente.");
                return;
            }

            Jogo jogo = new Jogo
            {
                Nome = nome,
                Genero = genero,
                Preco = preco
            };

            jogo.Inserir();

            MessageBox.Show("Jogo cadastrado com sucesso!");

            txtNomeJogo.Clear();
            txtGenero.Clear();
            txtPreco.Clear();

            AtualizarGrid();

        }

        private void AtualizarGrid()
        {
            dgvJogos.DataSource = null;
            dgvJogos.DataSource = Jogo.ListarTodos();
        }

        private void dgvJogos_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void dgvJogos_CellContentClick_1(object sender, DataGridViewCellEventArgs e)
        {

        }
    }
}
