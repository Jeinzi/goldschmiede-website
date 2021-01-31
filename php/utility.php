<?php
// Adds a fixed alert to the bottom of the page.
function alert($text) {
	echo '<div class="alert alert-warning alert-dismissible mx-auto" role="alert">';
	echo $text;
	echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button>';
  	echo '</div>';
}
?>
