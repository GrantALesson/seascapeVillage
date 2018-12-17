<?php
  require_once 'config.php';
  session_start();

  $restoname_err = "";
  $displaytypes1 = "";
  $displaytypes2 = "";
  $displaycuisines1 = "";
  $displaycuisines2 = "";
  $restologo_err = "";
  $rescuis_err = "";
  $restype_err = "";
  $menu_err = "";
  $achecked = "";
  $nachecked = "";
  $cashchecked = "";
  $checkchecked = "";
  $mangochecked = "";
  $displayaddresto = "";
  $fcuisine = 0;

  if(!isset($_COOKIE["restoidcookie"]))
  {
    header("location: restaurant.php");
  }
  else
  {
    $activeresto = $_COOKIE["restoidcookie"];
  }

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
    if($plvl != 1)
    {
      header("location: home.php");
    }
    else
    {
        $displayaddresto = "
          <a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
          <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
          <div class='dropdown-divider'></div>";
    }
  }
  $sql = "SELECT * FROM restaurants WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)) 
  {
    $resname = $row["restaurantname"];
    $resphone = $row["phonenumber"];
    $resprice = $row["restaurant_price"];
  }

  $sql = "SELECT * FROM moreinfo WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++) 
  {
    $resmoreinfo[$ctr] = $row["moreinfotxt"];
  }
  $infono = $ctr;

  for($ctr = 0; $ctr < $infono; $ctr++)
  {
    if($resmoreinfo[$ctr] == "Alcohol")
    {
      $achecked = "checked";
    }
    elseif($resmoreinfo[$ctr] == "No Alcohol Available")
    {
      $nachecked = "checked";
    }
  }

  $sql = "SELECT * FROM restaurantspaymentoptions WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++) 
  {
    $respayment[$ctr] = $row["paymentoptionsid"];
  }
  $paymentno = $ctr;

  for($ctr = 0; $ctr < $paymentno; $ctr++)
  {
    if($respayment[$ctr] == 1)
    {
      $cashchecked = "checked";
    }
    elseif($respayment[$ctr] == 2)
    {
      $checkchecked = "checked";
    }
    elseif ($respayment[$ctr] == 3) 
    {
      $mangochecked = "checked";
    }
  }

  $sql = "SELECT restaurantspaymentoptionsid FROM restaurantspaymentoptions ORDER BY restaurantspaymentoptionsid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 0)
  {
    $restoplastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $restoplastid = $row["restaurantspaymentoptionsid"]; 
    }
  }
  $restopnewid = $restoplastid + 1;

  $sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid  WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++) 
  {
    $rescuisine[$ctr] = $row["cuisine"];
  }
  $cuisinenumber = $ctr;

  if($cuisinenumber == 1)
  {
    $rescuisine[1] = "";
  }

  $sql = "SELECT restaurantcuisineid FROM restaurantscuisines ORDER BY restaurantcuisineid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 0)
  {
    $restoclastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $restoclastid = $row["restaurantcuisineid"]; 
    }
  }
  $restocnewid = $restoclastid + 1;

  $sql = "SELECT restauranttypeid FROM restaurantstype ORDER BY restauranttypeid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 0)
  {
    $restotlastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $restotlastid = $row["restauranttypeid"]; 
    }
  }
  $restotnewid = $restotlastid + 1;

  $sql = "SELECT restaurantid FROM restaurants ORDER BY restaurantid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 0)
  {
    $restolastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $restolastid = $row["restaurantid"]; 
    }
  }

  $sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  for($ctr= 0; $row = mysqli_fetch_assoc($result); $ctr++) 
  {
    $restype[$ctr] = $row["type"];
  }
  $typenumber = $ctr;

  if($typenumber == 1)
  {
    $restype[1] = "";
  }

  $sql = "SELECT * FROM type";
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
  {
    $typeid[$ctr] = $row["typeid"];
    $types[$ctr] = $row["type"]; 
  }
  $typecount = $ctr;

  for($ctr = 0; $ctr < $typecount; $ctr++)
  {
    if($types[$ctr] == $restype[0])
    {
      $displaytypes1 = $displaytypes1."<option value = '".$types[$ctr]."' selected>".$types[$ctr]."</option>";
    }
    else
    {
      $displaytypes1 = $displaytypes1."<option value = '".$types[$ctr]."'>".$types[$ctr]."</option>";
    }
    if($types[$ctr] == $restype[1])
    {
      $displaytypes2 = $displaytypes2."<option value = '".$types[$ctr]."' selected>".$types[$ctr]."</option>";
    }
    else
    {
      $displaytypes2 = $displaytypes2."<option value = '".$types[$ctr]."'>".$types[$ctr]."</option>";
    }
  }

  $sql = "SELECT * FROM cuisine";
  $result = mysqli_query($link, $sql);
  for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
  {
    $cid[$ctr] = $row["cuisineid"];
    $cname[$ctr] = $row["cuisine"]; 
  }
  $ccount = $ctr;

  for($ctr = 0; $ctr < $ccount; $ctr++)
  {
    if($cname[$ctr] == $rescuisine[0])
    {
      $displaycuisines1 = $displaycuisines1."<option value = '".$cname[$ctr]."' selected>".$cname[$ctr]."</option>";
    }
    else
    {
      $displaycuisines1 = $displaycuisines1."<option value = '".$cname[$ctr]."'>".$cname[$ctr]."</option>";
    }
    if($cname[$ctr] == $rescuisine[1])
    {
      $displaycuisines2 = $displaycuisines2."<option value = '".$cname[$ctr]."' selected>".$cname[$ctr]."</option>";
    }
    else
    {
      $displaycuisines2 = $displaycuisines2."<option value = '".$cname[$ctr]."'>".$cname[$ctr]."</option>";
    }
  }

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["dresto"]))
    {
      $sql = "DELETE FROM restaurants WHERE restaurantid = ".$activeresto;
      if($stmt = mysqli_prepare($link, $sql))
      {
        if(mysqli_stmt_execute($stmt))
        {
          header("location: restaurant.php");
        }
        else
        {
          echo "Something went wrong. Please try again later.";
        }
      }
      for($ctr = 1; $ctr <= $restolastid; $ctr++)
      {
        if($ctr > $activeresto)
        {
          $newid = $ctr - 1;
          $sql = "UPDATE restaurants SET restaurantid = ".$newid." WHERE restaurantid = ".$ctr;
          if($stmt = mysqli_prepare($link, $sql))
          {
            mysqli_stmt_bind_param($stmt, "i",$param_id);

            $param_id = $newid;
            if(mysqli_stmt_execute($stmt))
            {
              header("location: restaurant.php");
            }
            else
            {
              echo "Something went wrong. Please try again later.";
            }
          }
          mysqli_stmt_close($stmt);
        }
      }
    }
    if(isset($_POST["sresto"]))
    {
      if(empty($_POST["restoname"]))
      {
        $restoname_err = "Please provide a restaurant name.";
      }
      if(empty($_POST["restophone"]))
      {
        $restomobile = "Not Available";
      }
      else
      {
        $restomobile = $_POST["restophone"];
      }
      if(empty($_POST["restocost"]))
      {
        $restocost_err = "Please provide average restaurant cost for two.";
      }
      if(empty($_POST["cbxtype1"]) && empty($_POST["cbxtype2"]))
      {
        $restype_err = "Please choose a restaurant type";
      }
      if(empty($_POST["cbxcuisine1"]) && empty($_POST["cbxcuisine2"]))
      {
        $rescuis_err = "Please choose a restaurant cuisine";
      }
      if($_FILES['restologo']['size'] == 0) 
      {
        $restologo_err = "Please put an image.";
      }
      elseif(getimagesize($_FILES["restologo"]["tmp_name"]) == false) 
      {
        $restologo_err = "Not an image file.";
      }
      if(empty($restologo_err))
      {
        $upload_image = $_FILES["restologo"]["name"];
        $folder = "/xampp/htdocs/resto/img/uploads/";
        move_uploaded_file($_FILES["restologo"]["tmp_name"], $folder.$_FILES["restologo"]["name"]);
        $restofolder = "img/uploads/".$_FILES["restologo"]["name"];
      }
      if(empty($restoname_err) && empty($restocost_err) && empty($restype_err) && empty($rescuis_err))
      {
        if($restologo_err == "Please put an image.")
        {
          $sql = "UPDATE restaurants SET restaurantname = (?), phonenumber = (?), restaurant_price = (?) WHERE restaurantid = ".$activeresto;

          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_phone, $param_price);
              
              $param_name = $_POST["restoname"];
              $param_phone = $restomobile;
              $param_price = $_POST["restocost"];

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
          }
        }
        else
        {
          $sql = "UPDATE restaurants SET restaurantname = (?), phonenumber = (?), restaurant_price = (?), restaurant_img = (?) WHERE restaurantid = ".$activeresto;

          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "ssis", $param_name, $param_phone, $param_price, $param_img);
              
              $param_name = $_POST["restoname"];
              $param_phone = $restomobile;
              $param_price = $_POST["restocost"];
              $param_img = $restofolder;

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
          }
        }
        $sql = "DELETE FROM restaurantspaymentoptions WHERE restaurantid = ".$activeresto;
        if($stmt = mysqli_prepare($link, $sql))
        {
          if(!mysqli_stmt_execute($stmt))
          {
            echo "Something went wrong. Please try again later.";
          }
        }
        if(isset($_POST["cbcash"]))
        {
          $sql = "INSERT INTO restaurantspaymentoptions(restaurantspaymentoptionsid, restaurantid, paymentoptionsid) VALUES (?, ?, ?)";
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "iii", $param_rpid, $param_rid, $param_pid);
              
              $param_rpid = $restopnewid;
              $param_rid = $activeresto;
              $param_pid = 1;

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              }
              $restopnewid = $restopnewid + 1; 
          } 
        }
        if(isset($_POST["cbcredit"]))
        {
          $sql = "INSERT INTO restaurantspaymentoptions(restaurantspaymentoptionsid, restaurantid, paymentoptionsid) VALUES (?, ?, ?)";
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "iii", $param_rpid, $param_rid, $param_pid);
              
              $param_rpid = $restopnewid;
              $param_rid = $activeresto;
              $param_pid = 2;

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
              $restopnewid = $restopnewid + 1; 
          }
        }
        if(isset($_POST["cbmango"]))
        {
          $sql = "INSERT INTO restaurantspaymentoptions(restaurantspaymentoptionsid, restaurantid, paymentoptionsid) VALUES (?, ?, ?)";
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "iii", $param_rpid, $param_rid, $param_pid);
              
              $param_rpid = $restopnewid;
              $param_rid = $activeresto;
              $param_pid = 3;

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
              $restopnewid = $restopnewid + 1; 
          }
        }

        if($_POST["rdalcohol"] == "noalcohol")
        {
          $sql = "UPDATE moreinfo SET moreinfotxt = (?), moreinfoimg = (?) WHERE restaurantid = ".$activeresto;
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "ss", $param_txt, $param_img);

              $param_txt = "No Alcohol Available";
              $param_img = "img/icons/x.png";
              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
          }
        }
        else
        {
          $sql = "UPDATE moreinfo SET moreinfotxt = (?), moreinfoimg = (?) WHERE restaurantid = ".$activeresto;
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "ss", $param_txt, $param_img);
              
              $param_txt = "Alcohol";
              $param_img = "img/icons/check.png";

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
          }
        }
        $sql = "DELETE FROM restaurantstype WHERE restaurantid = ".$activeresto;
        if($stmt = mysqli_prepare($link, $sql))
        {
          if(!mysqli_stmt_execute($stmt))
          {
            echo "Something went wrong. Please try again later.";
          }
        }
        for($c = 0; $c < $typecount; $c = $c + 1)
        {
          if($_POST["cbxtype1"] == $types[$c])
          {
              $sql = "INSERT INTO restaurantstype(restauranttypeid, restaurantid, typeid) VALUES (?, ?, ?)";
              if($stmt = mysqli_prepare($link, $sql))
              {
                  mysqli_stmt_bind_param($stmt, "iii", $param_rtid, $param_rid, $param_tid);
                  
                  $param_rtid = $restotnewid;
                  $param_rid = $activeresto;
                  $param_tid = $typeid[$c];

                  if(!mysqli_stmt_execute($stmt))
                  {
                      echo "Something went wrong. Please try again later.";
                  }
                  $restotnewid = $restotnewid + 1;
              }
          }
          if($_POST["cbxtype2"] == $types[$c] && $_POST["cbxtype2"] != $_POST["cbxtype1"])
          {
              $sql = "INSERT INTO restaurantstype(restauranttypeid, restaurantid, typeid) VALUES (?, ?, ?)";
              if($stmt = mysqli_prepare($link, $sql))
              {
                  mysqli_stmt_bind_param($stmt, "iii", $param_rtid, $param_rid, $param_tid);
                  
                  $param_rtid = $restotnewid;
                  $param_rid = $activeresto;
                  $param_tid = $typeid[$c];

                  if(!mysqli_stmt_execute($stmt))
                  {
                      echo "Something went wrong. Please try again later.";
                  }
                  $restotnewid = $restotnewid + 1;
              }
          }
        }
        $sql = "DELETE FROM restaurantscuisines WHERE restaurantid = ".$activeresto;
        if($stmt = mysqli_prepare($link, $sql))
        {
          if(!mysqli_stmt_execute($stmt))
          {
            echo "Something went wrong. Please try again later.";
          }
        }
        for($c = 0; $c < $ccount; $c = $c + 1)
        {
          if($_POST["cbxcuisine1"] == $cname[$c])
          {
              $sql = "INSERT INTO restaurantscuisines(restaurantcuisineid, restaurantid, cuisineid) VALUES (?, ?, ?)";
              if($stmt = mysqli_prepare($link, $sql))
              {
                  mysqli_stmt_bind_param($stmt, "iii", $param_rcid, $param_rid, $param_cid);
                  
                  $param_rcid = $restocnewid;
                  $param_rid = $activeresto;
                  $param_cid = $cid[$c];

                  if(mysqli_stmt_execute($stmt))
                  {
                    header("location: restaurant.php");
                  }
                  else
                  {
                    echo "Something went wrong. Please try again later.";  
                  }
                  $restocnewid = $restocnewid + 1;
              }
          }
          if($_POST["cbxcuisine2"] == $cname[$c] && $_POST["cbxcuisine2"] != $_POST["cbxcuisine1"])
          {
              $sql = "INSERT INTO restaurantscuisines(restaurantcuisineid, restaurantid, cuisineid) VALUES (?, ?, ?)";
              if($stmt = mysqli_prepare($link, $sql))
              {
                  mysqli_stmt_bind_param($stmt, "iii", $param_rcid, $param_rid, $param_cid);
                  
                  $param_rcid = $restocnewid;
                  $param_rid = $activeresto;
                  $param_cid = $cid[$c];

                  if(mysqli_stmt_execute($stmt))
                  {
                    header("location: restaurant.php");
                  }
                  else
                  {
                    echo "Something went wrong. Please try again later.";  
                  }
                  $restocnewid = $restocnewid + 1;
              }
          }
        }
        mysqli_stmt_close($stmt);
      }
    }
    mysqli_close($link);
  }
?>