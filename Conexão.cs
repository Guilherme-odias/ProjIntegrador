using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using MySql.Data.MySqlClient;

namespace SisVendas
{
    public class Conexao
    {
        private static string connString = "server=10.37.44.72;user id=root;password=root;database=projeto_quimera";
        public MySqlConnection GetConnection()
        {
            return new MySqlConnection(connString);
        }
        
    }
}