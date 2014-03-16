<?php
// Create connection
$con=mysqli_connect("localhost","app_ly","app_ly_pass","app_ly");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

