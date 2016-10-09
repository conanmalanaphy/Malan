<?php session_start(); ?>
<?php

$DB_host = "conanmalanaphynet.ipagemysql.com";
$DB_user = "cmalanaphy_1";
$DB_pass = "malanaphy1";
$DB_name = "alexis_1";

try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 $e->getMessage();
}
?>
<?php

	if(!isset($_SESSION['user_id'])){
		header ('Location: NoLogin');
	}
else{ ?>

<html>
<head>
	<link rel="icon" href="http://conanmalanaphy.net/image/M.png">
	<title>Malan - Rate a Film</title>
	<link rel="stylesheet" href="css/mainbackground.css">
	<link rel="stylesheet" href="css/rating.css">
<script language="javascript" type="text/javascript" src="jquery-3.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
 $(".film").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;
 
  $.ajax
  ({
   type: "POST",
   url: "Get_Actor.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
      $(".actor").html(html);
   } 
   });
  });
 
});
</script>
</head>
<body>
	<?php include("header.php"); 
	?>
	<div class="container">
		<div class="user-box">
			<h1>Rate a Film</h1>
			
				<div class="user-box2">
					
							<form action="Insertrating.php" method="post">
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
										<td> 
											<input type= "text" name="film" class="film" placeholder="Film" list = "filmlist">
												<datalist id = "filmlist" >
													<?php
														$stmt = $DB_con->prepare("SELECT * FROM Film");
														$stmt->execute();
														while($row=$stmt->fetch(PDO::FETCH_ASSOC))
														{
														?>
															<option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
														<?php
														} 
														?></datalist>
										</td>
									</tr>
									<tr>
										<td> Actor:</td>
										<td>
										<select name="actor" class="actor">
											
											</select>
										</td>
									</tr>
						
									<tr>
										<td>Rating: </td>
										<td><input type="number" name="rating" min="0" max="10" placeholder="0 - 10" /> </td>
									</tr>
									<tr>
										<td>Comment</td>
										<td><input type="text" name="comment" placeholder="comment">
										</td>
							
									</tr>
									<tr>
										<td> </td>
										<td><input type="submit" /></form></td>
							
									</tr>
									<tr>
										<td></td>
										<td><div class="form-errors">
												<?php
													if (isset($_SESSION['ratingerrors'])): ?>
														<?php foreach($_SESSION['ratingerrors'] as $error): ?>
															<p><?php echo $error ?></p>
														<?php endforeach; ?>
												<?php endif; ?>	
											</div>
										</td>
							
									</tr>
								</tbody>
							</table>
				
							
							
						

						
							

				
				
			</div>
			<div class="user-box3">
				<div class="user-box-table">
					
				 <input type="image" src="image/R.png" id="display"/>		
						<div id="responsecontainer" align="center"> 
								

				</div>
					
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="jquery-3.1.0.min.js"> </script>

<script type="text/javascript">

 $(document).ready(function() {   //checks the document is safe and ready for js to use

    $("#display").click(function() {                //execute this every time the display is pressed 

      $.ajax({    //create an ajax request to randomfilm.php
        type: "GET",   // load data from the server
        url: "Randomfilm.php",             
        dataType: "text",   //expect text format to be returned            
        success: function(response){  
              $response1=  response;
            $("#responsecontainer").html($response1); //updates the container with the new info if succesful
        }

    });
});
});

</script>
	
</body>
</html>
<?php
}
?>