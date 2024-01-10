<?php include("inc/PublicHeader.php"); ?>



<?php 
	session_destroy();
	if (isset($_SESSION['SearchDestinationFail'])==True) {
		echo '<script>alert("Select Station From Listed Suggestions!!!!!");</script>';
		unset($_SESSION['SearchDestinationFail']);
	}
?>


<div class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="intro-wrap">
                    <h1 class="mb-5"><span class="d-block">Let's Search</span> Your Bus No. <span
                            class="typed-words"></span></h1>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <form class="form" id="form" method="post" action="inc/NearStnLocation.php">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <input type="text" id="input" name="Destination" class="form-control" required>
                                </div>
                                <ul class="list-search"></ul>
                            </div><br>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <input type="submit" name="SearchDestination" class="btn btn-primary btn-block"
                                        value="Search">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <?php include("inc/AllRouteMap.php"); ?>
            </div>
        </div>

    </div>

</div>

<!-- Details Count -->
<?php         
	    
	    $GetBusStnCount = $obj->GetBusStnCount();

	    if ($GetBusStnCount->num_rows > 0) {
			foreach ($GetBusStnCount as $row) {
				$TotalStn=$row['CountStnId'];
			}
	    }

	    $GetBusCount = $obj->GetBusCount();

	    if ($GetBusCount->num_rows > 0) {
			foreach ($GetBusCount as $row) {
				$TotalBus=$row['CountBusId'];
			}
	    }
	?>

<div class="untree_co-section count-numbers py-5">
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="" data-number="<?php echo $TotalStn; ?>">0</span>
                    </div>
                    <span class="caption">No. of Bus Stops around the city</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="" data-number="<?php echo $TotalBus; ?>">0</span>
                    </div>
                    <span class="caption">No. of Bus Exists</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="" data-number="<?php echo $TotalBus*2; ?>">0</span>
                    </div>
                    <span class="caption">No. of Route</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SELECT `BusId`, `StrStnName`, `StrStnLatLng`, `EndStnName`, `EndStnLatLng`, `SubCatStatus`, `ActiveStatus` FROM `Bus` WHERE 1 -->



<div class="untree_co-section">
    <div class="container">
        <div class="row text-center justify-content-center mb-5">
            <div class="col-lg-7">
                <h2 class="section-title text-center">Popular Destination</h2>
            </div>
        </div>

        <div class="owl-carousel owl-3-slider">

            <?php         
	    
				    $GetBus = $obj->GetBus();
				    if ($GetBus->num_rows > 0):
						foreach ($GetBus as $row):
				?>
            <div class="item">
                <a class="media-thumb" href="#">
                    <div class="media-text">
                        <h3>Bus No. <?php echo $row['BusId']; ?></h3>
                        <span class="location"><?php echo $row['StrStnName']." - ".$row['EndStnName']; ?></span>
                    </div>
                    <img src="images/custom/PublicLocation.png" alt="Image" style="margin-top: 100px;">
                </a>
            </div>
            <?php
						endforeach;
                	endif;
				?>

        </div>

    </div>
</div>



<?php include("inc/PublicFooter.php"); ?>