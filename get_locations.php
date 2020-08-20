<?php

if (!isset($_SESSION["status"])) {
  echo "Немате право приступа!";
} else {
  require_once("config.php");
  $id = $_SESSION["id"];
  $upit = "SELECT * FROM location;";

  $rez = mysqli_query($link, $upit);


  while ($podaci = mysqli_fetch_assoc($rez)) {

    $id = $podaci['location_id'];
    $naziv = $podaci['name'];
    $grad = $podaci['city'];
    $opstina = $podaci['municipality'];
    $ulica = $podaci['street'];
    $x = $podaci['x_coordinate'];
    $y = $podaci['y_coordinate'];


    echo <<<EOT
    <tr>

    <td>$naziv</td>
    <td>$grad</td>
    <td>$opstina</td>
    <td>$ulica</td>
    <td>$x; $y</td>   
    </tr>
EOT;
  }

  echo <<<EOT
  <tr>
  
  <td colspan="2"> <button class = "btn" type="submit" name="posalji"><a href="choose_locations.html">Одабери локације </a></button></td>
  
  <td colspan="3"> <button class = "btn" type="submit" name="posalji"><a href="update_location.html">Измени </a></button></td>
  </tr>
EOT;


  mysqli_close($link);
}