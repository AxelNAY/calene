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
		<title>CALENE : I</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/menu2.css"/>
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
        <script type="text/javascript" src="../highcharts/exporting.js"></script>
        <script type="text/javascript" src="../jquery/jquery-1.10.1.js"></script>
		<div id="container_I" style="width: 1400px; height: 300px; margin: 0 auto"></div>
        <script>
        var chart;
        //fonction qui appelle le fichier courant_ajax.php
		//qui récupère les courants par une requête ajax sur le fichier courant_live.php
        //qui retourne une valeur formatée en json
        function requestDataI() {
            $.ajax({
                url: 'courant_ajax.php', 
                success: function(point) {
                    var 
					i0 = point[0]  ;
					i1 = point[1]  ;
                    console.log( i0 );
                    console.log( i1 );
					//convertion des courants reçus en Ampère
					if (i0 > 32767) { i0 = i0 - 65536 ; }
					if (i1 > 32767) { i1 = i1 - 65536 ; }
					i0 = i0 / 1024 ;
					i1 = i1 / 1024 ;
					//attribution des courants à une série
					//qui permet de les affichés sur le graphique
                    chart_I.series[0].points[0].update(i0, false);
                    chart_I.series[1].points[0].update(i1, false);
                    chart_I.redraw();
                    // rappel après 1 seconde
                    setTimeout(requestDataI, 1000);  
                },
                cache: false
            });
        }
        //paramétrage du graphique
        $(document).ready(function() {
            chart_I = new Highcharts.Chart({
                chart: {
                    renderTo: 'container_I',
                    type: 'gauge',
                    plotBorderWidth: 1,
                    plotBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#F0D4F0'],
                            [0.5, '#FFFFFF'],
                            [1, '#F0D4F0']
                        ]
                    },
                    plotBackgroundImage: null,
                    height: 300,
                    events: {
                        load: requestDataI
                    }
                },
                title: {
                    text: 'Courants dans calenes'
                },
                pane: [{
                    startAngle: -45,
                    endAngle: 45,
                    background: null,
                    center: ['35%', '115%'],
                    size: 300
                }, {
                    startAngle: -45,
                    endAngle: 45,
                    background: null,
                    center: ['65%', '115%'],
                    size: 300
                }],
                tooltip: {
                    enabled: false
                },
                yAxis: [{
                    min: -10,
                    max: 10,
                    minorTickPosition: 'outside',
                    tickPosition: 'outside',
                    labels: {
                        rotation: 'auto',
                        distance: 20
                    },
                    plotBands: [{
                        from: 8,
                        to: 10,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }],
                    pane: 0,
                    title: {
                        text: 'Courant n°1<br/><span style="font-size:10px">Panneau solaire</span>',
                        y: -40
                    }
                }, {
                    min: -10,
                    max: 10,
                    minorTickPosition: 'outside',
                    tickPosition: 'outside',
                    labels: {
                        rotation: 'auto',
                        distance: 20
                    },
                    plotBands: [{
                        from: 8,
                        to: 10,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }],
                    pane: 1,
                    title: {
                        text: 'Courant n°2<br/><span style="font-size:10px">Batterie</span>',
                        y: -40
                    }
                }],
                series: [{
                    name: 'Channel A',
                    data: [10],
                    yAxis: 0
                }, {
                    name: 'Channel B',
                    data: [10],
                    yAxis: 1
                }]
            });     
        });
		</script>
	</body>
</html>