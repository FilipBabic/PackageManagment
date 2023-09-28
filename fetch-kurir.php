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
		//FROM paketi WHERE (klijent,status_paketa,grad) IN (("WALMART","na_stanju","Bijelo Polje"),("WALMART","dostavljeno","Bijelo Polje"));
        $query = "SELECT * FROM paketi WHERE (". sum() .") IN ((". sum3() .")) AND prijem BETWEEN '$datum1' AND '$datum2';";
    }
    else 
    {
		$datum1 = $_POST["datum1"];  
        $datum2 = $_POST["datum2"];  
        $query = "SELECT * FROM paketi WHERE prijem BETWEEN '$datum1' AND '$datum2';";
    }   
    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();
	function cmp($a, $b)
	{
		return strcmp($a["klijent"], $b["klijent"]);
	};

    if ($total_row > 0){
		$counter = 1;
		usort($result, "cmp");
        foreach ($result as $row)
        {
            $output .= '
            <tr>
                <td class="font-weight-bold bg-info"><a class="text-white ml-2 mr-2" href="edit-paket.php?id='.$row["id"].'">'.$counter.'</a></td>
				<td class="font-weight-bold bg-warning">'.$row["id"].'</td>
                <td>'.$row["klijent"].'</td>
                <td>'.$row["primalac"].'</td>
                <td>'.$row["br_telefona"].'</td>
                <td>'.$row["grad"].'</td>
                <td>'.$row["adresa"].'</td>
                <td>'.$row["kurir"].'</td>
                <td>'.$row["cena_otkupa"].'</td>
               	<td>'.$row["cena_dostave"].'</td>
                <td>'.$row["otkup_kurir"].'</td>
                <td>'.$row["klijentu_placeno"].'</td>
                <td>'.$row["status_paketa"].'</td>
            </tr>
            ';
			$counter = $counter+1;
        }
    }
    else
    {
            $output .= '
            <tr>
            <td colspan=13 align="center">Nema podataka za ovu pretragu</td>
            </tr>
            ';
    }
    echo $output;
?>