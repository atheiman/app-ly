<?php
session_start();
if (!isset($_SESSION['email']) {
  header('Location: http://www.example.com/');
  header('Location: applicant_login.php');
}
?>
<!doctype html>
<html>
<title>App-ly</title>
</head>
<body>
<div id='page_title'>
Welcome to App-ly
</div>
<div id='content'>
<?php var_dump($_SESSION);?>
<br>
<a href='logout.php'>Logout</a><br>
</div>
</body>
</html>

