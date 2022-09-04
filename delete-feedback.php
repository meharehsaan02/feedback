<?php
include "config.php";
if (!isset($_SESSION['username'])) {
    header("Location: {$hostname}/");
}
$feed_id = $_GET['id'];

//deleting particular feedback
$sql = "DELETE FROM feedback WHERE id = '{$feed_id}'";

if(mysqli_query($conn, $sql)){
	header("location: {$hostname}/feedback.php");
}else{
  echo "<p class='error'>Can\'t Delete the User Record.</p>";
}

mysqli_close($conn);

?>