<?php

    $connect = new PDO("mysql:host=localhost;dbname=johnuser_upravljanje_paketima","rootnew","Oldschool!2022");

    if($_POST != '') 
    {                       
        $datum1 = $_POST["datum1"];  
        $datum2 = $_POST["datum2"];
		$paketi = $_POST["paketi"];
		$grad = $_POST["grad"];
		$ime = $_POST["ime"];
		$query = "UPDATE paketi SET broj_liste = '$ime' WHERE id IN ($paketi);";
		$query2 = "INSERT INTO liste (ime,grad,datum_od,datum_do,created) VALUES ('$ime','$grad','$datum1','$datum2',now())";
		$statement = $connect->prepare($query);
		$statement2 = $connect->prepare($query2);
		$statement->execute();
		$statement2->execute();

		$result = $statement->fetchAll();
		$result2 = $statement2->fetchAll();

		$total_row = $statement->rowCount();
		$total_row2 = $statement2->rowCount();
		echo "<div class='text-info'>$ime | Grad: $grad | Datum od: $datum1 | Datum do: $datum2 </div>";
    } 
	else{
		echo "Neuspesno";
	}
    
?>