<?php 
session_start();
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query
$content = mysqli_real_escape_string($link,htmlentities($_POST['content']));



$question_query = "select * from questions where content like '%".$content."%';";

$questions = $link->query($question_query) or die ('Question Query Failed');

echo "Search Results:".'<br>';
while($question = mysqli_fetch_array($questions, MYSQL_ASSOC)){
	?>
		<a href="question.php?id=<?php echo $question['question_id'];?>">
		<?php 
			echo $question['content'].'<br>'.'<br>';
			?>
		</a>
	<?php
}

mysqli_close($link);
?>