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
    public partial class Menu : Form
    {
        public Menu()
        {
            InitializeComponent();
        }

        private void cadastroToolStripMenuItem_Click(object sender, EventArgs e)
        {
           TelaCadastroLogin form = new TelaCadastroLogin();
            form.MdiParent = this;
            form.Show();
        }

        private void loginToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Login form = new Login();
            form.MdiParent = this;
            form.Show();
        }

        private void cadastroJogoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            CadastroJogos form = new CadastroJogos();
            form.MdiParent = this;
            form.Show();
        }

        private void listaJogosToolStripMenuItem_Click(object sender, EventArgs e)
        {
            ListaJogos form = new ListaJogos();
            form.MdiParent = this;
            form.Show();
        }

        private void sorteadorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Sorteador form = new Sorteador();
            form.MdiParent = this;
            form.Show();
        }

        private void tabelasToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }
    }
}
