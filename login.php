<?php
// Initialize the session

 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Молимо вас да унесете мејл";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Молимо вас да унесете шифру";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT organizer_administrator_id, email, password, approved FROM organizer_administrator WHERE email='".$email."'";

        $result = mysqli_query($link,$sql);
        echo $sql;
        $temp = mysqli_fetch_array($result);
        $id = $temp["organizer_administrator_id"];
        $status = $temp["approved"];
        if($status==2){
          $status="admin";
        }
        else {
          $status = "organizer";
        }
        if($temp["email"]==$_POST["email"]){

          if($temp["password"]==$_POST["password"]){
            session_id("idadminsesije");  
            session_start();
            $_SESSION["loggedin"]=true;
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            $_SESSION["status"] = $status;
            header("Location: index.html");
            echo"Uspesno logovanje email:".$_SESSION["email"];
            
          }else{
            //ovde ce stajati kod za pogresan password
            echo "Pogresan pass";
          }

        }else{
          //ovde stoji kod koji se izvrsi ako ne postoji user sa datim mejlom... npr. prebacivanje na registration.php
          echo "Ne postoji user sa datim mejlom";
          
        }
        
        
        
    
    // Close connection
    mysqli_close($link);
}
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Логовање</title>
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
      </div> -->
      <?php include("fixed.php")?>
<!--       <script src="inactive.js"></script>
 -->
    <div class="content">
        <div class="form-container">
        <h1>Логовање</h1>
        <div class="form" id="login">
        <table>
            <form method = "POST" action ="login.php">
                <tr>
                    
                    <td>е-mail: <input type="text" name="email"></td>
                </tr>
                <tr>
                    
                    <td>Шифра: <input type="password" name="password"></td>
                </tr>
                <tr >
                    
                  <td> <button class = "btn" style="margin-top: 10%;"><a href="admin.html";> Улогуј се</a></button></td>
                  
                </tr>
            </form>
        </table>
    </div>
    </div>

</body>

</html>