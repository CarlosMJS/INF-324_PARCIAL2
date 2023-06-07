﻿using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Imaging;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace conexion
{
    public partial class Form1 : Form
    {
        private MySqlConnection cnx = null;
        MySqlCommand cmd = null;
        DataTable dt = null;
        Conexion C = null;        
        int RR, GG, BB;
        int mmR, mmG, mmB;
        int r2, g2, b2;
        public Form1()
        {
            InitializeComponent();           
            C = new Conexion();
            cnx = C.Cnx();
            Listar();
        }      
        private void btnAbrir_Click(object sender, EventArgs e)
        {
            openFileDialog1.Filter = "Todos|*.*|Archivos JPEG|*.jpg|Archivos GIF|*.gif";
            openFileDialog1.FileName = "";
            openFileDialog1.ShowDialog();
            Bitmap bmp = new Bitmap(openFileDialog1.FileName);
            pictureBox1.Image = bmp;
        }
        private void btnGuardar_Click(object sender, EventArgs e)
        {
            if (txtNombre.Text != "")
            {
                Guardar(txtNombre.Text, int.Parse(txtR.Text), int.Parse(txtG.Text), int.Parse(txtB.Text), r2, g2, b2);
                Listar();
            }
        }
        private void btnColor_Click(object sender, EventArgs e)
        {
            r2 = Int32.Parse(textBox3.Text);
            g2 = Int32.Parse(textBox2.Text);
            b2 = Int32.Parse(textBox1.Text);
        }
        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            int x, y, mR = 0, mG = 0, mB = 0;
            x = e.X; 
            y = e.Y;
            for (int i = x; i < x + 10; i++)
                for (int j = y; j < y + 10; j++)
                {
                    c = bmp.GetPixel(i, j);
                    mR = mR + c.R;
                    mG = mG + c.G;
                    mB = mB + c.B;
                }
            mR = mR / 100;
            mG = mG / 100;
            mB = mB / 100;            
            txtR.Text = mR.ToString();
            txtG.Text = mG.ToString();
            txtB.Text = mB.ToString();            
        }
        public void Guardar(string nomb, int r1, int g1, int b1, int r2, int g2, int b2)
        {
            try
            {
                cmd = new MySqlCommand();
                cmd.Connection = cnx;
                cmd.CommandText = "INSERT INTO datos(Nombre,R1,G1,B1,R2,G2,B2 )  VALUES(@nomb,@r1,@g1,@b1,@r2,@g2,@b2 )";
                cmd.Parameters.Add(new MySqlParameter("@nomb", nomb));
                cmd.Parameters.Add(new MySqlParameter("@r1", r1));
                cmd.Parameters.Add(new MySqlParameter("@g1", g1));
                cmd.Parameters.Add(new MySqlParameter("@b1", b1));
                cmd.Parameters.Add(new MySqlParameter("@r2", r2));
                cmd.Parameters.Add(new MySqlParameter("@g2", g2));
                cmd.Parameters.Add(new MySqlParameter("@b2", b2));
                cnx.Open();
                MySqlDataReader lector = cmd.ExecuteReader();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            finally
            { cnx.Close(); }
        }
        //----------GUARDADO DE ALMENOS 3 TEXTURAS------------------
        /*
        public void Guardar(string nomb, int r1, int g1, int b1, int r2, int g2, int b2)
        {
            try
            {
                int nombresGuardados = ObtenerCantidadNombresGuardados();
                if (nombresGuardados >= 3)
                {
                    MessageBox.Show("Se permiten guardar solamente 3 colores.");
                    return;
                }

                cmd = new MySqlCommand();
                cmd.Connection = cnx;
                cmd.CommandText = "INSERT INTO datos(Nombre,R1,G1,B1,R2,G2,B2 )  VALUES(@nomb,@r1,@g1,@b1,@r2,@g2,@b2 )";
                cmd.Parameters.Add(new MySqlParameter("@nomb", nomb));
                cmd.Parameters.Add(new MySqlParameter("@r1", r1));
                cmd.Parameters.Add(new MySqlParameter("@g1", g1));
                cmd.Parameters.Add(new MySqlParameter("@b1", b1));
                cmd.Parameters.Add(new MySqlParameter("@r2", r2));
                cmd.Parameters.Add(new MySqlParameter("@g2", g2));
                cmd.Parameters.Add(new MySqlParameter("@b2", b2));
                cnx.Open();
                MySqlDataReader lector = cmd.ExecuteReader();
                MessageBox.Show("Datos guardados");
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            finally
            {
                cnx.Close();
            }
        }
        private int ObtenerCantidadNombresGuardados()
        {
            int cantidad = 0;
            try
            {
                cmd = new MySqlCommand();
                cmd.Connection = cnx;
                cmd.CommandText = "SELECT COUNT(*) FROM datos";
                cnx.Open();
                cantidad = Convert.ToInt32(cmd.ExecuteScalar());
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            finally
            {
                cnx.Close();
            }
            return cantidad;
        }
        */
        private void Listar()
        {
            dt = new DataTable();
            MySqlCommand cmd = new MySqlCommand();
            cmd.Connection = cnx;
            cmd.CommandText = "SELECT Nombre,R1 AS 'R select', G1 AS 'G select', B1 AS 'B select', R2 AS 'textura R', G2 AS 'textura G', B2 AS 'textura B' FROM datos ORDER BY Id DESC;"; ;
            MySqlDataAdapter da = new MySqlDataAdapter(cmd);
            da.Fill(dt);
            dataGridView1.DataSource = dt;
        }
        private void btnColorear_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 0; i < bmp.Width - 10; i += 10)
                for (int j = 0; j < bmp.Height - 10; j += 10)
                {
                    mmR = 0;
                    mmG = 0;
                    mmB = 0;

                    for (int i2 = i; i2 < i + 10; i2++)
                        for (int j2 = j; j2 < j + 10; j2++)
                        {
                            c = bmp.GetPixel(i2, j2);
                            mmR = mmR + c.R;
                            mmG = mmG + c.G;
                            mmB = mmB + c.B;
                        }
                    mmR = mmR / 100;
                    mmG = mmG / 100;
                    mmB = mmB / 100;
                    bool sw = false;
                    for (int k = 0; k < dt.Rows.Count; k++)
                    {
                        RR = int.Parse(dt.Rows[k][1].ToString());
                        GG = int.Parse(dt.Rows[k][2].ToString());
                        BB = int.Parse(dt.Rows[k][3].ToString());
                        int RBD = int.Parse(dt.Rows[k][4].ToString());
                        int GBD = int.Parse(dt.Rows[k][5].ToString());
                        int BBD = int.Parse(dt.Rows[k][6].ToString());
                        if (((RR - 10) < mmR) && (mmR < (RR + 10)) &&
                            ((GG - 10) < mmG) && (mmG < (GG + 10)) &&
                            ((BB - 10) < mmB) && (mmB < (BB + 10)))
                        {
                            for (int i2 = i; i2 < i + 10; i2++)
                                for (int j2 = j; j2 < j + 10; j2++)
                                {
                                    bmp2.SetPixel(i2, j2, Color.FromArgb(RBD, GBD, BBD));
                                    sw = true;
                                }
                        }
                    }
                    if (!sw)
                    {
                        for (int i2 = i; i2 < i + 10; i2++)
                            for (int j2 = j; j2 < j + 10; j2++)
                            {
                                c = bmp.GetPixel(i2, j2);
                                bmp2.SetPixel(i2, j2, c);
                            }
                    }
                }
            pictureBox2.Image = bmp2;
        }              
        
    }   
}
