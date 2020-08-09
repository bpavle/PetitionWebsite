<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM location;";

$rez=mysqli_query($link,$upit);

while($podaci=mysqli_fetch_assoc($rez)){

  $grad=$podaci['city'];
  $ulica=$podaci['street'];
  $i=1;
  
 
  
    
    echo<<<EOT
    
    <option value="$i++">$grad, $ulica</option>
 
  EOT; 
}

mysqli_close($link);
?>