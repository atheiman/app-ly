<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
}
include '../resources/db_connect.php';
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
<link rel="stylesheet" type="text/css" href="../resources/style.css">
</head>
<body>
<div id='page_title'>
Browse Applicants
</div>
<div id='content'>
<div class='section_head'>Search for an applicant by name: </div>
<form method='get' name='name_form' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
<input type='text' name='applicant_name' id='applicant_name' required placeholder='Search by name'>
<input type='submit' value='Search by Name'>
</form><br>
<div class='section_head'>Search for applicants applied to job ID number: </div>
<form method='get' name='job_form' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
<input type='number' name='job_id' id='job_id' required placeholder='Job ID number' maxlength='3'>
<input type='submit' value='Search by Job ID'>
</form><br>
<?php
if (isset($_GET['applicant_name'])) {
  $applicant_name = test_input($_GET['applicant_name']);
  $sql = "select applicant_email , firstname , lastname , city , state from applicants
  where lastname like '%$applicant_name%'
  or firstname like '%$applicant_name%'
  or CONCAT(firstname, ' ', lastname) = '$applicant_name'";
  $result = mysqli_query($con , $sql);
  if ($result->num_rows == 0) {
    echo "<div class='section_head'>No applicants found in search.</div>Could not find any applicants by the name '$applicant_name'.";
  } else {
    echo "<div class='section_head'>Search results (applicant name '$applicant_name'):</div>";
    while($row = mysqli_fetch_array($result)) {
      $applicant_email = $row['applicant_email'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $city = $row['city'];
      $state = $row['state'];
      echo "$firstname $lastname | $applicant_email | $city, $state |
      <a href='applicant_info.php?applicant_email=$applicant_email'>View profile</a><br>";
    }
  }
  mysqli_free_result($result);
  echo "<script>
  document.getElementById('applicant_name').value='$applicant_name';
  document.getElementById('applicant_name').focus();
  </script>";
}
if (isset($_GET['job_id'])) {
  $job_id = test_input($_GET['job_id']);
  $sql = "select applicants.applicant_email , applicants.firstname , applicants.lastname, applicants.city , applicants.state from applicants , applied
  where applied.applicant_email = applicants.applicant_email
  and job_id = $job_id";
  $result = mysqli_query($con , $sql);
  if ($result->num_rows == 0) {
    echo "<div class='section_head'>No applicants found in search.</div>Either job id number '$job_id' is invalid or no applicants have applied to it.<br>";
  } else {
    echo "<div class='section_head'>Search results:</div>";
    while($row = mysqli_fetch_array($result)) {
      $applicant_email = $row['applicant_email'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $city = $row['city'];
      $state = $row['state'];
      echo "$firstname $lastname | $applicant_email | $city, $state |
      <a href='applicant_info.php?applicant_email=$applicant_email'>View profile</a><br>";
    }
  }
  mysqli_free_result($result);
  echo "<script>
  document.getElementById('job_id').value='$job_id';
  document.getElementById('job_id').focus();
  </script>";
}
if (!isset($_GET['applicant_name']) and !isset($_GET['job_id'])) {
  echo "<script>
  document.getElementById('applicant_name').focus();
  </script>";
}
?>
<br><hr><br>
<a href='home.php'>Home</a><br><br>&nbsp;
</div>
</body>
</html>
