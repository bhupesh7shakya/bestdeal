<?php
    $serverName= '127.0.0.1';
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