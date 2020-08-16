<?php


session_start();

if (isset($_SESSION["id"]) && isset($_POST["update"])) {
    require_once("config.php");
    $organizer_id = $_SESSION["id"];
    $i = 1;

    $sql = "SELECT location_id FROM location where organizer_id_chose=0 or organizer_id_chose=$organizer_id;";
    $result = mysqli_query($link, $sql);


    while ($row = mysqli_fetch_assoc($result)) {
        echo "Usao u while organizator " . $organizer_id . " location_id= " . $row["location_id"] . "<br>";
        $location_id = $row["location_id"];
        if (isset($_POST["odaberi$i"])) {

            $sql = "UPDATE location SET organizer_id_chose='$organizer_id' WHERE location_id=$location_id;";
            mysqli_query($link, $sql);
            echo $sql . "<br>";
        } else {
            //organizator moze i da ancekira lokaciju koja je bila njegova i time je oslobodi da moze da je uzme drugi organizator
            $sql = "UPDATE location SET organizer_id_chose=0 WHERE location_id=$location_id;";
            mysqli_query($link, $sql);
        }





        $i++;
    }
}

mysqli_close($link);

//vracanje na sign.html
$newURL = "locations.html";
header('Location: ' . $newURL);
die();