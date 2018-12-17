<?php
  include 'php/mainloginphp.php';
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
<div class="container">

  <form id="login" method="post">
    <div class="form-group">
      <center><img src="img/icons/logo.jpg" class="img-fluid" alt="Responsive image" id="logimg"></center>
      <center><h2>Log In</h2></center><br><br>
      <center><input type="text" placeholder="Email" class="form-control form-control-lg" name = "lemail" required></center><br>
      <center><input type="password" placeholder="Password" class="form-control form-control-lg" name = "lpassword" required></center><br>
        <?php echo $error ?>
      <label>Don't have an account? Register <a href="register.php"> here.</a></label><br><br>
      <center><input type="submit" class="btn btn-info btn-block" name = "lsubmit" id="loginid" value = "Log In"></center><br><br><br><br>
    </div>
  </form>

</div>
<!-- end of resto -->
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
</body>
</html>