<?php
  include 'php/cartphp.php';
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
            <li class="nav-item active">
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
                <a class='dropdown-item' href='logout.php'>Log Out</a>
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
<div class="form-inline" id="bread">
  <ul class="breadcrumb arr-right">
    <li class="breadcrumb-item"><a href="restaurant.php"><small>Restaurants</small></a></li>
    <li class="breadcrumb-item"><a href="bookinfo.php"><small>Booking Info</small></a></li>
    <li class="breadcrumb-item"><a href="booknow.php"><small>Food Selection</small></a></li>
    <li class="breadcrumb-item active"><small>Cart</small></li>
  </ul>
</div>

<!-- RESTO INFO -->
<div class="container">
	<!--table -->
	<table class="table" id="tablecart">
		<thead>
			<tr>
				<!-- label -->
				<th width="10%">Item</th>
				<th width="20%"></th>
				<th width="20%">Price</th>
				<th width="5%"></th>
				<th width="5%">Qty</th>
				<th width="10%"></th>
				<th width="30%">Order Summary</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $clist; ?>
		</tbody>
	</table>
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

</body>
</html>
