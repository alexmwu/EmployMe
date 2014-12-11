<?php 
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query for all companies
//no need to protect from SQL injections but will add just in case

$companies_query = $link->prepare("SELECT * from companies");
$companies_query->execute();
$companies = $companies_query->get_result();

//$company_query = "select * from companies;";
//$companies = $link->query($company_query) or die('Company Query Failed');

echo '<div>';	//div for left aligned block
while ($tuple = $companies->fetch_assoc()) {
	echo '<a href="../companies/company.php?id='.$tuple['company_id'].'">';
	echo '<div>';
	echo '<p>';
	echo $tuple['name'].'<br>';
//	echo $tuple['about'].'<br>';
	echo '</p>'; 
	echo '</div>';
	echo '</a>';
}

echo '</div>';

//query for all topics

$topics_query = $link->prepare("SELECT * from topics");
$topics_query->execute();
$topics = $topics_query->get_result();

//$topic_query = "select * from topics;";
//$topics = $link->query($topic_query) or die ('Topic Query Failed');

echo '<div>';
while ($tuple = $topics->fetch_assoc()) {
	echo '<a href="../topics/topic.php?id='.$tuple['topic_id'].'">';
	echo '<div>';
	echo '<p>';
	echo $tuple['name'].'<br>';
//	echo $tuple['about'].'<br>';
	echo '</p>'; 
	echo '</div>';	
	echo '</a>';
}
echo '</div>';

//query for all questions

$questions_query = $link->prepare("SELECT * from questions");
$questions_query->execute();
$questions = $questions_query->get_result();

//$questions_query = "select * from questions;";
//$questions = $link->query($question_query) or die ('Question Query Failed');

echo '<div>';	//div for right aligned block
while ($tuple = $questions->fetch_assoc()) {
	echo '<a href="question.php?id='.$tuple['question_id'].'">';
	echo '<div>';
	echo '<p>';
	if($tuple['title']!=null) echo $tuple['title'].'<br>';
	else echo 'No Title'.'<br>';
	echo $tuple['username'].'<br>';
	echo $tuple['content'].'<br>';
	echo $tuple['votes'].'<br>';
	echo $tuple['modified'].'<br>';
	echo '</p>'; 
	echo '</div>';
	echo '</a>';
}
echo '</div>';

mysqli_free_result($questions);

mysqli_close($link);

?>
