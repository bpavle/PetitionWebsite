
 <?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["update"])){

$i=1;
while($_POST["id$i"]){
    
    $id=$_POST["id$i"];

    $ime= $_POST["ime$i"];
    
    $prezime= $_POST["prezime$i"];
    
    $email= $_POST["email$i"];
    
    $predlagac= $_POST["predlagac$i"];
    
    $telefon= $_POST["telefon$i"];
    
    $sifra= $_POST["sifra$i"];

    $br_lk= $_POST["br_lk$i"];
    
    $odobren= $_POST["odobren$i"];
    
    $nevazeci= $_POST["nevazeci$i"];
    
    $lose_preporuke= $_POST["lose_preporuke$i"];
    



   if (isset($_POST["brisi$i"])) {

        $sql = "DELETE FROM organizer_administrator 

        WHERE organizer_administrator_id=$id;

        ";  
        mysqli_query($link,$sql);

    }

    $sql = "UPDATE organizer_administrator SET

    

    name='$ime',

    surname='$prezime',

    email='$email',

    recommended_by_organizer_id='$predlagac',

    phone_number='$telefon',

    password='$sifra',

    id_number='$br_lk',

    approved='$odobren', 

    invalid_signature_count='$nevazeci',

    bad_recommendation_count='$lose_preporuke'

    WHERE organizer_administrator_id=$id;

    ";
    mysqli_query($link,$sql);



    $i++;
}

}






mysqli_close($link);

//vracanje na sign.html
$newURL = "organizer.html";
header('Location: '.$newURL);
die(); 


?>
 
 




