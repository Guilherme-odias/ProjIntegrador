namespace Projeto_integrador
{
    partial class TelaCadastroLogin
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
            Button cad;
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(TelaCadastroLogin));
            url_foto = new Button();
            lb1 = new Label();
            email1 = new Label();
            tipo_user1 = new Label();
            nome1 = new Label();
            nome_user1 = new Label();
            senha1 = new Label();
            url_foto1 = new Label();
            cpf1 = new Label();
            label9 = new Label();
            email = new TextBox();
            tipo_user = new TextBox();
            nome = new TextBox();
            nome_user = new TextBox();
            cpf = new TextBox();
            openFileDialog1 = new OpenFileDialog();
            senha = new TextBox();
            confsenha = new TextBox();
            label1 = new Label();
            pictureBox1 = new PictureBox();
            cad = new Button();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            SuspendLayout();
            // 
            // cad
            // 
            cad.BackColor = Color.FromArgb(168, 3, 12);
            cad.ForeColor = Color.FromArgb(234, 234, 234);
            cad.Location = new Point(328, 379);
            cad.Name = "cad";
            cad.Size = new Size(116, 40);
            cad.TabIndex = 21;
            cad.Text = "Cadastrar";
            cad.UseVisualStyleBackColor = false;
            cad.Click += button1_Click;
            // 
            // url_foto
            // 
            url_foto.BackColor = Color.FromArgb(168, 3, 12);
            url_foto.ForeColor = Color.FromArgb(234, 234, 234);
            url_foto.Location = new Point(289, 224);
            url_foto.Name = "url_foto";
            url_foto.Size = new Size(75, 23);
            url_foto.TabIndex = 0;
            url_foto.Text = "Escolher";
            url_foto.UseVisualStyleBackColor = false;
            url_foto.Click += url_foto_Click;
            // 
            // lb1
            // 
            lb1.AutoSize = true;
            lb1.Font = new Font("SansSerif", 27.7499962F, FontStyle.Bold, GraphicsUnit.Point, 2);
            lb1.ForeColor = Color.FromArgb(234, 234, 234);
            lb1.Location = new Point(308, 14);
            lb1.Name = "lb1";
            lb1.Size = new Size(170, 43);
            lb1.TabIndex = 1;
            lb1.Text = "Quimera";
            // 
            // email1
            // 
            email1.AutoSize = true;
            email1.Font = new Font("Century Gothic", 9.75F);
            email1.ForeColor = Color.FromArgb(234, 234, 234);
            email1.Location = new Point(62, 101);
            email1.Name = "email1";
            email1.Size = new Size(43, 17);
            email1.TabIndex = 2;
            email1.Text = "Email";
            // 
            // tipo_user1
            // 
            tipo_user1.AutoSize = true;
            tipo_user1.Font = new Font("Century Gothic", 9.75F);
            tipo_user1.ForeColor = Color.FromArgb(234, 234, 234);
            tipo_user1.Location = new Point(418, 196);
            tipo_user1.Name = "tipo_user1";
            tipo_user1.Size = new Size(105, 17);
            tipo_user1.TabIndex = 3;
            tipo_user1.Text = "Tipo de usuário";
            // 
            // nome1
            // 
            nome1.AutoSize = true;
            nome1.Font = new Font("Century Gothic", 9.75F);
            nome1.ForeColor = Color.FromArgb(234, 234, 234);
            nome1.Location = new Point(289, 101);
            nome1.Name = "nome1";
            nome1.Size = new Size(72, 17);
            nome1.TabIndex = 4;
            nome1.Text = "Seu nome";
            // 
            // nome_user1
            // 
            nome_user1.AutoSize = true;
            nome_user1.Font = new Font("Century Gothic", 9.75F);
            nome_user1.ForeColor = Color.FromArgb(234, 234, 234);
            nome_user1.Location = new Point(514, 101);
            nome_user1.Name = "nome_user1";
            nome_user1.Size = new Size(58, 17);
            nome_user1.TabIndex = 5;
            nome_user1.Text = "Apelido";
            // 
            // senha1
            // 
            senha1.AutoSize = true;
            senha1.Font = new Font("Century Gothic", 9.75F);
            senha1.ForeColor = Color.FromArgb(234, 234, 234);
            senha1.Location = new Point(62, 291);
            senha1.Name = "senha1";
            senha1.Size = new Size(46, 17);
            senha1.TabIndex = 6;
            senha1.Text = "senha";
            // 
            // url_foto1
            // 
            url_foto1.AutoSize = true;
            url_foto1.Font = new Font("Century Gothic", 9.75F);
            url_foto1.ForeColor = Color.FromArgb(234, 234, 234);
            url_foto1.Location = new Point(272, 199);
            url_foto1.Name = "url_foto1";
            url_foto1.Size = new Size(119, 17);
            url_foto1.TabIndex = 7;
            url_foto1.Text = "Imagem de perfil";
            // 
            // cpf1
            // 
            cpf1.AutoSize = true;
            cpf1.Font = new Font("Century Gothic", 9.75F);
            cpf1.ForeColor = Color.FromArgb(234, 234, 234);
            cpf1.Location = new Point(62, 198);
            cpf1.Name = "cpf1";
            cpf1.Size = new Size(33, 17);
            cpf1.TabIndex = 8;
            cpf1.Text = "CPF";
            cpf1.Click += label8_Click;
            // 
            // label9
            // 
            label9.AutoSize = true;
            label9.Font = new Font("Century Gothic", 14.25F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label9.ForeColor = Color.FromArgb(234, 234, 234);
            label9.Location = new Point(328, 57);
            label9.Name = "label9";
            label9.Size = new Size(129, 23);
            label9.TabIndex = 10;
            label9.Text = "Cadastre-se:";
            // 
            // email
            // 
            email.Location = new Point(62, 129);
            email.Name = "email";
            email.Size = new Size(192, 23);
            email.TabIndex = 12;
            // 
            // tipo_user
            // 
            tipo_user.Location = new Point(418, 224);
            tipo_user.Name = "tipo_user";
            tipo_user.Size = new Size(98, 23);
            tipo_user.TabIndex = 13;
            // 
            // nome
            // 
            nome.Location = new Point(289, 129);
            nome.Name = "nome";
            nome.Size = new Size(197, 23);
            nome.TabIndex = 14;
            // 
            // nome_user
            // 
            nome_user.Location = new Point(514, 129);
            nome_user.Name = "nome_user";
            nome_user.Size = new Size(199, 23);
            nome_user.TabIndex = 15;
            // 
            // cpf
            // 
            cpf.Location = new Point(62, 224);
            cpf.Name = "cpf";
            cpf.Size = new Size(183, 23);
            cpf.TabIndex = 16;
            // 
            // openFileDialog1
            // 
            openFileDialog1.FileName = "openFileDialog1";
            // 
            // senha
            // 
            senha.Location = new Point(62, 326);
            senha.Name = "senha";
            senha.Size = new Size(168, 23);
            senha.TabIndex = 17;
            // 
            // confsenha
            // 
            confsenha.Location = new Point(276, 326);
            confsenha.Name = "confsenha";
            confsenha.Size = new Size(174, 23);
            confsenha.TabIndex = 18;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Century Gothic", 9.75F);
            label1.ForeColor = Color.FromArgb(234, 234, 234);
            label1.Location = new Point(276, 291);
            label1.Name = "label1";
            label1.Size = new Size(115, 17);
            label1.TabIndex = 19;
            label1.Text = "Confirmar senha";
            // 
            // pictureBox1
            // 
            pictureBox1.InitialImage = (Image)resources.GetObject("pictureBox1.InitialImage");
            pictureBox1.Location = new Point(563, 224);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(150, 122);
            pictureBox1.SizeMode = PictureBoxSizeMode.StretchImage;
            pictureBox1.TabIndex = 20;
            pictureBox1.TabStop = false;
            // 
            // TelaCadastroLogin
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            ClientSize = new Size(800, 450);
            Controls.Add(cad);
            Controls.Add(pictureBox1);
            Controls.Add(label1);
            Controls.Add(confsenha);
            Controls.Add(senha);
            Controls.Add(cpf);
            Controls.Add(nome_user);
            Controls.Add(nome);
            Controls.Add(tipo_user);
            Controls.Add(email);
            Controls.Add(label9);
            Controls.Add(cpf1);
            Controls.Add(url_foto1);
            Controls.Add(senha1);
            Controls.Add(nome_user1);
            Controls.Add(nome1);
            Controls.Add(tipo_user1);
            Controls.Add(email1);
            Controls.Add(lb1);
            Controls.Add(url_foto);
            Name = "TelaCadastroLogin";
            Text = "TelaCadastroLogin";
            Load += TelaCadastroLogin_Load;
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button url_foto;
        private Label lb1;
        private Label email1;
        private Label tipo_user1;
        private Label nome1;
        private Label nome_user1;
        private Label senha1;
        private Label url_foto1;
        private Label cpf1;
        private Label label9;
        private TextBox email;
        private TextBox tipo_user;
        private TextBox nome;
        private TextBox nome_user;
        private TextBox cpf;
        private OpenFileDialog openFileDialog1;
        private TextBox senha;
        private TextBox confsenha;
        private Label label1;
        private PictureBox pictureBox1;
        private Button cad;
    }
}