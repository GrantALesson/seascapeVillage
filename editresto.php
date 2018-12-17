<?php 
  include 'php/editrestophp.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="img/logo.jpg">
  <title>Seascape - Village Market and Paluto </title>
  <!-- Required meta tags -->
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
  <!-- bootstrap css -->
  <link rel = "stylesheet" href = "css/bootstrap.min.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src = "js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
          <!-- Split dropup button -->
          <div class="btn-group">
            <a href="profile.php">
              <button type="button" class="btn btn-light">
                <?php echo $pfname; ?>
              </button>
            </a>
            
            <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- Dropdown menu links -->
              <?php echo $displayaddresto; ?>
              <a class="dropdown-item" href="mybookings.php">My Bookings</a>
              <a class="dropdown-item" href="settings.php">Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href='logout.php'>Log Out</a>
            </div>
          </div>
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
<div class="container">
  <form method="post" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
  <div class="row">
    <div class="col-lg-7">
      <h3>Edit Restaurant</h3>
    </div>
    <div class="col-lg-4">
      <button type="submit" class="btn btn-danger" name = "dresto">Delete Restaurant</button>
    </div>
  </div>
  <div class="row" id="lblrestoheader">
    Basic Info
  </div>
  <div class="row">
  
    <div class="card" id="addrestocard">
      <div class="card-body">
        <div class="form-group">
          <label for="restoname">RESTAURANT NAME*</label>
          <input type="text" class="form-control" id="restoname" name = "restoname" value  = "<?php echo $resname; ?>" required>
        </div>
        <div class="form-group">
          <label for="restoown">PHONE NUMBER</label>
          <input type="text" class="form-control" id="restoown" name = "restophone" value  = "<?php echo $resphone; ?>">
        </div>
        <div class="form-group">
          <label>COST FOR TWO*</label>
          <input type="text" class="form-control" name = "restocost" value  = "<?php echo $resprice; ?>" required>
        </div>
        <div class="form-group">
          <label>LOGO</label>
          <input type="file" class = "form-control-file" name="restologo" accept="image/*">
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="lblrestoheader">
    Characteristics
  </div>

  <div class="row">
    <div class="card" id="addrestocard">
      <div class="card-body">

        <div class="form-group">
          <label for="alcohol">ALCOHOL*</label>
        </div>
        <div class="form-group">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="alcohol" name = "rdalcohol" value = "noalcohol" <?php echo $nachecked; ?>>Doesn't Serve Alcohol 
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="alcohol" name = "rdalcohol" value = "alcohol" <?php echo $achecked; ?>>Serves Alcohol 
          </div>
          
        </div>
        <div class="form-group">
          <label for="payment">PAYMENT*</label>
        </div>
        <div class="form-group">
          <div class="form-check form-check-inline" id="payment">
            <input class="form-check-input" type="checkbox" id="pay" name = "cbcash" <?php echo $cashchecked; ?>>Cash
            <input class="form-check-input" type="checkbox" id="pay" name = "cbcredit" <?php echo $checkchecked; ?>>Credit Card
            <input class="form-check-input" type="checkbox" id="pay" name = "cbmango" <?php echo $mangochecked; ?>>MANGOPAY
          </div>
        </div>
        <div class="form-group">
          <label for="cuisine">CUISINE*</label>
          <div class="card">
            <div class="card-body">
              <div class = "form-row">
                <div class = "form-group col-md-5">
                  <select class="form-control" name = "cbxcuisine1" required>
                    <option value = "">---</option>
                    <?php echo $displaycuisines1; ?>
                  </select>
                </div>
                <div class = "form-group col-md-5">
                  <select class="form-control" name = "cbxcuisine2">
                    <option value = "">---</option>
                    <?php echo $displaycuisines2; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="cuisine">TYPE*</label>
          <div class="card">
            <div class="card-body">
              <div class = "form-row">
                <div class = "form-group col-md-5">
                  <select class="form-control" name = "cbxtype1" required>
                    <option value = "">---</option>
                    <?php echo $displaytypes1; ?>
                  </select>
                </div>
                <div class = "form-group col-md-5">
                  <select class="form-control" name = "cbxtype2">
                    <option value = "">---</option>
                    <?php echo $displaytypes2; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--
        <div class="form-group">
          <label>MENU</label>
          <input type="file" class = "form-control-file" name="menu[]" accept="image/*" multiple>
        </div>
        -->
      </div>
    </div>
  </div>

  <div class="row">
    <button type="submit" class="btn btn-success btn-block" id="btnaddresto" name = "sresto">Save</button>
  </div>
      
    </div>
  </div>  
  </form>
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
        <div id="phone">
          <p id="footerabt">Monday-Sunday<br>9AM-9PM</p>
        </div>
      </div>
    </div>
  </div>
</footer>
</body>
</html>