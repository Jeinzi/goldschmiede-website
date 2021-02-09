<?php
session_start();
if (isset($_SESSION['goldsmithLoggedIn'])) {
	header("Location: .");
}
?>

<!doctype html>
<html lang="de">
<head>
	<title>Backend</title>
<?php
include("../include/head.php");
?>
	<link rel="stylesheet" href="res/backend.css">
</head>

<body>
	<a class="dropdown-item" href="/javascript-licenses" style="display: none;" data-jslicense="1">Javascript-Lizenzen</a>
	<div class="container-login d-flex" style="flex-direction: column">
		<div id="container-card">
			<div class="card text-center card-login">
				<div id="login-header" class="card-header">
					Backend-Login
				</div>
				<div class="card-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<img src="/svg/person-fill.svg" alt="Person">
							</div>
						</div>
						<input type="text" name="input-username" class="form-control" id="input-username" placeholder="Identification">
					</div>
					<div class="input-group mb-4">
	  					<div class="input-group-prepend">
							<div class="input-group-text">
								<img src="/svg/key-fill.svg" alt="Schlüssel">
							</div>
						</div>
						<input type="password" name="input-password" class="form-control" id="input-password" placeholder="Authorization code">
					</div>
					<button id="login-button" type="submit" class="btn btn-success">Login</button>
				</div>
			</div>
			<div id="fail-div">
				<img src="/svg/x-white.svg" class="d-none" width="32" alt="Kreuz">
			</div>
		</div>
	</div>
	<script src="res/login.js" defer></script>
</body>
</html>
