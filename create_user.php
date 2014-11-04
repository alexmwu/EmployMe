<?php

//connecting

$link=mysqli_connect('localhost','awu3','pw','hellomysql');
if($link->connect_errno){
	echo "Problem ".$link->connect_errno.": ".$link->connect_error;
}

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("insert into users(username,first_name,last_name,school,major,graduation_time,created) values(?,?,?,?,?,?);");

//bind
$statement->bind_param("sssssiss",$_POST['username','first_name','last_name','school','major','graduation'],$today);

//execute
$statement->execute();

//close
mysqli_close($link);
?>