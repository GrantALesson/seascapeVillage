<?php
  require_once 'loginphp.php';
  session_start();

  $displayaddresto = "";

  if(!isset($_SESSION['email']) || empty($_SESSION['email']))
  { 
      $accountnav =   
      "<li class='nav-item'>
          <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#loginModal'>
            Log In
          </button>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='register.php'>Sign Up</a>
      </li>";
  }
  else
  {
    $pemail = $_SESSION['email'];

    $sql = "SELECT * FROM accounts WHERE email = '".$pemail."'";
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
      $pfname = $row["firstname"];
      $plvl = $row["level"];
    }

    if($plvl == 1)
    {
      $displayaddresto = 
      " <a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
        <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
        <div class='dropdown-divider'></div>";
    }

    $accountnav = 
      "<div class='btn-group'>
          <a href='profile.php'>
            <button type='button' class='btn btn-light'>
              ".$pfname."
            </button>
          </a>
          <button type='button' class='btn btn-light dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <span class='sr-only'>Toggle Dropdown</span>
          </button>
          <div class='dropdown-menu dropdown-menu-right'>
            ".$displayaddresto."
            <a class='dropdown-item' href='mybookings.php'>My Bookings</a>
            <a class='dropdown-item' href='settings.php'>Settings</a>
            <div class='dropdown-divider'></div>
              <a class='dropdown-item' href='logout.php'>
                Log Out
              </a>
            </div>
          </div>
        </div>";
  }
?>