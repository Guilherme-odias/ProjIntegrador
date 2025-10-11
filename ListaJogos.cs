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

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            dgv.Columns["id_play"].Visible = false;
            dgv.Columns["id_categoria"].Visible = false;
            dgv.Columns["Imagens_jogos"].Visible = false;
            dgv.Columns["Imagens_cen1"].Visible = false;
            dgv.Columns["Imagens_cen2"].Visible = false;
            dgv.Columns["Trailers"].Visible = false;

        }

        private void ListaJogos_Load(object sender, EventArgs e)
        {

        }

        private void b1_Click(object sender, EventArgs e)
        {
            string cb = cb1.Text;
            string tb = tb1.Text;

            if (cb == "Titulo")
            {
                dgv.DataSource = busca.procura_titulo(tb);
            }

            if (cb == "Desenvolvedora")
            {
                dgv.DataSource = busca.procura_desenvolvedora(tb);

            }

            if (cb == "Distribuidora")
            {
                dgv.DataSource = busca.procura_distribuidora(tb);
            }

            if (cb == "Informacoes")
            {
                dgv.DataSource = busca.procura_informacoes(tb);
            }
        }
    }
}
