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

  echo "POST data: email=" . $_POST['email'] . " password=" . $_POST['password'] . " confirm_password=" . $_POST['confirm_password'] . " firstname=" . $_POST['firstname'] . " lastname=" . $_POST['lastname'] . " city=" . $_POST['city'] . " state=" . $_POST['state'] . " phone=" . $_POST['phone'] . "<br>";
  include 'resources/db_connect.php';
  // Check if email already exists
  $sql = "select applicant_email from applicants where applicant_email = '" . $_POST['email'] . "'";
  echo "Checking for existing account with sql: $sql<br>";
  $result = mysqli_query($con,$sql);
  if ($result->num_rows != 0 ) {
    echo "<script>
    alert('There is already an account associated with ".$_POST['email'].", redirecting you to login page.');
    window.location.assign('login.php');
    </script>";
  }
  mysqli_free_result($result);
  // Add user to applicants table
  $sql = "insert into applicants (
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
</head>
<body>
<div id='page_title'>
Welcome to App-ly
</div>
<div id='content'>
Sign up<br>
<form method='post' name='login_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' onsubmit="return validateForm()" >
Email: <input id='email_input' type='email' name='email' size='20' required><br>
Password: <input id='password_input' type='password' name='password' size='20' required><br>
Confirm Password: <input id='confirm_pass_input' type='password' name='confirm_password' size='20' required><br>
First name: <input id='firstname_input' type='text' name='firstname' size='20' required><br>
Last name: <input id='lastname_input' type='text' name='lastname' size='20' required><br>
City: <input id='city_input' type='text' name='city' size='20' required><br>
State: <input id='state_input' type='text' name='state' size='2' maxlength='2' required><br>
Phone: <input id='phone1' type='number' name='phone1' size='3' max='999' min='0' required onchange='set_phone()'> -
<input id='phone2' type='number' name='phone2' size='3' max='999' min='0' required onchange='set_phone()'> -
<input id='phone3' type='number' name='phone3' size='4' max='9999' min='0' required onchange='set_phone()'>
<input id='phone' type='text' name='phone' size='20'><br>
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
<br>Already a member? <a href='login.php'>Login</a><br>
</div>
<script>
function set_phone()
{
  var phone1=document.forms['login_form']['phone1'].value.toString();
  var phone2=document.forms['login_form']['phone2'].value.toString();
  var phone3=document.forms['login_form']['phone3'].value.toString();
  var phone=document.forms['login_form']['phone'];
  phone.value=phone1+'-'+phone2+'-'+phone3;
}

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
  if (password != confirm_password) {
    error = error.concat('Confirm password does not match. ');
  }
  if (phone.length != 12) {
    error = error.concat('Phone format incorrect. ');
  }
  if (error != '') {
    alert(error);
    return false;
  } else {
    var msg='Submitting data as email='+email+' password='+password+' firstname='+firstname+' lastname='+lastname+' city='+city+' state='+state+' phone='+phone;
    alert(msg);
  }
  //alert("JavaScript function preventing submit"); return false;
}
</script>
</body>
</html>
