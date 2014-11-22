<?php 

//connecting

$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");

//query
$query = 'SELECT title,username,content,difficult_stars,difficult_votes,modified from questions;';
$result = $link->query($query) or die ('Query Failed');


while($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)){
echo '<div>';

echo $tuple['content'].'<br>';
        
echo '</div>';
}


mysqli_free_result($result);

mysqli_close($link);

?>
