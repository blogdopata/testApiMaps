<?php 
	$direccion="";
	$API_KEY = "AIzaSyB560clmFAi7MMK3kqmgOKFPZqAGOvKYDo";

	if(isset($_GET['direccion'])){
		$direccion = $_GET['direccion'];
		echo " se ingreso 1 direccion: " . $direccion;
		$google_maps_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" .urlencode($direccion). "&key=".$API_KEY;
		
	
		$google_maps_json = file_get_contents($google_maps_url);
		$google_maps_array = json_decode($google_maps_json, true);


		$lat = $google_maps_array["results"][0]["geometry"]["location"]["lat"];	

		$lng= $google_maps_array["results"][0]["geometry"]["location"]["lng"];	
		
	}else{
		
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>API MAPS</title>

	 <style>
       #map {
        height: 400px;
      width: 800px;
       }
    </style>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">	
		<div class="row" style="border:1px solid red">
			<section class="col-md-3">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
				<label for="direccion">Direccion:</label>
				<input type="text" name="direccion">
				<button type="submit"> Enviar</button>
			</form>
			</section>
			<section class="col-md-9">
				 <div id="map"></div>

			</section>
		</div>
	</div>	

	<script>
      function initMap() {
        var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB560clmFAi7MMK3kqmgOKFPZqAGOvKYDo&callback=initMap">
    </script>


</body>
</html>