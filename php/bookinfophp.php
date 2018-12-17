<?php
  require_once 'config.php';

  $bookday = 0;
  $bookmonth = 0;
  $guests = 0;
  $bookhour = 0;
  $roomtype = "";
  $displayaddresto = "";

  session_start();

  if(!isset($_SESSION['email']) || empty($_SESSION['email']))
  { 
    header("location: login.php");
  }
  else
  {
    $pemail = $_SESSION['email'];

    $sql = "SELECT * FROM accounts WHERE email = '".$pemail."'";
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
      $pfname = $row["firstname"];
      $pid = $row["accid"];
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

  $sql = "SELECT bookingid FROM book ORDER BY bookingid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  // last id for the food table
  if(mysqli_num_rows($result) == 0)
  {
    $booklastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $booklastid = $row["bookingid"]; 
    }
  }
  $booknewid = $booklastid + 1;

  if(!isset($_COOKIE["bookid"]))
  {
    $sql = "DELETE FROM book WHERE bookconfirmation = 'no'";

    if($stmt = mysqli_prepare($link, $sql))
    {
      if(!mysqli_stmt_execute($stmt))
      {
        echo "Something went wrong. Please try again later.";
      }
    }
  }
  else
  {
    $sql = "SELECT * FROM book WHERE bookingid = ".$_COOKIE["bookid"];
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) 
    {
      $bookday = $row["bookday"];
      $bookmonth = $row["bookmonth"];
      $guests = $row["numberofpeople"];
      $bookhour = $row["bookhour"];
      $roomtype = $row["roomtype"];
      $totalamount = $row["totalamount"];
    }
  }

  if(!isset($_COOKIE["restoidcookie"]))
  {
    header("location: restaurant.php");
  }
  else
  {
    $activeresto = $_COOKIE["restoidcookie"];
  }

  $sql = "SELECT * FROM restaurants WHERE restaurantid = ". $_COOKIE["restoidcookie"];
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)) 
  {
    $rname = $row["restaurantname"];
    $rphone = $row["phonenumber"];
    $rprice = $row["restaurant_price"];
    $rimg = $row["restaurant_img"];
  }

  $sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = ". $_COOKIE["restoidcookie"];
  $result = mysqli_query($link, $sql);
  for($previd = -1; $row = mysqli_fetch_assoc($result); $previd = $row["restaurantid"] - 1)
  {
    $restid = $row["restaurantid"] - 1;
    if($restid == $previd)
    {
      $storecuisine = $row["cuisine"];
      $rcuisine = $rcuisine.", ".$storecuisine;
    }
    else
    {
      $storecuisine = $row["cuisine"];
      $rcuisine = $storecuisine;
    }
  }

  $sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = ". $_COOKIE["restoidcookie"];
  $result = mysqli_query($link, $sql);
  for($previd = -1; $row = mysqli_fetch_assoc($result); $previd = $row["restaurantid"] - 1)
  {
    $restid = $row["restaurantid"] - 1;
    if($restid == $previd)
    {
      $storetype = $row["type"];
      $rtype = $rtype.", ".$storetype;
    }
    else
    {
      $storetype = $row["type"];
      $rtype = $storetype;
    }
  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["infosubmit"]))
    {
      if(isset($_COOKIE["bookid"]))
      {
        $sql = "UPDATE book SET numberofpeople = (?), roomtype = (?), bookday = (?), bookmonth = (?), bookhour = (?), totalamount = (?) WHERE bookingid = ".$_COOKIE["bookid"];

        if($stmt = mysqli_prepare($link, $sql))
        {
          mysqli_stmt_bind_param($stmt, "isiiii", $param_people, $param_room, $param_day, $param_month, $param_hour, $param_total);

          $param_people = $_POST["infopeople"];
          $param_room = $_POST["inforoom"];
          $param_day = substr($_POST["infodate"], 0, 2); 
          $param_month = substr($_POST["infodate"], 3, 2); 
          $param_hour = $_POST["infotime"];
          if($_POST["inforoom"] == "Standard" && $roomtype == "VIP")
          {
            $param_total = $totalamount - 300;
          }
          elseif($_POST["inforoom"] == "VIP" && $roomtype == "Standard")
          {
            $param_total = $totalamount + 300;
          }
          else
          {
            $param_total = $totalamount;
          }

          if(mysqli_stmt_execute($stmt))
          {
            header("location: booknow.php");
          } 
          else
          {
              echo "Something went wrong. Please try again later.";
          }
        }
      }
      else
      {
        $bookingnumbergen = substr(str_shuffle(MD5(microtime())), 0, 8);
        $sql = "INSERT INTO book (bookingid, bookingnumber, numberofpeople, roomtype, bookday, bookmonth, bookhour, totalamount, bookconfirmation, accid, restaurantid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql))
        {
          mysqli_stmt_bind_param($stmt, "isisiiiisii", $param_id, $param_no, $param_people, $param_room, $param_day, $param_month, $param_hour, $param_total, $param_confirm, $param_acc, $param_resto);

          $param_id = $booklastid + 1;
          $param_no = $bookingnumbergen;
          $param_people = $_POST["infopeople"];
          $param_room = $_POST["inforoom"];
          $param_day = substr($_POST["infodate"], 0, 2); 
          $param_month = substr($_POST["infodate"], 3, 2); 
          if($_POST["inforoom"] == "Standard")
          {
            $param_total = 200;
          }
          elseif($_POST["inforoom"] == "VIP")
          {
            $param_total = 500;
          }
          $param_hour = $_POST["infotime"];
          $param_confirm = "no";
          $param_acc = $pid;
          $param_resto = $activeresto;

          if(mysqli_stmt_execute($stmt))
          {
            $cookie_name = "bookid";
            $cookie_value = $booknewid;
            $cookie_expire = time() + 300;
            setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
            header("location: booknow.php");
          } 
          else
          {
              echo "Something went wrong.s Please try again later.";
          }
        }
      }
      mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
  }
?>