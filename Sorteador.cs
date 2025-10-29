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
using static Projeto_integrador.RepositorioJogos;

namespace Projeto_integrador
{
    public partial class Sorteador : Form
    {
        private RepositorioJogos _repositorio;
        private string modo = ""; // "loja" ou "minha_biblioteca"
        private Dictionary<string, int> categorias;

        private List<string> _titulosAnimacao;
        private int _animIndex;
        private int _velocidade;
        private RepositorioJogos.Jogo _jogoSorteado;

        public Sorteador()
        {
            InitializeComponent();
            _repositorio = new RepositorioJogos();

            categorias = new Dictionary<string, int>()
            {
                { "Todas", 0 },
                { "Ação", 1 },
                { "Aventura", 2 },
                { "Corrida", 3 },
                { "Estratégia", 4 },
                { "Esporte", 5 },
                { "FPS", 6 },
                { "Luta", 7 },
                { "Terror", 8 },
                { "Sobrevivência", 9 },
                { "RPG", 10 }
            };

            grp_resultado.Visible = false;
            txt_user.Visible = false;

            cb_cate.DataSource = new BindingSource(categorias, null);
            cb_cate.DisplayMember = "Key";
            cb_cate.ValueMember = "Value";
            cb_cate.SelectedIndex = -1;

            PreencherCategorias();
            timer_an.Tick += TimerAnimacao_Tick;
        }

        public void ResetarTela()
        {
            lb_resposta.Text = "";
            pt_image_jogo.Image = null;
            grp_resultado.Visible = false;
            cb_cate.Visible = true;
            lb_cate.Visible = true;
            cb_cate.SelectedIndex = -1;
            txt_user.Visible = (modo == "minha_biblioteca");
        }

        private void PreencherCategorias()
        {
            var categorias = _repositorio.ObterCategorias();
            cb_cate.DataSource = null;
            cb_cate.DataSource = new BindingSource(categorias, null);
            cb_cate.DisplayMember = "Nome";
            cb_cate.ValueMember = "Id";
            if (cb_cate.Items.Count > 0)
                cb_cate.SelectedIndex = 0;
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
            if (string.IsNullOrWhiteSpace(modo))
            {
                MessageBox.Show("Escolha primeiro 'Minha Biblioteca' ou 'Toda Loja'.");
                return;
            }

            if (modo == "minha_biblioteca")
            {
                string usuario = txt_user.Text.Trim();
                if (string.IsNullOrWhiteSpace(usuario))
                {
                    MessageBox.Show("Digite o nome do usuário para buscar a biblioteca.");
                    return;
                }

                if (!_repositorio.UsuarioExiste(usuario))
                {
                    MessageBox.Show("Usuário não existe.");
                    return;
                }

                if (!_repositorio.UsuarioPossuiJogos(usuario))
                {
                    MessageBox.Show("Este usuário não possui jogos para sortear.");
                    return;
                }
            }

            int idCategoriaSelecionada = 0;
            if (cb_cate.SelectedItem != null)
            {
                var categoriaSelecionada = (Categoria)cb_cate.SelectedItem;
                idCategoriaSelecionada = categoriaSelecionada.Id;
            }

            _jogoSorteado = _repositorio.SortearJogo(modo, txt_user.Text.Trim(), idCategoriaSelecionada);
            if (_jogoSorteado == null)
            {
                MessageBox.Show("Nenhum jogo encontrado.");
                return;
            }

            cb_cate.Visible = false;
            lb_cate.Visible = false;

            _titulosAnimacao = new List<string>();
            for (int i = 0; i < 5; i++)
                _titulosAnimacao.Add("Sorteando... " + (i + 1));
            _titulosAnimacao.Add(_jogoSorteado.Titulo);

            _animIndex = _titulosAnimacao.Count - 1;
            _velocidade = 50;
            timer_an.Interval = _velocidade;
            timer_an.Start();

            grp_resultado.Visible = true;
            lb_resposta.Text = "";
            pt_image_jogo.Image = null;
        }

        private async void TimerAnimacao_Tick(object sender, EventArgs e)
        {
            if (_animIndex >= 0)
            {
                lb_resposta.Text = _titulosAnimacao[_animIndex];
                _animIndex--;
                _velocidade += 40;
                timer_an.Interval = _velocidade;
            }
            else
            {
                timer_an.Stop();
                lb_resposta.Text = "🎮 " + _jogoSorteado.Titulo;

                if (!string.IsNullOrWhiteSpace(_jogoSorteado.Imagem))
                {
                    try
                    {
                        string url = Uri.EscapeUriString(_jogoSorteado.Imagem);

                        using (HttpClient client = new HttpClient())
                        {
                            var bytes = await client.GetByteArrayAsync(url);
                            using (var ms = new System.IO.MemoryStream(bytes))
                            {
                                pt_image_jogo.Image = Image.FromStream(ms);
                                pt_image_jogo.SizeMode = PictureBoxSizeMode.Zoom;
                            }
                        }
                    }
                    catch (Exception ex)
                    {
                        Console.WriteLine("Erro ao carregar imagem: " + ex.Message);
                        pt_image_jogo.Image = null;
                    }
                }
            }
        }

        private void btn_nova_Click(object sender, EventArgs e)
        {
            ResetarTela();
        }

        private void btn_trailer_Click(object sender, EventArgs e)
        {
            if (_jogoSorteado == null)
            {
                MessageBox.Show("Nenhum jogo foi sorteado ainda!");
                return;
            }

            if (string.IsNullOrWhiteSpace(_jogoSorteado.Trailer))
            {
                MessageBox.Show("Este jogo não possui trailer cadastrado.");
                return;
            }

            Trailer telaTrailer = new Trailer(_jogoSorteado.Trailer, this);
            telaTrailer.Show();
            this.Hide();
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