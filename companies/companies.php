<?php 
//connecting
session_start();
$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Alex Wu , Ethan Chen">
		<meta name="description" content="Prepare for technical interviews.">
		<title>For all your interviewing needs.</title>

        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>

    </head>
	<body>
	   <div class="header-container">
            <header class="wrapper clearfix">
                <a href="../index.php"><h1 class="title">EmployMe</h1></a>
                <nav>
                    <ul>
                        <li><a href="../post/user_post.php">post</a></li>                        		<?php
								if(isset($_SESSION["user"])){
									//echo "Welcome " . $_COOKIE["user"] . "!\n";
									?>

									<li><a href="<?php echo "../users/user.php?user=".$_SESSION['user']; ?>">your account</a></li>
					                <li><a href="../users/log_out.php">sign out</a></li>
					                <?php
									/*echo "Welcome ".$_SESSION["user"]."!\n";
									echo "\n";
									echo '<form action="users/log_out.php"><input type="submit" value="Log Out"></form>';
									echo '<form action="users/edit_user.php"><input type="submit" value="Edit Account"></form>';
									*/
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

	<div class="button-nav">
	    <a href="#">
		<button class="btn ">Companies</button>
	    </a>
	    <a href="../topics/topics.php">
		<button class="btn ">Topics</button>
	    </a>
	    <a href="../questions/questions.php">
		<button class="btn ">Questions</button>
	    </a>
	</div>


		<!-- banner for the site-->
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<?php
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
/*
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
*/
mysqli_free_result($companies);

mysqli_close($link);

?>
