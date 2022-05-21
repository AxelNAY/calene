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
		<title>CALENE : U</title>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/menu2.css"/>
		<style type="text/css">
		</style>
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
        <script type="text/javascript" src="../highcharts/exporting.js"></script>
        <script type="text/javascript" src="../jquery/jquery-1.10.1.js"></script>
<div id="container" style="width: 1400px; height: 300px; margin: 0 auto"></div>
        <script>
        var chart;
        //fonction qui appelle le fichier tension_ajax.php
		//qui récupère les tensions par une requête ajax sur le fichier tension_live.php
        //qui retourne une valeur formatée en json
        function requestData() {
            $.ajax({
                url: 'tension_ajax.php', 
                success: function(point) {
                    var
					//convertion des tensions reçues en Volt
                        ddp0 = point[0] / 10 ;
                        ddp1 = point[1] / 10 ;
					//attribution des tensions à une série
					//qui permet de les affichées sur le graphique
                    chart.series[0].points[0].update(ddp0, false);
                    chart.series[1].points[0].update(ddp1, false);
                    chart.redraw();
                    // rappel après 1 seconde
                    setTimeout(requestData, 1000);
                },
                cache: false
            });
        }
		//paramétrage du graphique
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                //console.log( "ready!" );
                chart: {
                    renderTo: 'container',
                    type: 'gauge',
                    plotBorderWidth: 1,
                    plotBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF4C6'],
                            [0.3, '#FFFFFF'],
                            [1, '#FFF4C6']
                        ]
                    },
                    plotBackgroundImage: null,
                    height: 300,
                    events: {
                        load: requestData
                    }
                },
                title: {
                    text: 'Tensions dans calenes'
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
                    min: 0,
                    max: 50,
                    minorTickPosition: 'outside',
                    tickPosition: 'outside',
                    labels: {
                        rotation: 'auto',
                        distance: 20
                    },
                    plotBands: [{
                        from: 0,
                        to: 10,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    },{
                        from: 40,
                        to: 50,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }],
                    pane: 0,
                    title: {
                        text: 'Tension n°1<br/><span style="font-size:8px">Panneau solaire</span>',
                        y: -40
                    }
                }, {
                    min: 0,
                    max: 50,
                    minorTickPosition: 'outside',
                    tickPosition: 'outside',
                    labels: {
                        rotation: 'auto',
                        distance: 20
                    },
                    plotBands: [{
                        from: 0,
                        to: 10,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    },{
                        from: 40,
                        to: 50,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }],
                    pane: 1,
                    title: {
                        text: 'Tension n°2<br/><span style="font-size:8px">Batterie</span>',
                        y: -40
                    }
                }],
                series: [{
                    name: 'Channel A',
                    data: [24],
                    yAxis: 0
                }, {
                    name: 'Channel B',
                    data: [-0],
                    yAxis: 1
                }]
            });     
        });
		</script>
	</body>
</html>