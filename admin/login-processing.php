<?php
session_start();
include("../php/utility.php");
if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['checkCredentialsOnly'])) {
	exit;
}

// Check for valid login.
$validLogin = false;
$connection = connectDb();
$username = $_POST['username'];
$password = $_POST['password'];
$checkOnly = $_POST['checkCredentialsOnly'];

$query = $connection->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");

$result = $query->execute(array($username));
if ($result === true) {
	$row = $query->fetch(PDO::FETCH_ASSOC);
	if ($row && password_verify($password, $row['hash'])) {
		$validLogin = true;
		if ($checkOnly === "false") {
			$_SESSION['username'] = $username;
			$_SESSION['goldsmithLoggedIn'] = true;
			header("Location: .");
			exit;
		}
	}
}

// Output JSON response.
echo '{';
echo '"validLogin": ' . json_encode($validLogin);
echo '}';
?>
