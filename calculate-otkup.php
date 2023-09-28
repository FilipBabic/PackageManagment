<?php

    $connect = new PDO("mysql:host=localhost;dbname=johnuser_upravljanje_paketima","rootnew","Oldschool!2022");

    if($_POST != '' && !($_POST["klijent"]=="bez" && $_POST["kurir"]=="bez" && $_POST["grad"]=="bez" && $_POST["status"]=="bez" && $_POST["placeno"]=="bez")) 
    {                       
        $datum1 = $_POST["datum1"];  
        $datum2 = $_POST["datum2"];     
        function sum() {
            $klijent = $_POST["klijent"];
            $kurir = $_POST["kurir"];
            $grad = $_POST["grad"];  
            $status = $_POST["status"];
			$placeno = $_POST["placeno"];
            $upit = "";
            $a=array();
            if($klijent!='bez'){ 
                array_push($a, "klijent");
            };
            if($kurir!='bez'){
                array_push($a, "kurir");
            };
            if($grad!='bez'){
                array_push($a, "grad");
            };
            if($status!='bez'){
                array_push($a, "status_paketa");
            };
			if($placeno!='bez'){
                array_push($a, "klijentu_placeno");
            };
            $upit = implode(", ",$a);
            return $upit;
        };
        function sum3(){
            $klijent = $_POST["klijent"];
            $kurir = $_POST["kurir"];
            $grad = $_POST["grad"];  
            $status = $_POST["status"];
			$placeno = $_POST["placeno"];
            $a = array();
            $upit = "";
            if($klijent!='bez'){
                array_push($a, "'$klijent'");
            };
            if($kurir!='bez'){
                array_push($a, "'$kurir'");
            };
            if($grad!='bez'){
                array_push($a, "'$grad'");
            }
            if($status!='bez'){
                array_push($a, "'$status'");
            };
			if($placeno!='bez'){
                array_push($a, "'$placeno'");
            };
            $upit = implode(", ",$a);
            return $upit;
        };
        $query = "SELECT * FROM paketi WHERE (". sum() .") IN ((". sum3() .")) AND prijem BETWEEN '$datum1' AND '$datum2';";
    }
    else 
    {
        $datum1 = $_POST["datum1"];
        $datum2 = $_POST["datum2"];     
        $query = "SELECT * FROM paketi WHERE prijem BETWEEN '$datum1' AND '$datum2'";
    } 

    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();
	$otkup_sum = 0;
	$otkup_kurir = 0;
	$cena_dostave = 0;
	
	$id = '';
    if ($total_row > 0){
        foreach ($result as $row)
        {
			$otkup_sum = $otkup_sum + $row["cena_otkupa"];
			$otkup_kurir = $otkup_kurir + $row["otkup_kurir"];
			$cena_dostave = $cena_dostave + $row["cena_dostave"];
			$nesto = $row["id"];
			$id .= "$nesto, ";
        }
    }
    else
    {
            $otkup_sum = 0;
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
           	<th class='text-center' scope='col'>$otkup_sum €</th>
            <th class='text-center' scope='col'>$cena_dostave €</th>
            <th class='text-center' scope='col'>$otkup_kurir €</th>
            <th class='border-0 bg-dark text-white text-center' colspan='2' scope='col'>UKUPAN OTKUP: $ukupan_otkup €</th>
           </tr>;"
?>