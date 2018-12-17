<?php
 include 'php/settingsphp.php'
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile | Seascape Village</title>
  <!-- responsive -->
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
  <!-- icon -->
  <link rel="shortcut icon" href="img/icons/logo.jpg"/>
  <!-- css and javascript reference -->
  <link rel = "stylesheet" href = "css/bootstrap.min.css">
  <link rel = "stylesheet" type="text/css" href="css/styled.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src = "js/bootstrap.min.js"></script>
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
            <div class="btn-group">
              <a href="profile.php">
                <button type="button" class="btn btn-light" href="profile.php">
                  <?php echo $pfname; ?>
                </button>
              </a>
              <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <!-- Dropdown menu links -->
                <?php echo $displayaddresto;?>
                <a class="dropdown-item" href="mybookings.php">My Bookings</a>
                <a class="dropdown-item" href="settings.php">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href='logout.php'>Log Out</a>
              </div>
            </div>
        </ul>
    </div>
</nav>
<div class="container">
  <div class="row">
    <a href="mobile.php" id="applink"><img src="img/icons/app.png">Get the App</a>
  </div>
</div>
<!-- end of download app -->
<!-- content -->
<div class="container" id="settings">

  <center><h2>Settings</h2></center><hr>
  
  <div class="row" >
    
    <div class="col-md-3" id="settingscont">
      <ul class="nav flex-column settingscont">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#generaltab">General</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#passwordtab">Password</a>
        </li>
      </ul>
    </div>

    <div class="col-md-9">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="generaltab" aria-labelledby="general-tab">
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h6 class="mb-0">
                  <div class = "row">
                    <div class = "col-md-5" id = "settingslabel">
                      Name
                    </div>
                    <div class = "col-md-6" id = "settingslabel">
                      <?php echo $pfname." ".$plname; ?>
                    </div>
                    <div class = "col-md-1" id="editbtn">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Edit
                      </button>
                    </div>
                  </div>
                </h6>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <form method="post">
                    <div class = "row">
                      <div class = "col-md-5" id = "settingslabel">
                        First Name
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="text" id="settingstext" name = "settingsfname" required> 
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        Last Name
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="text" id="settingstext" name = "settingslname" required> 
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        <input type="submit" class="btn btn-outline-info" name = "namesub" value = "Save Changes">
                      </div>
                    </div>
                  </form> 
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h6 class="mb-0">
                  <div class = "row">
                      <div class = "col-md-5" id = "settingslabel">
                        Email Address
                      </div>
                      <div class = "col-md-6" id = "settingslabel">
                        <?php echo $pemail; ?>
                      </div>
                      <div class = "col-md-1" id="editbtn">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                          Edit
                        </button>
                      </div>
                  </div>
                </h6>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <form method="post">
                    <div class = "row">
                      <div class = "col-md-5" id = "settingslabel">
                        Email Address
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="email" id="settingstext" name = "settingsemail" required> 
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        <input type="submit" class="btn btn-outline-info" name = "emailsub"  value = "Save Changes">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h6 class="mb-0">
                  <div class = "row">
                    <div class = "col-md-5" id = "settingslabel">
                      Contact Number
                    </div>
                    <div class = "col-md-6" id = "settingslabel">
                      <?php echo $pnumber; ?>
                    </div>
                    <div class = "col-md-1" id="editbtn">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Edit
                      </button>
                    </div>
                  </div>
                </h6>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <form method="post">
                    <div class = "row">
                      <div class = "col-md-5" id = "settingslabel">
                        Contact Number
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="text" id="settingstext" name = "settingscontact" required>
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        <input type="submit" class="btn btn-outline-info" name = "contactsub"  value = "Save Changes">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="passwordtab" aria-labelledby="password-tab">
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h6 class="mb-0">
                  <div class = "row">
                    <div class = "col-md-11" id = "settingslabel">
                      Change Password
                    </div>
                    <div class = "col-md-1" id="editbtn">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsepass" aria-expanded="true" aria-controls="collapsepass">
                        Edit
                      </button>
                    </div>
                  </div>
                </h6>
              </div>
              <div id="collapsepass" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <form method="post">
                    <div class = "row">
                      <div class = "col-md-5" id = "settingslabel">
                        Current Password
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="password" id="settingstext" name = "currentpass" required>
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        New Password
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="password" id="settingstext" name = "newpass" required>
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        Confirm New Password
                      </div>
                      <div class = "col-md-7" id = "settingslabel">
                        <input type="password" id="settingstext" name = "confirmpass" required>
                      </div>
                      <div class = "w-100"></div>
                      <div class = "col-md-5" id = "settingslabel">
                        <input type="submit" class="btn btn-outline-info" name = "passsub"  value = "Save Changes">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div><!-- end of container -->

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
