<!DOCTYPE html>
<?php
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
    $connect = new PDO("mysql:host=localhost;dbname=**********","rootnew","**********");

    $query1 = "SELECT DISTINCT ime FROM kuriri";
    $query2 = "SELECT DISTINCT ime,avansni_klijent FROM klijenti";
    $query3 = "SELECT DISTINCT ime,kurir FROM gradovi";
	$query4 = "SELECT DISTINCT ime FROM liste";

    $statement1 = $connect->prepare($query1);
    $statement2 = $connect->prepare($query2);
    $statement3 = $connect->prepare($query3);
	$statement4 = $connect->prepare($query4);

    $statement1->execute();
    $statement2->execute();
    $statement3->execute();
	$statement4->execute();

    $result1 = $statement1->fetchAll();
    $result2 = $statement2->fetchAll();
    $result3 = $statement3->fetchAll();
	$result4 = $statement4->fetchAll();
?>
<html lang="sr">
<head>
  <title>Unesi paket</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
			<div class="row" style="background-color:red" id="header">
				<p class="col-4 text-left text-light mt-3 pl-4">UNESI PAKET</p>
					<p class="col-4 text-center text-light mt-3" id="name"><script>var today = new Date();
            var months = ["JANUAR", "FEBRUAR", "MART", "APRIL", "MAJ", "JUN", "JUL", "AVGUST", "SEPTEMBAR", "OKTOBAR", "NOVEMBAR", "DECEMBAR"];                   
            var datum1 = today.getDate()+'.'+(months[today.getMonth()])+'.'+today.getFullYear();
	document.getElementById("name").innerHTML = 'DATUM: '+datum1;</script></p>
					<a href="/" class="col-xs-12 col-md-4 text-right text-light mt-1 pr-4"><img src="go-express-logo-white.png" height="46" width="auto" alt="LOGO"/></a>
				</div>
			</div>
	<div class="container">
    <div class="card mt-4 mb-4">
        <div class="card-body">
		<!-- <span onClick={window.history.back()} class="btn btn-dark btn-block text-center"><< Nazad</span>-->
        <form action="insert-paket.php" method="post" class="mt-4">
			<div class="row">
            <div class="col-6 form-group mt-3">
                <h6>POŠILJALAC</h6>
                    <select name="klijent" id="klijent" class="form-control" required>
						<option class="text-center"></option>
                    <?php 
						foreach($result2 as $row)
                        {
                            if($row['ime']!=$customer['klijent']){
                            echo '<option class="text-center" value="'.$row["ime"].'+'.$row[1].'">'.$row["ime"].'</option>';
                        }
                        }
                    ?>
                    </select>
				<div id="klijent-email"></div>
            </div>
				<div class="col-6 form-group mt-3">
                <h6>PRIMALAC</h6>
                    <select name="grad" id="grad" class="form-control mb-3" required>
						<option class="text-center" value="">Izaberi grad</option>
                    <?php 
                        foreach($result3 as $row)
                        {
                            if($row['ime']!=$customer['grad']){
                            echo '<option class="text-center" value="'.$row["ime"].'+'.$row[1].'">'.$row["ime"].' (Kurir '.$row[1].')</option>';
                        }
                        }
                    ?>
                    </select>
					<input type="text" name="primalac" class="form-control text-center mb-3" placeholder="Ime i prezime" required>
					<input type="text" name="br_telefona" class="form-control text-center mb-3" placeholder="Broj telefona" required>
					<input type="text" name="adresa" class="form-control text-center mb-3" placeholder="Adresa" required>
            </div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-6">
					<h6 class="border mt-3 p-2">KURIR</h6>
					<h6 class="border mt-3 p-2">PACKING LISTA</h6>
					<h6 class="border mt-3 p-2">CIJENA DOSTAVE(EURO)</h6>
				</div>
            <div class="col-6 form-group mt-3">               
                    <select name="kurir" id="kurir" class="form-control">
                    <?php 
                        foreach($result1 as $row)
                        {
                            if($row['ime']!=$customer['kurir']){
                            echo '<option class="text-center" value="'.$row["ime"].'">'.$row["ime"].'</option>';
                        }
                        }
                    ?>
                    </select>
					<select name="br_liste" id="br_liste" class="form-control text-center mt-3">
						<option class="text-center" value="bez">bez</option>
						<?php 
							foreach($result4 as $row)
							{								
								echo '<option class="text-center" value="'.$row["ime"].'">'.$row["ime"].'</option>';
							}
						?>
                    </select>
					<input type="text" name="cena_dostave" class="form-control text-center mt-3" placeholder="Cijena dostave" required>
            </div>
			</div>
			<hr/>
			<h5 class="mt-3 p-2 text-center">OTKUP</h5>
			<div class="row">
				<div class="col-10 offset-1 bg-light border rounded mb-3">
					<div class="row">
					<div class="col-5 mt-3">VRIJEDNOST OTKUPA ( EURO )</div>
					<div class="col-5">
					<input type="text" name="samo_otkup" id="samo_otkup" class="form-control text-center mt-2 mb-2" placeholder="0.0" disabled>
					</div>
					<div class="col-2">
					<input type="checkbox" name="box_otkup" id="box_otkup" class="form-control text-center mt-2 mb-2" disabled>
					</div>
					</div>	
				</div>
			</div>
			<hr/>
			<h5 class="mt-3 p-2 text-center">OTKUP PO KURIRU</h5>
			<div class="row">
				<div class="col-10 offset-1 bg-light border rounded mb-3">
					<div class="row">
					<div class="col-5 mt-3">VRIJEDNOST OTKUPA ( EURO )</div>
					<div class="col-5">
					<input type="text" name="otkup_kurir" id="otkup_kurir" class="form-control text-center mt-2 mb-2" placeholder="0.0" disabled>
					</div>
					<div class="col-2">
					<input type="checkbox" name="box_kurir" id="box_kurir" class="form-control text-center mt-2 mb-2" disabled>
					</div>
					</div>	
				</div>
			</div>
			<hr/>
			<h5 class="mt-3 p-2 text-center">STATUS PAKETA</h5>
			<div class="row" data-toggle="buttons">
				<div class="col-1"></div>
				  <label class="btn btn-secondary col-3 text-center ml-3 mr-3">
					<input type="radio" name="options" style="accent-color: green;" value="na_stanju" id="option1" checked> NA STANJU
				  </label>
				  <label class="btn btn-secondary col-3 text-center ml-3 mr-3">
					<input type="radio" name="options" style="accent-color: yellow" value="dostavljeno" id="option2"> DOSTAVLJENO
				  </label>
				  <label class="btn btn-secondary col-3 text-center ml-3 mr-3">
					<input type="radio" name="options" style="accent-color: red" value="vraceno" id="option3"> VRAĆENO
				  </label>
			</div>
			<hr/>
			<div class="row">
				<h5 class="col-6 mt-3" style="color:red" id="placeno">PLAĆENO POŠILJAOCU</h5>
				<div class="col-2"></div>
				<div class="col-2 text-success text-center mt-3">
					<label class="form-group">
						<input type="radio" name="placeno" style="accent-color: green" value="da" id="option33"><br/> DA
				  	</label>
				</div>
				<div class="col-2 text-success text-center mt-3">
					<label class="form-group text-danger text-center">
						<input type="radio" name="placeno" style="accent-color: red" value="ne" id="option44" checked><br/> NE
				  	</label>
				</div>
			</div>
			<hr/>
			<div class="row mt-3">
				<div class="col-2 mt-3">POTPIŠI</div>
				<div class="col-3 border-bottom mt-3"></div>
				<div class="col-1"></div>
				<div class="col-3 border-bottom mt-3"></div>
				<div class="col-1"></div>
				<!--<div class="col-1 text-cener">
					 <div class="btn btn-dark" onclick="printData()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
