<?php
//connection à la base de données Calene
	include "connexion.php";
//Récupération de la dernière valeur enregistrée dans le champ Vitesse de la table voiture 1
header("Content-type: text/json");
	$requete = 'SELECT Vitesse FROM voiture1 ORDER BY ID_Voiture DESC LIMIT 0,1' ;
	$reponse = $bdd->query($requete);
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "]" ;
	}
?>