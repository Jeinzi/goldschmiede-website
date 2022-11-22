<?php
session_start();

if (!isset($_SESSION['goldsmithLoggedIn'])) {
  header("Location: login");
}
else {
  header("Location: gallery");
}
?>