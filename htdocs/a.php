<?php
session_start();
include 'dbConn.php';
include 'lib/strUtils.php';


	//execute the SQL query and return records
	$result = mysql_query("SELECT * FROM brand WHERE login='gmaggiotti'");
	$row = mysql_fetch_array($result);
    echo "a:".$row{login};


?>
