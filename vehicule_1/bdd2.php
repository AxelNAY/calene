<?php
if (isset($_GET['type'])) {	$type = $_GET['type']; } //récupération de l'unité permettant de choisir le champ
if (isset($_GET['indice'])) { $indice = $_GET['indice']; } //récupération de l'indice permettant de choisir le champ
if (isset($_GET['valeur'])) { $valeur = $_GET['valeur']; } //récupération de la valeur
//connection à la base de données calene
	include "connexion.php";
	$requete = 'SELECT * FROM voiture1 ORDER BY ID_Voiture DESC LIMIT 0,1 ;' ;
	$resultat = $bdd->query($requete);
	$compteur = $resultat->rowCount() ;
	$result = $resultat->fetch() ;
	//itération permettant de vérifier l'unité de la valeur
	if ($type == 'U')
	{
		//conversion de la tension entrée
		$valeur = $valeur * 10;
		//itération permettant de choisir le champ (Tension_1 ou Tension_2)
		if ($indice == '1')
		{
			$requete1 = "INSERT INTO voiture1 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude)
			VALUES ('$result[2]', '$result[3]','$result[4]','$valeur','$result[6]','$result[7]','$result[8]','$result[9]')";
		}
		else if ($indice == '2')
		{
			$requete1 = "INSERT INTO voiture1 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude)
			VALUES ('$result[2]', '$result[3]','$result[4]','$result[5]','$valeur','$result[7]','$result[8]','$result[9]')";
		}
	}
	if ($type == 'I')
	{
		//conversion du courant entrée
		$valeur = $valeur * 1024;
		//itération permettant de vérifier si le courant est négatif
		if ($valeur < 0)
		{
			$valeur = $valeur + 65536;
		}
		//itération permettant de choisir le champ (Courant_1 ou Courant_2)
		if ($indice == '1')
		{
			$requete1 = "INSERT INTO voiture1 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude)
			VALUES ('$result[2]', '$valeur','$result[4]','$result[5]','$result[6]','$result[7]','$result[8]','$result[9]')";
		}
		else if ($indice == '2')
		{
			$requete1 = "INSERT INTO voiture1 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude)
			VALUES ('$result[2]', '$result[3]','$valeur','$result[5]','$result[6]','$result[7]','$result[8]','$result[9]')";
		}
	}
	if ($type == 'V')
	{
		//conversion de la vitesse entrée
		$valeur = $valeur / 3.6;
		$requete1 = "INSERT INTO voiture1 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude)
		VALUES ('$result[2]', '$result[3]','$result[4]','$result[5]','$result[6]','$valeur','$result[8]','$result[9]')";
	}
	$resultat = $bdd->query($requete1);
?>