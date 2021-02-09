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
<?php
	include("include/navbar.php");

	function outputListGroupItems() {
		$firstFileName = "";
		$connection = connectDb();

		$query = $connection->prepare("SELECT * FROM galleryImages");
		$result = $query->execute();
		if ($result == false) {
			//TODO Error("Failed to query admins.");
			echo "Could not get gallery images.";
		}

		$first = true;
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$additionalClasses = "";
			if ($first) {
				$additionalClasses = " list-group-item-primary";
				$firstFileName = $row["fileName"];
				$first = false;
			}
			echo "<a href='#' onclick='return false;' class='list-group-item list-group-item-action$additionalClasses' data-id='" . $row["id"] . "'>"
					. $row["fileName"]
					. "</a>";
		}
		return $firstFileName;
	}
?>
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-md-4 col-lg-3 mb-3">
				<div class="list-group" style="overflow-y:auto;max-height:700px;">
					<div class="list-group-item">
  						<div class="d-flex w-100 justify-content-between">
  							<h4 class="mb-0">Galerie</h4>
  							<button class="btn">
								<img src="/svg/plus-square.svg" alt="Hinzufügen-Symbol">
							</button>
  						</div>
					</div>
					<?php
						$firstFileName = outputListGroupItems();
					?>
				</div>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="row">
					<!-- Preview -->
					<div class="col-lg-8 col-xl-7">
						<div class="d-flex justify-content-center mb-3">
							<!-- TODO: Add title and subtitle preview -->
							<img id="preview" src="/img/<?php echo $firstFileName; ?>" class="d-block w-50 img-thumbnail" alt="Das aktuell gewählte Bild">
						</div>
					</div>

					<!-- Tags -->
					<div id="tag-container" class="col-lg-4 col-xl-2 mb-2">
						<h3 class="border-bottom pb-1 d-none d-lg-block">Tags</h3>
					</div>
				</div>
				<div class="row">
					<!-- Text fields -->
					<div class="col-12 col-lg-8 col-xl-7">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div id="gallery-title-prepend" class="input-group-text">
									Titel
								</div>
							</div>
							<input type="text" class="form-control" placeholder="" aria-labelledby="gallery-title-prepend" data-db-path="galleryImages.title">
							<div class="input-group-append">
								<button class="btn btn-outline-input button-upload" tabindex="-1">
									<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
								</button>
							</div>
						</div>

						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div id="gallery-subtitle-prepend" class="input-group-text">
									Untertitel
								</div>
							</div>
							<textarea class="form-control" placeholder="" aria-labelledby="gallery-subtitle-prepend" data-db-path="galleryImages.subtitle"></textarea>
							<div class="input-group-append">
								<button class="btn btn-outline-input button-upload" tabindex="-1">
									<img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="res/uploadfield.js"></script>
<script src="res/list.js"></script>
<script>
fillInputFields();
outputTags();

function outputTags() {
	var container = $("#tag-container");
	container.children("a").remove();
	$.get("get-tags", {id: getActiveListItemId()}, function(data) {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
		data.forEach(function(item, i) {
			container.append(`<a href="#" class="badge" style="background-color: #${item.color}; color: #${item.textColor};">${item.name}</a> `);
		})
	});
}

function getUploadId() {
	return getActiveListItemId();
}

function onListItemChange(item) {
	$("#preview").attr("src", "/img/" + item.text());
	fillInputFields();
	resetUploadButtons();
	outputTags();
}
</script>
</body>
</html>
