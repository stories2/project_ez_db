<?php
	if(empty($_GET['id'])!=true)
	{
		echo ("<script>window.external.logout();</script>");
	}
	else
	{
		echo 'Wrong Connection';
	}
?>
