<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db_name = "camagru";
try
{
	$db = new PDO("mysql:host=$host", $user, $pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
	die();
}
$requests = "
			CREATE DATABASE IF NOT EXISTS $db_name;
			USE $db_name;
			CREATE TABLE user
			(
				id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
				login VARCHAR(512) NOT NULL,
				pass VARCHAR(512) NOT NULL,
				email VARCHAR(512) NOT NULL,
				actif BOOLEAN DEFAULT FALSE,
				cle VARCHAR(32) NOT NULL
			);
			CREATE TABLE image
			( 
				id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
				id_user INT NOT NULL,
				file VARCHAR(512) NOT NULL
			);
			CREATE TABLE comment
			(
				id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
				id_user INT NOT NULL,
				id_image INT NOT NULL,
				comment VARCHAR(1000) NOT NULL
			);
				";
try
{
    $db->exec($requests);
	header("Location: ../index.php");
}
catch (PDOException $e)
{
    echo $e->getMessage();;
    die();
}

// $db->exec("DROP DATABASE $db_name;");
//unlink("log/log");
?>
