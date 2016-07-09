<?php 
	$host = "localhost";
	$username = "XXXXX";
	$password = "XXXXX";
	$database = "XXXXX";

	$connect = mysqli_connect($host, $username, $password, $database);

	if(!$connect){
		die("Connection Fail:" . mysqli_connect_error());
	}
?>
