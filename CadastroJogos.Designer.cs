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
            textBox1 = new TextBox();
            btnAtualizar = new Button();
            btnRemover = new Button();
            ((System.ComponentModel.ISupportInitialize)dgvJogos).BeginInit();
            SuspendLayout();
            // 
            // btnCadastrar
            // 
            btnCadastrar.Location = new Point(819, 74);
            btnCadastrar.Name = "btnCadastrar";
            btnCadastrar.Size = new Size(77, 22);
            btnCadastrar.TabIndex = 0;
            btnCadastrar.Text = "Cadastrar";
            btnCadastrar.UseVisualStyleBackColor = true;
            btnCadastrar.Click += btnCadastrar_Click;
            // 
            // lblTitulo
            // 
            lblTitulo.AutoSize = true;
            lblTitulo.Location = new Point(91, 7);
            lblTitulo.Name = "lblTitulo";
            lblTitulo.Size = new Size(38, 15);
            lblTitulo.TabIndex = 1;
            lblTitulo.Text = "Titulo";
            // 
            // txtTitulo
            // 
            txtTitulo.Location = new Point(91, 25);
            txtTitulo.Name = "txtTitulo";
            txtTitulo.Size = new Size(223, 23);
            txtTitulo.TabIndex = 2;
            // 
            // lblCategoria
            // 
            lblCategoria.AutoSize = true;
            lblCategoria.Location = new Point(12, 7);
            lblCategoria.Name = "lblCategoria";
            lblCategoria.Size = new Size(58, 15);
            lblCategoria.TabIndex = 3;
            lblCategoria.Text = "Categoria";
            // 
            // txtCategoria
            // 
            txtCategoria.Location = new Point(12, 25);
            txtCategoria.Name = "txtCategoria";
            txtCategoria.Size = new Size(58, 23);
            txtCategoria.TabIndex = 4;
            // 
            // dgvJogos
            // 
            dgvJogos.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgvJogos.Location = new Point(12, 115);
            dgvJogos.Name = "dgvJogos";
            dgvJogos.Size = new Size(1064, 481);
            dgvJogos.TabIndex = 7;
            dgvJogos.CellContentClick += dgvJogos_CellContentClick_1;
            // 
            // lblDesenvolvedora
            // 
            lblDesenvolvedora.AutoSize = true;
            lblDesenvolvedora.Location = new Point(343, 7);
            lblDesenvolvedora.Name = "lblDesenvolvedora";
            lblDesenvolvedora.Size = new Size(91, 15);
            lblDesenvolvedora.TabIndex = 8;
            lblDesenvolvedora.Text = "Desenvlovedora";
            // 
            // txtDesenvolvedora
            // 
            txtDesenvolvedora.Location = new Point(343, 25);
            txtDesenvolvedora.Name = "txtDesenvolvedora";
            txtDesenvolvedora.Size = new Size(231, 23);
            txtDesenvolvedora.TabIndex = 9;
            // 
            // lblDistribuidora
            // 
            lblDistribuidora.AutoSize = true;
            lblDistribuidora.Location = new Point(600, 7);
            lblDistribuidora.Name = "lblDistribuidora";
            lblDistribuidora.Size = new Size(75, 15);
            lblDistribuidora.TabIndex = 10;
            lblDistribuidora.Text = "Distribuidora";
            // 
            // txtDistribuidora
            // 
            txtDistribuidora.Location = new Point(600, 25);
            txtDistribuidora.Name = "txtDistribuidora";
            txtDistribuidora.Size = new Size(181, 23);
            txtDistribuidora.TabIndex = 11;
            // 
            // lblInformacoes
            // 
            lblInformacoes.AutoSize = true;
            lblInformacoes.Location = new Point(806, 9);
            lblInformacoes.Name = "lblInformacoes";
            lblInformacoes.Size = new Size(73, 15);
            lblInformacoes.TabIndex = 12;
            lblInformacoes.Text = "Informações";
            // 
            // txtInformacoes
            // 
            txtInformacoes.Location = new Point(806, 25);
            txtInformacoes.Name = "txtInformacoes";
            txtInformacoes.Size = new Size(270, 23);
            txtInformacoes.TabIndex = 13;
            // 
            // lblDataLancamento
            // 
            lblDataLancamento.AutoSize = true;
            lblDataLancamento.Location = new Point(12, 57);
            lblDataLancamento.Name = "lblDataLancamento";
            lblDataLancamento.Size = new Size(116, 15);
            lblDataLancamento.TabIndex = 14;
            lblDataLancamento.Text = "Data de Lançamento";
            // 
            // dtpDataLancamento
            // 
            dtpDataLancamento.Location = new Point(12, 76);
            dtpDataLancamento.Name = "dtpDataLancamento";
            dtpDataLancamento.Size = new Size(200, 23);
            dtpDataLancamento.TabIndex = 15;
            // 
            // lblReqSistema
            // 
            lblReqSistema.AutoSize = true;
            lblReqSistema.Location = new Point(237, 57);
            lblReqSistema.Name = "lblReqSistema";
            lblReqSistema.Size = new Size(122, 15);
            lblReqSistema.TabIndex = 16;
            lblReqSistema.Text = "Requisitos do Sistema";
            // 
            // txtReq_Sis
            // 
            txtReq_Sis.Location = new Point(237, 75);
            txtReq_Sis.Name = "txtReq_Sis";
            txtReq_Sis.Size = new Size(312, 23);
            txtReq_Sis.TabIndex = 17;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Location = new Point(573, 57);
            label1.Name = "label1";
            label1.Size = new Size(52, 15);
            label1.TabIndex = 18;
            label1.Text = "Imagens";
            // 
            // textBox1
            // 
            textBox1.Location = new Point(573, 75);
            textBox1.Name = "textBox1";
            textBox1.Size = new Size(220, 23);
            textBox1.TabIndex = 19;
            // 
            // btnAtualizar
            // 
            btnAtualizar.Location = new Point(902, 75);
            btnAtualizar.Name = "btnAtualizar";
            btnAtualizar.Size = new Size(75, 20);
            btnAtualizar.TabIndex = 20;
            btnAtualizar.Text = "Atualizar";
            btnAtualizar.UseVisualStyleBackColor = true;
            btnAtualizar.Click += btnAtualizar_Click;
            // 
            // btnRemover
            // 
            btnRemover.Location = new Point(983, 74);
            btnRemover.Name = "btnRemover";
            btnRemover.Size = new Size(75, 21);
            btnRemover.TabIndex = 21;
            btnRemover.Text = "Remover";
            btnRemover.UseVisualStyleBackColor = true;
            // 
            // CadastroJogos
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(1088, 621);
            Controls.Add(btnRemover);
            Controls.Add(btnAtualizar);
            Controls.Add(textBox1);
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
            Name = "CadastroJogos";
            Text = "CadastroJogos";
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
        private TextBox textBox1;
        private Button btnAtualizar;
        private Button btnRemover;
    }
}