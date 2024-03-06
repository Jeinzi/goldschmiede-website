<?php
// Get POST variables.
$name = $_POST['name'];
$contact = $_POST['contact'];
$text = $_POST['text'];

include("include/utility.php");

// Must be lowercase!
$spamKeywords = array(
  "crypto",
  "bitcoin",
  " ceo ",
  " seo ",
  "investment",
  "get-profitshere.life",
  "take-profitnow.life",
  "2f-2f.de",
  "https://hob.",
  "hobhob",
  "crytohob",
  "robot",
  "Krypto",
  " reich ",
  " rich ",
);


// Generate message directories.
$messagePath = "messages/";
if (!file_exists($messagePath)) {
  mkdir($messagePath);
}
$spamPath = $messagePath . "spam/";
if (!file_exists($spamPath)) {
  mkdir($spamPath);
}

// Sort out spam.
$isSpam = false;
$textLowercase = strtolower($text);
$nameLowercase = strtolower($name);
foreach ($spamKeywords as $keyword) {
  if (str_contains($textLowercase, $keyword) || str_contains($nameLowercase, $keyword)) {
    $isSpam = true;
    break;
  }
}

// Compile notification text.
$notificationText = "Name: " . $name . "\n" .
                    "Kontakt: " . $contact . "\n";

// This phone field is hidden, so if it is filled out, it was a bot.
if ($_POST['phone'] != "") {
  $isSpam = true;
  $notificationText .= "Telefon: " . $_POST['phone'] . "\n";
}

$notificationText .= "Text:\n" . $text;

// Write to file.
$fileSuccess = true;
$fileName = date("c") . ".txt";
if ($isSpam) {
  $path = $spamPath . $fileName;
}
else {
  $path = $messagePath . $fileName;
}

try {
  $file = fopen($path, "a");
  if ($file === false) {
    $fileSuccess = false;
  }
  else {
    fwrite($file, $notificationText);
    fclose($file);
  }
}
catch (Exception $e) {
  $fileSuccess = false;
}


if (!$isSpam) {
  // Send email.
  $connection = connectdB();
  $query = $connection->prepare("select * from freya.settings;");
  $result = $query->execute();
  if ($result === false) {
    $mailSuccess = false;
  }
  $settingsRow = $query->fetch(PDO::FETCH_ASSOC);

  $query = $connection->prepare("select * from freya.contactEmails;");
  $result = $query->execute();
  if ($result === false) {
    $mailSuccess = false;
  }
  else {
    $firstRow = true;
    $recipient = '';
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    // Add all email addresses to an array.
    $recipientArray = array();
    foreach ($rows as $row) {
      $recipientArray[] = $row["email"];
    }
    // Join that array into a comma separated string.
    $recipients = implode(",", $recipientArray);

    $subject = $settingsRow["contactSubject"];
    $message = $notificationText;
    $header = 'From: ' . $settingsRow["contactFrom"] . "\r\n" .
              'Date: ' . date('r') . "\r\n" .
              'Sender: ' . $settingsRow["contactSender"] . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

    $mailSuccess = mail($recipients, $subject, $message, $header);
  }
}

if ($fileSuccess && ($isSpam || $mailSuccess)) {
  header('Location: thanks?success=1');
}
else {
  header('Location: thanks?success=0');
}
?>
