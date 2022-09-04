<?php 
include "config.php";
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: {$hostname}/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
	<link rel="stylesheet" href="bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
	<!-- HEADER -->
	<div id="header-admin">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-3">
					<h2>Feedback System</h2>
				</div>
				<div class="col-md-offset-6  col-md-1 color">
					<a class="admin-heading"><i style="color:#fff;" class="fa fa-user"></i><?php echo $_SESSION['username']; ?></a>
				</div>
				<div class="col-md-1 color">
					<a href="update-password.php?id=<?php echo $_SESSION['username']; ?>" class="admin-pass"><i style="color:#fff;" class="fa fa-key"></i></a>
				</div>
				<div class="col-md-1 color">
					<a href="logout.php" class="admin-logout">logout</a></a>
				</div>
			</div>
		</div>
	</div>
	<!-- /HEADER -->
	<!-- Menu Bar -->
	<div id="admin-menubar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="admin-menu">
						<?php 
						if ($_SESSION['role'] == '0') {
							?>
							<li>
								<a href="feedback.php">Feedback</a>
							</li>
							<li>
								<a href="faculty.php">Faculty</a>
							</li>
							<li>
								<a href="users.php">Users</a>
							</li>
							<?php 
						}
						if ($_SESSION['role'] == '1') {
							?>
							<li>
								<a href="student-feed.php">Your Feedback</a>
							</li>
							<li>
								<a href="sprofile.php">Profile</a>
							</li>
							<?php
						}
						if ($_SESSION['role'] == '2') {
							?>
							<li>
								<a href="faculty-feedback.php">Your Feedback</a>
							</li>
							<li>
								<a href="fprofile.php">Profile</a>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /Menu Bar -->


	<style type="text/css">

		form{
			margin-bottom: 40px;
		}

		input[type="submit"]{
			margin-bottom: -15px;
		}

		.container .row h2{
			color:#fff;
			font-weight: 600;
			padding-bottom: 10px;
		}

		.container .row h2:hover{
			transform: scale(1.07);
		}

	</style>