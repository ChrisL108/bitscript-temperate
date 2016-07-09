<?php

session_start();

include("configurations/configurations.php");
include("functions/functions.php");

function getCurrentUri(){
	$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
	$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
	if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
	$uri = '/' . trim($uri, '/');
	return trim($uri, "/");
}
$var = explode("/" ,getCurrentUri());

if ($var[0] == "") {
	if (!isset($_SESSION['temperate_uid'])) {
		include("pages/home/index.html");
	}
	else {
		showHomePage($connect, $_SESSION['temperate_uid']);
	}
}

if ($var[0] == "scan") {
	include("pages/ScriptCam/index.html");
}

if ($var[0] == "authuserthroughjson") {
	if (isset($_SESSION['auth_pin'])) {
		if (isset($_POST['pin'])) {
			$user = $_SESSION['auth_pin'];
			$query1 = mysqli_query($connect, "SELECT * FROM temperate_accounts WHERE uid = '" . $user  . "'");
			if (mysqli_num_rows($query1) == 1) {
				$query2 = mysqli_fetch_array($query1);
				if ($query2['pin'] == $_POST['pin']) {
					$query3 = mysqli_query($connect, "SELECT * FROM temperate_weight_" . $user . " ");
					$query4 = mysqli_query($connect, "SELECT * FROM temperate_height_" . $user . " ");
					$query5 = mysqli_fetch_array($query3);
					$query6 = mysqli_fetch_array($query4);
					$_SESSION['auth_pin'] = $user;
					include('pages/profile/index.html');
				}
			}
		}
	}
	session_unset('auth_pin');
}

if ($var[0] == "login") {
	if (isset($_SESSION['temperate_uid'])) {
		header("Location: ./");
	}
	else {
		if (isset($_POST['username']) && isset($_POST['password'])) {
			login($connect, $_POST['username'], sha1($_POST['password']));
		}
		else {
			include("pages/login/index.html");
		}
	}
	exit();
}

if ($var[0] == "jsonparse") {
	parse_json($connect, $_POST['json']);
}

if ($var[0] == "logout") {
	session_destroy();
	header("Location: ./login");
}

?>