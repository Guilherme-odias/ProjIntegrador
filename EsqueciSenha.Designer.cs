namespace Projeto_integrador
{
    partial class EsqueciSenha
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
            txtEmail = new TextBox();
            label1 = new Label();
            label2 = new Label();
            txtCodigo = new TextBox();
            label3 = new Label();
            EnviarCodigo = new Button();
            button1 = new Button();
            SuspendLayout();
            // 
            // txtEmail
            // 
            txtEmail.Location = new Point(102, 132);
            txtEmail.Name = "txtEmail";
            txtEmail.Size = new Size(231, 23);
            txtEmail.TabIndex = 0;
            // 
            // label1
            // 
            label1.Font = new Font("Segoe UI", 12F, FontStyle.Regular, GraphicsUnit.Point, 0);
            label1.ForeColor = Color.FromArgb(234, 234, 234);
            label1.Location = new Point(91, 56);
            label1.Name = "label1";
            label1.Size = new Size(268, 48);
            label1.TabIndex = 1;
            label1.Text = "COLOQUE O EMAIL CADASTRADO\r\n PARA RECUPERAR SUA CONTA";
            label1.Click += label1_Click;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.ForeColor = Color.FromArgb(234, 234, 234);
            label2.Location = new Point(102, 114);
            label2.Name = "label2";
            label2.Size = new Size(41, 15);
            label2.TabIndex = 2;
            label2.Text = "EMAIL";
            // 
            // txtCodigo
            // 
            txtCodigo.Location = new Point(102, 184);
            txtCodigo.Name = "txtCodigo";
            txtCodigo.Size = new Size(100, 23);
            txtCodigo.TabIndex = 3;
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.ForeColor = Color.FromArgb(234, 234, 234);
            label3.Location = new Point(102, 166);
            label3.Name = "label3";
            label3.Size = new Size(52, 15);
            label3.TabIndex = 4;
            label3.Text = "CODIGO";
            // 
            // EnviarCodigo
            // 
            EnviarCodigo.BackColor = Color.FromArgb(168, 3, 12);
            EnviarCodigo.ForeColor = Color.FromArgb(234, 234, 234);
            EnviarCodigo.Location = new Point(339, 132);
            EnviarCodigo.Name = "EnviarCodigo";
            EnviarCodigo.Size = new Size(55, 23);
            EnviarCodigo.TabIndex = 5;
            EnviarCodigo.Text = "ENVIAR";
            EnviarCodigo.UseVisualStyleBackColor = false;
            EnviarCodigo.Click += button1_Click;
            // 
            // button1
            // 
            button1.BackColor = Color.FromArgb(168, 3, 12);
            button1.ForeColor = Color.FromArgb(234, 234, 234);
            button1.Location = new Point(208, 184);
            button1.Name = "button1";
            button1.Size = new Size(71, 23);
            button1.TabIndex = 6;
            button1.Text = "VERIFICAR";
            button1.UseVisualStyleBackColor = false;
            // 
            // EsqueciSenha
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            ClientSize = new Size(681, 423);
            Controls.Add(button1);
            Controls.Add(EnviarCodigo);
            Controls.Add(label3);
            Controls.Add(txtCodigo);
            Controls.Add(label2);
            Controls.Add(label1);
            Controls.Add(txtEmail);
            Name = "EsqueciSenha";
            Text = "EsqueciSenha";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private TextBox txtEmail;
        private Label label1;
        private Label label2;
        private TextBox txtCodigo;
        private Label label3;
        private Button EnviarCodigo;
        private Button button1;
    }
}