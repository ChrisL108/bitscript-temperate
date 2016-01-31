<?php 
	$host = "localhost";
	$username = "mrsilver_tempera";
	$password = "M[Z)i4LkDAeR";
	$database = "mrsilver_temperate";

	$connect = mysqli_connect($host, $username, $password, $database);

	if(!$connect){
		die("Connection Fail:" . mysqli_connect_error());
	}
?>