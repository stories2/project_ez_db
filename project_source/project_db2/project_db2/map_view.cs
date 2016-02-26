using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace project_db2
{
    public partial class map_view : Form
    {

        public map_view()
        {
            InitializeComponent();
        }

        private void map_view_Load(object sender, EventArgs e)
        {
        }

        public void set_location(String x, String y)
        {
            String url = "http://stories2.iptime.org/googlemap2.php?x=" + x + "&y=" + y;
           // MessageBox.Show(url);
            web_google.Navigate(url);
        }

        private void map_view_FormClosing(object sender, FormClosingEventArgs e)
        {
            e.Cancel = true;
        }
    }
}
