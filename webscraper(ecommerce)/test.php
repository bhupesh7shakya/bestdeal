<?php 
function getMiddle($text){
    $string=str_split($text);
    // print_r($string);
     $length=sizeof($string);
    if(($length)%2==1){
        $index=$length/2;
       return $string[$index-0.5];
        // echo $length;
       
    }else{
        $index=$length/2;
        return $string[$index-1].$string[$index] ;
        
    }
}
getMiddle("test");
getMiddle("testing");
