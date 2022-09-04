<?php include "header.php";
if ($_SESSION['role'] != '0') {
	header("location: {$hostname}/logout.php");
}

if (isset($_POST['save'])) {
	
	$faculty_id = mysqli_real_escape_string($conn,$_POST['faculty_id']);
	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$username = mysqli_real_escape_string($conn, $_POST['user']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password =mysqli_real_escape_string($conn,md5($_POST['password']));
	$role = mysqli_real_escape_string($conn, $_POST['role']);

	if (strlen($username) < 6) {
		echo "<p class='error'>UserName must be atleast 6 characters.</p>";
	}else{
		//Username or Email check if exists already
		$sql_UC = "SELECT username,email,faculty_id FROM faculty WHERE username = '{$username}' or email = '{$email}' or faculty_id = '{$faculty_id}'";
		$result_UC = mysqli_query($conn, $sql_UC) or die("Query Failed = ".$sql_UC);

		if (mysqli_num_rows($result_UC) > 0) {
			echo "<p class='error'>Either Username or Email or faculty_id already Exists.</p>";
		}else{
			//putting into database
			$sql = "INSERT INTO faculty (faculty_id, name, username, email, password, role) 
			VALUES ('{$faculty_id}', '{$fullname}', '{$username}', '{$email}', '{$password}', '{$role}')";

			if (mysqli_query($conn, $sql)) {
				echo "<p class='added'>Record added</p>";
			}else{
				echo "<p class='error'>Sorry can't insert. Try again </p>";
			}
		}
	}
}
?>
<div id="admin-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="admin-heading">Add Faculty Record</h1>
			</div>
			<div class="col-md-offset-3 col-md-6">
				<!-- Form Start -->
				<form  action="" method ="POST" autocomplete="off">
					<div class="form-group">
						<label>Faculty ID</label>
						<input type="text" name="faculty_id" class="form-control" placeholder="Faculty ID" required>
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
					</div>
					<div class="form-group">
						<label>User Name</label>
						<input type="text" name="user" class="form-control" placeholder="Username" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group">
						<!-- <label>Role</label> -->
						<input type="hidden" name="role" class="form-control" value="2" required>
					</div>
					<input class="btn btn-primary" type="submit"  name="save"  value="Register" required />
				</form>
				<!-- Form End-->
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>
