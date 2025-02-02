<?php
if(!isset($_SESSION["id"]))
session_start();

if (
  basename($_SERVER["PHP_SELF"]) == "locations.html" ||
  basename($_SERVER["PHP_SELF"]) == "organizer.html" ||
  basename($_SERVER["PHP_SELF"]) == "complete_signatures.html" ||
  basename($_SERVER["PHP_SELF"]) == "news_entry.html" ||
  basename($_SERVER["PHP_SELF"]) == "organizer_entry.html" ||
  basename($_SERVER["PHP_SELF"]) == "location_entry.html"
)
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  }
if (!isset($_SESSION["email"])) {

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
} else {
  $status = $_SESSION['status'];
  $id = $_SESSION['id'];
  echo <<<EOT
  <div class="head">
  <div id="head-content">
  <a href="index.html">
    
    <div id="logo-container"><img src="assets/favicon.png" style="width:  100px; height: 100px;"
  /></a></div>
  <div id="naslov">Добродошли на Потпиши.ме!</div></div>
</div>
<div class="navigation">
  <div id = "nav-container">
  <a href="index.html">Насловна</a>
  <a href="petition.html">Петиција</a>
  <a href="news.html">Вести</a>
  <a href="sign.html">Потпиши</a>

  <div class="dropdown">
    <button class="dropbtn">Организација</button>
    <div class="dropdown-content">

      <a href="locations.html">Локације</a>
  <a href="organizer.html">Организатори</a> 
EOT;
  if ($_SESSION["status"] == "admin") {
    echo <<<EOT
  <a href="disqualified_organizers.html">Искључени организатори</a>
EOT;
  }
  echo <<<EOT
  <a href="choose_appointments.html"style="background-color: #5cff017d;">Почни са радом</a>
  <a href="complete_signatures.html">Комплетни потписи</a>
 
  <a href="logout.php">Излогујте се</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="dropbtn">Унос</button>
    <div class="dropdown-content">
      <a href="news_entry.html">Унос вести</a>
      <a href="organizer_entry.html">Унос организатора</a>
      <a href="location_entry.html">Унос локације</a>
    </div>
  </div>

  <a href="contact.html">Контакт</a>
  <p> Улоговани сте као $status id=$id</p>
</div>
</div>
EOT;
}