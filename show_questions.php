<p></p>

<?php 

//connecting

$link = mysqli_connect('localhost', 'tweninge', 'pw', 'tweninge');
if($link->connect_errno){
	echo "problem" . $link->connect_errno . ': ' . $link->connect_error;
}

//prepare stament
$stmt = $link->prepare("insert into user_age (age) values (?);");

//bind parameters
$stmt->bind_param("i", $_GET['age']);

$stmt->execute();

//query
$query = 'SELECT age from user_age;';
$result = $link->query($query) or die ('Query Failed');

echo '<table border = "1">';
while($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)){
echo '<tr>';
        foreach($tuple as $colvalue){
                echo '<td>'.$colvalue.'</td>';
        }
echo '</tr>';
}
echo '</table>';

mysqli_free_result($result);

mysqli_close($link);

?>
