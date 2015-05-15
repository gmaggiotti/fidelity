<?php
session_start();
include '../lib/dbConn.php';

if (!$_SESSION["valid_client_user"])
{
	// User not logged in, redirect to login page
	Header("Location: /json/loginService.php");
}

if(isset($_REQUEST['idc']))
{
	$id_category = stripslashes( $_REQUEST['idc'] );
	$query = "SELECT promotion.* FROM promotion,end_user WHERE promotion.id_category=".$id_category." AND end_user.id=". $_SESSION["valid_client_id"]." AND end_user.id_brand=promotion.id_brand";
} else 
{
	$query = "SELECT promotion.* FROM promotion,end_user WHERE end_user.id=". $_SESSION["valid_client_id"]." AND end_user.id_brand=promotion.id_brand";
}

$result = mysql_query($query);
$rows = array();
while($r = mysql_fetch_assoc($result)) {
  $rows[] = $r;
}
echo json_encode($rows);
?>