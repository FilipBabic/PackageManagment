<?php
if(count($_POST)>0){
include 'db-config.php';
$query = "UPDATE paketi set status_paketa='".$_POST['status_paketa']."' WHERE id='" . $_POST['id'] . "'";
 if (mysqli_query($conn, $query)) {
    $msg = 2;
 } else {
    $msg = 4;
 }
};

?>