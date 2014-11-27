<?php 

//connecting


$link = mysqli_connect('localhost', 'awu3', 'hellomysql','awu3') or die("Problem connecting to database.");

//mysqli_select_db('awu3') or die('Could not use database');

//query
$username=$_POST['username'];
$password=$_POST['password'];
$pw="";

$query = $link->prepare("SELECT password FROM users where username = ? LIMIT 1");
$query->bind_param('s',$username);
$query->execute() or die("Failed to execute query.");
$query->bind_result($pw);
$query->store_result();
if(!$query->fetch()) die("User " . $username . " does not exist"); 
if($pw!=$password) die("Incorrect username and password");

session_start();
$_SESSION['user']=$username;

//setcookie("user",$username,time()+(86400*30),"/");//keep username for 86400sec (day) * 30= 30 days, works for all directories (/)

header("Location: ../index.php");
die();

mysqli_free_result($result);

mysqli_close($link);
?>
