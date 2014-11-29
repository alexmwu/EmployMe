<?php 
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query for all questions
$question_query = "select * from questions where question_id=".intval($_GET['id']).";";
$questions = $link->query($question_query) or die ('Question Query Failed');

$comment_query = "select * from comments where question_id=".intval($_GET['id']).";";
$comments = $link->query($comment_query) or die ('Comment Query Failed');

$answer_query = "select * from answers where question_id=".intval($_GET['id']).";";
$answers = $link->query($answer_query) or die ('Answer Query Failed');

$tuple = mysqli_fetch_array($questions, MYSQL_ASSOC);
?>

<html>
	<head>
<meta charset="utf-8">
		<meta name="author" content="Alex Wu , Ethan Chen">
		<meta name="description" content="Template.">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1" />
		<title><?php 
		if($tuple['title']!=NULL){
			echo $tuple['title'];
		}
		else{
			echo $tuple['content'];
		}
		?></title>
	</head>

	<body>
	

<?php
echo '<div>';
	echo '<div>';
	echo '<p>';
	echo $tuple['title'].'<br>';
	echo "Asked by: ".$tuple['username'].'<br>';
	echo $tuple['content'].'<br>';
	echo $tuple['votes'].'<br>';
	echo $tuple['modified'].'<br>';
	echo '</p>'; 
	echo '</div>';

	$tuple = mysqli_fetch_array($comments, MYSQL_ASSOC);
	if($tuple['answer_id']==NULL){
		echo '<div>';
		echo '<p>';
		echo "Posted by: ".$tuple['username'].'<br>';
		echo $tuple['content'].'<br>';
		echo $tuple['votes'].'<br>';
		echo '</p>';
		echo '</div>';	
	}
echo '</div>';
?>

<form>

<?php

echo '<div>';
	$answer = mysqli_fetch_array($answers, MYSQL_ASSOC);
	if($answer){
		echo '<div>';
		echo '<p>';
		echo $answer['title'].'<br>';
		echo "Answered by: ".$answer['username'].'<br>';
		echo $answer['content'].'<br>';
		echo $answer['votes'].'<br>';
		echo $answer['modified'].'<br>';
		echo '</p>'; 
		echo '</div>';

		$comment = mysqli_fetch_array($comments, MYSQL_ASSOC);
		if($comment['answer_id']==$answer['answer_id']){
			echo '<div>';
			echo '<p>';
			echo "Posted by: ".$comment['username'].'<br>';
			echo $comment['content'].'<br>';
			echo $comment['votes'].'<br>';
			echo '</p>';
			echo '</div>';	
		}
	}
echo '</div>';

mysqli_free_result($questions);

mysqli_close($link);

?>

	</body>
</html>

