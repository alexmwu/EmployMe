<?php
session_start()
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

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>

    </head>
	<body>
	    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <a href="index.php"><h1 class="title">EmployMe</h1></a>
                <nav>
                    <ul>
                        <li><a href="questions/questions.php">questions</a></li>                        		<?php
								if(isset($_SESSION["user"])){
									//echo "Welcome " . $_COOKIE["user"] . "!\n";
									?>

									<li><a href="<?php echo "users/user.php?user=".$_SESSION['user']; ?>">your account</a></li>
					                <li><a href="users/log_out.php">sign out</a></li>
					                <?php
									/*echo "Welcome ".$_SESSION["user"]."!\n";
									echo "\n";
									echo '<form action="users/log_out.php"><input type="submit" value="Log Out"></form>';
									echo '<form action="users/edit_user.php"><input type="submit" value="Edit Account"></form>';
									*/
								}
								else{
									?>
									<li><a href="users/sign_in.php">sign in</a></li>
					                <li><a href="users/sign_up.php">sign up</a></li>
					                <?php
								}
					?>
                    </ul>
                </nav>
            </header>
        </div>


		<!-- banner for the site-->
		
		
		<div class="main-container">
            <div class="main">
                <img class="center cover" src="img/bad_interview_questions.jpg">
                <a href="questions/questions.php"><button class="btn center"> challenge me! </button></a>
            </div>
            <div class="main grey">
                <div class="main wrapper clearfix">
                    <article>
                        <h1>"This site rocks!" - Mark Zuckerberg</h1>
                    </article>
                </div>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <!--foother here-->
        <div class="footer-container">
            <footer class="wrapper">
                <ul>
                    <li><a href="#"><strong>EmployMe</strong></a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li>© 2014 EmployMe</li>
                </ul>
            </footer>
        </div>



        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>
    </body>
</html>

