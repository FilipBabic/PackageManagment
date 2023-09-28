<?php
if(count($_POST)>0){
include 'db-config.php';
$query = "UPDATE gradovi set id='" . $_POST['id'] . "', 
ime='" . $_POST['ime'] . "',
kurir='" . $_POST['kurir'] . "' 
WHERE id='" . $_POST['id'] . "'";
 if (mysqli_query($conn, $query)) {
    $msg = 2;
 } else {
    $msg = 4;
 }
}
header ("Location: spisak-gradova.php?msg=".$msg."");
?>