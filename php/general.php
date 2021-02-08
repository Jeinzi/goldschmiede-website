<?php
// Establishes a connection to the database and returns the connection object.
function connectDb() {
	// Read password from file.
	$fileName = __DIR__ . "/password";
	try {
		$handle = fopen($fileName, "r");
		$user = fgets($handle);
		$password = fgets($handle);
		fclose($handle);
		$password = trim($password, "\n\r\t\0\x0B");
		$user = trim($user, "\n\r\t\0\x0B");
	}
	catch (Exception $e) {
		//TODO Error("Could not open file.");
		echo "Could not open file." . $e->getMessage();
		exit(1);
	}

    try {
		// The last parameter tells PDO to return the number of matched rows,
		// even if they where not affected by an update because its value wasn't changed.
		$db = new PDO('mysql:host=localhost;dbname=freya', $user, $password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
		$db->exec("SET NAMES 'utf8';");
    }
    catch (PDOException $e) {
		//TODO Error("Could not establish connection to database: " . $e->getMessage());
		echo "Could not establish connection to database: " . $e->getMessage();
    }
	return($db);
}


function getWebsiteTitle() {
	$connection = connectDb();
	$query = $connection->prepare("SELECT name FROM imprint WHERE id=1");
	$result = $query->execute();
	if ($result == false) {
		//TODO Error("Failed to query imprint.");
		echo "Could not get imprint.";
	}

	$first = true;
	$row = $query->fetch(PDO::FETCH_ASSOC);
	return $row["name"];
}

?>
