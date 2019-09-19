<?php
	$host = "localhost";
	$password ="";
	$root = "root";
	$db_name = "teamplaceholder";
	
	if(!$connect = mysqli_connect($host, $root, $password, $db_name)){
		$message = mysqli_error($connect);
		echo $message;
		die();
	}

?>