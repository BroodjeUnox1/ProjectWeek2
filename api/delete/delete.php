<?php 

// include db
include("../database/db.php");

// setting value
$id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);

// execute sql
$sql = "DELETE FROM inschrijvingen WHERE id = $id";
if ($conn->query($sql) === TRUE) {
  echo "mooi";
} else {
  echo "Error updating record: " . $conn->error;
}	

 ?>