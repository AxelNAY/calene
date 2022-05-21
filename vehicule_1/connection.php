<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=calene;charset=utf8', 'etudiant.calene', 'etudiant47');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>