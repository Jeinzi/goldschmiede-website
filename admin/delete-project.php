<?php
// Check for existing session.
session_start();
if(!isset($_SESSION['userID']))
{
	header('Location: index.php');
	exit;
}

include("../php/general.php");
$projectId = $_GET['projectId'];

// Dete project from database.
$connection = ConnectDB();
$query = 'DELETE FROM projects WHERE id=' . $projectId;
$result = $connection->query($query);
if ($result == false)
{
    Error("Failed to delete project '" . $projectId . "' from database.");
}

echo 1;
?>
