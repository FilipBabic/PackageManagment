<!DOCTYPE html>
<?php
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
    $connect = new PDO("mysql:host=localhost;dbname=johnuser_upravljanje_paketima","rootnew","Oldschool!2022");

    $query = "SELECT DISTINCT ime FROM kuriri";
    $query2 = "SELECT DISTINCT ime FROM klijenti";
    $query3 = "SELECT DISTINCT ime FROM gradovi";
	$query4 = "SELECT COUNT(id) FROM liste";
	$query5 = "SELECT DISTINCT ime FROM liste";

    $statement = $connect->prepare($query);
    $statement2 = $connect->prepare($query2);
    $statement3 = $connect->prepare($query3);
	$statement4 = $connect->prepare($query4);
	$statement5 = $connect->prepare($query5);

    $statement->execute();
    $statement2->execute();
    $statement3->execute();
	$statement4->execute();
	$statement5->execute();

    $result = $statement->fetchAll();
    $result2 = $statement2->fetchAll();
    $result3 = $statement3->fetchAll();
	$result4 = $statement4->fetchAll();
	$result5 = $statement5->fetchAll();
?>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <title>Upravljanje Paketima</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-8" align="center">
				<div class="alert alert-info alert-dismissible fade show" role="alert">
				  <?php include 'msg.php';  ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				  </button>
				</div>
			</div>
		</div>
    <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <a href="unesi-paket.php" class="btn btn-success btn-block mb-3 mt-3 float-right">
                    Unesi Paket
                </a>
            </div>
            <div class="col-md-2">
                <a href="spisak-gradova.php" class="btn btn-info btn-block mb-3 mt-3 float-right">
                    Gradovi
                </a>   
            </div>
            <div class="col-md-2">
                <a href="spisak-klijenata.php" class="btn btn-info btn-block mb-3 mt-3 float-right">
                    Klijenti
                </a>
            </div>
            <div class="col-md-2">
                <a href="spisak-kurira.php" class="btn btn-info btn-block mb-3 mt-3 float-right">
                    Kuriri
                </a>   
            </div>
            <div class="col-md-2">
				<a href="logout.php" class="btn btn-danger mb-3 mt-3 float-right">Izloguj se</a>
            </div>
        </div>
        <div>
        <h4 align="center" class="mt-3">Pretraga paketa</h4>
        <div class="d-flex justify-content-center">
            <a href="./">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-clockwise text-info mt-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                </svg> 
                <p class="text-info">reset</p>           
            </a>
            </div>
        </div>
        <div class="row">
			<div class="col-md-2">				
				<div class="btn btn-dark btn-block text-center mt-5" id="svi_paketi">SVI PAKETI</div>
            </div>
            <div class="col-md-2">
				<h3 class="mb-3 text-center text-dark">KURIR</h3>
                <select name="pretraga_kurira" id="pretraga_kurira" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker">
                <option selected value="bez">BEZ FILTERA</option>
                    <?php 
                        foreach($result as $row)
                        {
                            echo '<option value="'.$row["ime"].'">'.$row["ime"].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
				<h3 class="mb-3 text-center text-dark">KLIJENT</h3>
                <select name="pretraga_klijenata" id="pretraga_klijenata" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker">
                <option selected value="bez">BEZ FILTERA</option>
                    <?php 
                        foreach($result2 as $row)
                        {
                            echo '<option value="'.$row["ime"].'">'.$row["ime"].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
				<h3 class="mb-3 text-center text-dark">GRAD</h3>
            	<select name="pretraga_gradova" id="pretraga_gradova" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker">
                <option selected value="bez">BEZ FILTERA</option>
                    <?php 
                        foreach($result3 as $row)
                        {
                            echo '<option value="'.$row["ime"].'">'.$row["ime"].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
				<h3 class="mb-3 text-center text-dark">STATUS</h3>
            	<select name="pretraga_statusa" id="pretraga_statusa" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker">
                <option selected value="bez">BEZ FILTERA</option>
					<!--<option value="dostavljeno_na_stanju">dostavljeno+na stanju</option> -->
					<option value="na_stanju">na_stanju</option>
                    <option value="dostavljeno">dostavljeno</option>
                    <option value="vraceno">vraćeno</option>					
                </select>
            </div>
			<div class="col-md-2">
				<h3 class="mb-3 text-center text-dark">PLAĆENO</h3>
            	<select name="klijentu_placeno" id="klijentu_placeno" class="form-control btn btn-dark btn-block mt-3 mb-3 selectpicker">
                <option selected value="bez">BEZ FILTERA</option>
					<option value="da">da</option>
					<option value="ne">ne</option>				
                </select>
            </div>
        </div>
		<div class="row">
			<?php 
                $month = date('m',strtotime("-1 month"));
                $day = date('d',strtotime("-1 month"));
                $year = date('Y',strtotime("-1 month"));
                $month2 = date('m',strtotime("+1 days"));
                $day2 = date('d',strtotime("+1 days"));
                $year2 = date('Y',strtotime("+1 days"));
                $today = $year . '-' . $month . '-' . $day;
                $tommorow = $year2 . '-' . $month2 . '-' . $day2;
                
            ?>
			<div class="col-md-5">
				<h3 class="mt-4 text-dark" id="parametri" style="display:none">PARAMETRI</h3>
				<h4 class="mt-3" id="uspesno"></h4>
			</div>
            <div class="col-md-2 mt-4">
				<h3 class="mb-3 text-center text-dark">DATUM</h3>
                od:<input type="date" value="<?php echo $today; ?>" class="mb-3" id="unosdatum"><br/>
                do:<input type="date" value="<?php echo $tommorow; ?>" class="mb-3" id="unosdatum2">
            </div>
			<div class="col-md-5">
			</div>
		</div>
        <div class="table-responsive mt-3 mb-5">               
            <table class="table table-striped table-bordered" id="printTable">
            	<caption>Lista paketa</caption>
				
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
						<th scope="col">ID</th>
                        <th scope="col">Pošiljalac</th>
						<th scope="col">Primalac</th>
                        <th scope="col">Broj Telefona</th>
                        <th scope="col">Grad</th>
                        <th scope="col">Adresa</th>
                        <th scope="col">Kurir</th>
                        <th scope="col">Otkup</th>
                        <th scope="col">Cijena dostave</th>
                        <th scope="col">Otkup kurir</th>
                        <th scope="col">Plaćeno</th>
                        <th scope="col">Status paketa</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
				<tfoot id="suma_kurir">
			  	</tfoot>
            </table>
        </div>
		<div class="container">
			<div class="row">
				<button class="btn btn-info col-xs-6 col-md-2 mb-3" id="sacuvaj_listu" >Sačuvaj listu</button>
			</div>
			<div class="row">
				<select name="ucitaj_listu" id="ucitaj_listu" class="col-xs-6 col-md-2 form-control btn btn-dark mb-3 selectpicker">
                <option selected value="bez">Učitaj listu</option>
                    <?php 
                        foreach($result5 as $row)
                        {
                            echo '<option value="'.$row["ime"].'">'.$row["ime"].'</option>';
                        }
                    ?>
                </select>
				<div class="col-8"></div>
				<div class="btn btn-warning mb-3 col-2" id="kurir-kasa" style="display:none">KURIR STANJE</div>
			</div>
		</div>
        <div class="container">
            <div class="d-flex flex-row justify-content-center mt-3 mb-3">
                <div class="btn btn-dark ml-3 p-2" onclick="printData()">ŠTAMPAJ</div>
            </div>
        </div>
</div>
	<script>
		function printData()
			{
			   var divToPrint=document.getElementById("printTable");
			   newWin= window.open("");
			   newWin.document.write(divToPrint.outerHTML);
			   newWin.print();
			   newWin.close();
			};
		function change_status(id='',status_paketa=''){
            $.ajax({
                url: "change-status.php",
                method: "POST",
                data: {id:id, status_paketa:status_paketa},
                success: function(data){
                    $('#uspesno').html(data);
                }
            })
        };
		function promeniStatus(id,status_paketa){			
			var status_paketa = status_paketa.options[status_paketa.selectedIndex].value;
			console.log("PROMENI STATUS", id,status_paketa);
			change_status(id,status_paketa);
			$('#suma_kurir').empty();
		};
		
</script>
</body>
</html>
<script>
    $(document).ready(function(){
        
        function load_data2(klijent='',kurir='',grad='',otkup='',status='',placeno='',datum1='',datum2=''){
            $.ajax({
                url: "fetch-kurir.php",
                method: "POST",
                data: {klijent:klijent, kurir:kurir, grad:grad, otkup:otkup, status:status,placeno:placeno, datum1:datum1, datum2:datum2},
                success: function(data){
                    $('tbody').html(data);
                }
            })
        };
        function load_datum(datum1='',datum2=''){
            $.ajax({
                url: "fetch-datum.php",
                method: "POST",
                data: {datum1:datum1, datum2:datum2},
                success: function(data){
                    $('tbody').html(data);
                }
            })
        };
		function calculate_otkup(klijent='',kurir='',grad='',otkup='',status='',placeno='',datum1='',datum2=''){
            $.ajax({
                url: "calculate-otkup.php",
                method: "POST",
                data: {klijent:klijent, kurir:kurir, grad:grad, otkup:otkup, status:status,placeno:placeno, datum1:datum1, datum2:datum2},
                success: function(data){
                    $('#suma_kurir').html(data);
                }
            })
        };
		function calculate_kurir(ime=''){
            $.ajax({
                url: "calculate-kurir.php",
                method: "POST",
                data: {ime:ime},
                success: function(data){
                    $('#suma_kurir').html(data);
                }
            })
        };
		function save_list(paketi='',ime="",grad='',datum1='',datum2=''){
            $.ajax({
                url: "save-list.php",
                method: "POST",
                data: {paketi:paketi, ime:ime, grad:grad, datum1:datum1, datum2:datum2},
                success: function(data){
                    $('#uspesno').html(data);
                }
            })
        };
		function load_list(ime=''){
            $.ajax({
                url: "load-list.php",
                method: "POST",
                data: {ime:ime},
                success: function(data){
                    $('tbody').html(data);
                }
            })
        };
		function load_list_params(ime=''){
            $.ajax({
                url: "load-list-params.php",
                method: "POST",
                data: {ime:ime},
                success: function(data){
                    $('#uspesno').html(data);
                }
            })
        };
		function load_all(){
            $.ajax({
                url: "load-all.php",
                method: "POST",
                data: {},
                success: function(data){
                    $('tbody').html(data);
                }
            })
        };
		$('#unosdatum').on('change', function(){
			var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
			var otkup = $('#pretraga_otkupa').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
		})
		$('#unosdatum2').on('change', function(){
			var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
			var otkup = $('#pretraga_otkupa').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
		})
		$('#svi_paketi').on('click', function(){
			var filteri = `<span class="h4 text-dark text-center mt-5">SVI PAKETI</span>`;
			var filteri2 = `<span class="h4 text-dark text-center"></span>`;
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
    		$('#uspesno').html(filteri);
			$('#suma_kurir').html(filteri2);
			$('#parametri').hide();
            load_all();
        })
        $('#pretraga_klijenata').change(function(){
            var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
			var otkup = $('#pretraga_otkupa').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
        })
        $('#pretraga_statusa').change(function(){
            var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
			var otkup = $('#pretraga_otkupa').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
        })
        $('#pretraga_gradova').change(function(){
            var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
			var otkup = $('#pretraga_otkupa').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
        })
		$('#pretraga_kurira').change(function(){
            var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
			var otkup = $('#pretraga_otkupa').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
        })
		$('#klijentu_placeno').change(function(){
            var klijent = $('#pretraga_klijenata').val();
            var kurir = $('#pretraga_kurira').val();
            var grad = $('#pretraga_gradova').val();
			var otkup = $('#pretraga_otkupa').val();
            var status = $('#pretraga_statusa').val();
			var placeno = $('#klijentu_placeno').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
			$('#suma_kurir').empty();
			$('#kurir-kasa').hide();
			$('#parametri').show();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var filteri = `<span class="h6 text-dark text-center"> pošiljalac: ${klijent}<br/>kurir: ${kurir}<br/>grad: ${grad}<br/>status: ${status}<br/>datum od: ${datum1} do: ${datum2}</span>`;
    		$('#uspesno').html(filteri);
            load_data2(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
			calculate_otkup(klijent,kurir,grad,otkup,status,placeno,datum1,datum2);
        })
		$('#sacuvaj_listu').on('click', function(){					
            var grad = $('#pretraga_gradova').val();
            var date = new Date($('#unosdatum').val());
            var date2 = new Date($('#unosdatum2').val());
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            var day2 = date2.getDate();
            var month2 = date2.getMonth() + 1;
            var year2 = date2.getFullYear();
			$('#parametri').hide();
            var datum1 = [year, month, day].join('-');
            var datum2 = [year2, month2, day2].join('-');
			var paketi = $('#paket_id').attr('value');
			$('#suma_kurir').empty();
			
			var status = "<?php foreach($result4 as $row)
                        {
                            echo $row[0]+1;
                        } ?>";
			let text1= "PL";
			let ime = text1.concat(status);
			if (typeof paketi==='undefined' || paketi===''){
				alert("NEMA PAKETA U LISTI");
				$('#kurir-kasa').hide();
			}else{				
				save_list(paketi,ime,grad,datum1,datum2);				
				alert("LISTA PAKETA USPEŠNO SAČUVANA");
				$(this).attr("disabled", true);				
				load_list(ime);
				load_list_params(ime);
				$('#kurir-kasa').show();
				$('#ucitaj_listu').append(`<option selected value="${ime}">
                                       ${ime}
                                  </option>`);
			};
        });
		$('#ucitaj_listu').change(function(){
            var ime = $('#ucitaj_listu').val();
			console.log("NEMA IME", ime);
			$('#sacuvaj_listu').attr("disabled", true);
			$('#kurir-kasa').show();
			$('#parametri').hide();
            load_list(ime);
			load_list_params(ime);
			$('#suma_kurir').empty();
        });
		$('#kurir-kasa').on('click', function(){
			var ime = $('#ucitaj_listu').val();
			$('#parametri').hide();
			calculate_kurir(ime);
        });
    });
</script>