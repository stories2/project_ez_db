<?php
	if(empty($_GET['id'])!=true)
	{
		$id = $_GET['id'];
		$host = "127.0.0.1";
		$db = mysqli_connect($host,"stories2","toortoor%^%","stories2");
		if(mysqli_connect_errno())
		{
			$error = true;
			$error_code = 1;
		}
		mysqli_query($db,"set session character_set_connection=utf8;");
		mysqli_query($db,"set session character_set_results=utf8;");
		mysqli_query($db,"set session character_set_client=utf8;");
		
		$query = "select img_data from guest where id = '".$id."';";
		mysqli_query($db,$query);
		
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array($result,MYSQLI_NUM);
		
		//$pic = addslashes($row[0]);
		Header("Content-type:image/jpeg");
		echo  $row[0];
		mysqli_close();
	}
	else
	{
		echo 'Wrong Connection';
	}
?>
