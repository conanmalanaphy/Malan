<?php session_start(); ?>
<?php

if(!isset($_SESSION['user_id'])){
 header ('Location: NoLogin.php');
}
else{ ?>
<html>
<head>
	<link rel="icon" href="http://conanmalanaphy.net/image/M.png">
	<title>Malan - New Film</title>
	<link rel="stylesheet" href="css/mainbackground.css">
	<link rel="stylesheet" href="css/addfilm.css">
</head>
<body>
	<?php include("header.php"); 
	?>
	<div class="container">
		<div class="innerbackgroundlevel1">
			<h1>Add a New Film</h1>
			<div class="innerbackgroundlevel2">
				<div class="innerbackgroundlevel3left">
					
						<form action="Insertfilm.php" method="post">
							<table>
								<thead>
									<tr>
										<th></th>
										<th></th>
								

									</tr>
								</thead>
								<tbody>
                                    <tr>
										<td> Filmname:</td>
										<td> <input type="text" name="Name" placeholder="TopGun"/></td>
									</tr>
									<tr>
										<td> ReleaseDate:</td>
										<td><input type="date" name="Releasedate" min="2000-12-31" max="2016-12-31" Placeholder="2015-12-31"></td>
									</tr>
						
									<tr>
										<td>Boxoffice (Mil GBP): </td>
										<td><input type="int" name="BoxOffice" placeholder="500" /></td>
									</tr>
									<tr>
										<td>Category</td>
										<td><input type="text" name="Category" list="CategoryList" placeholder="Action">
												<datalist id="CategoryList">
													<option value="Horror">
													<option value="Comedy">
													<option value="Thriller">
													<option value="Action">
													<option value="Animated">
												</datalist>
										</td>
							
									</tr>
									<tr>
										<td>Nominee 1: </td>
										<td><input type="text" name="Actor1" placeholder="Tom Cruise" /><br><br></td>
							
									</tr>
									<tr>
										<td>Nominee 2: </td>
										<td><input type="text" name="Actor2" placeholder="Al Pacino" /></td>
							
									</tr>
									<tr>
										<td>Nominee 3: </td>
										<td><input type="text" name="Actor3"placeholder="Tom Hanks" /></td>
									</tr>
									<tr>
										<td>Description</td>
										<td><input type="text" name="description"placeholder="Description" /></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" /></form></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="form-errors">
											<?php
											 if (isset($_SESSION['filmerrors'])): ?>
													<?php foreach($_SESSION['filmerrors'] as $error): ?>
														<p><?php echo $error ?></p>
													<?php endforeach; ?>
												
											<?php endif; ?>
											</div>
										</td>
							
									</tr>
								</tbody>
							</table>

					
				</div>

			<div class="innerbackgroundlevel3right">
                                <h1>Recently Added</h1>
				<?php
					include 'config.php';
					$result = mysqli_query($mysqli,"SELECT Name, 
													Dateadded 
													FROM `Film` 
													Order by Dateadded desc 
													LIMIT 5;"
											);
					echo "<table >
							<tr>
								<th>Filmname</th>
								<th>Rating</th>
							</tr>";

						while($row = mysqli_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>" . $row['Name'] . "</td>";
							echo "<td>" . $row['Dateadded'] . "</td>";
							echo "</tr>";
						}
						echo "</table>";

						mysqli_close($mysqli);
				?>

			</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
}
?>