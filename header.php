<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" href="css/header.css">
</head>
<body>
	<div id="header">
		<div class="header-inner">
			<div class="tab">
				<a class="home-link" href="MyDashboard"><img src="image/home.png"></span></a>
			</div>
			<div class="tab">
				<a class="Rating" href="RateFilm"><img src="image/GoldStar.png"></span></a>
			</div>
			<div class="tab">
				<a class="Film" href="AddNewFilm"><img src="image/Reel.png"></span></a>
			</div>
			<div class="header-box" >
                               <div class="header-box3" >
					<a class="Rating" href="logout.php"><img src="image/logout.png"></span></a>
				</div>
				
				<div class="header-box2" >
					<a class="User" href="AddNewUser"><img src="image/User.png"></span></a> 
				</div>
				<div class="header-box1">
					<p><?php
						echo '<span style="color:#ffffff;text-align:center;">Welcome '.$_SESSION['myusername'].'</span>';
					?>
				        </p>
                                </div>
			</div>
		</div>
	</div>
</body>
</html>