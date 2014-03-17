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
include 'resources/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_POST['title'] = test_input($_POST['title']);
  $_POST['employer'] = test_input($_POST['employer']);
  $_POST['start_date'] = test_input($_POST['start_date']);
  $_POST['end_date'] = test_input($_POST['end_date']);
  $_POST['reason_for_leaving'] = test_input($_POST['reason_for_leaving']);

  // replace '' with null
  $_POST['title'] = "'".$_POST['title']."'";
  $_POST['employer'] = "'".$_POST['employer']."'";
  $_POST['start_date'] = "'".$_POST['start_date']."'";
  if ($_POST['end_date'] == '') {
    $_POST['end_date'] = 'null';
  } else {
    $_POST['end_date'] = "'".$_POST['end_date']."'";
  }
  if ($_POST['reason_for_leaving'] == '') {
    $_POST['reason_for_leaving'] = 'null';
  } else {
    $_POST['reason_for_leaving'] = "'".$_POST['reason_for_leaving']."'";
  }
  // Set SQL query
  $sql = "insert into work_history ( applicant_email , title , employer , start_date , end_date , reason_for_leaving )
  values
  ( '".$_SESSION['email']."' , ".$_POST['title']." , ".$_POST['employer']." , ".$_POST['start_date']." , ".$_POST['end_date']." , ".$_POST['reason_for_leaving']." )";
  $result = mysqli_query($con,$sql);
}

?>
<!doctype html>
<html>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body>
<div id='page_title'>
Work History
</div>
<div id='content'>
Add new work history<br>
<form method='post' name='new_wh_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' onsubmit="return validateNewWH()" >
Title: <span class='red'>*</span> <input type='text' id='title' name='title' size='30' required><br>
Employer: <span class='red'>*</span> <input type='text' id='employer' name='employer' size='30' required><br>
Start Date: <span class='red'>*</span> <input type='date' id='start_date' name='start_date' required><br>
End Date: <input type='date' id='end_date' name='end_date'><br>
Reason for Leaving: <input type='text' id='reason_for_leaving' name='reason_for_leaving' size='40'><br>
<input type='submit'><br>
</form><br>
<hr>
<?php
// Show all work_history for this email and allow deleting. (maybe in future add updating)
$sql = "select * from work_history where applicant_email = '".$_SESSION['email']."'";
$result = mysqli_query($con,$sql);

if ($result->num_rows != 0 ) {
  echo "<table border=1><th>wh_id</th><th>applicant_email</th><th>title</th><th>employer</th><th>start_date</th><th>end_date</th><th>reason_for_leaving</th>";
  while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['wh_id'] . "</td>";
    echo "<td>" . $row['applicant_email'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['employer'] . "</td>";
    echo "<td>" . $row['start_date'] . "</td>";
    echo "<td>" . $row['end_date'] . "</td>";
    echo "<td>" . $row['reason_for_leaving'] . "</td>";
    echo "</tr>";
    }
  echo "</table>";
} else {
  echo "Add your first work_history so that hiring managers can see your experience!";
}

mysqli_free_result($result);
?>
<hr>
<a href='home.php'>Home</a><br>
</div>
</body>
<script>
function validateNewWH() {
  var error = '';
  var title = document.forms['new_wh_form']['title'].value;
  var employer = document.forms['new_wh_form']['employer'].value;
  var start_date = document.forms['new_wh_form']['start_date'].value;
  var end_date = document.forms['new_wh_form']['end_date'].value;
  var reason_for_leaving = document.forms['new_wh_form']['reason_for_leaving'].value;
  
  //alert ('values:\n'+title +'\n' + employer +'\n' + start_date +'\n' + end_date +'\n' + reason_for_leaving);

  if (end_date != '' && start_date > end_date) {
    error = error.concat('Start date must be before end date.\n');
  }
  //error = error.concat('\nJS Validate preventing submission.');
  if (error != '') {
    alert(error);return false;
  }
}
</script>
</html>
