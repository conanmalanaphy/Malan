<?php session_start();
?>
<?php
if(	!isset($_POST[username]) || 
	trim($_POST[username]) == '' || 
	!isset($_POST[password1]) || 
	trim($_POST[password1]) == '' || 
	!isset($_POST[password2]) || 
	trim($_POST[password2]) == ''  || 
	!isset($_POST[fname]) || 
	trim($_POST[fname]) == ''  || 
	!isset($_POST[lname]) || 
	trim($_POST[lname]) == '' 
	)
{
  
	$_SESSION['usererrors'] = array("Please fill all fields in");
	header("Location:AddNewUser.php");

}
else{

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


	$result = mysql_query("	SELECT * 
							FROM users 
							WHERE username='$_POST[username]'  
							LIMIT 1"
							);
	if (mysql_fetch_row($result)) {
		$_SESSION['usererrors'] = array("you've already added this user");
		header("Location:AddNewUser.php");
	}
	else{
		$sql="INSERT INTO users(username, 
								password, 
								DOB, 
								firstname, 
								lastname)
							VALUES
							('$_POST[username]',
							'$_POST[password1]',
							'$_POST[DOB]',
							'$_POST[fname]',
							'$_POST[lname]')";
		$_SESSION['usererrors'] = array("you've Added $_POST[username] as a User");
		header ('Location:AddNewUser.php');
		
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
	}

	mysql_close($con);
}
?>