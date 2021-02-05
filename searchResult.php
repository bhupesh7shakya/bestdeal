<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

    <title>Hello, world!</title>
  </head>
  <body>
    <div class='conatiner-fluid font-weight-bold '>
        <?php include('bestdeal/partials/_nav.php') ?>
    </div>
    
        <br>
        <div class='container float-right'>
        <h1 class='mt-5' >Search result for......W</h1>
        <?php 
        include('scrapy.php');
        for($i=0;$i<sizeof($ScrabedDeal);$i++){
        echo"
        <div class='card m-1 float-left' style='width: 19rem; overflow:hidden;'>
            ".$ScrabedDeal[$i]['image']."
            <div class='card-body'>
              <h5 class='card-title'>".substr($ScrabedDeal[$i]['details'],0,88)."...</h5>
              <p class='card-text'>".$ScrabedDeal[$i]['price']."</p>
              <a href='".$ScrabedDeal[$i]['link']."' class='btn btn-primary'>Go somewhere</a>
            </div>
          </div>
        ";
        }
        ?>
        
          
 
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
  </body>
</html>