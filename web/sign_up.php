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
  $_POST['country'] = test_input($_POST['country']);
  $_POST['phone'] = test_input($_POST['phone']);

  echo "POST data:<br>email=" . $_POST['email'] . " password=" . $_POST['password'] . " confirm_password=" . $_POST['confirm_password'] . " firstname=" . $_POST['firstname'] . " lastname=" . $_POST['lastname'] . " city=" . $_POST['city'] . " country=" . $_POST['country'] . " phone=" . $_POST['phone'] . "<br>";
  include 'resources/db_connect.php';
  //$sql = '';
  //$result = mysqli_query($con,$sql);
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
Country: <select id='country_select' name='country'><option value='United States'>United States</option><option value='Canada'>Canada</option><option value='Mexico'>Mexico</option></select><br>
Phone: <input id='phone_input' type='text' name='phone' size='20' maxlength='12' required> xxx-xxx-xxxx<br>
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
function validateForm()
{/*
var x=document.forms["myForm"]["fname"].value;
if (x==null || x=="")
  {
  alert("First name must be filled out");
  return false;
  }
var x=document.forms["myForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }*/
  alert("JavaScript function preventing submit");
  return false;
}
</script>
</body>
</html>
