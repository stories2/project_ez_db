using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using MetroFramework.Forms;
using System.Windows.Forms;
using System.Security.Permissions;
using System.Runtime.InteropServices;
using System.Threading;
using System.Data.SQLite;
using MySql.Data.MySqlClient;

namespace project_db2
{

    [System.Security.Permissions.PermissionSet(System.Security.Permissions.SecurityAction.Demand, Name = "FullTrust")]
    [System.Runtime.InteropServices.ComVisibleAttribute(true)]
    /*
     * 웹의 javascript 가 c#의 함수를 호출하기 위한 보안 옵션
     */
    public partial class Main : Form
    {
        String[] user_info = new String[20];
        /*
         * 0 : 비어있음
         * 1 : 손님 번호
         * 2 : 아이디 
         * 3 : 비밀번호
         * 4 : 이메일 주소
         * 5 : 프로필 이미지 경로
         * 6 : 이미지 작업 여부
         * 7 : 접속 아이피 주소/
         */
        int page = 1,useage_map = 0 , useage_people = 0 ;
        //몇번째 웹 페이지를 보여 줄지 , 위치 서비스를 몇번 이용했는지 , 사람과 거리 서비스를 몇번 이용했는지
        map_view google_map;
        //구글 맵을 보여주는 클래스
        bool is_show,running,google_map_show;
        //구글맵이 지금 보여지는 중인지 , 쓰레드 컨트롤 , 구글 맵을 보여줄지 안보여줄지 
        Thread main_thread;
        //쓰레드
        SQLiteConnection connection;
        //클라이언트 db
        String connection_str,login_time,logout_time;
        //접속 명령 , 로그인 시간 , 로그아웃 시간
        DateTime date;
        //시간 객체

        public Main()
        {
            InitializeComponent();
        }

        public void show_login_page()//로그인 페이지 보여주기
        {
            web_view.Navigate("http://stories2.iptime.org/playground/demo/login.html");
        }

        public void show_sign_up_page()//계정 생성 페이지 보여주기
        {
            web_view.Navigate("http://stories2.iptime.org/playground/demo/new_bee.html");
        }

        public void map()//위치 서비스 페이지 보여주기
        {
            useage_map += 1;//위치 서비스 이용 횟수 증가
            is_show = true;//
            page = 1;//페이지 초기화
            google_map.Show();//map_view 클래스 보이기
            google_map_show = true;//구글 맵을 보여줄수 있도록 허용
            web_view.Navigate("http://stories2.iptime.org/playground/demo/map_list.php?id="+user_info[2]+"&page="+page);
        }

        public void map_next_page()
        {
            page += 1;//페이지 증가
            web_view.Navigate("http://stories2.iptime.org/playground/demo/map_list.php?id=" + user_info[2] + "&page=" + page);//해당 페이지를 보여줌
        }

        public void map_prev_page()
        {
            if (page > 1)
            {
                page -= 1;//페이지 감소 0번째 페이지는 없음
            }
            web_view.Navigate("http://stories2.iptime.org/playground/demo/map_list.php?id=" + user_info[2] + "&page=" + page);//해당 페이지를 보여줌
        }

        public void people_next_page()
        {
            page += 1;//페이지 증가
            web_view.Navigate("http://stories2.iptime.org/playground/demo/people.php?id=" + user_info[2] + "&page=" + page);//해당 페이지를 보여줌
        }

        public void people_prev_page()
        {
            if (page > 1)
            {
                page -= 1;//페이지 감소 0번째 페이지는 없음
            }
            web_view.Navigate("http://stories2.iptime.org/playground/demo/people.php?id=" + user_info[2] + "&page=" + page);//해당 페이지를 보여줌
        }
        
        public void admin()//관리자 페이지
        {
            web_view.Navigate("http://stories2.iptime.org/playground/demo/admin.php?id=" + user_info[2]);
        }

