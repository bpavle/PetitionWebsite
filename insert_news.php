<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["posalji"])){

$naslov = $_POST["naslov"];

$datum = $_POST["datum"];


$vest=$_POST["message"];

}



$sql = "INSERT INTO news SET

title='$naslov',
date='$datum',
content='$vest',
# organizer_administrator_id=1 -mora da postoji id organizatora da bi radilo  

";


mysqli_query($link,$sql);

mysqli_close($link);

//vracanje na sign.html
 $newURL = "admin.html";
header('Location: '.$newURL);
die(); 



?>