<?php

if(count($_POST)>0)
{    
   include 'db-config.php';

   $ime = $_POST['ime'];
   $telefon = $_POST['telefon'];
   $email = $_POST['email'];
   $adresa = $_POST['adresa'];
   $br_racuna = $_POST['br_racuna'];

   $query = "INSERT INTO kuriri (ime,telefon,created,email,adresa,br_racuna)
   VALUES ('$ime','$telefon',now(),'$email','$adresa','$br_racuna')";

   if (mysqli_query($conn, $query)) {
      $msg = 1;
   } else {
      $msg = 4;
   }
}
header ("Location: spisak-kurira.php?msg=".$msg."");
?>