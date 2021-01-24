<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}
include("../php/general.php");


$error = "";
$targetPath = "../img/" . basename($_FILES["image"]["name"]);
//echo $targetPath;
//var_dump($_FILES);

// Check if uploaded file is an image.
if (getimagesize($_FILES["image"]["tmp_name"]) === false) {
    $error = "File is not an image";
}

// Check if file exists.
if (file_exists($targetPath)) {
    $error = "File already exists.";
}

// Check if file name is empty.
if ($_FILES["image"]["name"] === "") {
    $error = "No file selected or file to large.";
}

// Check file size.
$maxSize = 5000000;
if ($_FILES["image"]["size"] > $maxSize) {
    $error = "File is too large. (>" . $maxSize . "MB)";
}

// Upload file.
if ($error === "" &&
    !move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath))
{
    $error = "Error uploading image.";
}

// Update database.
if ($error === "") {
    $connection = connectdB();
    $query = $connection->prepare("INSERT INTO galleryImages(fileName, title, subtitle) VALUES (?, ?, ?)");
    $result = $query->execute(array(basename($targetPath), $_POST['title'], $_POST['subtitle']));
    if ($result === false) {
        $error = "Could not update database.";
        unlink($targetPath);
    }
}

echo $error;
if ($error === "") {
    header('Location: gallery');
}
?>