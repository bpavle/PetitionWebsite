<?php
session_start();
if (isset($_SESSION["status"])) {
    $id = $_SESSION["id"];

    require_once("config.php");

    if (isset($_POST["posalji"])) {

        $naslov = $_POST["naslov"];

        $datum = $_POST["datum"];


        $vest = $_POST["message"];
    }



    $sql = "INSERT INTO news SET

title='$naslov',
date='$datum',
content='$vest',
organizer_administrator_id=$id;                           # -mora da postoji id organizatora da bi radilo  

";


    mysqli_query($link, $sql);

    mysqli_close($link);

    //vracanje na sign.html
    $newURL = "news.html";
    header('Location: ' . $newURL);
    //die();
}