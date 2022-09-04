<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="login.css">
	<SCRIPT type="text/javascript">
		window.history.forward();
		function noBack() { window.history.forward(); }
	</SCRIPT>

</head>

<?php
if (isset($_POST['login'])) {
	include "config.php";
	if(empty($_POST['username']) || empty($_POST['password'])){
		echo '<div class="alert">All Fields must be entered.</div>';
	}else{
		$username =mysqli_real_escape_string($conn,$_POST['username']);
		$password =mysqli_real_escape_string($conn, md5($_POST['password']));

		//searching admin, faculty and student record in database

		$sql = "SELECT username, password, role FROM admin WHERE username = '{$username}' AND password = '{$password}'";
		$sql1 = "SELECT username, password, role FROM faculty WHERE username = '{$username}' AND password = '{$password}'";
		$sql2 = "SELECT username, password, role FROM student WHERE username = '{$username}' AND password = '{$password}'";

		//checking if query gets the record		
		if (mysqli_query($conn, $sql) || mysqli_query($conn, $sql1) ||mysqli_query($conn, $sql2)) {

			$result = mysqli_query($conn, $sql);
			$result1 = mysqli_query($conn, $sql1);
			$result2 = mysqli_query($conn, $sql2);

        	//admin login and session start
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					session_start();
					$_SESSION["username"] = $row['username'];
					$_SESSION["role"] = $row['role'];
					//redirecting
					header("location: {$hostname}/feedback.php");
				}
			}
		//faculty login and session start
			else if(mysqli_num_rows($result1) > 0){
				while($row1 = mysqli_fetch_assoc($result1)){
					session_start();
					$_SESSION["username"] = $row1['username'];
					$_SESSION["role"] = $row1['role'];
				//redirecting

					header("location: {$hostname}/faculty-feedback.php");
				}
			}
		//student login and session start
			else if(mysqli_num_rows($result2) > 0){
				while($row2 = mysqli_fetch_assoc($result2)){
					session_start();
					$_SESSION["username"] = $row2['username'];
					$_SESSION["role"] = $row2['role'];
				//redirecting
					header("location: {$hostname}/student-feed.php");
				}
			}else{
				echo "<p class='alert'>Incorrect username & password</p>";
			}
		}
	}
}
?>
<body>
	<div class="limiter bg-gra-03">
		<div class="container-login100" >
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41 pad">
					Account Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" required/>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
					</div>
					<div class="container-login100-form-btn m-t-32 pad">
						<input type="submit" name="login" class="login100-form-btn" value="login" />
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>