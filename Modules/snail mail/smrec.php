<?php
function Connect_TO_Server()
		{
			$usernamedb="root";
			$passworddb="nikunj";
			$server=$_SERVER['SERVER_ADDR'];
			$db_handle=mysql_connect($server,$usernamedb,$passworddb);
			return $db_handle; 
		}
		function Connect_TO_DB()
		{
			$database="sen";
			$db_found = mysql_select_db($database);
			if(!$db_found)
			{
				print "error in connection to database";
			}
			echo nl2br("\n");
		}
		function Close_To_Server($db_handle)
		{
			mysql_close($db_handle);
		}
?>
<?php
//include ('sen/databasefun.php');
$db=Connect_To_Server();
$db_found=Connect_To_DB();
?>
<?php
/// this page is for getting  snail mail at user side.......................................................
 //by nikunj amipara,
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>snail mail reterive for admin </title>
</head>

<body>
<?php
//3/ perform database query
//user name wwhich has to be fatched from session array
$userid = $_POST['id'];


//temp assignment of userid need to be removed when assembled
//$userid="201001199" ;

$result = mysql_query("SELECT * FROM snail_mail where id= $userid and received_status = false",$db);
if(!$result){
		die("database selection failed:".mysql_error());
	}
//4. use returned data
echo '<table border="1">';
echo "<tr>";
	echo "<td>snail_mail_id</td>";
	echo "<td>date</td>";
	echo "<td>time</td>";
	echo "<td>sentby</td>";
	
while($row = mysql_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row["snail_mail_id"] . "</td>";
	echo "<td>" . $row["date"] . "</td>";
	echo "<td>" . $row["time"] . "</td>";
	echo "<td>" . $row["sentby"] ."</td>";
	
	echo "<br/>";
	
	
	
	
	echo "</tr>";

}
echo "</table>";
echo '<br/>';

// this is  how admin can update status of snamil mail.

?>
<form action="smrec1.php" method="post">
	<b>Enter snail mail id for which u want to update status to received</b>
	<input type="text" name="smid" size=10 /><br />
    <input type="submit" />


</form>
</body>
</html>
<?php
//5. close connection

mysql_close($db);


?>