<?php
session_start();
include 'lib/dbConn.php';
include 'lib/strUtils.php';

$is_ajax = $_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax &&
		isFormFieldValid($_REQUEST['username']) &&
		isFormFieldValid($_REQUEST['password'])  )
{
	$username = stripslashes( $_REQUEST['username'] );
	$password = stripslashes( $_REQUEST['password'] );

	//execute the SQL query and return records
	$result = mysql_query("SELECT * FROM brand WHERE login='$username'");
	$row = mysql_fetch_array($result);

	if(isset($row) && $username == $row{'login'} && md5($password) == $row{'password'})
	{
		// Login good, create session variables
		$_SESSION["valid_id"] = $row{'id'};
		$_SESSION["valid_user"] = $username;
		$_SESSION["brand"] = $row['name'];
		$_SESSION["valid_time"] = time();
		echo "success";
	}
}

?>
