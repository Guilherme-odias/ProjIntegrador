namespace Projeto_integrador
{
    partial class ListaJogos
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(ListaJogos));
            label1 = new Label();
            cb1 = new ComboBox();
            label2 = new Label();
            label3 = new Label();
            tb1 = new TextBox();
            dgv = new DataGridView();
            b1 = new Button();
            pictureBox1 = new PictureBox();
            pictureBox2 = new PictureBox();
            pictureBox3 = new PictureBox();
            ((System.ComponentModel.ISupportInitialize)dgv).BeginInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).BeginInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox2).BeginInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox3).BeginInit();
            SuspendLayout();
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("SansSerif", 26.25F, FontStyle.Bold, GraphicsUnit.Point, 2);
            label1.ForeColor = Color.FromArgb(234, 234, 234);
            label1.Location = new Point(301, 32);
            label1.Name = "label1";
            label1.Size = new Size(273, 41);
            label1.TabIndex = 0;
            label1.Text = "Buscar jogos!!!";
            // 
            // cb1
            // 
            cb1.DropDownStyle = ComboBoxStyle.DropDownList;
            cb1.FormattingEnabled = true;
            cb1.Items.AddRange(new object[] { "Titulo", "Desenvolvedora", "Distribuidora", "Informacoes" });
            cb1.Location = new Point(32, 147);
            cb1.Name = "cb1";
            cb1.Size = new Size(149, 23);
            cb1.TabIndex = 1;
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Century Gothic", 15.75F);
            label2.ForeColor = Color.FromArgb(234, 234, 234);
            label2.Location = new Point(32, 106);
            label2.Name = "label2";
            label2.Size = new Size(149, 24);
            label2.TabIndex = 2;
            label2.Text = "Buscar o que:";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Century Gothic", 15.75F);
            label3.ForeColor = Color.FromArgb(234, 234, 234);
            label3.Location = new Point(206, 106);
            label3.Name = "label3";
            label3.Size = new Size(72, 24);
            label3.TabIndex = 3;
            label3.Text = "Digite:";
            label3.Click += label3_Click;
            // 
            // tb1
            // 
            tb1.Location = new Point(206, 147);
            tb1.Name = "tb1";
            tb1.Size = new Size(324, 23);
            tb1.TabIndex = 4;
            // 
            // dgv
            // 
            dgv.AllowUserToOrderColumns = true;
            dgv.BackgroundColor = Color.FromArgb(234, 234, 234);
            dgv.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            dgv.Location = new Point(32, 191);
            dgv.Name = "dgv";
            dgv.Size = new Size(612, 298);
            dgv.TabIndex = 5;
            dgv.CellClick += dgv_CellClick;
            dgv.CellContentClick += dataGridView1_CellContentClick;
            // 
            // b1
            // 
            b1.BackColor = Color.FromArgb(168, 3, 12);
            b1.Font = new Font("Century Gothic", 12F, FontStyle.Bold, GraphicsUnit.Point, 0);
            b1.ForeColor = Color.FromArgb(234, 234, 234);
            b1.Location = new Point(554, 147);
            b1.Name = "b1";
            b1.Size = new Size(90, 27);
            b1.TabIndex = 6;
            b1.Text = "Buscar";
            b1.UseVisualStyleBackColor = false;
            b1.Click += b1_Click;
            // 
            // pictureBox1
            // 
            pictureBox1.Location = new Point(703, 61);
            pictureBox1.Name = "pictureBox1";
            pictureBox1.Size = new Size(200, 133);
            pictureBox1.TabIndex = 7;
            pictureBox1.TabStop = false;
            // 
            // pictureBox2
            // 
            pictureBox2.Location = new Point(665, 213);
            pictureBox2.Name = "pictureBox2";
            pictureBox2.Size = new Size(200, 133);
            pictureBox2.TabIndex = 8;
            pictureBox2.TabStop = false;
            // 
            // pictureBox3
            // 
            pictureBox3.Location = new Point(703, 367);
            pictureBox3.Name = "pictureBox3";
            pictureBox3.Size = new Size(200, 133);
            pictureBox3.TabIndex = 9;
            pictureBox3.TabStop = false;
            // 
            // ListaJogos
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            BackColor = Color.FromArgb(10, 15, 28);
            ClientSize = new Size(924, 538);
            Controls.Add(pictureBox3);
            Controls.Add(pictureBox2);
            Controls.Add(pictureBox1);
            Controls.Add(b1);
            Controls.Add(dgv);
            Controls.Add(tb1);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(cb1);
            Controls.Add(label1);
            Icon = (Icon)resources.GetObject("$this.Icon");
            Name = "ListaJogos";
            Text = "ListaJogos";
            Load += ListaJogos_Load;
            ((System.ComponentModel.ISupportInitialize)dgv).EndInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox1).EndInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox2).EndInit();
            ((System.ComponentModel.ISupportInitialize)pictureBox3).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Label label1;
        private ComboBox cb1;
        private Label label2;
        private Label label3;
        private TextBox tb1;
        private DataGridView dgv;
        private Button b1;
        private PictureBox pictureBox1;
        private PictureBox pictureBox2;
        private PictureBox pictureBox3;
    }
}