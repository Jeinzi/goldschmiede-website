<?php
// Checks if a user password combination is valid.
function checkPassword($username, $password) {
  $connection = connectDb();
  $query = $connection->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");
  $result = $query->execute(array($username));

  if ($result === true) {
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row && password_verify($password, $row['hash'])) {
      return true;
    }
  }
  return false;
}
?>
