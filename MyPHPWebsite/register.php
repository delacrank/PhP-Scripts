<?php
if(isset($_POST['submit_register'])){
	$email = $_POST['email'];
	$pwd = md5($_POST['password']);
	include('includes/dbc_admin.php');
	$result = mysql_query("INSERT INTO users (email, password)
		VALUES ('$email', '$pwd')")
		or trigger_error('Error: '.mysql_error(), E_USER_ERROR);
	if($result){
		$msg = "<br><strong>New user successfully inserted!</strong>";
		$msg .= "<br><a href='admin_login.php'>Login Page</a>";
	}
}
?>

<!DOCTYPE html>
<html>
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
	<h3>Registration Form</h3><hr><br><br>
	<form id="form1" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<label for="email">Email Address: </label><input type="text" name="email" /><br /><br><br>
		<label for="password">Password: </label><input type="password" name="password" /><br /><br><br>
		<input type="submit" value="Submit" name="submit_register" />
	</form>
	<?php
	if(isset($msg)) {
		echo $msg;
	}
	?>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
