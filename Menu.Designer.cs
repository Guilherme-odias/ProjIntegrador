namespace Projeto_integrador
{
    partial class Menu
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            menuStrip1 = new MenuStrip();
            tabelasToolStripMenuItem = new ToolStripMenuItem();
            cadastroToolStripMenuItem = new ToolStripMenuItem();
            loginToolStripMenuItem = new ToolStripMenuItem();
            cadastroJogoToolStripMenuItem = new ToolStripMenuItem();
            listaJogosToolStripMenuItem = new ToolStripMenuItem();
            sorteadorToolStripMenuItem = new ToolStripMenuItem();
            menuStrip1.SuspendLayout();
            SuspendLayout();
            // 
            // menuStrip1
            // 
            menuStrip1.Items.AddRange(new ToolStripItem[] { tabelasToolStripMenuItem });
            menuStrip1.Location = new Point(0, 0);
            menuStrip1.Name = "menuStrip1";
            menuStrip1.Size = new Size(800, 24);
            menuStrip1.TabIndex = 0;
            menuStrip1.Text = "menuStrip1";
            // 
            // tabelasToolStripMenuItem
            // 
            tabelasToolStripMenuItem.DropDownItems.AddRange(new ToolStripItem[] { cadastroToolStripMenuItem, loginToolStripMenuItem, cadastroJogoToolStripMenuItem, listaJogosToolStripMenuItem, sorteadorToolStripMenuItem });
            tabelasToolStripMenuItem.Name = "tabelasToolStripMenuItem";
            tabelasToolStripMenuItem.Size = new Size(58, 20);
            tabelasToolStripMenuItem.Text = "Tabelas";
            tabelasToolStripMenuItem.Click += tabelasToolStripMenuItem_Click;
            // 
            // cadastroToolStripMenuItem
            // 
            cadastroToolStripMenuItem.Name = "cadastroToolStripMenuItem";
            cadastroToolStripMenuItem.Size = new Size(149, 22);
            cadastroToolStripMenuItem.Text = "Cadastro";
            cadastroToolStripMenuItem.Click += cadastroToolStripMenuItem_Click;
            // 
            // loginToolStripMenuItem
            // 
            loginToolStripMenuItem.Name = "loginToolStripMenuItem";
            loginToolStripMenuItem.Size = new Size(149, 22);
            loginToolStripMenuItem.Text = "Login";
            loginToolStripMenuItem.Click += loginToolStripMenuItem_Click;
            // 
            // cadastroJogoToolStripMenuItem
            // 
            cadastroJogoToolStripMenuItem.Name = "cadastroJogoToolStripMenuItem";
            cadastroJogoToolStripMenuItem.Size = new Size(149, 22);
            cadastroJogoToolStripMenuItem.Text = "Cadastro Jogo";
            cadastroJogoToolStripMenuItem.Click += cadastroJogoToolStripMenuItem_Click;
            // 
            // listaJogosToolStripMenuItem
            // 
            listaJogosToolStripMenuItem.Name = "listaJogosToolStripMenuItem";
            listaJogosToolStripMenuItem.Size = new Size(149, 22);
            listaJogosToolStripMenuItem.Text = "ListaJogos";
            listaJogosToolStripMenuItem.Click += listaJogosToolStripMenuItem_Click;
            // 
            // sorteadorToolStripMenuItem
            // 
            sorteadorToolStripMenuItem.Name = "sorteadorToolStripMenuItem";
            sorteadorToolStripMenuItem.Size = new Size(149, 22);
            sorteadorToolStripMenuItem.Text = "Sorteador";
            sorteadorToolStripMenuItem.Click += sorteadorToolStripMenuItem_Click;
            // 
            // Menu
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(800, 450);
            Controls.Add(menuStrip1);
            IsMdiContainer = true;
            MainMenuStrip = menuStrip1;
            Name = "Menu";
            Text = "Menu";
            Load += Menu_Load;
            menuStrip1.ResumeLayout(false);
            menuStrip1.PerformLayout();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private MenuStrip menuStrip1;
        private ToolStripMenuItem tabelasToolStripMenuItem;
        private ToolStripMenuItem cadastroToolStripMenuItem;
        private ToolStripMenuItem loginToolStripMenuItem;
        private ToolStripMenuItem cadastroJogoToolStripMenuItem;
        private ToolStripMenuItem listaJogosToolStripMenuItem;
        private ToolStripMenuItem sorteadorToolStripMenuItem;
    }
}