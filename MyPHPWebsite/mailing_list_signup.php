<?php
if(isset($_POST['Submit_Mail_List']))
{
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$comments = $_POST['comments'];
		include('includes/dbc_admin.php');
		$sql = "INSERT INTO mailing_list (name, phone, email, comments) VALUES ('$name', '$phone', '$email', '$comments')";
		mysql_query($sql) or trigger_error('Error: '.mysql_error(), E_USER_ERROR);
		$INSERTED = "<h2>Thank you!</h2> Your entry has beeen inserted into the database!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validateForm() {
var theName = document.getElementById('name').value;
var phone = document.getElementById('phone').value;
var theEmail = document.getElementById('email').value;
var nameMsg = document.getElementById('nameMsg');
var phoneMsg = document.getElementById('phoneMsg');
var emailMsg = document.getElementById('emailMsg');
	if(theName == "") {
		nameMsg.innerHTML = "Your name cannot be blank.";
		return false;
	}
	if(phone == "")	{
		phoneMsg.innerHTML = "Your phone mumber cannot be blank.";
		return false;
	}
	if(theEmail == "")	{
		phoneMsg.innerHTML = "Your email cannot be blank.";
	return false;
	}
}
</script>

</head>

<body>

<?php include('includes/dbc.php');?>

<?php include('includes/header.inc');?>

<?php include('includes/nav.inc');?>

<div id="container">
	<?php include('includes/leftside.inc');?>

	<div id="right">
	
	<h2>Mailing List Sign-Up</h2>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>"	method="POST" name="form1" onSubmit="return validateForm()">
	Name: <input type="text" id="name" name="name">
	<?php if(isset($nameMsg)){echo $nameMsg;}?>
	<br><span id="nameMsg" style="color:red;"></span>
	<br>
	Phone: <input type="text" id="phone" name="phone">
	<?php if(isset($phoneMsg)){echo $phoneMsg;} ?>
	<br><span id="phoneMsg" style="color:red;"></span>
	<br>	
	Email: <input type="text" id="email" name="email">
	<?php if(isset($emailMsg)){echo $emailMsg;}?>
	<br><span id="emailMsg" style="color:red;"></span>
	<br>	
	Comments: <textarea name="comments"></textarea><br><br>
	<input type="submit" name="Submit_Mail_List" value="Submit">
	<br>
	<br>
	</form>
	<div><?php if(isset($INSERTED)){echo $INSERTED;}?></div>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>