<!DOCTYPE html>
<?php
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

    $connect = new PDO("mysql:host=localhost;dbname**********rootnew","**********");

    $query = "SELECT DISTINCT ime FROM kuriri";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();
?>
<html lang="sr">
<head>
<meta charset="utf-8">
    <title>Dodaj Grad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-2">
    <div class="row text-center justify-content-center">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
            <div class="page-header">
                <h2>Dodaj Grad u bazu podataka</h2>
            </div>
            <form action="insert-grad.php" method="post">
                <div class="form-group">
                    <label>Ime Grada</label>
                    <input type="text" name="ime" class="form-control" required="">
                </div>  
				<div class="form-group">
				<label>Dodaj kurira za grad</label>
                <select name="kurir" id="kurir" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker" required>
                <option selected></option>
                    <?php 
                        foreach($result as $row)
                        {
                            echo '<option value="'.$row["ime"].'">'.$row["ime"].'</option>';
                        }
                    ?>
                </select>
				</div>
                <input type="submit" class="btn btn-primary float-left" name="submit" value="Sačuvaj">
                <span onClick={window.history.back()} class="btn btn-dark float-right">Nazad</span>
            </form>
        </div>
    </div>        
</div>
</body>
</html>
