<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
}
include 'resources/db_connect.php';
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
Search Jobs
</div>
<div id='content'>
State: <select onchange='search_by_state()' id='state'>
<?php
$sql = "select distinct state from jobs";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)) {
  $state=$row['state'];
  echo "<option value=".rawurlencode($state).">$state</option>";
}
mysqli_free_result($result);
?>
</select><br>
City: <select onchange='search_by_city()' id='city'>
<?php
$sql = "select distinct city from jobs";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)) {
  $city=$row['city'];
  echo "<option value=".rawurlencode($city).">$city</option>";
}
mysqli_free_result($result);
?>
</select></br>

</div>
</body>
<script>
function search_by_state() {
  var state_value = document.getElementById('state').value;
  var url = "jobs.php?state="+state_value;
  window.location.assign(url);
}
function search_by_city() {
  var city_value = document.getElementById('city').value;
  var url = "jobs.php?city="+city_value;
  window.location.assign(url);
}
</script>
</html>
