<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}
include("../include/utility.php");


$connection = connectdB();

// Delete tag if id delete and id is defined.
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $query = $connection->prepare("DELETE FROM freya.tags WHERE id=?;");
    $result = $query->execute(array($_GET['id']));
    if ($result == true && $query->rowCount() > 0) {
        echo 1;
        exit;
    }
    echo 0;
    exit;
}

// Update tags if id and all the columns is defined.
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['color']) && isset($_GET['textColor'])) {
    $query = $connection->prepare("UPDATE freya.tags SET name=?,color=?,textColor=? WHERE id=?;");
    $result = $query->execute(array($_GET['name'],$_GET['color'], $_GET['textColor'],$_GET['id']));
    if ($result === true && $query->rowCount() > 0) {
        echo 1;
        exit;
    }
    echo 0;
    exit;
}

// Add tag if no id and all the columns are defined. If successfull, return new id.
if (!isset($_GET['id']) && isset($_GET['name']) && isset($_GET['color']) && isset($_GET['textColor'])) {
    $query = $connection->prepare("INSERT INTO freya.tags (name,color,textColor) VALUES (?,?,?);");
    $result = $query->execute(array($_GET['name'],$_GET['color'], $_GET['textColor']));
    if ($result === true) {
        $query = $connection->prepare("SELECT LAST_INSERT_ID();");
        $query->execute();
        echo $query->fetch(PDO::FETCH_ASSOC)["LAST_INSERT_ID()"];
        exit;
    }
    echo 0;
    exit;
}

echo 0;
?>
