<?php
	echo '<html>
		<head>
			<meta charset="utf-8">
		</head>
		<body>';
	$id = "";
	$pw = "";
	$mail = "";
	$error = false;
	$error_code = 0;
	$server_direction = "/var/www/html/picture/";
	$hostname = "stories2.iptime.org";
	if(empty($_POST['id']) != true && empty($_POST['pw']) !=true && empty($_POST['mail']) !=true && empty($_FILES['pic'])!=true)
	{
		$id = $_POST['id'];
		$pw = $_POST['pw'];
		$mail=$_POST['mail'];
		
		$server_file = $server_direction.$_FILES['pic']['name'];
		$picture_name = $_FILES['pic']['name'];
		$file_open = fopen($_FILES['pic']['tmp_name'],'r');
		$content = fread($file_open,filesize($_FILES['pic']['tmp_name']));
		$content = addslashes($content);
		fclose($file_open);
		$file_status = move_uploaded_file($_FILES['pic']['tmp_name'],$server_file);
		
		if($file_status == true)
		{
			$db = mysqli_connect($hostname,"stories2","toortoor%^%","stories2");
			if(mysqli_connect_errno())
			{
				$error = true;
				$error_code = 3;
			}
			else
			{
				mysqli_query($db,"set session character_set_connection = utf8;");
				mysqli_query($db,"set session character_set_result=utf8;");
				mysqli_query($db,"set session character_set_client=utf8;");
				
				$query = "select count(id) from guest where id = '".$id."';";
				$result = mysqli_query($db,$query);
				$row = mysqli_fetch_array($result,MYSQLI_NUM);
				
				if($row[0] > 0)
				{
					$error = true;
					$error_code = 4;
				}
				else
				{
					$query = "insert into guest (id,pwd,e_mail,img_url,img_process,ip_address,img_data) value('".$id."','".$pw."','".$mail."','picture/".$picture_name."',0,'".$_SERVER['REMOTE_ADDR']."','".$content."');";

					$result = mysqli_query($db,$query);
					if($result != true)
					{
						$error_code = 5;
						$error = true;
					}
				}
			}
			mysqli_close($db);
		}
		else
		{
			$error = true;	
			$error_code = 2;
		}
	}
	else
	{
		$error = true;
		$error_code = 1;
		echo("<script>location.href='http://stories2.iptime.org/playground/demo/new_bee.html';</script>");
	}
	if($error == true)
	{
//		echo $error_code.'<br>';
		echo ("<script>alert('에러가 발생하였습니다 잠시후에 다시 시도해주세요 에러코드 ".$error_code."');location.href='http://stories2.iptime.org/playground/demo/new_bee.html';</script>");
	}
	else
	{
		echo 'ok<br><script>alert("완료되었습니다 등록한 정보로 로그인 해주세요");location.href="http://stories2.iptime.org/playground/demo/login.html";</script>';
	}
	echo '</body></html>';
?>
