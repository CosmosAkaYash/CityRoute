<?php 
	include("inc/PublicHeader.php");
?>
<div class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Searched Route</h1>
                    <p class="text-white">It shows the Bus and Copordinates by Route</p>
                </div>
            </div>

            <div class="ag-format-container">
                <div class="ag-courses_box">
                    <?php
					if (isset($_SESSION['Destination'])==True):

						$obj->StnName = $_SESSION['Destination'];
						$GetCheckDestination = $obj->CheckDestination();


						if ($GetCheckDestination->num_rows > 0):
							foreach ($GetCheckDestination as $row):
					?>
                    <div class="ag-courses_item">
                        <a href="#" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                <?php echo 'Bus No- '.$row['BusId'].'<br>'; ?>
                            </div>
                            <div class="ag-courses-item_date-box">
                                Bus Station<br>
                                <span class="ag-courses-item_date">
                                    <?php echo $_SESSION['Destination'].'<br>'; ?></span>
                            </div>
                        </a>
                    </div>

                    <?php 	
							$_SESSION['Destination_Lat']=$row['StnLat'];
							$_SESSION['Destination_Lng']=$row['StnLng'];
							endforeach;
						endif;

						if ($GetCheckDestination->num_rows == 0){
							$_SESSION['SearchDestinationFail']=True;
					    	echo "<script>window.location.href = 'index.php'</script>";
						}

					endif; 
					?>

                </div>
            </div>


            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 mx-auto text-center">
                        <div class="intro-wrap">
                            <h1 class="mb-0">Near By Location</h1>
                            <p class="text-white">It show the nearest Bus Stop From your location where you get the bus
                                to reach your destination.</p>
                        </div>
                    </div>

                    <div class="ag-format-container">
                        <div class="ag-courses_box">

                            <?php 
								if(isset($_SESSION['NearLat']) && isset($_SESSION['NearLng']) && isset($_SESSION['NearName'])):
							?>
                            <div class="ag-courses_item">
                                <a href="UserRoute.php" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        <?php echo $_SESSION['NearName'].'<br>'; ?>
                                    </div>
                                    <div class="ag-courses-item_date-box">
                                        <?php echo 'Destination<br>'; ?>
                                        <span class="ag-courses-item_date"> <?php echo $_SESSION['Destination']; ?>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <?php 
								endif;
							?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
					if(isset($_SESSION['Destination'])!=True){

						echo "<div class='row'><div class='col-12'><img src='images/custom/404.png' style='height: 100%; width: 100%; alt='Image'></div></div>";

						echo "</div></div></div>";

						echo "<div class='py-5 cta-section'>
								<div class='container'>
									<div class='row text-center'>
										<div class='col-md-12'>
											<h2 class='mb-2 text-white'>You entered wrong URL or Page isn't available/under construction.</h2>
											<p class='mb-4 lead text-white text-white-opacity'>Really Sorry For inconvenient</p>
											<p class='mb-0'><a href='../CityRoute' class='btn btn-outline-white text-white btn-md font-weight-bold'>Go Back</a></p>
										</div>
									</div>
								</div>
							</div>";
					}
				?>

        </div>
    </div>
</div>
<?php
	if(isset($_SESSION['Destination'])==True){
		include("inc/PublicFooter.php");
	}
	?>