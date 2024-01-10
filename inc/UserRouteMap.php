<!--  -->

<style type="text/css">
	/* CSS style for the marker with border color */
	.custom-marker {
		background-color: #FFFFFF; /* Fill color for the marker (white in this case) */
		border: 2px solid #0000FF; /* Border color for the marker (blue in this case) */
		border-radius: 50%; /* Make the marker a circle by using border-radius */
		width: 10px; /* Width of the marker */
		height: 10px; /* Height of the marker */
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtVIP4UrrDNAvC_tZP9OFzcOH1wNRuUcU&callback=initMap" async defer></script>

<script>
        // Initialize the map and show path with small dots as markers
        function initMap() {
            var mapOptions = {
                center: { lat: 23.04083, lng: 72.58284 }, // Set the initial center of the map
                zoom: 12 // Set the initial zoom level
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Define your fixed multiple latitude and longitude coordinates for the path
            var pathCoordinates = [<?php 
	// SELECT * FROM BusStopData WHERE `StnLat` IN (23.06490, 23.02505) && `StnLng` IN (72.52965, 72.67142);
	

	$StrStnLat=$_SESSION['NearLat'];
	$StrStnLng=$_SESSION['NearLng'];
	$EndStnLat=$_SESSION['Destination_Lat'];
	$EndStnLng=$_SESSION['Destination_Lng'];

	// $StrStnLat=$_SESSION['Destination_Lat'];
	// $StrStnLng=$_SESSION['Destination_Lng'];
	// $EndStnLat=$_SESSION['NearLat'];
	// $EndStnLng=$_SESSION['NearLng'];


	$obj = new GetAll();
	$GetBus = $obj->GetBus();

	if ($GetBus->num_rows > 0){
		foreach ($GetBus as $row){


			$obj->BusId = $row['BusId'];
			$obj->StrStnLat = $StrStnLat;
			$obj->StrStnLng = $StrStnLng;
			$obj->EndStnLat = $EndStnLat;
			$obj->EndStnLng = $EndStnLng;
			$GetBusStnOfSameBus = $obj->GetBusStnOfSameBus();

			$StrEndStnSeq=[];
			if ($GetBusStnOfSameBus->num_rows > 1){
				foreach ($GetBusStnOfSameBus as $row){
					array_push($StrEndStnSeq, $row['StnSeq']);
					$BusId=$row['BusId'];
				}
			}


			if (count($StrEndStnSeq)>1) {
				$obj->TempLat=$StrStnLat;
				$obj->TempLng=$StrStnLng;
				$obj->TempBusId=$BusId;
				$CheckSeqTemp = $obj->CheckSeqTemp();
				if ($CheckSeqTemp->num_rows > 0){
					foreach ($CheckSeqTemp as $row){
						$TempSeq=$row['StnSeq'];
					}
				}
				if($StrEndStnSeq[0]==$TempSeq){
					$_SESSION['ASC_MAP']=True;
				}
				elseif($StrEndStnSeq[1]==$TempSeq){
					$_SESSION['DESC_MAP']=True;
				}
				$obj->BusId = $BusId;
				$obj->StrBusStn = $StrEndStnSeq[0];
				$obj->EndBusStn = $StrEndStnSeq[1];
				$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

				if ($GetBusStnOfSameBusInBetween->num_rows > 0){
					foreach ($GetBusStnOfSameBusInBetween as $row){
                        echo "{ lat: ".$row["StnLat"].", lng: ".$row["StnLng"].", name: '".$row["StnName"]."' },\n";
                    }
                    $_SESSION['StrEndStnSeq']=True;
                }

					
			}
		}
	}	
	
	if (isset($_SESSION['StrEndStnSeq'])!=True) {
		$obj->Latitude = $StrStnLat;
		$obj->Longitude = $StrStnLng;
		$GetStnBus = $obj->GetStnBus();

		$StrStnBusAndSeq=[];
		if ($GetStnBus->num_rows > 0){
			foreach ($GetStnBus as $row){
				array_push($StrStnBusAndSeq, $row['BusId']);
				$StrStnSeq=$row['StnSeq'];
			}
		}

		$EndStnBusAndSeq=[];
		$obj->Latitude = $EndStnLat;
		$obj->Longitude = $EndStnLng;
		$GetStnBus = $obj->GetStnBus();

		if ($GetStnBus->num_rows > 0){
			foreach ($GetStnBus as $row){
				array_push($EndStnBusAndSeq, $row['BusId']);
				$EndStnSeq=$row['StnSeq'];
			}
		}

		foreach($StrStnBusAndSeq as $dataStr){
			foreach($EndStnBusAndSeq as $dataEnd){
				$obj->StrBusId = $dataStr;
				$obj->EndBusId = $dataEnd;
				$GetBusStnOfDiffBus = $obj->GetBusStnOfDiffBus();

				if ($GetBusStnOfDiffBus->num_rows > 0){
					foreach ($GetBusStnOfDiffBus as $row){
						$BusChgStn1Seq=$row["StrStnSeq"];
						$BusChgStn1=$row["StrStnBus"];
						$BusChgStn2Seq=$row["EndStnSeq"];
						$BusChgStn2=$row["EndStnBus"];

					}
				}
				
			}
		}
		if($StrStnSeq<$BusChgStn1Seq && $BusChgStn2Seq<$EndStnSeq){
			$_SESSION['ASC_MAP']=True;


			$obj->BusId = $BusChgStn1;//Bus Id For First Bus Starting Stop where you take bus for first station
			$obj->StrBusStn = $StrStnSeq; // First Starting bus station sequence
			$obj->EndBusStn = $BusChgStn1Seq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

			$smap=$GetBusStnOfSameBusInBetween->num_rows;

			$ChangeCheck=0;

			// echo "<a href='#ChangeRoute'>Your Should Change The station .. To check Click Me</a>";

			if ($GetBusStnOfSameBusInBetween->num_rows > 0){
				foreach ($GetBusStnOfSameBusInBetween as $row){
                    echo "{ lat: ".$row["StnLat"].", lng: ".$row["StnLng"].", name: '".$row["StnName"]."' },\n";
                }
            }

			$obj->BusId = $BusChgStn2;//Bus Id For Second Bus Stop where you Change bus for Destination
			$obj->StrBusStn = $BusChgStn2Seq; // First Starting bus station sequence
			$obj->EndBusStn = $EndStnSeq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();


			
			if ($GetBusStnOfSameBusInBetween->num_rows > 0){
				$skip=0;
				foreach ($GetBusStnOfSameBusInBetween as $row){

					if($skip>0){
                        echo "{ lat: ".$row["StnLat"].", lng: ".$row["StnLng"].", name: '".$row["StnName"]."' },\n";
                    }
                    $skip++;
                }
            }

		}
		elseif($StrStnSeq>$BusChgStn1Seq && $BusChgStn2Seq>$EndStnSeq){
			$_SESSION['DESC_MAP']=True;
			
			$obj->BusId = $BusChgStn1;//Bus Id For Second Bus Stop where you Change bus for Destination
			$obj->StrBusStn = $BusChgStn1Seq; // First Starting bus station sequence
			$obj->EndBusStn = $StrStnSeq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

			$ChangeCheck=0;

			$smap=$GetBusStnOfSameBusInBetween->num_rows;
			// echo $smap.'<br>';

			if ($GetBusStnOfSameBusInBetween->num_rows > 0){
				
				foreach ($GetBusStnOfSameBusInBetween as $row){
                    echo "{ lat: ".$row["StnLat"].", lng: ".$row["StnLng"].", name: '".$row["StnName"]."' },\n";
                }
            }

				

			$obj->BusId = $BusChgStn2;//Bus Id For First Bus Starting Stop where you take bus for first station
			$obj->StrBusStn = $EndStnSeq; // First Starting bus station sequence
			$obj->EndBusStn = $BusChgStn2Seq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

			if ($GetBusStnOfSameBusInBetween->num_rows > 0){
				$skip=0;
				foreach ($GetBusStnOfSameBusInBetween as $row){
					if($skip>0){
                        echo "{ lat: ".$row["StnLat"].", lng: ".$row["StnLng"].", name: '".$row["StnName"]."' },\n";
                    }
                    $skip++;
                }
					
            }


		}


	}
?>];

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

// Show small dots (circles) for each location with a tooltip on hover
var tooltips = []; // Array to store the tooltip instances
var markers = [];

for (var i = 0; i < pathCoordinates.length; i++) {
	

	var marker = new google.maps.Marker({
	   position: pathCoordinates[i],
		map: map,
		icon: {
			path: google.maps.SymbolPath.CIRCLE, // Use a circle as the marker
			scale: 5, // Set the size of the circle (adjust as needed)
			fillColor: '#FFFFFF', // White color for the marker (fill color)
			fillOpacity: 1.0, // Opacity of the marker (0.0 to 1.0)
			strokeWeight: 2, // Border width for the marker
			strokeColor: '#6495ED' // Blue color for the marker (border color)
		},
		title: pathCoordinates[i].name // Set the location name as the tooltip
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
// Show your current location on the map
		if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentPosition = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var currentLocationMarker = new google.maps.Marker({
                        position: currentPosition,
                        map: map,
                        title: 'Your Current Location'
                    });

                    // Center the map on your current location
                    
                });
            }

}
</script>

<div id="map" class="mapFluid" style="height: 500px; z-index: 0;"></div>
