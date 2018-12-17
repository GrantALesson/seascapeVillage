<?php
  require_once 'config.php';
  session_start();

  $displayaddresto = "";

  if(!isset($_SESSION['email']) || empty($_SESSION['email']))
  { 
    header("location: home.php");
  }
  else
  {
    $pemail = $_SESSION['email'];

    $sql = "SELECT * FROM accounts WHERE email = '".$pemail."'";
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        $pfname = $row["firstname"];
        $plname = $row["lastname"];
        $pnumber = $row["mobilenumber"];
        $pemail = $row["email"];
        $plvl = $row["level"];
    }

    if($plvl == 1)
    {
      $displayaddresto = 
      " <a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
        <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
        <div class='dropdown-divider'></div>";
    }
  }
?>