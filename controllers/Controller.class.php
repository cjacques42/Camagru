<?php

require "core/Database.class.php";

class Controller {

	protected $_db;

	public function __construct() {
		$instance = new Database();
		$this->_db = $instance->getDatabase();
	}

	public function getParam($str, $default = true)
	{
		if (isset($_GET[$str]))
			return $_GET[$str];
		else if ($default === true)
			return false;
		else
			return $default;
	}

	protected function render($page, $var = array())
	{
		if (isset($_SESSION['login']))
		{
			$top = array('logout' => 'Deconnexion');
			$nav = array('home' => 'Accueil', 'view' => 'Mes photos', 'shooting' => 'Prendre une photos');
		}
		else
		{
			$top = array('login' => 'Connexion', 'register' => 'Inscription');
			$nav = array('home' => 'Accueil');
		}	
		extract($var);
		$title = "Camagru | " . htmlentities(strtoupper($page));
		if (file_exists("views/" . $page . ".php"))
		{
			ob_start();
			require "views/" . $page . ".php";
			$content = ob_get_clean();
		}
		require "views/templates/default.php";
	}
}

?>