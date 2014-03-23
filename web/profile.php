<?php
session_start();
if (!isset($_SESSION['email'])) {header('Location: login.php');}
include 'resources/db_connect.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $sql = "select * from applicants where applicant_email = '".$_SESSION['email']."'";
  $result = mysqli_query($con,$sql);
  while($row = mysqli_fetch_array($result)) {
    $current_email = $row['applicant_email'];
    $current_first = $row['firstname'];
    $current_last = $row['lastname'];
    $current_city = $row['city'];
    $current_state = $row['state'];
    $current_phone = $row['phone'];
  }
  mysqli_free_result($result);
  $msg = "";
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_POST['email'] = test_input($_POST['email']);
  $_POST['firstname'] = test_input($_POST['firstname']);
  $_POST['lastname'] = test_input($_POST['lastname']);
  $_POST['city'] = test_input($_POST['city']);
  $_POST['state'] = test_input($_POST['state']);
  $_POST['phone'] = test_input($_POST['phone']);
  // Update info
  $sql = "update applicants set applicant_email='".$_POST['email']."',firstname='".$_POST['firstname']."',lastname='".$_POST['lastname']."',city='".$_POST['city']."',state='".$_POST['state']."',phone='".$_POST['phone']."' where applicant_email='".$_SESSION['email']."';";
  $result = mysqli_query($con,$sql);
  if (mysqli_connect_errno()) {die("Failed to connect to MySQL: " . mysqli_connect_error());}
  // Set new session vars
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['firstname'] = $_POST['firstname'];
  $msg='Profile updated.';
  // Set current vals to show on page
  $current_email = $_POST['email'];
  $current_first = $_POST['firstname'];
  $current_last = $_POST['lastname'];
  $current_city = $_POST['city'];
  $current_state = $_POST['state'];
  $current_phone = $_POST['phone'];
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<!doctype html>
<head>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body onload="setTimeout(function() {document.getElementById('msg').innerHTML=''} , 2000)">
<div id='page_title'>
Update your profile
</div>
<div id='content'>
<form method='post' name='login_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' onsubmit="return validateForm()" onkeypress='enable_update()'>
Email: <input id='email_input' type='email' name='email' size='20' required <?php echo "value='$current_email'"; ?>><br>
First name: <input id='firstname_input' type='text' name='firstname' required <?php echo "value='$current_first'"; ?>><br>
Last name: <input id='lastname_input' type='text' name='lastname' required <?php echo "value='$current_last'"; ?>><br>
City: <input id='city_input' type='text' name='city' required <?php echo "value='$current_city'"; ?>><br>
State: <input id='state_input' type='text' name='state' size='2' maxlength='2' required onchange="this.value=this.value.toUpperCase()" <?php echo "value='$current_state'"; ?>><br>
Phone: <input id='phone' type='text' name='phone' required <?php echo "value='$current_phone'"; ?>><br>
<input type='submit' id='update' value='Update' disabled><br>
</form>
<div id='msg'><?php echo $msg; ?>
</div>
<hr><a href='home.php'>Home</a><br>
</div>
<script>
function enable_update() {
  document.getElementById('update').disabled = false;
}

function validateForm()
{
  var email=document.forms['login_form']['email'].value;
  var firstname=document.forms['login_form']['firstname'].value;
  var lastname=document.forms['login_form']['lastname'].value;
  var city=document.forms['login_form']['city'].value;
  var state=document.forms['login_form']['state'].value;
  state=state.toUpperCase();
  var phone=document.forms['login_form']['phone'].value;
  var error = '';
  var numbers = new Array('0','1','2','3','4','5','6','7','8','9');
  var phone_err = 'Phone format incorrect. Format should be XXX-XXX-XXXX\n';
  if (numbers.indexOf(phone.charAt(0)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(1)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(2)) == -1) {
    error = phone_err;
  } else if (phone.charAt(3) != '-') {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(4)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(5)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(6)) == -1) {
    error = phone_err;
  } else if (phone.charAt(7) != '-') {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(8)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(9)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(10)) == -1) {
    error = phone_err;
  } else if (numbers.indexOf(phone.charAt(11)) == -1) {
    error = phone_err;
  } else if (phone.length != 12) {
    error = phone_err;
  }
  if (state.length != 2) {
    error = error.concat('State should be a 2-digit code. Ex: \'Kansas\' is \'KS\'.\n');
  }
  if (error != '') {
    alert(error);
    return false;
  }
}
</script>
</body>
</html>
