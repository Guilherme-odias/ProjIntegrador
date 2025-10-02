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
        private string _connectionString = "server=10.37.44.72;user id=root;password=root;database=projeto_quimera";

        // Modelo de jogo
        public class Jogo
        {
            public string Titulo { get; set; }
            public string Imagem { get; set; }
        }

        // Agora só existe esse método
        public Jogo SortearJogo(string modo = "loja", string usuario = "")
        {
            var lista = new List<Jogo>();

            using (var conexao = new MySqlConnection(_connectionString))
            {
                conexao.Open();

                string sql = (modo == "loja")
                    ? "SELECT Titulo, Imagens_jogos FROM jogos"
                    : @"SELECT j.Titulo, j.Imagens_jogos
                       FROM jogos j
                       INNER JOIN minha_biblioteca b ON b.id_play = j.id_play
                       INNER JOIN cadastro c ON c.id_user = b.id_user
                       WHERE c.nome_user = @usuario";

                using (var cmd = new MySqlCommand(sql, conexao))
                {
                    if (modo != "loja")
                        cmd.Parameters.AddWithValue("@usuario", usuario);

                    using (var reader = cmd.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            lista.Add(new Jogo
                            {
                                Titulo = reader["Titulo"]?.ToString() ?? string.Empty,
                                Imagem = reader["Imagens_jogos"]?.ToString() ?? string.Empty
                            });
                        }
                    }
                }
            }

            if (lista.Count == 0) return null;

            var rnd = new Random();
            return lista[rnd.Next(lista.Count)];
        }
    }
}

