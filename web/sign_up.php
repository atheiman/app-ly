<?php
session_start();
if (isset($_SESSION['email'])) {header('Location: home.php');}
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  include 'resources/db_connect.php';
  $_POST['email'] = test_input($_POST['email']);
  $_POST['password'] = test_input($_POST['password']);
  $sql = "select firstname , password from applicants where applicant_email = '" . $_POST['email'] . "'";
  $result = mysqli_query($con,$sql);
  if ($result->num_rows == 0 ) {
    $error = 'email not found';
  } else {
    while($row = mysqli_fetch_array($result)) {
      if ($row['password'] == $_POST['password']) {
        // Set session vars
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['firstname'] = $row['firstname'];
        // Redirect to homepage
        echo "<script>window.location.assign('home.php')</script>";
      } else {
        $error = 'incorrect password';
      }
    }
  }
}

function test_input($data)
{
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
<form method='post' name='login_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
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
</body>
</html>