        public void people()
        {
            useage_people += 1;//사람과 거리 페이지 사용 횟수 추가
            is_show = true;
            page = 1;//페이지 초기화
            google_map.Show();//map_view 클래스 표시
            google_map_show = true;//구글 맵 표시
            web_view.Navigate("http://stories2.iptime.org/playground/demo/people.php?id=" + user_info[2]+"&page="+page);//해당 페이지를 보여줌
        }

        public void Main_Load(object sender, EventArgs e)
        {
            date = DateTime.Today;
            this.web_view.ObjectForScripting = this;//javascript가 이 클래스를 컨트롤 할 수 있도록 해줌
            this.web_menu.ObjectForScripting = this;//javascript가 이 클래스를 컨트롤 할 수 있도록 해줌
            google_map = new map_view();//구글맵을 보여줄 객체 생성
            
            is_show = false;//초기화
            running = true;//초기화
            google_map_show = false;//초기화
            main_thread = new Thread(run);//run 함수가 쓰레드로 사용되도록 해줌
            main_thread.Start();//쓰레드 시작
            db_init();//클라이언트 데이터베이스 초기화

            web_view.Navigate("http://stories2.iptime.org/playground/demo/login.html");
            web_menu.Navigate("http://stories2.iptime.org/sub_menu/offline.html");
        }

        public void db_init()//클라이언트 데이터베이스 초기화
        {
            
            String query = "create table client (computer_id text , login_id text , useage_map int , useage_people int , login_time datetime , logout_time datetime);";
            //client이름의 테이블을 생성
            try
            {
                SQLiteConnection.CreateFile("C:/Users/" + parse_user() + "/AppData/Local/Temp/temp.db");
                //해당 유저 명의 임시 저장소에다가 데이터베이스를 생성
                connection_str = @"Data Source=C:/Users/" + parse_user() + "/AppData/Local/Temp/temp.db";
                connection = new SQLiteConnection(connection_str);//데이터베이스 연결 시작
                connection.Open();

                SQLiteCommand command = new SQLiteCommand(query, connection);//쿼리문 실행
                command.ExecuteNonQuery();
            }
            catch (Exception err)
            {
                //MessageBox.Show("" + err);
            }
        }

        public String parse_user()//컴퓨터 유저이름 파싱
        {
            bool write = false;
            String temp = System.Security.Principal.WindowsIdentity.GetCurrent().Name.Trim(),result = "";
            int i, str_length = temp.Length;
            for (i = 0; i < str_length; i += 1)
            {
                if (write == true)
                {
                    result = result + temp[i];
                }
                if (temp[i] == 92)
                {
                    write = true;
                }
            }
            return result;//결과값 반환
        }

        public void home_screen()//기본 홈 ui를 보여줌
        {
            google_map.Hide();
            google_map_show = false;//이땐 구글맵을 표시하지 않음
            web_view.Navigate("http://stories2.iptime.org/playground/demo/tiles.php?id=" + user_info[2]);
        }

        public void login(Object login_info)//로그인 성공시 해당 유저에 대한 정보를 받음
        {
            parse_user_info(login_info.ToString());//유저 정보를 분리
            this.Text = "사용자 "+user_info[2];
            web_menu.Navigate("http://stories2.iptime.org/sub_menu/profile/online.php?id="+user_info[2]);
            web_view.Navigate("http://stories2.iptime.org/playground/demo/tiles.php?id="+user_info[2]);
        }

        public void parse_user_info(String usr)//하나의 문장으로 된 유저의 정보를 분리 | 하나당 컬럼 하나
        {
            date = DateTime.Today;
            login_time = String.Format("{0:yyyy-MM-dd HH:mm:ss}", date);
            int i,t=0, str_lenght;
            String temp = "";
            str_lenght = usr.Length;
            for (i = 0; i < str_lenght; i += 1)
            {
                if (usr[i] == '|')
                {
                    user_info[t] = temp;
                    temp = "";
                    t += 1;
                }
                else
                {
                    temp = temp + usr[i];
                }
            }
        }

