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
if($_POST['id'])
{
 $id=$_POST['id'];
  
 $stmt = $DB_con->prepare("SELECT * FROM Film WHERE Name=:id");
 $stmt->execute(array(':id' => $id));
 ?><?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
<option value="<?php echo $row['Actor1']; ?>"><?php echo $row['Actor1']; ?></option>
<option value="<?php echo $row['Actor2']; ?>"><?php echo $row['Actor2']; ?></option>
<option value="<?php echo $row['Actor3']; ?>"><?php echo $row['Actor3']; ?></option>
        <?php
 }
}
?>