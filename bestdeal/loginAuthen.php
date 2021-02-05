<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include('partials/dbcon.php');
    $LoginEmail=$_POST['email'];
    $LoginPassword=$_POST['password'];
    $loginQuery="SELECT * FROM userdb WHERE email = '".$LoginEmail."'";
    $loginResult=mysqli_query($con,$loginQuery);
    $resultNum=mysqli_num_rows($loginResult);
    // echo var_dump($resultNum);
    if($resultNum==1){
        while($row=mysqli_fetch_assoc($loginResult)){
            if($row['email']==$LoginEmail && password_verify($LoginPassword,$row['password'])){
                
                echo 'logged in';
            }
            else{
                header('location:index.php?loginsucess=false');
                echo 'failed to logged in';
                break;
            }
        }
    }
    else{
        header('location:index.php?emaildont=true');

    }
}
?>