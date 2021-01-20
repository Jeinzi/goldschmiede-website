<!doctype html>
<html>
<head>
	<?php
		include("head.php");
		include("php/general.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Galerie </title>
	<script src="/gallery.js" defer></script>
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

<div style="width:100%;height:100%;display:flex;justify-content:center;align-items:center;position: absolute;top:0px">
<div id="carousel-div" style="display:none;position:fixed;z-index:1000;">
<div id="carouselExampleCaptions" class="carousel slide border-bottom" data-ride="" data-interval=false style="max-height:1000px;max-width:1000px;">
	  <div class="carousel-inner">
		<div class="carousel-item active">
		  <img src="/img/Emailstecker.jpg" class="d-block w-100" alt="...">
		  <div class="button-container">
			<img src="/svg/cart.svg" class="gallery-button" alt="">
			<img src="/svg/x.svg" class="gallery-button" alt="">
		  </div>
		  <div class="carousel-caption">
			<h5>Emaille!</h5>
			<p>Langlebiger Schmuck aus traditioneller Handwerkskunst</p>
		  </div>
		</div>
		<div class="carousel-item">
		  <img src="/img/eheringe.jpeg" class="d-block w-100" alt="...">
		  <div class="carousel-caption">
			<h5>Mein Schatz</h5>
			<p>Herrsche über Mittelerde</p>
		  </div>
		</div>
	  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>
</div>
</div>
</div>



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

			//echo '<a href="' . $imgPath . $name . '"><img src="' . $thumbnailPath . $name . '" class="img-thumbnail gallery-thumbnail"></img></a>';
			echo '<a href="#"><img src="' . $thumbnailPath . $name . '" class="img-thumbnail gallery-thumbnail"></img></a>';
		}
	}
?>
		</div>
	</div>
</div>
</body>
</html>