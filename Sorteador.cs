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
using System.Net;

namespace Projeto_integrador
{
    public partial class Sorteador : Form
    {
        private RepositorioJogos _repositorio;
        private string modo = ""; // "loja" ou "biblioteca"

        // variáveis para animação
        private List<string> _titulosAnimacao;
        private int _animIndex;
        private int _velocidade;
        private RepositorioJogos.Jogo _jogoSorteado;

        public Sorteador()
        {
            InitializeComponent();
            _repositorio = new RepositorioJogos();

            grp_resultado.Visible = false;
            txt_user.Visible = false;       

            timer_an.Tick += TimerAnimacao_Tick;

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
            _jogoSorteado = _repositorio.SortearJogo(modo, txt_user.Text.Trim());

            if (_jogoSorteado == null)
            {
                MessageBox.Show("Nenhum jogo encontrado.");
                return;
            }

            // Prepara lista de títulos para simular "roleta"
            _titulosAnimacao = new List<string>();
            for (int i = 0; i < 5; i++)
                _titulosAnimacao.Add("Sorteando... " + (i + 1));
            _titulosAnimacao.Add(_jogoSorteado.Titulo);

            _animIndex = _titulosAnimacao.Count - 1;
            _velocidade = 50; // começa rápido
            timer_an.Interval = _velocidade;
            timer_an.Start();

            grp_resultado.Visible = true;
            lb_resposta.Text = "";
            pt_image_jogo.Image = null;
        }

        private void TimerAnimacao_Tick(object sender, EventArgs e)
        {
            if (_animIndex >= 0)
            {
                lb_resposta.Text = _titulosAnimacao[_animIndex];
                _animIndex--;

                // desacelera gradualmente
                _velocidade += 40;
                timer_an.Interval = _velocidade;
            }
            else
            {
                timer_an.Stop();

                // Mostra o resultado final
                lb_resposta.Text = "🎮 " + _jogoSorteado.Titulo;

                // Tenta carregar imagem
                if (!string.IsNullOrWhiteSpace(_jogoSorteado.Imagem))
                {
                    try
                    {
                        using (var wc = new WebClient())
                        {
                            byte[] data = wc.DownloadData(_jogoSorteado.Imagem);
                            using (var ms = new System.IO.MemoryStream(data))
                            {
                                pt_image_jogo.Image = Image.FromStream(ms);
                                pt_image_jogo.SizeMode = PictureBoxSizeMode.Zoom;
                            }
                        }
                    }
                    catch
                    {
                        pt_image_jogo.Image = null;
                    }
                }
            }
        }

        private void btn_nova_Click(object sender, EventArgs e)
        {
                lb_resposta.Text = "";
                pt_image_jogo.Image = null;
                grp_resultado.Visible = false;

                // Se estiver no modo biblioteca, deixa a caixa visível
            if (modo == "minha_biblioteca")
                txt_user.Visible = true;
            else
                txt_user.Visible = false;
        }
        private void pt_image_jogo_Click(object sender, EventArgs e)
        {

        }

        private void lb_resposta_Click(object sender, EventArgs e)
        {

        }

        private void txt_user_TextChanged(object sender, EventArgs e)
        {

        }

        private void Sorteador_Load(object sender, EventArgs e)
        {
        }
    }
}