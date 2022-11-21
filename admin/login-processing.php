<?php
session_start();
if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['checkCredentialsOnly'])) {
	exit;
}
include("../include/utility.php");
include("include/backend-utility.php");

// Check for valid login.
$validLogin = false;
$username = $_POST['username'];
$password = $_POST['password'];
$checkOnly = $_POST['checkCredentialsOnly'];

if (checkPassword($username, $password) === true) {
	$validLogin = true;
	if ($checkOnly === "false") {
		$_SESSION['username'] = $username;
		$_SESSION['goldsmithLoggedIn'] = true;
		header("Location: .");
		exit;
	}
}

// Output JSON response.
echo '{';
echo '"validLogin": ' . json_encode($validLogin);
echo '}';
?>
