using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;
using Projeto_integrador;



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
                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@nome", Nome);
                    cmd.Parameters.AddWithValue("@genero", Genero);
                    cmd.Parameters.AddWithValue("@preco", Preco);
                    conn.Open();
                    cmd.ExecuteNonQuery();
                }
            }
        }

        public static DataTable ListarTodos()
        {
            Conexao conexao = new Conexao();
            using (var conn = conexao.GetConnection())
            {
                string sql = "SELECT * FROM jogos";
                using (MySqlDataAdapter da = new MySqlDataAdapter(sql, conn))
                {
                    DataTable dt = new DataTable();
                    da.Fill(dt);
                    return dt;
                }
            }
        }
    }
}
