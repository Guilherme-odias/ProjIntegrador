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
            if (this.MdiChildren.Length == 0)
            {


                TelaCadastroLogin abrirfo1 = new TelaCadastroLogin();
                abrirfo1.MdiParent = this;
                abrirfo1.Show();
            }
            else
            {

                this.MdiChildren[0].Activate();
            }

        }

        private void loginToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (this.MdiChildren.Length == 0)
            {


                TelaLogin abrirfo1 = new TelaLogin();
                abrirfo1.MdiParent = this;
                abrirfo1.Show();
            }
            else
            {

                this.MdiChildren[0].Activate();
            }

        }

        private void cadastroJogoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (this.MdiChildren.Length == 0)
            {


                CadastroJogos abrirfo1 = new CadastroJogos();
                abrirfo1.MdiParent = this;
                abrirfo1.Show();
            }
            else
            {

                this.MdiChildren[0].Activate();
            }

        }

        private void listaJogosToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (this.MdiChildren.Length == 0)
            {


                ListaJogos abrirfo1 = new ListaJogos();
                abrirfo1.MdiParent = this;
                abrirfo1.Show();
            }
            else
            {

                this.MdiChildren[0].Activate();
            }

        }

        private void sorteadorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (this.MdiChildren.Length == 0)
            {


                Sorteador abrirfo1 = new Sorteador();
                abrirfo1.MdiParent = this;
                abrirfo1.Show();
            }
            else
            {

                this.MdiChildren[0].Activate();
            }

        }

        private void tabelasToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }

        private void Menu_Load(object sender, EventArgs e)
        {

        }
    }
}
