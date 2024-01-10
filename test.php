<?php include("inc/PublicHeader.php");  ?>
	<div class="hero">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-8">
					<div class="intro-wrap">
						<h1 class="mb-5"><span class="d-block">Let's Search</span> Your Bus No. <span class="typed-words"></span></h1>
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
										<input type="submit" name="SearchDestination" class="btn btn-primary btn-block" value="Search">
									</div>	

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		
	</div>
<?php include("inc/PublicFooter.php");  ?>