<?php
session_start();
$user = $_SESSION['user'];
if(!isset($user)) {
	header("Location:admin_login.php");
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
	<?php
		if(isset($_POST['Submit_Update'])){
			include('includes/dbc_admin.php');
			$table = $_POST['table'];
			$id = $_POST['id'];
			$title = $_POST['title'];
			$message = $_POST['message'];
			mysql_query("UPDATE $table SET title='$title', message='$message' WHERE id=$id")
			or trigger_error('Error: '.mysql_error(), E_USER_ERROR);
			$msg = "<h2>Your content has successfully updated!</h2><br>";
		}
	?>
	<?php
	if(isset($msg)){
		echo $msg;
	}
	?>
	<h2>Edit Page</h2>
	<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" name="editpage">
	<br/>
	<?php
		$id = $_GET['id'];
		$table = $_GET['table'];
		include('includes/dbc_admin.php');
		$sql = "SELECT * FROM $table WHERE id='$id'";
		$result = mysql_query($sql) or die("Invalid Query: ".mysql_error());
		while($row=mysql_fetch_assoc($result)){
			echo '<input type="hidden" name="id" value="'.$id.'">';
			echo '<input type="hidden" name="table" value="'.$table.'">';
			echo '<input type="text" name="title" value="'.$row['title'].'"><br><br>';
			echo '<textarea name="message" rows="20" cols="75">'.$row['message'].'</textarea><br><br>';
		}
	?>
	<input type="submit" name="Submit_Update" value="Update">
	</form>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
