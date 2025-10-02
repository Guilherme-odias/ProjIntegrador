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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Menu));
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
            resources.ApplyResources(menuStrip1, "menuStrip1");
            menuStrip1.Name = "menuStrip1";
            // 
            // tabelasToolStripMenuItem
            // 
            tabelasToolStripMenuItem.DropDownItems.AddRange(new ToolStripItem[] { cadastroToolStripMenuItem, loginToolStripMenuItem, cadastroJogoToolStripMenuItem, listaJogosToolStripMenuItem, sorteadorToolStripMenuItem });
            resources.ApplyResources(tabelasToolStripMenuItem, "tabelasToolStripMenuItem");
            tabelasToolStripMenuItem.Name = "tabelasToolStripMenuItem";
            tabelasToolStripMenuItem.Click += tabelasToolStripMenuItem_Click;
            // 
            // cadastroToolStripMenuItem
            // 
            cadastroToolStripMenuItem.Name = "cadastroToolStripMenuItem";
            resources.ApplyResources(cadastroToolStripMenuItem, "cadastroToolStripMenuItem");
            cadastroToolStripMenuItem.Click += cadastroToolStripMenuItem_Click;
            // 
            // loginToolStripMenuItem
            // 
            loginToolStripMenuItem.Name = "loginToolStripMenuItem";
            resources.ApplyResources(loginToolStripMenuItem, "loginToolStripMenuItem");
            loginToolStripMenuItem.Click += loginToolStripMenuItem_Click;
            // 
            // cadastroJogoToolStripMenuItem
            // 
            cadastroJogoToolStripMenuItem.Name = "cadastroJogoToolStripMenuItem";
            resources.ApplyResources(cadastroJogoToolStripMenuItem, "cadastroJogoToolStripMenuItem");
            cadastroJogoToolStripMenuItem.Click += cadastroJogoToolStripMenuItem_Click;
            // 
            // listaJogosToolStripMenuItem
            // 
            listaJogosToolStripMenuItem.Name = "listaJogosToolStripMenuItem";
            resources.ApplyResources(listaJogosToolStripMenuItem, "listaJogosToolStripMenuItem");
            listaJogosToolStripMenuItem.Click += listaJogosToolStripMenuItem_Click;
            // 
            // sorteadorToolStripMenuItem
            // 
            sorteadorToolStripMenuItem.Name = "sorteadorToolStripMenuItem";
            resources.ApplyResources(sorteadorToolStripMenuItem, "sorteadorToolStripMenuItem");
            sorteadorToolStripMenuItem.Click += sorteadorToolStripMenuItem_Click;
            // 
            // Menu
            // 
            resources.ApplyResources(this, "$this");
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            Controls.Add(menuStrip1);
            ForeColor = SystemColors.ControlText;
            FormBorderStyle = FormBorderStyle.Fixed3D;
            IsMdiContainer = true;
            MainMenuStrip = menuStrip1;
            Name = "Menu";
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