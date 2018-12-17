<?php
  require_once 'config.php';

  $menuitems = "";
  $menumodals = "";
  $allcontent = "";
  $categorydisplay = "";
  $displayaddresto = "";
  $orderby = "<option value=''>Order By</option>
            <option value='ascending'>Ascending</option>
            <option value='descending'>Descending</option>";
  $flg = 0;
  $displayno = 0;
  $all = "";

  if(!isset($_COOKIE["bookid"]))
  {
    header("location: bookinfo.php");
  }

  if(!isset($_COOKIE["restoidcookie"]))
  {
    header("location: restaurant.php");
  }
  else
  {
    $activeresto = $_COOKIE["restoidcookie"];
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

  $sql = "SELECT * FROM book WHERE bookingid = ".$_COOKIE["bookid"];
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)) 
  {
    $booknumber = $row["bookingnumber"];
    $totalamount = $row["totalamount"];
  }

  $sql = "SELECT * FROM food WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++) 
  {
    $fid[$ctr] = $row["foodid"];
    $fname[$ctr] = $row["foodname"];
    $fprice[$ctr] = $row["foodprice"];
    $fimg[$ctr] = $row["foodimgpath"];
    $qtytxtname[$ctr] = "qtyname".$fid[$ctr];
    $modalsubmit[$ctr] = "s".$fid[$ctr];
  }
  $displayno = $ctr;

  for($ctr = 0; $ctr < $displayno; $ctr++)
  {
    $fmodal[$ctr] = "foodmodal".$ctr;
    $qtytxtid[$ctr] = "qtytxtid".$ctr;
    $productsubtotal[$ctr] = "productsubtotal".$ctr;
  }

  $sql = "SELECT cartid FROM cart ORDER BY cartid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 0)
  {
    $cartlastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $cartlastid = $row["cartid"]; 
    }
  }

  $sql = "SELECT * FROM cart WHERE bookingid = ".$_COOKIE["bookid"];
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++) 
  {
    $cname[$ctr] = $row["name"];
    $cqty[$ctr] = $row["quantity"];
  }
  $numberofitems = $ctr;

  $prevtype = "";
  $sql = "SELECT foodtype FROM food WHERE restaurantid = ".$activeresto." ORDER BY foodtype";
  $result = mysqli_query($link, $sql);
  for($ctr = -1; $row = mysqli_fetch_assoc($result); $prevtype = $row["foodtype"])
  {
    $currtype = $row["foodtype"];
    if($currtype == $prevtype)
    {
      $foodcount[$ctr] = $foodcount[$ctr] + 1;
    }
    else
    {
      $ctr= $ctr + 1;
      $ftype[$ctr] = $currtype;
      $categoryname[$ctr] = str_replace(" ","",$ftype[$ctr]);
      $foodcount[$ctr] = 1;
    }
  }
  $typecount = $ctr;

  for($ctr = 0; $ctr <= $typecount; $ctr++)
  {
    $categorydisplay = $categorydisplay.
    "<div class='btn-group'>
        <input type='submit' name='c".$categoryname[$ctr]."' class='btn btn-light' value = '".$ftype[$ctr]."' id='filterin'>
        <input type='button' id = 'ccount' data-toggle='buttons' class='btn btn-light' value = '".$foodcount[$ctr]."' disabled>
      </div>";
  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["pricecbx"]))
    {
      $order = $_POST["pricecbx"];
      if($order == "ascending")
      {
        $orderby = "<option value='ascending' selected>Ascending</option>
            <option value='descending'>Descending</option>";
        $sql = "SELECT * FROM food WHERE restaurantid = ".$activeresto." ORDER BY foodprice";
        $result = mysqli_query($link, $sql);
        for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
        {
            $fname[$ctr] = $row["foodname"];
            $fprice[$ctr] = $row["foodprice"];
            $fimg[$ctr] = $row["foodimgpath"];
            $fid[$ctr] = $row["foodid"];
            $modalsubmit[$ctr] = "s".$fid[$ctr];
            $qtytxtname[$ctr] = "qtyname".$fid[$ctr];
        }
      }
      elseif($order == "descending")
      {
        $orderby = "<option value='ascending'>Ascending</option>
                    <option value='descending' selected>Descending</option>";
       
        $sql = "SELECT * FROM food WHERE restaurantid = ".$activeresto." ORDER BY foodprice DESC";
        $result = mysqli_query($link, $sql);
        for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
        {
            $fname[$ctr] = $row["foodname"];
            $fprice[$ctr] = $row["foodprice"];
            $fimg[$ctr] = $row["foodimgpath"];
            $fid[$ctr] = $row["foodid"];
            $modalsubmit[$ctr] = "s".$fid[$ctr];
            $qtytxtname[$ctr] = "qtyname".$fid[$ctr];   
        }
      }
    }
    for($ctr = 0; $ctr < $displayno; $ctr++)
    {
      if(isset($_POST["s".$fid[$ctr]]))
      {
        $postqty = $_POST["qtyname".$fid[$ctr]];

        for($i = 0; $i < $numberofitems; $i++)
        {
          if($fname[$ctr] == $cname[$i])
          {
            $flg = 1;
            $newqty = $cqty[$i] + $postqty;
          }        
        }
        if($flg == 0)
        {
          $sql = "INSERT INTO cart (cartid, name, price, quantity, cartimg, bookingid) VALUES (?, ?, ?, ?, ?, ?)";

          if($stmt = mysqli_prepare($link, $sql))
          {
            mysqli_stmt_bind_param($stmt, "isiisi", $param_id, $param_name, $param_price, $param_qty, $param_img, $param_book);
                  
            $param_id = $cartlastid + 1;
            $param_name = $fname[$ctr];
            $param_price = $fprice[$ctr];
            $param_qty = $postqty;
            $param_img = $fimg[$ctr];
            $param_book = $_COOKIE["bookid"];

            if(mysqli_stmt_execute($stmt))
            {
                $sql = "UPDATE book SET totalamount = (?) WHERE bookingid = ".$_COOKIE["bookid"];
                if($stmt = mysqli_prepare($link, $sql))
                {
                    mysqli_stmt_bind_param($stmt, "i", $param_total);

                    $param_total = $totalamount + $postqty * $fprice[$ctr];
                    
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
                echo "Something went wrong. Please try again later.";
            }
          }          
        }
        else
        {
          $sql = "UPDATE cart SET quantity = (?) WHERE name = '".$fname[$ctr]."'";
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "i", $param_qty);

              $param_qty = $newqty;
              
              if(mysqli_stmt_execute($stmt))
              {
                $sql = "UPDATE book SET totalamount = (?) WHERE bookingid = ".$_COOKIE["bookid"];
                if($stmt = mysqli_prepare($link, $sql))
                {
                    mysqli_stmt_bind_param($stmt, "i", $param_total);

                    $param_total = $totalamount + $postqty * $fprice[$ctr];
                    
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
                echo "Something went wrong. Please try again later.";
              }
          }
        }
        mysqli_stmt_close($stmt);
      }
    }
    for($ctr = 0; $ctr <= $typecount; $ctr++)
    {
      if(isset($_POST["c".$categoryname[$ctr]]))
      {
        
        $sql = "SELECT * FROM food WHERE restaurantid = ".$activeresto." AND foodtype = '".$ftype[$ctr]."'";
        $result = mysqli_query($link, $sql);
        for($i = 0; $row = mysqli_fetch_assoc($result); $i++)
        {
          $fname[$i] = $row["foodname"];
          $fprice[$i] = $row["foodprice"];
          $fimg[$i] = $row["foodimgpath"];
          $fid[$i] = $row["foodid"];
          $modalsubmit[$i] = "s".$fid[$i];
          $qtytxtname[$i] = "qtyname".$fid[$i];
        }
        $displayno = $foodcount[$ctr];
      }
    }
    mysqli_close($link);
  }

  for($ctr = 0; $ctr < $displayno; $ctr++)
  {
    $menumodals = $menumodals.
    "<div class='modal' id='".$fmodal[$ctr]."' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <form class = 'form' enctype='multipart/form-data' method='post'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>".$fname[$ctr]."</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            </div>
            <div class='modal-body'>
            <center>
              <div id = 'productinfo'>
                <div id = 'productimg'>
                  <img src = '".$fimg[$ctr]."'>
                </div>
                <div id = 'productname'>
                  ".$fname[$ctr]."<br> PHP ".$fprice[$ctr].".00
                </div>
                <button type = 'button' class = 'btn btn-light' onclick='qtysub(".$fprice[$ctr].")'>-</button>
                <input type = 'text' class = 'modaltxt' id = '".$qtytxtid[$ctr]."' value = '0' name = '".$qtytxtname[$ctr]."' readonly>
                <button type = 'button' class = 'btn btn-light' onclick='qtyadd(".$fprice[$ctr].")'>+</button>
                <br><br>
                <div id = '".$productsubtotal[$ctr]."'></div>
              </div>
            </center>
        </div>
        <div class='modal-footer'>
          <input type = 'submit' class = 'btn btn-info' name = '".$modalsubmit[$ctr]."' value = 'Add to Cart'>
        </div>
          </form>
      </div>
     s</div>
    </div>";
    $menuitems = $menuitems. 
    "<div id = 'menuitems' class = 'well col-lg-3 col-md-4 col-sm-4' data-toggle='modal' data-target='#".$fmodal[$ctr]."' onclick='loadqty(".$ctr.",".$fprice[$ctr].")'>
      <img src = '".$fimg[$ctr]."'><br>
        <div id = 'menuitemtxt'>
          ".$fname[$ctr]."<br> PHP ".$fprice[$ctr].".00
        </div>
     </div>";
  }
?>