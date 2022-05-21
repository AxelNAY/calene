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
    <title>CALENE CHARTRES</title>
    <meta name="viewport" content="initial-scale=1.0 , user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/menu2.css"/>
	<link rel="stylesheet" href="../CALENE_AGEN_fichiers/leaflet.css"/>
	<script src="../CALENE_AGEN_fichiers/leaflet.js"> </script>
	<script src="../CALENE_AGEN_fichiers/jquery-3.2.1.js"> </script>
  <!-- <button id="bouton"> Pour des tests</button> -->
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
		background-color: #6699CC;
      }
    </style>
  <body>
	<?php
	//ajout du menu
	include "menu.html";
	?>
	<div id="map"></div>
	<script>
	//affichage d'une carte du circuit de Chartres via mapbox
	#mapid { height: 180px; }
	var mymap = L.map('mapid').setView([51.505, -0.09], 13);
	L.tileLayer('https://api.mapbox.com/styles/v1/calene/ckko3xf4f5wts17t6c52jnubb/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/ckko3xf4f5wts17t6c52jnubb',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw'
}).addTo(mymap)
	</script>
    <script src="../CALENE_AGEN_fichiers/leaflet-color-markers.js"> </script>
<!--      // blueIcon  redIcon  greenIcon  orangeIcon  yellowIcon  violetIcon  greyIcon  blackIcon -->
    <script src="../CALENE_AGEN_fichiers/markers.js"> </script>
    <script>
      var indice = 0 ;
        //-----------------------------------------------------------------------------
        // récupère la lattitude et la logitude
        // par une requête ajax sur le fichier latt_long.php
        // qui retourne une valeur formatée en json
        //-----------------------------------------------------------------------------
        function requestDatacalene() {
            $.ajax({
//                url: 'latt_long_ajax.php?indice='+indice, 
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
   	var imageicone = '../images/charge.png';
    var imageflag = '../images/flag.png';
    var imagecalene =  '../images/calene.png';
	//attribution de lattitude et de longiture aux différents marqueurs
    var circuit_depart = {lat: 48.440882, lng: 1.540875};
    var circuit_virage_1 = {lat: 48.441444, lng: 1.541390};
    var circuit_virage_2 = {lat: 48.439721, lng: 1.545800};
    var circuit_virage_3 = {lat: 48.436511, lng: 1.543171};
    var circuit_virage_4 = {lat: 48.438298, lng: 1.538601};
    var circuit_rond_point = {lat: 48.439885, lng: 1.539996};
    var circuit_calene = {lat: 48.439192, lng: 1.542298};
    var voiture_calene = {lat: 48.439192, lng: 1.540000};
	//
    var map = L.map('map' , {
    	center:circuit_calene,
    	minZoom: 16,
    	maxZoom:17,
    	zoom: 17,
    	rotation: Math.PI / 3,
    	dragging: false,
    	zoomControl: false
    	});
    L.tileLayer('https://api.mapbox.com/styles/v1/calene/ckko3xf4f5wts17t6c52jnubb/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw', {
        attribution: '&copy; <a href="cprp.lolacie.fr/projet/index.php">Calene</a> Lycée JB de BAUDRE - AGEN',
		    id: 'mapbox.ckko3xf4f5wts17t6c52jnubb',
		    accessToken: 'pk.eyJ1IjoiY2FsZW5lIiwiYSI6ImNra21qa3p2eDJyZWQydm1ucGxoNGU1NnUifQ.Jxkv4Yj-9eoN5HkOFJ6hUw'
		}).addTo(map);
//paramétrage des différents marqueurs
  var marker_calene = L.marker([48.439192, 1.540000], {
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
  var marker_virage3 = L.marker(circuit_virage_3, {
    title: "Virage n°3",
    icon: greyIcon, 
  }).addTo(map);
  marker_virage3.bindPopup("Virage n°3");
  var marker_virage4 = L.marker(circuit_virage_4, {
    title: "Virage n°4",
    icon: greyIcon, 
  }).addTo(map);
  marker_virage4.bindPopup("Virage n°4");
  var marker_rond_point = L.marker(circuit_rond_point, {
    title: "Rond point",
    icon: greyIcon, 
  }).addTo(map);
  marker_rond_point.bindPopup("Rond point");
	var circle = L.circle([48.439192, 1.542298], {
    		color: 'red',
    		fillColor: '#f03',
    		fillOpacity: 0.5,
    		radius: 15
		}).addTo(map);
	circle.bindPopup("Circuit SolarCup");
  var popup = L.popup();
  var marker_lire_position = new L.Marker([48.441273, 1.544341], {
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