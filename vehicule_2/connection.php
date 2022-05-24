<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=Projet_BTS;charset=utf8', 'identifiant', 'motdepasse');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>
