<?php

$Table = $_POST['Table'];

// Define variables for our server, username, password and database;
$servername = "hostname";
$username = "username";
$password = "password";
$dbname = "databasename";

// Create a new connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if table exists, if it does drop it
$sql = "DROP TABLE IF EXISTS $Table;

-- Create table '$Table'
CREATE TABLE $Table (
id INT(2) PRIMARY KEY,
username VARCHAR(30),
password VARCHAR(30)
)";

// Test if our query ran successfully
if (mysqli_multi_query($conn, $sql)) {
echo "Table $Table created successfully";
} else {
echo "Error creating table: " . mysqli_error($conn);
}


// Close the connection
mysqli_close($conn);

?>