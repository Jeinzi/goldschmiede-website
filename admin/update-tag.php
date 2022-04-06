<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
  header('Location: .');
  exit;
}
include("../include/utility.php");


$connection = connectdB();



//
// Delete tag if delete and id is defined.
//
if (isset($_GET['delete']) && isset($_GET['id'])) {
  // Delete tag-image associations.
  try {
    $query = $connection->prepare("DELETE FROM freya.galleryTags WHERE tagId=?;");
    $result = $query->execute(array($_GET['id']));
  }
  catch (PDOException $e) {
    echo 0;
    exit;
  }
  if ($result === false) {
    echo 0;
    exit;
  }

  // Delete tag itself.
  try {
    $query = $connection->prepare("DELETE FROM freya.tags WHERE id=?;");
    $result = $query->execute(array($_GET['id']));
  }
  catch (PDOException $e) {
    echo 0;
    exit;
  }
  if ($result === true && $query->rowCount() > 0) {
    echo 1;
    exit;
  }
  echo 0;
  exit;
}



//
// Update tag if id and all the columns are defined.
//
if (isset($_GET['id']) &&
    isset($_GET['name']) &&
    isset($_GET['color']) &&
    isset($_GET['textColor']))
{
  try {
    $query = $connection->prepare("UPDATE freya.tags SET name=?,color=?,textColor=? WHERE id=?;");
    $result = $query->execute(array($_GET['name'],$_GET['color'], $_GET['textColor'],$_GET['id']));
  }
  catch (PDOException $e) {
    echo 0;
    exit;
  }
  if ($result === true && $query->rowCount() > 0) {
    echo 1;
    exit;
  }
  echo 0;
  exit;
}



//
// Add tag if no id and all the columns are defined. If successfull, return new id.
//
if (!isset($_GET['id']) &&
     isset($_GET['name']) &&
     isset($_GET['color']) &&
     isset($_GET['textColor']))
{
  try {
    $query = $connection->prepare("INSERT INTO freya.tags (name,color,textColor) VALUES (?,?,?);");
    $result = $query->execute(array($_GET['name'],$_GET['color'], $_GET['textColor']));
  }
  catch (PDOException $e) {
    echo 0;
    exit;
  }
  if ($result === false) {
    echo 0;
    exit;
  }

  // Get new id.
  try {
    $query = $connection->prepare("SELECT LAST_INSERT_ID();");
    $query->execute();
    echo $query->fetch(PDO::FETCH_ASSOC)["LAST_INSERT_ID()"];
    exit;
  }
  catch (PDOException $e) {
    echo 0;
    exit;
  }
  echo 0;
  exit;
}

echo 0;
?>
