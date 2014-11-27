<?php
session_start();
//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//prepare statement
date_default_timezone_set('America/New_York');
date_default_timezone_get();
$today=date("Y/m/d");
$statement=$link->prepare("DELETE FROM users WHERE username = ?;");

//bind
$init=0;
//$statement->bind_param("s",$_COOKIE['user']);
$statement->bind_param("s",$_SESSION['user']);


//execute
$statement->execute() or die("Username does not exist");

//unset($_COOKIE['user']);
session_destroy();
header("Location: index.php");
//close
mysqli_close($link);
?>
