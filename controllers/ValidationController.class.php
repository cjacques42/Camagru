<?php

require "controllers/Controller.class.php";

class ValidationController extends Controller {
	
	private $_log;
	private $_key;

	public function __construct() {
		parent::__construct();
		$this->_log = $this->getParam('log');
		$this->_key = $this->getParam('key');
	}

	public function forget() {
		if (isset($_POST['login']))
		{
			$sth = $this->_db->prepare("SELECT * FROM user WHERE login = ?");
			$sth->execute(array($_POST['login']));
			$total = $sth->rowCount();
			if ($total != 0)
			{
				$info = "Show your email.";
				$mail = $sth->fetch()['email'];
			}
			else
				$info = "Error, unknown user.";
			$result = compact("info");
			$this->render("forget", $result);
		}
		else
			$this->render("forget");
	}

	public function activate() {
		$sth = $this->_db->prepare("SELECT * FROM user WHERE login = ? AND cle = ?");
		$sth->execute(array($this->_log, $this->_key));
		$total = $sth->rowCount();
		if ($total == 1 && $sth->fetch()['actif'] == 1)
			$content = "Your account is already activate.";
		else if ($total == 1)
		{
			$content = "Your account has been activate.";
			$key = md5(microtime(true) * rand(1, 100000) / rand(1, 100000));
			$sth = $this->_db->prepare("UPDATE user SET actif = 1, cle = ? WHERE login = ?");
			$sth->execute(array($key, $this->_log));
		}
		else
			$content = "Error, your account can't be activate.";
		$result = compact("content");
		$this->render("activate", $result);
	}

	public function modify() {

	}
}