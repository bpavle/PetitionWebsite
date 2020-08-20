<?php



if (!isset($_SESSION["status"])) {
  echo "Немате право приступа!";
} else {
  echo "<script src='validator.js'></script>";
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
<form onSubmit="return validateForm()" method="POST" action="save_update_locations.php">

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
    <td><input type="checkbox"  name="brisi$i" id="checkbox$i" value="brisi"></td>
   
   
    
 
    
    
   
    </tr>
  
 
EOT;
    $i++;
  }
  echo <<<EOT
  <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><td colspan="2"> <button class = "btn" type="submit" name="update"  > Сачувај </button></td></td></tr>
EOT;




  mysqli_close($link);
}
?>

<!-- 
<script>

function validateForm() {


  var br=0;  
  var i = 1;
//alert(document.get);
  while(document.getElementById("checkbox"+i)) {
//alert("USAO");
  //document.getElementsByName("brisi"+i);
    var checkboxes = document.getElementById("checkbox"+i);
    if (checkboxes.checked) {
      br++;
     
    }
    i++;
  }
if(br==1){
  return confirm("Пажња! Да ли сте сигурни да желите да обришете "+br +" ред?");
}
else if(br<5){
return confirm("Пажња! Да ли сте сигурни да желите да обришете "+br +" реда?");
}
else {return confirm("Пажња! Да ли сте сигурни да желите да обришете "+br +" редова?");}

}

</script> -->