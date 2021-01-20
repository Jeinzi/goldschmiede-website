<?php
// Check for existing session.
session_start();
if(!isset($_SESSION['userID'])) {
	header('Location: index.php');
	exit;
}?>

<!doctype html>
<html>
<head>
	<title>Backend</title>
	<?php
	 include("../php/head.php");
	?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css" integrity="sha256-nFp4rgCvFsMQweFQwabbKfjrBwlaebbLkE29VFR0K40=" crossorigin="anonymous" />
	<link rel="stylesheet" href="css/backend.css"/>
	<link rel="stylesheet" href="css/add-project.css?v=2"/>
</head>
<body>
	<?php include("php/navbar.php"); ?>
	<script src="js/bootstrap-datepicker.js"></script>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1>Projekt hinzufügen</h1>
				</div>
			</div>
		</div>
		<form method="POST" action="add-project-process.php">
			<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="inputTitleDE">Deutscher Titel</label>
						<input class="form-control" id="inputTitleDE" name="titleDE" placeholder="Titel"></input>
					</div>
				</div>
					<div class="col-md-6">
						<div class="form-group">
						<label for="inputTitleEN">Englischer Titel</label>
						<input class="form-control" id="inputTitleEN" name="titleEN" placeholder="Title"></input>
					</div>
				</div>
			</div>
			<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="inputDescriptionDE">Deutsche Beschreibung</label>
						<textarea class="form-control" rows=3 id="inputDescriptionDE" name="descriptionDE" placeholder="Beschreibung"></textarea>
					</div>
				</div>
					<div class="col-md-6">
						<div class="form-group">
						<label for="inputDescriptionEN">Englische Beschreibung</label>
						<textarea class="form-control" rows=3 id="inputDescriptionEN" name="descriptionEN" placeholder="Description"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="inputBannerDiv">Banner</label>
						<div class="col-md-12 noLeftPadding noRightPadding" id="bannerDiv">
							<div class="col-md-6 noLeftPadding noRightPadding">
								<img src="img/banner.jpg" alt="Picture missing" class="img-thumbnail img-responsive" id="banner">
							</div>
							<div class="visible-xs-block visible-sm-block">
								<br/>
							</div>
							<div class="col-md-6 noLeftPaddingPhone noRightPadding">
								<input type="file" class="btn btn-default fullWidth" id="inputBanner" name="banner"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group date" data-provide="datepicker">
						<label for="datepicker">Datum</label>
						<input class="form-control datepicker" placeholder="Datum" name="date">
					</div>
					<div class="form-group">
						<label for="inputDirectory">Verzeichnis</label>
						<input type="text" class="form-control" placeholder="Verzeichnis" id="inputDirectory" name="directory"></input>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="inputListed" value="blah" name="isListed">Gelistet</input>
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<input type="submit" class="btn btn-submit"></input>
					</div>
				</div>
			</div>
		</form>

		<!-- Script handling the datepicker and the thumbnail display. -->
		<script src="js/add-project.js?v=6"></script>
	</div>
</body>
</html>
