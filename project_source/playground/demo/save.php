<?php
	if(empty($_GET['admin']) != true && empty($_GET['guest']) != true && empty($_GET['level'])!=true && empty($_GET['stopt'])!=true)
	{
		$admin = $_GET['admin'];
		$guest = $_GET['guest'];
		$level = $_GET['level'];
		$blocked = $_GET['stopt'];
		//echo 'admin : '.$admin.'<br>guest : '.$guest.'<br>level : '.$level.'<br>blocked : '.$blocked;
		$host = "127.0.0.1";
		$error = false;
		$error_counter = 0;
		
		$db = mysqli_connect($host,"stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{
			$error = true;
			$error_counter = 1;
		}
		
		mysqli_query($db,"set session character_set_connection = utf8;");
		mysqli_query($db,"set session character_set_result=utf8;");
		mysqli_query($db,"set session character_set_client=utf8;");
		
		$query = "select id from guest where id = '".$admin."';";
//		echo $query.'<br>';
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array($result,MYSQLI_NUM);
		if($row[0] == $admin)
		{
			$query = "update guest set permission=".$level." , blocked=".$blocked." where id='".$guest."';";
//			echo $query;
			$result = mysqli_query($db,$query);/*
			if($result == 0)
			{
				echo 'ok';
			}
			else
			{
				$error = true;
				$error_counter = 2;
			}*/
		}
		else
		{
			echo 'Wrong Connection';
		}
		if($error == true)
		{
			echo 'error : '.$error_counter;
		}
		mysqli_close();
		echo ("<script>alert('ok');window.external.admin();</script>");		
	}
	else
	{
		echo 'Wrong Connection';/*
		if(empty($_GET['admin'])!=true)
		{
			echo 'admin : '.$_GET['admin'];
		}
		if(empty($_GET['guest'])!=true)
		{	
			echo 'guest : '.$_GET['guest'];
		}
		if(empty($_GET['level'])!=true)
		{
			echo 'level : '.$_GET['level'];
		}
		if(empty($_GET['stopt'])!=true)
		{
			echo 'blocked : '.$_GET['stopt'];
		}
		if(empty($_REQUEST['admin'])!=true)
		{
			echo 'admin re : '.$_REQUEST['admin'];
		}*/
	}
?>
