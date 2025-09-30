namespace Projeto_integrador
{
    partial class CadastroJogos
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
            btnCadastrar = new Button();
            lblNomeJogo = new Label();
            txtNomeJogo = new TextBox();
            lblGenero = new Label();
            txtGenero = new TextBox();
            lblPreco = new Label();
            txtPreco = new TextBox();
            dgvJogos = new DataGridView();
            ((System.ComponentModel.ISupportInitialize)dgvJogos).BeginInit();
            SuspendLayout();
            // 
            // btnCadastrar
            // 
            btnCadastrar.Location = new Point(634, 28);
            btnCadastrar.Name = "btnCadastrar";
            btnCadastrar.Size = new Size(77, 22);
            btnCadastrar.TabIndex = 0;
            btnCadastrar.Text = "Cadastrar";
            btnCadastrar.UseVisualStyleBackColor = true;
            btnCadastrar.Click += btnCadastrar_Click;
            // 
            // lblNomeJogo
            // 
            lblNomeJogo.AutoSize = true;
            lblNomeJogo.Location = new Point(50, 11);
            lblNomeJogo.Name = "lblNomeJogo";
            lblNomeJogo.Size = new Size(85, 15);
            lblNomeJogo.TabIndex = 1;
            lblNomeJogo.Text = "Nome do Jogo";
            // 
            // txtNomeJogo
            // 
            txtNomeJogo.Location = new Point(50, 29);
            txtNomeJogo.Name = "txtNomeJogo";
            txtNomeJogo.Size = new Size(223, 23);
            txtNomeJogo.TabIndex = 2;
            // 
            // lblGenero
            // 
            lblGenero.AutoSize = true;
            lblGenero.Location = new Point(296, 11);
            lblGenero.Name = "lblGenero";
            lblGenero.Size = new Size(45, 15);
            lblGenero.TabIndex = 3;
            lblGenero.Text = "Gênero";
            // 
            // txtGenero
            // 
            txtGenero.Location = new Point(296, 29);
            txtGenero.Name = "txtGenero";
            txtGenero.Size = new Size(238, 23);
            txtGenero.TabIndex = 4;
            // 
            // lblPreco
            // 
            lblPreco.AutoSize = true;
            lblPreco.Location = new Point(553, 11);
            lblPreco.Name = "lblPreco";
            lblPreco.Size = new Size(37, 15);
            lblPreco.TabIndex = 5;
            lblPreco.Text = "Preço";
            // 
            // txtPreco
            // 
            txtPreco.Location = new Point(553, 29);
            txtPreco.Name = "txtPreco";
            txtPreco.Size = new Size(66, 23);
            txtPreco.TabIndex = 6;
            // 
            // dgvJogos
            // 
            dgvJogos.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvJogos.Location = new Point(38, 84);
            dgvJogos.Name = "dgvJogos";
            dgvJogos.Size = new Size(713, 326);
            dgvJogos.TabIndex = 7;
            dgvJogos.CellContentClick += dgvJogos_CellContentClick_1;
            // 
            // CadastroJogos
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(800, 450);
            Controls.Add(dgvJogos);
            Controls.Add(txtPreco);
            Controls.Add(lblPreco);
            Controls.Add(txtGenero);
            Controls.Add(lblGenero);
            Controls.Add(txtNomeJogo);
            Controls.Add(lblNomeJogo);
            Controls.Add(btnCadastrar);
            Name = "CadastroJogos";
            Text = "CadastroJogos";
            ((System.ComponentModel.ISupportInitialize)dgvJogos).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button btnCadastrar;
        private Label lblNomeJogo;
        private TextBox txtNomeJogo;
        private Label lblGenero;
        private TextBox txtGenero;
        private Label lblPreco;
        private TextBox txtPreco;
        private DataGridView dgvJogos;
    }
}