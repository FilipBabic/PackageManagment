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
    <title>Izmeni Kurira</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-2">
  <div class="page-header">
      <h2>Izmeni Kurira</h2>
  </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            include 'db-config.php';
            $query = "SELECT * FROM kuriri WHERE id='" . $_GET["id"] . "'";
            $result=mysqli_query($conn,$query);
            $kurir = mysqli_fetch_assoc($result);
            ?>
            <form action="update-kurir.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" class="form-control" required="">
              <div class="form-group">
                <label>Ime Kurira</label>
                <input type="text" name="ime" class="form-control" value="<?php echo $kurir['ime']; ?>" required="">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $kurir['email']; ?>">
              </div>                
              <div class="form-group">
                <label>Broj telefona</label>
                <input type="text" name="telefon" class="form-control" value="<?php echo $kurir['telefon']; ?>">
              </div>
              <div class="form-group">
                <label>Adresa</label>
                <input type="text" name="adresa" class="form-control" value="<?php echo $kurir['adresa']; ?>">
              </div>
              <div class="form-group">
                <label>Broj Računa</label>
                <input type="text" name="br_racuna" class="form-control" value="<?php echo $kurir['br_racuna']; ?>">
              </div>             
              <button type="submit" class="btn btn-primary" value="submit">Sačuvaj</button>
              <span onClick={window.history.back()} class="btn btn-dark float-right mt-4"><< Nazad</span>
            </form>
        </div>
    </div>        
</div>
</body>
</html>