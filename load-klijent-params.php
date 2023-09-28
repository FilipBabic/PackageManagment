<?php
    $connect = new PDO("mysql:host=localhost;dbname=johnuser_upravljanje_paketima","rootnew","Oldschool!2022");

    if(count($_POST)>0)
    {              
        $ime = $_POST["ime"]; 
        $query = "SELECT * FROM klijenti WHERE ime='$ime'";
    }
    else 
    {
        $query = "";
    }    
    $statement = $connect->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();

    if ($total_row > 0){
        foreach ($result as $row)
        {
            $output = '
			<div class="text-muted mt-3 pl-3">
                <p>pib: '.$row["pib"].'</p>
                <p>email: '.$row["email"].'</p>
                <p>telefon: '.$row["telefon"].'</p>
                <p>adresa: '.$row["adresa"].'</p>
                <p>broj računa: '.$row["br_racuna"].'</p>
				<p>avansni klijent: '.$row["avansni_klijent"].'</p>
				</div>
            ';
        }
    }
    else
    {
            $output = '<div><a href="dodaj-klijenta.php" class="btn btn-dark mt-3">Dodaj klijenta</a></div>';
    }
    echo $output;
?>