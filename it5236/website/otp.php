<?php

// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

// Declare a set of variables to hold the one time password for the user
$otp = "";

// Declare an empty array of error messages
$errors = array();

// If someone has clicked their email validation link, then process the request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	if (isset($_GET['id'])) {

		$success = $app->processEmailValidation($_GET['id'], $errors);
		if ($success) {
			$message = "Email address validated. You may login.";
		}

	}

}

// If someone is attempting to login, process their request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Pull the username and password from the <form> POST
	$otp = $_POST['otp'];

	// Attempt to login the user and capture the result flag
	$result = $app->login($username, $password, $errors);

	// Check to see if the login attempt succeeded
	if ($result == TRUE) {

		// Redirect the user to the topics page on success
		header("Location: list.php");
		exit();

	}

}

if (isset($_GET['register']) && $_GET['register']== 'success') {
	$message = "Registration successful. Please check your email. A message has been sent to validate your address.";
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>alajiacolon.me</title>
	<meta name="description" content="Russell Thackston's personal website for IT 5233">
	<meta name="author" content="Russell Thackston">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Sacramento" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!--1. Display Errors if any exists
	2. Display Login form (sticky):  Username and Password -->

<body>
	<?php include 'include/header.php'; ?>
	<div class="body">

	<div></div>
	<div class="main-body">
		<h2>One Time Password Entry</h2>

		<?php include('include/messages.php'); ?>

		<div>
			<form method="post" action="otp.php">
				<label>One Time Password: </label>
				<input type="text" name="otp" id="otp" placeholder="One Time Password" value="<?php echo $otp; ?>" />
				<br/>

				<input type="submit" value="Submit" name="Submit" />
			</form>
		</div>
	</div>
	<div></div>
	</div>
	<?php include 'include/footer.php'; ?>
	<script src="js/site.js"></script>
</body>
</html>
