<?php
session_start();
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('includes/dbc.php');?>
<?php include('includes/dbc_admin.php');?>
<?php include('includes/header.inc');?>
<?php include('includes/nav.inc');?>

<div id="container">


	<?php include('includes/leftside.inc');?>


<div id="right">
<?php
include("includes/dbc.php");
$sql = "SELECT * from home_page order by id desc";
$result = mysql_query($sql) or die("Invalid query: ".mysql_error());
if(mysql_num_rows($result)==0){
echo "Sorry ... no information is available at this time. Please check back soon";
}
while($row=mysql_fetch_assoc($result)) {
if(isset($user)) {
echo '<div style = "float:right;">';
echo '<a href="ajax_edit.php?id='.$row['id'].'&table=home_page">Edit</a>';
echo '</div>';
}
echo '<h2>' .$row['title'].'</h2>';
echo '<p>' .$row['message'].'</p>';
}
?>
</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
