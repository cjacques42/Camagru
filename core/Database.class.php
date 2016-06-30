<?php

class Database {
	static $db;

	public function __construct()
	{
		if (!isset(self::$db))
		{
			require "config/database.php";
			try
			{
				self::$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
				die();
			}
		}
	}

	public function getDatabase() {
		return (self::$db);
	}
}

?>