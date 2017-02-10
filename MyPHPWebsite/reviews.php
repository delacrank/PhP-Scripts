<!DOCTYPE html>
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('includes/header.inc'); ?>
<?php include('includes/nav.inc'); ?>
<div id="container">
	<?php include('includes/leftside.inc'); ?>
	<div id="right">
		<table width="100%" cellpadding="5">
		<tr>
			<th>Product Name</th>
			<th>Name</th>
			<th>Comments</th>
		</tr>
		<?php
			include('includes/dbc.php');
			$sql = "SELECT * FROM reviews2 order by id desc";
			$result = mysql_query($sql) or die("Invald Query: " 
				.mysql_error());
			if(mysql_num_rows($result)==0) {
			echo "<tr><td colspan='3'>Sorry - No Data!</td></tr>";
			}
			while($row=mysql_fetch_assoc($result)) {
				echo '<tr><td>'.$row['Product'].'</td>';
				echo 	 '<td>'.$row['Name2'].'</td>';
				echo '<td>'.$row['Comment2'].'</td></tr>';
			}
		?>
		</table>
		<a href="Products.php">Back To Products</a><br>
	</div>
</div>
<?php include('includes/footer.inc'); ?>
</body>
</html>
