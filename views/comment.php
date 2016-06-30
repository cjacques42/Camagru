<?php
	foreach ($imgs as $img) {
		echo '<div class="container_picture"><a href="#"><img src="img/' . $img['file'] . '" /></a><a class="my_button" href="index.php?p=del&id=' . $img['id'] . '">Delete</a></div>';
	}

	foreach ($comments as $comment) {
		echo '<div class="container_picture">' . $comment['comment'] . '</div>';
	}
?>

	<form method="post">
		<input type="text" name="login" placeholder="Comment" value="" required>
		<input type="submit" value="Valid"><br />
	</form>
