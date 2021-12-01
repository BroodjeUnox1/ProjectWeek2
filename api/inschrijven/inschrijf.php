<?php
session_start();
function insert($username) {
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
	$stmt = $conn->prepare("INSERT INTO inschrijvingen (bsn, email, naam, datum, tel, madeby) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssss", $bsn, $email, $naam, $geboortedatum, $tel, $madeby);
	// set parameters and execute
	$bsn = filter_var($_POST['bsn'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$naam = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
	$geboortedatum = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
	$tel = filter_var($_POST['tel'], FILTER_SANITIZE_STRING);
	$madeby = filter_var($username, FILTER_SANITIZE_STRING);  // add loggedInUser
	$stmt->execute();
	$stmt->close();
}

if (isset($_POST["submit"])) {
	$_POST["submit"] = "somevalue";
	$array = $_POST;
	foreach ($array as $key) {
		if(empty($key)) {
			echo "Don't leave something empty <br>";
		}
	}
	insert($_SESSION['username']);
}
header("Location: ../../index.php");


?>