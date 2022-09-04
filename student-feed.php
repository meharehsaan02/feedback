<?php include "header.php";
//session check
if ($_SESSION['role'] != '1') {
  header("location: {$hostname}/logout.php");
}

?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">Your Feedback</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-feedback.php?id=<?php echo $_SESSION['username'] ?>">add feedback</a>
      </div>
      <div class="col-md-12">
        <?php 
        //retrieving data of particular student
        $sql = "SELECT feedback.q1, feedback.q2, feedback.q3, feedback.q4, feedback.q5, feedback.q6, feedback.comment, faculty.name FROM feedback LEFT JOIN faculty ON feedback.faculty_id = faculty.faculty_id WHERE student_id = '{$_SESSION['username']}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed = ".$sql);
        //showing data on table
        if (mysqli_num_rows($result) > 0) {
          ?>
          <table class="content-table">
            <thead>
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
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['q1']; ?></td>
                  <td><?php echo $row['q2']; ?></td>
                  <td><?php echo $row['q3']; ?></td>
                  <td><?php echo $row['q4']; ?></td>
                  <td><?php echo $row['q5']; ?></td>
                  <td><?php echo $row['q6']; ?></td>
                  <td><?php echo $row['comment']; ?></td>
                  <td class='delete'><a href='delete-user.php'><i style="color:red;" class='fa fa-trash-o'></i></a></td>
                  
                </tr>
                <?php 
              }
            }else{
              echo "<p class='error'>No Record Found.</p>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
