<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to server.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("INSERT INTO users (username,first_name,last_name,school,major,score,graduation_time,created) values(?,?,?,?,?,?,?,?);");

//bind
$init=0;
$statement->bind_param("sssssiss",$_POST['username'],$_POST['first_name'],$_POST['last_name'],$_POST['school'],$_POST['major'],$init,$_POST['graduation'],$today);

//execute
$statement->execute() or die("Username already exists");

//close
mysqli_close($link);
?>
