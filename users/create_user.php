<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
date_default_timezone_set('America/New_York');
date_default_timezone_get();
$today=date("Y/m/d");
$statement=$link->prepare("INSERT INTO users (username,password,first_name,last_name,school,major,score,graduation_time,created) values(?,?,?,?,?,?,?,?,?);");

//bind
$init=0;
$password=hash('sha512',$_POST['password']);
$statement->bind_param("ssssssiss",$_POST['username'],$password,$_POST['first_name'],$_POST['last_name'],$_POST['school'],$_POST['major'],$init,$_POST['graduation'],$today);

//execute
$statement->execute() or die("Username already exists");

//header("Location: ../index.php");
die();

//close
mysqli_close($link);
?>
