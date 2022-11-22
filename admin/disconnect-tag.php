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

try {
  $connection = connectDb();
  $query = $connection->prepare("DELETE FROM galleryTags WHERE imgId=? AND tagId=?;");
  $result = $query->execute(array($_GET['imgId'], $_GET['tagId']));
  //echo "Row count: ", $query->rowCount();
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
