<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM organizer_administrator;";

$rez=mysqli_query($link,$upit);

while($podaci=mysqli_fetch_assoc($rez)){

  $ime=$podaci['name'];
  $prezime=$podaci['surname'];
  $mail=$podaci['email'];
  $telefon=$podaci['phone_number'];
  $predlagac=$podaci['recommended_by_organizer_id'];
 
  
    
    echo<<<EOT
    
    <tr>
    <td>$ime</td>
    <td>$prezime</td>
    <td><a href="mailto:$mail">$mail</a></td>
    <td>$predlagac</td>
    <td>$telefon</td>
    
    
  
  </tr>
 
  EOT; 
}
echo<<<EOT
  <tr><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="posalji"><a href="update_organizer.html">Измени </a></button></td></td></tr>
  EOT;
mysqli_close($link);
?>