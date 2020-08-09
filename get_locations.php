<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM location;";

$rez=mysqli_query($link,$upit);

while($podaci=mysqli_fetch_assoc($rez)){

  $grad=$podaci['city'];
  $opstina=$podaci['municipality'];
  $ulica=$podaci['street'];
  
  
 
  
    
    echo<<<EOT
    
    <tr>
    <td>$grad</td>
    <td>$opstina</td>
    <td>$ulica</td>
    <td>Координате</td>
   
    
    
    <td><INPUT type="image" src="assets/update.png" value="" > </td>
    
    <td><INPUT type="image" src="assets/delete.png" value="" > </td>
  </tr>
 
  EOT; 
}

mysqli_close($link);
?>