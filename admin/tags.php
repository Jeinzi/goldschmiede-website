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
    <style>
        #button-delete {
            background-color: #dc3545;
            border-color: #dc3545;
            width: 10%;
        }

        .activeBadge {
            border: 2px solid black;
        }
    </style>
    <link rel="stylesheet" href="res/backend.css">
</head>
<body>
<?php include("include/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="main-heading border-bottom">Tags
                <button id="button-add-tag" class="btn btn-outline-input" style="float: right;">
                    <img src="/svg/plus.svg" alt="Plus-Zeichen">
                </button>
            </h1>
        </div>
    </div>
    <div class="row">
        <div id="tag-container" class="col-md-4">
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
      ?></div>
        <div class="col-md-8">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div id="tag-name-prepend" class="input-group-text">
                        Name
                    </div>
                </div>
                <input type="text" id="input-name" class="form-control" aria-labelledby="tag-name-prepend">
                <div class="input-group-append">
                    <input id="input-color" type="color" style="height: 100%;">
                </div>
                <div class="input-group-append">
                    <button id="button-text-color" class="btn btn-outline-input">Schriftfarbe</button>
                </div>
                <div class="input-group-append">
                    <button id="button-upload" class="btn btn-outline-input">
                        <img src="/svg/cloud-upload-fill.svg" alt="Hochladen-Symbol">
                    </button>
                </div>
            </div>
            <button id="button-delete" class="btn btn-outline-input">
                <img src="/svg/trash-fill-white.svg" alt="Mülleimer-Symbol">
            </button>
        </div>
    </div>
</div>
<script src="res/tags.js"></script>
</body>
</html>
