<?php
	session_start();

	if(isset($_SESSION["Connected"]))
	{
		session_destroy();
		header("Location: login_2.html");
	}else{
		header("Location: login_2.html");
	}
?>