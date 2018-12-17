<?php
	include 'db_connnection.php';
	 
	$conn = OpenCon();
	echo "Connected Successfully";	 
	CloseCon($conn);
?>