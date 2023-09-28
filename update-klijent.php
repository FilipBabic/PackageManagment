<?php
if(count($_POST)>0){
include 'db-config.php';
$query = "UPDATE klijenti set id='" . $_POST['id'] . "', 
ime='" . $_POST['ime'] . "',
avansni_klijent='" . $_POST['avansni'] . "',
pib='" . $_POST['pib'] . "', 
email='" . $_POST['email'] . "', 
telefon='" . $_POST['telefon'] . "', 
adresa='" . $_POST['adresa'] . "', 
br_racuna='" . $_POST['br_racuna'] . "' 
WHERE id='" . $_POST['id'] . "'";
 if (mysqli_query($conn, $query)) {
    $msg = 2;
 } else {
    $msg = 4;
 }
}
header ("Location: spisak-klijenata.php?msg=".$msg."");
?>