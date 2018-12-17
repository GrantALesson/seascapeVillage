<?php
  require_once 'config.php'; 

  $clist = "";
  $displayaddresto = "";

  if(!isset($_COOKIE["bookcookie"]))
  {
    header("location: mybookings.php");
  }
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

  $sql = "SELECT * FROM book WHERE bookingnumber = '".$_COOKIE['bookcookie']."'";
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)) 
  {
    $guests = $row["numberofpeople"];
    $month = $row["bookmonth"];
    $date = $row["bookday"];
    $hour = $row["bookhour"];
    $roomtype = $row["roomtype"];
    $paymenttype = $row["paymenttype"];
    $totalamount = $row["totalamount"];
  }

  $sql = "SELECT * FROM cart JOIN book ON book.bookingid = cart.bookingid WHERE book.bookingnumber = '".$_COOKIE['bookcookie']."'";
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
  {
    $cid[$ctr] = $row["cartid"];
    $cname[$ctr] = $row["name"];
    $cprice[$ctr] = $row["price"];
    $cqty[$ctr] = $row["quantity"];
    $cimg[$ctr] = $row["cartimg"];
  }
  $numberofitems = $ctr;

  for($ctr = 0; $ctr < $numberofitems; $ctr++)
  {
    $csubtotal[$ctr] = $cprice[$ctr]*$cqty[$ctr];
    $cminus[$ctr] = "cminus".$ctr;
    $cplus[$ctr] = "cplus".$ctr;
    $cdelete[$ctr] = "cdelete".$ctr;
    if($cqty[$ctr] == 1)
    {
      $disabled[$ctr] = "disabled = 'disabled'";
    }
    else
    {
      $disabled[$ctr] = "";
    }
  }

  if($roomtype == "Standard")
  {
    $roomcost = 200;
  }
  elseif($roomtype == "VIP")
  {
    $roomcost = 500;
  }
  if($hour > 0 && $hour < 13)
  {
    $displayhour = $hour.":00 am";
  }
  elseif($hour > 12 && $hour < 25)
  {
    $hour = $hour - 12;
    $displayhour = $hour.":00 pm";
  }
  $clist = $clist.
  "<tr>
    <form class = 'form' enctype='multipart/form-data' method='post'>
    
      <td></td>
      
      <td><h6>".$roomtype." Room</h6></td>
      
      <td><h6>PHP ".$roomcost.".00</h6></td>
      
      <td></td>
      <td>
        <div id='cartqty'>
          <input type='text' name='cartqtytxt' value = '1' readonly>
        </div>
      </td>
      <td></td>
    </form>
    <form class = 'form' enctype='multipart/form-data' method='post'>
      <td>
        <div id = 'bookdetails'>
          Book Number: ".$_COOKIE['bookcookie']."<br>
          Number of Guests: ".$guests."<br>
          Date: ".$date."/".$month."<br>
          Time: ".$displayhour."<br>
          Payment Options: ".$paymenttype."
              <h5>Total: PHP ".$totalamount.".00</h5>
        </div>
      </td>
    </form>
   </tr>";
  for($ctr = 0; $ctr < $numberofitems; $ctr++)
  {
    $clist= $clist.
    "<tr>
      <form class = 'form' enctype='multipart/form-data' method='post'>
      <td><div id = 'cartpic'><img src='".$cimg[$ctr]."'></div></td>
      <td><h6>".$cname[$ctr]."<br></h6>
      </td>
      <td><h6>PHP ".$cprice[$ctr].".00<h6>Subtotal: <br> PHP ".$csubtotal[$ctr].".00</h6></td>
      <td>  
      </td>
      <td>
        <div id='cartqty'>
          <input type='text' name='cartqtytxt' value = '".$cqty[$ctr]."' readonly>
        </div>
      </td>
      <td>
      </td>
      </form>
    </tr>";
  }
?>