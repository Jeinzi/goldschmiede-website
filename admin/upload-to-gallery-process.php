<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}
include("../include/utility.php");


$error = "";
$targetPath = "../img/" . basename($_FILES["image"]["name"]);
//echo $targetPath;
//var_dump($_FILES);

// Check file size.
if ($_FILES["image"]["error"] === UPLOAD_ERR_INI_SIZE) {
    $error = "File is too large.";
}

// Check if file name is empty.
if ($_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE) {
    $error = "No file selected.";
}

// Check if uploaded file is an image.
if ($error === "") {
    $imageInfo = getimagesize($_FILES["image"]["tmp_name"]);
    if ($imageInfo === false) {
        $error = "File is not an image";
    }
}

// Check if file exists.
if ($error === "") {
    if (file_exists($targetPath)) {
        $error = "File already exists.";
    }
}

// Make sure aspect ratio is 1:1.
if ($error === "") {
    $w = $imageInfo[0];
    $h = $imageInfo[1];
    if ($w / $h != 1) {
        $error = "Aspect ratio not 1:1 but " . ($w / $h);
    }
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


if ($error === "") {
    header('Location: gallery');
}
else {
    header('Location: upload-to-gallery?error=' . $error);
}
?>