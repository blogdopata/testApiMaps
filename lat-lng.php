<?php 
if (isset($_GET['direccion'])) {
      $direccion = $_GET['direccion'];
      echo " SE ingreso direccion $direccion <br/><br/>";

      $google_maps_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" .urlencode($direccion). "&key=AIzaSyC9DPH7p3q5W7HmTix7PUl01jkzUHhde6Q";
      $google_maps_json = file_get_contents($google_maps_url);
      $google_maps_array = json_decode($google_maps_json,true);


      $lat =$google_maps_array["results"][0]["geometry"]["location"]["lat"];
      $lng =$google_maps_array["results"][0]["geometry"]["location"]["lng"];

      echo "Latitud : $lat <br/ > Longitud: $lng";
    }


 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
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
      }
    </style>
    <script>
      window.moveBy(20,30);
    </script>
  </head>
  <body>

  <form action="" method="GET">
      <label for="direccion">Ingresa direccion</label>
      <input type="text" name="direccion">
      <button type="submit">Consultar</button>

  </form>
<div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
        var punto = {lat: <?php echo $lat ?>, lng: <?php echo $lng ;?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: punto,
          zoom: 15
        });

        var infoWindow = new google.maps.InfoWindow({map: map});
        var marker = new google.maps.Marker({
          position: punto,
          map: map
        });
        
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    </script>
 

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB560clmFAi7MMK3kqmgOKFPZqAGOvKYDo&callback=initMap">
    </script>
  </body>
</html>