<?php # Connection String

// Set the database access information
DEFINE ('DB_USER', 'Username');
DEFINE ('DB_PASSWORD', 'Password');
DEFINE ('DB_HOST', 'hostname');
DEFINE ('DB_NAME', 'databasename');

// Make the connection
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not establish a connection to the MySQL: ' . mysqli_connect_error() );

?>