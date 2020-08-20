<?php



if (!isset($_SESSION["status"])) {
    echo "Немате право приступа!";
} else {
    if ($_SESSION["status"] == "organizer") {
        $id = $_SESSION["id"];
        //echo "ORGANIZER";
        $upit = "SELECT * FROM location where organizer_id_chose=0 or organizer_id_chose=$id;";
    }
    require_once("config.php");
    $rez = mysqli_query($link, $upit);

    echo <<<EOT
<form method="POST" action="save_choose_locations.php">

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
        $chosen_by = $podaci["organizer_id_chose"];

        if ($chosen_by == $_SESSION["id"]) {
            $checked = "checked";
        } else {
            $checked = "";
        }
        echo <<<EOT
    <tr>
    
    <td>$id</td>
    <td>$naziv</td>
    <td>$grad</td>
    <td>$opstina</td>
    <td>$ulica</td>
    <td>$x</td>
    <td>$y</td>
    <td><input type="checkbox"  name="odaberi$i" value="odaberi" $checked></td>
   
   
    
 
    
    
   
    </tr>
  
 
EOT;
        $i++;
    }
    echo <<<EOT
  <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="update"> Сачувај </button></td></td></tr>
EOT;




    mysqli_close($link);
}
