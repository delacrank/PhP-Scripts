<?php # Script 9.3 - register.php
// This script performs an INSERT query to add a record to the users table.
DEFINE ('DB_USER', 'username');
DEFINE ('DB_PASSWORD', 'password');
DEFINE ('DB_HOST', 'hostname');
DEFINE ('DB_NAME', 'databasename');

// Make the connection
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not establish a connection to the MySQL: ' . mysqli_connect_error() );

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['UserName'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$un = trim($_POST['UserName']);
	}
	
	// Check for a last name:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$e = trim($_POST['email']);
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = trim($_POST['pass1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...

        
		// Make the query:
		$q = "INSERT INTO users (UserName, Password, email,  registration_date) VALUES ('$un', '$p', '$e', NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br /></p>';	

		} else { // If it did not run OK.
	
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
	
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.
		
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>
<h1>Register</h1>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="UserName" size="15" maxlength="20" value="<?php if (isset($_POST['UserName'])) echo $_POST['UserName']; ?>" /></p>
	<p>Last Name: <input type="text" name="email" size="15" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>