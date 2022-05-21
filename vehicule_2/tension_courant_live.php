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
		<title>CALENE : U & I</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/menu2.css"/>
        <style type="text/css">
	body {
	background-color: #6699CC;
	}
        </style>
	<body onload="startTime(); requestmessage() ; texteDefile();">
		<?php
		//ajout du menu
		include "menu.html";
		?>
        <script type="text/javascript" src="../highcharts/highcharts.js"></script>
        <script type="text/javascript" src="../highcharts/highcharts-more.js"></script>
        <script type="text/javascript" src="../highcharts/exporting.js"></script>
        <script type="text/javascript" src="../jquery/jquery-1.10.1.js"></script>
<div id="container_U" style="width: 1400px; height: 300px; margin: 0 auto"></div>
<div id="container_I" style="width: 1400px; height: 300px; margin: 0 auto"></div>
        <script>
        var chart;
        //fonction qui appelle le fichier tension_ajax.php
		//qui récupère les courants par une requête ajax sur le fichier tension_courant_live.php
        //qui retourne une valeur formatée en json
        function requestDataU() {
            $.ajax({
                url: 'tension_ajax.php', 
                success: function(point) {
                    var
					//conversion des tensions reçues en Volt
                        u0 = point[0] / 10 ;
                        u1 = point[1] / 10 ;
					//attribution des tensions à une série
					//qui permet de les affichées sur le graphique
                    chart_U.series[0].points[0].update(u0, false);
                    chart_U.series[1].points[0].update(u1, false);
                    chart_U.redraw();
                    // rappel après 1 seconde
                    setTimeout(requestDataU, 1000);  
                },
                cache: false
            });
        }
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
            //graphique des tensions
            chart_U = new Highcharts.Chart({
                //console.log( "ready!" );
                chart: {
                    renderTo: 'container_U',
                    type: 'gauge',
                    plotBorderWidth: 1,
                    plotBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#B0F0B0'],
                            [0.4, '#FFFFFF'],
                            [0.6, '#FFFFFF'],
                            [1, '#B0F0B0']
                        ]
                    },
                    plotBackgroundImage: null,
                    height: 300,
                    events: {
                        load: requestDataU
                    }
                },
                title: {
                    style: {
                            color: '#00B000',
                            fontWeight: 'bold'
                    },
                    text: 'Tensions dans calenes'
                },
                pane: [, {
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
                    tickPixelInterval: 50,
                    labels: {
                        step: 1,
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
                        text: 'Tension du <br>Panneau Solaire<br><span style="font-size:8px">en volts</span>',
                        y: -40
                    }
                }, {
                    min: 0,
                    max: 50,
                    minorTickPosition: 'outside',
                    tickPosition: 'outside',
                    tickPixelInterval: 50,
                    labels: {
                        step: 1,
                        rotation: 'auto',
                        distance: 20
                    },
                    plotBands: [{
                        from: 0,
                        to: 10,
                        color: '#C02316',
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }],
                    pane: 1,
                    title: {
                        text: 'Tension de la <br>Batterie<br><span style="font-size:8px">en volts</span>',
                        y: -40
                    }                
                }],
                plotOptions: {
                    gauge: {
                        dial: {
                            radius: '95%',
                            backgroundColor: 'black',
                            borderColor: 'black',
                            borderWidth: 0,
                            baseWidth: 2,
                            topWidth: 0,
                            baseLength: '90%', // of radius
                            rearLength: '50%'
                        },
                        dataLabels: {
                                    y: -230,
                                    borderWidth: 1,
                                    useHTML: true
                        }    
                    }
                },
                series: [{
                    name: 'Tension 1',
                    data: [0],
                    radius: '100%',
                    yAxis: 0
                }, {
                    name: 'Tension 2',
                    data: [0],
                    yAxis: 1
                }]
            });    
            //graphique des courants
            chart_I = new Highcharts.Chart({
                //console.log( "ready!" );
                chart: {
                    renderTo: 'container_I',
                    type: 'gauge',
                    plotBorderWidth: 1,
                    plotBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#F0B0B0'],
                            [0.4, '#FFFFFF'],
                            [0.6, '#FFFFFF'],
                            [1, '#F0B0B0']
                        ]
                    },
                    plotBackgroundImage: null,
                    height: 300,
                    events: {
                        load: requestDataI
                    }
                },
                title: {
                    style: {
                            color: '#B00000',
                            fontWeight: 'bold'
                    },
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
                    tickPixelInterval: 50,
                    labels: {
                        step: 1,
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
                        text: 'Courant du <br>Panneau Solaire<br><span style="font-size:10px">en ampères</span>',
                        y: -40
                    }
                }, {
                    min: -10,
                    max: +10,
                    minorTickPosition: 'outside',
                    tickPosition: 'outside',
                    tickPixelInterval: 50,
                    labels: {
                        step: 1,
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
                        text: 'Courant de la <br>Batterie<br><span style="font-size:10px">en ampères</span>',
                        y: -40
                    }
				}],
                plotOptions: {
                    gauge: {
                        dial: {
                            radius: '95%',
                            backgroundColor: 'black',
                            borderColor: 'black',
                            borderWidth: 0,
                            baseWidth: 2,
                            topWidth: 0,
                            baseLength: '90%',
                            rearLength: '50%'
                        },
                        dataLabels: {
                                    y: -230,
                                    borderWidth: 1,
                                    useHTML: true
                        }    
                    }
                },
                series: [{
                    name: 'Courant 1',
                    data: [0],
                    yAxis: 0
                }, {
                    name: 'Courant 2',
                    data: [-0],
                    yAxis: 1
                }]
            });
        });
		</script>
	</body>
</html>