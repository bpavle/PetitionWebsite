<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$mail_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validacija email adrese-
    //Proveravamo da li je polje mozda ostalo prazno
    if(empty(trim($_POST["mail"]))){
        $mail_err = "Молимо Вас да унесете адресу е поште";
        echo $mail_err;
    } else{
      
//ako polje nije prazno proveravamo da li se adresa vec nalazi u bazi
        $mail = $_POST["mail"];
        $sql = "SELECT email FROM organizer_administrator WHERE email = '$mail' ";
        
        $result= mysqli_query($link,$sql);

        $temp = mysqli_fetch_array($result);//mysqli_fetch_array smesta rezultat upita u numericki ili asocijativni niz kada god
        //kada god se pozove predje se u sledeci red, ali ja ovde ocekujem jedan ili ne jedan niz podataka.
       if($temp["email"]==$mail){
           $mail_err="Мејл адреса већ постоји";
         //Ovde bi mogao da uleti javascript sa nekim alertom npr. Mozda i da boji html polje u kojem je mejl adresa(to moze i bez javascript-a)
         
       }else{
       
       
        
    
    // Validate password
    if(empty(trim($_POST["sifra"]))){
        $password_err = "Поље за шифру не сме бити празно";   
        echo $password_err;  
    } else{
        $password = trim($_POST["sifra"]);
        
    }
    $name=$_POST["ime"];
    $surname=$_POST["prezime"];
    $phone_number=$_POST["telefon"];
    $address=$_POST["adresa"];
    $recommended_by=$_POST["predlagac"];
        // Check input errors before inserting in database
        if(empty($mail_err) && empty($password_err)){
        
            /* nije dodata adresa jer je nema u postavci novog dela zadatka:(  */
            $sql = "INSERT INTO organizer_administrator (email, password,name,surname,recommended_by_organizer_id,phone_number) VALUES ('".$mail."','".$password."','".$name."','".$surname."',".$recommended_by.",'".$phone_number."')";
             
            $result=mysqli_query($link,$sql);
            echo "upit ".$sql." izvrsen";
    
        }
  }
 

   
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
                    <td> <input type="text" name="ime" required></td>
                    
                </tr>
               
                <tr>
                    <td> Презиме:</td>
                    <td> <input type="text" name="prezime" required></td>
                </tr>
                <tr>
                    <td> е-mail:</td>
                    <td> <input type="text" name="mail" required></td>
                </tr>
                <tr>
                    <td> Адреса:</td>
                    <td> <input type="text" name="adresa" required></td>
                </tr>
                <tr>
                    <td> Предлагач:</td>
                    <td> <input type="text" name="predlagac" required></td>
                </tr>
                <tr>
                    <td> Телефон:</td>
                    <td> <input type="number" name="telefon" required></td>
                </tr>
                <tr>
                    <td> Шифра:</td>
                    <td> <input type="password" name="sifra" required></td>
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