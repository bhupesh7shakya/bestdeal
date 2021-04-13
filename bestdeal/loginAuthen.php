<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('partials/dbcon.php');
    $LoginEmail = $_POST['email'];
    $LoginPassword = $_POST['password'];
    $loginQuery = "SELECT * FROM userdb WHERE email = '" . $LoginEmail . "'";
    $loginResult = mysqli_query($con, $loginQuery);
    if (!$loginResult) {
        echo 'wrong query';
    } else {
        $resultNum = mysqli_num_rows($loginResult);
        // echo var_dump($resultNum);
        if ($resultNum == 1) {
            while ($row = mysqli_fetch_assoc($loginResult)) {
                if (password_verify($LoginPassword, $row['password'])) {
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['email']=$row['email'];
                    if($_SESSION['email']=="admin@admin.com"){
                        header("location:adminsPanel.php");
                    }else{
                        header('location:index.php?loginsuccess=true');
                        echo 'logged in';
                    }

                    
                } else {
                    header('location:index.php?loginsuccess=false');
                    // echo 'failed to logged in wrong password';
                    break;
                }
            }
        } else {
            // echo 'email doest exist';
            header('location:index.php?emaildont=true');

        }
    }
}
