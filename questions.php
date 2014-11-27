<?php 
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query for all companies
$company_query = "select * from companies;";
$companies = $link->query($company_query) or die('Company Query Failed');
echo '<div>';	//div for left aligned block
while($tuple = mysqli_fetch_array($companies, MYSQL_ASSOC)){
	echo '<div>';
	echo '<p>';
	echo $tuple['name'].'<br>';
	echo $tuple['about'].'<br>';
	echo '</p>'; 
	echo '</div>';	
}

echo '</div>';

//query for all topics
$topic_query = "select * from topics;";
$topics = $link->query($topic_query) or die ('Topic Query Failed');
echo '<div>';
while($tuple = mysqli_fetch_array($topics, MYSQL_ASSOC)){
	echo '<div>';
	echo '<p>';
	echo $tuple['name'].'<br>';
	echo $tuple['about'].'<br>';
	echo '</p>'; 
	echo '</div>';	
}
echo '</div>';

//query for all questions
$question_query = "select * from questions;";
$questions = $link->query($question_query) or die ('Question Query Failed');

echo '<div>';	//div for right aligned block
while($tuple = mysqli_fetch_array($questions, MYSQL_ASSOC)){
	echo '<div>';
	echo '<p>';
	echo $tuple['title'].'<br>';
	echo $tuple['username'].'<br>';
	echo $tuple['content'].'<br>';
	echo $tuple['votes'].'<br>';
	echo $tuple['modified'].'<br>';
	echo '</p>'; 
	echo '</div>';
}
echo '</div>';

mysqli_free_result($questions);

mysqli_close($link);

?>
