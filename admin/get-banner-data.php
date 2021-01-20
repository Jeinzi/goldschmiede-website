<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn']) || !isset($_GET['bannerId'])) {
	header('Location: .');
	exit;
}


include("../php/general.php");
$bannerId = $_GET['bannerId'];

// Get banner from database.
$connection = connectDb();
$query = $connection->prepare("SELECT * FROM banners WHERE id=?");
$result = $query->execute(array($bannerId));
if ($result == false) {
	//TODO Error("Failed to query admins.");
	echo "Could not get banners.";
}

// Create JSON array string.
function appendColumnToJson(&$jsonString, $columnName, $row) {
	$jsonString .= "'$columnName': '" . $row[$columnName] . "',";
}

$row = $query->fetch(PDO::FETCH_ASSOC);
$jsonData = '{';
$jsonData .= '"id": "' . $row['id'] . '",';
$jsonData .= '"active": "' . $row['active'] . '",';
$jsonData .= '"fileName": "' . $row['fileName'] . '",';
$jsonData .= '"title": "' . $row['title'] . '",';
$jsonData .= '"subtitle": "' . $row['subtitle'] . '"';
$jsonData .= '}';

echo $jsonData;
?>
