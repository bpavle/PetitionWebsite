<?php

require_once("config.php");

$upit = "SELECT * FROM sign;";

$rez = mysqli_query($link, $upit);

while ($podaci = mysqli_fetch_assoc($rez)) {

  $ime = $podaci['name'];
  $komentar = $podaci['comment'];

  echo <<<EOT
          
    <div class="comment">
        <h4>$ime</h4>
        $komentar
      </div>
      <hr />
 
EOT;
}

mysqli_close($link);
