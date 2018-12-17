<?php
  include 'php/restoinfophp.php';
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
  <script type="text/javascript">
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    $('.popover-dismiss').popover({
      trigger: 'focus'
    })
  </script>
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
        <a class="navbar-brand mx-auto" href="overview.php">Seascape</a>
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
<!-- content -->
<div class="container">
  <div class="card" id="cardresto">
      <div class="row">

      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <img src="<?php echo $rimg; ?>" id="restoimg">
          </div>

        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <small class="text-muted"><?php echo $rtype; ?></small><br>
            <h2><?php echo $rname; ?></h2>
          </div>

      </div><!-- row -->

      <div class="row">
        <table>
            <tbody>
                <tr>
                  <td><small class="text-muted restolbl">CUISINES: </small></td>
                  <td><small class="bookcont"><?php echo $rcuisine; ?></small></td>
                </tr>
                <tr>
                  <td><small class="text-muted restolbl">COST FOR TWO: </small></td>
                  <td><small class="bookcont">PHP<?php echo $rprice; ?></small></td>
                </tr>
                <!--
                <tr>
                  <td><small class="text-muted restolbl">HOURS: </small></td>
                  <td><small class="bookcont">9AM-9PM (Mon-Sun)</small></td>
                </tr>
                -->
            </tbody>
          </table>
      </div><!-- row --><!-- row -->      
    </div><!-- card -->

  <ul id="details-nav" class="nav nav-tabs" role="tablist">
      
      <li class="nav-item">
      <a class="nav-link active" href="#overview" id="home-tab" role="tab" data-toggle="tab" aria-controls="overview" aria-expanded="true">Overview</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#detailmenu" role="tab" id="menu-tab" data-toggle="tab" aria-controls="menu">Menu</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="bookinfo.php" role="tab">Book a Table</a>
      </li>
  </ul>

  <!-- Content Panel -->
  <div id="details-nav-content" class="tab-content">

      <div role="tabpanel" class="tab-pane fade show active" id="overview" aria-labelledby="overview-tab">
        <div class="container">
        <div class="row">
            <div class="col-sm">
                <h4>Phone Number</h4>
                <h6 id = "restoinfophone"><?php echo $rphone; ?></h6>

                <br><br>

                <h4>Payment Options</h4>
                <?php echo $displayoptions; ?>

                <br><br>
            </div>
            <div class="col-sm">
                <h4>Opening Hours 
                  <a tabindex="0" class="btn btn-light btn-sm" role="button" data-toggle="popover" data-trigger="focus" data-html="true" 
                  data-content="<?php echo $displaytime; ?>">>></a>
                </h4>
                <!-- <p>Today 9am – 9pm</p> -->


                <br><br>

                <h4>More Info</h4>
                <?php echo $displaymoreinfo; ?>
            </div>
          </div><!-- row -->
      </div><!-- container -->
      </div><!-- overview -->

      <div role="tabpanel" class="tab-pane fade" id="detailmenu" aria-labelledby="menu-tab">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php echo $menulist; ?>
        </div><!-- carousel-inner -->
      
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" id="arrows">
          <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" id="arrows">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div><!-- carouselExampleControls -->
      </div><!-- detailmenu -->
  </div><!-- details-nav-content -->
</div><!-- container -->

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