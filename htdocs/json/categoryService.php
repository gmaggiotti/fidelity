<?php
session_start();
include '../lib/dbConn.php';

if (!$_SESSION["valid_client_user"])
{
	// User not logged in, redirect to login page
	Header("Location: /json/loginService.php");
}

$query = "SELECT c.* FROM category c";//, promotion p, end_user u WHERE end_user.id=". $_SESSION["valid_client_id"]." AND end_user.id_brand=promotion.id_brand";

$result = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($result)) {
  $rows[] = $r;
}
echo json_encode($rows);
?>