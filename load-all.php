<?php

    $connect = new PDO("mysql:host=localhost;dbname=***********","rootnew","***********");
    
	$query = "SELECT * FROM paketi";

    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();
	function cmp($a, $b)
	{
		return strcmp($a["klijent"], $b["klijent"]);
	};

    if ($total_row > 0){		
		usort($result, "cmp");
		$counter = 1;
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
			$counter = $counter +1;
        }
    }
    else
    {
            $output .= '
            <tr>
            <td colspan=12 align="center">Nema podataka za ovu pretragu</td>
            </tr>
            ';
    }
    echo $output;
?>
