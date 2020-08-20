<?php

require_once("config.php");

$upit = "SELECT * FROM sign;";

$rez = mysqli_query($link, $upit);

while ($podaci = mysqli_fetch_assoc($rez)) {

  $ime = $podaci['name'];
  $prezime = $podaci['surname'];
  $mail = $podaci['email'];
  $licna = $podaci['id_number'];
  $javniPotpis = $podaci['publish'];
  $telefon = $podaci['phone_number'];
  $komentar = $podaci['comment'];
  $lokacija = $podaci['location_id'];
  $broj_termina = $podaci['appointment_count'];
  $termini = $podaci['appointments'];
  $preuzet = $podaci['taken_over'];
  $email_obavestenje = $podaci['email_notification'];

  if ($javniPotpis == 1) {
    $javniPotpis = 'ДА';
  } else $javniPotpis = 'НЕ';

  if ($preuzet == 1) {
    $preuzet = 'ДА';
  } else $preuzet = 'НЕ';

  if ($email_obavestenje == 1) {
    $email_obavestenje = 'ДА';
  } else $email_obavestenje = 'НЕ';

  echo <<<EOT
    <tr>
    <td>$ime</td>
    <td>$prezime</td>
    <td><a href="mailto:$mail">$mail</a></td>
    <td>$telefon</td>
    <td>$licna</td>
    <td>$lokacija</td>
    <td>$javniPotpis</td>
    <td>$email_obavestenje</td>
    <td>$preuzet</td>
    <td>$komentar</td>
   
  </tr>
EOT;
}
if ($_SESSION["status"] == "admin") {
  echo <<<EOT
  <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="posalji"><a href="update_complete_signature.html">Измени </a></button></td></td></tr>
EOT;
}
mysqli_close($link);