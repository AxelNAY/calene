<?php
//récupération du message
$message = $_POST['comments'];
$message = str_replace("'", "\'", $message);
//connection à la base de données Calene
include "connexion.php";
//requête permettant de récupérer le dernier enregistrement
	$requete = 'SELECT * FROM voiture1 ORDER BY ID_Voiture DESC LIMIT 0,1 ;' ;
	$resultat = $bdd->query($requete);
	$compteur = $resultat->rowCount() ;
	$result = $resultat->fetch() ;
//requête permettant d'entrer le commentaire dans la base de données calene
$requete1 = "INSERT INTO voiture1 (Commentaire, Courant_1, Courant_2, Tension_1, Tension_2, Vitesse, Latitude, Longitude)
VALUES ('$message','$result[3]', '$result[4]','$result[5]','$result[6]','$result[7]','$result[8]','$result[9]')";
$resultat = $bdd->query($requete1);
$compteur1 = $resultat->rowCount() ; // on compte le nombre de résultat à notre requete : 1 si ok sinon 0
	//echo $compteur1 ;
	if ($compteur1 == 1)
	{
		echo "Success" ;
	}
	else
	{
		echo "Failed";
	}
?>