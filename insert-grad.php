<?php

if(count($_POST)>0)
{    
   include 'db-config.php';

   $ime = $_POST['ime'];
   $kurir = $_POST['kurir'];

   $query = "INSERT INTO gradovi (ime,kurir,created)
   VALUES ('$ime','$kurir',now())";

   if (mysqli_query($conn, $query)) {
      $msg = 1;
   } else {
      $msg = 4;
   }
}
header ("Location: spisak-gradova.php?msg=".$msg."");
?>