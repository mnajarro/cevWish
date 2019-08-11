<!DOCTYPE html>
<html lang="en">
<head>
  <title>Platform Registration Form </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>
   <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"
  integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q=="
  crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
</head>

<body>

<div class="container">
<div class="row">
    <div class="col-xs-6">
        <img src="img/CEV_Logo.png" width="317" height="93" alt="CEV_Logo"/>

    </div>

    </div>
  <h2> Platform Registration Form </h2>
  <p>Please complete the following form:</p>
  <?php
  session_start();

  if(isset($_SESSION["dupcheck"])){
    if ($_SESSION["dupcheck"]=='success'){
    ?>

      <div class="alert alert-success" role="alert" id="alertdisplay"> Form Submitted Successfully </div>

    <?php
      $_SESSION["dupcheck"]='none';
      header( "refresh:4;" );
    }elseif($_SESSION["dupcheck"]=='duplicate'){
    ?>

      <div class="alert alert-danger" role="alert" id="alertdisplay"> Error: An Organization is already using these Latitude and Longitude coordinates. Please change the coordinates. </div>
    <?php
        $_SESSION["dupcheck"]='none';
    }else{

    }
  }
      if(isset($_SESSION["euroCheck"])){
        if ($_SESSION["euroCheck"]=='notContained'){
          echo '<div class="alert alert-danger" role="alert" id="euroalertdisplay"> Error: Check that your Latitude and Longitude coodinates are correct. </div>';
          $_SESSION["euroCheck"]='none'; 
        }
      }else{
        $_SESSION["eurocheck"]='none';
      }
    ?>
  <form action="db/dbscript.php" method="POST" role="form">
        <div class="form-group">
          <label for="OrgName">* Organization Name:</label>
          <input type="text" class="form-control" id="OrgName" name="OrgName" required>
        </div>
        <div class="form-group">
          <label for="Description">* Description:</label>
          <textarea class="form-control" id="descr" name="descr" rows="5" maxlength="1500" placeholder ="Enter description (for public website). Limit to 1,500 characters. "required></textarea>
        </div>
        <div class="form-group">
          <label for="email">* Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter a valid email address: e.g. sample@sample.com" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel"  class="form-control" id="tel" name="tel" placeholder="Enter country code and area code followed by phone number: e.g. +32-2-511-75-01">
        </div>
        <div class="form-group ">
          <label for="sel2">* Services Offered:</label>
          <p> Please select the services offered by your organization. <label>
          <div id="servicesval"></div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "hospitality" name = "sel2[]" value="Hospitality">Hospitality</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "languages" name = "sel2[]" value="Languages">Languages</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "legal" name = "sel2[]" value="Legal/Admin">Legal/Admin</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "social" name = "sel2[]" value="Social Life">Social Life</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "labour" name = "sel2[]" value="Labour Market">Labour Market</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "education" name = "sel2[]" value="Education (Homework Help)">Education (Homework Help)</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "health" name = "sel2[]" value="Health Care">Health Care</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "gender" name = "sel2[]" value="Gender Issues">Gender Issues</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "lgbtq" name = "sel2[]" value="LGBTQ">LGBTQ</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "psych" name = "sel2[]" value="Psychological Assistance">Psychological Assistance</label>
          </div>
          <div class = "checkbox">
            <label><input type="checkbox" id = "sos" name = "sel2[]" value="SOS">SOS</label>
          </div>

        </div>
        <div class="form-group">
            <label for="website">* Website:</label>
            <input type="text" class="form-control" id="website" name="website" placeholder = "e.g. http://www.example.org" required>
        </div>
        <div class="form-group">
            <label for="Address">* Street Address:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="e.g. Rue d'Edimbourg 26" required>
        </div>
        <div class="form-group">
            <label for="City">* City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder = "e.g. Brussels" required>
        </div>
        <div class="form-group">
          <label for="Province">State/Province:</label>
          <input type="text" class="form-control" id="prov" name="prov" placeholder ="e.g. Bruxelles-Capitale" >
        </div>
        <div class="form-group">
          <label for="Country">* Country:</label>
          <input type="text" class="form-control" id="country" name="country" placeholder ="e.g. Belgium" required>
        </div>
        <div class="form-group">
          <label for="Postal_Code">Postal Code:</label>
          <input type="text" class="form-control" id="postal" name="postal" placeholder ="e.g. 1050">
        </div>
            <div class="form-group">
              <input id="search-btn" type="button" value="Get Lat & Long" class="btn btn-success">
              <span id="search-txt"> </span>

            </div>
        <div id="coordserror"></div>
        <div class="form-group">
          <label for="Latitude">* Latitude:</label>
          <input type="number" step="any" class="form-control" id="lat" name="lat" placeholder = "e.g. 50.837894" required>
        </div>
        <div class="form-group">
          <label for="Longitude">* Longitude:</label>
          <input type="number" step="any" class="form-control" id="long" name="long" placeholder ="e.g. 4.364322" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Submit" class="btn btn-primary btn-lg" id="submit-btn">
        </div>
 </form>
    <div>
        <p id="instructions">  </p>
    </div>
