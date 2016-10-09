<?php session_start(); ?>
<?php

	if(isset($_SESSION['user_id'])){
		header ('Location: AddNewUser');
		}
	else{ ?>
<html>
<head>
	<link rel="icon" href="http://conanmalanaphy.net/image/M.png">
	<link rel="stylesheet" href="css/mainbackground.css">
	<link rel="stylesheet" href="css/newusercreate.css">
	<title>Malan - New User</title>
</head>
<body>
	<div class="container">
		<h1>Welcome to Conanmalanaphy.net</h1>
		<div class="user-box">
			<h1>Create Account</h1>
				<div class="user-box1">
					<div class="user-box2" >
						<p>Username:<br><br>
						Password:<br><br>
						Retype Password:<br><br>
						<br><br>
						Firstname:<br><br>
						Lastname:<br><br> 
						Birth date: <br><br>
						</p>

					</div>
					
					<div class="user-box3">
						<form action="newuserinsert.php" method="post">
							<input type="text" name="username" placeholder="Bobby" /><br><br>
							<input type="password" name="password1" /><br><br>
							<input type="password" name="password2" /><br><br>
							<br><br>
							<input type="text" name="fname" placeholder="Bob" /><br><br>
							<input type="text" name="lname" placeholder="Bobson" /><br><br>
							<input type="date" name="DOB" min="2000-12-31 max="2016-12-31"><br>

							<input type="submit" />
						</form>


						<div class="form-errors">
							<?php
							 if (isset($_SESSION['usererrors'])){ ?>
									<?php foreach($_SESSION['usererrors'] as $error){ ?>
										<p><?php echo $error ?></p>
									<?php }
                                                                   }?>
						</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>
<?php
}
?>