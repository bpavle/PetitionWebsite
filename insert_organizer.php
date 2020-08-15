<?php

session_start();

if (isset($_SESSION["status"])) {
    require_once("config.php");
    $id = $_SESSION["id"];
    if (isset($_POST["posalji"])) {


        $ime = $_POST["ime"];

        $prezime = $_POST["prezime"];

        $email = $_POST["email"];



        /* $predlagac= $_POST["predlagac"]; */

        $sifra = $_POST["sifra"];
        $telefon = $_POST["telefon"];

        $broj_lk = $_POST["broj_lk"];
    }



    $sql = "INSERT INTO organizer_administrator SET

name='$ime',

surname='$prezime',

email='$email',

phone_number='$telefon',

id_number='$broj_lk',

password = '$sifra',

recommended_by_organizer_id=$id;


";


    mysqli_query($link, $sql);

    mysqli_close($link);

    //vracanje na sign.html
    $newURL = "organizer.html";
    header('Location: ' . $newURL);
    //die(); 

}