</div>

<div class="container">
  <div class="row">
    <div id="mapid"></div>
    <div id="map-output"></div>
  </div>
</div>
<script type="text/javascript">

    $('#submit-btn').click(function(e) {

      checked = $("input[type=checkbox]:checked").length;

      if(checked == 0) {
        var services_el = document.getElementById("servicesval");
        services_el.innerHTML = "<div class='alert alert-danger'><strong>Error:</strong> Please select at least one service.</div>";
        services_el.scrollIntoView();
        e.preventDefault();
      }
      else{
       $("input[type=checkbox]").prop('required',false);
      }
      //Verify that Latitude coordinates are between -90 and 90 degrees
      var latVal = $("#lat").val();
      var services_el = document.getElementById("coordserror");
      if (latVal.length > 0){
        if(latVal < -90 || latVal > 90){
          services_el.innerHTML = "<div class='alert alert-danger'><strong>Error:</strong> Your Latitude value is not correct. It must between -90 and 90.</div>";
          services_el.scrollIntoView();
          e.preventDefault();
        }
      }
      //Verify that Latitude coordinates are between -180 and 180 degrees
      var longVal = $('#long').val();
      if (longVal.length > 0){
        if(longVal < -180 || longVal > 180){
          services_el.innerHTML = "<div class='alert alert-danger'><strong>Error:</strong> Your longitude value is not correct. It must between -180 and 180.</div>";
          services_el.scrollIntoView();
          e.preventDefault();
        }
      }

    });

 		/*
		 * Google Maps: Latitude-Longitude Finder Tool
		 * https://salman-w.blogspot.com/2009/03/latitude-longitude-finder-tool.html
		 */
      function loadmap() {
			// initialize map
			var map = new google.maps.Map(document.getElementById("mapid"), {
				center: new google.maps.LatLng(50.837894, 4.364322),
				zoom: 13,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
      function listen(marker){
    			// intercept map and marker movements
    			google.maps.event.addListener(map, "idle", function() {
    				document.getElementById("lat").value = marker.getPosition().lat().toFixed(6);
                                document.getElementById("long").value = marker.getPosition().lng().toFixed(6);
     			});
    			google.maps.event.addListener(marker, "dragend", function(mapEvent) {
    				map.panTo(mapEvent.latLng);

    			});
      };
			// initialize geocoder
			var geocoder = new google.maps.Geocoder();
      google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function() {

          var get_address = document.getElementById("address").value + ", " + document.getElementById("city").value
                  + document.getElementById("prov").value + ", " + document.getElementById("country").value + ", " + document.getElementById("postal").value;

				geocoder.geocode({ address: get_address }, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var result = results[0];
            // initialize marker
      			var marker = new google.maps.Marker({
      				position: result.geometry.location,
      				draggable: true,
      				map: map
      			});
            listen(marker);
						document.getElementById("search-txt").innerHTML = result.formatted_address;
                                                document.getElementById("instructions").innerHTML = "Tip: If the marker displayed is not accurate, click and drag the marker to the correct location."
						if (result.geometry.viewport) {
							map.fitBounds(result.geometry.viewport);
						} else {
							map.setCenter(result.geometry.location);
						}
  					} else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
  						      alert("Sorry, geocoder API failed to locate the address.");
  					} else {
  						      alert("Sorry, geocoder API failed with an error.");
  					}
				});
			});
			google.maps.event.addDomListener(document.getElementById("search-txt"), "keydown", function(domEvent) {
				if (domEvent.which === 13 || domEvent.keyCode === 13) {
					google.maps.event.trigger(document.getElementById("search-btn"), "click");
				}
			});
			// initialize geolocation */
		}
	</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjI0FT_Ja_Adp_M5h1o4nbnKD2Gy-hxXU&callback=loadmap"
    async defer></script>
</body>
</html>
