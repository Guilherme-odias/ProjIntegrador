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
        // ajuste sua connection string se necessário
        private string _connectionString = "server=localhost;user id=root;password=root;database=projeto_quimera";

        // modelo interno
        public class Jogo
        {
            public string Titulo { get; set; }
            public string Imagem { get; set; }
        }

        // busca (retorna lista) - traz Titulo e Imagens_jogos
        public List<Jogo> BuscarJogos(string modo = "loja", string usuario = "")
        {
            var lista = new List<Jogo>();

            using (var conexao = new MySqlConnection(_connectionString))
            {
                conexao.Open();
                
                string sql;
                if (modo == "loja")
                {
                    sql = "SELECT Titulo, Imagens_jogos FROM jogos";
                }
                else // biblioteca (exemplo de join; adapte aos nomes reais das tabelas)
                {
                    sql = @"
                    SELECT j.Titulo, j.Imagens_jogos
                    FROM jogos j
                    INNER JOIN minha_biblioteca b ON b.id_play = j.id_play
                    INNER JOIN cadastro c ON c.id_user = b.id_user
                    WHERE c.nome_user = @usuario";
                }

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
                                Titulo = reader["Titulo"] != DBNull.Value ? reader["Titulo"].ToString() : string.Empty,
                                Imagem = reader["Imagens_jogos"] != DBNull.Value ? reader["Imagens_jogos"].ToString() : string.Empty
                            });
                        }
                    }
                }
            }

            return lista;
        }

        // sorteia 1 jogo (usa BuscarJogos)
        public Jogo SortearJogo(string modo = "loja", string usuario = "")
        {
            var jogos = BuscarJogos(modo, usuario);
            if (jogos == null || jogos.Count == 0) return null;

            var rnd = new Random();
            return jogos[rnd.Next(jogos.Count)];
        }
    }
}

