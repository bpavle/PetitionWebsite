<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM sign;";

$rez=mysqli_query($link,$upit);

while($podaci=mysqli_fetch_assoc($rez)){

  $ime=$podaci['Name'];
  $prezime=$podaci['Surname'];
  $mail=$podaci['Email'];
  $licna=$podaci['personal_id_number'];
  $javniPotpis=$podaci['Public_Signature'];
  $telefon=$podaci['Phone_Number'];
  
  if($javniPotpis==1){
      $javniPotpis='ДА';
  }
  else $javniPotpis='НЕ';
  
    
    echo<<<EOT
    <tr>
    <td>$ime</td>
    <td>$prezime</td>
    <td><a href="mailto:$mail">$mail</a></td>
    <td>$telefon</td>
    <td>$licna</td>
    <td>01/10/2019</td>
    <td>10:42 AM</td>
    <td>$javniPotpis</td>
    <td>Супер</td>
    <td><INPUT type="image" src="assets/update.png" value=""> </td>
    <td><INPUT type="image" src="assets/delete.png" value=""> </td>
  </tr>
  EOT; 
}

mysqli_close($link);
?>