<?php
// Get POST variables.
$name = $_POST['name'];
$contact = $_POST['contact'];
$text = $_POST['text'];

include("include/utility.php");


// Generate message directory.
$messagePath = "messages/";
if (!file_exists($messagePath)) {
    mkdir($messagePath);
}

// Compile notification text.
$notificationText = "Name: " . $name . "\n" .
                    "Kontakt: " . $contact . "\n" .
                    "Text:\n" . $text;


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
    foreach ($rows as $row) {
        if ($firstRow) {
            $firstRow = false;
        }
        else {
            $recipient .= ",";
        }
        $recipient .= "";
    }

    $subject = $settingsRow["contactSubject"];
    $message = $notificationText;
    $header = 'From: ' . $settingsRow["contactFrom"] . "\r\n" .
    'Reply-To: ' . $settingsRow["contactReplyTo"] . "\r\n" . // TODO: Needed?
    'Date: ' . date('r') . "\r\n" .
    'Sender: ' . $settingsRow["contactSender"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
   
    $mailSuccess = mail($recipient, $subject, $message, $header);
}

// Write to file.
$fileSuccess = true;
$fileName = date("c") . ".txt";
$path = $messagePath . $fileName;
try {
    $file = fopen($path, "a");
    fwrite($file, $notificationText);
    fclose($file);
}
catch (Exception $e) {
    $fileSuccess = false;
}



if ($fileSuccess && $mailSuccess) {
    header('Location: thanks?success=1');
}
else {
    header('Location: thanks?success=0');
}
?>
