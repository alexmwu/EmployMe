<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("DELETE FROM users WHERE username = ?;");

//bind
$init=0;
$statement->bind_param("s",$_COOKIE['user']);

//execute
$statement->execute() or die("Username does not exist");

unset($_COOKIE['user']);

//close
mysqli_close($link);
?>
