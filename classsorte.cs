using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace Projeto_integrador
{
    class classsorte
    {
    }
    public class RepositorioJogos
    {
        private string _connectionString = "server=localhost;user id=root;password=root;database=quimera";

        // Classe que representa o jogo
        public class Jogo
        {
            public string Titulo { get; set; }
            public string Imagem { get; set; }
        }

        // Busca todos os jogos (só Titulo e Imagens_jogos)
        public List<Jogo> BuscarJogos()
        {
            var lista = new List<Jogo>();

            using (var conexao = new MySqlConnection(_connectionString))
            {
                conexao.Open();

                string sql = "SELECT Titulo, Imagens_jogos FROM jogos";
                using (var cmd = new MySqlCommand(sql, conexao))
                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        lista.Add(new Jogo
                        {
                            Titulo = reader["Titulo"].ToString(),
                            Imagem = reader["Imagens_jogos"].ToString()
                        });
                    }
                }
            }

            return lista;
        }

        // Sorteia 1 jogo da lista
        public Jogo SortearJogo()
        {
            var jogos = BuscarJogos();

            if (jogos.Count == 0)
                return null; // sem jogos no banco

            Random rnd = new Random();
            int index = rnd.Next(jogos.Count);
            return jogos[index];
        }
    }
}

