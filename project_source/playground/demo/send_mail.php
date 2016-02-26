<?php
	echo '<html>
		<head>
			<meta charset="utf-8">
		</head>
		<body>';
	$host = "127.0.0.1";
	$error = false;
	$error_code = 0;
	if(empty($_GET['id'])!=true)
	{
		$body = $_GET['body'];
		$id = $_GET['id'];
		
//		echo $id.'<br>'.$body;
		
		/*mail($id,'test',$body);
		mail("stories2@naver.com",'test',$body);*/
		$db = mysqli_connect($host,"stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{
			$error = true;
			$error_code = 1;
		}
		mysqli_query($db,"set session character_set_connection = utf8;");
		mysqli_query($db,"set session character_set_result=utf8;");
		mysqli_query($db,"set session character_set_client=utf8;");
		
		$query = "select e_mail from guest ;";
		$result = mysqli_query($db,$query);
		$cnt = 0;
		while(($row = mysqli_fetch_array($result,MYSQLI_NUM))!=NULL)
		{
			$cnt += 1;
			mail($row[0],"공지 메일입니다",$body);
		}
		mysqli_close();
		echo ("<script>location.href='email.php?id=".$id."';alert('성공적으로".$cnt."명의 회원에게 메일을 보냈습니다');</script>");
	}
	else
	{
		echo 'Wrong Connection';
	}
	echo '</body>
	</html>';
?>
