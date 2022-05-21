<html> 
<head> 
 	 <title> Formulaire CALENE </title> 
</head> 
<body bgcolor="#D3D3D3" > 
    
<center>
<?php echo "<H1> RESULTAT DU FORMULAIRE </H1>"; 
     
    include "ConnectBdD.php";
     
	 
	$Courant_1 = $_GET['var1'];
	$Courant_2 = $_GET['var2'];
	$Tension_1 = $_GET['var3']; // Récupération des données 
	$Tension_2 = $_GET['var4'];
 	$Vitesse = $_GET['var5'];
	$Latitude = $_GET['var6'];
	$Longitude = $_GET['var7'];
	
	printf ("<H1> Courant_1 = $Courant_1 </H1>"); 
	printf ("<H1> Courant_2 = $Courant_2 </H1>"); 
	printf ("<H1> Tension_1 = $Tension_1 </H1> ");
	printf ("<H1> Tension_2 = $Tension_2 </H1>");
	printf ("<H1> Vitesse = $Vitesse </H1>");
	printf ("<H1> Position = $Position </H1>");
	
?> 

</center>
    
<?php // Fonction base de données

    $log = ConnectBdD(); // Variable associée à la page ConnectBdD 

    if ($log) // Si la connexion se fait
    {

		$requete = "INSERT INTO voiture1 VALUES ('$Courant_1','$Courant_2','$Tension_1','$Tension_2','$Vitesse','$Latitude','$Longitude')"; // Alors on entre les données attendues dans la table 
					
		$resultat = mysqli_query($log, $requete); // Affichage sur la page Php 
		if ( $resultat )
		{
			echo "Enregistrement ajoute";
		}
		else
		{
			echo "Echec";
		}
		mysqli_close($log);
    }
    else
    {
        echo "Connexion à la BdD échouée";
    }

	
			 
			 
?>
</body> </html> 
