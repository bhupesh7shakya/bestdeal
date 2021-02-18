<!doctype html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

  <title>
    Search result for <?php echo $_GET['q'] ?>

  </title>
</head>

<body>
  <div class='conatiner-fluid font-weight-bold bg-dark'>
    <?php include('partials/_nav.php') ?>
  </div>

  <br>
  <div class='container float-right'>
    <div class="container">

      <form class="form-inline my-2 my-lg-0" method="POST" action="searchEngine.php">
        <input class="forms form-control mr-sm-2 w-50 p-3" type="search" name="search" placeholder="Search" aria-label="Search"><button class="submit button text-light btn btn-outline-dark bg-dark font-weight-bold my-2 my-sm-0 px-5 py-3" type="submit">Search</button>
      </form>
    </div>
    <h1 class='mt-5'>Search result for <?php echo $_GET['q'] ?></h1>
    <?php
    include('scrapy.php');
    require('./partials/dbcon.php');
    $sql = 'select * from products where search_keyword="' . $getsSearchQuery . '"';
    $result = mysqli_query($con, $sql);
    if ($result) {
      if (mysqli_num_rows($result) != 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $item['id'] = $rows['product_id'];
          $item['name'] = $rows['product_name'];
          $item['link'] = $rows['product_link'];
          $item['img'] = $rows['product_img_url'];
          $item['price'] = $rows['product_price'];
          $deals[] = $item;
        }
        $num = sizeof($deals);
        for ($i = 0; $i < $num; $i++) {
          for ($j = 0; $j < $num; $j++) {
            if(isset($deals[$j + 1]['price'])){
              if ((int)$deals[$j]['price'] > (int)$deals[$j + 1]['price']) {
                $temp = $deals[$j];
                $deals[$j] = $deals[$j + 1];
                $deals[$j + 1] = $temp;
              }
            }
           
          }
        }

        $g = 0;
        while ($g < $num) {
                 //  echo $rows['product_name'] . ' ' . $rows['product_price'] . ' ' . $rows['product_img_url'] . ' ' . $rows['product_link'];
                 echo "
                 <div class='card m-1 float-left' style='width: 19rem;height:28rem; '>
                 <img src='" . $deals[$g]['img'] . "' class='card-img-top img-thumbnail ' style='height:55%'>
                     <div class='card-body'>
                       <h5 class='card-title' style='overflow:hidden'>" . substr( $deals[$g]['name'], 0, 50) . "...</h5>
                       <p class='card-text'>Rs " . $deals[$g]['price'] . "</p>
                       <a href='productpageReview.php?id=".$deals[$g]['id']."' class='btn btn-primary'>See Details</a>
                     </div>
                   </div>
                 ";
          $g++;
        }
      }
    }








    ?>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
</body>

</html>