<?php

echo '<h1> Registered Users </h1>';

require_once('connection_string.php');

$query = "SELECT * FROM users ORDER BY registration_date ASC";

$result = @mysqli_query($dbc, $query);

$num = mysqli_num_rows($result);

if($num > 0 ) {
echo "<p>There are currently $num registered users<p>";

echo '<table>
<tr>
<td> Edit </td>
<td> Delete </td>
<td> UserName </td>
<td> Email </td>
<td> Registration Date </td>
</tr>';

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo '<tr>
<td> <a href="edit_user.php?id =' . $row['user_id'] . '"> Edit </a></td>
<td> <a href="delete_user.php?id =' . $row['user_id'] . '"> Delete </a> </td>
<td> ' . $row['UserName'] . ' </td>
<td> ' . $row['email'] . ' </td>
<td> ' . $row['registration_date'] . ' </td>
</tr>';
}

echo '</table>';
mysqli_free_result ($result);

} else {
echo '<p> There are currently no registered users.</p>';
}

mysqli_close($dbc);

?>