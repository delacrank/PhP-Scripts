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
			<th>Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Comments</th>
		</tr>
		<?php
			include('includes/dbc.php');
			$sql = "SELECT * FROM mailing_list order by id desc";
			$result = mysql_query($sql) or die("Invald Query: " 
				.mysql_error());
			if(mysql_num_rows($result)==0) {
			echo "<tr><td colspan='4'>Sorry - No Data!</td></tr>";
			}
			while($row=mysql_fetch_assoc($result)) {
				echo '<tr><td>'.$row['name'].'</td>';
				echo 	 '<td>'.$row['phone'].'</td>';
				echo 	 '<td>'.$row['email'].'</td>';
				echo '<td>'.$row['comments'].'</td></tr>';
			}
		?>
		</table>
	</div>
</div>
<?php include('includes/footer.inc'); ?>
</body>
</html>