<?php 
	$host = "localhost";
	$username = "XXXXXX";
	$password = "XXXXXX";
	$database = "XXXXXX";

	$connect = mysqli_connect($host, $username, $password, $database);

	if(!$connect){
		die("Connection Fail:" . mysqli_connect_error());
	}
?>
