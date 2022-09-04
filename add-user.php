<?php
include "header.php";
if ($_SESSION['role'] != '0') {
	header("location: {$hostname}/logout.php");
}

if (isset($_POST['save'])) {

	//adding post record to variables
	$college_id =mysqli_real_escape_string($conn, strtolower($_POST['college_id']));
	$firstname =mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname =mysqli_real_escape_string($conn, $_POST['lname']);
	$username =mysqli_real_escape_string($conn, strtolower($_POST['user']));
	$email =mysqli_real_escape_string($conn, $_POST['email']);
	$password =mysqli_real_escape_string($conn,md5($_POST['password']));
	$gender =mysqli_real_escape_string($conn, $_POST['gender']);
	$role =mysqli_real_escape_string($conn, $_POST['role']);


	if (strlen($username) < 6) {
		echo "<p class='error'>UserName must be atleast 6 characters.</p>";
	}else{
		//Username or Email check if exists already
		$sql_UC = "SELECT college_id, username, email FROM student WHERE username = '{$username}' or email = '{$email}' or college_id = '{$college_id}'";
		$result_UC = mysqli_query($conn, $sql_UC) or die("Query Failed = ".$sql_UC);

		if (mysqli_num_rows($result_UC) > 0) {
			echo "<p class='error'>Either UserName or Email or College ID already Exists.</p>";
		}else{
		//putting into database
			$sql = "INSERT INTO student (college_id, firstname, lastname, username, email, password, gender, role)
			VALUES ('{$college_id}', '{$firstname}', '{$lastname}', '{$username}', '{$email}', '{$password}', '{$gender}', '{$role}')";

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
				<h1 class="admin-heading">Add Student Record</h1>
			</div>
			<div class="col-md-offset-3 col-md-6">
				<!-- Form Start -->
				<form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST" autocomplete="on">
					<div class="form-group">
						<label>College ID</label>
						<input type="text" name="college_id" class="form-control" placeholder="College ID" required>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="fname" class="form-control" placeholder="First Name" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="lname" class="form-control" placeholder="Last Name" required>
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
						<label>Gender</label>
						<div class="custom_radio" >
							<input type="radio" name="gender" value="male" required> Male
							<input type="radio" name="gender" value="female" required> Female 
							<input type="radio" name="gender" value="others" required> Others 
						</div>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group">
						<!-- <label>Role</label> -->
						<input type="hidden" name="role" class="form-control" value="1" required>
					</div>
					<input class="btn btn-primary" type="submit"  name="save"  value="Register" required />
				</form>
				<!-- Form End-->
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>
