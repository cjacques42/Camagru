<?php

class Image {

	private $_db;

	public function __construct()
	{
		$instance = new Database();
		$this->_db = $instance->getDatabase();
	}

	public function show_all() {
		$sth = $this->_db->prepare("SELECT * FROM image");
		$sth->execute();
		return $sth->fetchAll();
	}

	public function show_my() {
		if (isset($_SESSION['login']))
		{
			$sth = $this->_db->prepare("SELECT image.id, image.file FROM image INNER JOIN user ON image.id_user = user.id WHERE login = ?");
			$sth->execute(array($_SESSION['login']));
			return $sth->fetchAll();
		}
		else
			header("Location:index.php");
	}

	public function show_id( $id ) {
		$sth = $this->_db->prepare("SELECT image.id, image.file FROM image INNER JOIN user ON image.id_user = user.id WHERE image.id = ?");
		if ($sth->rowCount() != 1)
			header("Location:index.php");
		$sth->execute(array($id));
		return $sth->fetchAll();
	}
}
?>