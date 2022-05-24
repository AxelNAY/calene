<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
	header("Content-type: text/json");
//Récupération de la dernière valeur enregistrée dans les champs Time et Speed de la table vehicule 2
	$requete = 'SELECT Time, Speed FROM vehicule2 ORDER BY ID_Vehi DESC LIMIT 0,1' ;
	$reponse = $bdd->query($requete);
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>
