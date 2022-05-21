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
		<title>CALENE : test js</title>
		<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
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
	<h1>Modification de la dernière valeur entrée pour faire des tests de fonctionnement</h1>
		<form id="mainForm" name="mainForm">
		    <div>
		    	<input type="radio" id="tension" name="rads" value="U" checked/>
		    	<label for="tension">tension</label>
		    	<input type="radio" id="courant" name="rads" value="I" />
				<label for="courant">courant</label>
		    	<input type="radio" id="vitesse" name="rads" value="V" />
				<label for="vitesse">vitesse</label>
		    </div>
		</form>
		<br>
		<br>
		<div class="slidecontainer">
			<label id="label_valeur_min" for="valeur">0</label>
			<input type="range" min="0" max="50" value="0" class="slider" id="valeur">
	    	<label id="label_valeur_max" for="valeur">50</label>
		</div>
		<div class="slidecontainer">
			1<input type="range" min="1" max="2" value="0" class="slider" id="indice">2
		</div>
		<button onclick="myFunction1()" id="bouton1" >update </button>
		<p id="demo"></p>
		<script>
			//variable contenant la valeur choisie via le premier slider
			var slider_valeur = document.getElementById("valeur");
			//variable contenant l'indice choisi via le deuxième slider
			var slider_indice = document.getElementById("indice");
			//variable contenant l'unité choisi via l'un des trois boutons
			var radVal = document.mainForm.rads.value;
			var param_valeur = slider_valeur.value ;
			var param_indice = slider_indice.value ;
			//requête permettant d'envoyer la nouvelle valeur avec le bon champ dans le fichier bdd2.php
			//permettant d'envoyer cette valeur dans le champ choisi de la base de données
			var requete = "../vehicule_1/bdd2.php?" + "type=" + radVal + "&indice=" + param_indice + "&valeur=" + param_valeur ;
			var caption_bouton ;
			update_caption() ;
			//paramétrage du graphique
			document.mainForm.onclick = function(){
				radVal = document.mainForm.rads.value;
				requete = "../vehicule_1/bdd2.php?" + "type=" + radVal + "&indice=" + param_indice + "&valeur=" + param_valeur ;
				update_caption() ;
				switch (radVal)
				 {
				 	case 'U' : 	document.getElementById("valeur").min = 0 ;
								document.getElementById("valeur").max = 50 ; 
								document.getElementById("label_valeur_min").innerHTML = document.getElementById("valeur").min ;
				 				document.getElementById("label_valeur_max").innerHTML = document.getElementById("valeur").max ;
				 				//console.log(document.getElementById("valeur").max) ;
				 				break ;
				 	case 'I' : 	document.getElementById("valeur").min = -10 ;
								document.getElementById("valeur").max = 10 ;
								document.getElementById("label_valeur_min").innerHTML = document.getElementById("valeur").min ;
				 				document.getElementById("label_valeur_max").innerHTML = document.getElementById("valeur").max ;
				 				//console.log(document.getElementById("valeur").max) ;
				 				break ;
				 	case 'V' : 	document.getElementById("valeur").min = 0 ;
								document.getElementById("valeur").max = 100 ;
								document.getElementById("indice").max = 1;
								document.getElementById("label_valeur_min").innerHTML = document.getElementById("valeur").min ;
				 				document.getElementById("label_valeur_max").innerHTML = document.getElementById("valeur").max ;
				 				//console.log(document.getElementById("valeur").max) ;
				 				break ;
				 }
			}
			//fonction permettant d'envoyer la nouvelle valeur avec le bon champ dans le fichier bdd2.php
			//permettant d'envoyer cette valeur dans le champ choisi de la base de données
			function myFunction1() {
				var xhr = new XMLHttpRequest();
				requete = "./bdd2.php?" + "type=" + radVal + "&indice=" + param_indice + "&valeur=" + param_valeur ;
			  	document.getElementById("demo").innerHTML = requete ;
				console.log(requete) ;
				xhr.open('GET', requete);
				xhr.send(null);
			}
			//fonction permettant la configuration du bouton
			function update_caption() {
				caption_bouton = "update " ;
				switch (radVal)
				 {
				 	case 'U' : caption_bouton = caption_bouton + "tension n°" + param_indice + "= " + param_valeur ; break ;
				 	case 'I' : caption_bouton = caption_bouton + "courant n°" + param_indice + "= " + param_valeur ; break ;
				 	case 'V' : caption_bouton = caption_bouton + "vitesse n°" + param_indice + "= " + param_valeur ; break ;
				 }
				document.getElementById("bouton1").innerHTML = caption_bouton ;
			}
			//configuration du slider permettant de choisir l'indice
			slider_valeur.oninput = function() {
				param_valeur = this.value;
				update_caption() ;
			}
			//configuration du slider permettant de choisir l'indice
			slider_indice.oninput = function() {
				param_indice = this.value;
				update_caption() ;
			}
		</script>
	</body>
</html>