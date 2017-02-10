
<?php
if(isset($_POST['id'])){
	include('../includes/dbc.php');
	$table = $_POST['table'];
	$id = $_POST['id'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	$result = mysql_query("UPDATE $table SET title='$title', message='$mesage' WHERE id=$id")
	or trigger_error('Error: '.mysql_error(), E_USER_ERROR);
	if($result){
		echo ' <em>Your conent has been succesfully updated!</em><br>';
	}
}
?>
