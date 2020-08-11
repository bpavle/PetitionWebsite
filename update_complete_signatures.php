<?php

$link=mysqli_connect("localhost:3308", "root","","petition");


$upit="SELECT * FROM sign;";

$rez=mysqli_query($link,$upit);

echo<<<EOT
<form method="POST" action="save_update_complete_signatures.php">

EOT;
$i=1;

while($podaci=mysqli_fetch_assoc($rez)){

    $id=$podaci['sign_id'];
    $ime=$podaci['name'];
    $prezime=$podaci['surname'];
    $email=$podaci['email'];
    $telefon=$podaci['phone_number'];
    $br_lk=$podaci['id_number'];
    $lokacija=$podaci['location_id'];
    $javniPotpis=$podaci['publish'];
    $email_obavestenje=$podaci['email_notification'];
    $preuzet=$podaci['taken_over'];
    $komentar=$podaci['comment'];

    
    
  
   
    echo<<<EOT
    <tr>
    
    <td><input type="text" name="id$i" value=$id></td>
    <td><input type="text" name="ime$i" value=$ime></td>
    <td><input type="text" name="prezime$i" value=$prezime></td>
    <td><input type="text" name="email$i" value=$email></td>
    <td><input type="text" name="telefon$i" value=$telefon></td>
    <td><input type="text" name="br_lk$i" value=$br_lk></td>
    <td><input type="text" name="lokacija$i" value=$lokacija></td>
    <td><input type="text" name="javniPotpis$i" value=$javniPotpis></td>
    <td><input type="text" name="email_obavestenje$i" value=$email_obavestenje></td>
    <td><input type="text" name="preuzet$i" value=$preuzet></td>
    <td><input type="text" name="komentar$i" value=$komentar></td>
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