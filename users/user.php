<?php 
//connecting
session_start();

$user=$_GET['user'];
var_dump($user);
if($user=$_SESSION['user']){
	$sameuser=1;
}
if(!isset($sameuser)){
	echo "User ".$_SESSION['user']."'s Page"."<br>";
}

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");


$users = $link->prepare("SELECT * from users where username=?");
$users->bind_param('s',$user);
$users->execute();
$user = $users->get_result();
/*
$questions = $link->prepare("SELECT * from questions where username=?");
$questions->bind_param('s',$user);
$questions->execute();
$question = $questions->get_result();


$answers_query = $link->prepare("SELECT * from answers where username=?");
$answers_query->bind_param('s',$user);
$answers_query->execute();
$answers = $answers_query->get_result();
*/

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
if(isset($sameuser)){
	?>
		<a href="edit_user.php">Edit User Account</a>
	<?php
}

while($tuple=$user->fetch_assoc()){
	echo '<div id="user">';
	echo '<p>';
	if($tuple['active']!=1) echo 'This user account has been deactivated.'.'<br>';
	echo $tuple['first_name'].' '.$tuple['last_name'].'<br>';
	echo 'School: '.$tuple['school'].'<br>';
	echo 'Major: '.$tuple['major'].'<br>';
	echo 'Graduation: '.$tuple['graduation_time'].'<br>';
	echo '</p>';
	echo '</div>';
}


while ($tuple = $question->fetch_assoc()) {
    // do something with $row
	echo '<div class="question">';
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

	if(isset($sameuser)){
		?>
			<form id="editQuestion">
				<button onClick="<?php echo "userEditPost(0,".$tuple['question_id'].")";?> ">
				Edit Question</button>
			</form>
		<?php
	}
	echo '</div>';
}



/*

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

}
echo '</div>';
*/


mysqli_close($link);

?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>
	</body>
</html>