<?php

session_start();

require "controllers/ValidationController.class.php";

$controller = new ValidationController();
$page = $controller->getParam('p');
if ($page === false || !method_exists($controller, $page))
	header("Location:index.php");

$controller->$page();

?>