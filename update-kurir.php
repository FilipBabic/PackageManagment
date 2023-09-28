<?php
if(count($_POST)>0){
include 'db-config.php';
$query = "UPDATE kuriri set id='" . $_POST['id'] . "', 
ime='" . $_POST['ime'] . "',
email='" . $_POST['email'] . "',
br_racuna='" . $_POST['br_racuna'] . "',
adresa='" . $_POST['adresa'] . "', 
telefon='" . $_POST['telefon'] . "' 
WHERE id='" . $_POST['id'] . "'";
 if (mysqli_query($conn, $query)) {
    $msg = 2;
 } else {
    $msg = 4;
 }
}
header ("Location: spisak-kurira.php?msg=".$msg."");
?>