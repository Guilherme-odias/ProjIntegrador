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
            txt_user = new TextBox();
            btn_bibl = new Button();
            btn_loja = new Button();
            btn_sortear = new Button();
            pt_image_jogo = new PictureBox();
            lb_resposta = new Label();
            btn_nova = new Button();
            grp_resultado = new GroupBox();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            ((System.ComponentModel.ISupportInitialize)pt_image_jogo).BeginInit();
            grp_resultado.SuspendLayout();
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
            // txt_user
            // 
            txt_user.BackColor = SystemColors.ActiveCaption;
            txt_user.BorderStyle = BorderStyle.FixedSingle;
            txt_user.Font = new Font("Lucida Console", 12F, FontStyle.Regular, GraphicsUnit.Point, 0);
            txt_user.ForeColor = Color.FromArgb(234, 234, 234);
            txt_user.Location = new Point(218, 348);
            txt_user.Name = "txt_user";
            txt_user.Size = new Size(480, 23);
            txt_user.TabIndex = 2;
            txt_user.TextChanged += txt_user_TextChanged;
            // 
            // btn_bibl
            // 
            btn_bibl.BackColor = Color.FromArgb(168, 3, 12);
            btn_bibl.FlatStyle = FlatStyle.Flat;
            btn_bibl.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btn_bibl.ForeColor = Color.FromArgb(234, 234, 234);
            btn_bibl.Location = new Point(270, 225);
            btn_bibl.Name = "btn_bibl";
            btn_bibl.Size = new Size(177, 38);
            btn_bibl.TabIndex = 3;
            btn_bibl.Text = "Minha Biblioteca";
            btn_bibl.UseVisualStyleBackColor = false;
            btn_bibl.Click += btn_bibl_Click_1;
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
            btn_loja.Click += btn_loja_Click;
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
            btn_sortear.Click += btn_sortear_Click;
            // 
            // pt_image_jogo
            // 
            pt_image_jogo.Location = new Point(312, 42);
            pt_image_jogo.Name = "pt_image_jogo";
            pt_image_jogo.Size = new Size(189, 177);
            pt_image_jogo.TabIndex = 6;
            pt_image_jogo.TabStop = false;
            pt_image_jogo.Click += pt_image_jogo_Click;
            // 
            // lb_resposta
            // 
            lb_resposta.AutoSize = true;
            lb_resposta.BackColor = Color.FromArgb(168, 3, 12);
            lb_resposta.FlatStyle = FlatStyle.Flat;
            lb_resposta.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            lb_resposta.ForeColor = Color.FromArgb(234, 234, 234);
            lb_resposta.Location = new Point(369, 235);
            lb_resposta.Name = "lb_resposta";
            lb_resposta.Size = new Size(76, 19);
            lb_resposta.TabIndex = 7;
            lb_resposta.Text = "Resposta";
            lb_resposta.TextAlign = ContentAlignment.MiddleCenter;
            lb_resposta.Click += lb_resposta_Click;
            // 
            // btn_nova
            // 
            btn_nova.BackColor = Color.FromArgb(168, 3, 12);
            btn_nova.FlatStyle = FlatStyle.Flat;
            btn_nova.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            btn_nova.ForeColor = Color.FromArgb(234, 234, 234);
            btn_nova.Location = new Point(346, 283);
            btn_nova.Name = "btn_nova";
            btn_nova.Size = new Size(120, 49);
            btn_nova.TabIndex = 8;
            btn_nova.Text = "Sortear Novamente";
            btn_nova.UseVisualStyleBackColor = false;
            btn_nova.Click += btn_nova_Click;
            // 
            // grp_resultado
            // 
            grp_resultado.Controls.Add(pt_image_jogo);
            grp_resultado.Controls.Add(btn_nova);
            grp_resultado.Controls.Add(lb_resposta);
            grp_resultado.Location = new Point(0, 0);
            grp_resultado.Name = "grp_resultado";
            grp_resultado.Size = new Size(823, 671);
            grp_resultado.TabIndex = 9;
            grp_resultado.TabStop = false;
            grp_resultado.Text = "groupBox1";
            grp_resultado.Visible = false;
            // 
            // Sorteador
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            ClientSize = new Size(824, 669);
            Controls.Add(grp_resultado);
            Controls.Add(btn_sortear);
            Controls.Add(btn_loja);
            Controls.Add(btn_bibl);
            Controls.Add(txt_user);
            Controls.Add(lb_titulo);
            Controls.Add(pictureBox1);
            Name = "Sorteador";
            Text = "Sorteador";
            Load += Sorteador_Load;
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ((System.ComponentModel.ISupportInitialize)pt_image_jogo).EndInit();
            grp_resultado.ResumeLayout(false);
            grp_resultado.PerformLayout();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private PictureBox pictureBox1;
        private Label lb_titulo;
        private TextBox txt_user;
        private Button btn_bibl;
        private Button btn_loja;
        private Button btn_sortear;
        private PictureBox pt_image_jogo;
        private Label lb_resposta;
        private Button btn_nova;
        private GroupBox grp_resultado;
    }
}