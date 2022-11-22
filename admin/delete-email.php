<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
    header('Location: .');
    exit;
}
include("../include/utility.php");


if (!isset($_GET['id'])) {
    echo 0;
    exit;
}

$connection = connectdB();
$query = $connection->prepare("DELETE FROM freya.contactEmails WHERE id=?");
$result = $query->execute(array($_GET['id']));
if ($result === true) {
    if ($query->rowCount() > 0) {
        echo 1;
    }
    else {
        echo 0;
    }
    exit;
}

echo 0;
?>