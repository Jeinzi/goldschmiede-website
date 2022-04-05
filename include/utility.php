<?php
// Adds a fixed alert to the bottom of the page.
function alert($text) {
	echo '<div class="alert alert-danger alert-dismissible alert-static mx-auto" role="alert">';
	echo $text;
	echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button>';
  	echo '</div>';
}


// Establishes a connection to the database and returns the connection object.
function connectDb() {
	// Read password from file.
	$fileName = __DIR__ . "/password";
	try {
		$handle = fopen($fileName, "r");
		if (!$handle) {
			throw new Error("Can't open password file: '" . $fileName . "'");
		}
		$user = fgets($handle);
		$password = fgets($handle);
		fclose($handle);
		$password = trim($password, "\n\r\t\0\x0B");
		$user = trim($user, "\n\r\t\0\x0B");
	}
	catch (Error $e) {
		alert($e->getMessage());
		exit(1);
	}

    try {
		// The last parameter tells PDO to return the number of matched rows,
		// even if they where not affected by an update because their value wasn't changed.
		$db = new PDO('mysql:host=localhost;dbname=freya', $user, $password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
		$db->exec("SET NAMES 'utf8';");
    }
    catch (PDOException $e) {
		alert("Could not establish connection to database: " . $e->getMessage());
		exit(1);
    }
	return($db);
}


function getWebsiteTitle() {
	$connection = connectDb();
	$query = $connection->prepare("SELECT websiteTitle FROM settings WHERE id=1");
	$result = $query->execute();
	if ($result === false) {
		alert("Failed to query settings.");
	}

	$first = true;
	$row = $query->fetch(PDO::FETCH_ASSOC);
	return $row["websiteTitle"];
}


/**
 * Fill values from associative array into template and output it.
 *
 * @param $file - Name of the template.
 * @param $args - Associative array of variables to use in the template.
 */
function template($name, $args) {
	$path = $_SERVER["DOCUMENT_ROOT"] . "/res/template/" . $name . ".php";
	if (!file_exists($path)) {
		echo "No file: " . $path;
		return;
	}
	if (!is_array($args)) {
		echo "No array";
		return;
	}
  if (file_exists($path) && is_array($args)) {
    extract($args);
		include($path);
  }
}
?>