        public void logout()//로그아웃시 초기 페이지를 보여줌
        {
            date = DateTime.Today;
            logout_time = String.Format("{0:yyyy-MM-dd HH:mm:ss}", date);
            this.Text = "환영합니다";
            web_view.Navigate("http://stories2.iptime.org/playground/demo/login.html");
            web_menu.Navigate("http://stories2.iptime.org/sub_menu/offline.html");

            upload();
        }

        public void upload()//쌓인 정보를 클라이언트 데이터베이스에 저장
        {
            String query = "insert into client (computer_id, login_id , useage_map , useage_people , login_time , logout_time) value('" + parse_user() + "','" + user_info[2] + "'," + useage_map + "," + useage_people + ",'" + login_time + "','" + login_time + "');";
            try
            {
                

                SQLiteCommand command = new SQLiteCommand(query, connection);
                command.ExecuteNonQuery();
            }
            catch (Exception err)
            {
                //MessageBox.Show(query+" " + err);
            }


        }

        private void web_view_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {
        }

        private void Main_MinimumSizeChanged(object sender, EventArgs e)
        {
        }

        private void Main_SizeChanged(object sender, EventArgs e)//크기 변화 이벤트가 일어날때마다
        {
            if (google_map_show == true)//구글맵을 보이고 줄이고를 컨트롤함
            {
                if (is_show == false)
                {
                    google_map.Show();
                }
                else
                {
                    google_map.Hide();
                    is_show = false;
                }
            }
        }

        public void run()//map_view클래스의 위치를 자기자신 클래스의 바로 옆부분에 늘 따라다니도록 함
        {
            int padding = 10;
            while (running)
            {
                try
                {
                    google_map.Left = this.Left + this.Width + padding;
                    google_map.Top = this.Top;
                    Thread.Sleep(1);
                }
                catch (Exception err)
                {
                }
            }
        }

        public void get_location(object data)//좌표 데이터를 받으면 그 좌표를 | 기준으로 위도 경도로 나눈 후 map_view클래스에 값을 넘겨줌
        {
            int i,str_length;
            bool turn = false;
            String str_data = data.ToString(),latitude = "" ,longitude = "";
            str_length = str_data.Length;
            for (i = 0; i < str_length; i += 1)
            {
                if (str_data[i] == '|')
                {
                    turn = true;
                }
                else
                {
                    if (turn == false)
                    {
                        latitude = latitude + str_data[i];
                    }
                    else
                    {
                        longitude = longitude + str_data[i];
                    }
                }
            }
            google_map.set_location(latitude, longitude);
        }

        public void upload_server()//클라이언트 데이터베이스에 쌓인 정보를 서버에 최종적으로 업로드함
        {
            try
            {
                String strConn = "Server=121.165.187.102;Database=stories2;Uid=stories2;Pwd=toortoor%^%;";
                using (MySqlConnection myconnection = new MySqlConnection(strConn))
                {
                    
                    //MySqlCommand command = new MySqlCommand();
                    myconnection.Open();
                    MySql.Data.MySqlClient.MySqlCommand command = new MySql.Data.MySqlClient.MySqlCommand("insert into client value('" + parse_user() + "','" + user_info[2] + "'," + useage_map + "," + useage_people + ",'" + login_time + "','" + login_time + "');", myconnection);
                    command.ExecuteNonQuery();
                    myconnection.Close();
                }
            }
            catch (Exception err)
            {
                MessageBox.Show("" + err);
            }

        }

        private void Main_FormClosing(object sender, FormClosingEventArgs e)//프로그램 종료시
        {
            //google_map.set_location(0, 0);
            //map_view.running = false;
            
            date = DateTime.Today;
            //MessageBox.Show(""+date);
            logout_time = "" + DateTime.Today.Year+"-"+DateTime.Today.Month+"-"+DateTime.Today.Day+" "+DateTime.Today.Hour+":"+DateTime.Today.Minute+":"+DateTime.Today.Second;
            //MessageBox.Show(login_time);
            upload();
            upload_server();
            connection.Close();
            running = false;

        }
    }
}
