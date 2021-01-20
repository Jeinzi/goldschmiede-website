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
	<title>Backend</title>
	<?php
		include("../head.php");
		include("php/head.php");
		include("../php/general.php");
	?>
	<script src="js/banner-functions.js?v=<?php echo time();?>"></script><!-- TODO -->
</head>
<body>
<?php
	include("php/navbar.php");

	function outputListGroupItems() {
		$connection = connectDb();

		$query = $connection->prepare("SELECT * FROM banners ORDER BY active DESC");
		$result = $query->execute();
		if ($result == false) {
			//TODO Error("Failed to query admins.");
			echo "Could not get banners.";
		}

		$first = true;
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$additionalClasses = "";
			if ($first) {
				$additionalClasses = " list-group-item-primary";
				$first = false;
			}
			else if (!$row["active"]) {
				$additionalClasses = " list-group-item-secondary";
			}
			echo "<a href='#' onclick='return false;' class='list-group-item list-group-item-action$additionalClasses' data-id='" . $row["id"] . "'>"
					. $row["fileName"]
					. "</a>";
		}
	}
?>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3 mb-3">
				<ul class="list-group" style="overflow-y:auto;max-height:700px;">
					<li class="list-group-item">
  						<div class="d-flex w-100 justify-content-between">
  							<h4 class="mb-0">Banner</h4>
  							<button class="btn">
								<img src="/svg/plus-square.svg">
							</button>
  						</div>
					</li>
					<?php
						outputListGroupItems();
					?>
				</ul>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="row">
					<!-- Preview -->
					<div class="col-lg-8 col-xl-7">
						<div class="d-flex justify-content-center mb-3">
							<!-- TODO: Add titel and subtitle preview -->
							<img id="banner-preview" src="/img/banner/1.jpg" class="d-block w-100 img-thumbnail">
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Text fields -->
					<div class="col-12 col-lg-8 col-xl-7">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">
									Titel
								</div>
							</div>
							<input type="text" id="input-title" class="form-control" aria-label="Titel">
							<div class="input-group-append">
								<button class="btn btn-outline-input" tabindex="-1">
									<img src="/svg/cloud-upload-fill.svg">
								</button>
							</div>
						</div>

						<div class="input-group mb-4">
							<div class="input-group-prepend">
								<div class="input-group-text">
									Untertitel
								</div>
							</div>
							<textarea id="input-subtitle" class="form-control" aria-label="Untertitel"></textarea>
							<div class="input-group-append">
								<button class="btn btn-outline-input">
									<img src="/svg/cloud-upload-fill.svg">
								</button>
							</div>
						</div>

						<div class="row">
							<div class="col-6">
								<input type="checkbox" id="input-is-active" class="d-none" data-toggle="toggle" data-on="Aktiv" data-off="Inaktiv" checked>
							</div>
							<div class="col-6">
								<button id="button-delete" class="btn btn-danger float-right">Löschen</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="js/banner-bindings.js?v=<?php echo time();?>"></script><!-- TODO -->
<script>
	// If there are banners listed, get the active one's id
	// and fill in the banner info. The variable areBannersListed is defined
	// in banner-loading.js.
	if(true/* areBannersListed TODO*/) {
		var $bannerId = $('a.list-group-item.list-group-item-primary').text();
		getAndUpdateData($bannerId);
	}
</script>
</body>
</html>
