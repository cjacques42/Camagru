<?php

class Auth {
	private $_db;

	public function __construct() {
		if (isset($_SESSION['login']))
			header("Location:index.php");
		$instance = new Database();
		$this->_db = $instance->getDatabase();
	}

	private function verify($user, $pass) {
		$hash = hash('whirlpool', $pass);
		$sth = $this->_db->prepare("SELECT * FROM user WHERE login = ? AND pass = ?");
		$sth->execute(array($user, $hash));
		$total = $sth->rowCount();
		if ($total == 1 && $sth->fetch()['actif'] == 1)
			return (true);
		else if ($total == 1)
			return ("Your account is not activated.<br />Show your email.");
		else
			return ("Invalid username and/or password.<br />Please try again.");
	}

	public function login($user, $pass) {
		$ret = $this->verify($user, $pass);
		if ($ret === true)
		{
			$_SESSION['login'] = $user;
			header("Location:index.php");
		}
		return ($ret);
	}
}

?>