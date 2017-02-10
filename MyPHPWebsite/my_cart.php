<?php
session_start();
$cart = $_COOKIE['MyGameProducts'];
if (isset($_POST['clear']))
{
$expire = time() -60*60*27*7*365;
setcookie("MyGameProducts", $cart, $expire);
}
if ($cart && $_GET['id'])
{
$cart .= ','.$_GET['id'];
$expire = time() +60*60*27*7*365;
setcookie("MyGameProducts", $cart, $expire);
}
if (!$cart && $_GET['id'])
{
$cart = $_GET['id'];
$expire = time() +60*60*27*7*365;
setcookie("MyGameProducts", $cart, $expire);
}
if ($cart && $_GET['remove_id'])
{
$remove_item = $_GET['remove_id'];
$new_cart = str_replace(",$removed_item", "", $cart);
$expire = time() +60*60*27*7*365;
setcookie("MyGameProducts", $new_Cart, $expire);
}
if ($cart && $_GET['remove_id_1'])
{
$remove_item = $_GET['remove_id_1'];
$new_cart = str_replace("$removed_item,", "", $cart);
$expire = time() -60*60*27*7*365;
setcookie("MyGameProducts", $new_cart, $expire);
}
$_COOKIE['MyGameProducts'] = $cart;
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

	<h2> My Cart </h2>

	<table width="100%">
	<tr>
	<th>Item Name</th>
	<th>Desciption</th>
	<th>Price</th>
	<th>Actions</th>
	</tr>
	<?php
	$cart = $_COOKIE['MyGameProducts'];
	if ($cart)
	{
		$i = 1; //Set the counter to 1
		include('includes/dbc.php');
		$items = explode(',', $cart); //Seperate each ID by comma
		foreach($items AS $item) //Create the $item variable which will act as an individual id
		{
			$sql = "SELECT * FROM products where id = '$item'";
			$result = mysql_query($sql) or die ("Invalid query: ".mysql_error());
			while($row=mysql_fetch_assoc($result))
			{
			echo '<tr>';
			echo '<td align="left">';
			echo $row['title'];
			echo '</td>';
			echo '<td align="left">';
			echo $row['desciption'];
			echo '</td>';
			echo '<td align="left">';
			echo $row['price'];
			echo '</td>';
			echo '<td align="left">';
			if($i==1)
			{
			 echo '<a href="my_cart.php?remove_id_1='.$row['id'].'">Remove From Cart</a>';
			}
			 else
			{
			 echo '<a href="my_cart.php?remove_id='.$row['id'].'">Remove From Cart</a>';
			}
			echo '</td>';
			echo '</tr>';
			}
			$i++; //Increments the counter by 1
		}
	}
	?>
	</table>
	<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	<input type="submit" name="clear" value="Empty Shopping Cart">
	</form>
	</div>

</div>

<?php include('includes/footer.inc');?>

</body>
</html>
