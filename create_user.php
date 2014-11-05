hi

<html><head></head><body>

<?php
echo "<p>hiiiii</p>";
//connecting

$link=mysqli_connect('localhost','awu3','hellomysql');
if($link->connect_errno){
	echo "Problem ".$link->connect_errno.": ".$link->connect_error;
	die();
}

//use database awu3
mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("insert into users(username) values(?);"//,first_name,last_name,school,major,graduation_time,created) values(?,?,?,?,?,?);");

//bind
$statement->bind_param("s"/*ssssiss"*/,$_POST['username');//,'first_name','last_name','school','major','graduation'],$today);

//execute
$statement->execute();

//close
mysqli_close($link);
?>


</body>
</html>
