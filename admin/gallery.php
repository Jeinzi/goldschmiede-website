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
  <?php include("../include/head.php"); ?>
  <link rel="stylesheet" href="res/backend.css">
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
      template("gallery-list-item", array(
        "name"    => $row["fileName"],
        "id"      => $row["id"],
        "classes" => $additionalClasses,
      ));
    }
    return $firstFileName;
  }
?>
  <div class="modal fade" id="tag-modal" tabindex="-1" aria-labelledby="tag-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tag-modal-label">Tags hinzufügen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
            try {
              $connection = connectdB();
              $query = $connection->prepare("select * from freya.tags;");
              $result = $query->execute();
            }
            catch (PDOException $e) {
              alert("Exception: Can't get tags from database.");
              exit;
            }
            if ($result === false) {
              alert("Can't get tags from database.");
              exit;
            }

            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
              $name = $row["name"] == "" ? " " : $row["name"];
              template("tag", array(
                "bgColor" => $row["color"],
                "textColor" => $row["textColor"],
                "id" => $row["id"],
                "name" => $row["name"],
              ));
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-4 col-lg-3 mb-3">
        <div class="list-group" style="overflow-y:auto;max-height:700px;">
          <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h4 class="mb-0">Galerie</h4>
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
            <h3 class="border-bottom pb-1 d-none d-lg-block">
              Tags
              <button title="Tags hinzufügen" class="btn btn-outline-input btn-outline-secondary btn-sm" data-toggle="modal" data-target="#tag-modal" style="float: right;">
                <img src="/svg/plus.svg" alt="Plus-Zeichen">
              </button>
            </h3>
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

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div id="price-prepend" class="input-group-text">
                  Preis
                </div>
              </div>
              <input type="text" class="form-control" placeholder="" aria-labelledby="price-prepend" data-db-path="galleryImages.price">
              <div class="input-group-append">
                <div class="input-group-text">€</div>
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


// Click on the 'X' on a tag.
$("#tag-container").on("click", "[class=tag-x]", function() {
  var badge = $(this).parent(".badge");
  $.get('disconnect-tag', {
    tagId: badge.attr('data-tag-id'),
    imgId: getUploadId()
  }).done(function(response) {
    if (response == 1) {
      badge.remove();
    }
  });
});


// Click on a tag in the popup modal.
$(".tag").click(function() {
  var id = $(this).attr("data-id");
  var bgColor = $(this).css("background-color");
  var textColor = $(this).css("color");
  var name = $(this).text();
  $.get("connect-tag", {
    tagId: id,
    imgId: getUploadId()
  }, function(response) {
    if (response == 1) {
      showTag({
        tagId: id,
        name: name,
        color: bgColor,
        textColor: textColor
      });
    }
  });
});

function outputTags() {
  $("#tag-container").children("span").remove();
  $.get("get-tags", {id: getActiveListItemId()}, function(data) {
    data = JSON.parse(data);
    data.forEach(function(item, i) {
      showTag(item);
    })
  });
}

function showTag(obj) {
  if (obj.color[0] != 'r') {
    obj.color = "#" + obj.color;
  }
  if (obj.textColor[0] != 'r') {
    obj.textColor = "#" + obj.textColor;
  }
  $("#tag-container").append(`<span class="badge" style="background-color: ${obj.color}; color: ${obj.textColor};" data-tag-id="${obj.tagId}">${obj.name} <span title="Tag entfernen" class="tag-x">X</span></span> `);
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
