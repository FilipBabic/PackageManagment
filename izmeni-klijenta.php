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
    <title>Izmeni Klijenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-2">
  <div class="page-header">
      <h2>Izmeni Klijenta</h2>
  </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            include 'db-config.php';
            $query = "SELECT * FROM klijenti WHERE id='" . $_GET["id"] . "'";
            $result=mysqli_query($conn,$query);
            $klijent = mysqli_fetch_assoc($result);
            ?>
            <form action="update-klijent.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" class="form-control" required="">
              <div class="form-group">
                <label>Ime Klijenta</label>
                <input type="text" name="ime" class="form-control" value="<?php echo $klijent['ime']; ?>" required="">
              </div>
				<div class="form-group mt-3">
					<label>Avansni klijent</label><br/>
				  <label class="text-center">
					<input type="radio" name="avansni" style="accent-color: green;" value="da" id="option1" checked>
					DA
				  </label>
				  <label class="text-center">
					<input type="radio" name="avansni" style="accent-color: red" value="ne" id="option3"> NE
				  </label>
				</div>
				<script>
					// Check
					let avansni = "<?php echo $klijent['avansni_klijent']; ?>"
					if (avansni == "da"){
						document.getElementById("option1").checked = true;
						document.getElementById("option3").checked = false;
					}else{
						document.getElementById("option3").checked = true;
						document.getElementById("option1").checked = false;
					};
				</script>
              <div class="form-group">
                <label>PIB</label>
                <input type="text" name="pib" class="form-control" value="<?php echo $klijent['pib']; ?>">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $klijent['email']; ?>">
              </div>
              <div class="form-group">
                <label>Broj telefona</label>
                <input type="text" name="telefon" class="form-control" value="<?php echo $klijent['telefon']; ?>">
              </div>
              <div class="form-group">
                <label>Adresa</label>
                <input type="text" name="adresa" class="form-control" value="<?php echo $klijent['adresa']; ?>">
              </div>
              <div class="form-group">
                <label>Broj Računa</label>
                <input type="text" name="br_racuna" class="form-control" value="<?php echo $klijent['br_racuna']; ?>">
              </div>                            
              <button type="submit" class="btn btn-primary" value="submit">Sačuvaj</button>
              <span onClick={window.history.back()} class="btn btn-dark float-right mt-4"><< Nazad</span>
            </form>
        </div>
    </div>        
</div>
</body>
</html>