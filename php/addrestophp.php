<?php
  require_once 'config.php';
  session_start();

  $restoname_err = "";
  $rescuis_err = "";
  $restype_err = "";
  $displaycuisines = "";
  $displaytypes = "";
  $displaycbxc = "";
  $menu_err = "";
  $fcuisine = 0;

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
        $displayaddresto = 
        " <a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
          <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
          <div class='dropdown-divider'></div>";
    }
  }

  function lastid($result, $sqlid)
  {
    if(mysqli_num_rows($result) == 0)
    {
      $lastid = 0;
      return $lastid; 
    }
    else
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $lastid = $row[$sqlid]; 
        return $lastid;
      }
    }
  }

  $sql = "SELECT restaurantid FROM restaurants ORDER BY restaurantid DESC LIMIT 1";
  $sqlid = 'restaurantid';
  $result = mysqli_query($link, $sql);
  $restolastid = lastid($result, $sqlid);
  $restonewid = $restolastid + 1;

  $sql = "SELECT restaurantcuisineid FROM restaurantscuisines ORDER BY restaurantcuisineid DESC LIMIT 1";
  $sqlid = 'restaurantcuisineid';
  $result = mysqli_query($link, $sql);
  $restoclastid = lastid($result, $sqlid);
  $restocnewid = $restoclastid + 1;

  $sql = "SELECT restaurantspaymentoptionsid FROM restaurantspaymentoptions ORDER BY restaurantspaymentoptionsid DESC LIMIT 1";
  $sqlid = 'restaurantspaymentoptionsid';
  $result = mysqli_query($link, $sql);
  $restoplastid = lastid($result, $sqlid);
  $restopnewid = $restoplastid + 1;
   
  $sql = "SELECT cuisineid FROM cuisine ORDER BY cuisineid DESC LIMIT 1";
  $sqlid = 'cuisineid';
  $result = mysqli_query($link, $sql);
  $cuisinelastid = lastid($result, $sqlid);
  $cuisinenewid = $cuisinelastid + 1;

  $sql = "SELECT moreinfoid FROM moreinfo ORDER BY moreinfoid DESC LIMIT 1";
  $sqlid = 'moreinfoid';
  $result = mysqli_query($link, $sql);
  $moreinfolastid = lastid($result, $sqlid);
  $moreinfonewid = $moreinfolastid + 1;

  $sql = "SELECT menuimageid FROM menuimage ORDER BY menuimageid DESC LIMIT 1";
  $sqlid = 'menuimageid';
  $result = mysqli_query($link, $sql);
  $menulastid = lastid($result, $sqlid);
  $menunewid = $menulastid + 1;

  $sql = "SELECT restauranttypeid FROM restaurantstype ORDER BY restauranttypeid DESC LIMIT 1";
  $sqlid = 'restauranttypeid';
  $result = mysqli_query($link, $sql);
  $restotlastid = lastid($result, $sqlid);
  $restotnewid = $restotlastid + 1;
   
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
    $displaytypes = $displaytypes.
    "<option value = '".$types[$ctr]."'>".$types[$ctr]."</option>";
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
    $displaycbxc = $displaycbxc."<option value = '".$cname[$ctr]."'>".$cname[$ctr]."</option>";
  }
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
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
      else
      {
        $restofolder = "img/uploads/qmark.jpg";
      }

      $mymenu = $_FILES["menu"];
      $menucount = count($mymenu["name"]);

      for($ctr = 0; $ctr < $menucount; $ctr++)
      {
        if($mymenu['size'][$ctr] == 0) 
        {
          $menu_err = "Please put an image.";
        }
        elseif(getimagesize($mymenu["tmp_name"][$ctr]) == false) 
        {
          $menu_err = "Not an image file.";
        }
        if(empty($menu_err))
        {
          $upload_image = $mymenu["name"][$ctr];
          $folder = "/xampp/htdocs/resto/img/uploads/";
          move_uploaded_file($mymenu["tmp_name"][$ctr], $folder.$mymenu["name"][$ctr]);
          $menufolder[$ctr] = "img/uploads/".$mymenu["name"][$ctr];
        }
      }

      if(empty($restoname_err) && empty($restocost_err) && empty($restype_err) && empty($rescuis_err))
      {
        $sql = "INSERT INTO restaurants(restaurantid, restaurantname, phonenumber, restaurant_price, restaurant_img) VALUES (?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "issis", $param_id, $param_name, $param_phone, $param_price, $param_img);
            
            $param_id = $restonewid;
            $param_name = $_POST["restoname"];
            $param_phone = $restomobile;
            $param_price = $_POST["restocost"];
            $param_img = $restofolder;

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
              $param_rid = $restonewid;
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
              $param_rid = $restonewid;
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
              $param_rid = $restonewid;
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
          $sql = "INSERT INTO moreinfo(moreinfoid, moreinfotxt, moreinfoimg, restaurantid) VALUES (?, ?, ?, ?)";
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "issi", $param_id, $param_txt, $param_img, $param_rid);
              
              $param_id = $moreinfonewid;
              $param_txt = "No Alcohol Available";
              $param_img = "img/icons/x.png";
              $param_rid = $restonewid;

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
              $moreinfonewid = $moreinfonewid + 1; 
          }
        }
        else
        {
          $sql = "INSERT INTO moreinfo(moreinfoid, moreinfotxt, moreinfoimg, restaurantid) VALUES (?, ?, ?, ?)";
          if($stmt = mysqli_prepare($link, $sql))
          {
              mysqli_stmt_bind_param($stmt, "issi", $param_id, $param_txt, $param_img, $param_rid);
              
              $param_id = $moreinfonewid;
              $param_txt = "Alcohol";
              $param_img = "img/icons/check.png";
              $param_rid = $restonewid;

              if(!mysqli_stmt_execute($stmt))
              {
                 echo "Something went wrong. Please try again later.";
              } 
              $moreinfonewid = $moreinfonewid + 1; 
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
                  $param_rid = $restonewid;
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
                  $param_rid = $restonewid;
                  $param_tid = $typeid[$c];

                  if(!mysqli_stmt_execute($stmt))
                  {
                      echo "Something went wrong. Please try again later.";
                  }
                  $restotnewid = $restotnewid + 1;
              }
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
                  $param_rid = $restonewid;
                  $param_cid = $cid[$c];

                  if(!mysqli_stmt_execute($stmt))
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
                  $param_rid = $restonewid;
                  $param_cid = $cid[$c];

                  if(!mysqli_stmt_execute($stmt))
                  {
                      echo "Something went wrong. Please try again later.";
                  }
                  $restocnewid = $restocnewid + 1;
              }
          }
        }
        if(empty($menu_err))
        {
          for($c = 0; $c < $menucount; $c = $c + 1)
          {
            $sql = "INSERT INTO menuimage(menuimageid, menuimage, restaurantid) VALUES (?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql))
            {
                mysqli_stmt_bind_param($stmt, "isi", $param_id, $param_img, $param_rid);
                
                $param_id = $menunewid;
                $param_img = $menufolder[$c];
                $param_rid = $restonewid;

                if(mysqli_stmt_execute($stmt))
                {
                  header("location: restaurant.php");
                } 
                else
                {
                  echo "Something went wrong. Please try again later.";
                }
                $menunewid = $menunewid + 1;
            }
          }
        }
        mysqli_stmt_close($stmt);
      }
    }
    mysqli_close($link);
  }
?>