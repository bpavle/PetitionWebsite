<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$sql="CREATE SCHEMA IF NOT EXISTS `Petition` DEFAULT CHARACTER SET utf8 ;
USE `Petition` ;
CREATE TABLE IF NOT EXISTS `Petition`.`Location` (
  `Location_id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Address` VARCHAR(45) NULL,
  `municipality` VARCHAR(45) NULL,
  `xcoordinate` DOUBLE NOT NULL,
  `ycoordinate` DOUBLE NOT NULL,
  PRIMARY KEY (`Location_id`),
  )

CREATE TABLE IF NOT EXISTS `Petition`.`Sign` (
  `Sign_id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Surname` VARCHAR(45) NOT NULL,
  `Phone_Number` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `personal_id_number` VARCHAR(45) NULL,
  `Location_id` INT NOT NULL,
  `Number_Of_Appointments` INT NOT NULL,
  `Appointments` VARCHAR(100) NOT NULL,
  `Email_Info` TINYINT NULL,
  `Public_Signature` TINYINT NULL,
  PRIMARY KEY (`Sign_id`),
  CONSTRAINT `Location_id`
    FOREIGN KEY (`Location_id`)
    REFERENCES `Petition`.`Location` (`Location_id`)
    )
";

mysqli_query($link,$sql);

mysqli_close($link);
?>