<?php
  require_once 'config.php';
  $remail = "";
  $rpassword = "";
  $confirm_password = "";
  $remail_err = "";
  $rpassword_err = "";
  $confirm_password_err = "";
  $contactno_err = "";
 
  $sql = "SELECT accid FROM accounts ORDER BY accid DESC LIMIT 1";
  $result = mysqli_query($link, $sql);
  // last id for the food table
  if(mysqli_num_rows($result) == 0)
  {
    $acclastid = 0; 
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $acclastid = $row["accid"]; 
    }
  }
  $accnewid = $acclastid + 1;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["regsubmit"]))
    {
      if(empty($_POST["regemail"]))
      {
        $remail_err = "*Please enter your email.";
      }
      elseif(!filter_var($_POST["regemail"], FILTER_VALIDATE_EMAIL)) 
      { 
        $remail_err = "Invalid email format"; 
      } 
      else
      {
        $sql = "SELECT accid FROM accounts WHERE email = ?";
      
        if($stmt = mysqli_prepare($link, $sql))
        {
          mysqli_stmt_bind_param($stmt, "s", $param_email);
          $param_email = trim($_POST["regemail"]);
        
          if(mysqli_stmt_execute($stmt))
          {
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                $remail_err = "*This email is already taken.";
            } 
            else
            {
                $remail = $_POST["regemail"];
            }
          } 
          else
          {
            echo "Oops! Something went wrong. Please try again later.";
          }
        }
      }
      
      if(empty(trim($_POST['regpassword'])))
      {
        $rpassword_err = "*Please enter a password.";     
      } 
      else
      {
        $rpassword = $_POST['regpassword'];
      }
    
      if(empty(trim($_POST["regconfirm_password"])))
      {
        $confirm_password_err = '*Please confirm password.';     
      } 
      else
      {
        $confirm_password = $_POST["regconfirm_password"];
        if($rpassword != $confirm_password)
        {
          $confirm_password_err = '*Password did not match.';
        }
      }

      $firstname = $_POST['regfname'];
      $lastname = $_POST['reglname'];
      
      if(strlen($_POST['regcontact']) != 11)
      {
        $contactno_err = '*Please enter an 11-digit number';
      }
      elseif(substr(($_POST['regcontact']), 0, 2) != "09")  
      {
        $contactno_err = '*Please enter a valid contact number';
      }
      else
      {
        $contactno = $_POST['regcontact'];
      }
    
      if(empty($remail_err) && empty($rpassword_err) && empty($confirm_password_err) && empty($contactno_err))
      {
        $sql = "INSERT INTO accounts(accid, email, password, firstname, lastname, mobilenumber, level) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql))
        {
          mysqli_stmt_bind_param($stmt, "isssssi", $param_id, $param_email, $param_password, $param_fname, $param_lname, $param_mobile, $param_level);
          
          $param_id = $accnewid;
          $param_email = $remail;
          $param_password = password_hash($rpassword, PASSWORD_DEFAULT);
          $param_fname = $firstname;
          $param_lname = $lastname;
          $param_mobile = $contactno;
          $param_level = 2;

          if(mysqli_stmt_execute($stmt))
          {
              header("location: login.php");
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
  require_once 'loginphp.php';
?>