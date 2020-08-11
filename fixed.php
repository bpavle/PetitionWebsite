
<?php

echo <<<EOT

<div class="head">
      <div id="head-content">
      <a href="index.html">
        
        <div id="logo-container"><img src="assets/favicon.png" style="width:  100px; height: 100px;"
      /></a></div>
      <div id="naslov">Добродошли на Потпиши.ме!</div></div>
    </div>
    <div class="navigation">
      <div id="nav-container">
        <a href="index.html">Насловна</a>
        <a href="petition.html">Петиција</a>
        <a href="news.html">Вести</a>
        <a href="sign.html">Потпиши</a>
        <div class="dropdown">
          <button class="dropbtn">Организација</button>
          <div class="dropdown-content">
            <a href="login.php">Улогуј се</a>
            <a href="registration.php">Регистрација</a>
          </div>
        </div>
        <a href="contact.html">Контакт</a>
      </div>
    </div> 
EOT;
?>
