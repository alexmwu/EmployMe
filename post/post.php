
<?php 
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query
$post_type = mysqli_real_escape_string(htmlentities($_POST['post_type']));
$page_id = mysqli_real_escape_string(htmlentities($_POST['page_id']));
$content = mysqli_real_escape_string(htmlentities($_POST['content']));
echo $post_type;
/*
$question_query = "select * from questions where question_id=".intval($_GET['id']).";";
$questions = $link->query($question_query) or die ('Question Query Failed');

$comment_query = "select * from comments where question_id=".intval($_GET['id']).";";
$comments = $link->query($comment_query) or die ('Comment Query Failed');

$answer_query = "select * from answers where question_id=".intval($_GET['id']).";";
$answers = $link->query($answer_query) or die ('Answer Query Failed');

$tuple = mysqli_fetch_array($questions, MYSQL_ASSOC);
*/



mysql_query(" UPDATE ratings(vote) VALUES ('$rating') WHERE id = '$page_id' ");