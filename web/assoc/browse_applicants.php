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
<input type='text' name='applicant_name' id='applicant_name' required autofocus >
<input type='submit'>
</form>
<?php
if (isset($_GET['applicant_name'])) {
  $applicant_name = test_input($_GET['applicant_name']);
  $sql = "select applicant_email , firstname , lastname , city , state from applicants
  where lastname = '$applicant_name'
  or firstname = '$applicant_name'
  or CONCAT(firstname, ' ', lastname) = '$applicant_name'";
  $result = mysqli_query($con , $sql);
  if ($result->num_rows == 0) {
    echo "<div class='section_head'>No applicants found in search.</div>";
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
}
?>
<br><hr><br>
<a href='home.php'>Home</a>
</div>
</body>
</html>
