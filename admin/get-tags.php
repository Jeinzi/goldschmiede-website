<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}

include("../include/utility.php");


if (!isset($_GET['id'])) {
    exit;
}
// The id of the image to be queried.
$id = $_GET['id'];
$connection = connectdB();
$query = $connection->prepare("select tagId,name,color,textColor from freya.galleryTags,freya.tags WHERE galleryTags.imgId=? AND galleryTags.tagId = tags.id;");
$result = $query->execute(array($id));
if ($result === false) {
	exit;
}

$firstRow = true;
$jsonData = '[';
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    if ($firstRow) {
        $firstRow = false;
    }
    else {
        $jsonData .= ',';
    }
    $jsonData .= '{"tagId": ' . $row["tagId"] . ', "name": "' . $row["name"] . '", "color": "' . $row["color"] . '", "textColor": "' . $row["textColor"] . '"}';
}
$jsonData .= ']';

echo $jsonData;
?>
