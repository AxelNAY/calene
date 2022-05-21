<!DOCTYPE HTML>

<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_1.html");
	}
?>

<html>
	<head>
		<title>CALENE : Plan du circuit</title>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/menu2.css"/>
	</head>
	
<style type="text/css">
body {
background-color: #6699CC;
}
</style>
	
	<body>
	<?php
	//ajout du menu
	include "menu.html";
	?>
	<!-- affichage du plan via un fichier png -->
		<div style="text-align: center;">
			<img
				    src="\projet\images\plan.jpg"
				    height="40%" 
				    width="40%" 
				/>
		</div>
	</body>
</html>