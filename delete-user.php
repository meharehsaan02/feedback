<?php
include "config.php";
if (!isset($_SESSION['username'])) {
	header("Location: {$hostname}/");
}

$username = $_GET['id'];

//deleting both student record and all his feedbacks
$sql = "DELETE FROM student WHERE username = '{$username}'";
$sql1 = "DELETE FROM feedback WHERE student_id = '{$username}'";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
	header("location: {$hostname}/users.php");
}else{
	echo "<p class='error'>Can\'t Delete the User Record.</p>";
}

mysqli_close($conn);

?>

