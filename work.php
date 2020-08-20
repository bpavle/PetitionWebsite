<?php
/* 
Organizator izabere lokacije, tim lokacijama
>> odgovaraju određeni potpisnici. Onda izabere termine. Onda program
>> nadje
>> u
>> svakom terminu koliko ima potpisnika kojima odgovaraju ti termini, i
>> onda
>> bira termine prema broju potpisnika, prvo najgušći termin. Onda program
>> krene od jednog potpisnika slučajno izabranog iz tog termina, pa nadje
>> sledećeg najbližeg, pa sledećeg i tako dalje sve dok mogu da stanu u
>> taj
>> termin. Onda izbaci te potpisnike, i bira sledeći najgušći termin, pa
>> tu
>> izabere raspored potpisnika. Na kraju posle proračuna organizatoru
>> izbaci
>> listu termina i redosleda potpisnika koje treba da obidje u tom terminu
>> sa
>> adresama. */

session_start();
//echo $_SESSION["status"];

//funkcija koja vraca distancu izmedju dve tacke zadatih koordinata
function distance($X1, $X2, $Y1, $Y2)
{

    return sqrt(($X1 - $X2) ** 2 + ($Y1 - $Y2) ** 2);
}
if (isset($_SESSION["status"]) && isset($_POST["posalji"])) {
    $organizer_speed = 4 / 60; //brzina organizatora po minutu
    echo <<<EOT
    <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<link rel="shortcut icon" type="image/png" href="assets/favicon.png" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Рад</title>
</head>

<body>
EOT;
    include("fixed.php");
    echo <<<EOT
<div class="content">
  <h1>Почетак рада</h1> 
EOT;
    require_once("config.php");

    //prvo cemo da dohvatimo sve termine koji odgovaraju organizatoru iz forme koja je pozvala ovaj fajl

    //promenljiva koja sadrzi niz termina koje je organizator odabrao
    $chosen_appointments = $_POST["appointments"];

    /* foreach ($chosen_appointments as $appointment) {
        //echo $appointment . " ";
    } */

    //lokacije koje je organizator koji je ulogovan izabrao
    $id = $_SESSION["id"];
    $sql = "SELECT Location_id FROM location WHERE organizer_id_chose=$id";
    $result = mysqli_query($link, $sql);
    $chosen_locations = [];

    while ($location = mysqli_fetch_assoc($result)) {
        array_push($chosen_locations, $location);
    } //napravili smo niz id-jeva lokacija koje je organizator odabrao



    //sada nam trebaju potpisnici sa tih lokacija i njihovi termini
    $signatories_by_appointment_count = [];
    $signatories_by_appointment = [];
    
    //za svaki termin koji je izabrao organizator uzimamo koliko je ljudi u njemu
    foreach ($chosen_appointments as $appointment) {

        //uzimamo sve potpisnike kojima odgovara taj termin
        $sql = "SELECT * FROM sign WHERE taken_over=0 AND appointments LIKE '%$appointment%' AND location_id IN (
                SELECT location_id FROM location WHERE organizer_id_chose=$id
            )";
        //echo $sql . "<br>";
        $result = mysqli_query($link, $sql);

        //brojimo koliko u kom terminu ima potpisnika
        $signatories_by_appointment_count[$appointment] = mysqli_num_rows($result);
        echo "Broj potpisnika kojima odgovara termin: " . $appointment . " je " . $signatories_by_appointment_count[$appointment] . "<br>";

    }

    //sortiramo niz broja potpisnika po terminima opadajuce jer krecemo od najgusceg termina
    array_multisort($signatories_by_appointment_count, SORT_DESC);

    //termini sortirani po gustini(prvo najgusci)
    $sorted_appointments = array_keys($signatories_by_appointment_count);

    $last_signatory = [];
    //u svakom terminu sortiramo ljude po blizini pocevsi od prvog coveka
    foreach ($sorted_appointments as $appointment) {

        $sql = "SELECT * FROM sign WHERE taken_over=0 AND appointments LIKE '%$appointment%' AND location_id IN (
            SELECT location_id FROM location WHERE organizer_id_chose=$id
        )";
    //echo $sql . "<br>";
    $result = mysqli_query($link, $sql);
        $signatories_by_appointment[$appointment] = [];

        while ($signatory = mysqli_fetch_assoc($result)) {
            //ako je neko vec rasporedjen(taken_over=2) njega ne ubacujemo u termin
            //ubacujemo samo one koji nisu rasporedjeni taken_over=0;
            if ($signatory["taken_over"] == 0)
                array_push($signatories_by_appointment[$appointment], $signatory);
            //echo $signatory["sign_id"] . " ide u niz<br>";

        }
        echo "<br>za ".$appointment;
        foreach($signatories_by_appointment[$appointment] as $s){
            echo "<br>".$s["sign_id"];
        }


        //sortiramo ljude po blizini
        $arr = $signatories_by_appointment[$appointment];

        for ($i = 0; $i < count($signatories_by_appointment[$appointment]); $i++) {
            $min = 1000000;
            for ($j = 1; $j < count($signatories_by_appointment[$appointment]); $j++) {
                //mala optimizacija... Preskacemo slucajeve kada poredimo potpisnika sa samim sobom
                if ($arr[$i]["sign_id"] == $arr[$j]["sign_id"]) continue;
                //echo "Distanca izmedju " . $arr[$i]["sign_id"] . "(" . $arr[$i]['x_coordinate'] . "," . $arr[$i]['y_coordinate'] . ")" . " i " . $arr[$j]["sign_id"] . "(" . $arr[$j]['x_coordinate'] . "," . $arr[$j]['y_coordinate'] . ")" . " je " . distance($arr[$i]["x_coordinate"], $arr[$j]["x_coordinate"], $arr[$i]["y_coordinate"], $arr[$j]["y_coordinate"]) . "<br>";
                //echo "Trenutna najmanja distanca u nizu je " . $min . "<br>";
                if (distance($arr[$i]["x_coordinate"], $arr[$j]["x_coordinate"], $arr[$i]["y_coordinate"], $arr[$j]["y_coordinate"]) < $min) {
                    $min = distance($arr[$i]["x_coordinate"], $arr[$j]["x_coordinate"], $arr[$i]["y_coordinate"], $arr[$j]["y_coordinate"]);
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                    //echo "USAO" . "<br>";
                }
            }
            //belezimo koje smo ljude vec rasporedili
            /* $sid=$arr[$i]['sign_id'];
            $sql="UPDATE sign SET
            taken_over=2 
            WHERE sign_id=$sid;
            ";
            echo $sql;
            mysqli_query($link,$sql); */
        } //zavrseno sortiranje po blizini
        $signatories_by_appointment[$appointment] = $arr;
        /* echo "sortirani u terminu ".$appointment;
        foreach ($arr as $key) {
            echo '<br>'.$key["sign_id"];
        } */
        //proverimo da li je termin prazan, ako jeste ne pravimo tabelu
        if (empty($signatories_by_appointment[$appointment])) {
            echo "Термин " . $appointment . " је празан<BR>";
            continue;
        };
        echo <<<EOT
        <form method="POST" action = "finish.php">
        <table id="table" class="table_cs">
        <tr >
            <th colspan="7">Термин $appointment</th>
        </tr>
        <tr>
          <th>Име</th>
          <th>Презиме</th>
          <th>e-mail</th>
          <th>Број телефона</th>
          <th>Број личне карте</th>
          <th>Локација</th>
          <th>Потпис преузет</th>
        </tr>
