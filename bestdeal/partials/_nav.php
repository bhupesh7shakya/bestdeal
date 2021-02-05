<nav class="navbar navbar-expand-lg navbar-dark ">
    <img src="https://down-yuantu.pngtree.com/element_our/bg/20200415/bg/fac991aa1e0ad.png?e=1612357603&st=N2ZhNTBiYTAyM2U1OTMwMzVhYzFjZmY2YTE4Zjc2ZDI&n=%E2%80%94Pngtree%E2%80%94shopping%20on%20mobile_5354478.png" width="50px" height="50px">

    <a class="navbar-brand" href="#">Bestbuy</a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Find us</a>
            </li>

        </ul>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light m-1" data-toggle="modal" data-target="#signinModal">
            Sign in
        </button>

        <!-- Modal -->
        <div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="loginAuthen.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-check">


                            </div>

                     
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary float-right">Signin</button>

                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#signupModal">
            Sign up
        </button>

        <!-- Modal -->
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a new account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="createNewAc.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Email address</label>
                                <input type="email" name="c_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="c_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary float-right">Signup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>
<?php
    if(isset($_GET['userexists']) && $_GET['userexists']==true){
        echo'
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Ops!</strong> User you were trying to create has already exits!!! please try signup using another email
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    if(isset($_GET['accountCreated']) && $_GET['accountCreated']==true){
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulation</strong> The account has been created successfully! Thank you for joining our community.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    if(isset($_GET['accountCreated']) && $_GET['accountCreated']==false){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ops!</strong> Something went wrong !! Account not created successfully!! Please contact dev team!!!!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    // a bug need to be fixed here
    // echo var_dump($_GET['loginsucess']);
    // $_GET['loginsucess']=false;
    if(isset($_GET['loginsucess']) && $_GET['loginsucess']=='true'){
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulation</strong> You have been logged in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    if(isset($_GET['loginsucess']) && $_GET['loginsucess']=='false'){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ops!!</strong> You have not been logged in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
   
    if(isset($_GET['emaildont']) && $_GET['emaildont']==true){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ops</strong> Email does not exist.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
?>