
<!doctype html>
<head>
<title>App-ly</title>
</head>
<body>
<div id='page_title'>
Welcome to App-ly
</div>
<div id='content'>
Login or Signup<br>
<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
Email: <input type='email' name='email'>
</form>
</div>
</body>
</html>
