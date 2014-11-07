<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("UPDATE users SET password=? WHERE username=?;");

//bind
$init=0;
$statement->bind_param("ss",$_POST['new_password'],$_COOKIE['user']);

//execute
$statement->execute() or die("Username already exists");

header("Location: index.php");
die();

//close
mysqli_close($link);
?>
