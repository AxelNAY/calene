<?php
//connection à la base de données Projet_BTS
	include "connexion.php";
	$user = $_POST['username'] ;
	$password = $_POST['password'] ;
	$requete = "SELECT * FROM Autorisation WHERE user='".$user."' AND motdepasse='".$password."'" ; 
	$resultat = $bdd->query($requete);
	$compteur = $resultat->rowCount() ; // on compte le nombre de résultat à notre requete : 1 si ok sinon 0
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
		
