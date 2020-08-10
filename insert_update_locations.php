
 <?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["posalji"])){

$id=$_POST["id"];
$naziv= $_POST["naziv"];

$grad= $_POST["grad"];

$opstina= $_POST["opstina"];

$ulica= $_POST["ulica"];

$x= $_POST["x_koordinata"];

$y= $_POST["y_koordinata"];


}



$sql = "UPDATE location SET

name='$naziv',

city='$grad',

municipality='$opstina',

street='$ulica',

x_coordinate='$x',

y_coordinate='$y'

WHERE location_id=$id;

";


mysqli_query($link,$sql);

mysqli_close($link);

 


?>
 
 




