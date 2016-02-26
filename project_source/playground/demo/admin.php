<?php
	$id = "";
	if(empty($_GET['id'])!=true)
	{
		$id = $_GET['id'];
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
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/google-analytics.js"></script>

    <style type="text/css">
        body {
            background: #E4902F;
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
                <h1 class="start">관리자 컨트롤</h1>
                <left>
                    <a class="metro-button " onclick="window.external.home_screen()">홈</a>
                </left><br><br>

                <a class="metro-command-button" href="guest_control.php?id='.$id.'&page=1">
                    <span class="title">회원관리</span>
                    <span class="subtitle">회원 정지 , 권한 상승 , 리스트</span>
                </a>
                <a class="metro-command-button" href="total.php?id='.$id.'">
                    <span class="title">통계</span>
                    <span class="subtitle">서버에 저장된 데이터를 이용합니다</span>
                </a>
                <a class="metro-command-button" href="email.php?id='.$id.'">
                    <span class="title">공지 메일 보내기</span>
                    <span class="subtitle">모든 회원에게 메일을 보냅니다</span>
                </a>
            </div>
            
        </div>
        

        <footer class="footer">

               <!-- <left>
                    <a class="metro-button disabled"  onclick="">뒤로가기</a>1/1<a class="metro-button disabled" onclick="" >앞으로 가기</a>
                </left>-->
        </footer>
    </div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>
</body>
</html>';
	}
	else
	{
		echo 'Wrong Connection';
	}
?>
