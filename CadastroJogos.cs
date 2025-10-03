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
        private int jogoSelecionadoId = -1;


        public CadastroJogos()
        {
            InitializeComponent();
            this.dgvJogos.CellClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dgvJogos_CellClick);
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
                if (jogoSelecionadoId == -1)
                {
                    // Novo cadastro
                    jogo.Inserir();
                    MessageBox.Show("Jogo cadastrado com sucesso!");
                    LimparCampos();
                }
                else
                {
                    MessageBox.Show("Selecione 'Atualizar' para modificar o jogo.");
                }


                AtualizarGrid();
            }
            catch (Exception ex)
            {
                MessageBox.Show("Erro ao cadastrar ou atualizar jogo: " + ex.Message);
            }

        }

        private void AtualizarGrid()
        {
            dgvJogos.DataSource = null;
            dgvJogos.DataSource = Jogo.ListarTodos();
        }

       

        private void dgvJogos_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0)
            {
                DataGridViewRow row = dgvJogos.Rows[e.RowIndex];

                jogoSelecionadoId = Convert.ToInt32(row.Cells["id_play"].Value);
                txtCategoria.Text = row.Cells["id_categoria"].Value.ToString();
                txtTitulo.Text = row.Cells["titulo"].Value.ToString();
                txtDesenvolvedora.Text = row.Cells["desenvolvedora"].Value.ToString();
                txtDistribuidora.Text = row.Cells["distribuidora"].Value.ToString();
                txtInformacoes.Text = row.Cells["informacoes"].Value.ToString();
                dtpDataLancamento.Value = Convert.ToDateTime(row.Cells["data_lancamento"].Value);
                txtReq_Sis.Text = row.Cells["req_sistema"].Value.ToString();
            }
        }

        private void dgvJogos_CellContentClick_1(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void btnAtualizar_Click(object sender, EventArgs e)
        {
            Conexao conexao = new Conexao();
            using (var conn = conexao.GetConnection())
            {
                string sql = @"UPDATE jogos SET 
                        id_categoria = @id_categoria,
                        titulo = @titulo,
                        desenvolvedora = @desenvolvedora,
                        distribuidora = @distribuidora,
                        informacoes = @informacoes,
                        data_lancamento = @data_lancamento,
                        req_sistema = @req_sistema
                    WHERE id_play = @id_play";

                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@id_categoria", Convert.ToInt32(txtCategoria.Text));
                    cmd.Parameters.AddWithValue("@titulo", txtTitulo.Text);
                    cmd.Parameters.AddWithValue("@desenvolvedora", txtDesenvolvedora.Text);
                    cmd.Parameters.AddWithValue("@distribuidora", txtDistribuidora.Text);
                    cmd.Parameters.AddWithValue("@informacoes", txtInformacoes.Text);
                    cmd.Parameters.AddWithValue("@data_lancamento", dtpDataLancamento.Value);
                    cmd.Parameters.AddWithValue("@req_sistema", txtReq_Sis.Text);
                    cmd.Parameters.AddWithValue("@id_play", jogoSelecionadoId); // ID do jogo selecionado no DataGridView

                    conn.Open();
                    cmd.ExecuteNonQuery();

                }

                if (jogoSelecionadoId == -1)
                {
                    MessageBox.Show("Por favor, selecione um jogo na lista para atualizar.");
                    return;
                }

                // Criar o objeto jogo com dados atuais do formulário e id selecionado
                Jogo jogo = new Jogo
                {
                    Id = jogoSelecionadoId,
                    Categoria = txtCategoria.Text,
                    Titulo = txtTitulo.Text,
                    Desenvolvedora = txtDesenvolvedora.Text,
                    Distribuidora = txtDistribuidora.Text,
                    Informacoes = txtInformacoes.Text,
                    DataLancamento = dtpDataLancamento.Value,
                    RequisitosSistema = txtReq_Sis.Text
                };

                try
                {
                    jogo.Atualizar();  // Ou seu código de update direto
                    MessageBox.Show("Jogo atualizado com sucesso!");
                    LimparCampos();
                    jogoSelecionadoId = -1;
                    AtualizarGrid();
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao atualizar o jogo: " + ex.Message);
                }
            }
        }

        private void LimparCampos()
        {
            txtCategoria.Clear();
            txtTitulo.Clear();
            txtDesenvolvedora.Clear();
            txtDistribuidora.Clear();
            txtInformacoes.Clear();
            txtReq_Sis.Clear();
            dtpDataLancamento.Value = DateTime.Now;
        }

        private void CadastroJogos_Load(object sender, EventArgs e)
        {

        }
        private void dgvJogos_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0)
            {
                DataGridViewRow row = dgvJogos.Rows[e.RowIndex];

                jogoSelecionadoId = Convert.ToInt32(row.Cells["id_play"].Value);
                txtCategoria.Text = row.Cells["id_categoria"].Value.ToString();
                txtTitulo.Text = row.Cells["titulo"].Value.ToString();
                txtDesenvolvedora.Text = row.Cells["desenvolvedora"].Value.ToString();
                txtDistribuidora.Text = row.Cells["distribuidora"].Value.ToString();
                txtInformacoes.Text = row.Cells["informacoes"].Value.ToString();
                dtpDataLancamento.Value = Convert.ToDateTime(row.Cells["data_lancamento"].Value);
                txtReq_Sis.Text = row.Cells["req_sistema"].Value.ToString();
            }
        }

    }
}
