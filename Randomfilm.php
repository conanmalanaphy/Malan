<?php
$user = "cmalanaphy_1";
$pass = "malanaphy1";
$host="conanmalanaphynet.ipagemysql.com";
$databaseName="alexis_1";

$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$result = mysql_query("SELECT Name FROM `Film` order by rand() limit 1 "); # selects 1  random film from the database table. 
$data = array();
while ( $row = mysql_fetch_row($result) )
{
  $data[] = $row[0];                              # adds the data into an array
}

echo json_encode( $data[0] );            

?>