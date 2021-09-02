<?php
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=aprms', 'root', '');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	} catch (PDOException $e) {
		echo "Error connecting to database ".$e->getMessage();
	}
?>