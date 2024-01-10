<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		
	</style>
</head>
<body>

</body>
</html>


<?php 
	require_once("Backend/ClsSelect.php");
	include("inc/PublicHeader.php");
	// SELECT * FROM BusStopData WHERE `StnLat` IN (23.06490, 23.02505) && `StnLng` IN (72.52965, 72.67142);

	$StrStnLat=$_SESSION['NearLat'];
	$StrStnLng=$_SESSION['NearLng'];
	$EndStnLat=$_SESSION['Destination_Lat'];
	$EndStnLng=$_SESSION['Destination_Lng'];


	$obj = new GetAll();
	$obj->BusId = 2;
	$obj->StrStnLat = $StrStnLat;
	$obj->StrStnLng = $StrStnLng;
	$obj->EndStnLat = $EndStnLat;
	$obj->EndStnLng = $EndStnLng;
	$GetBusStnOfSameBus = $obj->GetBusStnOfSameBus();

	$StrEndStnSeq=[];
	if ($GetBusStnOfSameBus->num_rows > 0){
		foreach ($GetBusStnOfSameBus as $row){
			array_push($StrEndStnSeq, $row['StnSeq']);
			$BusId=$row['BusId'];
		}
	}
	else{
		echo "string";
	}
	if ($GetBusStnOfSameBus->num_rows == 0){
	echo count($StrEndStnSeq);
}	
echo $BusId;
print_r($StrEndStnSeq)
?>
<div class="hero">
	<div class="container">
	    <div class="row align-items-center">	
<?php
	if (count($StrEndStnSeq)>1):
		$obj->BusId = $BusId;
		$obj->StrBusStn = $StrEndStnSeq[0];
		$obj->EndBusStn = $StrEndStnSeq[1];
		$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

		if ($GetBusStnOfSameBusInBetween->num_rows > 0):
			foreach ($GetBusStnOfSameBusInBetween as $row):
?>

		<div class="col-3">
			<div class="card_Route work_Route">
		  		<div class="img-section_Route">
		  
		  		</div>
		  		<div class="card-desc_Route">
		  			<div class="card-header_Route">
		  				<div class="card-title_Route"><?php echo $row['StnName']; ?></div>
			  			<div class="card-menu_Route">
			  				<div class="dot"></div>
			  				<div class="dot"></div>
			    			<div class="dot"></div>
			    		</div>
		  			</div>
		  			<div class="card-time_Route">Bus No. <?php echo $row['BusId']; ?>&nbsp;&nbsp;&nbsp;&nbsp;></div>
		  			<!-- <p class="recent_Route">Last Week-36hrs</p> -->
				</div>
			</div>
		</div>

<?php 
			endforeach;
		endif;
	endif;
?>
		</div>
	</div>
</div>