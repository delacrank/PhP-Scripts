<?php
if(isset($_POST['Add_Reviews']))
{
$Product = $_POST['Product'];
$Name2 = $_POST['Name2'];
$Comment2 = $_POST['Comment2'];
		include('includes/dbc_admin.php');
		$sql = "INSERT INTO reviews2 (Product, Name2, Comment2) VALUES ('$Product', '$Name2', '$Comment2')";
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
var ProductID = document.getElementById('Product').value;
var theName = document.getElementById('Name2').value;
var Comments = document.getElementById('Comment2').value;
var ProductMsg = document.getElementById('ProductMsg');
var theNameMsg = document.getElementById('theNameMsg');
var CommentsMsg = document.getElementById('CommentsMsg');

	if(ProductID == "") {
		ProductMsg.innerHTML = "Your product cannot be blank.";
		return false;
	}
	if(theName == "")	{
		theNameMsg.innerHTML = "Your name cannot be blank.";
		return false;
	}
	if(Comments == "")	{
		CommentsMsg.innerHTML = "Your comments cannot be blank.";
	return false;
	}
}
</script>

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

	<h2> Add Reviews </h2>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>"	method="POST" name="form1" onSubmit="return validateForm()">
	Product Name: <input type="text" id="Product" name="Product">
	<?php if(isset($ProductMsg)){echo $ProductMsg;}?>
	<br><span id="ProductMsg" style="color:red;"></span>
	<br>
	Name: <input type="text" id="Name2" name="Name2">
	<?php if(isset($NameMsg)){echo $NameMsg;} ?>
	<br><span id="theNameMsg" style="color:red;"></span>
	<br>	
	Comments: <input type="text" id="Comment2" name="Comment2">
	<?php if(isset($CommentsMsg)){echo $CommentsMsg;}?>
	<br><span id="CommentsMsg" style="color:red;"></span><br><br>
	<input type="submit" name="Add_Reviews" value="Submit"><br>
	<a href="reviews.php">To Reviews</a><br>
	<a href="Products.php">Back To Products</a><br>
	</form>
	<div><?php if(isset($INSERTED)){echo $INSERTED;}?></div>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
