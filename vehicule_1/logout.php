<?php
	session_start();

	if(isset($_SESSION["Connected"]))
	{
		session_destroy();
		header("Location: login_1.html");
	}else{
		header("Location: login_1.html");
	}
?>