<!doctype html>
<html lang="de">
<head>
	<?php
		include("include/head.php");
		include("include/utility.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Nachricht gesendet </title>
</head>
<body>
<?php
	include("include/navbar.php");
	$success = $_GET['success'];
?>


<div style="position: fixed;
	height: 100%;
	width: 100%;
	display: flex;
	justify-content: center;
	align-items: center;">
	<div class="card" style="width: 540px;">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div style="position: absolute;height:100%;width:100%;display:flex;justify-content:center;align-items:center;">
				<?php if ($success) {
				echo
				'<svg width="90%" fill="red" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
				</svg>';
				}
				else {
					echo '<svg width="80%" viewBox="0 0 16 16" class="bi bi-emoji-frown" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
					<path fill-rule="evenodd" d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683z"/>
					<path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
				  </svg>';
				}
				?>
			</div>
			</div>
			<div class="col-md-8">
				<div class="card-body">
				<h5 class="card-title"><?php echo $success ? "Danke! :)" : "Oh Nein! :(" ?></h5>
				<?php
				if ($success) {
					echo '<p class="card-text">Ich freue mich dass du Interesse an meiner Goldschmiedekunst hast! Ich werde mich in Bälde bei dir melden.</p>';
					echo '<p class="card-text"><small class="text-muted">Du bist super!</small></p>';
				}
				else {
					echo '<p class="card-text">Leider konnte deine Nachricht nicht gesendet werden. Du kannst mich gerne auf andere Weise kontaktieren, siehe <a href="imprint">Impressum</a>.</p>';
					echo '<p class="card-text"><small class="text-muted">Danke für dein Interesse!</small></p>';
				}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>