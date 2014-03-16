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
Login<br>
<form method='post' name='login_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
Email: <input id='email_input' type='email' name='email' size='20' required><br>
Password: <input id='password_input' type='password' name='password' size='20' required><br>
<input type='submit' value='Login'><br>
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
<br>Not a member yet? <a href='applicant_sign_up.php'>Sign up</a><br>
</div>
</body>
</html>
