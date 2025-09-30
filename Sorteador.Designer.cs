namespace Projeto_integrador
{
    partial class Sorteador
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
            pictureBox1 = new PictureBox();
            lb_titulo = new Label();
            textBox1 = new TextBox();
            btn_bi = new Button();
            btn_loja = new Button();
            btn_sortear = new Button();
            pictureBox2 = new PictureBox();
            label1 = new Label();
            button1 = new Button();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox2).BeginInit();
            SuspendLayout();
            // 
            // pictureBox1
            // 
            pictureBox1.Image = Properties.Resources.controle_ps1;
            pictureBox1.Location = new Point(369, 28);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(189, 120);
            pictureBox1.SizeMode = PictureBoxSizeMode.StretchImage;
            pictureBox1.TabIndex = 0;
            pictureBox1.TabStop = false;
            // 
            // lb_titulo
            // 
            lb_titulo.AutoSize = true;
            lb_titulo.BackColor = Color.FromArgb(168, 3, 12);
            lb_titulo.FlatStyle = FlatStyle.Popup;
            lb_titulo.Font = new Font("SansSerif", 14.2499981F, FontStyle.Italic, GraphicsUnit.Point, 2);
            lb_titulo.ForeColor = Color.FromArgb(234, 234, 234);
            lb_titulo.Location = new Point(134, 165);
            lb_titulo.Name = "lb_titulo";
            lb_titulo.Size = new Size(651, 22);
            lb_titulo.TabIndex = 1;
            lb_titulo.Text = "Escolha um Jogo Aleatório da sua Biblioteca Quimera, ou da  Própria Loja ";
            // 
            // textBox1
            // 
            textBox1.BackColor = SystemColors.ActiveCaption;
            textBox1.BorderStyle = BorderStyle.FixedSingle;
            textBox1.Font = new Font("Lucida Console", 12F, FontStyle.Regular, GraphicsUnit.Point, 0);
            textBox1.ForeColor = Color.FromArgb(234, 234, 234);
            textBox1.Location = new Point(218, 348);
            textBox1.Name = "textBox1";
            textBox1.Size = new Size(480, 23);
            textBox1.TabIndex = 2;
            // 
            // btn_bi
            // 
            btn_bi.BackColor = Color.FromArgb(168, 3, 12);
            btn_bi.FlatStyle = FlatStyle.Flat;
            btn_bi.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btn_bi.ForeColor = Color.FromArgb(234, 234, 234);
            btn_bi.Location = new Point(270, 225);
            btn_bi.Name = "btn_bi";
            btn_bi.Size = new Size(177, 38);
            btn_bi.TabIndex = 3;
            btn_bi.Text = "Minha Biblioteca";
            btn_bi.UseVisualStyleBackColor = false;
            //btn_bi.Click += btn_bi_Click;
            // 
            // btn_loja
            // 
            btn_loja.BackColor = Color.FromArgb(168, 3, 12);
            btn_loja.FlatStyle = FlatStyle.Flat;
            btn_loja.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btn_loja.ForeColor = Color.FromArgb(234, 234, 234);
            btn_loja.Location = new Point(491, 225);
            btn_loja.Name = "btn_loja";
            btn_loja.Size = new Size(116, 38);
            btn_loja.TabIndex = 4;
            btn_loja.Text = "Toda Loja";
            btn_loja.UseVisualStyleBackColor = false;
            //btn_loja.Click += btn_loja_Click;
            // 
            // btn_sortear
            // 
            btn_sortear.BackColor = Color.FromArgb(168, 3, 12);
            btn_sortear.FlatStyle = FlatStyle.Flat;
            btn_sortear.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btn_sortear.ForeColor = Color.FromArgb(234, 234, 234);
            btn_sortear.Location = new Point(426, 420);
            btn_sortear.Name = "btn_sortear";
            btn_sortear.Size = new Size(75, 38);
            btn_sortear.TabIndex = 5;
            btn_sortear.Text = "Sortear";
            btn_sortear.UseVisualStyleBackColor = false;
            // 
            // pictureBox2
            // 
            pictureBox2.Location = new Point(369, 490);
            pictureBox2.Name = "pictureBox2";
            pictureBox2.Size = new Size(189, 177);
            pictureBox2.TabIndex = 6;
            pictureBox2.TabStop = false;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.BackColor = Color.FromArgb(168, 3, 12);
            label1.FlatStyle = FlatStyle.Flat;
            label1.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            label1.ForeColor = Color.FromArgb(234, 234, 234);
            label1.Location = new Point(425, 682);
            label1.Name = "label1";
            label1.Size = new Size(76, 19);
            label1.TabIndex = 7;
            label1.Text = "Resposta";
            // 
            // button1
            // 
            button1.BackColor = Color.FromArgb(168, 3, 12);
            button1.FlatStyle = FlatStyle.Flat;
            button1.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            button1.ForeColor = Color.FromArgb(234, 234, 234);
            button1.Location = new Point(402, 723);
            button1.Name = "button1";
            button1.Size = new Size(120, 49);
            button1.TabIndex = 8;
            button1.Text = "Sortear Novamente";
            button1.UseVisualStyleBackColor = false;
            // 
            // Sorteador
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            ClientSize = new Size(971, 838);
            Controls.Add(button1);
            Controls.Add(label1);
            Controls.Add(pictureBox2);
            Controls.Add(btn_sortear);
            Controls.Add(btn_loja);
            Controls.Add(btn_bi);
            Controls.Add(textBox1);
            Controls.Add(lb_titulo);
            Controls.Add(pictureBox1);
            Name = "Sorteador";
            Text = "Sorteador";
            //Load += Sorteador_Load;
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox2).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private PictureBox pictureBox1;
        private Label lb_titulo;
        private TextBox textBox1;
        private Button btn_bi;
        private Button btn_loja;
        private Button btn_sortear;
        private PictureBox pictureBox2;
        private Label label1;
        private Button button1;
    }
}