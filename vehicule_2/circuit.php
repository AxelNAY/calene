<!DOCTYPE HTML>

<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_2.html");
	}
?>

<html>
	<head>
		<title>CALENE : Longueur du circuit</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<!-- affichage de la mesure du circuit via un fichier png -->
		<div style="text-align: center;">
			<img
				    src="\projet\images\circuit.jpg"
				    height="50%" 
				    width="50%" 
				/>
		</div>
	</body>
</html>