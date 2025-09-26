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
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            SuspendLayout();
            // 
            // pictureBox1
            // 
            pictureBox1.Image = Properties.Resources.controle_ps1;
            pictureBox1.Location = new Point(314, 33);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(166, 99);
            pictureBox1.SizeMode = PictureBoxSizeMode.StretchImage;
            pictureBox1.TabIndex = 0;
            pictureBox1.TabStop = false;
            // 
            // lb_titulo
            // 
            lb_titulo.AutoSize = true;
            lb_titulo.Location = new Point(218, 146);
            lb_titulo.Name = "lb_titulo";
            lb_titulo.Size = new Size(396, 15);
            lb_titulo.TabIndex = 1;
            lb_titulo.Text = "Escolha um Jogo Aleatório da sua Biblioteca Quimera, ou da  Própria Loja ";
            // 
            // Sorteador
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = SystemColors.ActiveCaption;
            ClientSize = new Size(800, 450);
            Controls.Add(lb_titulo);
            Controls.Add(pictureBox1);
            Name = "Sorteador";
            Text = "Sorteador";
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private PictureBox pictureBox1;
        private Label lb_titulo;
    }
}