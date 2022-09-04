<?php include "header.php";

if ($_SESSION['role'] != '0') {
  header("location: {$hostname}/logout.php");
}

if (isset($_POST['update'])) {

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $fac_id = mysqli_real_escape_string($conn,$_POST['faculty_id']);
  $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
  $username = mysqli_real_escape_string($conn, $_POST['user']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  if (strlen($username) < 6) {
    echo "<p class='error'>UserName must be atleast 6 characters.</p>";
  }else{
  //Username or Email check if exists already
    $sql_UC = "SELECT username,email FROM faculty WHERE username = '{$username}' and email = '{$email}'";
    $result_UC = mysqli_query($conn, $sql_UC) or die("Query Failed = ".$sql_UC);

    if (mysqli_num_rows($result_UC) > 0) {
      echo "<p class='error'>UserName already Exists.</p>";
    }else{
      $sql = "UPDATE faculty SET faculty_id = '{$fac_id}', name = '{$fullname}', username = '{$username}', email = '{$email}' WHERE id = '{$id}' ";

      if (mysqli_query($conn, $sql)) {
        echo "<p class='added'>Record Updated</p>";
      }else{
        echo "<p class='error'>Sorry can't update. Try again </p>";
      }
    }
  }
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Modify Faculty Details</h1>
      </div>
      <!-- Form Start -->
      <div class="col-md-offset-4 col-md-4">
        <?php 

        //to save get value incase of reload in page
        if (isset($_GET['id'])) {
          $_SESSION['id'] = $_GET['id'];
          $fac_id = $_SESSION['id'];
        }else{
          $fac_id = $_SESSION['id'];
        }

        $sql1 = "SELECT * FROM faculty WHERE faculty_id = '{$fac_id}'";
        $result = mysqli_query($conn, $sql1) or die("Query Failed =" .$sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            ?>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
              <div class="form-group">
                <input type="hidden" name="id"  class="form-control" value="<?php echo $row['id']; ?>" placeholder="" >
                <div class="form-group">
                  <label>Faculty ID</label>
                  <input type="text" name="faculty_id" class="form-control" placeholder="Faculty ID" value="<?php echo $row['faculty_id']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="fullname" class="form-control" placeholder="Full Name" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="form-group">
                  <label>User Name</label>
                  <input type="text" name="user" class="form-control" placeholder="Username" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                </div>
                <input type="submit" name="update" class="btn btn-primary" value="Update Faculty" required />

              </form>
              <?php 
            }
          }
          ?>
          <!-- /Form -->
        </div>
      </div>
    </div>
  </div>

  <?php include "footer.php"; ?>



