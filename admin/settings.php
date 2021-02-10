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
	<?php
		include("../include/head.php");
		include("../include/utility.php");
	?>
	<title>Backend - Einstellungen</title>
</head>
<body>
<?php
	include("include/navbar.php");
?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="main-heading border-bottom">Einstellungen</h1>
			<h2>Impressum</h2>
		</div>
	</div>
	<div class="row" style="margin-bottom: 2%;">
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
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
	<div class="row" style="margin-bottom: 2%;">
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="website-title-prepend" class="input-group-text">
						Website-Titel
					</div>
				</div>
				<input type="text" class="form-control" aria-labelledby="website-title-prepend" data-db-path="settings.websiteTitle">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="margin-bottom: 2%;">
		<div class="col-12">
			<h2>Kontaktformular</h2>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="contact-from-prepend" class="input-group-text">
						From
					</div>
				</div>
				<input type="text" class="form-control" placeholder="" aria-labelledby="contact-from-prepend" data-db-path="settings.contactFrom">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="contact-sender-prepend" class="input-group-text">
						Sender
					</div>
				</div>
				<input type="text" class="form-control" placeholder="" aria-labelledby="contact-sender-prepend" data-db-path="settings.contactSender">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="contact-reply-to-prepend" class="input-group-text">
						Reply To
					</div>
				</div>
				<input type="text" class="form-control" placeholder="" aria-labelledby="contact-reply-to-prepend" data-db-path="settings.contactReplyTo">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
					</button>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div id="contact-subject-prepend" class="input-group-text">
						Betreff
					</div>
				</div>
				<input type="text" class="form-control" placeholder="" aria-labelledby="contact-subject-prepend" data-db-path="settings.contactSubject">
				<div class="input-group-append">
					<button class="btn btn-outline-input button-upload" tabindex="-1">
						<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="margin-bottom: 2%;">
		<div class="col-12">
			<h5>Abos</h5>
		</div>
		<div class="col-lg-6">
			<div class="list-group">
			<?php
				$connection = connectdB();
				
				// Create row for settings if it does not exist.
				$query = $connection->prepare("insert into freya.settings (id) values(1);");
				try {
					$query->execute();
				}
				catch (PDOException $e) {}

				// Get mail addresses.
				$query = $connection->prepare("select * from freya.contactEmails;");
				$result = $query->execute();
				if ($result === false) {
					alert("Could not get emails.");
					exit;
				}
				
				$firstRow = true;
				$rows = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach ($rows as $row) {
					echo '<span class="list-group-item">' . $row["email"] . '</span>';
				}
			?>
			</div>
		</div>
	</div>
</div>
<script src="res/uploadfield.js"></script>
<script>
	function getUploadId() {
		return 1;
	}
	// Load data from server and display it in input fields.
	$('.input-group-append .button-upload').each(function() {
		fillInputField($(this), 1);
	})
</script>
</body>
</html>