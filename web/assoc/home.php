<?php
session_start();
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
}
?>
<!doctype html>
<html>
<title>App-ly - Associate Home</title>
<link rel="stylesheet" type="text/css" href="../resources/style.css">
</head>
<body>
<div id='page_title'>
Applicant Home
</div>
<div id='content'>
<div class='section_head'>Welcome, <?php echo $_SESSION['firstname']; ?></div>
<a href='browse_applicants.php'>Browse Applicants</a><br>
<hr>
<a href='logout.php'>Logout</a><br>
</div>
</body>
</html>
