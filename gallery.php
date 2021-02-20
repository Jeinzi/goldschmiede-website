<!doctype html>
<html lang="de">
<head>
	<?php
		include("include/head.php");
		include("include/utility.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Galerie </title>
	<script src="/res/gallery.js" defer></script>
	<link rel="stylesheet" href="res/gallery.css">
</head>
<body>
<?php include("include/navbar.php"); ?>

<div class="container" style="margin-top:50px">
	<div class="row">
		<div class="col-12 text-center">
<?php
	$imgPath = "img/";
	$thumbnailDir = "thumbnails/";
	$thumbnailPath = $imgPath . $thumbnailDir;

	// Generate thumbnail directory.
	if (!file_exists($thumbnailPath)) {
		mkdir($thumbnailPath);
	}

	// Check for ImageMagick.
	if (!class_exists("IMagick")) {
		alert("Echter Fehler: ImageMagick not installed.");
	}

	// Get image names and (sub-)titles from database.
	$firstImage = "";
	$connection = connectdB();
	$query = $connection->prepare("SELECT fileName,title,subtitle FROM galleryImages");
	$result = $query->execute();
	
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$name = $row["fileName"];
		$path = $thumbnailPath . $name;
		if (!file_exists($path)) {
			try {
				$img = new Imagick($imgPath . $name);
				$img->scaleImage(200, 0);
				$img->setImageFormat("jpeg");
				$result = file_put_contents($path, $img);
				$img->destroy();
				if ($result === false) {
					alert("Thumbnail for '" . $name . "' could not be saved.");
				}
			}
			catch (Exception $e) {
				alert("Thumbnail for '" . $name . "'could not be generated.");
			}
		}

		echo '<img src="' . $path . '" class="img-thumbnail gallery-thumbnail" alt="' . $row["title"] . '" data-subtitle="' . $row["subtitle"] . '">';
		if ($firstImage === "") {
			$firstImage = $path;
		}
	}
?>
		</div>
	</div>
</div>


<div class="gallery-viewer-container" style="display: none;">
	<div class="margin-container">
		<div class="square-container">
			<img id="gallery-image" src="<?php echo $firstImage; ?>" aria-labelledby="gallery-title" aria-describedby="gallery-subtitle">
			<div class="text-container">
				<h5 id="gallery-title">Titel</h5>
				<p id="gallery-subtitle">Untertitel</p>
			</div>
		</div>
	</div>
</div>

</body>
</html>
