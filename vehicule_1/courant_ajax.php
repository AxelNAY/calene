<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
//Récupération de la dernière valeur enregistrée dans les champs Amp_1 et Amp_2 de la table vehicule 1
header("Content-type: text/json");
	$reponse = $bdd->query('SELECT Amp_1, Amp_2 FROM vehicule2 ORDER BY ID_Vehi DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "," ;
		echo $donnees['1'] ;
		echo "]" ;
	}
?>
