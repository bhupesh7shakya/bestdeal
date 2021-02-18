<?php
// making  existuser as false as default
$exitsuser = false;
// checking if the method is post or not
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // storing data from the form
    $email = $_POST['email'];
    $c_email = $_POST['c_email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    // checking email and password are equal or not
    if ($email == $c_email && $password == $c_password) {
        // if both email and password are equal 
        // it connects to database
        include('partials\dbcon.php');
        // checking if the user exits or not it is true then it returns trure
        $checkQuery = "SELECT * FROM userdb";
        $checkResult = mysqli_query($con, $checkQuery);
        while ($row = mysqli_fetch_assoc($checkResult)) {
            if ($row['email'] == $email) {
                $exitsuser = true;
            }
        }
        // if the useremail alereadu exits it redirects to userexits=true
        if ($exitsuser) {
            header('location:index.php?userexists=true');
        } 
        // encrypting the password and inserting the database
        else {
            $encrytPass = password_hash($password, PASSWORD_DEFAULT);
            $Createquery = "INSERT INTO `userdb` ( `email`, `password`, `created_date`) VALUES ('" . $email . "', '" . $encrytPass . "', current_timestamp());";
            $CreateResult = mysqli_query($con, $Createquery);
            if ($CreateResult) {
                header('location:index.php?accountCreated=true');
            } else {
                mysqli_error($CreateResult);
                // header('location:index.php?accountCreated=false');
            }
        }
    }
    // if the the emnail or password didnot matched to its coreesponding confirmaton
    if($email != $c_email || $password != $c_password){
        echo'username or password didnot match ';
    }
    // if the user name or passwor is null
    if($email ==null || $password==null) {
        header('location:index.php?up=false');

    }
}
else{
    echo'not post method';
}
