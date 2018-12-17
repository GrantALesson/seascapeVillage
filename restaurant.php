<?php 
  include 'php/restaurantphp.php'; 
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
            <li class="nav-item active">
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
            <?php echo $accountnav; ?>
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
<!-- resto -->
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 col-xl-4">
      <div class="card" id="fltrs">
        <!-- search -->
        <div id="search">
          <form class="form-inline" method="post">
            <input type="text" placeholder="Search Restaurant..." class="form-control form-control" name = "searchtxt">
            <input type="submit" value="Search" class="btn btn-outline-info" name = "searchbtn">
          </form> 
          
        </div>
        <!-- label for price -->
        <div class="restoheader">
          <img src="img/icons/price.png" id="restoicon"><label>Price</label>
        </div>
        <div class="w-100"></div>
        <!-- filter for price -->
        <div class="restocont">
          <form method="post">
            <div class="btn-group">
              <input type="submit" name="less350" class="btn btn-light" value = "Less than PHP 350" id="filterin">
              <input type="button" id = "allplus" data-toggle="buttons" class="btn btn-light" value = "<?php echo $no350; ?>" disabled>
            </div>
            <br>
            <div class="btn-group">
              <input type="submit" name="less700" class="btn btn-light" value = "PHP 350 to PHP 700" id="filterin">
              <input type="button" id = "allplus" data-toggle="buttons" class="btn btn-light" value = "<?php echo $no700; ?>" disabled>
            </div>  
            <br>
            <div class="btn-group">
              <input type="submit" name="less1400" class="btn btn-light" value = "PHP 700 to PHP 1400" id="filterin">
              <input type="button" id = "allplus" data-toggle="buttons" class="btn btn-light" value = "<?php echo $no1400; ?>" disabled>
            </div>
            <br>
            <div class="btn-group">
              <input type="submit" name="more1400" class="btn btn-light" value = "More than PHP 1400" id="filterin">
              <input type="button" id = "allplus" data-toggle="buttons" class="btn btn-light" value = "<?php echo $nomore; ?>" disabled>
            </div>
          </form>
          <br><br><br>
        </div><!-- end of restocont -->
        <div class="w-100"></div>
        <!-- label for cuisines -->
        <div class="restoheader">
          <label><img src="img/icons/cuisine.png" id="restoicon">Cuisine</label>
        </div>
        <div class="w-100"></div>
        <!-- filter for cuisines -->
        <div class="restocont">
          <form method="post">
            <?php echo $cuisinedisplay; ?>
          </form>
          <br><br>
        </div><!-- end of restocont -->
      </div><!-- end of card -->
    </div><!-- end of col -->
    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">
        <?php echo $restodisplay; ?>
    </div>
  </div><!-- end oof row -->
</div>
<!-- end of resto -->

<!-- Modal -->
<?php echo $callmodal; ?>


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