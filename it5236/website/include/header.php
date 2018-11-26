<?php

	// Assume the user is not logged in and not an admin
	$isadmin = FALSE;
	$loggedin = FALSE;
	
	// If we have a session ID cookie, we might have a session
	if (isset($_COOKIE['sessionid'])) {
		
		$user = $app->getSessionUser($errors); 
		$loggedinuserid = $user["userid"];

		// Check to see if the user really is logged in and really is an admin
		if ($loggedinuserid != NULL) {
			$loggedin = TRUE;
			$isadmin = $app->isAdmin($errors, $loggedinuserid);
		}

	} else {
		
		$loggedinuserid = NULL;

	}


?>
	<div class="nav">
		<div><img src="css/images/logo.png" alt="Logo" height="200px" style="clear:right" ></div>
		<div><a href="index.php" class="nav">Home</a></div>
		<?php if (!$loggedin) { ?>
			<div><a href="login.php" style="text-decoration: none; color: #ee9e95;">Login</a></div>
			<div><a href="register.php" style="text-decoration: none; color: #ee9e95;">Register</a></div>
		<?php } ?>
		<?php if ($loggedin) { ?>
			<div><a href="list.php">List</a></div>
			&nbsp;&nbsp;
			<div><a href="editprofile.php" style="text-decoration: none; color: #ee9e95;">Profile</a></div>
			&nbsp;&nbsp;
			<?php if ($isadmin) { ?>
				<div><a href="admin.php" style="text-decoration: none; color: #ee9e95;">Admin</a></div>
				&nbsp;&nbsp;
			<?php } ?>
			<div><a href="fileviewer.php?file=include/help.txt" style="text-decoration: none; color: #ee9e95;">Help</a></div>
			&nbsp;&nbsp;
			<div><a href="logout.php" style="text-decoration: none; color: #ee9e95;">Logout</a></div>
			&nbsp;&nbsp;

		<?php } ?>
	</div>
	
