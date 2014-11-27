<?php
session_start();
//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to database.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
date_default_timezone_set('America/New_York');
date_default_timezone_get();
$today=date("Y/m/d");
$statement=$link->prepare("INSERT INTO questions (username,content,company_id,created,title) values(?,?,?,?,?);");

//find username
if(isset($_SESSION['user'])){
	$user=$_SESSION['user'];}
else{
	$user='guest';
}

//bind
$init=0;
$statement->bind_param("ssiss",$user,$_POST['content'],$init/*query for company id here*/,$today,$_POST['title']);
//need to work on query for company id


//execute
$statement->execute() or die("Failed to post question.");


//close
mysqli_close($link);
?>
