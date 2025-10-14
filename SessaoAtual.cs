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

            // Verifica se já está logado, se não abre a tela de login
            public static bool VerificarLogin(Form menu)
            {
            if (!string.IsNullOrEmpty(UsuarioLogado))
            {
                // chama corretamente o método estático
                AplicarPermissoes(menu);
                return true;
            }

            using (TelaLogin login = new TelaLogin())
            {
                if (login.ShowDialog() == DialogResult.OK)
                {
                    UsuarioLogado = login.EmailOuUsuario;
                    TipoUsuario = login.TipoUsuario;
                    AplicarPermissoes(menu); // ✅ sem erro
                    return true;
                }
            }

            return false;
            }

        private static void AplicarPermissoes(Form menu)
        {
            if (menu is Menu m) // precisa ser a classe Menu
            {
                bool ehAdmin = TipoUsuario == "admin";

                // ✅ só funciona se os ToolStripMenuItems forem públicos
                m.cadastroToolStripMenuItem.Enabled = ehAdmin;
                m.cadastroJogoToolStripMenuItem.Enabled = ehAdmin;
                m.listaJogosToolStripMenuItem.Enabled = ehAdmin;
                m.sorteadorToolStripMenuItem.Enabled = true;
            }
        }
}

        // Permite fazer logout
        public static void Logout()
            {
                UsuarioLogado = null;
                TipoUsuario = null;
            }
        }
    }
}
}
