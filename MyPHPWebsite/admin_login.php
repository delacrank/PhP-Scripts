<?php
session_start();
// session_Start always at the top
if(isset($_POST['Submit_Login'])){
	$email = trim($_POST['email']); // remove unintended spaces
	$pwd = md5(trim($_POST['pwd']));

	include('includes/dbc.php');
	// Query to check user and password to database
	$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pwd'";
	$result = mysql_query($sql) or die("Invalid query: ".mysql_error());
	if(mysql_num_rows($result)==0) {
		// credentials don't match so we need a message on the body
		$msg = "<h2 style='color:red;'>Invalid Credentials!</h2>";
	}else{
		$_SESSION['user'] = $email; // Add the user to the session so we can check for it later
		$msg = "<h2>Login Successful!</h2>"; // Credentials match, so we affirm.
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('includes/dbc.php');?>

<?php include('includes/header.inc');?>

<?php include('includes/nav.inc');?>

<div id="container">


	<?php include('includes/leftside.inc');?>


	<div id="right">
		<?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		<h3>Login</h3><hr><br><br>
	<form name="adminLogin" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	Name: <input type="text" id="email" name="email"><br><br>
	Password: <input type="text" id="pwd" name="pwd"><br><br>
	<input type="submit" name="Submit_Login" value="login">
	</form>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
