<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}

include("../php/general.php");


if (!isset($_GET['path']) || !isset($_GET['id']) || !isset($_GET['value'])) {
    echo 0;
    exit;
}
// The column to modify, in the format table.column.
$path = $_GET['path'];
// The id of the row to be modified.
$id = $_GET['id'];
// The new value of the specified database field.
$value = $_GET['value'];


// The tables and columns that are allowed to be modified in this generic way.
$permittedCols = [
    "imprint" => [
        "name",
        "street",
        "city",
        "phone",
        "email",
        "vatId"
    ],
    "banners" => [
        "title",
        "subtitle"
    ],
    "galleryImages" => [
        "title",
        "subtitle"
    ]
];

// Check if the requested colum is part of the permittedCols array.
$pathArray = explode(".", $path, 2);
if (count($pathArray) != 2) {
    echo 0;
    exit;
}

$table = $pathArray[0];
$column = $pathArray[1];
if (array_key_exists($table, $permittedCols) &&
    in_array($column, $permittedCols[$table], true))
{
    $connection = connectdB();
    $query = $connection->prepare("UPDATE " . $table . " SET " . $column . "=? WHERE id=?");
    $result = $query->execute(array($value, $id));
    if ($result == true) {
    	echo 1;
    	exit;
    }
}

echo 0;
?>