<?php

// Import the application classes
require_once('include/classes.php');

// Create an instance of the Application class
$app = new Application();
$app->setup();

// Declare a set of variables to hold the username and password for the user
$username = "";
$password = "";

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
	$username = $_POST['username'];
	$password = $_POST['password'];

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
	<meta name="description" content="Alajia Colon's personal website for IT 5233">
	<meta name="author" content="Alajia Colon">
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
		<h2>Login</h2>

		<?php include('include/messages.php'); ?>

		<div>
			<form method="post" action="login.php" id="usernameForm">
				<label>Username: </label>
				<input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>"  />
				<br/>

				<label>Password: </label>
				<input type="password" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
				<br/><br/>


				<input type="checkbox" name="saveLocal" id="saveLocal" ><label for="saveLocal"> Remember Me!</label> <br>
				<input type="submit" value="Login" name="submit"/>
			</form>
		</div>
		<a href="register.php">Need to create an account?</a>
		<br/><br/>
		<a href="reset.php">Forgot your password?</a>
	</div>
	<div></div>
	</div>
	<?php include 'include/footer.php'; ?>
	<script src="js/site.js"></script>
	<script src="myscripts.js"></script>
</body>

</html>
