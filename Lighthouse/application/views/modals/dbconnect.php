<?php
    try{
		$pdo = new PDO("mysql:host=localhost;dbname=danesinventory","root","");
	} catch (PDOException $e) {
		exit("Database Connection Error!");
	}

?>