<?php 
	require_once 'config.php';

	$restodisplay = "";
	$callmodal = "";
	$cuisinedisplay = "";
	$displayaddresto = "";
	$displayaddfood = "";
	$plvl = 0;
	$displayno = 0;
	session_start();	

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

	function price($result)
	{
		for($pricesql = 0; $row = mysqli_fetch_assoc($result); $pricesql++){}
		return $pricesql;
	}

	function typecuisine($result, $sqltc)
	{
		for($previd = -1; $row = mysqli_fetch_assoc($result); $previd = $restid)
		{
			$restid = $row["restaurantid"] - 1;
			if($restid == $previd)
			{
				$storetag = $row[$sqltc];
				$rtag[$restid] = $rtag[$restid].", ".$storetag;
			}
			else
			{
				$storetag = $row[$sqltc];
				$rtag[$restid] = $storetag; 
			}
		}
		return $rtag;
	}

	function filter($result, $sqltc, $rid, $array)
	{
		for($previd = -1; $row = mysqli_fetch_assoc($result); $previd = $rid - 1)
		{
			$restid = $rid - 1;
			if($restid == $previd)
			{
				$storetag = $row[$sqltc];
				$rtag[$array] = $rtag[$array].", ".$storetag;
			}
			else
			{
				$storetag = $row[$sqltc];
				$rtag[$array] = $storetag;
			}
		}
		return $rtag[$array];
	}

	$sql = "SELECT * FROM restaurants WHERE restaurant_price < 350";
	$result = mysqli_query($link, $sql);
	$no350 = price($result);

	$sql = "SELECT * FROM restaurants WHERE restaurant_price > 350 AND restaurant_price < 700";
	$result = mysqli_query($link, $sql);
	$no700 = price($result);

	$sql = "SELECT * FROM restaurants WHERE restaurant_price > 700 AND restaurant_price < 1400";
	$result = mysqli_query($link, $sql);
	$no1400 = price($result);
	
	$sql = "SELECT * FROM restaurants WHERE restaurant_price > 1400";
	$result = mysqli_query($link, $sql);
	$nomore = price($result);
	
	$sql = "SELECT restaurantid FROM restaurants ORDER BY restaurantid DESC LIMIT 1";
	$sqlid = 'restaurantid';
	$result = mysqli_query($link, $sql);
	$lastidr = lastid($result, $sqlid);
	$displayno = $lastidr;

	$sql = "SELECT cuisineid FROM cuisine ORDER BY cuisineid DESC LIMIT 1";
	$sqlid = 'cuisineid';
	$result = mysqli_query($link, $sql);
	$lastidc = lastid($result, $sqlid);

	for($ctr = 1; $ctr <= $lastidr; $ctr = $ctr + 1)
	{
		$arr = $ctr - 1;
		$sql = "SELECT * FROM restaurants WHERE restaurantid = ".$ctr;
		$result = mysqli_query($link, $sql);

		while($row = mysqli_fetch_assoc($result)) 
		{
		  $rid[$arr] = $row["restaurantid"];
		  $rname[$arr] = $row["restaurantname"];
		  $rphone[$arr] = $row["phonenumber"];
		  $rprice[$arr] = $row["restaurant_price"];
		  $rimg[$arr] = $row["restaurant_img"];
		}
		$rmodal[$arr] = "call".$arr;
	}
 
	if(!isset($_SESSION['email']) || empty($_SESSION['email']))
	{ 
		$accountnav =   
	   "<li class='nav-item'>
	        <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#loginModal'>
	        	Log In
	        </button>
	    </li>
	    <li class='nav-item'>
	        <a class='nav-link' href='register.php'>Sign Up</a>
	    </li>";
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
		   "<a class='dropdown-item' href='addresto.php'>Add a Restaurant</a>
	        <a class='dropdown-item' href='adminbook.php'>Customer Bookings</a>
	        <div class='dropdown-divider'></div>";
		}

	  	$accountnav = 
	   "<div class='btn-group'>
	    	<a href='profile.php'>
	        	<button type='button' class='btn btn-light'>".$pfname."</button>
	        </a>
	        <button type='button' class='btn btn-light dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
	            <span class='sr-only'>Toggle Dropdown</span>
	        </button>
	        <div class='dropdown-menu dropdown-menu-right'>".$displayaddresto."
	            <a class='dropdown-item' href='mybookings.php'>My Bookings</a>
	            <a class='dropdown-item' href='settings.php'>Settings</a>
	            <div class='dropdown-divider'></div>
	            <a class='dropdown-item' href='logout.php'>Log Out</a>
	        </div>
	    </div>";
	}

	if(isset($_COOKIE["bookid"])) 
	{
	    unset($_COOKIE["bookid"]);
	    setcookie("bookid", '', time() - 3600, '/'); 
	    
	    $sql = "DELETE FROM book WHERE bookconfirmation = 'no'";

		if($stmt = mysqli_prepare($link, $sql))
		{
			if(!mysqli_stmt_execute($stmt))
			{
				echo "Something went wrong. Please try again later.";
			}
		}
	}

	$sql = "SELECT * FROM cuisine";
	$result = mysqli_query($link, $sql);
	for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
	{
		$cuisine[$ctr] = $row["cuisine"];
	}

	$sql = "SELECT DISTINCT cuisine FROM restaurantscuisines JOIN cuisine ON restaurantscuisines.cuisineid = cuisine.cuisineid WHERE restaurantscuisines.cuisineid IS NOT NULL";
	$result = mysqli_query($link, $sql);

	for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
	{
		$havecuisine[$ctr] = $row["cuisine"];
	}
	$havecuisineno = $ctr;

	for($ctr = 0; $ctr < $havecuisineno; $ctr++)
	{
		$sql = "SELECT * FROM restaurants JOIN restaurantscuisines ON restaurantscuisines.restaurantid = restaurants.restaurantid JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid WHERE cuisine = '".$havecuisine[$ctr]."'";

		$result = mysqli_query($link, $sql);
		$nocuisine[$ctr] = 0;
		for($d = 0; $row = mysqli_fetch_assoc($result); $d++)
		{
			$nocuisine[$ctr] = $nocuisine[$ctr] + 1;
		}
	}

	$sql = "SELECT DISTINCT cuisine FROM restaurantscuisines JOIN cuisine ON restaurantscuisines.cuisineid = cuisine.cuisineid WHERE restaurantscuisines.cuisineid IS NOT NULL";
	$result = mysqli_query($link, $sql);
	for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
	{
		$cuisinedisplay = $cuisinedisplay.
		"<div class='btn-group'>
			<input type='submit' name='".$havecuisine[$ctr]."' class='btn btn-light' value = '".$havecuisine[$ctr]."' id='filterin'>
			<input type='button' id = 'allplus' data-toggle='buttons' class='btn btn-light' value = '".$nocuisine[$ctr]."' disabled>
		</div><br>";
	}

	
	$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid ORDER BY restaurantscuisines.restaurantid";
	$result = mysqli_query($link, $sql);
	$rcuisine = typecuisine($result, "cuisine");

	$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid ORDER BY restaurantstype.restaurantid";
	$result = mysqli_query($link, $sql);
	$rtype = typecuisine($result, "type");

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		for($ctr = 0; $ctr < $lastidc; $ctr++)
		{
			if(isset($_POST[$cuisine[$ctr]]))
			{
				$sql = "SELECT * FROM restaurants JOIN restaurantscuisines ON restaurantscuisines.restaurantid = restaurants.restaurantid JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid WHERE cuisine = '".$cuisine[$ctr]."'";

				$result = mysqli_query($link, $sql);
				for($i = 0; $row = mysqli_fetch_assoc($result); $i++)
				{
					$rid[$i] = $row["restaurantid"];
					$rname[$i] = $row["restaurantname"];
					$rphone[$i] = $row["phonenumber"];
					$rprice[$i] = $row["restaurant_price"];
					$rimg[$i] = $row["restaurant_img"];
				}
				$displayno = $i;
				
				for($i = 0; $i < $displayno; $i++)
				{
					$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = '".$rid[$i]."' ORDER BY restaurantscuisines.restaurantid";
					$result = mysqli_query($link, $sql);
					$rcuisine[$i] = filter($result, "cuisine", $rid[$i], $i);	
				}
				for($i = 0; $i < $displayno; $i++)
				{
					$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = '".$rid[$i]."' ORDER BY restaurantstype.restaurantid";
					$result = mysqli_query($link, $sql);
					$rtype[$i] = filter($result, "type", $rid[$i], $i);	
				}
			}
		}

		if(isset($_POST["less350"]))
		{ 
			$sql = "SELECT * FROM restaurants WHERE restaurant_price < 350";
			$result = mysqli_query($link, $sql);
		  	for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
		  	{
				$rid[$ctr] = $row["restaurantid"];
				$rname[$ctr] = $row["restaurantname"];
				$rphone[$ctr] = $row["phonenumber"];
				$rprice[$ctr] = $row["restaurant_price"];
				$rimg[$ctr] = $row["restaurant_img"];
		  	}
		  	$displayno = $ctr;
		
			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = '".$rid[$i]."' ORDER BY restaurantscuisines.restaurantid";
				$result = mysqli_query($link, $sql);
				$rcuisine[$i] = filter($result, "cuisine", $rid[$i], $i);		
			}
			for($i = 0; $i < $displayno; $i++)
			{
			  	$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = '".$rid[$i]."' ORDER BY restaurantstype.restaurantid";
				$result = mysqli_query($link, $sql);
				$rtype[$i] = filter($result, "type", $rid[$i], $i);		
			}
		}

		if(isset($_POST["less700"]))
		{ 
		  	$sql = "SELECT * FROM restaurants WHERE restaurant_price > 350 AND restaurant_price < 700";
			$result = mysqli_query($link, $sql);
			for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
			{
				$rid[$ctr] = $row["restaurantid"];
				$rname[$ctr] = $row["restaurantname"];
				$rphone[$ctr] = $row["phonenumber"];
				$rprice[$ctr] = $row["restaurant_price"];
				$rimg[$ctr] = $row["restaurant_img"];
		  	}
		  	$displayno = $ctr;

			for($i = 0; $i < $displayno; $i++)
			{
			  	$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = '".$rid[$i]."' ORDER BY restaurantscuisines.restaurantid";
				$result = mysqli_query($link, $sql);
				$rcuisine[$i] = filter($result, "cuisine", $rid[$i], $i);		
			}	

			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = '".$rid[$i]."' ORDER BY restaurantstype.restaurantid";
				$result = mysqli_query($link, $sql);
				$rtype[$i] = filter($result, "type", $rid[$i], $i);		
			}
		}
		if(isset($_POST["less1400"]))
		{ 
			$sql = "SELECT * FROM restaurants WHERE restaurant_price > 700 AND restaurant_price < 1400";
			$result = mysqli_query($link, $sql);
			for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
			{
				$rid[$ctr] = $row["restaurantid"];
				$rname[$ctr] = $row["restaurantname"];
				$rphone[$ctr] = $row["phonenumber"];
				$rprice[$ctr] = $row["restaurant_price"];
				$rimg[$ctr] = $row["restaurant_img"];
			}
			$displayno = $ctr;

			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = '".$rid[$i]."' ORDER BY restaurantscuisines.restaurantid";
				$result = mysqli_query($link, $sql);
				$rcuisine[$i] = filter($result, "cuisine", $rid[$i], $i);		
			}

			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = '".$rid[$i]."' ORDER BY restaurantstype.restaurantid";
				$result = mysqli_query($link, $sql);
				$rtype[$i] = filter($result, "type", $rid[$i], $i);		
			}
		}
		
		if(isset($_POST["more1400"]))
		{ 
			$sql = "SELECT * FROM restaurants WHERE restaurant_price > 1400";
			$result = mysqli_query($link, $sql);
			for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
			{
				$rid[$ctr] = $row["restaurantid"];
				$rname[$ctr] = $row["restaurantname"];
				$rphone[$ctr] = $row["phonenumber"];
				$rprice[$ctr] = $row["restaurant_price"];
				$rimg[$ctr] = $row["restaurant_img"];
			}
			$displayno = $ctr;

			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = '".$rid[$i]."' ORDER BY restaurantscuisines.restaurantid";
				$result = mysqli_query($link, $sql);
				$rcuisine[$i] = filter($result, "cuisine", $rid[$i], $i);		
			}

			for($i = 0; $i < $displayno; $i++)
			{	  	
				$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = '".$rid[$i]."' ORDER BY restaurantstype.restaurantid";
				$result = mysqli_query($link, $sql);
				$rtype[$i] = filter($result, "type", $rid[$i], $i);	
			}
		}
		if(isset($_POST["searchbtn"]))
		{
			$searchresto = $_POST["searchtxt"];
			$sql = "SELECT * FROM restaurants WHERE restaurantname LIKE '%".$searchresto."%'";
			$result = mysqli_query($link, $sql);
			for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
			{
				$rid[$ctr] = $row["restaurantid"];
				$rname[$ctr] = $row["restaurantname"];
				$rphone[$ctr] = $row["phonenumber"];
				$rprice[$ctr] = $row["restaurant_price"];
				$rimg[$ctr] = $row["restaurant_img"];
			}
			$displayno = $ctr;

			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = '".$rid[$i]."' ORDER BY restaurantscuisines.restaurantid";
				$result = mysqli_query($link, $sql);
				$rcuisine[$i] = filter($result, "cuisine", $rid[$i], $i);		
			}

			for($i = 0; $i < $displayno; $i++)
			{
				$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = '".$rid[$i]."' ORDER BY restaurantstype.restaurantid";
				$result = mysqli_query($link, $sql);
				$rtype[$i] = filter($result, "type", $rid[$i], $i);		
			}
		}
		if(isset($_POST["detaillink"]))
		{
			if(isset($_COOKIE["restoidcookie"]))
			{
				unset($_COOKIE["restoidcookie"]);
				setcookie("restoidcookie", '', time() - 3600, '/'); 
			}
			$cookie_name = "restoidcookie";
			$cookie_value = $_POST["restoidd"];
			$cookie_expire = time() + 3000;
			setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
			header("location: restoinfo.php");

		}
		if(isset($_POST["booklink"]))
		{
			if(isset($_COOKIE["restoidcookie"]))
			{
				unset($_COOKIE["restoidcookie"]);
				setcookie("restoidcookie", '', time() - 3600, '/'); 
			}
			$cookie_name = "restoidcookie";
			$cookie_value = $_POST["restoidb"];
			$cookie_expire = time() + 3000;
			setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
			header("location: bookinfo.php");
		}
		if(isset($_POST["adddishlink"]))
		{
			if(isset($_COOKIE["restoidcookie"]))
			{
				unset($_COOKIE["restoidcookie"]);
				setcookie("restoidcookie", '', time() - 3600, '/'); 
			}
			$cookie_name = "restoidcookie";
			$cookie_value = $_POST["restoidad"];
			$cookie_expire = time() + 3000;
			setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
			header("location: addfood.php");
		}
		if(isset($_POST["editinfo"]))
		{
			if(isset($_COOKIE["restoidcookie"]))
			{
				unset($_COOKIE["restoidcookie"]);
				setcookie("restoidcookie", '', time() - 3600, '/'); 
			}
			$cookie_name = "restoidcookie";
			$cookie_value = $_POST["restoidad"];
			$cookie_expire = time() + 3000;
			setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
			header("location: editresto.php");
		}
	}

