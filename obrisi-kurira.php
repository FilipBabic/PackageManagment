<?php

include 'db-config.php';
$query = "DELETE FROM kuriri WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($conn, $query)) {
    $msg = 3;
} else {
    $msg = 4;
}
header ("Location: spisak-kurira.php?msg=".$msg."");
?>