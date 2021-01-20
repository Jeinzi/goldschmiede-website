<?php
// Check for existing session.
session_start();
if(!isset($_SESSION['userID']))
{
	header('Location: index.php');
	exit;
}

include("../php/general.php");

// Get POST variables.
$titleDE = $_POST['titleDE'];
$titleEN = $_POST['titleEN'];
$date = $_POST['date'];
$descriptionDE = $_POST['descriptionDE'];
$descriptionEN = $_POST['descriptionEN'];
$banner = $_POST['banner'];
$directory = $_POST['directory'];

$isListed = 0;
if(isset($_POST['userID']))
{
    $isListed = 1;
}

// Insert new project into database.
$connection = ConnectDB();
$query = 'INSERT INTO `projects`(`titleDE`, `titleEN`, `date`, `descriptionDE`, `descriptionEN`, `directory`, `isListed`)
												VALUES ("'.$titleDE.'", "'.$titleEN.'", "'.$date.'", "'.$descriptionDE.'", "'.$descriptionEN.'", "'.$directory.'", "'.$isListed.'")';
print $query;
$result = $connection->query($query);
if ($result == false)
{
    Error("Failed to insert project.");
}

header('Location: index.php');
exit;
?>
