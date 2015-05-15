<?php 
session_start();
if ($_SESSION["valid_user"])
{
  ?> <script type="text/javascript"> top.location.href='promotion.php'</script><?php
}
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
  <title>Fidelity</title>
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<div id="content" class="container">
  <form class="form-signin" id="form1" name="form1" action="doLogin.php" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="username" class="sr-only">Username</label>
    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
    <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="login" name="login">Sign in</button>
    <button type="button" class="btn btn-lg btn-info btn-block"><a href="signup.php">Click here to Sign Up!</a></button>
  </form>
  <div id="message"></div>
</div>
</body>
</html>