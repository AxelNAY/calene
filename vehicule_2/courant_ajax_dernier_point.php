<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
	header("Content-type: text/json");
//Récupération de la dernière valeur enregistrée dans les champs Time, Amp_1 et Amp_2 de la table vehicule 2
	$requete = 'SELECT Time, Amp_1, Amp_2 FROM vehicule2 ORDER BY ID_Vehi DESC LIMIT 0,1' ;
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
