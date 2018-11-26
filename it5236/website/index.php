<?php
	
// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

// Declare an empty array of error messages
$errors = array();

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>lajia.me</title>
	<meta name="description" content="Alajia Colon's personal website for IT 5236">
	<meta name="author" content="Alajia Colon">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Sacramento" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php include 'include/header.php'; ?>
	<div class="body">
		<div></div>
		
		<div class="main-body">
			<h2>Boo'ed in the Boro</h2>
			<p>
				This is a website to give couples fun date ideas for people living in the Statesboro area!
				Students currently registered for the course may <a href="login.php">create an account</a> or proceed directly to the 
				<a href="login.php">login page</a>.
			</p>
		</div>
		
		<div></div>
	
	</div>
	
	<?php include 'include/footer.php'; ?>
	<script src="js/site.js"></script>
</body>
</html>
