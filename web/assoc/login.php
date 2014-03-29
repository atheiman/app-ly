<?php
session_start();
if (isset($_SESSION['user_email'])) {header('Location: home.php');}
if (isset($_SESSION['email'])) {header('Location: ../home.php');}
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  include '../resources/db_connect.php';
  $_POST['user_email'] = test_input($_POST['user_email']);
  $_POST['password'] = test_input($_POST['password']);
  $sql = "select firstname , password from users where user_email = '" . $_POST['user_email'] . "'";
  $result = mysqli_query($con,$sql);
  if ($result->num_rows == 0 ) {
    $error = 'email not found';
  } else {
    while($row = mysqli_fetch_array($result)) {
      if ($row['password'] == $_POST['password']) {
        // Set session vars
        $_SESSION['user_email'] = $_POST['user_email'];
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
<title>App-ly - Associate Login</title>
<link rel="stylesheet" type="text/css" href="../resources/style.css">
</head>
<body>
<div id='page_title'>
Login to App-ly as Associate
</div>
<div id='content'>
<form method='post' name='login_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
Email: <input id='email_input' type='email' name='user_email' size='20' required
<?php if (isset($_GET['user_email'])) {echo "value=".$_GET['user_email']." "; } ?>
><br>
Password: <input id='password_input' type='password' name='password' size='20' required><br>
<input type='submit' value='Login'><br>
</form>
<div class='red'>
<?php
if ($error != '') {echo "Error: " . $error;}
echo "<script>";
if ($error == 'incorrect password') {
  echo "
  document.forms['login_form']['email'].value = '" . $_POST['user_email'] . "';
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
<br><hr><br>
Not a member yet? Request access from another associate.
</div>
</body>
</html>
