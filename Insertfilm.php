<?php session_start();
include 'connect.php';

?>
<?php
if(	!isset($_POST[Name]) || 
	trim($_POST[Name]) == '' || 
	!isset($_POST[BoxOffice]) || 
	trim($_POST[BoxOffice]) == '' || 
	!isset($_POST[Category]) || 
	trim($_POST[Category]) == ''  || 
	!isset($_POST[Actor1]) || 
	trim($_POST[Actor1]) == ''|| 
	!isset($_POST[Actor2]) || 
	trim($_POST[Actor2]) == ''|| 
	!isset($_POST[Actor3]) || 
	trim($_POST[Actor3]) == ''
	)
	{
		$_SESSION['filmerrors'] = array("Please fill all fields in");
		header("Location:AddNewFilm.php");

}else{

	

	$result = mysql_query("	SELECT * 
							FROM Film 
							WHERE Name = UCASE ('$_POST[Name]') 
							LIMIT 1"
						);
						
	if (mysql_fetch_row($result)) {
		$_SESSION['filmerrors'] = array("film already there");
		header("Location:AddNewFilm.php");

	} 
	else {
	   $sql="INSERT INTO 	Film (	Name,
									Releasedate,
									BoxOffice,
									Category,
									Dateadded,
									Actor1,
									Actor2,
									Actor3,
									description)
							VALUES	(UCASE ('$_POST[Name]'),
									'$_POST[Releasedate]',
									'$_POST[BoxOffice]',
									'$_POST[Category]',
									now(),
									'$_POST[Actor1]',
									'$_POST[Actor2]',
									'$_POST[Actor3]',
									'$_POST[description]')";
									
		
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		$_SESSION['filmerrors'] = array(" $_POST[Name] Film added");
		header("Location:AddNewFilm.php");
	} 
	mysql_close($con);
	}
?>
<header>
</header>