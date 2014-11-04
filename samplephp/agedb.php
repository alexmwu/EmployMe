<html>
<body>
<p>Here are your ages:</p>

<?php

//Connect and select db
$link = mysql_connect('localhost', 'tweninge', 'pw') or die('connection failed');
echo 'Connection Success!!11!!1!!@!!!';

mysql_select_db('tweninge') or die ('DB not found');

//query
$query = 'SELECT * from user_age;';
$result = mysql_query($query) or die ('Query Failed');

echo '<table border = "1">';
while($tuple = mysql_fetch_array($result, MYSQL_ASSOC)){
echo '<tr>';
	foreach($tuple as $colvalue){
		echo '<td>'.$colvalue.'</td>';
	}
echo '</tr>';
}
echo '</table>';


?>

</body>
</html>
