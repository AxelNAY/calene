<?php
//connection à la base de données Calene
	include "connexion.php";
//Récupération de la dernière valeur enregistrée dans les champs Tension_1 et Tension_2 de la table voiture 1
header("Content-type: text/json");
	$reponse = $bdd->query('SELECT Tension_1,Tension_2 FROM voiture1 ORDER BY ID_Voiture DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>