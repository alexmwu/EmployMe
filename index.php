<?php
session_start()
?>
<html>
	<head>
<meta charset="utf-8">
		<meta name="author" content="Alex Wu , Ethan Chen">
		<meta name="description" content="Prepare for your next technical interview with EmployMe. Sort by company or by question type.">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1" />
		<title>EmployMe. All your interviewing needs.</title>
	</head>

	<body>
		<!--header here-->
		<?php
			if(isset($_SESSION["user"])){
				//echo "Welcome " . $_COOKIE["user"] . "!\n";

				echo "Welcome ".$_SESSION["user"]."!\n";
				echo "\n";
				echo '<form action="users/log_out.php"><input type="submit" value="Log Out"></form>';
				echo '<form action="users/edit_user.php"><input type="submit" value="Edit Account"></form>';

			}
			else{
				echo '
		<form action="users/sign_in.php"><input type="submit" value="Sign In"></form>
		<form action="users/sign_up.php"><input type="submit" value="Sign Up"></form>';
			}
?>
		<!-- banner for the site-->
		<div class="section" id="banner">
			<form action="questions/post_question.php"><input type="submit" value="Post Question"></form>
			<form action="companies/add_company.php"><input type="submit" value="Add Company"></form>
			<form action="questions/show_questions.php"><input type="submit" value="All Questions"></form>
			<form action="questions/questions.php"><input type="submit" value="Catalog"></form>
			<form action=""><input type="textbox" name="searchBox"><input type="submit" value="Search"></form>
		</div>
		
		<!-- some of the best example questions-->
		<div class="section" id="featured">


		</div>
	
		<!--a blurb on EmployMe-->	
		<div class="section" id="about">

	
		</div>

		<!--foother here-->

	</body>
</html>
