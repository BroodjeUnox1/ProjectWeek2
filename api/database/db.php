<?php 
// DB files
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'projectweek2';
// Connecting to db
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if ( mysqli_connect_errno() ) {
	// Error handling
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
