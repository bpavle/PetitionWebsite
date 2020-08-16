<?php
//session_start();
$disqualified_organizers = [];
$all_organizers = [];

if (isset($_SESSION["status"])) {
  require_once("config.php");

  if (basename($_SERVER["PHP_SELF"]) == "organizer.html") {
    $upit = "SELECT * FROM `organizer_administrator` WHERE `approved`<>2;";

    $rez = mysqli_query($link, $upit);

    while ($podaci = mysqli_fetch_assoc($rez)) {

      $ime = $podaci['name'];
      $prezime = $podaci['surname'];
      $mail = $podaci['email'];
      $telefon = $podaci['phone_number'];
      $predlagac = $podaci['recommended_by_organizer_id'];



      echo <<<EOT
    
    <tr>
    <td>$ime</td>
    <td>$prezime</td>
    <td><a href="mailto:$mail">$mail</a></td>
    <td>$predlagac</td>
    <td>$telefon</td>
    
    
  
  </tr>
 
  EOT;
    }
    if ($_SESSION["status"] == "admin") {
      echo <<<EOT
  <tr>  
  <td></td>
  <td></td>
  <td></td>
  <td><td colspan="2"> <button class = "btn" type="submit" name="posalji"><a href="update_organizer.html">Измени </a></button></td></td></tr>
  EOT;
    }
  } else {
    $sql = "SELECT * FROM organizer_administrator WHERE approved<>2;";
    // echo $sql . "<br>";
    $rezult = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($rezult)) {
      array_push($GLOBALS["all_organizers"], $row);
      $organizer_id_chose = $row["organizer_administrator_id"];
      $sql = "SELECT COUNT(*) AS total_signatures_by_organizator FROM `sign` S, location L where S.location_id=L.location_id AND organizer_id_chose=$organizer_id_chose;";
      //echo $sql . "<br>";
      $total_signatures_by_organizator = mysqli_query($link, $sql);
      $total_signatures_by_organizator = mysqli_fetch_assoc($total_signatures_by_organizator);
      $total_signatures_by_organizator = $total_signatures_by_organizator["total_signatures_by_organizator"];

      if ($total_signatures_by_organizator == 0 || $row["invalid_signature_count"] / $total_signatures_by_organizator  <= 0.05) {
        // echo "desio se continue<br>";
        continue;
      }
      $sql = "SELECT * FROM `organizer_administrator` WHERE `invalid_signature_count`/$total_signatures_by_organizator>0.05 AND 
      organizer_administrator_id=$organizer_id_chose;";
      //echo $sql . "<br>";

      $organizer = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($organizer);
      array_push($GLOBALS["disqualified_organizers"], $row);
      $ime = $row['name'];
      $prezime = $row['surname'];
      $mail = $row['email'];
      $telefon = $row['phone_number'];
      $predlagac = $row['recommended_by_organizer_id'];
      /* 


      echo <<<EOT
    
    <tr>
    <td>$ime</td>
    <td>$prezime</td>
    <td><a href="mailto:$mail">$mail</a></td>
    <td>$predlagac</td>
    <td>$telefon</td>
    
    
  
  </tr>
 
  EOT; */
    }
    foreach ($GLOBALS["all_organizers"] as $value) {

      if ($value["bad_recommendation_count"] >= 2) {
        array_push($GLOBALS["disqualified_organizers"], $value);
      }
    }
    while ($row = array_pop($GLOBALS["disqualified_organizers"])) {

      $ime = $row['name'];
      $prezime = $row['surname'];
      $mail = $row['email'];
      $telefon = $row['phone_number'];
      $predlagac = $row['recommended_by_organizer_id'];


      echo <<<EOT
    
    <tr>
    <td>$ime</td>
    <td>$prezime</td>
    <td><a href="mailto:$mail">$mail</a></td>
    <td>$predlagac</td>
    <td>$telefon</td>
    
    
  
  </tr>
EOT;
    }
  }
  mysqli_close($link);
}