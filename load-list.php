<?php

    $connect = new PDO("mysql:host=localhost;dbname=**********","rootnew","***********");

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

    if ($total_row > 0){
		$counter = 1;
        foreach ($result as $row)
        {
			$broj = $row["broj_liste"];
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
                <td><select name="promeni_status" id="promeni_status'.$row["id"].'" onchange="promeniStatus('.$row["id"].',this)" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker">
                
				<script>
					var element = "'.$row["status_paketa"].'";
					if (element == "dostavljeno"){
						var test = document.getElementById("promeni_status'.$row["id"].'");
						test.innerHTML = `
						<option selected value="'.$row["status_paketa"].'">
							'.$row["status_paketa"].'
						</option>
						<option value="na_stanju">
							na_stanju
						</option>
						<option value="vraceno">
							vraceno
					</option>`;
					}else if(element == "na_stanju"){
						var test = document.getElementById("promeni_status'.$row["id"].'");
						test.innerHTML = `
						<option selected value="'.$row["status_paketa"].'">
							'.$row["status_paketa"].'
						</option>
						<option value="dostavljeno">
							dostavljeno
						</option>
						<option value="vraceno">
							vraceno
						</option>`;
					}else if(element=="vraceno"){
						var test = document.getElementById("promeni_status'.$row["id"].'");
						test.innerHTML = `
						<option selected value="'.$row["status_paketa"].'">
							'.$row["status_paketa"].'
						</option><option value="dostavljeno">
							dostavljeno
						</option>
						<option value="na_stanju">
							na_stanju
						</option>`;
					};
				</script>				
                </select></td>
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
