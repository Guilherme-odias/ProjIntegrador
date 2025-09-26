using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace Projeto_integrador
{
    class Jogo
    {
        public string Nome { get; set; }
        public string Genero { get; set; }
        public decimal Preco { get; set; }

        public void Inserir()
        {
            Conexao conexao = new Conexao();
            using (var conn = conexao.GetConnection())
            {
                string sql = "INSERT INTO jogos (nome, genero, preco) VALUES (@nome, @genero, @preco)";
            }
        }
    }
}
