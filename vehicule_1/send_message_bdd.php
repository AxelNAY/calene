<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=Projet_BTS;charset=utf8', 'identifiant', 'motdepasse');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
//-----------------------------------------------------------------------------
// Set the JSON header
header("Content-type: text/json");

$message = $_POST['le_message'];
$requete = "INSERT INTO Message FROM vehicule1 VALUES ('$message')";
$resultat = mysql_query($requete);

/**/

?>
