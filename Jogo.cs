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
        public string Categoria { get; set; }
        public string Titulo { get; set; }
        public string Desenvolvedora { get; set; }
        public string Distribuidora { get; set; }
        public string Informacoes { get; set; }
        public DateTime DataLancamento { get; set; }
        public string RequisitosSistema { get; set; }

        public void Inserir()
        {
            Conexao conexao = new Conexao();
            using (var conn = conexao.GetConnection())
            {
                string sql = @"INSERT INTO jogos 
                    (categoria, titulo, desenvolvedora, distribuidora, informacoes, data_lancamento, req_sistema) 
                    VALUES 
                    (@categoria, @titulo, @desenvolvedora, @distribuidora, @informacoes, @data_lancamento, @req_sistema)";

                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@categoria", Categoria);
                    cmd.Parameters.AddWithValue("@titulo", Titulo);
                    cmd.Parameters.AddWithValue("@desenvolvedora", Desenvolvedora);
                    cmd.Parameters.AddWithValue("@distribuidora", Distribuidora);
                    cmd.Parameters.AddWithValue("@informacoes", Informacoes);
                    cmd.Parameters.AddWithValue("@data_lancamento", DataLancamento);
                    cmd.Parameters.AddWithValue("@req_sistema", RequisitosSistema);

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
