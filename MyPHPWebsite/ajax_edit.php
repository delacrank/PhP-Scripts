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
<script src= "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#sendData').click(function() {
		//alert("sendData clicked!");
		var theId = $('#id').val();
		var newTitle = $('#title').val();
		var newContent = $('#message').val();
		$.post('AJAX/ajax_update.php',
		{
			table	: "home_page",
			id 		: theId,
			title 	: newTitle,
			message : newContent

		},
		function(response, textStatus, jqXHR) {
			if(response) {
				$('#updateResults').html("The response: "+response+ " <strong>"+textStatus+"!</strong>");
				$('#updateResults').append("<br><a href='w2_lab.php'>Return to Home Page</a>");
			}
			else{
				alert("response false");
				$('#updateResults').html("Sorry! It didn't work!");
			}
		});
	});
});
</script>
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
			include('includes/dbc.php');
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
	<div id="updateResults">

	<br/>
	<?php
		$id = $_GET['id'];
		$table = $_GET['table'];
		include('includes/dbc_admin.php');
		$sql = "SELECT * FROM $table WHERE id='$id'";
		$result = mysql_query($sql) or die("Invalid Query: ".mysql_error());
		while($row=mysql_fetch_assoc($result)){
			echo '<input type="hidden" name="id" id="id" value="'.$id.'">';
			echo '<input type="hidden" name="table" id="table" value="'.$table.'">';
			echo '<input type="text" name="title" id="title" value="'.$row['title'].'"><br><br>';
			echo '<textarea name="message" id="message" rows="20" cols="75">'.$row['message'].'</textarea><br><br>';
		}
	?>
	<input type="button" value="Update" id="sendData">
</div>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
