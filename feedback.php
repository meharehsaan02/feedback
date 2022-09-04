<?php include "header.php";
if ($_SESSION['role'] != '0') {
  header("location: {$hostname}/logout.php");
}
?>

<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Feedback</h1>
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
        $sql = "SELECT feedback.id, feedback.q1, feedback.q2, feedback.q3, feedback.q4, feedback.q5, feedback.q6, feedback.comment, student.firstname, student.lastname, faculty.name FROM feedback LEFT JOIN student ON feedback.student_id = student.username LEFT JOIN faculty ON feedback.faculty_id = faculty.faculty_id ORDER BY id DESC LIMIT {$offset},{$limit}";

        $result = mysqli_query($conn, $sql) or die("Query Failed = ".$sql);
        //showing data on table
        if (mysqli_num_rows($result) > 0) {
          ?>
          <table class="content-table">
            <thead>
              <th>Student Name</th>
              <th>Faculty</th>
              <th>Way of Teaching</th>
              <th>Helping Material</th>
              <th>Punctuality</th>
              <th>Rewarding</th>
              <th>Postivism</th>
              <th>Collaboration</th>
            <th>comment</th>
            <th>Delete</th>
          </thead>
          <tbody>
            <?php 
            while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                <td><?php echo $row['firstname']. " ".$row['lastname']; ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['q1'] ?></td>
                <td><?php echo $row['q2'] ?></td>
                <td><?php echo $row['q3'] ?></td>
                <td><?php echo $row['q4'] ?></td>
                <td><?php echo $row['q5'] ?></td>
                <td><?php echo $row['q6'] ?></td>
              <td><?php echo $row['comment']; ?></td>
              <td class='delete'><a style="color:red;" href='delete-feedback.php?id=<?php echo $row['id']?>'><i style="color:red;" class='fa fa-trash-o'></i><!-- Delete --></a></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
      <?php
    }else{
      echo "<h4 class='error'>No Record Found.</h4>";
    }

    //show pagination
    $sql1 = "SELECT * FROM feedback";
    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

    if (mysqli_num_rows($result1) > 0) {

      $total_records = mysqli_num_rows($result1);
      $total_page = ceil($total_records/$limit);

      echo "<ul class='pagination admin-pagination'>";
      //showing prev button in pagination
      if ($page > 1) {
        echo "<li><a href='feedback.php?page=".($page - 1)."'>Prev</a></li>";
      }
      for ($i = 1; $i <= $total_page; $i++) { 
        if($i == $page){
          $active = "active";
        }else{
          $active = "";
        }
        echo '<li><a class="'.$active.'" href="feedback.php?page='.$i.'">'.$i.'</a></li>';
      }

      //showing next button in pagination
      if ($total_page > $page) {
        echo "<li><a href='feedback.php?page=".($page + 1)."'>Next</a></li>";
      }
      echo "</ul>";
    }
    ?>
  </div>
</div>
</div>
</div>
<?php include "footer.php"; ?>
