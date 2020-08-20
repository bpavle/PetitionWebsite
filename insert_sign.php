<?php

require_once("config.php");

if (isset($_POST["posalji"])){

    $x=1;
    $termini="";
  
    if(isset($_POST["termin1"])){
        $termini = $termini.$_POST["termin1"].";";
    }
    if(isset($_POST["termin2"])){
        $termini = $termini.$_POST["termin2"].";";
    }
    if(isset($_POST["termin3"])){
        $termini = $termini.$_POST["termin3"].";";
    }
    if(isset($_POST["termin4"])){
        $termini = $termini.$_POST["termin4"].";";
    }
    if(isset($_POST["termin5"])){
        $termini = $termini.$_POST["termin5"].";";
    }
    if(isset($_POST["termin6"])){
        $termini = $termini.$_POST["termin6"].";";
    }
    if(isset($_POST["termin7"])){
        $termini = $termini.$_POST["termin7"].";";
    }
    if(isset($_POST["termin8"])){
        $termini = $termini.$_POST["termin8"].";";
    }
        


        
       
          
   

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

$lokacija=$_POST["lokacije"];


   

$komentar=$_POST["message"];


$preuzet=$_POST["preuzet"];
$javno=$_POST["javno"];
$obavestenja=$_POST["obavestenja"];
}



$sql = "INSERT INTO sign SET

name='$ime',
surname='$prezime',
phone_number='$tel',
email='$email',
id_number='$broj_lk',
comment='$komentar',
location_id='$lokacija',
appointments='$termini',
email_notification='$obavestenja[0]',
publish='$javno[0]',
taken_over='$preuzet[0]',
number=1

";
echo $sql;

mysqli_query($link,$sql);

mysqli_close($link);

//vracanje na sign.html
/*   $newURL = "sign.html";
header('Location: '.$newURL);
die(); 
  */


?>