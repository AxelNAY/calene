<?php
//connection à la base de données Calene
	include "connexion.php";
header("Content-type: text/json");
//Récupération de la dernière valeur enregistrée dans les champs Temps, Tension_1 et Tension_2 de la table voiture 2
	$requete = 'SELECT Temps, Tension_1, Tension_2 FROM voiture2 ORDER BY ID_Voiture DESC LIMIT 0,1' ;
	$reponse = $bdd->query($requete);
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "," ;
		echo $donnees['2'] ;
		echo "]" ;
	}
?>
	
	
	
	