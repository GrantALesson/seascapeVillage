<?php 
  include 'php/bookinfophp.php'; 
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
    function startTime() 
    {
      var infodate = document.getElementById("infodate");
      for(var c = 0; c <= 10; c = c + 1)
      {
        var setday = new Date();
        setday.setDate(setday.getDate() + c);

        var month = new Array();
        month[0] = "01";
        month[1] = "02";
        month[2] = "03";
        month[3] = "04";
        month[4] = "05";
        month[5] = "06";
        month[6] = "07";
        month[7] = "08";
        month[8] = "09";
        month[9] = "10";
        month[10] = "11";
        month[11] = "12";
        var arrayM = month[setday.getMonth()];
      
        var date = setday.getDate();
        var year = setday.getFullYear();

        var opt = document.createElement("option");
        opt.text = date + "/" + arrayM + "/" + year;
        opt.value = date + "/" + arrayM + "/" + year;
        
        infodate.add(opt);

        if(date == <?php echo $bookday; ?> && arrayM == <?php echo $bookmonth; ?>)
        {
          infodate.value = date + "/" + arrayM + "/" + year;
        }
      }
    }
  </script>
</head>
<body onload="startTime()">
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
    <li class="breadcrumb-item"><small>Booking Info</small></li>
  </ul>
</div>

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
          <tr>
            <td><small class="text-muted restolbl">HOURS: </small></td>
            <td><small class="bookcont">9AM-9PM (Mon-Sun)</small></td>
          </tr>
        </tbody>
      </table>
    </div><!-- row -->
    <form method="post">
      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div id="bookingdetailh">
            <h4>1. Booking Details</h4>
          </div>
          <div id="bookingdetailc">
            <table>
              <tr>
                <td>Select Date</td>
                <td>Number of Guests</td>
                <td>Time</td>
              </tr>
              <tr>
                <td>
                  <select class="custom-select mr-sm-2" id="infodate" name = "infodate"> 
                  </select>
                </td>
                <td>
                  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name = "infopeople">
                    <option value="1" <?php if($guests == 1){ echo "selected"; } ?> >1</option>
                    <option value="2" <?php if($guests == 2){ echo "selected"; } ?> >2</option>
                    <option value="3" <?php if($guests == 3){ echo "selected"; } ?> >3</option>
                    <option value="4" <?php if($guests == 4){ echo "selected"; } ?> >4</option>
                    <option value="5" <?php if($guests == 5){ echo "selected"; } ?> >5</option>
                    <option value="6" <?php if($guests == 6){ echo "selected"; } ?> >6</option>
                    <option value="7" <?php if($guests == 7){ echo "selected"; } ?> >7</option>
                    <option value="8" <?php if($guests == 8){ echo "selected"; } ?> >8</option>
                  </select>
                </td>
                <td>
                  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name = "infotime">
                    <option value="13" <?php if($bookhour == 13){ echo "selected"; } ?> >1:00PM</option>
                    <option value="14" <?php if($bookhour == 14){ echo "selected"; } ?> >2:00PM</option>
                    <option value="15" <?php if($bookhour == 15){ echo "selected"; } ?> >3:00PM</option>
                    <option value="16" <?php if($bookhour == 16){ echo "selected"; } ?> >4:00PM</option>
                    <option value="17" <?php if($bookhour == 17){ echo "selected"; } ?> >5:00PM</option>
                    <option value="18" <?php if($bookhour == 18){ echo "selected"; } ?> >6:00PM</option>
                    <option value="19" <?php if($bookhour == 19){ echo "selected"; } ?> >7:00PM</option>
                    <option value="20" <?php if($bookhour == 20){ echo "selected"; } ?> >8:00PM</option>
                    <option value="21" <?php if($bookhour == 21){ echo "selected"; } ?> >9:00PM</option>
                    <option value="22" <?php if($bookhour == 22){ echo "selected"; } ?> >10:00PM</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <div id="bookingdetailh">
            <h4>2. Room Type</h4>
          </div>
          <div id="bookingdetailc">
            <table>
              <tr>
                <td>
                  Select room type                  
                </td>
              </tr>
              <tr>
                <td>
                  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name = "inforoom">
                    <option value="Standard" <?php if($roomtype == "Standard"){ echo "selected"; } ?> >Standard</option>
                    <option value="VIP" <?php if($roomtype == "VIP"){ echo "selected"; } ?>>VIP</option>
                  </select>    
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div><!-- row -->

      <div class="row" id="booknow">
        <input type="submit" name = "infosubmit" value="Next" class="btn btn-info">
      </div>
    </form>
    
  </div><!-- card -->
</div>
<!-- end of content -->
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