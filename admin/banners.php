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
		include("include/head.php");
		include("../include/utility.php");
	?>
</head>
<body>
<?php
	include("include/navbar.php");

	function outputListGroupItems() {
		$bannerFileName = "";
		$connection = connectDb();

		$query = $connection->prepare("SELECT * FROM banners ORDER BY active DESC");
		$result = $query->execute();
		if ($result == false) {
			alert("Could not get banners.");
		}

		$first = true;
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$additionalClasses = "";
			if ($first) {
				$additionalClasses = " list-group-item-primary";
				$bannerFileName = $row["fileName"];
				$first = false;
			}
			else if (!$row["active"]) {
				$additionalClasses = " list-group-item-secondary";
			}
			echo "<a href='#' onclick='return false;' class='list-group-item list-group-item-action$additionalClasses' data-id='" . $row["id"] . "'>"
					. $row["fileName"]
					. "</a>";
		}
		return $bannerFileName;
	}
?>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3 mb-3">
				<div class="list-group" style="overflow-y:auto;max-height:700px;">
					<div class="list-group-item">
  						<div class="d-flex w-100 justify-content-between">
  							<h4 class="mb-0">Banner</h4>
  							<button class="btn">
								<img src="/svg/plus-square.svg" alt="Hinzufügen-Symbol">
							</button>
  						</div>
					</div>
					<?php
						$bannerFileName = outputListGroupItems();
					?>
				</div>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="row">
					<!-- Preview -->
					<div class="col-lg-8 col-xl-7">
						<div class="d-flex justify-content-center mb-3">
							<!-- TODO: Add title and subtitle preview -->
							<img id="banner-preview" src="/img/banner/<?php echo $bannerFileName;?>" class="d-block w-100 img-thumbnail">
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Text fields -->
					<div class="col-12 col-lg-8 col-xl-7">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div id="banner-title-prepend" class="input-group-text">
									Titel
								</div>
							</div>
							<input type="text" id="input-title" class="form-control" aria-labelledby="banner-title-prepend" data-db-path="banners.title">
							<div class="input-group-append">
								<button class="btn btn-outline-input button-upload" tabindex="-1">
									<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
								</button>
							</div>
						</div>

						<div class="input-group mb-4">
							<div class="input-group-prepend">
								<div id="banner-subtitle-prepend" class="input-group-text">
									Untertitel
								</div>
							</div>
							<textarea id="input-subtitle" class="form-control" aria-labelledby="banner-subtitle-prepend" data-db-path="banners.subtitle"></textarea>
							<div class="input-group-append">
								<button class="btn btn-outline-input button-upload">
									<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
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
<script src="res/uploadfield.js"></script>
<script src="res/list.js"></script>
<script src="res/banner.js"></script>
<script>
fillInputFields();

function getUploadId() {
	return getActiveListItemId();
}

function onListItemChange(item) {
	$("#banner-preview").attr("src", "/img/banner/" + item.text());
	fillInputFields();
	resetUploadButtons();
	// TODO: Preserve gray background for inactive banners when switching.

	var jsonObject = {path: "banners.active", id: getActiveListItemId()};
	$.get('get-data.php', jsonObject).done(function(data) {
		data = JSON.parse(data);
		$('#input-is-active').bootstrapToggle(data.value == 1 ? 'on' : 'off', true);
	});
}
</script>
</body>
</html>
