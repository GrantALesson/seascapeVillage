<?php
 include 'php/registerphp.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="img/icons/logo.jpg">
  <title>Seascape - Market Village and Paluto </title>
  <!-- Required meta tags -->
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
  <!-- bootstrap css -->
  <link rel = "stylesheet" href = "css/bootstrap.min.css">
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src = "js/bootstrap.min.js"></script>
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/styled.css">
</head>
<body>
<!-- navigation bar -->
<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="restaurant.php">Restaurant List</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="home.php">Seascape</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#loginModal">
                  Log In
                </button>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="register.php">Sign Up</a>
            </li>
        </ul>
    </div>
</nav>
<!-- end of navigation bar -->
<!-- row for download app -->
<div class="container">
  <div class="row">
    <a href="mobile.php" id="applink"><img src="img/icons/app.png">Get the App</a>
  </div>
</div>
<!-- end of download app -->
<!-- content -->
<div class="container-fluid" id="signcontain">
  <div class="row" id="reglbl">
    <center><h3>Sign Up</h3></center><br>
  </div>

  <div class="row">
    <!-- registration form -->
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="accsfrm">
      <form id="accfrm" method="post">

        <label id = "registerlabel">Account Information</label>
        
        <div class="fcontent">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name = "regemail" aria-describedby="emailHelp" placeholder="Enter email" required>
            <div id="helpblock"><?php echo $remail_err; ?></div>
          </div>
          <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" id="pwd" name = "regpassword" placeholder="Password" required>
            <div id="helpblock"><?php echo $rpassword_err; ?></div>
          </div>
          <div class="form-group">
            <label for="pwd">Confirm Password</label>
            <input type="password" class="form-control" id="pwd" name = "regconfirm_password" placeholder="Confirm Password" required>
            <div id="helpblock"><?php echo $confirm_password_err; ?></div>
          </div>
        </div><!-- end of fcontent -->
    </div><!-- end of div acc -->

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="persofrm">
      <label id = "registerlabel">Personal Information</label>
      
      <div class="fcontent">
        <div class="form-group">
          <label for="fname">First Name</label>
          <input type="text" class="form-control" id="fname" name = "regfname" placeholder="Ex. Juan" required>
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input type="text" class="form-control" id="lname" name = "reglname" placeholder="Ex. dela Cruz" required>
        </div>
        <div class="form-group">
          <label for="contactno">Contact Number</label>
          <input type="number" class="form-control" id="contactno" name = "regcontact" placeholder="Ex. 0900000000" required>
          <div id="helpblock"><?php echo $contactno_err; ?></div>
        </div>
      </div><!-- end of fcontent -->

      <div class="form-group">
        <input type="submit" class="btn btn-info" id="register" name = "regsubmit" value = "Register">
      </div>

    </div><!-- end of div perso -->
      </form><!-- end of registration form -->
  </div><!-- end of row -->
</div>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
        <label id="hfooter">About Us</label>
        <p id="footerabt">
          Seascape Village Bay Market is Manila’s newest seafood destination. Aside from the many dining options, Seascape Village will feature a spa resort, beach walk & sand bar, and souq boutiques.

          <br><br><br><br>

          @ 2018 Powered By Eurolink
        </p>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <label id="hfooter">Contact Info</label>
        <div>
          <p id="footerabt"><img src="img/icons/location.png">  Atang Dela Rama, Pasay, Metro Manila</p> 
        </div>
        <div id = "footerphone">
          <p id="footerabt"><img src="img/icons/phone.png">  (02) 869 7452</p>
        </div>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <label id="hfooter">Opening Hours</label>
        <div>
          <p id="footerabt">Monday-Sunday<br>9AM-9PM</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- The Modal -->
<div class="modal" id="loginModal">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title">Log In</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
      <form method="post">
        <div class="form-group">
          <input type="text" name="lemail" placeholder="Email" id="emailid"><br><br>
          <input type="password" name="lpassword" placeholder="Password" id="pwdid">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-info" name = "lsubmit" id="loginid" value = "Log In">
          <label id="loglbl">Don't have an account? Register </label><a href="register.php" id="reglink"> here</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>