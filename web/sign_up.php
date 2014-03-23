<?php
session_start();
if (isset($_SESSION['email'])) {header('Location: home.php');}
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $_POST['email'] = test_input($_POST['email']);
  $_POST['password'] = test_input($_POST['password']);
  $_POST['confirm_password'] = test_input($_POST['confirm_password']);
  $_POST['firstname'] = test_input($_POST['firstname']);
  $_POST['lastname'] = test_input($_POST['lastname']);
  $_POST['city'] = test_input($_POST['city']);
  $_POST['state'] = test_input($_POST['state']);
  $_POST['phone'] = test_input($_POST['phone']);

  include 'resources/db_connect.php';
  // Check if email already exists
  $sql = "select applicant_email from applicants where applicant_email = '" . $_POST['email'] . "'";
  $result = mysqli_query($con,$sql);
  if ($result->num_rows != 0 ) {
    echo "<script>
    alert('There is already an account associated with ".$_POST['email'].", redirecting you...');
    window.location.assign('login.php?email=".$_POST['email']."');
    </script>";
  }
  mysqli_free_result($result);
  // Add user to applicants table
  $sql = "insert into applicants ( applicant_email , password , firstname , lastname , city , state , phone )
  values
  ( '".$_POST['email']."' , '".$_POST['password']."' , '".$_POST['firstname']."' , '".$_POST['lastname']."' , '".$_POST['city']."' , '".$_POST['state']."' , '".$_POST['phone']."')";
  $result = mysqli_query($con,$sql);
  if (mysqli_connect_errno()) {die("Failed to connect to MySQL: " . mysqli_connect_error());}
  // Set Session vars
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['firstname'] = $_POST['firstname'];
  echo "<script>window.location.assign('home.php');</script>";
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
<body>
<div id='page_title'>
Join App-ly
</div>
<div id='content'>
<form method='post' name='login_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' onsubmit="return validateForm()" >
Email: <input id='email_input' type='email' name='email' size='20' required><br>
Password: <input id='password_input' type='password' name='password' required><br>
Confirm Password: <input id='confirm_pass_input' type='password' name='confirm_password' required><br>
First name: <input id='firstname_input' type='text' name='firstname' required><br>
Last name: <input id='lastname_input' type='text' name='lastname' required><br>
City: <input id='city_input' type='text' name='city' required><br>
State: <input id='state_input' type='text' name='state' size='2' maxlength='2' required onchange="this.value=this.value.toUpperCase()"><br>
Phone: <input id='phone' type='text' name='phone' required> <span class='gray small'>XXX-XXX-XXXX</span><br>
<input type='submit'><br>
</form>
<div id='error'>
<?php
if ($error != '') {echo "Error: " . $error;}
echo "<script>";
if ($error == 'incorrect password') {
  echo "
  document.forms['login_form']['email'].value = '" . $_POST['email'] . "';
  document.getElementById('password_input').focus();
  ";
} else {
  echo "
  document.getElementById('email_input').focus();
  ";
}
echo "</script>";
?>
</div>
<hr>Already a member? <a href='login.php'>Login</a><br>
</div>
<script>
function validateForm()
{
  var email=document.forms['login_form']['email'].value;
  var password=document.forms['login_form']['password'].value;
  var confirm_password=document.forms['login_form']['confirm_password'].value;
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
  if (password != confirm_password) {
    error = error.concat('Password and Confirm Password do not match.\n');
  }
  if (password.length < 6) {
    error = error.concat('Password must be at least 6 characters.\n');
  }
  if (error != '') {
    alert(error);
    return false;
  }
}
</script>
</body>
</html>
