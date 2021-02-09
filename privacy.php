<!doctype html>
<html>
<head>
	<?php
		include("php/head.php");
		include("php/utility.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Datenschutz </title>
</head>
<body>
<?php include("php/navbar.php") ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="main-heading border-bottom">Datenschutz&shy;erklärung</h1>
			<h2>Kurzfassung</h2>
			Wir haben ehrlichen Respekt vor Ihrer Privatsphäre, deshalb sammelt diese Webseite so wenig Daten wie möglich. Kein System ist absolut sicher, das gilt insbesondere für Server im Internet. Nur Daten, die gar nicht erst erhoben werden, sind geschützt. Deshalb:<br><br>
			<ul>
			<li>Verwenden wir kein Google Analytics oder sonstige externe Analysetools.</li>
			<li>Binden wir auch sonst keine Skripte von Drittanbietern ein. Wenn Sie diese Webseite besuchen, reden Sie <i>nur</i> mit dieser Webseite.</li>
			<li>Ist der Quellcode dieser Seite als <a href="https://fsfe.org/freesoftware/index.de.html">Freie Open-Source-Software</a> verfügbar und kann auf <a href="https://github.com/Jeinzi/goldschmiede-website">Github</a> eingesehen werden. Sie müssen unseren Angaben hier also nicht blind vertrauen, sondern können selbst überprüfen wie die Webseite im Hintergrund arbeitet, können <a href="https://github.com/Jeinzi/goldschmiede-website/issues">Fehler melden</a> und sogar aktiv an der Entwicklung teilnehmen.</li>
			</ul>

			<h2 class="mt-5">Details</h2>
			<h4>Cookies</h4>
			<b>Wir setzen keine unnötigen Cookies.</b><br>
			Ein Cookie wird nur dann gesetzt, wenn  es technisch unbedingt nötig ist, zum Beispiel wenn Sie sich als Administrator einloggen (hoffentlich nicht). Deshalb gibt es auch keines dieser außerordentlich nervigen, oft unnötig kompliziert gestalten Popups, welches Sie zur Zustimmung zur Datensammlung nötigt. Wenn Sie wie wir genervt von Cookie-Bannern sind, möchten wir an dieser Stelle das Open-Source-Plugin <a href="https://www.i-dont-care-about-cookies.eu/">I don't care about cookies</a> für Ihren Webbrowser empfehlen, das diese Popups fast überall beseitigt.

			<h4>Server-Logs</h4>
			<b>Der Webserver protokolliert Zugriffe auf diese Webseite.</b><br>
			Dies dient beispielsweise dazu, missbräuchliches Verhalten und Angriffe identifizieren zu können, aber auch unserem Interesse wie viele Leute welche Seiten aufrufen. Ein Eintrag in diesen Log-Dateien sehen wie folgt aus:<br>
			<code>
				79.205.102.136 - - [24/Jan/2021:00:36:45 +0000] "GET /privacy HTTP/1.1" 200 2891 "https://freya-goldschmie.de/imprint" "Mozilla/5.0 (X11; Linux x86_64; rv:84.0) Gecko/20100101 Firefox/84.0"
			</code><br>
			Sie können sehen, dass bei einem Seitenaufruf IP-Adresse, Zeitpunkt, aufgerufene Seite, welche andere Seite Sie hergeführt hat, Browser und Betriebssystem gespeichert werden. Die IP-Adressen werden nach drei Tagen aus den Logs gelöscht.

			<h4>Kontaktformular</h4>
			Wenn Sie uns über das Kontaktformular kontaktieren, werden Ihre Eingaben auf dem Webserver gespeichert und  zusätzlich via E-Mail an uns verschickt.
		</div>
	</div>
</div>
</body>
</html>