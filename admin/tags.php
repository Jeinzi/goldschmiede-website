<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}
?>
<!doctype html>
<html lang="de">
<head>
	<title>Backend</title>
<?php
	include("../include/head.php");
	include("../include/utility.php");
?>
</head>
<body>
<?php include("include/navbar.php"); ?>

<div class="container">
    <div class="row">
		<div class="col-12">
			<h1 class="main-heading border-bottom">Tags</h1>
		</div>
	</div>
    <div class="row">
        <div class="col">
            <?php
                $connection = connectdB();
                $query = $connection->prepare("select * from freya.tags;");
                $result = $query->execute();
                if ($result == false) {
                    alert("Can't get tags from database.");
                    exit;
                }
                
                $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                    echo '<a href="#" class="badge" style="background-color: #' . $row["color"] . '; color: #' . $row["textColor"] . ';">' . $row["name"] . '</a><br>';
                }
            ?>
        </div>
    </div>
</div>

</body>
</html>
