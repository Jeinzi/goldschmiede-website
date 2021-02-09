<!doctype html>
<html>
<head>
	<?php
		include("php/head.php");
		include("php/utility.php");
		$websiteTitle = getWebsiteTitle();
	?>
	<title><?= $websiteTitle ?> - Javascript-Lizenzen</title>
    <style>
        td,th {
            border: 1px solid gray;
            padding: 0.5rem 1rem;
        }
        #jslicense-labels1 {
            margin-top: 10%;
        }
        a {}
	</style>
</head>
<body>
<?php
	include("php/navbar.php");
?>
<div class="container">

    <div class="row">
        <div class="col">
            <table id="jslicense-labels1" class="mx-auto">
                <!-- Frontend -->
                <tr>
                    <td><a href="/res/bootstrap.min.js">bootstrap.min.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.js">bootstrap.js</a></td>
                </tr>
                <tr>
                    <td><a href="/res/jquery-3.5.1.min.js">jquery-3.5.1.min.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="https://code.jquery.com/jquery-3.5.1.js">jquery-3.5.1.js</a></td>
                </tr>
                <tr>
                    <td><a href="/res/gallery.js">gallery.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="/res/gallery.js">gallery.js</a></td>
                </tr>

                <!-- Backend -->
                <tr>
                    <td><a href="/res/bootstrap4-toggle.min.js">bootstrap4-toggle.min.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.js">bootstrap4-toggle.js</a></td>
                </tr>
                <tr>
                    <td><a href="/admin/js/banner.js">banner.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="/admin/js/banner.js">banner.js</a></td>
                </tr>
                <tr>
                    <td><a href="/admin/js/list.js">list.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="/admin/js/list.js">list.js</a></td>
                </tr>
                <tr>
                    <td><a href="/admin/js/login.js">login.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="/admin/js/login.js">login.js</a></td>
                </tr>
                <tr>
                    <td><a href="/admin/js/uploadfield.js">uploadfield.js</a></td>
                    <td><a href="http://www.jclark.com/xml/copying.txt">MIT</a></td>
                    <td><a href="/admin/js/uploadfield.js">uploadfield.js</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
