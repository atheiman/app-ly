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
  if (isset($_POST['sql'])) {  // $_POST['sql'] contains a delete statement for the chosen education
    $sql = $_POST['sql'];
    $result = mysqli_query($con,$sql);
  } else {
    $_POST['school_name'] = test_input($_POST['school_name']);
    $_POST['school_state'] = test_input($_POST['school_state']);
    $_POST['edu_status'] = test_input($_POST['edu_status']);
    $_POST['grad_date'] = test_input($_POST['grad_date']);
    $_POST['major'] = test_input($_POST['major']);

    // replace '' with null
    $_POST['school_name'] = "'".$_POST['school_name']."'";
    if ($_POST['school_state'] == '') {
      $_POST['school_state'] = 'null';
    } else {
      $_POST['school_state'] = "'".$_POST['school_state']."'";
    }
    $_POST['edu_status'] = "'".$_POST['edu_status']."'";
    $_POST['grad_date'] = "'".$_POST['grad_date']."'";
    $_POST['major'] = "'".$_POST['major']."'";

    // Set SQL query
    $sql = "insert into education ( applicant_email , school_name , school_state , edu_status , grad_date , major )
    values
    ( '".$_SESSION['email']."' , ".$_POST['school_name']." , ".$_POST['school_state']." , ".$_POST['edu_status']." , ".$_POST['grad_date']." , ".$_POST['major']." )";
    $result = mysqli_query($con,$sql);
  }
}
?>
<!doctype html>
<html>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body>
<div id='page_title'>
Education
</div>
<div id='content'>
<div class='section_head'>Add new education</div>
<form method='post' name='new_edu_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' onsubmit="return validateNewEdu()">
School Name: <span class='red'>*</span> <input type='text' id='school_name' name='school_name' size='30' required><br>
School State: <input type='text' id='school_state' name='school_state' size='2' maxlength='2' onchange="this.value=this.value.toUpperCase()"><br>
Education Status: <span class='red'>*</span> <select id='edu_status' name='edu_status'>
  <option value='Associates in progress'>Associates Degree in progress</option>
  <option value='Bachelors in progress'>Bachelors Degree in progress</option>
  <option value='Postgraduate in progress'>Postgraduate Degree in progress</option>
  <option value='Completed Associates'>Completed Associates Degree</option>
  <option value='Completed Bachelors'>Completed Bachelors Degree</option>
  <option value='Completed Postgraduate'>Completed Postgraduate Degree</option>
</select><br>
Graduation Date: <span class='red'>*</span> <input type='date' id='grad_date' name='grad_date' required><br>
Major: <span class='red'>*</span> <input type='text' id='major' name='major' size='30' required><br>
<input type='submit' id='submit'><br>
</form>
<?php
// Show all education for this email and allow deleting. (maybe in future add updating)
$sql = "select * from education where applicant_email = '".$_SESSION['email']."'";
$result = mysqli_query($con,$sql);

if ( $result->num_rows != 0 ) {
  // this email already has at least one education record
  echo "<hr><div class='section_head'>Delete existing education</div>";
  echo "<table border='1' cellpadding='3'><th>School Name</th><th>School State</th><th>Education Status</th><th>Grad Date</th><th>Major</th><th>Action</th>";
  while($row = mysqli_fetch_array($result)) {
    $edu_id = $row['edu_id'];
    $applicant_email = $row['applicant_email'];
    $school_name = $row['school_name'];
    $school_state = $row['school_state'];
    $edu_status = $row['edu_status'];
    $grad_date = $row['grad_date'];
    $major = $row['major'];
    $sql = "delete from education where edu_id = $edu_id";
    echo "<tr><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' onsubmit='return confirm(".'"Are you sure you want to delete your education at '.$school_name.'?"'.")'>";
    echo "<td>$school_name</td>";
    echo "<td>$school_state</td>";
    echo "<td>$edu_status</td>";
    echo "<td>$grad_date</td>";
    echo "<td>$major</td>";
    echo "<input type='text' name='sql' value='$sql' size='50' hidden>";
    echo "<td><input type='submit' value='Delete'></td>";
    echo "</form></tr>";
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
function validateNewEdu() {
  var error = '';
  var school_name = document.forms['new_edu_form']['school_name'].value;
  var school_state = document.forms['new_edu_form']['school_state'].value;
  var edu_status = document.forms['new_edu_form']['edu_status'].value;
  var grad_date = document.forms['new_edu_form']['grad_date'].value;
  var major = document.forms['new_edu_form']['major'].value;
  
  //error = error.concat('\nJS Validate preventing submission.');
  if (error != '') {
    alert(error);return false;
  }
}
</script>
</html>
