<?php
	foreach ($imgs as $img) {
		echo '<div class="container_picture"><a href="#"><img src="img/' . $img['file'] . '" /></a><a class="my_button" href="index.php?p=del&id=' . $img['id'] . '">Delete</a></div>';
	}
?>