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
    <title>Spisak Gradova</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <?php include 'msg.php';  ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
        </div>
		<div class="row justify-content-center">
        <div class="col-12">
          <h2 class="float-left mt-4">Spisak Gradova</h2>
          <table class="table table-striped table-responsive">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Ime</th>
					<th scope="col">Kurir</th>
					<th scope="col"></th>
					<th scope="col"></th>
                  <th scope="col"><a href="dodaj-grad.php" class="btn btn-info float-right">DODAJ GRAD</a></th>
                </tr>
              </thead>
              <tbody>              
                <?php
                include 'db-config.php';
                $query="select * from gradovi";
                $result=mysqli_query($conn,$query);
                ?>
                <?php if ($result->num_rows > 0): ?>
                <?php while($array=mysqli_fetch_row($result)): ?>
                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
					<td><?php echo $array[2];?></td>
					<td></td>
					<td></td>
                    <td><a href="obrisi-grad.php?id=<?php echo $array[0];?>" class="btn btn-danger float-right ml-2" style="background-color: red" onclick="myFunction()">Obriši</a>
                      <a href="izmeni-grad.php?id=<?php echo $array[0];?>" class="btn btn-info float-right">Izmeni</a></td>                       
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                  <td colspan="3" rowspan="1" headers="">Nema upisanih gradova</td>
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
</div>
	<script>
		function myFunction() {
			
		  if (confirm('Are you sure you want to save this thing into the database?')) {
  // Save it!
  console.log('Thing was saved to the database.');
} else {
  // Do nothing!
  console.log('Thing was not saved to the database.');
}

		}
	</script>
</body>
</html>
