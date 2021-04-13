<!doctype html>
<html lang='en'>

<head>
  <!-- Required meta tags -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
  <style>
    .card{
      /* background-color: red; */
      /* border-radius: 5%; */
      box-shadow: 8px 8px 5px 0px rgba(0,0,0,0.54);
-webkit-box-shadow: 8px 8px 5px 0px rgba(0,0,0,0.54);
-moz-box-shadow: 8px 8px 5px 0px rgba(0,0,0,0.54);
transition: 0.4s;
animation: ani 0.5s ease-in;
    }
    @keyframes ani {
      0%{
        /* transform: scale(0.); */
        /* tra-top: 1000px; */
        filter: blur(5px);

        transform: translateY(10px);
        opacity: 0;
      }
      
      
    }
    .card:hover{
      transform: scale(1.02);
      box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.71);
-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.71);
-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.71);
    }
  </style>
  <title>
    Search result for <?php echo $_GET['q'] ?>


  </title>
</head>

<body>
  <div class='conatiner-fluid font-weight-bold bg-dark'>
    <?php include('partials/_nav.php') ?>
  </div>

  <br>
  <div class='container '>
    <div class="container">

      <form class="form-inline my-2 my-lg-0" method="POST" action="searchEngine.php">
        <input class="forms form-control mr-sm-2 w-50 p-3" type="search" name="search" placeholder="Search" aria-label="Search"><button class="submit button text-light btn btn-outline-dark bg-dark font-weight-bold my-2 my-sm-0 px-5 py-3" type="submit">Search</button>
      </form>
    </div>
    <h1 class='mt-5'>Search result for <?php echo $_GET['q'] ?></h1>
    <div style="margin: -1% 18%;float: right;">
      Sort by <select class="form-select form-select-sm " onclick="sort(this.value)" id="sort" aria-label=".form-select-sm example">
        <option selected>
          <?php
          if(!isset($_GET['sortby ']) && $_GET['sortby']==null || $_GET['sortby']=="Best Match"){
            echo "Best Match";
          } else{
            if($_GET['sortby']=="ascending"){
              echo "Low to High";
            }
            if($_GET['sortby']=="descending"){
              echo "High to Low";
            }
          }?>

          
        </option>
        <option value="ascending">Low to high</option>
        <option value="descending">High to Low</option>
        <option value="Best Match">Best Match</option>
      </select>
    </div>

    <br>
    <?php
    include('scrapy.php');
    require('./partials/dbcon.php');
    // echo $_GET['test'];
    $sql = "SELECT * FROM `products` WHERE `product_name` LIKE '%" . $getsSearchQuery . "%' OR `search_keyword` LIKE '%" . $getsSearchQuery . "%'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      if (mysqli_num_rows($result) != 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $item['id'] = $rows['product_id'];
          $item['name'] = $rows['product_name'];
          $item['link'] = $rows['product_link'];
          $item['img'] = $rows['product_img_url'];
          $item['price'] = $rows['product_price'];
          $item['source']=$rows['source'];
          $deals[] = $item;
        }


        $num = sizeof($deals);
        //  sorting using bubble sort

        if (isset($_GET['sortby']) && $_GET['sortby']!= null) {
          if ($_GET['sortby'] == "descending") {
            // high to low
            for ($i = 0; $i < $num; $i++) {
              for ($j = 0; $j < $num; $j++) {
                if (isset($deals[$j + 1]['price'])) {
                  if ((int)$deals[$j]['price'] < (int)$deals[$j + 1]['price']) {
                    $temp = $deals[$j];
                    $deals[$j] = $deals[$j + 1];
                    $deals[$j + 1] = $temp;
                  }
                }
              }
            }
          }
          if ($_GET['sortby'] == "ascending") {
            // low to high
            for ($i = 0; $i < $num; $i++) {
              for ($j = 0; $j < $num; $j++) {
                if (isset($deals[$j + 1]['price'])) {
                  if ((int)$deals[$j]['price'] > (int)$deals[$j + 1]['price']) {
                    $temp = $deals[$j];
                    $deals[$j] = $deals[$j + 1];
                    $deals[$j + 1] = $temp;
                  }
                }
              }
            }
          }
        }


        $g = 0;
        while ($g < $num) {
          //  echo $rows['product_name'] . ' ' . $rows['product_price'] . ' ' . $rows['product_img_url'] . ' ' . $rows['product_link'];
          echo "
          <div class='cards'>      
                     <div class='card m-3 float-left' style='width: 20.5rem;height:28rem;'>
                 <img src='" . $deals[$g]['img'] . "' class='card-img-top img-thumbnail ' style='height:65%;overflow:hidden'>
                     <div class='card-body'>
                       <h5 class='card-title' style='overflow:hidden'>" . substr($deals[$g]['name'], 0, 50) . "...</h5>
                       <p class='card-text'>Rs " . $deals[$g]['price'] . "</p>
                       <a href='productpageReview.php?id=" . $deals[$g]['id'] . "' class='btn btn-primary'>See Details</a>
                       <p class='float-right'>Sold by ".$deals[$g]['source']."</p>
                       <!--<img src='".$deals[$g]['source']."' class='card-img-top img-thumbnail ' style='width: 12%;height: 20%;margin-left: 40%;'>-->
                       
                       </div>
                   </div>
                   </div>

                 ";
          $g++;
        }
      }
    }








    ?>



    <script>
      function sort(value){
        // console.log(value);
        window.location = `searchResult.php?q=<?php echo $_GET['q']?>&sortby=`+value
      }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
</body>

</html>