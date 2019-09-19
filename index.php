<?php
	session_start();
	$se = $_SESSION['email'];
	if(!isset($_SESSION['email'])){
		header('location: login.php');
	}else{
		echo $se;
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Placeholder</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div class="container">
			<div class="inner-container">
				<div class="dark">
					
				<div class="light">
				
					<a href="logout.php">logout</a>
					</div>
				</div>
			</div>
		</div>
	
	<script src="script/index.js"></script>
	</body>
	
</html>