for($c = 0; $c < $displayno; $c = $c + 1)
{
	if($plvl == 1)
	{
		$displayaddfood = 
		"<form method='post'>
			<input type='hidden' name='restoidad' value='".$rid[$c]."'>
			<input type='submit' name='editinfo' class='btn btn-outline-dark btn-sm' value = 'Edit Details'><br><br>
			<input type='submit' name='adddishlink' class='btn btn-outline-dark btn-sm' value = 'Edit Menu'>
		</form>";
	}
	$restodisplay = $restodisplay.
	"<div class='card' id='cardresto'>

      <div class='row'>

        <div class='col-sm-4 col-md-3 col-lg-3'>
          <img src='".$rimg[$c]."' id='restoimg'>
        </div>

        <div class='col-sm-5 col-md-7 col-lg-6'>
          <small class='text-muted'>".$rtype[$c]."</small><br>
          <h2>".$rname[$c]."</h2>
        </div>
        <div class='col-sm-2 col-md-2 col-lg-2'>
    	  ".$displayaddfood."
        </div>

      </div><!-- row -->
      <div class='row'>
        <table>
          <tbody>
            <tr>
              <td><small class='text-muted restolbl'>CUISINES: </small></td>
              <td><small class='restocont'>".$rcuisine[$c]."</small></td>
            </tr>
            <tr>
              <td><small class='text-muted restolbl'>COST FOR TWO</small></td>
              <td><small class='restocont'>PHP".$rprice[$c]."</small></td>
            </tr>
            <!--
            <tr>
              <td><small class='text-muted restolbl'>HOURS: </small></td>
              <td><small class='restocont'>9AM-9PM (Mon-Sun)</small></td>
            </tr>
            -->
          </tbody>
        </table>
      </div><!-- row -->

      <div class='row'>
        <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
          <button type='button' class='btn btn-light call' data-toggle='modal' data-target='#".$rmodal[$c]."'>
            <bold>Call</bold>
          </button>
        </div>
        <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
          <form method='post'>
          	<input type='hidden' name='restoidd' value='".$rid[$c]."'>
            <input type='submit' name='detaillink' class='btn btn-light call' value = 'Details'>
          </form>
        </div>
        <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
			<form method='post'>
				<input type='hidden' name='restoidb' value='".$rid[$c]."'>
				<input type='submit' name='booklink' class='btn btn-outline-info call' value = 'Book a Table'>
			</form>
        </div>
      </div>
    </div>";

    $callmodal = $callmodal.
	 "<div class='modal fade' id='".$rmodal[$c]."' tabindex='-1' role='dialog' aria-labelledby='".$rmodal[$c]."' aria-hidden='true'>
	  <div class='modal-dialog modal-dialog-centered' role='document'>
	    <div class='modal-content'>
	      <div class='modal-header'>
	        <h5 class='modal-title' id='exampleModalLongTitle'>".$rname[$c]."</h5>
	        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
	          <span aria-hidden='true'>&times;</span>
	        </button>
	      </div>
	      <div class='modal-body'>
	        <center><bold>Phone number: </bold></center><br>
	        <center>".$rphone[$c]."</center>
	      </div>
	    </div>
	  </div>
	</div>";
}
require_once 'loginphp.php';
?>