<?php
    $serverName= 'localhost';
    $serverUsername='root';
    $serverPassword='';
    $databseName='bestdeal';
    
    $con = mysqli_connect($serverName,$serverUsername,$serverPassword,$databseName);
    if($con->connect_error){
        echo'something went wrong';
    }
    else {
        // echo 'conneted successfully';
    }
?>