<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["mail"]))){
        $username_err = "Молимо Вас да унесете адресу е поште";
    } else{
        // Prepare a select statement
        $mail = $_POST["mail"];
        $sql = "SELECT email FROM organizer_administrator WHERE email = '$mail' ";
        
        $result= mysqli_query($link,$sql);
      
        $temp = mysqli_fetch_array($result);
       if($temp[0]==$mail){
         echo "Већ постоји дата мејл адреса";
         
       }
       
       
        
    
    // Validate password
    if(empty(trim($_POST["sifra"]))){
        $password_err = "Поље за шифру не сме бити празно";     
    } else{
        $password = trim($_POST["sifra"]);
    }
    
  }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO organizer_administrator (email, password) VALUES (".$mail.",".$password.")";
         
        mysqli_query($link,$sql);
    }
    
    // Close connection
    mysqli_close($link);
}

?>
 
<!DOCTYPE html>

<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Регистрација</title>
</head>

<body>
    <!-- <div class="head">
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
              <a href="login.html">Улогуј се</a>
            <a href="registration.html">Регистрација</a>
          </div>
          </div>
          <a href="contact.html">Контакт</a>
        </div>
      </div>
      <script src="inactive.js"></script>
 -->
 <?php include("fixed.php")?>
    <div class="content">
        <div class="form-container">
        <h1>Регистрација</h1>
        <div class="form">
        <table>
            <form method="POST" action="registration.php">
                <tr>
                    <td> Име:</td>
                    <td> <input type="text" name="ime"></td>
                    
                </tr>
               
                <tr>
                    <td> Презиме:</td>
                    <td> <input type="text" name="prezime"></td>
                </tr>
                <tr>
                    <td> е-mail:</td>
                    <td> <input type="text" name="mail"></td>
                </tr>
                <tr>
                    <td> Адреса:</td>
                    <td> <input type="text" name="adresa"></td>
                </tr>
                <tr>
                    <td> Предлагач:</td>
                    <td> <input type="text" name="predlagac"></td>
                </tr>
                <tr>
                    <td> Телефон:</td>
                    <td> <input type="number" name="telefon"></td>
                </tr>
                <tr>
                    <td> Шифра:</td>
                    <td> <input type="password" name="sifra"></td>
                </tr>
               
                <tr >
                  <td colspan="2"> <button class = "btn" name="register"> <a href="index.html">Региструј се </a></button></td>
                  
                </tr>
            </form>
        </table>
    </div>
    </div>
</div>

</body>

</html>