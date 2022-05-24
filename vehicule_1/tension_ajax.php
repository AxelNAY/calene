<?php
//connection à la base de données Calene
	include "connexion.php";
//Récupération de la dernière valeur enregistrée dans les champs Volt_1 et Volt_2 de la table vehicule 1
header("Content-type: text/json");
	$reponse = $bdd->query('SELECT Volt_1, Volt_2 FROM vehicule1 ORDER BY ID_Vehi DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>
