<?php 
  require_once 'config.php';
  session_start();

  $currpassword = "";
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
      "<a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
       <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
       <div class='dropdown-divider'></div>";
    }
  }
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["namesub"]))
    {
      $sql = "UPDATE accounts SET firstname = (?), lastname = (?) WHERE email = '".$pemail."'";
      if($stmt = mysqli_prepare($link, $sql))
      {
          mysqli_stmt_bind_param($stmt, "ss", $param_fname, $param_lname);
          $param_fname = $_POST["settingsfname"];
          $param_lname = $_POST["settingslname"];
          
          if(mysqli_stmt_execute($stmt))
          {
            header("location: settings.php");
          } 
          else
          {
            echo "Something went wrong. Please try again later.";
          }
      }
    }
    if(isset($_POST["emailsub"]))
    {
      $sql = "UPDATE accounts SET email = (?) WHERE email = '".$pemail."'";
      if($stmt = mysqli_prepare($link, $sql))
      {
          mysqli_stmt_bind_param($stmt, "s", $param_email);
          $param_email = $_POST["settingsemail"];
          
          if(mysqli_stmt_execute($stmt))
          {
            session_start();
            $_SESSION['email'] = $_POST["settingsemail"];
            header("location: settings.php");
          } 
          else
          {
            echo "Something went wrong. Please try again later.";
          }
      }
    }
    if(isset($_POST["contactsub"]))
    {
      $sql = "UPDATE accounts SET mobilenumber = (?) WHERE email = '".$pemail."'";
      if($stmt = mysqli_prepare($link, $sql))
      {
          mysqli_stmt_bind_param($stmt, "s", $param_mobileno);
          $param_mobileno = $_POST["settingscontact"];
          
          if(mysqli_stmt_execute($stmt))
          {
            header("location: settings.php");
          } 
          else
          {
            echo "Something went wrong. Please try again later.";
          }
      }
    }
    if(isset($_POST["passsub"]))
    {
      $sql = "SELECT password FROM accounts WHERE email = '".$pemail."'";
      $result = mysqli_query($link, $sql);
      while($row = mysqli_fetch_assoc($result)) 
      {
        $pashword = $row["password"];
        if(password_verify($_POST["currentpass"], $pashword))
        {
          $f = "0";
        }
        else
        {
          $f = "1";
        }
      }
      if(empty(trim($_POST['currentpass'])))
      {
        $currpassword_err = "Please enter your password.";     
      }
      elseif($f == "1")
      {
        $currpassword_err = "Wrong Password";
      } 
      else
      {
        $currpassword = $_POST['currentpass'];
      }
      if(empty(trim($_POST['newpass'])))
      {
        $newpassword_err = "Please enter a new password.";     
      } 
      else
      {
        $newpassword = $_POST['newpass'];
      }
      
      if(empty(trim($_POST["confirmpass"])))
      {
        $confpassword_err = 'Please confirm password.';     
      } 
      else
      {
        $confpassword = $_POST['confirmpass'];
        if($newpassword != $confpassword)
        {
            $confpassword_err = 'Password did not match.';
        }
      }
      if(empty($newpassword_err) && empty($currpassword_err) && empty($confpassword_err))
      {
        $sqls = "UPDATE accounts SET password = (?) WHERE email  = '".$pemail."'";
        if($stmt = mysqli_prepare($link, $sqls))
        {
          mysqli_stmt_bind_param($stmt, "s", $param_password);

          $param_password = password_hash($newpassword, PASSWORD_DEFAULT);

          if(mysqli_stmt_execute($stmt))
          {
            header("location: settings.php");
          } 
          else
          {
            echo "Something went wrong. Please try again later.";
          }
        }
        mysqli_stmt_close($stmt);
      }
    }
    mysqli_close($link);
  }
?>