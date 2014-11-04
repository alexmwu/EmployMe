<?php
session_start();
if(isset($_SESSION['views'])){
$_SESSION['views'] = $_SESSION['views']+1;
}else{
$_SESSION['views'] = 1;
}
?>
<html>
<body>
<form action="ageaction.php" method="get">
<input name="age"/>
</form>
<?php
$age = $_GET["age"];
?>
You are <?php echo $age;?> years old.
<br/>
You have visited this page <?=$_SESSION['views'];?> time(s).
<table border="1">
<?php
for ($i=0; $i<$age; $i++){

echo '<tr><td>candle</te> </tr>';

}
?>
</table>
</body>
</html>
