<?php

$link=mysqli_connect("localhost:3308", "root","","petition");



$id=$_POST["update"];






$upit="SELECT * FROM location WHERE location_id=$id;";

$rez=mysqli_query($link,$upit);

$podaci=mysqli_fetch_assoc($rez);

    $naziv=$podaci['name'];
    $grad=$podaci['city'];
    $opstina=$podaci['municipality'];
    $ulica=$podaci['street'];
    $x=$podaci['x_coordinate'];
    $y=$podaci['y_coordinate'];
  
    echo<<<EOT
    
    <!DOCTYPE html>
    <html>
    
    <head>
      <title>Унос локације</title>
      <meta charset="UTF-8" />
      <link rel="shortcut icon" type="image/png" href="assets/favicon.png" />
      <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    
    <body>
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
       
        
        <a href="complete_signatures.html">Комплетни потписи</a>
       
        <a href="index.html">Излогујте се</a>
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
        
      </div>
    </div>
    
    
    <script src="inactive.js"></script>
    
      <div class="content">
        <div class="form-container">
        <h1>Унос локације</h1>
        <div class="form">
        <table>
            <form  method="POST" action="insert_update_locations.php">
                <tr>   
                    <td>
                            ID локације је: 
                     </td>
                     <td>
                     <input type="text" name="id" value="$id">
                     </td>
                </tr>
                <tr>
                        <td> Назив:</td>
                       <td> <input type="text" name="naziv" value="$naziv"></td>
                
                </tr>
    
                <tr>
                  <td> Град:</td>
                  <td> <input type="text" name="grad" value="$grad"></td>
                </tr>
    
                <tr>
                 <td> Општина:</td>
                 <td> <input type="text" name="opstina" value="$opstina"></td>
                </tr>
    
                <tr>
                    <td> Улица:</td>
                    <td> <input type="text" name="ulica" value="$ulica"></td>
                    
                </tr>
               
                <tr>
                  <td>  X координата:</td>
                  <td> <input type="text" name="x_koordinata" value="$x"></td>
                </tr>
                <tr>
                  <td> Y координата:</td>
                  <td> <input type="text" name="y_koordinata" value="$y"></td>
                </tr>
               
                
               
                <tr >
                  <td colspan="2"> <button class = "btn" name="posalji" > Унеси </a></button></td>
                  
                </tr>
            </form>
        </table>
    </div>
    </div>
    </div>
    
    </body>
    </html>
 
  EOT; 

 


mysqli_close($link);
//vracanje na sign.html
$newURL = "locations.html";
header('Location: '.$newURL);
die(); 


?>