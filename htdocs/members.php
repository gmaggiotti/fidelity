<?php
session_start();

if (!$_SESSION["valid_user"])
{
        // User not logged in, redirect to login page
        Header("Location: index.php");
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
	<title>Fidelity</title>
	<!--script type="text/javascript" src="js/jquery-1.7.2.min.js"></script-->
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<link href="css/fileuploader.css" rel="stylesheet" type="text/css">	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>
<?php
// Member only content
// ...
// ...
// ...

// Display Member information
//echo "<p>User ID: " . $_SESSION["valid_id"];
//echo "<p>Username: " . $_SESSION["valid_user"];
//echo "<p>Logged in: " . date("m/d/Y", $_SESSION["valid_time"]);
//echo "<br>";
echo "<h4>Fidelity</h4>";
echo "<span class=\"label label-success\">Hola ".strtoupper($_SESSION["valid_user"])."!</span><br><br>";
echo "<span class=\"label label-warning\">Ingresaste por ultima vez ".date("m/d/Y", $_SESSION["valid_time"])."</span><br><br>";
echo "<br>";

// Add a promo
//echo "<p><a href=\"addPromo.php\">Add a promo</a></p>";
echo "<a href=\"promotion.php\" class=\"btn btn-info btn-sm\" role=\"button\">Promotions</a>";

// Display logout link
echo "<a href=\"logout.php\"><button type=\"button\" class=\"btn btn-link\">Click here to logout!</button></a>";


// Display promotions link
//echo "<p><a href=\"promotion.php\">Promotions</a></p>";

// Display logout link
//echo "<p><a href=\"logout.php\">Click here to logout!</a></p>";
?>
</body>
</html>