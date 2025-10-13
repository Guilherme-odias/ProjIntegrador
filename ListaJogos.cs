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
    public partial class ListaJogos : Form
    {

        private Buscas busca = new Buscas();

        public ListaJogos()
        {
            InitializeComponent();
        }

        private void CarregarJogos()
        {
            Conexao conexao = new Conexao();
            string query = @"SELECT titulo, desenvolvedora, distribuidora, informacoes, 
                            data_lancamento, req_sistema 
                     FROM jogos";

            // pega uma nova conexão
            using (MySqlConnection con = conexao.GetConnection())
            {
                try
                {
                    con.Open();

                    MySqlCommand cmd = new MySqlCommand(query, con);
                    MySqlDataAdapter da = new MySqlDataAdapter(cmd);
                    DataTable dt = new DataTable();
                    da.Fill(dt);

                    dgv.DataSource = dt;
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao carregar jogos: " + ex.Message);
                }
            }
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
           

        }

        private void ListaJogos_Load(object sender, EventArgs e)
        {

        }

        private void b1_Click(object sender, EventArgs e)
        {

            CarregarJogos();

            string cb = cb1.Text;
            string tb = tb1.Text;

            if (cb == "Titulo")
            {
                CarregarJogos();
                dgv.DataSource = busca.procura_titulo(tb);
            }

            if (cb == "Desenvolvedora")
            {
                CarregarJogos();
                dgv.DataSource = busca.procura_desenvolvedora(tb);
            }

            if (cb == "Distribuidora")
            {
                CarregarJogos();
                dgv.DataSource = busca.procura_distribuidora(tb);
            }

            if (cb == "Informacoes")
            {
                CarregarJogos();
                dgv.DataSource = busca.procura_informacoes(tb);
            }
        }
    }
}
