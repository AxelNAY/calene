<?php

if (isset($_GET['username']))
{
	$login = $_GET['username'];
}
else
{
	die('Erreur : ' . $e->getMessage());
}

if (isset($_GET['password']))
{
	$mot_de_passe = $_GET['password'];
}
else
{
	die('Erreur : ' . $e->getMessage());
}

try
{
$bdd = new PDO('mysql:host=cprp.lolacie.fr;dbname=cprp;charset=utf8', 'etudiant.cprp', 'etudiant47');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
//-----------------------------------------------------------------------------
// Set the JSON header
header("Content-type: text/json");
	
	$utilisateur = $bdd->query('SELECT login FROM Authentification');
	
	if ($login == $utilisateur)
	{
		$password = $bdd->query('SELECT mdp FROM Authentification WHERE login = "$login"');
		
		if ($mot_de_passe == $password)
		{
			echo $donnees['0'];
		}
		else
		{
			echo $donnees['1'];
		}
	}
	else
	{
		echo $donnees['2'];
	}
	
/**/

?>
		
