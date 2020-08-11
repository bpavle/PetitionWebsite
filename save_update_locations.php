
 <?php

$link=mysqli_connect("localhost:3308", "root","","petition");

if (isset($_POST["update"])){

$i=1;
while($_POST["id$i"]){
    
    $id=$_POST["id$i"];

    $naziv= $_POST["naziv$i"];
    
    $grad= $_POST["grad$i"];
    
    $opstina= $_POST["opstina$i"];
    
    $ulica= $_POST["ulica$i"];
    
    $x= $_POST["x$i"];
    
    $y= $_POST["y$i"];
    



   if (isset($_POST["brisi$i"])) {

        $sql = "DELETE FROM location 

        WHERE location_id=$id;

        ";  
        mysqli_query($link,$sql);

    }

    $sql = "UPDATE location SET

    

    name='$naziv',

    city='$grad',

    municipality='$opstina',

    street='$ulica',

    x_coordinate='$x',

    y_coordinate='$y'

    WHERE location_id=$id;

    ";
    mysqli_query($link,$sql);



    $i++;
}

}






mysqli_close($link);

//vracanje na sign.html
$newURL = "locations.html";
header('Location: '.$newURL);
die(); 


?>
 
 




