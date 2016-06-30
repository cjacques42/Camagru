<?php

require "core/Mail.class.php";

class Register {
	
	private $_db;

	public function __construct()
	{
		$instance = new Database();
		$this->_db = $instance->getDatabase();
	}

	private function check_login($user) {
		$sth = $this->_db->prepare("SELECT * FROM user WHERE login = ?");
		$sth->execute(array($user));
		$total = $sth->rowCount();
		if ($total == 0)
			return true;
		else
			return "Username already taken.";
	}

	public function check_passwd($pass1, $pass2) {
		if ($pass1 !== $pass2)
			return "Passwords didn't match.";
		if (strlen($pass1) < 8)
			return "Your password is too short.";
		if (!preg_match('/[A-Z]/', $pass1))
			return "Your password must contain at least one capital letter.";
		if (!preg_match('/[1-9]/', $pass1))
			return "Your password must contain at least one digit.";
		return true;
	}

	private function verify($user, $pass1, $pass2) {
		$ret = $this->check_login($user);
		if ($ret !== true)
			return $ret;
		$ret = $this->check_passwd($pass1, $pass2);
		if ($ret !== true)
			return $ret;
		return true; 
	}

	private function mail($user, $mail, $key) {
		$subject = "Activate your account | Camagru";
		$message = "Bienvenue sur VotreSite,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://127.0.0.1/activation.php?p=activate&log=".urlencode($user)."&cle=".urlencode($key)."
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.";
		$tab = array('dest' => $mail, 'subject' => $subject, 'message' => $message);
		$instance = new Mail("camagru@camagru.com");
		$instance->send($tab);
	}

	public function register($user, $email, $pass1, $pass2) {
		$ret = $this->verify($user, $pass1, $pass2);
		if ($ret === true)
		{
			$hash = hash('whirlpool', $pass1);
			$key = md5(microtime(true) * rand(1, 100000) / rand(1, 100000));
			$sth = $this->_db->prepare("INSERT INTO user (login, email, pass, cle) VALUES (?, ?, ?, ?)");
			$sth->execute(array($user, $email, $hash, $key));
			$this->mail($user, $email, $key);
			header("Location:index.php?p=login");
		}
		return $ret;
	}
}

?>