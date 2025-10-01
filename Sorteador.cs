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
        private RepositorioJogos _repositorio;
        private string modo = ""; // "loja" ou "biblioteca"

        public Sorteador()
        {
            InitializeComponent();
            _repositorio = new RepositorioJogos();

            // estado inicial
            grp_resultado.Visible = false;      // se tiver groupbox de resultado
            txt_user.Visible = false;         // só aparece quando escolher Biblioteca

            // (opcional) ligar eventos manualmente se não estiverem ligados no Designer:
            // btn_bibl.Click += btn_bibl_Click;
            // btn_loja.Click += btn_loja_Click;
            // btn_sortear.Click += btn_sortear_Click;
            // btn_nova.Click += btn_nova_Click;
        }

        // botão Minha Biblioteca

        private void Sorteador_Load(object sender, EventArgs e)
        {
            // nada aqui (a menos que queira algo ao abrir)
        }

        private void btn_bibl_Click_1(object sender, EventArgs e)
        {
            modo = "minha_biblioteca";
            txt_user.Visible = true;
            txt_user.Focus();
        }

        private void btn_loja_Click(object sender, EventArgs e)
        {
            modo = "loja";
            txt_user.Visible = false;
        }

        private void txt_user_TextChanged(object sender, EventArgs e)
        {

        }

        private void btn_sortear_Click(object sender, EventArgs e)
        {
            // Validações
            if (string.IsNullOrWhiteSpace(modo))
            {
                MessageBox.Show("Escolha primeiro 'Minha Biblioteca' ou 'Toda Loja'.");
                return;
            }

            if (modo == "minha_biblioteca" && string.IsNullOrWhiteSpace(txt_user.Text))
            {
                MessageBox.Show("Digite o nome do usuário para buscar a biblioteca.");
                return;
            }

            // Sorteia usando a classe
            var jogoSorteado = _repositorio.SortearJogo(modo, txt_user.Text.Trim());

            if (jogoSorteado == null)
            {
                MessageBox.Show("Nenhum jogo encontrado.");
                return;
            }

            // Atualiza UI
            lb_resposta.Text = jogoSorteado.Titulo;
            pt_image_jogo.Image = null;

            // Carrega imagem da URL (se houver)
            if (!string.IsNullOrWhiteSpace(jogoSorteado.Imagem))
            {
                try
                {
                    using (var wc = new WebClient())
                    {
                        byte[] data = wc.DownloadData(jogoSorteado.Imagem);
                        using (var ms = new System.IO.MemoryStream(data))
                        {
                            pt_image_jogo.Image = Image.FromStream(ms);
                            pt_image_jogo.SizeMode = PictureBoxSizeMode.Zoom; // ou StretchImage
                        }
                    }
                }
                catch (Exception ex)
                {
                    // se quiser, mostra mensagem simples e segue
                    MessageBox.Show("Não foi possível carregar a imagem do jogo.\n" + ex.Message);
                }
            }

            grp_resultado.Visible = true; // mostra o bloco com resultado
        }

        private void pt_image_jogo_Click(object sender, EventArgs e)
        {

        }

        private void lb_resposta_Click(object sender, EventArgs e)
        {

        }

        private void btn_nova_Click(object sender, EventArgs e)
        {
            Sorteador sorteador = new Sorteador();
        }
    }
}