<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
$statement=$link->prepare("INSERT INTO companies (name,about) values(?,?);");

//bind
$statement->bind_param("ss",$_POST['name'],$_POST['about']);
//need to work on query for company id


//execute
$statement->execute() or die("Failed to add company.");

//close
mysqli_close($link);
?>
