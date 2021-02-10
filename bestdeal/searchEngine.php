<?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $Search_query=$_POST['search']; 
        if($Search_query!=null){
            header('location:searchResult.php?q='.$Search_query);
        }
        else{
            echo 'null input';
            header('location:index.php');
        }
    }
?>