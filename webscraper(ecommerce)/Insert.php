<?php 
    function insert($link,$page,$cate,$source){
        include "partials/dbcon.php";
        if($con){
            $sql="INSERT INTO `scapinglink` (`id`, `url`, `page`, `cate`, `date`, `source`, `user_id`) VALUES (NULL, '$link', '$page', '$cate', current_timestamp(), '$source',1);";
            $result= mysqli_query($con,$sql);
            if($result){
                echo "$cate inserted"; 
            }
        }
        else{
            echo 'No connection !!!!!!!!!! \n';
        }
    }
    $list=array("daraz", "choicemandu", "durbarmart", "muncha", "mynepshop", "sastodeal", "style97", "thulo");
    foreach($list as $l){
        $myfile = fopen("files/$l.txt", "r") or die("Unable to open file!");
    while (!feof($myfile)) {
        $para = fgets($myfile);
        $link = explode(",", $para);
        
        // print_r($link[0] . "," . $link[1] . "," . $link[2] );
    
        insert($link[0],$link[1],$link[2],"$l");
    }
    fclose($myfile);
    }
    
    