<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql') or die("Problem connecting to server.");

//use database awu3
mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("insert into users values(username,first_name,last_name,school,major,graduation_time,created) values(?,?,?,?,?,?);");

//bind
$statement->bind_param("sssssiss",$_POST['username'],$_POST['first_name'],$_POST['last_name'],$_POST['school'],$_POST['major'],$_POST['graduation'],$today);

//execute
$statement->execute();

//close
mysqli_close($link);
?>