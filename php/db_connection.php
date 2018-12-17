<?php
/* 
	function OpenCon()
	{
		$dbhost = "192.168.7.194";
		$dbuser = "griz";
		$dbpass = "1234";
		$db = "resto";

		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

		return $conn;
	}
 
	function CloseCon($conn)
	{
		$conn -> close();
	}
*/
	function OpenCon()
	{
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = " ";
		$db = "resto";

		$conn = mysqli_connect('localhost', 'root', '','resto');

		return $conn;
	}
 
	function CloseCon($conn)
	{
		$conn -> close();
	}

?>