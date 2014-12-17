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
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Alex Wu , Ethan Chen">
	<meta name="description" content="Prepare for technical interviews.">
	<title>Post Question</title>
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

<?php
$companies_query = $link->prepare("SELECT * from companies");
$companies_query->execute();
$companies = $companies_query->get_result();

$topics_query = $link->prepare("SELECT * from topics");
$topics_query->execute();
$topics = $topics_query->get_result();
?>

<div id="login">
  <h1>post question</h1>
  <form action="create_question.php" method="post">
    <textarea type="textbox" name="title" placeholder="title" class="post"></textarea>
    <br><br>
    <textarea type="textbox" name="content" placeholder="what do you want to ask?" class="post"></textarea>
    <br>
    <select name="company_id">
	<option value="">select a company</value>
	<?php
	while($company=$companies->fetch_assoc()){
		echo '<option value="'.$company['company_id'].'">'.$company['name'].'</option>';
	}
?>
    </select>
    <br><br>
    <select name="topic_id">
	<option value="">select a topic</value>
	<?php
	while($topic=$topics->fetch_assoc()){
		echo '<option value="'.$topic['topic_id'].'">'.$topic['name'].'</option>';
        }
?>  
    </select>
    <br><br>
    <input type="submit" value="submit"/>
  </form>
</div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>
	</body>
</html>


