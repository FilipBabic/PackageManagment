<?php

if(count($_POST)>0)
{    
   include 'db-config.php';

   $ime = $_POST['ime'];
   $pib = $_POST['pib'];
   $email = $_POST['email'];
   $telefon = $_POST['telefon'];
   $adresa = $_POST['adresa'];
   $br_racuna = $_POST['br_racuna'];
   $avansni_klijent = $_POST['avansni'];

   $query = "INSERT INTO klijenti (ime,avansni_klijent,created,email,pib,telefon,br_racuna,adresa)
   VALUES ('$ime','$avansni_klijent',now(),'$email','$pib','$telefon','$br_racuna','$adresa')";
 
   if (mysqli_query($conn, $query)) {
      $msg = 1;
   } else {
      $msg = 4;
   }

}
  header ("Location: spisak-klijenata.php?msg=".$msg."");
?>