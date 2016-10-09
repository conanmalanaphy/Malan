<?php
$username = "cmalanaphy_1";
	$password = "malanaphy1";
	$host="conanmalanaphynet.ipagemysql.com";
	$database="alexis_1";

	$con = mysql_connect($host,$username,$password);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
 
	mysql_select_db($database,$con);

?>
