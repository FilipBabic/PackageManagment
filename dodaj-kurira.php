<?php 
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
<meta charset="utf-8">
    <title>Dodaj kurira</title>
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
                <h2>Dodaj Kurira u bazu podataka</h2>
            </div>           
            <form action="insert-kurir.php" method="post">
                <div class="form-group mt-3">
                    <label>Ime Kurira</label>
                    <input type="text" name="ime" class="form-control" required="">
                </div>                        
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Broj telefona</label>
                    <input type="text" name="telefon" class="form-control">
                </div> 
                <div class="form-group">
                    <label>Adresa</label>
                    <input type="text" name="adresa" class="form-control">
                </div>
                <div class="form-group">
                    <label>Broj Računa</label>
                    <input type="text" name="br_racuna" class="form-control">
                </div>
                <input type="submit" class="btn btn-primary float-left" name="submit" value="Sačuvaj">
                <span onClick={window.history.back()} class="btn btn-dark float-right">Nazad</span>
            </form>
        </div>
    </div>        
</div>
</body>
</html>