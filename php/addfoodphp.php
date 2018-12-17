<?php
  require_once 'config.php';

  $menuitems = "";
  $categorydisplay = "";
  $displaymodal = "";

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

  $sql = "SELECT foodid FROM food ORDER BY foodid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  if(mysqli_num_rows($result) == 0)
  {
    $foodlastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $foodlastid = $row["foodid"]; 
    }
  }
  $foodnewid = $foodlastid + 1;

  $c = 0;
  $sql = "SELECT * FROM food WHERE restaurantid = ".$activeresto;
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)) 
  {
    $fid[$c] = $row["foodid"];
    $fname[$c] = $row["foodname"];
    $fprice[$c] = $row["foodprice"];
    $foodtype[$c] = $row["foodtype"];
    $fimg[$c] = $row["foodimgpath"];
    $editdishmodal[$c] = "editdishmodal".$fid[$c];
    $edishname[$c] = "editname".$fid[$c];
    $edishprice[$c] = "editprice".$fid[$c];
    $edishtype[$c] = "edittype".$fid[$c];
    $edishimg[$c] = "editimg".$fid[$c];
    $esubdish[$c] = "editsub".$fid[$c];
    $dsubdish[$c] = "delsub".$fid[$c];
    $c = $c + 1;
  }
  $displayno = $c;

  $prevtype = "";
  $foodcount = [];
  $c = -1;
  $sql = "SELECT foodtype FROM food WHERE restaurantid = ".$activeresto." ORDER BY foodtype";
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result))
  {
    $currtype = $row["foodtype"];
    if($currtype == $prevtype)
    {
      $foodcount[$c] = $foodcount[$c] + 1;
    }
    else
    {
      $c = $c + 1;
      $ftype[$c] = $currtype;
      $categoryname[$c] = str_replace(" ","",$ftype[$c]);
      $foodcount[$c] = 1;
    }
    $prevtype = $row["foodtype"];
  }
  $typecount = $c;

  for($c = 0; $c <= $typecount; $c = $c + 1)
  {
    $categorydisplay = $categorydisplay.
    "
      <div class='btn-group'>
        <input type='submit' name='c".$categoryname[$c]."' class='btn btn-light' value = '".$ftype[$c]."' id='filterin'>
        <input type='button' id = 'ccount' data-toggle='buttons' class='btn btn-light' value = '".$foodcount[$c]."' disabled>
      </div>
    ";
  }
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["subdish"]))
    {
      if(empty($_POST["dishname"]))
      {
        $dishname_err = "Please provide a dish name.";
      }
      if(empty($_POST["dishprice"]))
      {
        $dishprice_err = "Please provide a dish price.";
      }
      if(empty($_POST["dishtype"]))
      {
        $dishtype_err = "Please provide a dish type.";
      }
      if($_FILES['dishimg']['size'] == 0) 
      {
        $dishimg_err = "Please put an image.";
      }
      elseif(getimagesize($_FILES["dishimg"]["tmp_name"]) == false) 
      {
        $dishimg_err = "Not an image file.";
      }
      if(empty($dishimg_err))
      {
        $upload_image = $_FILES["dishimg"]["name"];
        $folder = "/xampp/htdocs/resto/img/uploads/";
        move_uploaded_file($_FILES["dishimg"]["tmp_name"], $folder.$_FILES["dishimg"]["name"]);
        $dishfolder = "img/uploads/".$_FILES["dishimg"]["name"];
      }
      else
      {
        $dishfolder = "img/uploads/qmark.jpg";
      }
      if(empty($dishname_err) && empty($dishprice_err) && empty($dishtype_err))
      {
        $sql = "INSERT INTO food(foodid, foodname, foodprice, foodtype, foodimgpath, restaurantid) VALUES (?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "isissi", $param_id, $param_name, $param_price, $param_type, $param_img, $param_rid);

            $param_id = $foodnewid;
            $param_name = $_POST["dishname"];
            $param_price = $_POST["dishprice"];
            $param_type = $_POST["dishtype"];
            $param_img = $dishfolder;
            $param_rid = $activeresto;

            if(mysqli_stmt_execute($stmt))
            {
                header("location: addfood.php");
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
            }
        }
      }
      mysqli_stmt_close($stmt);
    } 
    for($c = 0; $c <= $typecount; $c = $c + 1)
    {
      if(isset($_POST["c".$categoryname[$c]]))
      {
        $d = 0;
        $sql = "SELECT * FROM food WHERE restaurantid = ".$activeresto." AND foodtype = '".$ftype[$c]."'";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)) 
        {
          $fname[$d] = $row["foodname"];
          $fprice[$d] = $row["foodprice"];
          $fimg[$d] = $row["foodimgpath"];
          $fid[$d] = $row["foodid"];
          $d = $d + 1;
        }
        $displayno = $foodcount[$c];
      }
    } 
    for($c = 0; $c < $displayno; $c = $c + 1)
    {
      if(isset($_POST[$esubdish[$c]]))
      {
        if(empty($_POST[$edishname[$c]]))
        {
          $dishname_err = "Please provide a dish name.";
        }
        if(empty($_POST[$edishprice[$c]]))
        {
          $dishprice_err = "Please provide a dish price.";
        }
        if(empty($_POST[$edishtype[$c]]))
        {
          $dishtype_err = "Please provide a dish type.";
        }
        if($_FILES[$edishimg[$c]]['size'] == 0) 
        {
          $dishimg_err = "Please put an image.";
        }
        elseif(getimagesize($_FILES[$edishimg[$c]]["tmp_name"]) == false) 
        {
          $dishimg_err = "Not an image file.";
        }
        $upload_image = $_FILES[$edishimg[$c]]["name"];
        $folder = "/xampp/htdocs/resto/img/uploads/";
        move_uploaded_file($_FILES[$edishimg[$c]]["tmp_name"], $folder.$_FILES[$edishimg[$c]]["name"]);
        $dishfolder = "img/uploads/".$_FILES[$edishimg[$c]]["name"];
        
        if(empty($dishname_err) && empty($dishprice_err) && empty($dishtype_err) && $dishimg_err == "Please put an image.")
        {
          $sql = "UPDATE food SET foodname = (?), foodprice = (?), foodtype = (?) WHERE foodid = ".$fid[$c];
          if($stmt = mysqli_prepare($link, $sql))
          {
            mysqli_stmt_bind_param($stmt, "sis", $param_name, $param_price, $param_type);

            $param_name = $_POST[$edishname[$c]];
            $param_price = $_POST[$edishprice[$c]];
            $param_type = $_POST[$edishtype[$c]];

            if(mysqli_stmt_execute($stmt))
            {
              header("location: addfood.php");
            }
            else
            {
              echo "Something went wrong. Please try again later.";
            }
          }
        }
        elseif(empty($dishname_err) && empty($dishprice_err) && empty($dishtype_err) && empty($dishimg_err))
        {
          $sql = "UPDATE food SET foodname = (?), foodprice = (?), foodtype = (?), foodimgpath = (?) WHERE foodid = ".$fid[$c];
          if($stmt = mysqli_prepare($link, $sql))
          {
            mysqli_stmt_bind_param($stmt, "siss", $param_name, $param_price, $param_type, $param_img);

            $param_name = $_POST[$edishname[$c]];
            $param_price = $_POST[$edishprice[$c]];
            $param_type = $_POST[$edishtype[$c]];
            $param_img = $dishfolder;

            if(mysqli_stmt_execute($stmt))
            {
              header("location: addfood.php");
            }
            else
            {
              echo "Something went wrong. Please try again later.";
            }
          }
        }
        mysqli_stmt_close($stmt);
      }
      if(isset($_POST[$dsubdish[$c]]))
      {
        $d = 0;
        $sql = "SELECT * FROM food";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
          $foodsid[$d] = $row["foodid"];
          $d = $d + 1; 
        }
        $sql = "DELETE FROM food WHERE foodid = ".$fid[$c];
        if($stmt = mysqli_prepare($link, $sql))
        {
          if(mysqli_stmt_execute($stmt))
          {
            header("location: addfood.php");
          }
          else
          {
            echo "Something went wrong. Please try again later.";
          }
        }
        mysqli_stmt_close($stmt);
        for($e = 1; $e < $d; $e = $e + 1)
        {
          if($e > $fid[$c])
          {
              $newid = $e - 1;
              $sql = "UPDATE food SET foodid = ".$newid." WHERE id = ".$e;
                if($stmt = mysqli_prepare($link, $sql))
                {
                    mysqli_stmt_bind_param($stmt, "i", $param_id);

                    $param_id = $newid;
                    
                    if(mysqli_stmt_execute($stmt)){
                        header("location: addfood.php");
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                
                }
                mysqli_stmt_close($stmt);
          }
        }
      }
    }
    mysqli_close($link);
  }

  for($c = 0; $c < $displayno; $c = $c + 1)
  {
    $displaymodal = $displaymodal.
    "<div class='modal' id='".$editdishmodal[$c]."' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <form class = 'form' enctype='multipart/form-data' method='post'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Edit Dish</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          </div>
          <div class='modal-body'>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Dish Name</label>
              <div class='col-sm-9'>
                <input type = 'text' class = 'form-control' name = '".$edishname[$c]."' value = '".$fname[$c]."'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Price</label>
              <div class='col-sm-9'>
                <input type = 'text' class = 'form-control' name = '".$edishprice[$c]."' value = '".$fprice[$c]."'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Food Type</label>
              <div class='col-sm-9'>
                <input type = 'text' class = 'form-control' name = '".$edishtype[$c]."' value = '".$foodtype[$c]."'>
              </div>
            </div>
            <div class='form-group row'>
              <label class='col-sm-3 col-form-label'>Upload</label>
              <div class='col-sm-9'>
                <input type='file' class='form-control-file' name = '".$edishimg[$c]."' accept='.png, .jpg, .jpeg'>
              </div>
            </div>
          </div>
          <div class='modal-footer'>
            <input type = 'submit' class = 'btn btn-danger' name = '".$dsubdish[$c]."' value = 'Delete Dish'>
            <input type = 'submit' class = 'btn btn-info' name = '".$esubdish[$c]."' value = 'Edit Dish'>
          </div>
          </form>
        </div>
      </div>
    </div>
    ";
    $menuitems = $menuitems. 
    "<div id = 'menuitems' class = 'well col-lg-3 col-md-4 col-sm-4'  data-toggle='modal' data-target='#".$editdishmodal[$c]."' >
      <img src = '".$fimg[$c]."'><br>
      <div id = 'menuitemtxt'>
        ".$fname[$c]."<br>
        PHP ".$fprice[$c].".00
      </div>
    </div>";
  }
?>