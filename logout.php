
<?php
include "config.php";
if (!isset($_SESSION['username'])) {
    header("Location: {$hostname}/");
}

session_start();

session_unset();

session_destroy();

header("Location: {$hostname}/");

?>
