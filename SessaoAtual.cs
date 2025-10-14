using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Projeto_integrador
{
    public static class SessaoAtual
    {
        private static string connectionString = "server=10.37.44.72;user id=root;password=root;database=projeto_quimera";
        public static string UsuarioLogado { get; private set; } = null;
        public static string TipoUsuario { get; private set; } = null;

        // 🔹 Verifica login e aplica permissões
        public static bool VerificarLogin(Form menu)
        {
            if (!string.IsNullOrEmpty(UsuarioLogado))
            {
                AplicarPermissoes(menu);
                return true;
            }

            using (TelaLogin login = new TelaLogin())
            {
                if (login.ShowDialog() == DialogResult.OK)
                {
                    UsuarioLogado = login.EmailOuUsuario;
                    TipoUsuario = login.TipoUsuario;
                    AplicarPermissoes(menu);
                    return true;
                }
            }

            return false;
        }

        private static void AplicarPermissoes(Form menu)
        {
            // Normaliza o texto vindo do banco
            string tipo = (TipoUsuario ?? "").Trim().ToLower();

            // Só libera tudo se for 'adm'
            bool ehAdmin = tipo == "adm";

            // Chama o método público do Menu
            m.AplicarPermissoesLocais(ehAdmin);
        }

        public static void Logout()
        {
            UsuarioLogado = null;
            TipoUsuario = null;
        }
    }
}
