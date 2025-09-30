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

namespace Projeto_integrador
{
    public partial class Sorteador : Form
    {
        public Sorteador()
        {
            InitializeComponent();
        }

        private void btn_loja_Click(object sender, EventArgs e)
        {
            Conexao conexao = new Conexao();

            using (MySqlConnection conn = conexao.GetConnection())
            {
                try
                {
                    conn.Open();
                    string query = "SELECT * FROM jogos ORDER BY RAND() LIMIT 1";
                    MySqlCommand cmd = new MySqlCommand(query, conn);
                    MySqlDataReader reader = cmd.ExecuteReader();

                    if (reader.Read())
                    {

                        string nomeJogo = reader["titulo"].ToString();
                        textBox1.Text = "Jogo sorteado: " + nomeJogo;
                    }
                    else
                    {
                        textBox1.Text = "Nenhum jogo encontrado.";
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao sortear jogo: " + ex.Message);
                }
            }
        }
        private void btn_bi_Click(object sender, EventArgs e)
        {
            Conexao conexao = new Conexao();

            using (MySqlConnection conn = conexao.GetConnection())
            {
                try
                {
                    conn.Open();

                    string query = @"
                    SELECT j.titulo
                    FROM minha_biblioteca mb
                    INNER JOIN jogos j ON mb.id_play = j.id_play
                    ORDER BY RAND()
                    LIMIT 1";

                    MySqlCommand cmd = new MySqlCommand(query, conn);
                    MySqlDataReader reader = cmd.ExecuteReader();

                    if (reader.Read())
                    {
                        string tituloJogo = reader["titulo"].ToString();
                        textBox1.Text = "Jogo sorteado: " + tituloJogo;
                    }
                    else
                    {
                        textBox1.Text = "Nenhum jogo encontrado.";
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Erro ao sortear jogo: " + ex.Message);
                }
            }
        }
    }
}
