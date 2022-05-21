<?php
//connection à la base de données Calene
	include "connexion.php";
//Récupération de la dernière valeur enregistrée dans les champs Courant_1 et Courant_2 de la table voiture 2
header("Content-type: text/json");
	$reponse = $bdd->query('SELECT Courant_1,Courant_2 FROM voiture2 ORDER BY ID_Voiture DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>