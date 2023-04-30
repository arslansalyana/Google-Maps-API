<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My first Google map</title>
  <style>
    #heading {
      text-align: center;
      color: blue;
    }

    #google_map {
      width: 100%;
      height: 520px;
      border: 1px solid blue;
    }
  </style>
</head>

<body>
  <h2 id="heading">My First Google Map</h2>
  <div id="google_map"></div>
  <script>
    function myMap() {
      var mapProp = {
        center: new google.maps.LatLng(33.68, 73.04),
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.HYBRID
      };
      var map = new google.maps.Map(
        document.getElementById("google_map"),
        mapProp
      );

      // Fetch the location points from the PHP script
      fetch("fetch_data.php")
        .then((response) => response.json())
        .then((data) => {
          // Loop through the location points and add markers to the map
          data.forEach((point) => {
            var marker = new google.maps.Marker({
              position: {
                lat: parseFloat(point.lat),
                lng: parseFloat(point.lng)
              },
              map: map,
              title: point.name,
            });

            // Add click listener to marker
            marker.addListener("click", function() {
              // Increase zoom level
              map.setZoom(12);
              // After 5 seconds, set zoom level back to default
              setTimeout(function() {
                map.setZoom(8);
              }, 5000);
            });
          });
        })
        .catch((error) => console.log(error));
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmWvG0umKXjtmkkVN1w9bqBrNihXX3-Rk&callback=myMap" async defer></script>
</body>

</html>