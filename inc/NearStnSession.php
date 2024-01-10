<?php
    session_start();
    $_SESSION['NearLat']=$_POST['lat'];
    $_SESSION['NearLng']=$_POST['lng'];
    $_SESSION['NearName']=$_POST['name'];

    if(isset($_SESSION['NearLat']) && isset($_SESSION['NearLng']) && isset($_SESSION['NearName'])){
        echo "Done";
    }
?>
