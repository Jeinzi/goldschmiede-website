<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #020432">
	<a class="navbar-brand" href="/admin">ADMIN</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="/admin">Galerie</a></li>
			<li class="nav-item"><a class="nav-link" href="upload-to-gallery">Bilder hochladen</a></li>
			<li class="nav-item"><a class="nav-link" href="tags">Tags</a></li>
			<li class="nav-item"><a class="nav-link" href="banners">Banner</a></li>
			<li class="nav-item"><a class="nav-link" href="settings">Einstellungen</a></li>
			<li class="nav-item" style="display: none;"><a class="nav-link" href="/javascript-licenses" data-jslicense="1">Javascript-Lizenzen</a></li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="logout"><?php echo $_SESSION['username']; ?> ausloggen</a>
			</li>
		</ul>
	</div>
</nav>