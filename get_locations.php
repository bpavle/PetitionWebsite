<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM location;";

$rez=mysqli_query($link,$upit);


while($podaci=mysqli_fetch_assoc($rez)){
  
  $id=$podaci['location_id'];
   $naziv=$podaci['name'];
   $grad=$podaci['city'];
   $opstina=$podaci['municipality'];
   $ulica=$podaci['street'];
   $x=$podaci['x_coordinate'];
   $y=$podaci['y_coordinate'];
   

   echo<<<EOT
    <tr>

    <td>$naziv</td>
    <td>$grad</td>
    <td>$opstina</td>
    <td>$ulica</td>
    <td>$x; $y</td>   
    </tr>
EOT; 
  
  
}

echo<<<EOT
  <tr><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="posalji"><a href="update_location.html">Измени </a></button></td></td></tr>
  EOT;


mysqli_close($link);


?>

