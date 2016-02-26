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
            background: #e4902f;
        }
        .metro {
            width: 940px;
            overflow: hidden;
        }
        .start {
        }
    </style>

</head>
<body>
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
                <a class="brand">'.$id.'님 환영합니다</a>
            </div>
        </div>
    </div>

    <div class="container metro"><br>
        <h1 class="start">메일 보내기</h1>
       	<a class="metro-button" href="admin.php?id='.$id.'">돌아가기</a> 
        <form class="metro-form" style="margin-top: 20px;" action="send_mail.php" method="get">
            <div class="metro-form-control" >
		보내는 사람
		<input type="text" hidden name="id" value="'.$id.'" style="color:#000000;"/>
                <label>본문</label>
                <div class="metro-text-box">
                    <span class="helper"></span>
                </div>
                <textarea name="body" cols="200" rows="5" style="color:#000000;width:400px"></textarea>
            </div>
		
            <input type="submit" class="metro-button" value="전송" />
	
        </form>

        <footer class="footer">
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
