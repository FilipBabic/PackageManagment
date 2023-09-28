<?php
    $connect = new PDO("mysql:host=localhost;dbname=**********","rootnew","**********");

    if($_POST["datum1"] != '') 
    {              
        $datum1 = $_POST["datum1"];
        $datum2 = $_POST["datum2"];     
        $query = "SELECT * FROM paketi WHERE prijem BETWEEN '$datum1' AND '$datum2'";
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
        foreach ($result as $row)
        {
            $output .= '
            <tr>
            <td class="font-weight-bold bg-info"><a class="text-white ml-2 mr-2" href="edit-paket.php?id='.$row["id"].'">'.$row["id"].'</a></td>
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
