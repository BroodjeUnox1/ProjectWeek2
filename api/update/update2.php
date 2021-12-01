<?php 
include("../database/db.php");

// check if nothing is empty
$array = $_POST;
foreach ($array as $key) {
	if(empty($key)) {
		exit;
	}
}

// set values
$bsn = filter_var($_POST['bsn'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$datum = filter_var($_POST['datum'], FILTER_SANITIZE_STRING);
$tel = filter_var($_POST['tel'], FILTER_SANITIZE_STRING);
$id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);


$sql = "UPDATE inschrijvingen SET bsn = '$bsn' , email = '$email', datum = '$datum', tel = '$tel' WHERE id = $id";

// error handling
if ($conn->query($sql) === TRUE) {
  echo "mooi";
} else {
  echo "Error updating record: " . $conn->error;
}	


?>

