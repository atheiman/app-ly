<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
}
if (isset($_GET['state']) and $_GET['state'] == "Any") {
  header('Location: jobs.php');
}
include '../resources/db_connect.php';
$post_date=date("Y-m-d");  // $post_date is str
//echo "post date: $post_date <br>";
$expir_date = date_create($post_date);  // $expir_date is obj
$expir_date = date_add($expir_date,date_interval_create_from_date_string("90 days"));  // $expir_date is obj
$expir_date = date_format($expir_date , "Y-m-d");  // $expir_date is str
//echo "expiration date: $expir_date <br>";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = test_input($_POST['title']);
  $tags = test_input($_POST['tags']);
  $description = test_input($_POST['description']);
  $city = test_input($_POST['city']);
  $state = test_input($_POST['state']);
  $expiration = test_input($_POST['expiration']);
  $openings = test_input($_POST['openings']);
  $posted = $post_date;
  $sql = "insert into jobs ( title , tags , description , city , state , expiration , openings , posted )
  values
  ( '$title' , '$tags' , '$description' , '$city' , '$state' , '$expiration' , $openings , '$posted' )";
  $result = mysqli_query($con,$sql);
}
?>
<!doctype html>
<html>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="../resources/style.css">
</head>
<body>
<div id='page_title'>
Jobs
</div>
<div id='content'>
<div class='section_head'>Current openings:</div>
Filter by state: <select onchange='search_by_state()' id='state'><option value="Any">Any</option>
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
  echo "<table border='1' cellpadding='3'><th>Job ID</th><th>Title</th><th>City</th><th>State</th><th>Expires</th><th>Openings</th><th>Posted</th>";
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
    $delete_url = "delete_job.php?job_id=$job_id";
    $applicants_url = "browse_applicants.php?job_id=$job_id";
    echo "<tr>";
    echo "<td>$job_id</td>";
    echo "<td>$title</td>";
    echo "<td>$city</td>";
    echo "<td>$state</td>";
    echo "<td>$expiration</td>";
    echo "<td>$openings</td>";
    echo "<td>$posted</td>";
    echo "<td><button onclick='alert(".'"'.$description.'"'.")'>More Info</button></td>";
    echo "<td><button onclick='window.location.assign(".'"'."$delete_url".'"'.")'>Delete job</button></td>";
    echo "<td><button onclick='window.location.assign(".'"'."$applicants_url".'"'.")'>View applicants</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}
mysqli_free_result($result);
?>
<br><hr>
<div class='section_head'>Post a new job</div>
<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' name='new_job_form'>
Title: <input type='text' name='title' id='input_title'><br>
Tags: <input type='text' name='tags' id='input_tags'><br>
Description: <input type='text' name='description' id='description'><br>
City: <input type='text' name='city' id='input_city'><br>
State: <input type='text' name='state' id='input_state' maxlength='2' size='2' onchange="this.value=this.value.toUpperCase()"><br>
Expiration: <input type='date' name='expiration' id='input_expiration' value='<?php echo $expir_date; ?>'><br>
Openings: <input type='number' name='openings' id='openings'><br>
<input type='submit' value='Post'>
</form>
<br><hr><br>
<a href='home.php'>Home</a><br>
</div>
<script>
function search_by_state() {
  var state_value = document.getElementById('state').value;
  var url = "jobs.php?state="+state_value;
  window.location.assign(url);
}
</script>
</body>
</html>
