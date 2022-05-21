<?php

if (isset($_GET['type'])) {	$type = $_GET['type']; } //récupération de l'unité permettant de choisir le champ
if (isset($_GET['indice'])) { $indice = $_GET['indice']; } //récupération de l'indice permettant de choisir le champ
if (isset($_GET['valeur'])) { $valeur = $_GET['valeur']; } //récupération de la valeur

echo $type ;
echo "<BR>" ;
echo $indice ;
echo "<BR>" ;
echo $valeur ;
echo "<BR>" ;

//connection à la base de données Calene
	include "connexion.php";

	$requete = 'SELECT * FROM voiture2 ORDER BY ID_Voiture DESC LIMIT 0,1 ;' ;
	//$requete = "SELECT * FROM voiture2 ;" ;
	echo $requete ;
	echo "<BR>" ;
	$resultat = $bdd->query($requete);
	$compteur = $resultat->rowCount() ;
	$result = $resultat->fetch() ;
//	var_dump($result) ;

	echo "<BR>" ;
	echo $compteur ;
	echo "<BR>" ;


	echo $result[0] ;
	echo "<BR>" ;
	echo $result[1] ;
	echo "<BR>" ;
	echo $result[2] ;
	echo "<BR>" ;
	echo $result[3] ;
	echo "<BR>" ;
	echo $result[4] ;
	echo "<BR>" ;
	echo $result[5] ;
	echo "<BR>" ;
	echo $result[6] ;
	echo "<BR>" ;
	echo $result[7] ;
	echo "<BR>" ;
	echo $result[8] ;
	echo "<BR>" ;
	echo $result[9] ;
	echo "<BR>" ;
	echo "<BR>" ;

	//itération permettant de vérifier l'unité de la valeur
	if ($type == 'U')
	{
		//conversion de la tension entrée
		$valeur = $valeur * 10;
		//itération permettant de choisir le champ (Tension_1 ou Tension_2)
		if ($indice == '1')
		{
			$requete2 = "INSERT INTO voiture2 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude) VALUES ('$result[2]', '$result[3]','$result[4]','$valeur','$result[6]','$result[7]','$result[8]','$result[9]')";
		}
		else if ($indice == '2')
		{
			$requete2 = "INSERT INTO voiture2 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude) VALUES ('$result[2]', '$result[3]','$result[4]','$result[5]','$valeur','$result[7]','$result[8]','$result[9]')";
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
			$requete2 = "INSERT INTO voiture2 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude) VALUES ('$result[2]', '$valeur','$result[4]','$result[5]','$result[6]','$result[7]','$result[8]','$result[9]')";
			echo $requete ;
		}
		else if ($indice == '2')
		{
			$requete2 = "INSERT INTO voiture2 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude) VALUES ('$result[2]', '$result[3]','$valeur','$result[5]','$result[6]','$result[7]','$result[8]','$result[9]')";
		}
	}
	if ($type == 'V')
	{
		//conversion de la vitesse entrée
		$valeur = $valeur / 3.6;
		$requete2 = "INSERT INTO voiture2 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude) VALUES ('$result[2]', '$result[3]','$result[4]','$result[5]','$result[6]','$valeur','$result[8]','$result[9]')";
	}
	echo $requete2 ;
	echo "<BR>" ;
	$resultat = $bdd->query($requete2);
	echo $resultat ;

?>