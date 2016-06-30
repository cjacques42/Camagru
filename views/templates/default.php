<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
  
<body>
	<div id="top_nav">
		<?php
			foreach ($top as $key => $value) {
				echo '<a href="index.php?p=' . $key . '"><div class="container_top">' . $value . '</div></a>';
			}
		?>
	</div>
	<div id="header">
		<a href="index.php"><img src="img/logo.png"/ ></a>
		<div id="nav">
		<?php
			foreach ($nav as $key => $value) {
				echo '<a href="index.php?p=' . $key . '"><div class="container_nav">' . $value . '</div></a>';
			}
		?>
		</div>
	</div>
	<div id="main_content">
		<?= $content ?>
	}
	</div>
	<div id="footer">
		<i>© cjacques 2016</i>
	</div>
	<script src="script.js"></script>
</body>
</html>
