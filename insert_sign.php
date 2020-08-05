<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["posalji"])){

$ime = $_POST["ime"];
echo $ime.'<br>';
$prezime = $_POST["prezime"];
echo $prezime.'<br>';
$email=$_POST["email"];
echo $email.'<br>';
$tel = $_POST["tel"];
echo $tel.'<br>';
$broj_lk = $_POST["broj_lk"];
echo $broj_lk.'<br>';

$lokacija=$_POST["lokacije"]

$termini=$_POST["termini"];




$preuzet=$_POST["preuzet"]
$javno=$_POST["javno"];
$obavestenja=$_POST['obavestenja'];
}



$sql = "INSERT INTO sign SET
name='$ime',
surname='$prezime',
phone_number='$tel',
email='$email',
id_number='$broj_lk',
location_id='$lokacija',
Number_Of_Appointments='1',
Appointments='$termini',
Email_Info='$obavestenja[0]',
Public_Signature='$javno[0]';
";


mysqli_query($link,$sql);

mysqli_close($link);

//vracanje na sign.html
 $newURL = "sign.html";
header('Location: '.$newURL);
die(); 



?>