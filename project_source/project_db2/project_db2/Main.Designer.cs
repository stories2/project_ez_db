namespace project_db2
{
    partial class Main
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
            this.split_main = new System.Windows.Forms.SplitContainer();
            this.web_menu = new System.Windows.Forms.WebBrowser();
            this.web_view = new System.Windows.Forms.WebBrowser();
            ((System.ComponentModel.ISupportInitialize)(this.split_main)).BeginInit();
            this.split_main.Panel1.SuspendLayout();
            this.split_main.Panel2.SuspendLayout();
            this.split_main.SuspendLayout();
            this.SuspendLayout();
            // 
            // split_main
            // 
            this.split_main.Dock = System.Windows.Forms.DockStyle.Fill;
            this.split_main.FixedPanel = System.Windows.Forms.FixedPanel.Panel2;
            this.split_main.IsSplitterFixed = true;
            this.split_main.Location = new System.Drawing.Point(0, 0);
            this.split_main.Name = "split_main";
            // 
            // split_main.Panel1
            // 
            this.split_main.Panel1.Controls.Add(this.web_menu);
            // 
            // split_main.Panel2
            // 
            this.split_main.Panel2.Controls.Add(this.web_view);
            this.split_main.Size = new System.Drawing.Size(724, 581);
            this.split_main.SplitterDistance = 220;
            this.split_main.TabIndex = 0;
            // 
            // web_menu
            // 
            this.web_menu.Dock = System.Windows.Forms.DockStyle.Fill;
            this.web_menu.Location = new System.Drawing.Point(0, 0);
            this.web_menu.MinimumSize = new System.Drawing.Size(20, 20);
            this.web_menu.Name = "web_menu";
            this.web_menu.ScriptErrorsSuppressed = true;
            this.web_menu.ScrollBarsEnabled = false;
            this.web_menu.Size = new System.Drawing.Size(220, 581);
            this.web_menu.TabIndex = 0;
            // 
            // web_view
            // 
            this.web_view.Dock = System.Windows.Forms.DockStyle.Fill;
            this.web_view.Location = new System.Drawing.Point(0, 0);
            this.web_view.MinimumSize = new System.Drawing.Size(20, 20);
            this.web_view.Name = "web_view";
            this.web_view.ScriptErrorsSuppressed = true;
            this.web_view.ScrollBarsEnabled = false;
            this.web_view.Size = new System.Drawing.Size(500, 581);
            this.web_view.TabIndex = 0;
            this.web_view.DocumentCompleted += new System.Windows.Forms.WebBrowserDocumentCompletedEventHandler(this.web_view_DocumentCompleted);
            // 
            // Main
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(7F, 12F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(724, 581);
            this.Controls.Add(this.split_main);
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(740, 620);
            this.MinimumSize = new System.Drawing.Size(740, 620);
            this.Name = "Main";
            this.Text = "환영합니다";
            this.MinimumSizeChanged += new System.EventHandler(this.Main_MinimumSizeChanged);
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Main_FormClosing);
            this.Load += new System.EventHandler(this.Main_Load);
            this.SizeChanged += new System.EventHandler(this.Main_SizeChanged);
            this.split_main.Panel1.ResumeLayout(false);
            this.split_main.Panel2.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.split_main)).EndInit();
            this.split_main.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.SplitContainer split_main;
        private System.Windows.Forms.WebBrowser web_view;
        private System.Windows.Forms.WebBrowser web_menu;


    }
}