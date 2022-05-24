<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
// Set the JSON header
header("Content-type: text/json");

	$reponse = $bdd->query('SELECT Lat, Long FROM vehicule2 ORDER BY ID_Vehi DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>
	
	
	
	
