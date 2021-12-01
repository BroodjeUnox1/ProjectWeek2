<?php
// if content isset include it
if (isset($_GET['content'])) {
	include $_GET["content"] . ".php";
} else {
    include "home.php";
}

?>