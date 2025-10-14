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

        public void cadastroToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (!SessaoAtual.VerificarLogin(this)) return;

            if (SessaoAtual.TipoUsuario != "admin")
            {
                MessageBox.Show("Acesso permitido apenas para administradores.");
                return;
            }

            TelaCadastroLogin tela = new TelaCadastroLogin();
            tela.MdiParent = this;
            tela.Show();

        }

        public void loginToolStripMenuItem_Click(object sender, EventArgs e)
        {
            SessaoAtual.VerificarLogin(this);

        }

        public void cadastroJogoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (!SessaoAtual.VerificarLogin(this)) return;

            if (SessaoAtual.TipoUsuario != "adm")
            {
                MessageBox.Show("Acesso permitido apenas para administradores.");
                return;
            }

            CadastroJogos tela = new CadastroJogos();
            tela.MdiParent = this;
            tela.Show();

        }

        public void listaJogosToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (!SessaoAtual.VerificarLogin(this)) return;

            if (SessaoAtual.TipoUsuario != "adm")
            {
                MessageBox.Show("Acesso permitido apenas para administradores.");
                return;
            }

            ListaJogos tela = new ListaJogos();
            tela.MdiParent = this;
            tela.Show();

        }

        public void sorteadorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (!SessaoAtual.VerificarLogin(this)) return;

            Sorteador tela = new Sorteador();
            tela.MdiParent = this;
            tela.Show();

        }

        private void tabelasToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }

        public void AplicarPermissoesLocais(bool ehAdmin)
        {
            cadastroToolStripMenuItem.Enabled = ehAdmin;
            cadastroJogoToolStripMenuItem.Enabled = ehAdmin;
            listaJogosToolStripMenuItem.Enabled = ehAdmin;
            sorteadorToolStripMenuItem.Enabled = true;
        }

        public void Menu_Load(object sender, EventArgs e)
        {
            cadastroToolStripMenuItem.Enabled = false;
            cadastroJogoToolStripMenuItem.Enabled = false;
            listaJogosToolStripMenuItem.Enabled = false;
            sorteadorToolStripMenuItem.Enabled = false;
        }

        private void logoutToolStripMenuItem_Click(object sender, EventArgs e)
        {


            Application.Restart();

        }
    }
}
