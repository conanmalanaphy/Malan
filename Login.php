<?php session_start(); ?>
<?php
	if(!isset($_SESSION['user_id'])){
 ?>
<?php 

if (isset($_POST['submit'])) {
	$user= "cmalanaphy_1";
    $pass= "malanaphy1";
    $host="conanmalanaphynet.ipagemysql.com";
    $database="alexis_1";
    mysql_connect($host,$user,$pass,$database);
    mysql_select_db($database);
    
    $username = $_POST['username'];
    $password = $_POST['password'];
   
	if (empty($username) or empty($password)){
		$_SESSION['errors'] = array("empty fields");
		header("Location:Login"); ;
	}else{
		$sql = mysql_query("SELECT id FROM users WHERE username='$username' AND password='$password'");
		$run = mysql_fetch_array($sql);
		$id = $run['id'];

		$sqlname = mysql_query("SELECT firstname FROM users WHERE username='$username' AND password='$password'");
		$runname = mysql_fetch_array($sqlname);
		$idname = $runname['firstname'];
	if (!empty($id)){
		$_SESSION['myusername'] = $username;
		$_SESSION['user_id'] = $id;
		header('Location: MyDashboard');
		exit();
	}else{
		$_SESSION['errors'] = array("Your username or password was incorrect.");
		header("Location:Login");}

	}
}

	if(isset($_GET['logout'])){
	echo 'You are now logged out!'; 
	}
?>
<head>
	<link rel="icon" href="http://conanmalanaphy.net/image/M.png">
	<title>Malan - Login</title>
	<link rel="stylesheet" href="css/loginpage.css">
</head>
<html>
	<section class="container">
		<form method= "post" >
			<div class="login">
			<h1>Login to Malan</h1>
			Username: <input type = "text" name= "username" placeholder="Username"><br /><br />
			Password: <input type ="password" name ="password"placeholder="Password"><br /> 
			<br />

				<div class="form-errors">
					<?php
						if (isset($_SESSION['errors'])): 
					?>
					<?php foreach($_SESSION['errors'] as $error): 
					?>
					<p><?php echo $error ?></p>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div id= "buttonbox">
					<div id= "buttonleft">
					<input type="button" id='newuserbtn' onclick="location.href='http://conanmalanaphy.net/CreateUser';" value="New User" />
					</div>
					<div id= "buttonright">
						<class="submit"><input type ="submit" name="submit" value"Log In" />
					</div>
				</div>

			</div>

		</form>
	</section>
</html>
<?php
 
}
else{
	header ('Location: MyDashboard');
}
?>