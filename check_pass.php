<?php 

//connecting


$link = mysqli_connect('localhost', 'awu3', 'hellomysql', 'awu3') or die("Problem connecting to database.");



//query
$uname=$_POST['username'];
$pword=$_POST['password'];


$query = $link->prepare("select password FROM users where username = ? LIMIT 1");

if ($query) {
  $query->bind_param('i',$uname);
  $query->execute();
  $query->bind_result($stored_pw);
  echo $stored_pw;
}

#echo $query;

#$result = $link->query($query) or die ('Query Failed');


#echo '<table border = "1">';
#while($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)){
#echo '<tr>';
#        foreach($tuple as $colvalue){
#                echo '<td>'.$colvalue.'</td>';
#        }
#echo '</tr>';
#}
#echo '</table>';

mysqli_free_result($result);

mysqli_close($link);

?>
