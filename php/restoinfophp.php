<?php
	require_once 'config.php';

	$menulist = "";
	$displaymoreinfo = "";
	$displayoptions = "";
	$displayaddresto = "";
	$displaytime = "";

	session_start();

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

	if(isset($_COOKIE["restoidcookie"]))
	{
		$sql = "SELECT * FROM restaurants WHERE restaurantid = ". $_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		while($row = mysqli_fetch_assoc($result)) 
		{
			$rname = $row["restaurantname"];
			$rphone = $row["phonenumber"];
			$rprice = $row["restaurant_price"];
			$rimg = $row["restaurant_img"];
		}

		$sql = "SELECT * FROM moreinfo WHERE restaurantid = ". $_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
		{
			$infotxt[$ctr] = $row["moreinfotxt"];
			$infoimg[$ctr] = $row["moreinfoimg"];
		}
		$infono = $ctr;

		for($c = 0; $c < $infono; $c = $c + 1)
		{
			$displaymoreinfo = $displaymoreinfo."<img src='".$infoimg[$c]."'> ".$infotxt[$c]."<br>";
		}
	
		$sql = "SELECT * FROM restaurantspaymentoptions JOIN paymentoptions ON paymentoptions.paymentoptionsid = restaurantspaymentoptions.paymentoptionsid JOIN restaurants ON restaurants.restaurantid = restaurantspaymentoptions.restaurantid WHERE restaurantspaymentoptions.restaurantid = ".$_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
		{
			$paymentoptiontxt[$ctr] = $row["paymentoption"];
		}
		$optionno = $ctr;

		for($c = 0; $c < $optionno; $c = $c + 1)
		{
			$displayoptions = $displayoptions."<p>".$paymentoptiontxt[$c]."</p>";
		}

		$sql = "SELECT * FROM restaurantscuisines JOIN cuisine ON cuisine.cuisineid = restaurantscuisines.cuisineid JOIN restaurants ON restaurants.restaurantid = restaurantscuisines.restaurantid WHERE restaurantscuisines.restaurantid = ". $_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		for($previd = -1; $row = mysqli_fetch_assoc($result); $previd = $row["restaurantid"] - 1)
		{
			$restid = $row["restaurantid"] - 1;
			if($restid == $previd)
			{
				$storecuisine = $row["cuisine"];
				$rcuisine = $rcuisine.", ".$storecuisine;
			}
			else
			{
				$storecuisine = $row["cuisine"];
				$rcuisine = $storecuisine;
			}
		}

		$sql = "SELECT * FROM restaurantstype JOIN type ON type.typeid = restaurantstype.typeid JOIN restaurants ON restaurants.restaurantid = restaurantstype.restaurantid WHERE restaurantstype.restaurantid = ". $_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		for($previd = -1; $row = mysqli_fetch_assoc($result); $previd = $row["restaurantid"] - 1)
		{
			$restid = $row["restaurantid"] - 1;
			if($restid == $previd)
			{
				$storetype = $row["type"];
				$rtype = $rtype.", ".$storetype;
			}
			else
			{
				$storetype = $row["type"];
				$rtype = $storetype;
			}
		}

	
		$sql = "SELECT * FROM restauranttime WHERE restaurantid = ".$_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		for($ctr = 0; $row = mysqli_fetch_assoc($result); $ctr++)
		{
			$rday[$ctr] = $row["timeday"];
			$ropen[$ctr] = $row["timeopen"];
			$rclose[$ctr] = $row["timeclose"];
			$rstat[$ctr] = $row["timestatus"];

			if($ropen[$ctr] < 12)
			{
				$opentime = $ropen[$ctr]."am";
			}
			elseif($ropen[$ctr] == 12)
			{
				$opentime = $ropen[$ctr]."nn";
			}
			elseif($ropen[$ctr] > 12 && $ropen[$ctr] < 24)
			{
				$ropen[$ctr] = $ropen[$ctr] - 12;
				$opentime = $ropen[$ctr]."pm";
			}
			elseif($ropen[$ctr] == 24)
			{
				$ropen[$ctr] = $ropen[$ctr] - 12;
				$opentime = $ropen[$ctr]."mn";
			}

			if($rclose[$ctr] < 12)
			{
				$closetime = $rclose[$ctr]."am";
			}
			elseif($ropen[$ctr] == 12)
			{
				$closetime = $rclose[$ctr]."nn";
			}
			elseif($rclose[$ctr] > 12 && $rclose[$ctr] < 24)
			{
				$rclose[$ctr] = $rclose[$ctr] - 12;
				$closetime = $rclose[$ctr]."pm";
			}
			elseif($rclose[$ctr] == 24)
			{
				$rclose[$ctr] = $rclose[$ctr] - 12;
				$closetime = $rclose[$ctr]."mn";
			}

			$displaytime = $displaytime.$rday[$ctr]." &nbsp ".$opentime." - ".$closetime."<br>";
		}

		$sql = "SELECT * FROM menuimage WHERE restaurantid = ".$_COOKIE["restoidcookie"];
		$result = mysqli_query($link, $sql);
		for($c = 0; $row = mysqli_fetch_assoc($result); $c = $c + 1)
		{
			$storemenu = $row["menuimage"];
			if($c == 0)
			{
				$menulist = 
				"<div class='carousel-item active'>
					<img class='d-block w-100' src='".$storemenu."'>
				 </div>";
			}
			else
			{
				$menulist = $menulist."<div class='carousel-item'>
				  				   			<img class='d-block w-100' src='".$storemenu."'>
								   	   </div>";
			}
		}
	}
	else
	{
		header("location: restaurant.php");
	}
?>