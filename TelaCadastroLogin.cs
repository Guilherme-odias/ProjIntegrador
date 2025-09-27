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
    }
}
