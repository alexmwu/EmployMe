<?php 
session_start();
//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query
$content = mysqli_real_escape_string($link,htmlentities($_POST['content']));
$like='%'.$content.'%';
$questions_query= $link->prepare("SELECT * from questions where content like ?;");
$questions_query->bind_param('s',$like);
$questions_query->execute();
$questions = $questions_query->get_result();

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Alex Wu , Ethan Chen">
	<meta name="description" content="Prepare for technical interviews.">
		<title>Search: <?php echo $_POST['content'];?></title>

        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>

    </head>
	<body>
	    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<div class="header-container">
            <header class="wrapper clearfix">
                <a href="../index.php"><h1 class="title">EmployMe</h1></a>
                <nav>
                    <ul>
                        <li><a href="questions.php">all</a></li>                                       <?php
                                                                if(isset($_SESSION["user"])){
                                                                        //echo "Welcome " . $_COOKIE["user"] . "!\n";
                                                                        ?>

                                                                        <li><a href="../users/edit_user.php">edit account</a></li>
                                                        <li><a href="../users/log_out.php">sign out</a></li>
				<?php
                                                                }
                                                                else{
                                                                        ?>
                                                                        <li><a href="../users/sign_in.php">sign in</a></li>
                                                        <li><a href="../users/sign_up.php">sign up</a></li>
                                                        <?php
                                                                }
                                        ?>
                    </ul>
                </nav>
            </header>
        </div>
	<br>
<?php

echo "Search Results:".'<br>';
while ($question = $questions->fetch_assoc()) {
	?>
	<div class="search">
		<br>
		<a href="question.php?id=<?php echo $question['question_id'];?>">
		<?php 
			if($question['title']!=null){
				echo $question['title'];
			}
			else{
				echo $question['content'];
			}
			?>
		</a>
	</div>
	<?php
}

mysqli_close($link);
?>
