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
		
	<h2>Products</h2>

	<table width="100%">
	<tr>
	<th>Item Name</th>
	<th>Description</th>
	<th>Price</th>
	<th>Actions</th>
	</tr>
	<?
	include('includes/dbc.php');
	$sql = "SELECT * FROM products order by id DESC";
	$result = mysql_query($sql) or die("Invalid query: ".mysql_error());
	if(mysql_num_rows($result)==0)
	{
	echo '<tr><td colspan="4">Sorry...No products are available at this time.</td></tr>';
	}
	while($row=mysql_fetch_assoc($result))
	{
	echo '<tr>';
	echo '<td align="left">';
	echo $row['title'];
	echo '</td>';
	echo '<td align="left">';
	echo $row['description'];
	echo '</td>';
	echo '<td align="left">';
	echo $row['price'];
	echo '</td>';
	echo '<td align="left">';
	echo '<a href="my_cart.php?id='.$row['id'].'">Add to Cart</a>';
	echo '</td>';
	echo '<tr>';
	echo '<td align="left">';
	echo '<a href="reviews.php">Read Reviews</a>';
	echo '</td>';
	echo '<tr>';
	echo '<td align="left">';
	echo '<a href="add_reviews.php">Add Reviews</a><br>';
	echo '</td>';
	echo '</tr>';
	}
	?>
	</table>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
