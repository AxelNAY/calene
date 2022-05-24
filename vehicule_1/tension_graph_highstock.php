<!DOCTYPE HTML>

<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_1.html");
	}
?>

<html>
	<head>
		<title>Tensions</title>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
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
		//connection à la base de données calene
		include "connexion.php";
		?>
		<script type="text/javascript" src="../jquery/jquery-1.10.1.js"></script>
		<script type="text/javascript" src="../HighStock/highstock.js"></script>
		<script type="text/javascript" src="../HighStock/exporting.js"></script>
		<script type="text/javascript" src="../HighStock/export-data.js"></script>
		<div id="container1" style="width: 1800px; height: 800px; margin: 0 auto"></div>
		<div id="container2" style="width: 1800px; height: 400px; margin: 0 auto"></div>
		<script>
		var chart ;
		var oldpoint = 1563490482000 ; // global
	    //fonction d'appeler le fichier vitesse_ajax_dernier_point.php permettant
		//de récupérer les dernières valeurs entrées dans les champs Vitesse et Temps
	    //et d'ajouter un nouveau point si la variable du champ Temps est différente
	    //de la variable oldpoint
		function requestData() {
			$.ajax({
				url: 'tension_ajax_dernier_point.php', 
				success: function(point) {
					point_tension1 = [point[0],point[1]] ;
					point_tension2 = [point[0],point[2]] ;
					//itération permetant de créer un nouveau point
					if ( (point[0] != oldpoint) )
					{
						//attribution des tensions à une série
						//qui permet de les affichés sur le graphique
						chart.series[0].addPoint(point_tension1, true, false); /* */
						chart.series[1].addPoint(point_tension2, true, false); /* */
						//attribution de la valeur du champ Temps à la varible oldpoint
						oldpoint = point[0] ;
					}
					// rappel après 1 seconde
					setTimeout(requestData, 1000);	
				},
				cache: false
			});
		}
		Highcharts.setOptions({
		    lang: {
		        months: [
		            'Janvier', 'Février', 'Mars', 'Avril',
		            'Mai', 'Juin', 'Juillet', 'Août',
		            'Septembre', 'Octobre', 'Novembre', 'Décembre'
		        ],
		        weekdays: [
		            'Dimanche', 'Lundi', 'Mardi', 'Mercredi',
		            'Jeudi', 'Vendredi', 'Samedi'
		        ]
		    }
		});
	    //paramétrage du graphique
		$(document).ready(function() {
			chart = new Highcharts.stockChart('container1', {
				    chart: {
				        events: {
									load: requestData
				        }
				    },				
			        rangeSelector: {
			        				allButtonsEnabled: false,
							        buttonTheme: { // styles for the buttons
							            fill: 'none',
							            width: 80,
							            stroke: 'none',
							            'stroke-width': 2,
							            r: 5,
							            style: {
							                color: 'blue',
							                fontWeight: 'bold'
							            },
							            states: {
							                hover: {
							                },
							                select: {
							                    fill: 'blue',
							                    style: {
							                        color: 'white'
							                    }
							                }
							                // disabled: { ... }
							            }
							        },
							        inputBoxBorderColor: 'gray',
							        inputBoxWidth: 120,
							        inputBoxHeight: 18,
							        inputStyle: {
							            color: '#039',
							            fontWeight: 'bold'
							        },
							        labelStyle: {
							            color: 'silver',
							            fontWeight: 'bold'
							        },
			        				buttonSpacing: 20,
									buttons: [{
										    type: 'second',
										    count: 30,
										    text: '30 secondes'
										}, {
										    type: 'minute',
										    count: 1,
										    text: '1 minute'
										}, {
										    type: 'minute',
										    count: 5,
										    text: '5 minutes'
										}, {
										    type: 'minute',
										    count: 10,
										    text: '10 minutes'
										}, {
										    type: 'minute',
										    count: 20,
										    text: '20 minutes'
										}, {
										    type: 'minute',
										    count: 30,
										    text: '30 minutes'
										}, {
										    type: 'hour',
										    count: 1,
										    text: '1 heure'
										}, {
										    type: 'all',
										    text: 'Tout'
										}],
						            selected: 1
			        },
			        title: {
			            text: 'CALENE'
			        },
				    xAxis: {
				        type: 'datetime',
				        dateTimeLabelFormats: { // don't display the dummy year
				            second: '%e %B %Y %H:%M:%S'				            
				        },
				        title: {
				            text: 'Date'
				        }
				    },
			        yAxis: {
			            title: {
			                text: 'Exchange rate'
			            },
			            plotLines: [{
			                value: 0,
			                color: 'green',
			                dashStyle: 'shortdash',
			                width: 2,
			                label: {
			                    text: 'minimum'
			                }
			            }, {
			                value: 50,
			                color: 'red',
			                dashStyle: 'shortdash',
			                width: 2,
			                label: {
			                    text: 'maximum'
			                }
			            }]
			        },
			        series: [{
				            name: 'Volt 1',
				            color: 'green',
							<?php
							$reponse = $bdd->query('SELECT Time, Volt_1, Volt_2 FROM vehicule1');
							$nombre_enregistrement = $reponse->rowCount() ;
							$compteur = 1 ;
							echo "data: [";
							while ($donnees = $reponse->fetch())
							{
								$u1 = $donnees[Volt_1] ;
								$u1 = $u1 / 10;
								$t = strtotime($donnees[Time]) + 7200;
								$ut1 = "[".$t."000, $u1]";
								echo $ut1;
								if ($compteur < $nombre_enregistrement)
								{
									echo",";
									$compteur ++ ;
								}
							}
							echo "]";
							echo "\n";
							?>
							,
							marker: {
						                enabled: true,
						                radius: 3
				            },
							type: 'spline',
				            tooltip: {
				                valueDecimals: 3
			            	}
			            },{	
				            name: 'Volt 2',
				            color: 'black',
				            <?php
							$reponse = $bdd->query('SELECT Time, Volt_1, Volt_2 FROM vehicule1');
							$nombre_enregistrement = $reponse->rowCount() ;
							$compteur = 1 ;
							echo "data: [";
							while ($donnees = $reponse->fetch())
							{
								$u2 = $donnees[Volt_2] ;
								$u2 = $u2 / 10;
								$t = strtotime($donnees[Time]) + 7200;
								$ut2 = "[".$t."000, $u2]";
								echo $ut2;
								if ($compteur < $nombre_enregistrement)
								{
									echo",";
									$compteur ++ ;
								}
							}
							echo "]";
							echo "\n";
							?>
							,
							marker: {
						                enabled: true,
							            symbol: 'cross',
							            lineColor: 'blue',
							            lineWidth: 2
					        },

							type: 'spline',
				            tooltip: {
				                valueDecimals: 3
			            	}
			            }]
			    });
    		});
		</script>
	</body>
</html>
