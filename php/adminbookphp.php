<?php
  require_once 'config.php';
  session_start();

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
        $pid = $row["accid"];
        $plvl = $row["level"];
    }
    if($plvl != 1)
    {
      header("location: home.php");
    }
    else
    {
       $displayaddresto = 
       "  <a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
          <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
          <div class='dropdown-divider'></div>";
    }
  }

  if(isset($_COOKIE["bookcookie"])) 
  {
      unset($_COOKIE["bookcookie"]);
      setcookie("bookcookie", '', time() - 3600, '/'); 
  }

  $displaybooks = "";

  $sql = "SELECT * FROM book JOIN restaurants ON book.restaurantid = restaurants.restaurantid JOIN accounts ON book.accid = accounts.accid WHERE bookconfirmation = 'yes'";
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
  {
    $bookno[$ctr] = $row["bookingnumber"];
    $bemail[$ctr] = $row["email"];
    $day[$ctr] = $row["bookday"];
    $month[$ctr] = $row["bookmonth"];
    $total[$ctr] = $row["totalamount"];
    $restaurant[$ctr] = $row["restaurantname"];
  }
  $noofbooks = $ctr;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    for($ctr = 0; $ctr < $noofbooks; $ctr++)
    {
      if(isset($_POST["s".$bookno[$ctr]]))
      {
        $cookie_name = "bookcookie";
        $cookie_value = $bookno[$ctr];
        $cookie_expire = time() + 300;
        setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
        header("location: bookingdetails.php");
      }
    }
  }

  for($ctr = 0; $ctr < $noofbooks; $ctr++)
  {
    $displaybooks = $displaybooks.
    "<tr>
      <td>".$day[$ctr]."/".$month[$ctr]."/18</td>
      <td>".$bemail[$ctr]."</td>
      <td>
        <form method='post'>
          <input type = 'submit' name = 's".$bookno[$ctr]."' class = 'btn btn-link btn-sm' value = '".$bookno[$ctr]."'>
        </form>
      </td>
      <td>".$restaurant[$ctr]."</td>
      <td>PHP ".$total[$ctr].".00</td>
    </tr>";
  }
?>