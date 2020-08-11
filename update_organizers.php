<?php

$link=mysqli_connect("localhost:3308", "root","","petition");


$upit="SELECT * FROM organizer_administrator;";

$rez=mysqli_query($link,$upit);

echo<<<EOT
<form method="POST" action="save_update_organizers.php">

EOT;
$i=1;

while($podaci=mysqli_fetch_assoc($rez)){

  $id=$podaci['organizer_administrator_id'];
  $ime=$podaci['name'];
  $prezime=$podaci['surname'];
  $sifra=$podaci['password'];
  $telefon=$podaci['phone_number'];
  $email=$podaci['email'];
  $br_lk=$podaci['id_number'];
  $odobren=$podaci['approved'];
  $predlagac=$podaci['recommended_by_organizer_id'];
  $nevazeci=$podaci['invalid_signature_count'];
  $lose_preporuke=$podaci['bad_recommendation_count'];

    echo<<<EOT
    <tr>
    
    <td><input type="text" name="id$i" value=$id></td>
    <td><input type="text" name="ime$i" value=$ime></td>
    <td><input type="text" name="prezime$i" value=$prezime></td>
    <td><input type="text" name="email$i" value=$email></td>
    <td><input type="text" name="predlagac$i" value=$predlagac></td>
    <td><input type="text" name="telefon$i" value=$telefon></td>
    <td><input type="text" name="sifra$i" value=$sifra></td>
    <td><input type="text" name="br_lk$i" value=$br_lk></td>
    <td><input type="text" name="odobren$i" value=$odobren></td>
    <td><input type="text" name="nevazeci$i" value=$nevazeci></td>
    <td><input type="text" name="lose_preporuke$i" value=$lose_preporuke></td>
    <td><input type="checkbox"  name="brisi$i" value="brisi"></td>
   
   
    
 
    
    
   
    </tr>
  
 
EOT; 
$i++;
}
echo<<<EOT
  <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="update"> Сачувај </button></td></td></tr>
EOT;

 


mysqli_close($link);



?>