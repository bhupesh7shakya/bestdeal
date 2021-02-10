
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
<div class='conatiner-fluid font-weight-bold bg-dark'>
    <?php include('partials/_nav.php') ?>
  </div>

    <div class="container">
        <div class="container">

            <?php
            $id = $_GET['id'];
            require('./partials/dbcon.php');
            $sql = 'select * from products where product_id=' . $id;
            $result = mysqli_query($con, $sql);
            if ($result) {
                if (mysqli_num_rows($result) != 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                        echo ' 
                    <div class="container-fluid m-5">
                    <div class="row">
                        <div class="col-md-6">
                    <img class="m-1"src="' . $rows['product_img_url'] . '" width="300px" height="300px" class="rounded float-left" alt="...">
    
                        </div>
                        <div class="col-md-6">
                            <h1>' . $rows['product_name'] . '</h1>
                            <hr>
                            <h3>Rs ' . $rows['product_price'] . '</h3>

                            <a href="' . $rows['product_link'] . '" class="btn btn-primary float-right">Click here to Buy</a>
                            </div>
    
                        </div>
                    </div>
                </div>
                    ';
                    }
                }
            }
            ?>
        <br>
              
            <div class="container">
                
<?php
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" ){
                    $id= $_GET['id'];
                    $comment= $_POST['comments'];
                    $insertCommentSql="INSERT INTO `comment` (`comments`, `commeted_by`, `comment_product_id`) VALUES ('".$comment."', '".$_SESSION['email']."', '".$id."');";
                    $result=mysqli_query($con,$insertCommentSql);
                    if($result){
                        // echo 'commented succesfullly';
                    }
                    else{
                        echo 'something went wrong ';
                    }
                }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<br><hr><h1 class="py-3">Post a comment</h1>
        <form action='.$_SERVER["REQUEST_URI"].' method="POST">
            <div class="form-group">
                <p class="lead">Comment</p>                
                <p>Type a comment</p>
                <textarea class="form-control" id="describe" name="comments" placeholder="Please be polite and dont use offesive word" rows="3" cols=130%></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Post</button>
        </form>';
        } else {
            echo '<p class="lead">You must login to post comment.Please kindly login</p>';
        }?>
                <?php
           



                require('./partials/dbcon.php');
                $sql = 'select * from comment where comment_product_id=' . $id;
                $result = mysqli_query($con, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) != 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            echo '
                         <div class="media mb-3 w-100">
                            <img class="mr-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdagfNlkCXKS54rDkgY6CjGNtPECsI_SZlKQ&usqp=CAU" width="54px" alt="Generic placeholder image">
                            <div class="media-body ">
                            <p class="font-weight-bold my-0">'.$rows['commeted_by'].' at ' . $rows['commented_on']. '</p>
                            '  . $rows['comments'] . '
                            </div>
                        </div>'
                            ;
                        }
                    } if(mysqli_num_rows($result) == 0){
                        echo '
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-4"><b>No comment yet!!!!!!!!</b></h1>
                                        <p class="lead">Be first person to comment</p>
                                </div>
                            </div>
                            ';
                    }
                }
                
                if(!$result){
                    echo '
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4"><b>No comment yet!!!!!!!!</b></h1>
                                    <p class="lead">Be first person to comment</p>
                            </div>
                        </div>
                        ';
                }
                

                ?>
            </div>



        </div>
    </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>