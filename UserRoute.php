<?php include("inc/PublicHeader.php");  ?>

<div class="hero hero-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Near By Location</h1>
                    <p class="text-white">It show the nearest Bus Stop From your location where you get the bus to reach
                        your destination.</p>
                </div>
            </div>
			
        </div>
		<div class="row align-items-center">
			<div class="col-12">
				<?php include("inc/UserRouteMap.php"); ?>
			</div>
		</div>
    </div>
</div>


<div class="container">
    <div class="row">
        <?php 
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
					$_SESSION['ASC']=True;
				}
				elseif($StrEndStnSeq[1]==$TempSeq){
					$_SESSION['DESC']=True;
				}
				$obj->BusId = $BusId;
				$obj->StrBusStn = $StrEndStnSeq[0];
				$obj->EndBusStn = $StrEndStnSeq[1];
				$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

				if ($GetBusStnOfSameBusInBetween->num_rows > 0):
					foreach ($GetBusStnOfSameBusInBetween as $row):

?>
        <div class="col-3" id="routeStn">
            <div class="card-route">
                <h3 class="card__title-route">Bus No. <?php echo $row['BusId']; ?>
                </h3>
                <!-- <p class="card__content-route">Bus No. <?php echo 'ChangeCheck'; ?></p>  -->

                <div class="card__date-route">
                    <?php echo $row['StnName']; ?>
                </div>
                <div class="card__arrow-route">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff"
                            d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <?php
					endforeach;
					$_SESSION['StrEndStnSeq']=True;
				endif;
					
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

	// echo '<br><br>';

	//First Bus
	// echo 'First Bus- '.$BusChgStn1.'<br>';

	//First Starting stop
	// echo 'First Starting stop- '.$StrStnSeq.'<br>';

	//First Ending stop
	// echo 'First Ending stop- '.$BusChgStn1Seq.'<br>';

	//Second Bus
	// echo 'Second Bus- '.$BusChgStn2.'<br>';

	//Second Starting stop
	// echo 'Second Starting stop- '.$BusChgStn2Seq.'<br>';

	//Second Ending stop
	// echo 'Second Ending stop- '.$EndStnSeq.'<br>';

	
		if($StrStnSeq<$BusChgStn1Seq && $BusChgStn2Seq<$EndStnSeq){
			$_SESSION['ASC']=True;


			$obj->BusId = $BusChgStn1;//Bus Id For First Bus Starting Stop where you take bus for first station
			$obj->StrBusStn = $StrStnSeq; // First Starting bus station sequence
			$obj->EndBusStn = $BusChgStn1Seq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

			$smap=$GetBusStnOfSameBusInBetween->num_rows;

			$ChangeCheck=0;

			// echo "<a href='#ChangeRoute'>Your Should Change The station .. To check Click Me</a>";

			if ($GetBusStnOfSameBusInBetween->num_rows > 0):
				foreach ($GetBusStnOfSameBusInBetween as $row):
					$ChangeCheck++;
?>
        <div class="col-3" id="routeStn">
            <div class="card-route">
                <h3 class="card__title-route">Bus No. <?php echo $row['BusId']; ?>
                    <?php if($smap==$ChangeCheck):?>
                    <font id="ChangeRoute">Swap -> </font><?php echo $BusChgStn2;?>
                    <?php endif; ?>
                </h3>
                <!-- <p class="card__content-route">Bus No. <?php echo 'ChangeCheck'; ?></p>  -->

                <div class="card__date-route">
                    <?php echo $row['StnName']; ?>
                </div>
                <div class="card__arrow-route">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff"
                            d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <?php

					
				endforeach;
			endif;


			$obj->BusId = $BusChgStn2;//Bus Id For Second Bus Stop where you Change bus for Destination
			$obj->StrBusStn = $BusChgStn2Seq; // First Starting bus station sequence
			$obj->EndBusStn = $EndStnSeq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();


			
			if ($GetBusStnOfSameBusInBetween->num_rows > 0):
				$skip=0;
				foreach ($GetBusStnOfSameBusInBetween as $row):
					
					if($skip>0):
?>
        <div class="col-3" id="routeStn">
            <div class="card-route">
                <h3 class="card__title-route">Bus No. <?php echo $row['BusId']; ?>
                </h3>
                <!-- <p class="card__content-route">Bus No. <?php echo $row['StnName']; ?></p> -->
                <div class="card__date-route">
                    <?php echo $row['StnName']; ?>
                </div>
                <div class="card__arrow-route">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff"
                            d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <?php
					endif;
					$skip++;

				endforeach;
			endif;

		}
		elseif($StrStnSeq>$BusChgStn1Seq && $BusChgStn2Seq>$EndStnSeq){
			$_SESSION['DESC']=True;

			
			
			$obj->BusId = $BusChgStn1;//Bus Id For Second Bus Stop where you Change bus for Destination
			$obj->StrBusStn = $BusChgStn1Seq; // First Starting bus station sequence
			$obj->EndBusStn = $StrStnSeq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

			$ChangeCheck=0;

			$smap=$GetBusStnOfSameBusInBetween->num_rows;
			// echo $smap.'<br>';

			if ($GetBusStnOfSameBusInBetween->num_rows > 0):
				
				foreach ($GetBusStnOfSameBusInBetween as $row):
					$ChangeCheck++;

?>
        <div class="col-3" id="routeStn">
            <div class="card-route">
                <h3 class="card__title-route">Bus No. <?php echo $row['BusId']; ?>
                    <?php if($smap==$ChangeCheck):?>
                    <font id="ChangeRoute">Swap -> </font><?php echo $BusChgStn2;?>
                    <?php endif; ?>
                </h3>
                <!-- <p class="card__content-route">Bus No. <?php echo 'ChangeCheck'; ?></p>  -->

                <div class="card__date-route">
                    <?php echo $row['StnName']; ?>
                </div>
                <div class="card__arrow-route">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff"
                            d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <?php
	
				endforeach;
			endif;

				

			$obj->BusId = $BusChgStn2;//Bus Id For First Bus Starting Stop where you take bus for first station
			$obj->StrBusStn = $EndStnSeq; // First Starting bus station sequence
			$obj->EndBusStn = $BusChgStn2Seq;// First Ending bus station sequence
			$GetBusStnOfSameBusInBetween = $obj->GetBusStnOfSameBusInBetween();

			if ($GetBusStnOfSameBusInBetween->num_rows > 0):
				$skip=0;
				foreach ($GetBusStnOfSameBusInBetween as $row):
					if($skip>0):


?>
        <div class="col-3" id="routeStn">
            <div class="card-route">
                <h3 class="card__title-route">Bus No. <?php echo $row['BusId']; ?>
                </h3>
                <!-- <p class="card__content-route">Bus No. <?php echo $row['StnName']; ?></p> -->
                <div class="card__date-route">
                    <?php echo $row['StnName']; ?>
                </div>
                <div class="card__arrow-route">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff"
                            d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <?php
					endif;
					$skip++;
				endforeach;
			endif;


		}


	}
?>

    </div>
</div>

<?php 

if(isset($_SESSION['ASC'])==True){
	echo 'ASC';
}	
elseif(isset($_SESSION['DESC'])==True){
	echo 'DESC';
}

?>

<?php include("inc/PublicFooter.php");  ?>