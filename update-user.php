<?php include "header.php";
if ($_SESSION['role'] != '0') {
  header("location: {$hostname}/logout.php");
}

if (isset($_POST['update'])) {


  $id =mysqli_real_escape_string($conn, $_POST['id']);
  $college_id =mysqli_real_escape_string($conn, $_POST['college_id']);
  $firstname =mysqli_real_escape_string($conn, $_POST['fname']);
  $lastname =mysqli_real_escape_string($conn, $_POST['lname']);
  $username =mysqli_real_escape_string($conn, $_POST['user']);
  $email =mysqli_real_escape_string($conn, $_POST['email']);
  $gender =mysqli_real_escape_string($conn, $_POST['gender']);

  if (strlen($username) < 6) {
    echo "<p class='error'>UserName must be atleast 6 characters.</p>";
  }else{
  //Username or Email check if exists already
    $sql_UC = "SELECT username,email FROM student WHERE username = '{$username}' and email = '{$email}'";
    $result_UC = mysqli_query($conn, $sql_UC) or die("Query Failed = ".$sql_UC);

    if (mysqli_num_rows($result_UC) > 0) {
      echo "<p class='error'>UserName already Exists.</p>";
    }else{
      $sql1 = "UPDATE student SET college_id = '{$college_id}', firstname = '{$firstname}', lastname = '{$lastname}', username = '{$username}', email = '{$email}', gender = '{$gender}' WHERE id = {$id} ";

      if (mysqli_query($conn, $sql1)) {
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
        <h1 class="admin-heading">Modify Student Details</h1>
      </div>
      <div class="col-md-offset-4 col-md-4">
        <!-- Form Start -->
        <?php

        //to save get value incase of reload in page
        if (isset($_GET['id'])) {
          $_SESSION['id'] = $_GET['id'];
          $college_id = $_SESSION['id'];
        }else{
          $college_id = $_SESSION['id'];
        }

        $sql = "SELECT * FROM student WHERE college_id = '{$college_id}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed.".$sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            ?>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
              <div class="form-group">
                <label>College ID</label>
                <input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $row['id'];  ?>" required>
                <input type="text" name="college_id" class="form-control" placeholder="College ID" value="<?php echo $row['college_id'];  ?>" required>
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $row['firstname'];  ?>" required>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname'];  ?>" required>
              </div>
              <div class="form-group">
                <label>User Name</label>
                <input type="text" name="user" class="form-control" placeholder="Username" value="<?php echo $row['username'];  ?>" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $row['email']; ?>" required>
              </div>
              <div class="form-group">
                <label>Gender</label>
                <div class="custom_radio" >
                  <input type="radio" name="gender" value="male" required> Male
                  <input type="radio" name="gender" value="female" required> Female 
                  <input type="radio" name="gender" value="others" required> Others 
                </div>
              </div>
              <input type="submit" name="update" class="btn btn-primary" value="Update User" required />
              <?php 
            }
          }
          ?>
        </form>
        <!-- /Form -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>



<style type="text/css">
  form{
    margin-bottom: 40px;
  }

  input[type="submit"]{
    margin-bottom: -15px;
  }
</style>