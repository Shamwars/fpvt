<?php
	/* Connect to a MySQL database using driver invocation */
	
	$dsn = 'mysql:dbname=fpvt;host=localhost';
	$user = 'root';
	$password = 'root';
	$port = 8889;
	
	try {
		$dbh = new PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			}

?>