using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Projeto_integrador
{
    public class Buscas
    {

        public bool busca_email(string imail)
        {
            string sql = "SELECT COUNT(*) FROM cadastro WHERE email = @imail";
            Conexao conexao = new Conexao();

            using (var conn = conexao.GetConnection())
            {
                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@imail", imail);
                    conn.Open();
                    int count = Convert.ToInt32(cmd.ExecuteScalar());
                    return count > 0; // true se já existe
                }
            }
        }

        public bool busca_cpf(string cpff)
        {
            string sql = "SELECT COUNT(*) FROM cadastro WHERE cpf = @cpff";
            Conexao conexao = new Conexao();

            using (var conn = conexao.GetConnection())
            {
                using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@cpff", cpff);
                    conn.Open();
                    int count = Convert.ToInt32(cmd.ExecuteScalar());
                    return count > 0; // true se já existe
                }
            }
        }

    }
}
