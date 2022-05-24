<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
	
	$user = $_POST['username'] ;
	$password = $_POST['password'] ;
	$requete = "SELECT * FROM Autorisation WHERE user='".$user."' AND motdepasse='".$password."'" ; 
	//echo $requete ;
	$resultat = $bdd->query($requete);
	//var_dump($resultat) ;
	$compteur = $resultat->rowCount() ; // on compte le nombre de résultat à notre requete : 1 si ok sinon 0
	//echo $compteur ;
	if ($compteur == 1)
	{
		session_start();
		
		$_SESSION["Connected"] = true;
		
		echo "Success" ;
	}
	else
	{
		echo "Failed";
	}
?>
		
