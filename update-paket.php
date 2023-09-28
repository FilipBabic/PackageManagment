<?php
if(count($_POST)>0)
{    
   include 'db-config.php';
	$id = $_POST['id_paketa'];
	$klijentv = $_POST['klijent'];
	$klijent = substr($klijentv, 0, -3);
	$grad1 = $_POST['grad'];
    $kurir = $_POST['kurir'];
	$grad = explode("+",$grad1);
	$primalac = $_POST['primalac'];
	$br_telefona = $_POST['br_telefona'];
	$adresa = $_POST['adresa'];
	$cena_dostave = $_POST['cena_dostave'];
	$broj_liste = '';
	$otkup_kurir = 0.0;
	$cena_otkupa = 0.0;
	if ($_POST['samo_otkup'] != 0.0){
		$cena_otkupa = $_POST['samo_otkup'];
	}elseif ($_POST['otkup_kurir'] != 0.0){
		$otkup_kurir = $_POST['otkup_kurir'];
	};
	if ($_POST['br_liste']=='bez'){
		$broj_liste = 'bez';
	}else{
		$broj_liste = $_POST['br_liste'];
	};
	$status_paketa = $_POST['options'];
	$klijentu_placeno = $_POST['placeno'];
	
   $query = "UPDATE paketi SET id='" . $id . "', klijent='" . $klijent . "', primalac='" . $primalac ."', br_telefona='" . $br_telefona ."', kurir='" . $kurir ."', grad='" . $grad[0] ."', adresa='" . $adresa ."', cena_dostave=$cena_dostave, cena_otkupa=$cena_otkupa,otkup_kurir=$otkup_kurir, status_paketa='" . $status_paketa ."', klijentu_placeno='" . $klijentu_placeno ."', broj_liste='" . $broj_liste ."' WHERE id='" . $id . "'";

   if (mysqli_query($conn, $query)) {
      $msg = 1;
   } else {
      $msg = 4;
   }
}
header ("Location: index.php?msg=".$msg."");
?>