<?php
	$id = "";
	$error = false;
	$error_code = 0;
	$permission = 0;
	if(empty($_GET['id'])!=true)
	{
		$id = $_GET['id'];
		$db =mysqli_connect("127.0.0.1","stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{
			$error = true;		
			$error_code = 1;
		}
		mysqli_query($db,"set session character_set_connection = utf8;");
		mysqli_query($db,"set session character_set_result=ut8;");
		mysqli_query($db,"set session character_set_client=utf8;");

		$query = "select permission from guest where id ='".$id."';";
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array($result,MYSQLI_NUM);
		$permission = $row[0];
		mysqli_close($db);
    echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />

    <meta name="description" content="Metro UI CSS - это набор стилей для создания сайтов с интерфейсом, похожим на Windows 8 Metro UI. Набор стилей разрабатывается как дополнение к любому другому CSS фрейм ворку, например можно использовать в качестве основного twitter bootstrap, а Metro UI CSS как дополнение для посторения частей интерфейса" />
    <meta data-annotation="Metro UI CSS - это набор стилей для создания сайтов с интерфейсом, похожим на Windows 8 Metro UI. Набор стилей разрабатывается как дополнение к любому другому CSS фрейм ворку, например можно использовать в качестве основного twitter bootstrap, а Metro UI CSS как дополнение для посторения частей интерфейса" />
    <meta name="author" content="Сергей Пименов (ака olton)" />
    <meta name="copyright" content="2012, Сергей Пименов" />
    <meta name="license" content="Licensed under MIT License" />

    <title>Metro UI CSS Framework Demo</title>

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/prettify.css">
    <link rel="stylesheet" type="text/css" href="css/metro.css">
    <link rel="stylesheet" type="text/css" href="css/site.css">

    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.transit.js"></script>
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/prettify.js"></script>
    <script type="text/javascript" src="js/metro.js"></script>
    <script type="text/javascript" src="js/site.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/google-analytics.js"></script>

    <style type="text/css">
        body {
            background: transparent url(img/bgmetro1.png);
        }
        .metro {
            width: 500px;
            overflow: hidden;
        }
        .metro-section {
            width: 500px !important;
        }
        #section1 {
        }
        #section2 {

        }
        #section3 {
            width: 320px !important;
        }
        .metro-sections {
            width: 500px !important;
        }
        .start {
            position: absolute;
            top: 60px;
        }
        #demo {
        }
    </style>

</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="pull-left" style="margin-top: 7px; margin-right: 5px;" href="/">
                    <!--<img src="img/avatar474_2.gif" style="max-height: 16px;"/>-->
                </a>
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" >'.$id.'님 환영합니다</a>
                
            </div>
        </div>
    </div>

    <div class="container" id="demo">
        <div  class="metro">
            <div class="metro-sections">
                <div class="metro-section" id="section1">

                    <a data-next="#section2" data-prior="#section1" href="#" class="next-section"></a>

                    <div class="tile tile-double tile-double-vertical bg-color-darken">
                        <div class="tile-icon-large">
                            <img src="img/Google%20Maps.png" />
                        </div>
                        <span class="tile-label" OnClick="window.external.map()">위치 서비스</span>
                    </div>
                    <div class="tile bg-color-pink">
                        <div class="tile-icon-large">
                            <img src="img/Power - Log Off.png" />
                        </div>
                        <span class="tile-label" OnClick="location.href=\'http://stories2.iptime.org/playground/logout.php?id='.$id.'\'">로그아웃</span>
                    </div>
		';
		if($permission == 5)
		{
		echo '
                    <div class="tile bg-color-orange">
                        <div class="tile-icon-large">
                            <img src="img/Security Approved.png" />
                        </div>
                        <span class="tile-label" OnClick="window.external.admin()">관리자 컨트롤</span>
                    </div>';
		}
                echo '

                </div>
                <div class="metro-section" id="section2">

                    <a data-next="#section3" data-prior="#section2" href="#" class="next-section"></a>

                    <div class="tile tile-triple bg-color-purple">
                        <div class="tile-icon-large">
                            <img src="img/Personal.png" />
                        </div>
                        <span class="tile-label" OnClick="window.external.people()">사람과 거리</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            window.prettyPrint && prettyPrint();
        })

        $(".metro").metro();

    </script>
</body>
</html>';
	}
?>
