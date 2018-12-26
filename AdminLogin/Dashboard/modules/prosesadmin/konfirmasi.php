<div class="content-box-large">
	<div class="panel-heading">
</div>
	<div class="panel-body">
<?php 
$n=array("Foto Bukti SKRD","Foto KTP Ahli Waris","Foto KTP Almarhum/ah","Foto KK","Foto Surat Keterangan Kematian");
$index=0;
$email=$_GET['email'];
$idpesanan=$_GET['id'];
$queryFoto="SELECT f_skrd,f_ktpahliwaris,f_ktpalm,f_kk,f_suratkematian FROM pesanan_detail WHERE idpesanan=$idpesanan";
$dbAdmin->setQuery($queryFoto);
$col=$dbAdmin->loadObject();
foreach ($col as $c) {
 ?>

	<div class="card bg-info text-white" style="width: 35rem;" id="">
	  <img class="card-img-top img-thumbnail" src="../../assets/uploads/<?php echo $_GET['email'];echo "/";echo $c;?>" >
	  <div class="card-body">
	    <h5 class="card-title"><center><?=$n[$index];?></center></h5>
	  </div>
	  <ul class="list-group list-group-flush">
	    <li class="list-group-item">Namefile : <?=$c;?></li>
	  </ul>

	</div>
	<br><br><br>

<?php
	$index++;}
	$dbAdmin->setQuery("SELECT * FROM pesanan a, pesanan_detail b, proses c WHERE a.idpesanan=b.idpesanan AND a.idpesanan=c.idpesanan AND a.idpesanan=$idpesanan");
	$data=$dbAdmin->loadObject();
 ?>
	
	<div class="card" style="width: 45rem;position: fixed;top: 25%;left: 60%;background-color: #BFEAF5" id="item">
	  <div class="card-body">
	    <h3 class="card-title"><center>Konfirmasi Bukti Pembayaran</center></h5>
	  </div>
	  <ul class="list-group list-group-flush">
	  	<form method="POST">
	  		<input type="hidden" name="iddetail" value="<?=$_GET['id'];?>">
	  		<input type="hidden" name="carapemakaman" value="<?=$data->carapemakaman;?>">
	    <li class="list-group-item">Tanggal Pemakaman : <input type="text" value="<?=date('d-m-Y',substr($data->tanggalpemakaman, 0));?>" class="form-control" readonly></li>
	    <li class="list-group-item">Jam Pemakaman : <input type="text" class="form-control" value="<?=$data->jampemakaman;?>" readonly></li>
	    <li class="list-group-item">Lokasi Penjemputan : 
		<textarea rows="4" cols="50" class="form-control" readonly=""><?=$data->lokasipenjemputan?$data->lokasipenjemputan:"Tidak Menggunakan Mobil Jenazah";?></textarea> 
	    </li>
	  </ul>
		<center>
			<button name="submit" class="btn btn-primary">Konfirmasi</button> 
			<button name="tolak" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk tolak pesanan ini?');">Tolak</button>
		</center><br>
	</div>
	<br><br><br>
</form>
	</div>
</div>


<?php 

if (isset($_POST['submit'])) {
	$ket = $_POST['carapemakaman'];
	$sub="SELECT * FROM blok a, subblok b WHERE a.idblok=b.idblok AND a.keterangan='$ket' AND b.status_subblok='1'";
	$dbAdmin->setQuery($sub);
	$getSub=$dbAdmin->loadObject();
	$query="SELECT MAX(nomormakam) as nomormakam FROM subblok a, makam b WHERE a.idsubblok=b.idsubblok AND a.idsubblok=$getSub->idsubblok";
	$dbAdmin->setQuery($query);
	$getinfo=$dbAdmin->loadObject();
	$total=$getSub->panjangkolom * $getSub->lebarbaris;

	$nomormakam=$getinfo->nomormakam + 1;
	if ($nomormakam <= $total) {
		$object=new stdClass();
		$object->nomormakam=$nomormakam;
		$object->idsubblok=$getSub->idsubblok;
		$object->baris=ceil($nomormakam / $getSub->lebarbaris);
		$object->kolom=$nomormakam % $getSub->panjangkolom;
		$a=$dbAdmin->Insert("makam",$object);

		$inserted="SELECT MAX(idmakam) as idmakam FROM makam";
		$dbAdmin->setQuery($inserted);
		$lastInserted=$dbAdmin->loadObject();
		$objUpdate=new stdClass();
		$objUpdate->idmakam=$lastInserted->idmakam;
		$objUpdate->status="3";
		$objUpdate->tanggalkonfirmasi=time();
		$b=$dbAdmin->Update("pesanan",$objUpdate,"idpesanan=$idpesanan");
		echo "<script> alert('Konfirmasi berhasil!');location.replace('index.php?modules=details&id=$idpesanan&email=$email'); </script>";
	} else {
		echo "<script type='text/javascript'>alert('Maaf blok yang sedang digunakan sudah penuh!');</script>";
	}
} elseif (isset($_POST['tolak'])) {
	$cond="iddetail=".$_POST['iddetail']."";
	$obj= new stdClass();
	$obj->status="4";
	$obj->iduser=$_SESSION['iduser'];
	$dbAdmin->Update($table,$obj,$cond);
}

 ?>