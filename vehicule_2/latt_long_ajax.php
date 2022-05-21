<?php
//connection à la base de données Calene
	include "connexion.php";
// Set the JSON header
header("Content-type: text/json");

	$reponse = $bdd->query('SELECT Latitude, Longitude FROM voiture2 ORDER BY ID_Voiture DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>
	
	
	
	