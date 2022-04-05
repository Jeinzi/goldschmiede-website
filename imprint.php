<!doctype html>
<html lang="de">
<head>
	<?php include("include/head.php"); ?>
  <title><?= $websiteTitle ?> - Impressum </title>
</head>
<body>
<?php
	include("include/navbar.php");

	$connection = connectDb();
	$query = $connection->prepare("SELECT * FROM imprint WHERE id=1");
	$result = $query->execute();
	if ($result == false) {
		//TODO Error("Failed to query imprint.");
		echo "Could not get imprint.";
	}

	$first = true;
	$row = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
	<h1 class="main-heading border-bottom">Impressum</h1>
	<div class="row">
		<div class="col">
			<?= $row["name"] ?><br>
			<?= $row["street"] ?><br>
			<?= $row["city"] ?><br>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col">
			Telefon: <?= $row["phone"] ?><br>
			E-Mail: <a href="mailto:<?= $row["email"] ?>"><?= $row["email"] ?></a><br>
		</div>
	</div>
	<br>
	Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz: <?= $row["vatId"] ?><br>
	Verantwortlicher i.S.d. § 55 Abs. 2 RStV: <?= $row["name"] ?>, <?= $row["street"] ?>, <?= $row["city"] ?><br>
</div>
</body>
</html>