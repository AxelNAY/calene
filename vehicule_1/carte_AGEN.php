<!DOCTYPE html>

<?php
	session_start();
	
	if(!isset($_SESSION["Connected"]))
	{
		header("Location: login_1.html");
	}
?>

<html>
  <head>
    <title>CALENE AGEN</title>
    <meta name="viewport" content="initial-scale=1.0 , user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/menu.css"/>
	<link rel="stylesheet" href="../CALENE_AGEN_fichiers/leaflet.css"/>
	<script src="../CALENE_AGEN_fichiers/leaflet.js"> </script>
	<script src="../CALENE_AGEN_fichiers/jquery-3.2.1.js"> </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 90%;
        margin: 0;
        padding: 0;
		background-color: #6699CC;
      }
    </style>
  </head>
  <body>
	<?php
	//ajout du menu
	include "menu.html";
	?>
	<div id="map"></div>
	<script>
	//affichage d'une carte de la piste d'agen via mapbox
	#mapid { height: 120px; }
	var mymap = L.map('mapid').setView([51.505, -0.09], 13);
	L.tileLayer('https://api.mapbox.com/styles/v1/calene/ckkmo79ps4iru17ry6o3wvf45/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/ckkmo79ps4iru17ry6o3wvf45',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw'
}).addTo(mymap)
	</script>
    <script src="../CALENE_AGEN_fichiers/leaflet-color-markers.js"> </script>
    <script src="../CALENE_AGEN_fichiers/markers.js"> </script>
    <script>
      var indice = 0 ;
        // récupère la lattitude et la logitude
        // par une requête ajax sur le fichier latt_long.php
        // qui retourne une valeur formatée en json
        function requestDatacalene() {
            $.ajax({
                url: 'latt_long_ajax.php?indice=0',
                success: function(point) {
                    var 
                        longitude = point[1] ;
                        lattitude = point[0] ;
						//attribution de la lattitude et de la longitude à un marqueur
						//qui sera affiché sur le graphique
                        var newLatLng = new L.LatLng(lattitude, longitude);
                        marker_calene.setLatLng(newLatLng);
                        if (indice==0) { indice=6;} else  { indice=indice-1;} 
                    // rappel après 1 seconde
                    setTimeout(requestDatacalene, 1000);  
                },
                cache: false
            });
        }
        //
        $('#bouton').click(function() {
          //requestDatacalene() ;
        });

        //
        $(document).ready(function() {
          requestDatacalene() ;
        });
	//récupération des fichiers images nécessaire dans des variables
   	var imageicone = './projet/images/charge.png';
    var imageflag = './projet/images/flag.png';
    var imagecalene =  './projet/images/calene.png';
	//attribution de lattitude et de longiture aux différents marqueurs
    var circuit_depart =   {lat: 44.197559, lng: 0.613781};
    var circuit_virage_1 = {lat: 44.197690, lng: 0.614612};
    var circuit_virage_2 = {lat: 44.197728, lng: 0.613593};
    var circuit_rond_point = {lat: 48.439885, lng: 1.539996};
    var circuit_calene = {lat: 44.197682, lng: 0.614258};
    var voiture_calene = {lat: 44.197682, lng: 0.614258};
    //variable permettant de zoommer
    var map = L.map('map' , {
    	center:circuit_calene,
    	minZoom: 1,
    	maxZoom:18,
    	zoom: 18,
    	rotation: Math.PI / 3,
//      dragging: false,
//      zoomControl: false
      dragging: true,
      zoomControl: true
    	});
//	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    L.tileLayer('https://api.mapbox.com/styles/v1/calene/ckkmo79ps4iru17ry6o3wvf45/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw', {
        attribution: '&copy; <a href="cprp.lolacie.fr/projet/index.php">Calene</a> Lycée JB de BAUDRE - AGEN',
		    id: 'mapbox.ckkmo79ps4iru17ry6o3wvf45',
		    accessToken: 'pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw'
		}).addTo(map);
//paramétrage des différents marqueurs
  var marker_calene = L.marker([44.197667, 0.613604], {
    draggable: true,
    title: "Voiture Calene",
    //icon: yellowIcon,
    icon: caleneIcon,
    autoPan: false,
    opacity: 1
  }).addTo(map);
  marker_calene.bindPopup("Position de la voiture");
  var marker_depart = L.marker(circuit_depart, {
    title: "Départ circuit",
    icon: greyIcon, 
  }).addTo(map);
  marker_depart.bindPopup("Départ de la course");
  var marker_virage1 = L.marker(circuit_virage_1, {
    title: "Virage n°1",
    icon: greyIcon, 
  }).addTo(map);
  marker_virage1.bindPopup("Virage n°1");
  var marker_virage2 = L.marker(circuit_virage_2, {
    title: "Virage n°2",
    icon: greyIcon, 
  }).addTo(map);
  marker_virage2.bindPopup("Virage n°2");
	var circle = L.circle([48.439192, 1.542298], {
    		color: 'red',
    		fillColor: '#f03',
    		fillOpacity: 0.5,
    		radius: 15
		}).addTo(map);
	circle.bindPopup("Circuit SolarCup");
  var popup = L.popup();
  var marker_lire_position = new L.Marker(circuit_calene, {
    draggable:true, 
    title: "Double-clic pour lire lattitude et longitude",
    icon: greenIcon 
  }).on('dblclick', markerOnClick).addTo(map);
  marker_lire_position.bindPopup("Drag and drop pour un nouvel emplacement<BR>Double-clic pour lire lattitude et longitude");
  function markerOnClick(e)
  {
    alert("Lattitude et longitude : " + e.latlng);
  }
	</script>
  </body>
</html>
