<?php

if (isset($_SESSION["status"]) && $_SESSION["status"] == "admin") {
  require_once("config.php");

  if (isset($_POST["update"])) {

    $i = 1;
    $data_set = [];

    while (isset($_POST["id$i"])) {


      $id = $_POST["id$i"];

      $ime = $_POST["ime$i"];

      $prezime = $_POST["prezime$i"];

      $email = $_POST["email$i"];

      $predlagac = $_POST["predlagac$i"];

      $telefon = $_POST["telefon$i"];

      $sifra = $_POST["sifra$i"];

      $br_lk = $_POST["br_lk$i"];

      $odobren = $_POST["odobren$i"];
      echo "<br>" . "Odobren $i :" . $odobren . "<br>";
      $nevazeci = $_POST["nevazeci$i"];

      $lose_preporuke = $_POST["lose_preporuke$i"];

      $not_null_fields = array(
        "id" => $id,
        "ime" => $ime,
        "prezime" => $prezime,
        "email" => $email,
        "predlagac" => $predlagac,
        "telefon" => $telefon,
        "sifra" => $sifra,
        "br_lk" => $br_lk,
        "odobren" => $odobren,
        "nevazeci" => $nevazeci,
        "lose_preporuke" => $lose_preporuke
      );
      array_push($data_set, $not_null_fields);

      if (isset($_POST["brisi$i"])) {

        $sql = "DELETE FROM organizer_administrator 

        WHERE organizer_administrator_id=$id;

        ";
        mysqli_query($link, $sql);
      }


      $sql = "UPDATE organizer_administrator SET ";

      if (!empty($ime))
        $sql = $sql . "name='" . $ime . "',";
      if (!empty($prezime))
        $sql = $sql . "surname='" . $prezime . "',";
      if (!empty($email))
        $sql = $sql . "email='" . $email . "',";
      if (!empty($predlagac))
        $sql = $sql . "recommended_by_organizer_id='" . $predlagac . "',";
      if (!empty($telefon))
        $sql = $sql . "phone_number='" . $telefon . "',";
      if (!empty($sifra))
        $sql = $sql . "password='" . $sifra . "',";
      if (!empty($br_lk))
        $sql = $sql . "id_number='" . $br_lk . "',";
      echo "<br>" . "Odobren $i :" . $odobren . "<br>";
      //menjamo approved samo za one koji nisu admini. admin je uvek 2
      if ($odobren != '2') {
        if (isset($_POST["odobren$i"])) {
          $sql = $sql . "approved='" . "1" . "',";
          echo "JESTE SETOVANO!!!!!!!!!!!!!!!!!!! $odobren";
        } else {
          $sql = $sql . "approved='" . "0" . "',";
          echo "NIJE SETOVANO!!!!!!!!!!!!!!!";
        }
      }
      if (!empty($nevazeci))
        $sql = $sql . "invalid_signature_count='" . $nevazeci . "',";
      if (!empty($lose_preporuke))
        $sql = $sql . "bad_recommendation_count='" . $lose_preporuke . "',";

      $sql = substr($sql, 0, -1); //sklanjamo poslednji zarez iz sql stringa

      $sql = $sql . "WHERE organizer_administrator_id=$id;";
      echo $sql;
      echo "\n";
      /*  $sql = "UPDATE organizer_administrator SET

    

    name='$ime',

    surname='$prezime',

    email='$email',

    recommended_by_organizer_id='$predlagac',

    phone_number='$telefon',

    password='$sifra',

    id_number='$br_lk',

    approved='$odobren', 

    invalid_signature_count='$nevazeci',

    bad_recommendation_count='$lose_preporuke'

    WHERE organizer_administrator_id=$id;

    "; */
      mysqli_query($link, $sql);



      $i++;
    }
  }






  mysqli_close($link);


  //vracanje na sign.html
  $newURL = "organizer.html";
  header('Location: ' . $newURL);
  die();
} else {
  echo "НЕМАТЕ ПРИСТУП, УЛОГУЈТЕ СЕ КАО АДМИН!";
  sleep(5);
  $newURL = "login.php";
  header('Location: ' . $newURL);
  die();
}