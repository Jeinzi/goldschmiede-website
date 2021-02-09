<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}


include("../include/utility.php");
if (!isset($_GET['bannerId'])) {
	echo 0;
	exit;
}
$bannerId = $_GET['bannerId'];

// Delete banner from database.
$connection = ConnectDB();
$query = $connection->prepare("DELETE FROM banners WHERE id=?");
$result = $query->execute(array($bannerId));
if ($result === false) {
	//TODO Error("Failed to query admins.");
	echo 0;
	exit;
}

echo 1;
?>
