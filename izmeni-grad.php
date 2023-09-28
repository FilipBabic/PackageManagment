<!DOCTYPE html>
<?php
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
    $connect = new PDO("mysql:host=localhost;dbname=johnuser_upravljanje_paketima","rootnew","Oldschool!2022");

    $query = "SELECT DISTINCT ime FROM kuriri";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result2 = $statement->fetchAll();
?>
<html lang="sr">
<head>
<meta charset="utf-8">
    <title>Izmeni Grad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-2">
  <div class="page-header">
      <h2>Izmeni Grad</h2>
  </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            include 'db-config.php';
            $query = "SELECT * FROM gradovi WHERE id='" . $_GET["id"] . "'";
            $result=mysqli_query($conn,$query);
            $grad = mysqli_fetch_assoc($result);
            ?>
            <form action="update-grad.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" class="form-control" required="">
              <div class="form-group">
                <label>Ime Grada</label>
                <input type="text" name="ime" class="form-control" value="<?php echo $grad['ime']; ?>" required="">
              </div>
				<div class="form-group">
				<label>Dodaj kurira za grad</label>
                <select name="kurir" id="kurir" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker" required>
                <option value="<?php echo $grad['kurir']; ?>" selected><?php echo $grad['kurir']; ?></option>
                    <?php 
                        foreach($result2 as $row)
                        {
							if($row['ime']!=$grad['kurir']){
                            echo '<option value="'.$row["ime"].'">'.$row["ime"].'</option>';
							}
                        }
                    ?>
                </select>
				</div>                         
              <button type="submit" class="btn btn-primary" value="submit">Sačuvaj</button>
              <span onClick={window.history.back()} class="btn btn-dark float-right mt-4"><< Nazad</span>
            </form>
        </div>
    </div>        
</div>
</body>
</html>