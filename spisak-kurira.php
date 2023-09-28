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
    <title>Spisak Kurira</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid mt-4">
<div class="row justify-content-center">
    <div class="col-md-8" align="center">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <?php include 'msg.php';  ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
        </div>
        <div class="col-md-8" align="center">
        <a href="dodaj-kurira.php" class="btn btn-lg btn-info mt-4">DODAJ KURIRA</a>
        </div>
        <div class="col-12">
          <h2 class="float-left mt-4">Spisak Kurira</h2>
            <table class="table table-striped table-responsive">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Ime</th>
                  <th scope="col">Email</th>
                  <th scope="col">Broj Telefona</th>
                  <th scope="col">Adresa</th>
                  <th scope="col">Broj Računa</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'db-config.php';
                $query="select * from kuriri";
                $result=mysqli_query($conn,$query);
                ?>
                <?php if ($result->num_rows > 0): ?>
                <?php while($array=mysqli_fetch_row($result)): ?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[4];?></td>
                    <td><?php echo $array[2];?></td>
                    <td><?php echo $array[5];?></td>
                    <td><?php echo $array[6];?></td>                    
                    <td>                       
                      <a href="obrisi-kurira.php?id=<?php echo $array[0];?>" class="btn btn-danger float-right ml-2" style="background-color: red">Obriši</a>
                      <a href="izmeni-kurira.php?id=<?php echo $array[0];?>" class="btn btn-success float-right">Izmeni</a>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                  <td colspan="3" rowspan="1" headers="">No Data Found</td>
                </tr>
                <?php endif; ?>
                <?php mysqli_free_result($result); ?>
              </tbody>
            </table>
            <div class="container">
            <a href="./" class="btn btn-dark float-right mt-4"><< Nazad</a>
            </div>
        </div>
    </div>        
</div>
</body>
</html>