</svg>
					</div> 
				</div>-->
				<div class="col-2 text-center mt-3">
				<button type="submit" name="submit" class="btn btn-success">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/>
					</svg></button>
				</div>
				
			</div>
			<div class="row mt-3">
				<div class="col-2"></div>
				<div class="col-3 text-center">POŠILJALAC</div>
				<div class="col-1"></div>
				<div class="col-3 text-center">GO EXPRESS</div>
				<div class="col-1"></div>
				<div class="col-1 text-cener">					
				</div>
				<div class="col-1 text-center">
				</div>				
			</div>
            </form>
            </div>
</div>
	</div>
	<script>
		function printData()
			{
			   print();
			};
</script>
</body>
</html>
<script>
    $(document).ready(function(){
		function load_klijent_params(ime=''){
            $.ajax({
                url: "load-klijent-params.php",
                method: "POST",
                data: {ime:ime},
                success: function(data){
                    $('#klijent-email').html(data);
                }
            })
        };
		
		$('input[type=radio][name=placeno]').change(function() {
			console.log(this.value);
			if (this.value == 'da') {
                document.getElementById('header').style.backgroundColor = 'green';
				document.getElementById('placeno').style.color = 'green';
            }
            else if (this.value == 'ne') {
                document.getElementById('header').style.backgroundColor = 'red';
				document.getElementById('placeno').style.color = 'red';
            }
        });
		$('#grad').change(function(){
			var grad = $('#grad').val();
			console.log(grad);
			const gradkurir = grad.split("+");
			let kurir22 = gradkurir[1];
			console.log(kurir22);
			document.getElementById("kurir").value = kurir22;
		});
		$('#kurir').change(function(){
			var grad = $('#kurir').val();
			console.log(grad);
		});
		$('#klijent').change(function(){
			var klijent = $('#klijent').val();
			console.log(klijent);
			var getValue = document.getElementById('klijent').selectedOptions[0].value;
			const klijentavans = getValue.split("+");
			let avans = klijentavans[1];
			console.log("AVANS", avans);
			console.log("LIJENTAVANS", klijentavans[0]);			
			console.log("MAGIC22", getValue);
			if(avans=='da'){
				document.getElementById("box_kurir").checked = false;
				document.getElementById("box_otkup").checked = true;
				$('#samo_otkup').attr('disabled',false);
				$('#box_otkup').attr('disabled',false);
				$("#option33").prop('checked', true);
				document.getElementById('header').style.backgroundColor = 'green';
				document.getElementById('placeno').style.color = 'green';
				console.log("DA");
			}else if(avans=='ne'){
				document.getElementById("box_kurir").checked = false;
				document.getElementById("box_otkup").checked = true;
				$('#samo_otkup').attr('disabled',false);
				$('#box_otkup').attr('disabled',false);
				$("#option44").prop('checked', true);
				document.getElementById('header').style.backgroundColor = 'red';
				document.getElementById('placeno').style.color = 'red';				
				console.log("NE");
			}
			var ime = klijentavans[0]
			if(ime!=""){				
				load_klijent_params(ime);
			}else{
				$('#klijent-email').text("");
			}
			
		});
		$("#box_otkup").change(function() {
			if($(this).prop('checked')) {
				$("#box_kurir").attr("checked",false);
				$('#otkup_kurir').attr('disabled',true);
				$('#otkup_kurir').val("0.0");
				$('#box_kurir').attr('disabled',true);
				$('#samo_otkup').attr('disabled',false);
			} else {				
				$('#box_otkup').attr('disabled',true);
				$('#samo_otkup').attr('disabled',true);
				$('#box_kurir').attr('disabled',false);
				$('#samo_otkup').val("0.0");
				$("#box_kurir").attr("checked",true);				
				$('#otkup_kurir').attr('disabled',false);
			}
		});
		$("#box_kurir").change(function() {
			if($(this).prop('checked')) {
				$("#box_otkup").attr("checked",false);
				$('#box_otkup').attr('disabled',true);
				$('#samo_otkup').attr('disabled',true);
				$('#samo_otkup').val("0.0");
				$('#otkup_kurir').attr('disabled',false);
			} else {
				$('#box_otkup').attr('disabled',false);
				$('#box_otkup').attr("checked",true);
				$('#box_kurir').attr('disabled',true);
				$('#otkup_kurir').val("0.0");
				$('#samo_otkup').attr('disabled',false);
				$('#otkup_kurir').attr('disabled',true);
			}
		});
		
    });    
</script>
