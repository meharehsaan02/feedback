<?php include "header.php";

if ($_SESSION['role'] != '2') {
  header("location: {$hostname}/logout.php");
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">Your Feedback</h1>
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
        $sql = "SELECT feedback.q1, feedback.q2, feedback.q3, feedback.q4, feedback.q5, feedback.q6, feedback.comment, student.college_id, student.firstname, student.lastname, faculty.username FROM feedback LEFT JOIN student ON feedback.student_id = student.username LEFT JOIN faculty ON feedback.faculty_id = faculty.faculty_id WHERE faculty.username = '{$_SESSION['username']}' ";
        $result = mysqli_query($conn, $sql) or die("Query Failed = ".$sql);
        if (mysqli_num_rows($result) > 0) {
          ?>
          <table class="content-table">
            <thead>
              <th>Student Name</th>
              <th>Way of Teaching</th>
              <th>Helping Material</th>
              <th>Punctuality</th>
              <th>Rewarding</th>
              <th>Postivism</th>
              <th>Collaboration</th>
              <th>comment</th>
            </thead>
            <tbody>
              <?php 
              while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  <td><?php echo $row['college_id']."-".$row['firstname']. " ".$row['lastname']; ?></td>
                  <td><?php echo $row['q1'] ?></td>
                  <td><?php echo $row['q2'] ?></td>
                  <td><?php echo $row['q3'] ?></td>
                  <td><?php echo $row['q4'] ?></td>
                  <td><?php echo $row['q5'] ?></td>
                  <td><?php echo $row['q6'] ?></td>
                  <td><?php echo $row['comment'] ?></td>
                  <!-- <td class='delete'><a href=''><i class='fa fa-trash-o'></i></a></td> -->
                </tr>
                <?php 
              }
            }else{
              echo "<p class='error'>No Record Found.</p>";
            }
            ?>
          </tbody>
        </table>
        <?php 

    //show pagination
        if (mysqli_num_rows($result) > 0) {

          $total_records = mysqli_num_rows($result);
          $total_page = ceil($total_records/$limit);

          echo "<ul class='pagination admin-pagination'>";
      //showing prev button in pagination
          if ($page > 1) {
            echo "<li><a href='faculty-feedback.php?page=".($page - 1)."'>Prev</a></li>";
          }
          for ($i = 1; $i < $total_page; $i++) { 
            if($i == $page){
              $active = "active";
            }else{
              $active = "";
            }
            echo '<li><a class="'.$active.'" href="faculty-feedback.php?page='.$i.'">'.$i.'</a></li>';
          }

      //showing next button in pagination
          if ($total_page > $page) {
            echo "<li><a href='faculty-feedback.php?page=".($page + 1)."'>Next</a></li>";
          }
          echo "</ul>";
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>