<!DOCTYPE html>
<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_2.html");
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

<!--
<a href="http://calene.lolacie.fr/tension_courant_live.php" target="_blank">Affichage des courants et des tensions dans la voiture</a>
<br>
<br>
<a href="http://calene.lolacie.fr/carte_CHARTRES.php" target="_blank">Carte du circuit avec position de la voiture CIRCUIT CHARTRES</a>
<br>
<a href="http://calene.lolacie.fr/images/circuit.jpg" target="_blank">Carte du circuit (1,6km)</a>
<br>
<a href="http://calene.lolacie.fr/images/plan.jpg" target="_blank">Plan du site</a>
<br>
<br>
<a href="http://calene.lolacie.fr/todo.php" target="_blank">ToDo</a>
<br>
<br>
<a href="https://www.oxybol.fr/live.php" target="_blank">suivi en direct</a>
<br>
<br>
-->