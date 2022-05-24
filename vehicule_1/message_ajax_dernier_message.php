<?php
try
{
$bdd = new PDO('mysql:host=cprp.lolacie.fr;dbname=Projet_BTS;charset=utf8', 'identifiant', 'motdepasse');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
//-----------------------------------------------------------------------------
// Set the JSON header
header("Content-type: text/json");

	$reponse = $bdd->query('SELECT Message FROM vehicule_1 ORDER BY ID DESC LIMIT 0,1');
	while ( $donnees = $reponse->fetch() ) {
		echo "[" ;
		echo $donnees['0'] ;
		echo "]" ;
	}
/**/

?>
