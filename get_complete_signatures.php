<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM sign;";

$rez=mysqli_query($link,$upit);

while($podaci=mysqli_fetch_assoc($rez)){

  $ime=$podaci['name'];
  $prezime=$podaci['surname'];
  $mail=$podaci['email'];
  $licna=$podaci['id_number'];
  $javniPotpis=$podaci['publish'];
  $telefon=$podaci['phone_number'];
  $komentar=$podaci['comment'];
  $lokacija=$podaci['location_id'];
  $broj_termina=$podaci['appointment_count'];
  $termini=$podaci['appointments'];
  $preuzet=$podaci['taken_over'];
  $email_obavestenje=$podaci['email_notification'];

  if($javniPotpis==1){
      $javniPotpis='ДА';
  }
  else $javniPotpis='НЕ';

  if($preuzet==1){
    $preuzet='ДА';
}
else $preuzet='НЕ';
  
if($email_obavestenje==1){
  $email_obavestenje='ДА';
}
else $email_obavestenje='НЕ';
    
    echo<<<EOT
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
    <td><INPUT type="image" src="assets/update.png" value=""> </td>
    <td><INPUT type="image" src="assets/delete.png" value=""> </td>
  </tr>
  EOT; 
}

mysqli_close($link);
?>