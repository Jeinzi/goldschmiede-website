<!doctype html>
<html>
<head>
	<?php
		include("include/head.php");
		include("include/utility.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Kontakt </title>
</head>
<body>
<?php include("include/navbar.php") ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="main-heading border-bottom">Kontakt</h1>
			<p>Fragen? Anregungen? Interesse an einem meiner Schmuckstücke?<br>Schreib mir einfach!</p>
		</div>
	</div>

	<form method="POST" action="save-message" style="margin-bottom: 5%;">
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Name</span>
				</div>
				<input type="text" name="name" class="form-control" placeholder="Wie heißt du?" aria-label="Name" aria-describedby="basic-addon1">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Kontakt</span>
				</div>
				<input type="text" name="contact" class="form-control" placeholder="Wie kann ich dich erreichen?" aria-label="Contact" aria-describedby="basic-addon1">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Deine Nachricht</span>
				</div>
				<textarea name="text" class="form-control" aria-label="Text" aria-describedby="basic-addon1" style="height:200px"></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<button type="submit" class="btn btn-success float-right">Absenden!</button>
		</div>
	</div>
	</form>
</div>
</body>
</html>