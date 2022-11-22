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
  <?php include("../include/head.php"); ?>
  <title>Backend - Passwortänderung</title>
</head>
<body>
<?php  include("include/navbar.php"); ?>
<div class="container">
  <h1 class="main-heading border-bottom">Admin-Passwort ändern</h1>

  <form action="change-password" method="POST">
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <div id="contact-subject-prepend" class="input-group-text">
          Altes Passwort
        </div>
      </div>
      <input type="password" name="old-pw" class="form-control" placeholder="" aria-labelledby="contact-subject-prepend">
    </div>
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <div id="contact-subject-prepend" class="input-group-text">
          Neues Passwort
        </div>
      </div>
      <input type="password" name="new-pw" class="form-control" placeholder="" aria-labelledby="contact-subject-prepend">
    </div>
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <div id="contact-subject-prepend" class="input-group-text">
          Nochmal neues Passwort bidde
        </div>
      </div>
      <input type="password" name="new-pw-repeat" class="form-control" placeholder="" aria-labelledby="contact-subject-prepend">
    </div>
    <button class="btn btn-primary float-right">Ändern</button>
  </form>

<?php
include("include/backend-utility.php");

if (isset($_POST['old-pw']) &&
    isset($_POST['new-pw']) &&
    isset($_POST['new-pw-repeat'])
) {
  $newPw = $_POST['new-pw'];
  $newPwRepeat = $_POST['new-pw-repeat'];

  $success = true;
  $message = "Unbekannter Fehler.";
  // Check current password.
  if (!checkPassword($_SESSION['username'], $_POST['old-pw'])) {
    $success = false;
    $message = "Altes Passwort stimmt nicht.";
  }
  // Check whether new passwords match.
  if ($_POST['new-pw'] !== $_POST['new-pw-repeat']) {
    $success = false;
    $message = "Neue Passwörter stimmen nicht überein.";
  }

  // Update database.
  if ($success) {
    $hash = password_hash($_POST['new-pw'], PASSWORD_DEFAULT);
    try {
      $connection = connectdB();
      $query = $connection->prepare("UPDATE admins SET hash=? WHERE username=?;");
      $result = $query->execute(array($hash, $_SESSION['username']));

      if ($result === true && $query->rowCount() > 0) {
        $message = "Passwort erfolgreich geändert :)";
      }
      else {
        $success = false;
        $message = "Neues Passwort konnte nicht gespeichert werden.";
      }
    }
    catch (PDOException $e) {
      $success = false;
      $message = "Problem beim Datenbankzugriff.";
    }
  }

  // Notify user about success or failure.
  if ($success) {
    alert($message, "alert-success");
  }
  else {
    alert($message);
  }
}
?>
</div>
</body>
</html>
