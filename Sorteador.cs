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
using MySql.Data.MySqlClient;
using System.Net;

namespace Projeto_integrador
{
    public partial class Sorteador : Form
    {
        public Sorteador()
        {
            /*InitializeComponent();
           _repositorio = new RepositorioJogos();
        }

        private void Sorteador_Load(object sender, EventArgs e)
        {
            //var jogoSorteado = _repositorio.SortearJogo();

            if (jogoSorteado != null)
            {
                lb_resposta.Text = jogoSorteado.Titulo;

                try
                {
                    using (var wc = new WebClient())
                    {
                        //byte[] data = wc.DownloadData(jogoSorteado.Imagem);
                        using (var ms = new System.IO.MemoryStream(data))
                        {
                            pt_image_jogo.Image = Image.FromStream(ms);
                            pt_image_jogo.SizeMode = PictureBoxSizeMode.StretchImage;
                        }
                    }
                }
                catch
                {
                    MessageBox.Show("Não foi possível carregar a imagem do jogo.");
                }
            }
            else
            {
                lb_resposta.Text = "Nenhum jogo encontrado!";
            }*/
        }
    }
}
