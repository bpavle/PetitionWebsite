<?php

require_once("config.php");

$upit="SELECT * FROM location;";

$rez=mysqli_query($link,$upit);
$i=1;
while($podaci=mysqli_fetch_assoc($rez)){

  $grad=$podaci['city'];
  $ulica=$podaci['street'];
  
  
 
  
    
    echo<<<EOT
    
    <option value="$i">$grad, $ulica</option>
 
EOT; 
  $i++;
}

mysqli_close($link);
?>