<?php
session_start();
//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
//date_default_timezone_set('America/New_York');
//date_default_timezone_get();
//$today=date("Y/m/d");
$password=hash('sha512',$_POST['new_password']);
$statement=$link->prepare("UPDATE users SET password=? WHERE username=?;");
//bind
$init=0;
$statement->bind_param("ss",$password,$_SESSION['user']);

//execute
$statement->execute() or die("Username already exists");

header("Location: ../index.php");
die();

//close
mysqli_close($link);
?>