EOT;


        $last_signatory[$appointment] = 1; //poslednji potpisnik do kojeg stizemo
        $time_left = 12000000000;//postavljena je velika vrednost da se pokaze da algoritam radi lepo... 
        //echo"broj ljudi je ".count($signatories_by_appointment[$appointment]);
        for ($i = 0; $i < count($signatories_by_appointment[$appointment]) - 1; $i++) {



            //echo $signatories_by_appointment[$appointment][$i]["sign_id"] . "<br>";
            $time_left -= 15; //oduzimamo petnaest minuta za potpis od potpisnika kod kojeg je organizator trenutno
            $time_left -=
                distance(
                    $signatories_by_appointment[$appointment][$i]["x_coordinate"],
                    $signatories_by_appointment[$appointment][$i + 1]["x_coordinate"],
                    $signatories_by_appointment[$appointment][$i]["y_coordinate"],
                    $signatories_by_appointment[$appointment][$i + 1]["y_coordinate"]
                ) / $organizer_speed;


            //za svakog korisnika u ovom terminu do kojeg mozemo da stignemo, upisujemo u bazu taken_over=2

            //belezimo koga smo rasporedili
            $sql = "UPDATE sign SET taken_over=2 WHERE sign_id=" . $signatories_by_appointment[$appointment][$i]["sign_id"];
            // echo $sql;
            mysqli_query($link, $sql);

            /* //za coveka koji je rasporedjen u ovaj termin, gledamo da li je bio i u drugim terminima i ako jeste, skidamo ga iz njih
            foreach ($sorted_appointments as $other_appointment) {


                if ($other_appointment != $appointment && in_array($signatories_by_appointment[$appointment][$i], $signatories_by_appointment[$appointment2])) {
                    
                }
            } */

            echo"<br>$time_left<br>";
            if ($time_left == 15) {
                //kada vreme padne na 15 stizemo da uzmemo potpis od potpisnika kod kog smo dosli 
                $last_signatory[$appointment] = $i + 1;
                $sql = "UPDATE sign SET taken_over=2 WHERE sign_id=" . $signatories_by_appointment[$appointment][$i + 1]["sign_id"];
                // echo $sql;
                mysqli_query($link, $sql);
                break;
            }
            if ($time_left < 15) {
                //ako je manje, ne stizemo, pa cemo tog potisnika izbaciti
                $last_signatory[$appointment] = $i;
                break;
            } else {
                $sql = "UPDATE sign SET taken_over=2 WHERE sign_id=" . $signatories_by_appointment[$appointment][$i + 1]["sign_id"];
                // echo $sql;
                mysqli_query($link, $sql);
                $last_signatory[$appointment] = $i + 1;
            }
        }









        echo "<br>Posledji koji staje je ".$last_signatory[$appointment];
        for ($i = 0; $i < count($signatories_by_appointment[$appointment]) ; $i++) {
           echo "<br>usao u petlju i=".$i."<br>";
            $sign_id = $signatories_by_appointment[$appointment][$i]["sign_id"];
            $name = $signatories_by_appointment[$appointment][$i]["name"];
            $surname = $signatories_by_appointment[$appointment][$i]["surname"];
            $email = $signatories_by_appointment[$appointment][$i]["email"];
            $phone_number = $signatories_by_appointment[$appointment][$i]["phone_number"];
            $id_number = $signatories_by_appointment[$appointment][$i]["id_number"];
            $location_id = $signatories_by_appointment[$appointment][$i]["location_id"];
            $taken_over = $signatories_by_appointment[$appointment][$i]["taken_over"];
            $checked = "";
            if ($taken_over != 0) {
                $checked = "checked";
            }
            echo <<<EOT
    <tr>
    
    <td>$name</td>
    <td>$surname</td>
    <td><a href="mailto:$email">$email</a></td>
    <td>$phone_number</td>
    <td>$id_number</td>
    <td>$location_id</td>
    
    
    <td><input type="checkbox" name="taken_over[]" value="$sign_id" $checked></td>
    </tr>
EOT;
        }
    } //za svaki termin



    //niz u koji cemo za svaki termin staviti posledjeg potpinika do kojeg mozemo stici
    
    

    echo <<<EOT
<tr><td colspan="7"><button class = "btn" type="submit" name="finish"> Сачувај </button></td></tr>
EOT;
    mysqli_close($link);
}
