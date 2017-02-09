<?php

// Define variables for our server, username, password and database;
$servername = "hostname";
$username = "username";
$password = "password";
$dbname = "databasename";

// Create a new connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Test our connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$sql = "show tables";
$result = mysqli_query($conn, $sql);
    

if (mysqli_num_rows($result) > 0) {
// Store our query in variable $row
while($row = mysqli_fetch_assoc($result)) {
// Display our data based on our column names
print $row["Tables_in_mydb"] . "<br />"; 
}
} else {
// If our table has no records display this instead
echo "0 results";
}

// Close the connection
mysqli_close($conn);


?>