<?php
$exitsuser = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $c_email = $_POST['c_email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    if ($email == $c_email && $password == $c_password) {
        include('partials\dbcon.php');
        $checkQuery = "SELECT * FROM userdb";
        $checkResult = mysqli_query($con, $checkQuery);
        while ($row = mysqli_fetch_assoc($checkResult)) {
            if ($row['email'] == $email) {
                $exitsuser = true;
            }
        }
        if ($exitsuser) {
            header('location:index.php?userexists=true');
        } else {
            $encrytPass = password_hash($password, PASSWORD_DEFAULT);
            $Createquery = "INSERT INTO `userdb` ( `email`, `password`, `created_date`) VALUES ('" . $email . "', '" . $encrytPass . "', current_timestamp());";
            $CreateResult = mysqli_query($con, $Createquery);
            if ($CreateResult) {
                header('location:index.php?accountCreated=true');
            } else {
                header('location:index.php?accountCreated=false');
            }
        }
    } if($email ==null && $password==null) {
        header('location:index.php?up=false');

    }
}
