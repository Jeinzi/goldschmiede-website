<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
  header('Location: .');
  exit;
}
include('../include/utility.php');


if (!isset($_GET['imgId']) || !isset($_GET['tagId'])) {
  echo 0;
  exit;
}

// Check if image-tag association is already in database.
try {
  $connection = connectDb();
  $query = $connection->prepare("SELECT tagId FROM galleryTags WHERE imgId=? AND tagId=?;");
  $result = $query->execute(array($_GET['imgId'], $_GET['tagId']));
}
catch (PDOException $e) {
  echo 0;
  exit;
}
if ($result === false || $query->rowCount() != 0) {
  echo 0;
  exit;
}

// If combination does not exist, add it.
try {
  $query = $connection->prepare("INSERT INTO galleryTags VALUES(?, ?);");
  $result = $query->execute(array($_GET['imgId'], $_GET['tagId']));
}
catch (PDOException $e) {
  echo 0;
  exit;
}
if ($result === false || $query->rowCount() == 0) {
  echo 0;
  exit;
}

echo 1;
?>
