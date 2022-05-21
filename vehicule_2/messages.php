<!DOCTYPE HTML>
<html>
	<head>
		<title>CALENNE : Messages</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/menu2.css"/>
	</head>

	<body>
	<?php include "menu.html"; ?>

	<br>
	<br>
	<h1> Envoyer un message au pilote</h1>
	<br>

		<p id="message_actuel"></p>

	    <form id="formulaire" name="formulaire">
	    	<div>
				<input type="text" size="100%" name="le_message" placeholder="Message à envoyer">
			</div>
		</form>
		<br>
		<br>
		<br>
		<button onclick="myFunction1()" id="bouton1" >Envoyer le message </button>

		<script>
			//----------------------------------------------
			function myFunction1() {
				var xhr = new XMLHttpRequest();
				var requete = "http://localhost/projet/vehicule_1/send_message_bdd.php?le_message=" + document.formulaire.le_message.value ;
				console.log(requete) ;
				xhr.open('GET', requete);
				xhr.send(null);
				document.formulaire.le_message.value="" ;
			}

			//----------------------------------------------
			function requestData1() {
  
			    var xhr = new XMLHttpRequest();
			    var la_reponse = "" ;
			    // On souhaite juste récupérer le contenu du fichier, la méthode GET suffit amplement :
			    xhr.open('GET', 'http://localhost/projet/vehicule_1/message_ajax_dernier_message.html');

			    xhr.addEventListener('readystatechange', function() { // On gère ici une requête asynchrone

			        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) { 
			        	la_reponse = xhr.responseText ;
						//console.log( la_reponse );
			            document.getElementById('message_actuel').innerHTML = '<span><h2> Message actuel : ' + la_reponse + '</h2></span>'; // Et on affiche !
			        }
		    	});
    			xhr.send(null); // La requête est prête, on envoie tout !
				setTimeout(requestData1, 1000);	// call it again after one second
			}

			//----------------------------------------------
			requestData1() ;

		</script>


	</body>
</html>