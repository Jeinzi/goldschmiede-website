<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}
include("../include/utility.php");


if (!isset($_GET['email'])) {
    echo 0;
    exit;
}

$connection = connectdB();
$query = $connection->prepare("INSERT INTO freya.contactEmails VALUES (NULL, ?);");
$result = $query->execute(array($_GET['email']));
if ($result === true) {
    $query = $connection->prepare("SELECT LAST_INSERT_ID();");
    $query->execute();
    echo $query->fetch(PDO::FETCH_ASSOC)["LAST_INSERT_ID()"];
	exit;
}

echo 0;
?>