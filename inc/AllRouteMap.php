<style type="text/css">
/* CSS style for the marker with border color */
.custom-marker {
    background-color: #FFFFFF; /* Fill color for the marker (white in this case) */
    border: 2px solid #0000FF; /* Border color for the marker (blue in this case) */
    border-radius: 50%; /* Make the marker a circle by using border-radius */
    width: 10px; /* Width of the marker */
    height: 10px; /* Height of the marker */
}
.mapFluid{
	top:50px;
	width: 100%;
	border-radius: 15px;
}
#form{
	z-index: 0;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtVIP4UrrDNAvC_tZP9OFzcOH1wNRuUcU&callback=initMap" async defer></script>
<script>
// Initialize the map and show multiple paths with small dots as markers
function initMap() {
    var mapOptions = {
        center: { lat: 23.04083, lng: 72.58284 }, // Set the initial center of the map
        zoom: 12 // Set the initial zoom level
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Define your multiple paths with fixed latitude and longitude coordinates
    var paths = [<?php 
    		$obj = new GetAll();

    		$GetBus = $obj->GetBus();
		    if ($GetBus->num_rows > 0){
				foreach ($GetBus as $row){
					echo "[";
    	
		    		$obj->BusId = $row['BusId'];
		    		$GetBusStn = $obj->GetBusStn();

		    		if ($GetBusStn->num_rows > 0){
						foreach ($GetBusStn as $rowBusStn){
							echo "{ lat: ".$rowBusStn["StnLat"].", lng: ".$rowBusStn["StnLng"].", name: '".$rowBusStn["StnName"]."' },\n";
						}
		    		}
		    		echo "],";
        		}
        	}
        ?>
        // Add more paths as needed
    ];

    // Loop through each path and draw it on the map
    for (var i = 0; i < paths.length; i++) {
        var pathCoordinates = paths[i];

        // Create a Polyline object to draw the path on the map
        var path = new google.maps.Polyline({
            path: pathCoordinates,
            geodesic: true,
            strokeColor: '#4169E1', // Color of the path (red in this case)
            strokeOpacity: 1.0,
            strokeWeight: 5
        });

        // Set the Polyline on the map
        path.setMap(map);

        // Show small dots (customized with border color) for each location with a tooltip on hover
        var markers = [];
        var tooltips = [];  // Array to store the marker instances

        for (var j = 0; j < pathCoordinates.length; j++) {
            var marker = new google.maps.Marker({
                position: pathCoordinates[j],
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE, // Use a circle as the marker
                    scale: 5, // Set the size of the circle (adjust as needed)
                    fillColor: '#FFFFFF', // White color for the marker (fill color)
                    fillOpacity: 1.0, // Opacity of the marker (0.0 to 1.0)
                    strokeWeight: 2, // Border width for the marker
                    strokeColor: '#6495ED' // Blue color for the marker (border color)
                },
                title: pathCoordinates[j].name // Set the location name as the tooltip
            });

            // Add event listeners to show and hide the tooltip on hover
             google.maps.event.addListener(marker, 'mouseover', function() {
                var tooltip = new google.maps.InfoWindow({
                    content: this.getTitle() // Get the location name from the marker's title
                });
                tooltip.open(map, this);
                tooltips.push(tooltip); // Add tooltip instance to the array
            });

            google.maps.event.addListener(marker, 'mouseout', function() {
                // Close all the tooltips in the array
                for (var i = 0; i < tooltips.length; i++) {
                    tooltips[i].close();
                }
                tooltips = []; // Empty the array
            });

            
        }
    }
}
</script>

<div id="map" class="mapFluid" style="height: 650px; z-index: 0;"></div>