<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!doctype html>
<html>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body>
<div id='page_title'>
Jobs
</div>
<div id='content'>
<?php
include 'resources/db_connect.php';
$sql = "select * from jobs";
$result = mysqli_query($con,$sql);
if ($result->num_rows == 0) {
  echo "Sorry, no jobs currently listed. Check back soon!";
} else {
  echo "<table border='1' cellpadding='3'><th>Title</th><th>Tags</th><th>City</th><th>State</th><th>Expiration Date</th><th>Openings</th><th>Date Posted</th><th>More Info</th><th>Apply</th>";
  while($row = mysqli_fetch_array($result)) {
    $job_id = $row['job_id'];
    $title = $row['title'];
    $tags = $row['tags'];
    $description = $row['description'];
    $city = $row['city'];
    $state = $row['state'];
    $expiration = $row['expiration'];
    $openings = $row['openings'];
    $posted = $row['posted'];
    echo "<tr>";
    echo "<td>$title</td>";
    echo "<td>$tags</td>";
    echo "<td>$city</td>";
    echo "<td>$state</td>";
    echo "<td>$expiration</td>";
    echo "<td>$openings</td>";
    echo "<td>$posted</td>";
    echo "<td><button onclick='alert(".'"'.$description.'"'.")'>More Info</button></td>";
    echo "<td><button onclick='window.location.assign(".'"apply_to.php?job_id='.$job_id.'"'.")'>Apply</button></td>";
    echo "</tr>";
  }
  echo "</table>";
  mysqli_free_result($result);
}
?>
<hr>
<a href='home.php'>Home</a><br>
</div>
</body>
<script>

</script>
</html>
