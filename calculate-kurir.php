<?php

    $connect = new PDO("mysql:host=localhost;dbname=**********","rootnew","**********");

    if($_POST != '') 
    {                       
        $ime = $_POST["ime"];  
        $query = "SELECT * FROM paketi WHERE broj_liste='$ime'";
    }
    else 
    {
        $query = "SELECT * FROM paketi";
    }   
    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();
	$otkup_sum = 0;
	$otkup_kurir = 0;
	$cena_dostave = 0;
	$kurir_kasa = 0;
	
	$id = '';
    if ($total_row > 0){
        foreach ($result as $row)
        {
			$otkup_sum = $otkup_sum + $row["cena_otkupa"];
			$cena_otkupa = $row["cena_otkupa"];
			$otkup_kurir = $row["otkup_kurir"];
			$cena_dostave = $row["cena_dostave"];
			$status_paketa = $row["status_paketa"];
			$placeno = $row["klijentu_placeno"];
			$nesto = $row["id"];
			$id .= "$nesto, ";
			if ($cena_otkupa > 0.0 && $status_paketa=="dostavljeno"){
				$kurir_kasa = $kurir_kasa + $cena_otkupa + $cena_dostave;
			};
			if($cena_otkupa > 0.0 && $status_paketa=="na_stanju"){
				$kurir_kasa = $kurir_kasa;
			};
			if ($otkup_kurir > 0.0 && $status_paketa=="dostavljeno" && $placeno=="ne"){
				$kurir_kasa = $kurir_kasa + $otkup_kurir + $cena_dostave;
			};
			if ($otkup_kurir > 0.0 && $status_paketa=="dostavljeno" && $placeno=="da"){
				$kurir_kasa = $kurir_kasa + $cena_dostave;
			};
			if ($otkup_kurir > 0.0 && $status_paketa=="na_stanju" && $placeno=="ne"){
				$kurir_kasa = $kurir_kasa;
			};
			if($otkup_kurir > 0.0 && $status_paketa=="na_stanju" && $placeno=="da"){
				$kurir_kasa = $kurir_kasa - $otkup_kurir;
			};
        }
    }
    else
    {
            $otkup_sum = '';
    }
	$new = rtrim($id, ", ");
	$ukupan_otkup = $otkup_sum + $otkup_kurir;
    echo "<tr>
			<th class='border-0' scope='col'></th>
            <th class='border-0' scope='col'></th>
			<th class='border-0' scope='col'></th>
            <th class='border-0' scope='col'></th>
            <th class='border-0' scope='col'></th>
            <th class='border-0' scope='col'></th>
            <th class='border-0'><div name='paket_id' id='paket_id' value='$new'></div></th>
           	<th class='border-0' scope='col'></th>
            <th class='border-0' scope='col'></th>
            <th class='border-0' scope='col'></th>            
            <th class='text-center bg-warning' colspan='2' scope='col'>KURIR STANJE:<br/>$kurir_kasa €</th>
           </tr>;"
?>
