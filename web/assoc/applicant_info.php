<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
}
include '../resources/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $comment = test_input($_POST['comment']);
  $applicant_email = test_input($_POST['applicant_email']);
  $commenter = $_SESSION['user_email'];
  $sql = "insert into comments ( user_email , applicant_email , comment )
  values
  ( '$commenter' , '$applicant_email' , '$comment' )";
  echo "$sql<br>";
  $result = mysqli_query($con,$sql);
  echo "<script>
  var target_url= window.location.pathname + '?applicant_email=$applicant_email';
  window.location.assign(target_url);
  </script>";
}
if (isset($_GET['applicant_email'])) {
  $applicant_email = $_GET['applicant_email'];
} else {
  die("Specify applicant email.");
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$sql = "select a.firstname , a.lastname , a.city , a.state , a.phone from applicants as a
where a.applicant_email = '$applicant_email'";
$result = mysqli_query($con,$sql);
if ($result->num_rows == 0) {
  die("Applicant with email '$applicant_email' not found!");
}
while($row = mysqli_fetch_array($result)) {
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $city = $row['city'];
  $state = $row['state'];
  $phone = $row['phone'];
}
mysqli_free_result($result);
?>
<!doctype html>
<html>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="../resources/style.css">
</head>
<body>
<div id='page_title'>
<?php echo "$firstname $lastname";?>
</div>
<div id='content'>
<div class='section_head'>Basic Information</div>
<?php
echo "Email: $applicant_email<br>City: $city<br>State: $state<br>Phone: $phone<br>";
echo "<hr><br>";
echo "<div class='section_head'>Work History</div>";
$sql = "select w.title , w.employer , w.start_date , w.end_date , w.reason_for_leaving from work_history as w 
where applicant_email = '$applicant_email'";
$result = mysqli_query($con,$sql);
if ($result->num_rows == 0) {
  echo "No work history found<br>";
} else {
  while($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $employer = $row['employer'];
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
    $reason_for_leaving = $row['reason_for_leaving'];
    echo "Title: $title<br>Employer: $employer<br>Start Date: $start_date<br>";
    if ($end_date != '') {echo "End Date: $end_date<br>";}
    if ($reason_for_leaving != '') {echo "Reason for Leaving: $reason_for_leaving<br>";}
  }
}
mysqli_free_result($result);
echo "<hr><br>";
echo "<div class='section_head'>Education</div>";
$sql = "select e.school_name , e.school_state , e.edu_status , e.grad_date , e.major from education as e
where applicant_email = '$applicant_email'";
$result = mysqli_query($con,$sql);
if ($result->num_rows == 0) {
  echo "No education found<br>";
} else {
  while($row = mysqli_fetch_array($result)) {
    $school_name = $row['school_name'];
    $school_state = $row['school_state'];
    $edu_status = $row['edu_status'];
    $grad_date = $row['grad_date'];
    $major = $row['major'];
    echo "School name: $school_name<br>School state: $school_state<br>Education status: $edu_status<br>Graduation date: $grad_date<br>Major: $major<br>";
  }
}
mysqli_free_result($result);
echo "<hr><br>";
echo "<div class='section_head'>Comments</div>";
$sql = "select c.comment , u.user_email , u.firstname , u.lastname , u.title from comments as c , users as u
where c.applicant_email = '$applicant_email'
and c.user_email = u.user_email";
$result = mysqli_query($con,$sql);
if ($result->num_rows == 0) {
  echo "No comments found<br>";
} else {
  while($row = mysqli_fetch_array($result)) {
    $comment = $row['comment'];
    $user_email = $row['user_email'];
    $user_first = $row['firstname'];
    $user_last = $row['lastname'];
    $user_title = $row['title'];
    echo "'$comment'<br>~ $user_first $user_last | $user_title | $user_email<br>";
  }
}
mysqli_free_result($result);
?>
<?php
$form_action = htmlspecialchars($_SERVER['PHP_SELF']);
?>
<br>
<form method='post' name='comment_form' action='<?php echo $form_action;?>'>
<input type='text' id='input_comment' name='comment' placeholder='Add a comment' size='100' required>
<input type='text' id='input_email' name='applicant_email' value='<?php echo "$applicant_email";?>' hidden>
<input type='submit' value='Post'>
</form>
<br><hr><br>
<a href='home.php'>Home</a><br>
</div>
</body>
</html>

