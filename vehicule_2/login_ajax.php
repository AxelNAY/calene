<?php
//connection à la base de données calene
	include "connexion.php";
	
	$user = $_POST['username'] ;
	$password = $_POST['password'] ;
	$requete = "SELECT * FROM Authentification WHERE login='".$user."' AND mdp='".$password."'" ; 
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
		
