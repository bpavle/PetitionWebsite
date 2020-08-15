<?php



if (!isset($_SESSION["status"])) {
  echo "Немате право приступа!";
} else {
  if ($_SESSION["status"] == "organizer") {
    $id = $_SESSION["id"];
    //echo "ORGANIZER";
    $upit = "SELECT * FROM location WHERE organizer_administrator_id=$id";
  } else {
    $upit = "SELECT * FROM location;";
  }
  require_once("config.php");
  $rez = mysqli_query($link, $upit);

  echo <<<EOT
<form method="POST" action="save_update_locations.php">

EOT;
  $i = 1;

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
    
    <td><input type="text" name="id$i" value=$id></td>
    <td><input type="text" name="naziv$i" value=$naziv></td>
    <td><input type="text" name="grad$i" value=$grad></td>
    <td><input type="text" name="opstina$i" value=$opstina></td>
    <td><input type="text" name="ulica$i" value=$ulica></td>
    <td><input type="text" name="x$i" value=$x></td>
    <td><input type="text" name="y$i" value=$y></td>
    <td><input type="checkbox"  name="brisi$i" value="brisi"></td>
   
   
    
 
    
    
   
    </tr>
  
 
EOT;
    $i++;
  }
  echo <<<EOT
  <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="update"> Сачувај </button></td></td></tr>
EOT;




  mysqli_close($link);
}