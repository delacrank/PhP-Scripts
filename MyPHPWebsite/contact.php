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
<h2>Contact Us</h2>
<?php
if(isset($_POST['send_email']))
{
	//Put form data into variables
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	if($name != "" && $email != "")
	{
	//set the To and From fields
		$to = "jcarias86@gmail.com";
		$subject = "Contact Form Submission";
		$from = $email;
		$headers = "From: $from";

		//Send the email
		mail($to, $subject, $message, $headers);
		}
		else
		{
			$error = "Sorry . . . You must fill in the name and email fields";
		}
	}
	?>
<?php
if(isset($error))
{
echo $error. '<br /><br />';
}
?>
<script type="text/javascript">
function checkForm()
{
var name = document.getElementByID('name').value;
var email = document.getElementByID('email').value;
	if(name == "")
	{
	alert("Your name cannot be blank");
	return false;
	}
	if(email == "")
	{
	alert("Your email cannot be blank")
	return false;
	}
}
</script>
<form method = "post" action="<?php $_SERVER['PHP_SELF'];?>" onsubmit = "return checkForm()">
Name:
<br />
<input type="text" name="name" id="name">
<br />
<br />
Phone:
<br />
<input type="text" name="phone">
<br />
<br />
Email:
<br />
<input type="text" name="email" id="email">
<br />
<br />
Message:
<br />
<textarea name="message"></textarea>
<br />
<br />
<input type="submit" name="send_email" value="Send Email">
</form>
</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
