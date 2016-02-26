<?php
	$id = "";
	$page = 0;
	$host = "127.0.0.1";
	$error = false;
	$error_count = 0;
	$page_limit = 0;
	$show_limit = 3;
	$cnt = 0;
	if(empty($_GET['id'])!=true && empty($_GET['page'])!=true)
	{
		$id = $_GET['id'];
		$page = $_GET['page'];
	
		$db = mysqli_connect($host,"stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{		
			$error = true;
			$error_count = 1;
		}
		mysqli_query($db,"set session character_set_connection = utf8;");
		mysqli_query($db,"set session character_set_results=utf8;");
		mysqli_query($db,"set session character_set_client=utf8;");

		$query = "select id,e_mail,permission from guest order by permission desc;";
	
		$result = mysqli_query($db,$query);
		
		$page_limit = mysqli_num_rows($result);
		//$page_limit = floor($page_limit / $show_limit);
		if($page_limit % $show_limit != 0)
		{
			$page_limit += $show_limit;
		}
		$page_limit = floor($page_limit/$show_limit);

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
                <h1 class="start">회원 관리</h1>
                <left>
                    <a class="metro-button " onclick="window.external.admin()">돌아가기</a><br><br>
<!--                    <form class="metro-form" action="search.php" method="get">
                        <input type="text" name="target_id" class="metro-text-box" style="color:#000000;" pattern="[a-zA-Z]{4,10}"/>
                        <input type="submit" value="검색" class="metro-button"/>
                    </form>-->
                </left>
                <ul class="metro-replies">';
		$cnt = 0;
		while(($row = mysqli_fetch_array($result,MYSQLI_NUM)) != NULL)
		{
			$cnt += 1;
			if(floor(($cnt - 1)/$show_limit)+1 == $page)
			{
				echo '
                    <li class="metro-reply bg-color-orange" onclick="location.href=\'set.php?admin='.$id.'&guest='.$row[0].'\'">
                        <div class="avatar"><img src="http://stories2.iptime.org/sub_menu/profile/get_my_pic.php?id='.$row[0].'" /></div>
                        <div class="reply">
                            <div class="date">LV.'.$row[2].'</div>
                            <div class="author">'.$row[0].'</div>
                            <div class="text">'.$row[1].'</div><br>
                        </div>
                    </li>';
			}
			else if(floor(($cnt-1)/$show_limit)+1 > $page)
			{
				break;	
			}
		}
		echo '
                </ul>
            </div>
            
        </div>
        

        <footer class="footer">

                <left>
		';
		if($page<=1)
		{
			echo'
                    <a class="metro-button disabled"  onclick="">앞으로가기</a>';
		}
		else
		{
			echo '<a class="metro-button " onclick="">앞으로가기</a>';
		}

		echo $page.' / '.$page_limit;

		if($page>=$page_limit)
		{
			echo '<a class="metro-button disabled" onclick="" >뒤로 가기</a>';
		}
		else
		{
			echo '<a class="metro-button " onclick="">뒤로가기</a>';
		}
		echo '
                </left>
        </footer>
    </div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>
</body>
</html>';
		mysqli_close();
	}
	else
	{
		echo 'Wrong Connection';
	}
?>
