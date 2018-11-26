<?php

// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Grab or initialize the input values
	$usernameOrEmail = $_POST['usernameOrEmail'];

	// Request a password reset email message
	$app->passwordReset($usernameOrEmail, $errors);
	
	$message = "An email has been sent to the specified account, if it exists. Please check your spam folder.";

}

?>

<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>alajiacolon.me</title>
	<meta name="description" content="Alajia Colon's personal website for IT 5233">
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
	<main id="wrapper">
		<h2>Reset Password</h2>
		<?php include('include/messages.php'); ?>
		<form method="post" action="reset.php">
			<input type="text" name="usernameOrEmail" id="usernameOrEmail" placeholder="Enter your username or email address" required="required" size="40" />
			<input type="submit" value="Submit" />
		</form>
		<a href="register.php">Need to create an account?</a>
	</main>
	</div>
	<div></div>
	</div>
	<?php include 'include/footer.php'; ?>
	<script src="js/site.js"></script>
</body>
</html>