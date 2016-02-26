<?php
	$host = "127.0.0.1";
	$id="";
	$error = false;
	$error_code = 0;
	if(empty($_GET['id'])!=true)
	{
//		Header("Content-type: image/bmp");

		$pic = "#";
		$id = $_GET['id'];
		$db = mysqli_connect($host,"stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{
			$error = true;
			$error_code = 1;
		}
		mysqli_query($db,"set session character_set_connection=utf8;");
		mysqli_query($db,"set session character_set_results=utf8;");
		mysqli_query($db,"set session character_set_client=utf8;");
		
		$query = "select e_mail from guest where id = '".$id."';";
		mysqli_query($db,$query);
		
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array($result,MYSQLI_NUM);
		
		//$pic = addslashes($row[0]);
		//Header("Content-type:image/jpeg");
		//echo  $pic;
		mysqli_close();
//		Header("Content-type:image/jpeg");
		echo '
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Author Card - CodePen</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

    <script src="js/modernizr.js"></script>

</head>

<body>

  <!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Author Card</title>
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
	<script src="https://raw.github.com/aFarkas/html5shiv/master/src/html5shiv.js"></script>	
</head>
<body>
	<div id="bg"></div>
		<div class="card">
			<div class="profile">
			<img src="get_my_pic.php?id='.$id.'">
			
				
				<div class="border"></div>
			</div>
			<div class="name"><p>'.$id.'</p></div>
			<div class="numbers">
			<table id="stats">
				<tbody>
				<tr>
					<td>'.$row[0].'</td>
				</tr>
				</tbody>
			</table>
<!--			<div class="divider"></div>
			</div>-->
		</div>

	<div id="credits">
	<p>
		
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</p>
	</div>
</body>
</html>

  <script src="http://codepen.io/assets/libs/fullpage/jquery.js"></script>

</body>

</html>';
	}
	else
	{
		echo'Wrong Connection';
	}
?>
