<?php
	if(empty($_GET['id'])!=true)
	{
		$id = $_GET['id'];
		$db = mysqli_connect("127.0.0.1","stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{
			$error = true;
			$error_code = 1;
		}
		mysqli_query($db,"set session character_set_connection=utf8;");
		mysqli_query($db,"set session character_set_results=utf8;");
		mysqli_query($db,"set session character_set_client=utf8;");
		
		$query = "select * from client;";

		$result = mysqli_query($db,$query);

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
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/prettify.js"></script>
    <script type="text/javascript" src="js/metro.js"></script>
    <script type="text/javascript" src="js/site.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://    html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/google-analytics.js"></script>

    <style type="text/css">
        body {
            background: #e4902f;
        }
        .metro {
            width: 940px;
            overflow: hidden;
        }
        .start {
        }
        .demo-scene {
            width: 320px;
            margin-right: 50px;
            float: left;
        }
    </style>

</head>
<body top="0" left="0">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="pull-left" style="margin-top: 7px; margin-right: 5px;" href="/">
                    
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

    <div class="container metro">
        <div class="row">
            <div class="span6"><br>
                <h1 class="start">통계</h1>
                <left>
                    <a class="metro-button " onclick="window.external.admin()">돌아가기</a>
                </left><br><br>
                <fieldset>
                    <legend>서비스 이용 현황</legend>';
		$count = 0;
		$sum = 0;
		$sum2 = 0;
		while(($row = mysqli_fetch_array($result,MYSQLI_NUM)) != NULL)
		{
			$sum = $sum + $row[2];
			$sum2 = $sum2 + $row[3];
			$count += 1;
		}
		
		mysqli_close();
		echo '위치 서비스 평균 이용 평균 횟수 '.($sum/$count).'회<br>
		사람과 거리 평균 이용 횟수 '.($sum2/$count).'회
                </fieldset>
            </div>
        </div>
        
    </div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>
</body>
</html>';
	}
?>
