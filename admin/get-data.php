<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}

include("../include/utility.php");


if (!isset($_GET['path']) || !isset($_GET['id'])) {
    exit;
}
// The column to query, in the format table.column.
$path = $_GET['path'];
// The id of the row to be queried.
$id = $_GET['id'];


// The tables and columns that are allowed to be accessed in this generic way.
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
        "active",
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
    $query = $connection->prepare("SELECT " . $column . " FROM " . $table . " WHERE id=?");
    $result = $query->execute(array($id));
    if ($result == false) {
    	exit;
    }
}

// Create JSON array string.
function appendColumnToJson(&$jsonString, $columnName, $row) {
	$jsonString .= "'$columnName': '" . $row[$columnName] . "',";
}

$row = $query->fetch(PDO::FETCH_ASSOC);
$jsonData = '{';
$jsonData .= '"value": "' . $row[$column] . '"';
$jsonData .= '}';

echo $jsonData;
?>
