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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(CadastroJogos));
            btnCadastrar = new Button();
            lblTitulo = new Label();
            txtTitulo = new TextBox();
            lblCategoria = new Label();
            txtCategoria = new TextBox();
            dgvJogos = new DataGridView();
            lblDesenvolvedora = new Label();
            txtDesenvolvedora = new TextBox();
            lblDistribuidora = new Label();
            txtDistribuidora = new TextBox();
            lblInformacoes = new Label();
            txtInformacoes = new TextBox();
            lblDataLancamento = new Label();
            dtpDataLancamento = new DateTimePicker();
            lblReqSistema = new Label();
            txtReq_Sis = new TextBox();
            label1 = new Label();
            txtImagem1 = new TextBox();
            btnAtualizar = new Button();
            btnRemover = new Button();
            txtImagem2 = new TextBox();
            txtImagem3 = new TextBox();
            label2 = new Label();
            label3 = new Label();
            label4 = new Label();
            ((System.ComponentModel.ISupportInitialize)dgvJogos).BeginInit();
            SuspendLayout();
            // 
            // btnCadastrar
            // 
            btnCadastrar.BackColor = Color.FromArgb(168, 3, 12);
            btnCadastrar.Font = new Font("Century Gothic", 9.75F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnCadastrar.ForeColor = Color.FromArgb(234, 234, 234);
            btnCadastrar.Location = new Point(992, 47);
            btnCadastrar.Name = "btnCadastrar";
            btnCadastrar.Size = new Size(84, 22);
            btnCadastrar.TabIndex = 0;
            btnCadastrar.Text = "Cadastrar";
            btnCadastrar.UseVisualStyleBackColor = false;
            btnCadastrar.Click += btnCadastrar_Click;
            // 
            // lblTitulo
            // 
            lblTitulo.AutoSize = true;
            lblTitulo.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblTitulo.ForeColor = Color.FromArgb(234, 234, 234);
            lblTitulo.Location = new Point(93, 28);
            lblTitulo.Name = "lblTitulo";
            lblTitulo.Size = new Size(39, 15);
            lblTitulo.TabIndex = 1;
            lblTitulo.Text = "Titulo";
            // 
            // txtTitulo
            // 
            txtTitulo.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtTitulo.Location = new Point(93, 46);
            txtTitulo.Name = "txtTitulo";
            txtTitulo.Size = new Size(223, 23);
            txtTitulo.TabIndex = 2;
            // 
            // lblCategoria
            // 
            lblCategoria.AutoSize = true;
            lblCategoria.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblCategoria.ForeColor = Color.FromArgb(234, 234, 234);
            lblCategoria.Location = new Point(14, 28);
            lblCategoria.Name = "lblCategoria";
            lblCategoria.Size = new Size(62, 15);
            lblCategoria.TabIndex = 3;
            lblCategoria.Text = "Categoria";
            // 
            // txtCategoria
            // 
            txtCategoria.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtCategoria.Location = new Point(14, 46);
            txtCategoria.Name = "txtCategoria";
            txtCategoria.Size = new Size(73, 23);
            txtCategoria.TabIndex = 4;
            // 
            // dgvJogos
            // 
            dgvJogos.BackgroundColor = Color.FromArgb(234, 234, 234);
            dgvJogos.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvJogos.Location = new Point(15, 146);
            dgvJogos.Name = "dgvJogos";
            dgvJogos.Size = new Size(1064, 450);
            dgvJogos.TabIndex = 7;
            dgvJogos.CellContentClick += dgvJogos_CellContentClick_1;
            // 
            // lblDesenvolvedora
            // 
            lblDesenvolvedora.AutoSize = true;
            lblDesenvolvedora.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblDesenvolvedora.ForeColor = Color.FromArgb(234, 234, 234);
            lblDesenvolvedora.Location = new Point(322, 28);
            lblDesenvolvedora.Name = "lblDesenvolvedora";
            lblDesenvolvedora.Size = new Size(100, 15);
            lblDesenvolvedora.TabIndex = 8;
            lblDesenvolvedora.Text = "Desenvolvedora";
            // 
            // txtDesenvolvedora
            // 
            txtDesenvolvedora.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtDesenvolvedora.Location = new Point(322, 46);
            txtDesenvolvedora.Name = "txtDesenvolvedora";
            txtDesenvolvedora.Size = new Size(209, 23);
            txtDesenvolvedora.TabIndex = 9;
            // 
            // lblDistribuidora
            // 
            lblDistribuidora.AutoSize = true;
            lblDistribuidora.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblDistribuidora.ForeColor = Color.FromArgb(234, 234, 234);
            lblDistribuidora.Location = new Point(537, 28);
            lblDistribuidora.Name = "lblDistribuidora";
            lblDistribuidora.Size = new Size(79, 15);
            lblDistribuidora.TabIndex = 10;
            lblDistribuidora.Text = "Distribuidora";
            // 
            // txtDistribuidora
            // 
            txtDistribuidora.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtDistribuidora.Location = new Point(537, 46);
            txtDistribuidora.Name = "txtDistribuidora";
            txtDistribuidora.Size = new Size(181, 23);
            txtDistribuidora.TabIndex = 11;
            // 
            // lblInformacoes
            // 
            lblInformacoes.AutoSize = true;
            lblInformacoes.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblInformacoes.ForeColor = Color.FromArgb(234, 234, 234);
            lblInformacoes.Location = new Point(724, 28);
            lblInformacoes.Name = "lblInformacoes";
            lblInformacoes.Size = new Size(79, 15);
            lblInformacoes.TabIndex = 12;
            lblInformacoes.Text = "Informações";
            // 
            // txtInformacoes
            // 
            txtInformacoes.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtInformacoes.Location = new Point(724, 46);
            txtInformacoes.Name = "txtInformacoes";
            txtInformacoes.Size = new Size(264, 23);
            txtInformacoes.TabIndex = 13;
            // 
            // lblDataLancamento
            // 
            lblDataLancamento.AutoSize = true;
            lblDataLancamento.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblDataLancamento.ForeColor = Color.FromArgb(234, 234, 234);
            lblDataLancamento.Location = new Point(15, 84);
            lblDataLancamento.Name = "lblDataLancamento";
            lblDataLancamento.Size = new Size(127, 15);
            lblDataLancamento.TabIndex = 14;
            lblDataLancamento.Text = "Data de Lançamento";
            // 
            // dtpDataLancamento
            // 
            dtpDataLancamento.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            dtpDataLancamento.Location = new Point(15, 102);
            dtpDataLancamento.Name = "dtpDataLancamento";
            dtpDataLancamento.Size = new Size(200, 23);
            dtpDataLancamento.TabIndex = 15;
            // 
            // lblReqSistema
            // 
            lblReqSistema.AutoSize = true;
            lblReqSistema.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            lblReqSistema.ForeColor = Color.FromArgb(234, 234, 234);
            lblReqSistema.Location = new Point(240, 84);
            lblReqSistema.Name = "lblReqSistema";
            lblReqSistema.Size = new Size(138, 15);
            lblReqSistema.TabIndex = 16;
            lblReqSistema.Text = "Requisitos do Sistema";
            // 
            // txtReq_Sis
            // 
            txtReq_Sis.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtReq_Sis.Location = new Point(240, 102);
            txtReq_Sis.Name = "txtReq_Sis";
            txtReq_Sis.Size = new Size(312, 23);
            txtReq_Sis.TabIndex = 17;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            label1.ForeColor = Color.FromArgb(234, 234, 234);
            label1.Location = new Point(573, 84);
            label1.Name = "label1";
            label1.Size = new Size(57, 15);
            label1.TabIndex = 18;
            label1.Text = "Imagens";
            // 
            // txtImagem1
            // 
            txtImagem1.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtImagem1.Location = new Point(703, 102);
            txtImagem1.Name = "txtImagem1";
            txtImagem1.Size = new Size(109, 23);
            txtImagem1.TabIndex = 19;
            // 
            // btnAtualizar
            // 
            btnAtualizar.BackColor = Color.FromArgb(168, 3, 12);
            btnAtualizar.Font = new Font("Century Gothic", 9.75F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnAtualizar.ForeColor = Color.FromArgb(234, 234, 234);
            btnAtualizar.Location = new Point(992, 75);
            btnAtualizar.Name = "btnAtualizar";
            btnAtualizar.Size = new Size(84, 22);
            btnAtualizar.TabIndex = 20;
            btnAtualizar.Text = "Atualizar";
            btnAtualizar.UseVisualStyleBackColor = false;
            btnAtualizar.Click += btnAtualizar_Click;
            // 
            // btnRemover
            // 
            btnRemover.BackColor = Color.FromArgb(168, 3, 12);
            btnRemover.Font = new Font("Century Gothic", 9.75F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btnRemover.ForeColor = Color.FromArgb(234, 234, 234);
            btnRemover.Location = new Point(992, 103);
            btnRemover.Name = "btnRemover";
            btnRemover.Size = new Size(84, 22);
            btnRemover.TabIndex = 21;
            btnRemover.Text = "Remover";
            btnRemover.UseVisualStyleBackColor = false;
            btnRemover.Click += btnRemover_Click;
            // 
            // txtImagem2
            // 
            txtImagem2.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtImagem2.Location = new Point(573, 102);
            txtImagem2.Name = "txtImagem2";
            txtImagem2.Size = new Size(109, 23);
            txtImagem2.TabIndex = 22;
            // 
            // txtImagem3
            // 
            txtImagem3.Font = new Font("Century Gothic", 9.75F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txtImagem3.Location = new Point(827, 102);
            txtImagem3.Name = "txtImagem3";
            txtImagem3.Size = new Size(109, 23);
            txtImagem3.TabIndex = 23;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            label2.ForeColor = Color.FromArgb(234, 234, 234);
            label2.Location = new Point(627, 84);
            label2.Name = "label2";
            label2.Size = new Size(37, 15);
            label2.TabIndex = 24;
            label2.Text = "Capa";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            label3.ForeColor = Color.FromArgb(234, 234, 234);
            label3.Location = new Point(703, 84);
            label3.Name = "label3";
            label3.Size = new Size(37, 15);
            label3.TabIndex = 25;
            label3.Text = "Cen1";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("SansSerif", 9.749999F, FontStyle.Regular, GraphicsUnit.Point, 2);
            label4.ForeColor = Color.FromArgb(234, 234, 234);
            label4.Location = new Point(827, 84);
            label4.Name = "label4";
            label4.Size = new Size(37, 15);
            label4.TabIndex = 26;
            label4.Text = "Cen2";
            // 
            // CadastroJogos
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            ClientSize = new Size(1088, 621);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(txtImagem3);
            Controls.Add(txtImagem2);
            Controls.Add(btnRemover);
            Controls.Add(btnAtualizar);
            Controls.Add(txtImagem1);
            Controls.Add(label1);
            Controls.Add(txtReq_Sis);
            Controls.Add(lblReqSistema);
            Controls.Add(dtpDataLancamento);
            Controls.Add(lblDataLancamento);
            Controls.Add(txtInformacoes);
            Controls.Add(lblInformacoes);
            Controls.Add(txtDistribuidora);
            Controls.Add(lblDistribuidora);
            Controls.Add(txtDesenvolvedora);
            Controls.Add(lblDesenvolvedora);
            Controls.Add(dgvJogos);
            Controls.Add(txtCategoria);
            Controls.Add(lblCategoria);
            Controls.Add(txtTitulo);
            Controls.Add(lblTitulo);
            Controls.Add(btnCadastrar);
            Icon = (Icon)resources.GetObject("$this.Icon");
            Name = "CadastroJogos";
            Text = "'";
            Load += CadastroJogos_Load;
            ((System.ComponentModel.ISupportInitialize)dgvJogos).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button btnCadastrar;
        private Label lblTitulo;
        private TextBox txtTitulo;
        private Label lblCategoria;
        private TextBox txtCategoria;
        private DataGridView dgvJogos;
        private Label lblDesenvolvedora;
        private TextBox txtDesenvolvedora;
        private Label lblDistribuidora;
        private TextBox txtDistribuidora;
        private Label lblInformacoes;
        private TextBox txtInformacoes;
        private Label lblDataLancamento;
        private DateTimePicker dtpDataLancamento;
        private Label lblReqSistema;
        private TextBox txtReq_Sis;
        private Label label1;
        private TextBox txtImagem1;
        private Button btnAtualizar;
        private Button btnRemover;
        private TextBox txtImagem2;
        private TextBox txtImagem3;
        private Label label2;
        private Label label3;
        private Label label4;
    }
}