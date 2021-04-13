<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
   
        .f {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: 1s;
            /* animation: a 3s ease-in-out ; */
        }
    

        .button {
            position: absolute;
            top: 64%;
            left: 50%;
            transform: translate(-50%, -50%);

        }
        body{
            background-image: url('https://source.unsplash.com/1600x900/?ecommerce,shopping,bestbuy');
            /* image-rendering: pixelated; */
            background-repeat: no-repeat;
            /* background-size:cover; */
        }
        nav {
            background-color:black;
        }
        
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>BestDeals.com.np</title>
</head>

<body>
    <div class="conatiner-fluid">
       <?php include('partials/_nav.php') ?>
        <div class="container font-weight-bold ">
            
            <div class="container">

                <form class="form-inline my-2 my-lg-0" method="POST" action="searchEngine.php">
                    <input class="f forms form-control mr-sm-2  w-75 p-3" type="search" name="search" placeholder="Search"
                        aria-label="Search">
                    <button class="f submit button text-light btn btn-outline-dark bg-dark font-weight-bold my-2 my-sm-0 px-5 py-3"
                        type="submit">Search</button>
                </form>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>