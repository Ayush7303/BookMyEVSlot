<!DOCTYPE html>
<html lang="en">
<head>
<?php
include "conn.php";
include "header.php";

if(isset($_POST['bookslot']))
{
    echo $_POST['time-value'];
}
?>
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/clientindex.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<script src="assets/js/jQuery.js"></script>
    <script src="assets/js/index.js"></script>

</head>

<body oncontextmenu="return false">

<div>
    <div class="mapContainer">
        <div id="mapCanvas" class="Canvas"></div>
        <div class="Canvas main"></div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>
  var map = L.map('mapCanvas').setView([21.1702, 72.8311], 13);

var osm=L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
osm.addTo(map);
// L.marker([$lat,$lon]).bindPopup($desc).addTo(map);
var myIcon = L.icon({
    iconUrl: 'assets/icons/evmark.png',
    iconSize: [40, 60],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
 
});

<?php
            $query = mysqli_query($con,"select * from stationtb");
            while ($data = mysqli_fetch_array($query))
            {
                $stationid = $data['stationid'];
                $desc = $data['location'];
                $lat = $data['latitude'];
                $lon = $data['longitude'];

                $main_div = '<div class="main-box">';
                $station_details = '<div class="station-details">';
                $station_data = '<div class="station-data">';
                $station_name = '<div class="station-name">';
                $h2 = "<h2>{$data['stationname']}</h2>";
                $sstation_name = '</div>';

                if($data['available']==1)
                {
                    $station_available = '<div class="station-available">';
                }
                else if($data['available']==0)
                {
                    $station_available = '<div class="station-unavailable">';
                }
                
                $circle = '<div class="circle"></div>';
                $sstation_available = '</div>';
                $sstation_data = '</div>';
                $hr = '<hr class="center-line">';
                $book_btn = '<div class="show-slot-btn">';
                if($data['available']==1)
                {
                $button = '<button onclick="showSlots('.$stationid.');">Show Slots</button>';
                }
                else{
                $button = '<button disabled>Show Slots</button>';
                }


                // $button = '<button onclick="showSlots('.$stationid.');">Show Slots</button>';
                $sbook_btn = '</div>';
                $sstation_details = '</div>';
                $smain_div = '</div>';

                echo ("var m = L.marker([$lat, $lon],{icon: myIcon}); m.bindPopup('$main_div $station_details $station_data $station_name $h2 $sstation_name $station_available $circle $sstation_available $sstation_data $hr $book_btn $button $sbook_btn $sstation_details $smain_div').openPopup(); m.addTo(map);");
                // echo ("var m = L.marker([$lat, $lon],{icon: myIcon}); m.bindPopup('$div').openPopup(); m.addTo(map);");
                // echo("L.marker([$lat,$lon],{icon: myIcon}).bindPopup($desc).openPopup().addTo(map);");
            }
          ?>

googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
});
googleHybrid.addTo(map);

navigator.geolocation.watchPosition(success,error);
function success(pos){
    const lat=pos.coords.latitude;
    const lng=pos.coords.longitude;
    const accuracy=pos.coords.accuracy;
//    L.marker([lat,lng],{icon: myIcon2}).addTo(map);
   L.marker([lat,lng]).addTo(map);

  //L.circle([lat,lng],{radius:accuracy}).addTo(map);
}
function error(err)
{
    if(err.code==1)
    {
        alert("please allow geaolocation access.");
    }
    else{
        alert("connot get current location.");
    }
}
// var maplayout = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
// 	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
// 	subdomains: 'abcd',
// 	maxZoom: 20
// });
// maplayout.addTo(map);


// googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
//     maxZoom: 20,
//     subdomains:['mt0','mt1','mt2','mt3']
// });
  </script>
  </body>
</html>
  


 