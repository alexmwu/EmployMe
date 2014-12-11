<?php 
//connecting
session_start();
$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query for all questions
//$question_query = "select * from questions where question_id=".intval($_GET['id']).";";
$question_id=intval($_GET['id']);
$questions = $link->prepare("SELECT * from questions where question_id=?");
$questions->bind_param('i',$question_id);
$questions->execute();
$question = $questions->get_result();

//$comment_query = "select * from comments where question_id=".intval($_GET['id']).";";
//$comments = $link->query($comment_query) or die ('Comment Query Failed');
/*
$comments = $link->prepare("SELECT * from comments where question_id=?");
$comments->bind_param('i',$question_id);
$comments->execute();
$comment = $comments->get_result();
*/

//$answer_query = "select * from answers where question_id=".intval($_GET['id']).";";
//$answers = $link->query($answer_query) or die ('Answer Query Failed');

$answers_query = $link->prepare("SELECT * from answers where question_id=?");
$answers_query->bind_param('i',$question_id);
$answers_query->execute();
$answers = $answers_query->get_result();

//$tuple = mysqli_fetch_array($questions, MYSQL_ASSOC);
?>

</head>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Alex Wu , Ethan Chen">
		<meta name="description" content="Template.">
		<title><?php 
		if($tuple['title']!=NULL){
			echo $tuple['title'];
		}
		else{
			echo $tuple['content'];
		}
		?></title>

        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>

    </head>
	<body>
	    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<?php
while ($tuple = $question->fetch_assoc()) {
    // do something with $row
	echo '<div id="question">';
	echo '<div>';
	echo '<p>';
	if($tuple['title']!=null) echo $tuple['title'].'<br>';
	else echo 'No Title'.'<br>';
	echo "Asked by: ".$tuple['username'].'<br>';
	echo '<div id="questionContent">';
	echo $tuple['content'];
	echo '</div>';
//	echo $tuple['votes'].'<br>';
	echo $tuple['modified'].'<br>';
	echo '</p>'; 
	echo '</div>';
}

if(isset($_SESSION['user'])){
	?>
		<form id="editQuestion">
			<button onClick="<?php echo "userEditPost(0,".$_GET['id'].")";?> ">
			Edit Question</button>
		</form>
	<?php
}

/*
$answercomments=array();
while($tuple = mysqli_fetch_array($comments, MYSQL_ASSOC)){
	if($tuple){
		if($tuple['answer_id']==NULL){
			echo '<div>';
			echo '<p>';
			echo "Posted by: ".$tuple['username'].'<br>';
			echo $tuple['content'].'<br>';
		//	echo $tuple['votes'].'<br>';
			echo '</p>';
			echo '</div>';
		}
		else{
			$answercomments[]=$tuple;
		}
	}
echo '</div>';
}

if(isset($_SESSION['user'])){
?>
<form>
	<input type="textbox" name="addQuestionComment">
	<input type="button" value="Add Comment">
</form>
<?php
}
*/

echo '<div>';
while($answer = $answers->fetch_assoc()) {
	if($answer){
		echo '<div>';
		echo '<p>';
		echo $answer['title'].'<br>';
		echo "Answered by: ".$answer['username'].'<br>';
		echo $answer['content'].'<br>';
	//	echo $answer['votes'].'<br>';
		echo $answer['modified'].'<br>';
		echo '</p>'; 
		echo '</div>';
	}
/*	if(isset($_SESSION['user'])){
	?>
		<form id="editAnswer">
			<button onClick="<?php echo "userEditPost(0,".$_GET['id'].")";?> ">
			Edit Question</button>
		</form>
	<?php
	}
	foreach($answercomments as $comment){
		if(intval($comment['answer_id'])==intval($answer['answer_id'])){
			echo '<div>';
			echo '<p>';
			echo "Posted by: ".$comment['username'].'<br>';
			echo $comment['content'].'<br>';
		//	echo $comment['votes'].'<br>';
			echo '</p>';
			echo '</div>';	
		}
	}*/
}
echo '</div>';

/*if(isset($_SESSION['user'])){
	?>
<form>
	<input type="textbox" name="addAnswerComment">
	<input type="button" value="Add Comment">
</form>
<?php
}*/

//<input type="textbox" name="editQuestionContent" placeholder="'+questionContent+'">
//<input type="button" value="Edit Question" onClick="post(0,'+page_id+',this.form)">'

if(isset($_SESSION['user'])){
	?>
<form>
	<input type="textbox" name="editAnswer" placeholder="Answer the Question">
	<input type="button" value="Add Answer" onclick="<?php echo "post(1,".$_GET['id'].",this.form)";?> ">
</form>
<?php
	}



mysqli_close($link);

?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>
	</body>
</html>