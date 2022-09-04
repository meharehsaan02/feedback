<?php include "header.php";

if (isset($_POST['update'])) {
	
	//fields empty check
	$username = $_GET['id']; 
	$oldpass = mysqli_real_escape_string($conn, md5($_POST['oldpass']));
	$newpass = mysqli_real_escape_string($conn, md5($_POST['newpass']));
	$confirmpass = mysqli_real_escape_string($conn, md5($_POST['confirmpass']));

	if (strlen($_POST['newpass']) < 6) {
		echo "<p class ='error'>Password must be atleast 6 characters.</p>";
	}else{
		if ($oldpass == $newpass) {
			echo "<p class ='error'>Old password can't be used again. Try different one.</p>";
		}else{
			if ($newpass == $confirmpass) {

	//retrieving oldpassword record
				$sql = "SELECT username, password FROM admin WHERE username = '{$username}' AND password = '{$oldpass}'";
				$sql1 = "SELECT username, password FROM faculty WHERE username = '{$username}' AND password = '{$oldpass}'";
				$sql2 = "SELECT username, password FROM student WHERE username = '{$username}' AND password = '{$oldpass}'";

				$result = mysqli_query($conn, $sql);
				$result1 = mysqli_query($conn, $sql1);
				$result2 = mysqli_query($conn, $sql2);

		//admin pass updation
				if (mysqli_num_rows($result) > 0) {
					$sql1 = "UPDATE admin SET password = '{$newpass}' WHERE username = '{$username}'";
					if(mysqli_query($conn, $sql1)){
						echo "<p class='added'>Password Updated</p>";
					}else{
						echo "<p class='error'>Something went wrong.Can\'t update password</p>";
					}
				}
		//faculty pass updation
				else if (mysqli_num_rows($result1) > 0) {
					$sql1 = "UPDATE faculty SET password = '{$newpass}' WHERE username = '{$username}'";
					if(mysqli_query($conn, $sql1)){
						echo "<p class='added'>Password Updated</p>";
					}else{
						echo "<p class='error'>Something went wrong.Can\'t update password</p>";
					}
				}
		//student pass updation
				else if (mysqli_num_rows($result2) > 0) {
					$sql1 = "UPDATE student SET password = '{$newpass}' WHERE username = '{$username}'";
					if(mysqli_query($conn, $sql1)){
						echo "<p class='added'>Password Updated</p>";
					}else{
						echo "<p class='error'>Something went wrong.Can\'t update password</p>";
					}
				}else{
					echo "<p class='error'>Incorrect oldpassword.</p>";
				}
			}else{
				echo "<p class ='error'>New password not matches with confirm  password.</p>";
			}
		}
	}
}
?>
<div id="admin-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="admin-heading">Change Password</h1>
			</div>
			<div class="col-md-offset-4 col-md-4">
				<!-- Form Start -->
				<form  action="" method ="POST" autocomplete="off">
					<div class="form-group">
						<label>Old Password</label>
						<input type="password" name="oldpass" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group">
						<h3 style="border-bottom: 2px solid black;"></h3>
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" name="newpass" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="confirmpass" class="form-control" placeholder="Password" required>
					</div>
					<input type="submit"  name="update" class="btn btn-primary" value="Update Password" required />
				</form>
				<!-- Form End-->
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>

