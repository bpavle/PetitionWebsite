<?php
session_start();

if (isset($_SESSION["status"])) {
    require_once("config.php");

    if (isset($_POST["posalji"])) {


        $ime = $_POST["naziv"];

        $grad = $_POST["grad"];

        $opstina = $_POST["opstina"];

        $ulica = $_POST["ulica"];

        $x = $_POST["x_koordinata"];

        $y = $_POST["y_koordinata"];
    }

    $id = $_SESSION['id'];


    $sql = "INSERT INTO location SET

name='$ime',

city='$grad',

municipality='$opstina',

street='$ulica',

organizer_id_chose='$id',

organizer_administrator_id='$id',

x_coordinate='$x',

y_coordinate='$y'


";


    mysqli_query($link, $sql);

    mysqli_close($link);

    //vracanje na sign.html
    $newURL = "location_entry.html";
    header('Location: ' . $newURL);
    die();
}