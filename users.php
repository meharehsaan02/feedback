<?php 
include "header.php";
if ($_SESSION['role'] != '0') {
  header("location: {$hostname}/logout.php");
}
?>
<div id="admin-content" onload="noBack();">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Student Records</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-user.php">add Student</a>
      </div>
      <div class="col-md-12">
        <?php

        //pagination
        $limit = 10;
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
        }else{
          $page = 1;
        }
        $offset = ($page - 1) * $limit;

        //retreiving data from database
        $sql = "SELECT * FROM student ORDER BY id DESC LIMIT {$offset},{$limit}";
        $result = mysqli_query($conn, $sql) or die("Query Failed = ".$sql);
        if (mysqli_num_rows($result) > 0) {
          ?>
          <table class="content-table">
            <thead>
              <th>COLLEGE ID</th>
              <th>FULL NAME</th>
              <th>USERNAME</th>
              <th>EMAIL</th>
              <th>GENDER</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </thead>
            <tbody>
              <?php 
              while ($row = mysqli_fetch_assoc($result)) {
               ?>
               <tr>
                <td><?php echo $row['college_id']; ?></td>
                <td><?php echo $row['firstname']. " ". $row['lastname']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td class='edit'><a href='update-user.php?id=<?php echo $row["college_id"]; ?>'><i style="color:blue;" class='fa fa-edit'></i><!-- Edit --></a></td>
                <td class='delete'><a style="color:red;" href='delete-user.php?id=<?php echo $row["username"]; ?>'><i style="color:red;" class='fa fa-trash-o'></i><!-- Delete --></a></td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
        <?php
      }else{
        echo "<p class='error'>No Record Found.</p>";
      }

    //show pagination
      $sql1 = "SELECT * FROM student";
      $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

      if (mysqli_num_rows($result1) > 0) {

        $total_records = mysqli_num_rows($result1);
        $total_page = ceil($total_records/$limit);

        echo "<ul class='pagination admin-pagination'>";
      //showing prev button in pagination
        if ($page > 1) {
          echo "<li><a href='users.php?page=".($page - 1)."'>Prev</a></li>";
        }
        for ($i = 1; $i <= $total_page; $i++) { 
          if($i == $page){
            $active = "active";
          }else{
            $active = "";
          }
          echo '<li><a class="'.$active.'" href="users.php?page='.$i.'">'.$i.'</a></li>';
        }

      //showing next button in pagination
        if ($total_page > $page) {
          echo "<li><a href='users.php?page=".($page + 1)."'>Next</a></li>";
        }
        echo "</ul>";
      }
      ?>
    </div>
  </div>
</div>
</div>
<?php include "footer.php"; ?>
