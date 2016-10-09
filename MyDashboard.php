<?php session_start(); ?> //opens session to get global variables 

<?php
if(!isset($_SESSION['user_id'])){
 header ('Location: nologin.php');
}
else{ ?>  // checks if user is logged in 

<head>
<link rel="stylesheet" href="css/mainbackground.css"> // gets css for homepage
<link rel="stylesheet" href="css/maintable.css"> 
<link rel="icon" href="http://conanmalanaphy.net/image/M.png"> // gets icon for tab
<script type="text/javascript" src="https://www.google.com/jsapi"></script> // reference for google charts

<title>Malan - Home</title>


</head>
<body>
<?php 
include("header.php"); //include the header on the top of page
include 'config.php';  //include connection to the database
?> 


<div class="container" style="height: 1550px;">

        <div class = "innerbox-level1">
		<div class = "innerbox-level2left">
			<h1>Highest Grossing films</h1>
			<div id="barschart" style="width: 450px; height: 450px;">
			</div>
		</div>
		<div class = "innerbox-level2right">
			<h1>Films Per Category</h1>
			<div id="piechart" style="width: 450px; height: 450px;">
			</div>
		</div>
	</div>
	<hr class="style14">
	<div class = "innerbox-level1">
		<div class = "innerbox-level2left">
<h1>Most Nominated Actors</h1>
			<div id="piechartactor" style="width: 450px; height: 450px;"></div>
		</div>				
		<div class = "innerbox-level2right" >
<h1>Box Office vs Rating</h1>
				<div id="scatterchart" style="width: 450px; height: 450px;"></div>
		</div>
	</div>
		<hr class="style14">
	<div class = "innerbox-level1">
			<div class = "innerbox-level2left">
				<h1>Top Rated Films</h1>
				<?php
				$result = mysqli_query($mysqli,"SELECT 	Film.Category as 'Category',
														Releasedate,Boxoffice, 
														filmname, 
														Round(AVG(rating),1) as 'rating' 
												FROM `Averagerating` 
												join Film 
												on Film.Name = Averagerating.filmname
												GROUP BY filmname "
										);
				
				echo "<table>
						<thead>
							<tr>
								<th width='40px'>Filmname</th>
								<th width='70px'>Rating</th>
								<th>Releasedate</th>
								<th>Boxoffice</th>
								<th>Category</th>

							</tr>
						</thead>";
					echo "<tbody>";
					while($row = mysqli_fetch_array($result))# gets asccociative array of results displaying each column result per row 
						{
						echo "<tr>";
							echo "<td>" . $row['filmname'] . "</td>";
							echo "<td>" . $row['rating'] . "</td>";
							echo "<td>" . $row['Releasedate'] . "</td>";
							echo "<td>" . $row['Boxoffice'] . "</td>";
							echo "<td>" . $row['Category'] . "</td>";
						echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";

				
				?>
			</div>
			<div class = "innerbox-level2right">
				<h1>Films I have Rated</h1>
				<?php
				$result = mysqli_query($mysqli,"SELECT 	filmname, 
														rating 
												FROM `Averagerating`
												where id='" . $_SESSION['user_id'] . "' 
												Order by rating desc"
										);
										
				echo 	"<table >
							<thead>
								<tr>
									<th>Filmname</th>
									<th>Rating</th>
								</tr>
							</thead>";
							echo "<tbody>";
								while($row = mysqli_fetch_array($result)) # gets asccociative array of results displaying each column result per row 
								{
								echo "<tr>";
									echo "<td>" . $row['filmname'] . "</td>";
									echo "<td>" . $row['rating'] . "</td>";
								echo "</tr>";
								}
							echo "</tbody>";
						echo "</table>";

						
						?>
			</div>
		</div>
	<hr class="style14">
	
</div>


<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
	var data = google.visualization.arrayToDataTable([

		['Date', 'Mil GBP'],
		 <?php 
			
			$result = mysqli_query	($mysqli,"SELECT 	BoxOffice,
													Name 
													FROM Film
                                                                                  order by BoxOffice Desc
                                                                                  limit 5"
									);
			while($row = mysqli_fetch_array($result)){
			echo "['".$row['Name']."',".$row['BoxOffice']."],";}
		?>
 
	]);

	var options = {// options kept incase titles etc needed 
	};
 
	var chart = new google.visualization.ColumnChart(document.getElementById("barschart"));
	chart.draw(data, options);
	}
</script>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {

	var data = google.visualization.arrayToDataTable([
		['category', 'count'],
		<?php 
			
			$result = mysqli_query($mysqli,"SELECT 	count(Category) AS count,
													Category 
													FROM Film 
													GROUP BY Category"
									);
									
			while($row = mysqli_fetch_array($result)){

			echo "['".$row['Category']."',".$row['count']."],";
			}
		?>
	]);

	var options = { // options kept incase titles etc needed 
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
	}
</script>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {

	var data = google.visualization.arrayToDataTable([
		['Actor', 'count'],
		<?php 
			
			$result = mysqli_query($mysqli,"SELECT 	count(Actor) AS count,
													Actor 
													FROM Averagerating 
													GROUP BY Actor"
									);
									
			while($row = mysqli_fetch_array($result)){

			echo "['".$row['Actor']."',".$row['count']."],";
			}
		?>
	]);

	var options = {// options kept incase titles etc needed 
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechartactor'));

	chart.draw(data, options);
	}
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
        var data = google.visualization.arrayToDataTable([
			['rating', 'Boxoffice'],
			 <?php 
				
				$result = mysqli_query($mysqli,"	SELECT Film.BoxOffice AS  'boxoffice', 
													Averagerating.rating AS  'rating'
													FROM  `Averagerating` 
													JOIN Film 
													ON Film.Name = Averagerating.filmname
													order by Averagerating.rating"
										);
			 while($row = mysqli_fetch_array($result)){

			 echo "[".$row['rating'].",".$row['boxoffice']."],";
			 }
			 ?>
		]);


        var options = {
          hAxis: {title: 'Rating', minValue: 0, maxValue: 10},
          vAxis: {title: 'Box Office', minValue: 0, maxValue: 15},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('scatterchart'));

        chart.draw(data, options);
      }
</script>

</script>

</body>
</html>
 <?php
mysql_close($con);
} 
?>