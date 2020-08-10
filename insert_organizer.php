<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["posalji"])){


$ime= $_POST["ime"];

$prezime= $_POST["prezime"];

$email= $_POST["email"];



$predlagac= $_POST["predlagac"];

$telefon= $_POST["telefon"];

$broj_lk= $_POST["broj_lk"];


}



$sql = "INSERT INTO organizer_administrator SET

name='$ime',

surname='$prezime',

email='$email',

phone_number='$telefon',

id_number='$broj_lk',

recommended_by_organizer='$predlagac'


";


mysqli_query($link,$sql);

mysqli_close($link);

//vracanje na sign.html
 $newURL = "admin.html";
header('Location: '.$newURL);
die(); 



?>