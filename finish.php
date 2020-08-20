<?php

session_start();
require_once("config.php");
if(isset($_SESSION["status"]) && isset($_POST["finish"])){
    for ($i=0; $i < count($_POST["taken_over"]); $i++) { 
        
        if(isset($_POST["taken_over"]))
        echo " potpis prikupljen ".$_POST["taken_over"][$i]."<br>";
        $id=$_POST["taken_over"][$i];
        $sql="UPDATE sign set taken_over=1 where sign_id=$id ";
        mysqli_query($link,$sql);   
    }
}
 $sql="UPDATE sign set taken_over=0 where taken_over=2";
mysqli_query($link,$sql); 

//vracanje na sign.html
$newURL = "complete_signatures.html";
header('Location: '.$newURL);
die(); 
  