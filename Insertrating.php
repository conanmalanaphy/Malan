<?php session_start();
?>
<?php
	if(!isset($_POST[film]) || 
		trim($_POST[film]) == '' || 
		!isset($_POST[actor]) ||
		trim($_POST[actor]) == '' || 
		!isset($_POST[rating]) || 
		trim($_POST[rating]) == '')
	{
  
	$_SESSION['ratingerrors'] = array("Please fill all fields in");
	header("Location:RateFilm");

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


		$result = mysql_query("SELECT * FROM Averagerating 
										WHERE filmname='$_POST[film]' and id='$_POST[id]' 
										LIMIT 1");
		
		if (mysql_fetch_row($result)) {
			$_SESSION['ratingerrors'] = array("you've already rated");
			header("Location:RateFilm");

		}else{
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

			$eventname = mysql_real_escape_string($_SESSION['user_id']);

			$sql="INSERT INTO Averagerating (	filmname, 
												id, 
												actor,
												rating,
												comment)
												VALUES
											('$_POST[film]',
											$eventname,
											'$_POST[actor]',
											'$_POST[rating]',
											'$_POST[comment]') 
											ON DUPLICATE KEY UPDATE actor= '$_POST[actor]' , 
											rating ='$_POST[rating]' ";

			if (!mysql_query($sql,$con))
			  {
			  die('Error: ' . mysql_error());
			  }
			 $_SESSION['ratingerrors'] = array("you've rated $_POST[film]");
			 header ('Location: RateFilm');
			}


		if (!mysql_query($sql,$con))
		  {
		  die('Error: ' . mysql_error());
		  }
		mysql_close($con);
}
?>
<?php
header ('Location: RateFilm');
?>
<header>
</header>