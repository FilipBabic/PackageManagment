<?php

    $connect = new PDO("mysql:host=localhost;dbname=johnuser_upravljanje_paketima","rootnew","Oldschool!2022");

    if($_POST != '') 
    {                       
        $ime = $_POST["ime"];    
        $query = "SELECT * FROM liste WHERE ime='$ime'";
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
			foreach ($result as $row){
				echo "<span class='text-info'>".$row["ime"]." | </span>GRAD: ".$row["grad"]."<span class='h6 float-right text-secondary'> datum od: ".substr($row["datum_od"], 0, -8)." do: ".substr($row["datum_do"], 0, -8)."</span>";
			}
    }
    else
    {
            echo "PAKETI KOJI NISU NA PACKING LISTI";
    };    
?>