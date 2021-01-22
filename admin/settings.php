<?php
// Check for existing session.
session_start();
if (!isset($_SESSION['goldsmithLoggedIn'])) {
	header('Location: .');
	exit;
}
?>
<!doctype html>
<html>
<head>
	<?php
		include("../head.php");
		include("../php/general.php");
	?>
	<title>Backend - Einstellungen</title>
</head>
<body>
<?php
	include("php/navbar.php");
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h1 class="main-heading border-bottom">Einstellungen</h1>
			<h2>Impressum</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="name-prepend" class="input-group-text">
						Name
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="name-prepend" data-db-path="imprint.name">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="address-prepend" class="input-group-text">
						Adresse
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="address-prepend" data-db-path="imprint.street">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="city-prepend" class="input-group-text">
						Stadt
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="city-prepend" data-db-path="imprint.city">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="phone-prepend" class="input-group-text">
						Telefon
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="phone-prepend" data-db-path="imprint.phone">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="email-prepend" class="input-group-text">
						E-Mail
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="email-prepend" data-db-path="imprint.email">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="vat-id-prepend" class="input-group-text">
					USt-IdNr.
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="vat-id-prepend" data-db-path="imprint.vatId">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<h2>Allgemein</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="website-title-prepend" class="input-group-text">
						Website-Titel
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="website-title-prepend" disabled="disabled">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" disabled="disabled" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg">
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<h2>Kontaktformular</h2>
		</div>
		<div class="col-lg-6">
			<ul class="list-group">
				<span class='list-group-item'>EMail1@skdfh</span>
				<span class='list-group-item'>EMail1@skdfh</span>
				<!-- TODO -->
			</ul>
		</div>
	</div>
</div>
<script src="js/uploadfield-bindings.js?v=<?php echo time();?>"></script><!-- TODO -->
<script>
	// Load data from server and display it in input fields.
	$('.input-group-append .button-upload').each(function() {
		fillInputField($(this), 1);
	})
</script>
</body>
</html>