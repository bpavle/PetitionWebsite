<?php



    if (isset($_POST["update"]) && isset($_SESSION["status"]) && $_SESSION["status"] == "admin") {
        require_once("config.php");
        $i = 1;
        while ($_POST["id$i"]) {

            $id = $_POST["id$i"];

            $ime = $_POST["ime$i"];

            $prezime = $_POST["prezime$i"];

            $email = $_POST["email$i"];

            $telefon = $_POST["telefon$i"];

            $br_lk = $_POST["br_lk$i"];

            $lokacija = $_POST["lokacija$i"];

            $javniPotpis = $_POST["javniPotpis$i"];

            $email_obavestenje = $_POST["email_obavestenje$i"];

            $preuzet = $_POST["preuzet$i"];

            $komentar = $_POST["komentar$i"];





            if (isset($_POST["brisi$i"])) {

                $sql = "DELETE FROM sign 

        WHERE sign_id=$id;

        ";
                mysqli_query($link, $sql);
            }

            $sql = "UPDATE sign SET

    

    name='$ime',

    surname='$prezime',

    email='$email',

    phone_number='$telefon',

    id_number='$br_lk',

    location_id='$lokacija',

    publish='$javniPotpis',

    email_notification='$email_obavestenje',
    taken_over='$preuzet',
    comment='$komentar'

    WHERE sign_id=$id;

    ";
            mysqli_query($link, $sql);



            $i++;
        }
    }






    mysqli_close($link);

    //vracanje na sign.html
    $newURL = "complete_signatures.html";
    header('Location: ' . $newURL);
    die();


    ?>