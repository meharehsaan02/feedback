<?php include "header.php";
//session check
if ($_SESSION['role'] != '1') {
	header("location: {$hostname}/logout.php");
}

if (isset($_POST['submit'])) {


	$faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
	$student = mysqli_real_escape_string($conn, $_SESSION['username']);
	$q1 = mysqli_real_escape_string($conn, $_POST['q1']);
	$q2 = mysqli_real_escape_string($conn, $_POST['q2']);
	$q3 = mysqli_real_escape_string($conn, $_POST['q3']);
	$q4 = mysqli_real_escape_string($conn, $_POST['q4']);
	$q5 = mysqli_real_escape_string($conn, $_POST['q5']);
	$q6 = mysqli_real_escape_string($conn, $_POST['q6']);
	if (empty($_POST['comment'])) {
		$comment = "No comment";
	}else{
		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	}
	
	//putting into database
	$sql = "INSERT INTO feedback (faculty_id, student_id, q1, q2, q3, q4, q5, q6, comment)
	VALUES('{$faculty}', '{$student}','{$q1}', '{$q2}', '{$q3}', '{$q4}', '{$q5}', '{$q6}', '{$comment}')";
	if (mysqli_query($conn, $sql)) {
		echo "<p class='added'>Feedback added, Thanks for review</p>";
	}else{
		echo "<p class='error'>Sorry Can't Insert.</p>";
	}
}
?>
<div id="admin-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="admin-heading">Feedback</h1>
			</div>
			<div class="col-md-offset-3 col-md-6">
				<!-- Form Start -->
				<form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST" autocomplete="off">
					<div class="form-group">
						<label>Select Faculty</label>
						<select class="form-control" style="margin-bottom: 10px;" name="faculty">
							<option value="NA" disabled>---- Select ----</option>
							<!-- faculty show  -->
							<?php
							$sql = "SELECT * FROM faculty";
							$result = mysqli_query($conn, $sql) or die("Query Failed = ".$sql);
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									?>
									<option value="<?php echo $row['faculty_id']; ?>" name="faculty"><?php echo $row['name']; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Way of Teaching</label>
						<input type="radio" name="q1" value="Very Poor" required/> Very Poor
						<input type="radio" name="q1" value="Poor" required/> Poor
						<input type="radio" name="q1" value="Normal" required/> Normal
						<input type="radio" name="q1" value="Good" required/> Good
						<input type="radio" name="q1" value="Excellent" required/> Excellent
					</div>
					<div class="form-group">
						<label>Helping Material</label>
						<input type="radio" name="q2" value="Very Poor" required/> Very Poor
						<input type="radio" name="q2" value="Poor" required/> Poor
						<input type="radio" name="q2" value="Normal" required/> Normal
						<input type="radio" name="q2" value="Good" required/> Good
						<input type="radio" name="q2" value="Excellent" required/> Excellent
					</div>
					<div class="form-group">
						<label>Punctuality</label>
						<input type="radio" name="q3" value="Very Poor" required/> Very Poor
						<input type="radio" name="q3" value="Poor" required/> Poor
						<input type="radio" name="q3" value="Normal" required/> Normal
						<input type="radio" name="q3" value="Good" required/> Good
						<input type="radio" name="q3" value="Excellent" required/> Excellent
					</div>
					<div class="form-group">
						<label>Rewarding</label>
						<input type="radio" name="q4" value="Very Poor" required/> Very Poor
						<input type="radio" name="q4" value="Poor" required/> Poor
						<input type="radio" name="q4" value="Normal" required/> Normal
						<input type="radio" name="q4" value="Good" required/> Good
						<input type="radio" name="q4" value="Excellent" required/> Excellent
					</div>
					<div class="form-group">
						<label>Postivism</label>
						<input type="radio" name="q5" value="Very Poor" required/> Very Poor
						<input type="radio" name="q5" value="Poor" required/> Poor
						<input type="radio" name="q5" value="Normal" required/> Normal
						<input type="radio" name="q5" value="Good" required/> Good
						<input type="radio" name="q5" value="Excellent" required/> Excellent
					</div>
					<div class="form-group">
						<label>Collaboration</label>
						<input type="radio" name="q6" value="Very Poor" required/> Very Poor
						<input type="radio" name="q6" value="Poor" required/> Poor
						<input type="radio" name="q6" value="Normal" required/> Normal
						<input type="radio" name="q6" value="Good" required/> Good
						<input type="radio" name="q6" value="Excellent" required/> Excellent
					</div>
					<div class="form-group">
						<input type="text" name="comment" class="form-control" placeholder="Enter your comment or leave blank" />
					</div>
					<input class="btn btn-primary" type="submit"  name="submit"  value="Submit" required />
				</form>
				<!-- Form End-->
			</div>
		</div>
	</div>
</div>



<?php include "footer.php" ?>


<!-- css for form only this page -->
<style type="text/css">
	.form-group{
		width: 100%;
		display: flex;
		border-bottom: 3px solid #f1f1f1;
	}

	.form-group label{
		display: flex;
		width: 25%;
		flex-wrap: wrap;
		margin-right: 20px;
		/*border: 2px solid red;*/
	}

	.form-group input[type="radio"]{
		/*width: 20%;*/
		margin-right: 2px;
		margin-left: 10px;
	}
</style>