<?php 
$dbAdmin->setQuery("SELECT * FROM blok	WHERE keterangan REGEXP BINARY '[[:<:]]Muslim[[:>:]]'");
$blokMuslim=$dbAdmin->loadObject();
$dbAdmin->setQuery("SELECT * FROM subblok a LEFT JOIN blok b ON a.idblok=b.idblok WHERE b.idblok='$blokMuslim->idblok'");
$muslim=$dbAdmin->loadObjectList();

$dbAdmin->setQuery("SELECT * FROM blok	WHERE keterangan REGEXP BINARY '[[:<:]]muslim[[:>:]]'");
$blokNon=$dbAdmin->loadObject();
$dbAdmin->setQuery("SELECT * FROM subblok a LEFT JOIN blok b ON a.idblok=b.idblok WHERE b.idblok='$blokNon->idblok'");
$Non=$dbAdmin->loadObjectList();

 ?>
<div class="content-box-large">
	<div class="panel-heading">
	<div class="panel-title"></div>
</div>
	<div class="panel-body">
		<div class="card" style="width: 45rem;margin-left: 30%;background-color: #BFEAF5;" id="item">
	  <div class="card-body">
	    <h3 class="card-title">PILIH BLOK YANG INGIN DI GUNAKAN</h5>
	  </div>
	  <ul class="list-group list-group-flush"  style="">
	  	<form method="POST">
	    <li class="list-group-item">Sub-Blok Muslim : 
	    <select type="text" name="sub-blok" class="form-control" id="txtToggle" required>
	    	<?php foreach ($muslim as $s) {
	    		echo "<option value='$s->idsubblok'>".$s->subblok." - Muslim</option>";
	    	} ?>
	    </select></li>
	  </ul>
		<center>
			<button name="submitMuslim" class="btn btn-primary">Submit</button> 
			<input type="reset" class="btn btn-primary" value="Reset">
		</center><br>
	</div>
		<br><br><br>
	</form>
<!-- -------------------------------------------------------- -->
		<div class="card" style="width: 45rem;margin-left: 30%;background-color: #BFEAF5;" id="item">
	  <div class="card-body">
	    <h3 class="card-title">PILIH BLOK YANG INGIN DI GUNAKAN</h5>
	  </div>
	  <ul class="list-group list-group-flush"  style="">
	  	<form method="POST">
	    <li class="list-group-item">Sub-Blok Untuk Non-Muslim : 
	    <select type="text" name="sub-blok" class="form-control" id="txtToggle" required>
	    	<?php foreach ($Non as $s) {
	    		echo "<option value='$s->idsubblok'>".$s->subblok." - Non Muslim</option>";
	    	} ?>
	    </select></li>
	  </ul>
		<center>
			<button name="submitNon" class="btn btn-primary">Submit</button> 
			<input type="reset" class="btn btn-primary" value="Reset">
		</center><br>
	</div>
</form>


<?php 
if (isset($_POST['submitMuslim'])) {
	$dbAdmin->setQuery("SELECT * FROM subblok a LEFT JOIN blok b ON a.idblok=b.idblok WHERE b.idblok='$blokMuslim->idblok' AND status_subblok=1");
	$l=$dbAdmin->loadObject();
	$table="subblok";

	if ($l->idsubblok==$_POST['sub-blok']) {
		echo "<h5>Sub-Blok sudah terpakai.</h5>";
	}
	else{
		$object= new stdClass();
		$object->status_subblok=0;
		$cond="idsubblok=".$l->idsubblok;
		$dbAdmin->Update($table,$object,$cond);
		// -----------------------------------------
		$change= new stdClass();
		$change->status_subblok=1;
		$condition1="idsubblok=".$_POST['sub-blok'];
		$dbAdmin->Update($table,$change,$condition1);
	}

} elseif (isset($_POST['submitNon'])) {
	$dbAdmin->setQuery("SELECT * FROM subblok a LEFT JOIN blok b ON a.idblok=b.idblok WHERE b.idblok='$blokNon->idblok' AND status_subblok=1");
	$l=$dbAdmin->loadObject();
	$table="subblok";

	if ($l->idsubblok==$_POST['sub-blok']) {
		echo "<h5>Sub-Blok sudah terpakai.</h5>";
	}
	else{
		$object= new stdClass();
		$object->status_subblok=0;
		$cond="idsubblok=".$l->idsubblok;
		$dbAdmin->Update($table,$object,$cond);
		// -----------------------------------------
		$change= new stdClass();
		$change->status_subblok=1;
		$condition1="idsubblok=".$_POST['sub-blok'];
		$dbAdmin->Update($table,$change,$condition1);
	}
}

 ?>

		</div>
	</div>



<script>

	$(function() {
	    $('#toggler').change(function() {
	    	$.ajax({
			url:"/webskripsi/arcade/AdminLogin/Dashboard/modules/prosesadmin/ajax.php",
			data: {blok: $(this).val()},
			method:"POST",
			success: function(data){
				$.each(result, function(i, item) {
	               console.log(result);
	               $('<option value="' + item.value + '">' + item.name + '</option>').
	                   appendTo(select);
	           });
			}
		})
	       // var select = $('#txtToggle').empty();
	       // $.get('index.php?modules=ajax', {blok: $(this).val()}, function(result) {
	       // 	console.log(result);
	       //     $.each(result, function(i, item) {
	       //         $('<option value="' + item.value + '">' + item.name + '</option>').
	       //             appendTo(select);
	       //     });
	       // });
	    });
	});
			// url:"/webskripsi/arcade/AdminLogin/Dashboard/modules/prosesadmin/ajax.php",
</script>


	</div>
</div>
