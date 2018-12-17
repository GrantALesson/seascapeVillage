<?php 
  include 'php/aboutphp.php';
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
            <li class="nav-item active">
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
<div class="container-fluid" >
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="art">
      <div id="headerabt">
        Dampa - Redefining The Traditional Concept
      </div>
      <div id="contentabt" >
        Seascape Village is a mall-like property that features its own clean and organized wet market for fresh and live seafood. The wet market sources its seafood from all over the Philippines, a conscious effort of the developer to highlight the bounty of local waters to diners.<br><br>

        Located between Sofitel Philippine Plaza Manila and the Manila Film Center at the CCP Complex, Seascape Village is actually a mixed-use development and the Bay Market is just the first phase of the project. The complex will soon have a retail space for lifestyle and wellness shops, a man-made beach at the baywalk area, as well as a hotel. The whole commercial property would be finished by 2020.<br><br> 

        Bay Market hopes to capture both locals and tourists and is banking on the clean and safe environment it can provide to picky customers. 
      </div>  
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <img src="img/bts.jpg" id="abtimage">
    </div>
  </div>
</div>
<!-- END OF BTS -->
<!-- content -->
<div class="container">
  <center>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/c0mxj2o-al8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen id="videoabt"></iframe>
  </center>
</div>
<!-- BTS -->
<div class="container">
  <div class="text-center">
    <h2 id="bts">Behind The Scenes</h2>
    <p>
      Being the Philippines largely surrounded by different bodies of water, we enjoy an abundant amount of fresh seafood. So much so, restaurants that offer seafood have been popping around the metro. With so many of these restos to choose from, you’re wondering, “where should I eat next?” Wonder no more, as Seascape Village opens its doors for all you seafood lovers!<br><br><br><br><br>
    </p>
  </div>
</div>
<div class="container-fluid">
  <!-- header picture -->
  <div class="row">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15447.33879786123!2d120.9809504!3d14.5514436!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3277e010f269cd0b!2sSeascape+Village+PH!5e0!3m2!1sen!2sph!4v1539596169812" width="2040" height="400" frameborder="0" allowfullscreen></iframe>
  </div>
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
        <div id= "footerphone">
          <p id= "footerabt"><img src="img/icons/phone.png">  (02) 869 7452</p>
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