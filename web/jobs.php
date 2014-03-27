<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
}
if (isset($_GET['state']) and $_GET['state'] == "Any") {
  header('Location: jobs.php');
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
include 'resources/db_connect.php';
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
State: <select onchange='search_by_state()' id='state'><option value="Any">Any</option>
<?php
$sql = "select distinct state from jobs";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)) {
  $state=$row['state'];
  echo "<option id='$state' value=".rawurlencode($state).">$state</option>";
}
mysqli_free_result($result);
?>
</select><br>
<?php
if (isset($_GET['state'])) {
  $state = $_GET['state'];
  echo "<script>document.getElementById('$state').selected=true;</script>";
  $sql = "select * from jobs where state = '$state'";
} else {
  $sql = "select * from jobs";
}
$result = mysqli_query($con,$sql);
if ($result->num_rows == 0) {
  echo "Sorry, no jobs currently listed. Check back soon!";
} else {
  echo "<table border='1' cellpadding='3'><th>Title</th><th>City</th><th>State</th><th>Expires</th><th>Openings</th><th>Posted</th><th>More Info</th><th>Apply</th>";
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
}
mysqli_free_result($result);
?>
<hr>
<a href='home.php'>Home</a><br>
</div>
</body>
<script>
function search_by_state() {
  var state_value = document.getElementById('state').value;
  var url = "jobs.php?state="+state_value;
  window.location.assign(url);
}
</script>
</html>
