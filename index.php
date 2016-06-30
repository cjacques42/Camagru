<?php

session_start();

require "controllers/PictureController.class.php";

$controller = new PictureController();
$default = $controller->getParam('p', 'home');
if (!method_exists($controller, $default))
	header("Location:index.php");
$controller->$default();

?>