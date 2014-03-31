<?php
//delete_job.php?job_id=$job_id
session_start();
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
}
if (isset($_GET['job_id'])) {
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  include '../resources/db_connect.php';
  $job_id = test_input($_GET['job_id']);
  // delete from applied where job_id = 7 ; delete from jobs where job_id = 7 ;
  $sql = "delete from applied where job_id = $job_id";
  $result = mysqli_query($con,$sql);
  $sql = "delete from jobs where job_id = $job_id";
  $result = mysqli_query($con,$sql);
}
?>
<!doctype html>
<html>
<script>
window.location.assign('jobs.php');
</script>
</html>
