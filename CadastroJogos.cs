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
            string categoria = txtCategoria.Text;
            string titulo = txtTitulo.Text;
            string desenvolvedora = txtDesenvolvedora.Text;
            string distribuidora = txtDistribuidora.Text;
            string informacoes = txtInformacoes.Text;
            DateTime dataLancamento = dtpDataLancamento.Value;
            string reqSistema = txtReq_Sis.Text;

            // Validação simples
            if (string.IsNullOrWhiteSpace(categoria) ||
                string.IsNullOrWhiteSpace(titulo) ||
                string.IsNullOrWhiteSpace(desenvolvedora) ||
                string.IsNullOrWhiteSpace(distribuidora) ||
                string.IsNullOrWhiteSpace(informacoes) ||
                string.IsNullOrWhiteSpace(reqSistema))
            {
                MessageBox.Show("Por favor, preencha todos os campos corretamente.");
                return;
            }

            Jogo jogo = new Jogo
            {
                Categoria = categoria,
                Titulo = titulo,
                Desenvolvedora = desenvolvedora,
                Distribuidora = distribuidora,
                Informacoes = informacoes,
                DataLancamento = dataLancamento,
                RequisitosSistema = reqSistema
            };

            try
            {
                jogo.Inserir();
                MessageBox.Show("Jogo cadastrado com sucesso!");

                // Limpar campos
                txtCategoria.Clear();
                txtTitulo.Clear();
                txtDesenvolvedora.Clear();
                txtDistribuidora.Clear();
                txtInformacoes.Clear();
                txtReq_Sis.Clear();
                dtpDataLancamento.Value = DateTime.Now;

                AtualizarGrid();
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro ao cadastrar jogo: " + ex.Message);
            }

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
