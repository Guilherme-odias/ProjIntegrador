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

        public DataTable busca_email(string imail)
        {
            string nomeBusca = imail;
            string sql = "SELECT * FROM cadastro WHERE email LIKE @imail";
            Conexao conexao = new Conexao();
            using (var conn = conexao.GetConnection())
            {
                using (MySqlDataAdapter da = new MySqlDataAdapter(sql, conn))
                {
                    da.SelectCommand.Parameters.AddWithValue("@imail", $"%{nomeBusca}%");
                    DataTable dt = new DataTable();
                    da.Fill(dt);
                    return dt;
                }
            }
        }

    }
}
