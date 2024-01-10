<?php 
	require_once("ClsSelect.php");
	session_start();

	include("../inc/PublicHeader.php");
	if (isset($_POST['SearchDestination'])==True) {
		$Destination=$_POST['Destination'];
	

		$obj = new GetAll();
		$obj->StnName = $Destination;
		$GetCheckDestination = $obj->CheckDestination();


		if ($GetCheckDestination->num_rows > 0) {
			foreach ($GetCheckDestination as $row) {
				echo $row['StnName'];
			}
	    }else{
	    	$_SESSION['SearchDestinationFail']=True;
	    	header('Location: ../index.php');
	    }
	}
	else{
		echo 'Sorry';
	}
	include("../inc/PublicFooter.php");
	
	

?>