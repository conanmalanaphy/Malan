<?php
	$username = "cmalanaphy_1";
	$password = "malanaphy1";
	$host="conanmalanaphynet.ipagemysql.com";
	$database="alexis_1";

	$mysqli = new mysqli($host,$username,$password,$database);

	if ($mysqli -> connect_error)
	  {
	  die('Could not connect: (' . $mysqli -> connect_errno.')'
	   .$mysqli -> connect_error);
	  }
	   
?>