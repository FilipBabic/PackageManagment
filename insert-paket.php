<?php
if(count($_POST)>0)
{    
   include 'db-config.php';
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
	
	$query2 = "SELECT MAX(id) FROM paketi";
	$result=mysqli_query($conn,$query2);
   	$id_paketa = mysqli_fetch_assoc($result);
	$id = $id_paketa['MAX(id)'] + 1;
   $query = "INSERT INTO paketi VALUES (NULL,now(),'$klijent','$primalac','$br_telefona','$kurir','$grad[0]','$adresa',$cena_dostave,$cena_otkupa,$otkup_kurir,'$status_paketa','$klijentu_placeno','$broj_liste')";

   if (mysqli_query($conn, $query)) {
      $msg = 1;
   } else {
      $msg = 4;
   }
}
header ("Location: edit-paket.php?id=".$id."");
?>