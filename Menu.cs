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
            TelaCadastroLogin modal = new TelaCadastroLogin();
            modal.ShowDialog();
        }

        private void loginToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Login modal = new Login();
            modal.ShowDialog();
        }

        private void cadastroJogoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            CadastroJogos modal = new CadastroJogos();
            modal.ShowDialog();
        }

        private void listaJogosToolStripMenuItem_Click(object sender, EventArgs e)
        {
            ListaJogos modal = new ListaJogos();
            modal.ShowDialog();
        }

        private void sorteadorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Sorteador modal = new Sorteador();
            modal.ShowDialog();
        }
    }
}
