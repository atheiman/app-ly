<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
}
?>
<!doctype html>
<html>
<title>App-ly - Applicant Home</title>
<link rel="stylesheet" type="text/css" href="resources/style.css">
</head>
<body>
<div id='page_title'>
Applicant Home
</div>
<div id='content'>
<div class='section_head'>Welcome, <?php echo $_SESSION['firstname']; ?></div>
<a href='profile.php'>Update your profile</a><br>
<a href='education.php'>Update your education history</a><br>
<a href='work_history.php'>Update your work history</a><br>
<a href='jobs.php'>Browse openings</a>
<hr>
<a href='logout.php'>Logout</a><br>
</div>
</body>
</html>

