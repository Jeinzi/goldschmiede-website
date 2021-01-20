<?php
session_start();
if (isset($_SESSION['goldsmithLoggedIn'])) {
	header("Location: .");
}
?>

<!doctype html>
<html>
<head>
	<title>Backend</title>
<?php
include("../head.php");
//include("../php/general.php"); TODO remove
?>
	<!-- <script src="/js/project.js" defer></script> -->
	<!-- <link rel="stylesheet" href="/css/project.css"> -->
	<link rel="stylesheet" href="css/backend.css?v=<?php echo time();?>"/> <!-- TODO: Remove time? -->
	<!-- <script src="js/project-overview-functions.js"></script> -->
</head>

<body>
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
								<img src="/svg/person-fill.svg">
							</div>
						</div>
						<input type="text" name="input-username" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Identification">
					</div>
					<div class="input-group mb-4">
	  					<div class="input-group-prepend">
							<div class="input-group-text">
								<img src="/svg/key-fill.svg">
							</div>
						</div>
						<input type="password" name="input-password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Authorization code">
					</div>
					<button id="login-button" type="submit" class="btn btn-success">Login</button>
				</div>
			</div>
			<div id="fail-div">
				<img src="/svg/x-white.svg" class="d-none" width="32px">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/login.js" defer></script>
</body>
</html>
