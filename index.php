<!doctype html>
<html lang="de">
<head>
  <?php include("include/head.php"); ?>
  <title><?= $websiteTitle ?> </title>
</head>
<body>
<?php
  include("include/navbar.php");

  // Generate the html code for the banner carousel.
  function generateCarousel() {
    $carouselId = "banner-carousel";
    $connection = connectDb();

    $query = $connection->prepare("SELECT * FROM banners WHERE active=1");
    $result = $query->execute();
    if ($result == false) {
      //TODO Error("Failed to query admins.");
      echo "Could not get banners.";
    }


    echo "<div id='$carouselId' class='carousel slide border-bottom' data-ride='carousel'>
        <div class='carousel-inner'>";

    // Output images.
    $count = 0;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      echo "
        <div class='carousel-item" . ($count == 0 ? " active" : "") . "'>
          <img src='img/banner/" . $row["fileName"] . "' class='d-block w-100' aria-labelledby='banner-title-" . $count . "'>
          <div class='carousel-caption d-none d-md-block'>
            <h5 id=banner-title-" . $count . ">" . $row['title'] . "</h5>
            <p>" . $row['subtitle'] . "</p>
          </div>
        </div>";
      ++$count;
    }

    // Output controls.
    if ($count > 1) {
      echo "<ol class='carousel-indicators'>";
      for ($i = 0; $i < $count; ++$i) {
        echo "<li data-target='#$carouselId' data-slide-to='$i'" . ($i == 0 ? " class='active'" : "") . "></li>";
      }

      echo "</ol>";
      echo "
        <a class='carousel-control-prev' href='#$carouselId' role='button' data-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='sr-only'>Previous</span>
        </a>
        <a class='carousel-control-next' href='#$carouselId' role='button' data-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='sr-only'>Next</span>
        </a>";
    }


    echo "  </div>";
    echo "</div>";
  }


  generateCarousel();


    include("index-content.html");
?>
</body>
</html>
