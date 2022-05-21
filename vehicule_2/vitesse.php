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
		<title>CALENNE : Vitesse</title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
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
		<script type="text/javascript" src="../highcharts/highcharts.js"></script>
		<script type="text/javascript" src="../highcharts/highcharts-more.js"></script>
		<script type="text/javascript" src="../jquery/jquery-1.10.1.js"></script>
		<div id="container1" style="width: 100%; height: 500px; margin: 0 auto"></div>
		<script>
		var compteur_V1;
		//fonction qui appelle le fichier vitesse_ajax.php
		//qui récupère la vitesse par une requête ajax sur le fichier vitesse.php
        //qui retourne une valeur formatée en json
		function requestData1() {
			$.ajax({
				url: 'vitesse_ajax.php?compteur=1', 
				success: function(point) {
					//attribution de la vitesse à une série
					//qui permet de l'affichée sur le graphique
					ddp0 = point[0] * 3.6 ;
					compteur_V1.series[0].data[0].update(ddp0);
					setTimeout(requestData1, 1000);	// call it again after one second
					console.log( point );
				},
				cache: false
			});
		}
		//paramétrage du graphique
		$(document).ready(function() {
			compteur_V1 = new Highcharts.Chart({
				chart: {
					renderTo: 'container1',
					defaultSeriesType: 'gauge',
					plotBackgroundColor: null,
        			plotBackgroundImage: null,
        			plotBorderWidth: 0,
        			plotShadow: false,
					events: {
						load: requestData1
					}
				},
				title: {
					text: 'Vitesse'
				},
			    pane: {
			        startAngle: -140,
			        endAngle: 140,
			        background: [{
			            backgroundColor: {
			                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
			                stops: [
			                    [0, '#FFF'],
			                    [1, '#333']
			                ]
			            },
			            borderWidth: 0,
			            outerRadius: '109%'
			        }, {
			            backgroundColor: {
			                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
			                stops: [
			                    [0, '#333'],
			                    [1, '#FFF']
			                ]
			            },
			            borderWidth: 1,
			            outerRadius: '107%'
			        }, {
			            backgroundColor: '#DDD',
			            borderWidth: 0,
			            outerRadius: '105%',
			            innerRadius: '100%'
			        }]
			    },
				yAxis: [{
				    min: 0,
        			max: 100,
			        minorTickInterval: 'auto',
			        minorTickWidth: 1,
			        minorTickLength: 10,
			        minorTickPosition: 'inside',
			        minorTickColor: '#666',
			        tickPixelInterval: 30,
			        tickWidth: 2,
			        tickPosition: 'inside',
			        tickLength: 10,
			        tickColor: '#666',
			        labels: {
			            step: 2,
			            distance: -20,
			            rotation: 'auto'
			        },
			        title: {
			            text: 'points et km/h'
			        },
		            plotBands: [{
		            from: 0,
		            to: 80,
		            color: '#55BF3B' // green
			        }, {
		            from: 80,
		            to: 90,
		            color: '#DDDF0D' // yellow
			        }, {
		            from: 90,
		            to: 100,
		            color: '#DF5353' // red
			        }]
				},{
			        min: 0,
			        max: 27.777778,
			        tickPosition: 'outside',
			        lineColor: '#933',
			        lineWidth: 2,
			        minorTickPosition: 'outside',
			        tickColor: '#933',
			        minorTickColor: '#933',
			        tickLength: 5,
			        minorTickLength: 5,
			        labels: {
			            distance: -15,
			            rotation: 'auto'
			        },
			        offset: -30,
			        endOnTick: false
				}],
				series: [{
					name: 'Vitesse',
					data: [100],
					dataLabels: {
            					formatter: function () {
                				var points = this.y,
                   				 kmh = Math.round(points / 3.6);
                				 return '<span style="color:#339">' + points + ' km/h</span><br/>' +
                    					'<span style="color:#933">' + kmh + ' m/s</span>';
            					},
			            		backgroundColor: {
									                linearGradient: {
									                    x1: 0,
									                    y1: 0,
									                    x2: 0,
									                    y2: 1
									                },
									                stops: [
									                    [0, '#DDD'],
									                    [1, '#FFF']
									                ]
					            }
        			},
        			tooltip: {
            			valueSuffix: ' km/h'
					}
				}]
			});		
		});
		</script>
	</body>
</html>