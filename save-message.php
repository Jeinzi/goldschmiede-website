<?php
// Get POST variables.
$name = $_POST['name'];
$contact = $_POST['contact'];
$text = $_POST['text'];


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
$empfaenger = ''; // TODO: Add emails, separated by commas.
$betreff = 'Kontaktanfrage Website';
$nachricht = $notificationText;
$header = 'From: kontakt@freya-goldschmie.de' . "\r\n" .
    'Reply-To: kontakt@freya-goldschmie.de' . "\r\n" . // TODO: Needed?
    'Date: ' . date('r') . "\r\n" .
    'Sender: kontakt@freya-goldschmie.de' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


$mailSuccess = mail($empfaenger, $betreff, $nachricht, $header);

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
