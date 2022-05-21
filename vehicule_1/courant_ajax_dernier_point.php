<?php
//connection à la base de données Calene
	include "connexion.php";
	header("Content-type: text/json");
//Récupération de la dernière valeur enregistrée dans les champs Temps, Courant_1 et Courant_2 de la table voiture 1
	$requete = 'SELECT Temps, Courant_1, Courant_2 FROM voiture1 ORDER BY ID_Voiture DESC LIMIT 0,1' ;
//	echo $requete ;
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
