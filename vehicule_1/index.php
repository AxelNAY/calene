<!DOCTYPE html>

<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_1.html");
	}
?>

<html>
	<head>
    	<title>CALENE Menu principal</title>
    	<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/menu2.css"/>
		<meta name="viewport" content="width=device-width">
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
	<!-- affichage du logo de l'association Calene via un fichier jpg -->
	<div style="text-align: center;">
			<img
				    src="/projet/images/Logo_Calene.jpg" 
				    alt="logo de calene"
				    height="35%" 
				    width="35%" 
				/>
		</div>
	</body>
</html>

