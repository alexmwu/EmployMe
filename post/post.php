<?php 
session_start();
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query
$post_type = mysqli_real_escape_string($link,htmlentities($_POST['post_type']));
$page_id = mysqli_real_escape_string($link,htmlentities($_POST['page_id']));
$content = mysqli_real_escape_string($link,htmlentities($_POST['content']));



/*
$question_query = "select * from questions where question_id=".intval($_GET['id']).";";
$questions = $link->query($question_query) or die ('Question Query Failed');

$comment_query = "select * from comments where question_id=".intval($_GET['id']).";";
$comments = $link->query($comment_query) or die ('Comment Query Failed');

$answer_query = "select * from answers where question_id=".intval($_GET['id']).";";
$answers = $link->query($answer_query) or die ('Answer Query Failed');

$tuple = mysqli_fetch_array($questions, MYSQL_ASSOC);
*/

//$question_query = "update questions set content='"+$content+"' where question_id="+$page_id+";";
if($post_type=="editq"){
	$statement=$link->prepare("UPDATE questions set content=? where question_id=?;") or die("Can't prepare");

	$statement->bind_param("si",$content,$page_id) or die("Can't bind params for question update");

	$statement->execute() or die("Question does not exist");

	//$questions = $link->query($question_query) or die ('Question Query Failed');
}
else if($post_type=="addans"){
	 $statement = $link->prepare("INSERT into answers (username,question_id,content) values(?,?,?)");

	 $statement->bind_param("sis",$_SESSION['user'],$page_id,$content) or die("Can't bind params for answer insert");

	 $statement->execute() or die("Answer query failed");
	 
}
mysqli_close($link);
?>