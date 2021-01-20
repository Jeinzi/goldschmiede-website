<?php
session_start();
include("../php/general.php");
if (!isset($_POST['username']) || !isset($_POST['password'])) {
	header("Location: .");
	exit;
}

// Check for valid login.
$validLogin = false;
$connection = connectDb();
$username = $_POST['username'];
$password = $_POST['password'];

$query = $connection->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");

$result = $query->execute(array($username));
if ($result == false) {
	//TODO Error("Failed to query admins.");
	echo "Failed to query admins.";
}

$row = $query->fetch(PDO::FETCH_ASSOC);
if ($row && password_verify($password, $row['hash'])) {
	$_SESSION['username'] = $username;
	$_SESSION['goldsmithLoggedIn'] = true;
}

header("Location: .");
?>