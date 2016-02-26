namespace project_db2
{
    partial class map_view
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
            this.web_google = new System.Windows.Forms.WebBrowser();
            this.SuspendLayout();
            // 
            // web_google
            // 
            this.web_google.Dock = System.Windows.Forms.DockStyle.Fill;
            this.web_google.Location = new System.Drawing.Point(0, 0);
            this.web_google.MinimumSize = new System.Drawing.Size(20, 20);
            this.web_google.Name = "web_google";
            this.web_google.ScriptErrorsSuppressed = true;
            this.web_google.ScrollBarsEnabled = false;
            this.web_google.Size = new System.Drawing.Size(384, 581);
            this.web_google.TabIndex = 0;
            this.web_google.Url = new System.Uri("http://stories2.iptime.org/googlemap2.html", System.UriKind.Absolute);
            // 
            // map_view
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(7F, 12F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(384, 581);
            this.Controls.Add(this.web_google);
            this.MaximizeBox = false;
            this.MaximumSize = new System.Drawing.Size(400, 620);
            this.MinimizeBox = false;
            this.MinimumSize = new System.Drawing.Size(400, 620);
            this.Name = "map_view";
            this.ShowInTaskbar = false;
            this.Text = "map_view";
            this.TopMost = true;
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.map_view_FormClosing);
            this.Load += new System.EventHandler(this.map_view_Load);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.WebBrowser web_google;
    }
}