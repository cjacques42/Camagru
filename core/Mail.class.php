<?php

class Mail {
	
	private $_db;
	private $_from;

	public function __construct( $from ) {
		$instance = new Database();
		$this->_db = $instance->getDatabase();
		if (isset($from))
			$this->_from = "From: " . $from;
	}

	public function send(array $kwargs) {
		if (isset($kwargs['dest']))
			$dest = $kwargs['dest'];
		if (isset($kwargs['subject']))
			$subject = $kwargs['subject'];
		if (isset($kwargs['message']))
			$message = $kwargs['message'];
		mail($dest, $subject, $message, $this->_from);
	}
}
?>