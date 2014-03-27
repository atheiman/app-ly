<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
}
if (!isset($_GET['job_id'])) {
  header('Location: jobs.php');
}
include 'resources/db_connect.php';
$job_id = $_GET['job_id'];
$applicant_email = $_SESSION['email'];
$sql = "delete from applied where job_id = $job_id and applicant_email = '$applicant_email'";
//$sql = "insert into applied (job_id , applicant_email) values ($job_id , '$applicant_email')";
//echo $sql;
$result = mysqli_query($con,$sql);
echo "<script>window.location.assign('jobs.php')</script>";
echo "<br><a href='jobs.php'>Continue browsing jobs</a>";
?>
