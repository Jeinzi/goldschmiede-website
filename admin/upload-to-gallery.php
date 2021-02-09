<?php
// Check for existing session.
session_start();
if(!isset($_SESSION['goldsmithLoggedIn']))
{
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
include("../include/utility.php")
?>
</head>
<body>
<?php include("include/navbar.php"); ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="main-heading border-bottom">Galeriebilder hochladen</h1>
				<form action="upload-to-gallery-process" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<div class="input-group mb-2">
							<label for="fileSelection">Wähle ein Bild</label>
    						<input type="file" name="image" class="form-control-file" id="fileSelection">
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">
									Titel
								</div>
							</div>
							<input type="text" name="title" class="form-control">
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">
									Untertitel
								</div>
							</div>
							<textarea class="form-control" name="subtitle"></textarea>
						</div>

						<button type="submit" class="btn btn-success float-right">Hochladen</button>
  					</div>
				</form>
			</div>
		</div>
		<?php
			if (isset($_GET["error"]) && $_GET["error"] !== "") {
				alert("Error: " . $_GET["error"]);
			}
		?>
	</div>
</body>
</html>
