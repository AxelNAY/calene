<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
header("Content-type: text/json");
//Récupération de la dernière valeur enregistrée dans les champs Time, Volt_1 et Volt_2 de la table vehicule 1
	$requete = 'SELECT Time, Volt_1, Volt_2 FROM vehicule1 ORDER BY ID_Vehi DESC LIMIT 0,1' ;
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


	
