<?php
	require_once 'config.php'; 

	$clist = "";
	$displayaddresto = "";

	if(!isset($_COOKIE["bookid"]))
	{
	  header("location: bookinfo.php");
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
	  $guests = $row["numberofpeople"];
	  $month = $row["bookmonth"];
	  $date = $row["bookday"];
	  $hour = $row["bookhour"];
	  $roomtype = $row["roomtype"];
	  $totalamount = $row["totalamount"];
	}

	$sql = "SELECT * FROM cart WHERE bookingid = ".$_COOKIE["bookid"];
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

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	  for($ctr = 0; $ctr < $numberofitems; $ctr++)
	  {
	  	if(isset($_POST["cminus".$ctr]))
	  	{
	  		if($cqty[$ctr] > 1)
	  		{
		  		$newqty = $cqty[$ctr] - 1; 
		  		$sql = "UPDATE cart SET quantity = (?) WHERE cartid = ".$cid[$ctr];
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

		                    $param_total = $totalamount - $cprice[$ctr];
		                    
		                    if(mysqli_stmt_execute($stmt))
		                    {
		                      header("location: cart.php");
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
	  	if(isset($_POST["cplus".$ctr]))
	  	{
	  		$newqty = $cqty[$ctr] + 1;
	  		$sql = "UPDATE cart SET quantity = (?) WHERE cartid = ".$cid[$ctr];
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

		                $param_total = $totalamount + $cprice[$ctr];
		                
		                if(mysqli_stmt_execute($stmt))
		                {
		                  header("location: cart.php");
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
	        mysqli_stmt_close($stmt);
	  	}
	  	if(isset($_POST["cdelete".$ctr]))
	  	{
	        $sql = "DELETE FROM cart WHERE cartid = ".$cid[$ctr];
			if($stmt = mysqli_prepare($link, $sql))
			{
				if(mysqli_stmt_execute($stmt))
				{
					$sql = "UPDATE book SET totalamount = (?) WHERE bookingid = ".$_COOKIE["bookid"];
		            if($stmt = mysqli_prepare($link, $sql))
		            {
		                mysqli_stmt_bind_param($stmt, "i", $param_total);

		                $param_total = $totalamount - $cprice[$ctr] * $cqty[$ctr];
		                
		                if(mysqli_stmt_execute($stmt))
		                {
		                  header("location: cart.php");
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
			mysqli_stmt_close($stmt);
	  	}
	  }
	  if(isset($_POST["confirm"]))
	  	{
	  		$sql = "UPDATE book SET paymenttype = (?), bookconfirmation = (?) WHERE bookingid = ".$_COOKIE["bookid"];
	        if($stmt = mysqli_prepare($link, $sql))
	        {
	            mysqli_stmt_bind_param($stmt, "ss", $param_payment, $param_confirm);

	            $param_payment = $_POST["cartpayment"];
	            $param_confirm = "yes";
	            
	            if(mysqli_stmt_execute($stmt))
	            {
	              header("location: mybookings.php");
	            } 
	            else
	            {
	              echo "Something went wrong. Please try again later.";
	            }
	        }
	  	}
	  mysqli_close($link);
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
					Book Number: ".$booknumber."<br>
					Number of Guests: ".$guests."<br>
					Date: ".$date."/".$month."<br>
					Time: ".$displayhour."<br>
					Payment Options:
					<select class='custom-select mr-sm-2' name = 'cartpayment'>
			        	<option value = 'Cash' selected>Cash Upon Arrival</option>
			        	<option value = 'Credit Card'>Credit Card</option>
			        	<option value = 'MANGOPAY'>MANGOPAY</option>
		        	</select><br><br>
		        	<h5>Total: PHP ".$totalamount.".00</h5> <input type='submit' class = 'btn btn-info' name='confirm' value='Confirm'>
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
					<div id = 'cartimage'>
						<button type='submit' name = '".$cdelete[$ctr]."' class='btn btn-light'>
							<img src='img/icons/trash.png'>
						</button>
					</div>
				</td>
				<td><h6>PHP ".$cprice[$ctr].".00<h6>Subtotal: <br> PHP ".$csubtotal[$ctr].".00</h6></td>
				<td>	
					<input type='submit' class = 'btn btn-light' name='".$cminus[$ctr]."' value='-' ".$disabled[$ctr].">
				</td>
				<td>
					<div id='cartqty'>
						<input type='text' name='cartqtytxt' value = '".$cqty[$ctr]."' readonly>
					</div>
				</td>
				<td>
					<input type='submit' class = 'btn btn-light' name='".$cplus[$ctr]."' value='+'>
				</td>
			</form>
		</tr>";
	}

?>