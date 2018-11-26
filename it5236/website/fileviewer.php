<?php

// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

// Get the name of the file to display the contents of
$name = $_GET["file"];

?>

<!doctype html>
<html lang="en">
<head>
	<title>alajiacolon.me</title>
	<meta name="description" content="Alajia Colon's personal website for IT 5233">
	<meta name="author" content="Alajia Colon">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Sacramento" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--1. Display Errors if any exists 
	2. If no errors display things -->
<body>
	<?php include 'include/header.php'; ?>
	<div class="body">

	<div></div>
	<div class="main-body">
	<h2>User Guide</h2>
	<div>
		<?php echo $app->getFile($name); ?>
	</div>
	
	</div>
	<div></div>
	</div>
</body>
</html>
