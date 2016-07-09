<?php

function login($conn, $username, $password) {
	$query1 = mysqli_query($conn, "SELECT * FROM temperate_accounts WHERE bcode = '" . $username . "'");
	$query2 = mysqli_query($conn, "SELECT * FROM temperate_accounts WHERE email = '" . $username . "'");
	if (mysqli_num_rows($query1) == 1) {
		$query3 = mysqli_fetch_array($query1);
		if ($password == $query3['pword']) {
			$_SESSION['temperate_uid'] = $query3['uid'];
			header("Location: ./login");

		}
	}
	if (mysqli_num_rows($query2) == 1) {
		$query4 = mysqli_fetch_array($query2);
		if ($password == $query4['pword']) {
			$_SESSION['temperate_uid'] = $query4['uid'];
			header("Location: ./login");
		}
	}
}

?>