<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["posalji"])){


$ime= $_POST["naziv"];

$grad= $_POST["grad"];

$opstina= $_POST["opstina"];

$ulica= $_POST["ulica"];

}



$sql = "INSERT INTO location SET

name='$naziv',

city='$grad',

municipality='$opstina',

street='$ulica'


";


mysqli_query($link,$sql);

mysqli_close($link);

//vracanje na sign.html
 $newURL = "sign.html";
header('Location: '.$newURL);
die(); 



?>