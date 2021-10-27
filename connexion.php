<?php
	$db_username = 'root';
	$db_password = 'root';
	$conn = new PDO( 'mysql:host=localhost;dbname=formulaire', $db_username, $db_password );
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
