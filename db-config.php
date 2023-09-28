<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'rootnew');
define('DB_PASSWORD', 'Oldschool!2022');
define('DB_NAME', 'johnuser_upravljanje_paketima');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
