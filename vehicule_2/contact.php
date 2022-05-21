<!DOCTYPE HTML>

<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_2.html");
	}
?>

<html>
	<head>
		<title>Contact</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/menu2.css"/>
	</head>
	
	<style type="text/css">
body {
background-color: #6699CC;
}
</style> 
	
	<body>
	<?php
	
	//ajout du menu
	include "menu.html";
	?>
	<!-- zone du texte qui sera envoyer à contact.php -->
	
	
	<form>
    <p>
		<p><font size="13" color="BLACK"> <b> Contact </b></font></p>
		<label for="comments">Vos commentaires :</label>
		<br>
		<br>
		<br>
        <textarea name="comments" id="comments" cols="50" rows="6">
		</textarea>
		<p> <input type="submit" id="submit" value="Envoyer" /></p>
		<p id=retour>  </p>
    </form>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
	<script>
	//création du document
$(document).ready(function(){
	//activation de la fonction une fois que l'utilisateur ait appuyer sur le bouton "Envoyer"
    $("#submit").click(function(e){
		e.preventDefault();
		//Création des variables contenant la valeur entrée dans "comments" et le retour
		var commentaire = document.getElementById("comments").value ;
		var texte_retour = document.getElementById("retour") ;
		console.log(commentaire) ;
		//envoi des données dans le fichier contact_ajax.php
        $.post(
            'contact_ajax.php',
			{
				comments: commentaire
			},
            function(data){
			//itération permettant de vérifier si l'utilisateur doit accéder au véhicule 1
			if(data[0] == 'S')
			{
				retour.innerHTML = "Votre commentaire a bien été envoyé."
            }
            else
			{
				retour.innerHTML = "Erreur !!! Votre commentaire n'a pas été envoyé."
            }
            },
         );
    });
});
</script>
	
	
	
	</body>
</html>