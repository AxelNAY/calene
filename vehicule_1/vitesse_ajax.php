<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
//Récupération de la dernière valeur enregistrée dans le champ Speed de la table vehicule 1
header("Content-type: text/json");
	$requete = 'SELECT Speed FROM vehicule1 ORDER BY ID_Vehi DESC LIMIT 0,1' ;
	$reponse = $bdd->query($requete);
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "]" ;
	}
?>
