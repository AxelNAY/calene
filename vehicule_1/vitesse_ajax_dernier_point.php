<?php
//connection à la base de données Calene
	include "connexion.php";
	header("Content-type: text/json");
//Récupération de la dernière valeur enregistrée dans les champs Temps et Vitesse de la table voiture 1
	$requete = 'SELECT Temps, Vitesse FROM voiture1 ORDER BY ID_Voiture DESC LIMIT 0,1' ;
	$reponse = $bdd->query($requete);
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>