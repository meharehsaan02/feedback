<?php
include "config.php";
//session check
if (!isset($_SESSION['username'])) {
    header("Location: {$hostname}/");
}

$faculty_id = $_GET['id'];

//deleting both faculty and their feedback given to them
$sql = "DELETE FROM faculty WHERE faculty_id = '{$faculty_id}'";
$sql1 = "DELETE FROM feedback WHERE faculty_id = '{$faculty_id}'";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
	header("location: {$hostname}/faculty.php");
}else{
  echo "<p class='error'>Can\'t Delete the User Record.</p>";
}

mysqli_close($conn);

?>