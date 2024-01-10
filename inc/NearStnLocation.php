<?php require_once("../backend/ClsSelect.php"); ?>
<style type="text/css">
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtVIP4UrrDNAvC_tZP9OFzcOH1wNRuUcU&callback=initMap" async defer></script>

<?php 
    session_start();
?>

    <?php

        if(isset($_GET['lat'])==true && isset($_GET['lng'])==true && isset($_GET['name'])==true){
            $_SESSION['NearLat']=$_GET['lat'];
            $_SESSION['NearLng']=$_GET['lng'];
            $_SESSION['NearName']=$_GET['name'];
         
        }
        if(isset($_SESSION['NearLat'])==True && isset($_SESSION['NearLng'])==True && isset($_SESSION['NearName'])==True){
            header("location: ../SearchRoute.php");
        }

        if(isset($_SESSION['NearLat'])!=True && isset($_SESSION['NearLng'])!=True && isset($_SESSION['NearName'])!=True): 
            $_SESSION['Destination']=$_POST['Destination'];
    ?>
 <script>
        // Initialize the map and find the nearest location
        function initMap() {
            var mapOptions = {
                zoom: 12 // Set the initial zoom level
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Get the user's current location using the Geolocation API
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLatLng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Define your data of latitude and longitude for locations
                    var locations = [<?php 
                            $obj = new GetAll();
                            $GetBusStnAll = $obj->GetBusStnAll();

                            if ($GetBusStnAll->num_rows > 0){
                                foreach ($GetBusStnAll as $rowBusStn){
                                    echo "{ lat: ".$rowBusStn["StnLat"].", lng: ".$rowBusStn["StnLng"].", name: '".$rowBusStn["StnName"]."' },\n";
                                }
                            }
                        ?>
                    ];

                    // Calculate the distance between the user's location and each location
                    var nearestLocation;
                    var nearestDistance = Number.MAX_VALUE;

                    for (var i = 0; i < locations.length; i++) {
                        var location = locations[i];
                        var distance = getDistance(userLatLng, location);

                        if (distance < nearestDistance) {
                            nearestLocation = location;
                            nearestDistance = distance;
                        }
                    }

                    // Display the user's location and the nearest location on the map
                    var userMarker = new google.maps.Marker({
                        position: userLatLng,
                        map: map,
                        title: 'Your Location'
                    });

                    var nearestMarker = new google.maps.Marker({
                        position: nearestLocation,
                        map: map,
                        title: nearestLocation.name
                    });

                    // Center the map to fit both markers
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(userMarker.getPosition());
                    bounds.extend(nearestMarker.getPosition());
                    map.fitBounds(bounds);

                    // Display the nearest location information in PHP File session
                   
                    // console.log(nearestLocation);

                    // $.ajax({
                    //     url:"NearStnSession.php",
                    //     method: "post",
                    //     data:nearestLocation,
                    //     success: function(res){
                    //         console.log(res);
                    //     }
                    // })


                    window.location.href = "NearStnLocation.php?lat=" + encodeURIComponent(nearestLocation.lat) + "&lng=" + encodeURIComponent(nearestLocation.lng) +"&name=" + encodeURIComponent(nearestLocation.name);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        // Function to calculate the distance between two points using the Haversine formula
        function getDistance(point1, point2) {
            var rad = function(x) {
                return x * Math.PI / 180;
            };
            var R = 6371; // Earth's radius in km
            var dLat = rad(point2.lat - point1.lat);
            var dLng = rad(point2.lng - point1.lng);
            var a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(point1.lat)) * Math.cos(rad(point2.lat)) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var distance = R * c;
            return distance;
        }
    </script>   
    <?php endif; ?>
    <div id="map" hidden></div>


