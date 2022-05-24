<?php
$message = $_POST['comments'];
//echo $message ;
//echo "<BR>" ;
$message = str_replace("'", "\'", $message);
//connection à la base de données Projet_BTS
include "connexion.php";


	$requete = 'SELECT * FROM vehicule2 ORDER BY ID_Vehi DESC LIMIT 0,1 ;' ;
	//$requete = "SELECT * FROM vehicule2 ;" ;
//	echo $requete ;
//	echo "<BR>" ;
	$resultat = $bdd->query($requete);
	$compteur = $resultat->rowCount() ;
	$result = $resultat->fetch() ;
//	var_dump($result) ;
/*
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
/**/


$requete1 = "INSERT INTO vehicule2 (Message, Amp_1, Amp_2, Volt_1, Volt_2, Speed, Lat, Long)
VALUES ('$message','$result[3]', '$result[4]','$result[5]','$result[6]','$result[7]','$result[8]','$result[9]')";
//echo $requete1 ;
//echo "<BR>" ;
$resultat = $bdd->query($requete1);
//var_dump ($resultat);
//echo "<BR>" ;
$compteur1 = $resultat->rowCount() ; // on compte le nombre de résultat à notre requete : 1 si ok sinon 0
//	echo $compteur1 ;
	if ($compteur1 == 1)
	{
		echo "Success" ;
	}
	else
	{
		echo "Failed";
	}
	
/**/	
?>
		
		
		
