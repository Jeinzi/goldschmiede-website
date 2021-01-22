<!doctype html>
<html>
<head>
	<?php
		include("head.php");
		include("php/general.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Galerie </title>
</head>
<body>
<?php
	include("utility.php");
	include("navbar.php");
?>
<style>
.gallery-thumbnail {
	width: 200px;
	margin: 5px;
}

@media (max-width: 575.98px) {
	.gallery-thumbnail {
	width: 100px;
	margin: 5px;
	}
}

.carousel-caption {
	bottom: 0px !important;
	padding-bottom: 0px !important;
}

.gallery-button {
	width: 32px;
	height: 32px;
}

.button-container svg path {
	fill: white;
}

.button-container {
	position: absolute;
	top: 0px;
	right: 0px;
}

</style>

<div class="container" style="margin-top:50px">
	<div class="row">
		<div class="col-12 text-center">
<?php
	$imgPath = "img/";
	$thumbnailDir = "thumbails/";
	$thumbnailPath = $imgPath . $thumbnailDir;

	// Generate thumbnail directory.
	if (!file_exists($thumbnailPath)) {
		mkdir($thumbnailPath);
	}

	// Check for ImageMagick.
	if (!class_exists("IMagick")) {
		alert("Echter Fehler: ImageMagick not installed.");
	}

	// Generate thumbnails.
	$dir = new DirectoryIterator($imgPath);
	foreach ($dir as $fileInfo) {
		$name = $fileInfo->getFilename();
		$ext = $fileInfo->getExtension();

		if ($fileInfo->isFile() &&
		   !$fileInfo->isDot() &&
		   ($ext == "jpg" || $ext == "jpeg" || $ext == "png"))
		{
			if (!file_exists($thumbnailPath . $name)) {
				try {
					$img = new Imagick($imgPath . $name);
					$img->scaleImage(200, 0);
					$img->setImageFormat("jpeg");
					file_put_contents($thumbnailPath . $name, $img);
					$img->destroy();
				}
				catch (Exception $e) {
					alert("Thumbnail for '" . $name . "'could not be generated.");
					continue;
				}
			}

			echo '<a href="' . $imgPath . $name . '"><img src="' . $thumbnailPath . $name . '" class="img-thumbnail gallery-thumbnail"></img></a>';
		}
	}
?>
		</div>
	</div>
</div>
</body>
</html>