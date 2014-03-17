<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
}
?>
<!doctype html>
<html>
<title>App-ly</title>
<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body>
<div id='page_title'>
Applicant Home
</div>
<div id='content'>
Welcome, <?php echo $_SESSION['firstname']; ?><br>
<a href='profile.php'>Update your profile</a><br>
<a href='work_history.php'>Update your work history</a><br>
<a href='jobs.php'>Browse openings</a>
<hr>
<a href='logout.php'>Logout</a><br>
</div>
</body>
</html>

