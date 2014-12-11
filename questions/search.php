<?php 
session_start();
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query
$content = mysqli_real_escape_string($link,htmlentities($_POST['content']));
$like='%'.$content.'%';
$questions_query = $link->prepare("SELECT * from questions where content like ?;");
$questions_query->bind_param('s',$like);
$questions_query->execute();
$questions = $questions_query->get_result();


//$question_query = "select * from questions where content like '%".$content."%';";
//$questions = $link->query($question_query) or die ('Question Query Failed');

echo "Search Results:".'<br>';
while ($question = $questions->fetch_assoc()) {
	?>
		<a href="question.php?id=<?php echo $question['question_id'];?>">
		<?php 
			if($question['title']!=null){
				echo $question['title'];
			}
			else{
				echo $question['content'];
			}
			?>
		</a><br><br>
	<?php
}

mysqli_close($link);
?>