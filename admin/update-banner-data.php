<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}

include("../php/general.php");

if (!isset($_GET['bannerId'])) {
	echo 0;
	exit;
}
$bannerId = $_GET['bannerId'];


/* TODO File name */
if (isset($_GET['input-title'])) {
	$column = "title";
	$value = $_GET['input-title'];
}
else if (isset($_GET['input-subtitle'])) {
	$column = "subtitle";
	$value = $_GET['input-subtitle'];
}
else if (isset($_GET['input-is-active'])) {
	$column = "active";
	$value = $_GET['input-is-active'];
}
else {
	echo 0;
	exit;
}


// Modify database.
$connection = connectdB();
$query = $connection->prepare("UPDATE banners SET " . $column . "=? WHERE id=?");
$result = $query->execute(array($value, $bannerId));
//print_r($query->errorInfo()); //TODO
if ($result == false) {
	echo 0;
	exit;
}

echo 1;
