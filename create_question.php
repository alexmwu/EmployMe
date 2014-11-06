<?php

//connecting

$link=mysqli_connect('localhost','awu3','hellomysql','awu3') or die("Problem connecting to server.");

//use database awu3
//mysql_select_db('awu3') or die('Could not use database!');

//prepare statement
$today=date("Y/m/d");
$statement=$link->prepare("INSERT INTO questions (username,content,difficult_stars,difficult_votes,company_id,created,title) values(?,?,?,?,?,?,?);");

//bind
$init=0;
$statement->bind_param("ssiiiss",$_SESSION['username'],$_POST['content'],$init,$init,$init/*query for company id here*/,$today,$_POST['title']);
//need to work on query for company id


//execute
$statement->execute() or die("Failed to post question.");

//close
mysqli_close($link);
?>
