<?php

require "controllers/Controller.class.php";

class PictureController extends Controller {

	public function home() {
		require "models/Image.class.php";
		$img = new Image();
		$imgs = $img->show_all();
		$result = compact($imgs, "imgs");
		$this->render("home", $result);
	}

	public function login() {
		require "core/Auth.class.php";
		if (isset($_POST['login']) && isset($_POST['pass1']))
		{
			$instance = new Auth();
			$info = $instance->login($_POST['login'], $_POST['pass1']);
			$result = compact($info, "info");
			$this->render("login", $result);
		}
		else
			$this->render("login");
	}

	public function register() {
		require "core/Register.class.php";
		if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['pass1']) && isset($_POST['pass2']))
		{
			$instance = new Register();
			$info = $instance->register(
				htmlentities($_POST['login']),
				htmlentities($_POST['email']),
				htmlentities($_POST['pass1']),
				htmlentities($_POST['pass2']));
			$result = compact($info, "info");
			$this->render("register", $result);
		}
		else
			$this->render("register");
	}

	public function logout() {
		unset($_SESSION['login']);
		header("Location:index.php");
	}

	public function view() {
		require "models/Image.class.php";
		$img = new Image();
		$imgs = $img->show_my();
		$result = compact($imgs, "imgs");
		$this->render("view", $result);
	}

	public function del() {
		$id = $this->getParam('id');
		if ($id === false || !intval($id))
			header("Location:index.php");
		if (isset($_SESSION['login']))
		{
			$sth = $this->_db->prepare("SELECT image.id, image.file, user.login FROM image INNER JOIN user ON image.id_user = user.id WHERE image.id = ? AND user.login = ?");
			$sth->execute(array($id, $_SESSION['login']));
			$total = $sth->rowCount();
			if ($total == 1)
			{
				$sth = $this->_db->prepare("DELETE FROM image WHERE id = ?");
				$sth->execute(array($id));
			}
		}
		header("Location:index.php?p=view");
	}

	public function comment() {
		$param = $this->getParam('id');
		if ($param !== false && intval($param))
		{
			
		}
		else if ($param === false)
		{
			
		}
		else
			header("Location:index.php");
	}
}