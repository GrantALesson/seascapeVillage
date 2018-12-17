<?php
  require_once 'config.php';
 
  $lemail = "";
  $lpassword = "";
  $lemail_err = "";
  $lpassword_err = "";
  $error = "";
   
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["lsubmit"]))
    {
      if(empty($_POST["lemail"]))
      {
        $lemail_err = 'Please enter your email.';
      } 
      else
      {
        $lemail = $_POST["lemail"];
      }

      if(empty($_POST['lpassword']))
      {
        $lpassword_err = 'Please enter your password.';
      } 
      else
      {
        $lpassword = $_POST['lpassword'];
      }
      if(empty($lemail_err) && empty($lpassword_err))
      {
        $sql = "SELECT email, password FROM accounts WHERE email = ?";
        if($stmt = mysqli_prepare($link, $sql))
        {
          mysqli_stmt_bind_param($stmt, "s", $param_email);
          $param_email = $lemail;
          
          if(mysqli_stmt_execute($stmt))
          {
            mysqli_stmt_store_result($stmt);
                  
            if(mysqli_stmt_num_rows($stmt) == 1)
            {                    
              mysqli_stmt_bind_result($stmt, $lemail, $hpassword);
              
              if(mysqli_stmt_fetch($stmt))
              {
                if(password_verify($lpassword, $hpassword))
                {
                  session_start();
                  $_SESSION['email'] = $lemail;      
                  header("location: home.php");
                }
                else
                {
                  $lpassword_err = 'The password you entered was not valid.';
                  $error = "<div class='alert alert-danger'>Email or Password is incorrect.</div>";
                }
              }
            } 
            else
            {
              $lemail_err = 'No account found with that email.';
              $error = "<div class='alert alert-danger'>Email or Password is incorrect.</div>";
            }
          } 
          else
          {
            echo "Oops! Something went wrong. Please try again later.";
          }
          mysqli_stmt_close($stmt);
        }
      }
      else
      {
        header("location: login.php");
      }
    }
    mysqli_close($link);
  }
?>