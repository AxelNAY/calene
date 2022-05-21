<?php
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

$message = $_POST['le_message'];
$requete = "INSERT INTO Message FROM voiture_1 VALUES ('$message')";
$resultat = mysql_query($requete);

/**/

?>