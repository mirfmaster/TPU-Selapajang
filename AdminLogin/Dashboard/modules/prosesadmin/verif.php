<div class="content-box-large">
	<div class="panel-heading">
	<!-- <div class="panel-title"><?php echo $headercontent[0];?></div> -->
</div>
	<div class="panel-body">

<?php 
$n=array("Foto KTP Ahli Waris","Foto KTP Almarhum/ah","Foto KK","Foto Surat Keterangan Kematian","Catatan");
$index=0;
$email=$_GET['email'];
$query="SELECT f_ktpahliwaris,f_ktpalm,f_kk,f_suratkematian,catatan FROM pesanan a, pesanan_detail b
		WHERE a.idpesanan=b.idpesanan AND b.idpesanan=$_GET[id]";
// dnd($query);die;
$dbAdmin->setQuery($query);
$col=$dbAdmin->loadObject();
 ?>
<?php foreach ($col as $c): ?>
<div class="card bg-info text-white" style="width: 40rem;" id="">
  <img class="card-img-top img-thumbnail" src="../../assets/uploads/<?php echo $_GET['email'];echo "/";echo $c;?>" alt="">
  <div class="card-body">
    <h5 class="card-title"><center><?=$n[$index];?></center></h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item" style="text-align: center;">
	<?php 
	$content=$c;
	if ($c==NULL) {
		$content="Null";
	}
	echo $content;
	 ?>
    </li>
  </ul>

</div>
	<br><br><br>
<?php $index++; endforeach ?>

	
	<div class="card" style="width: 45rem;position: fixed;top: 23%;left: 55%;background-color: #BFEAF5" id="item">
	  <div class="card-body">
	    <h3 class="card-title">Mohon isi data sesuai dengan berkas.</h5>
	  </div>
	  <ul class="list-group list-group-flush">
	  	<form method="POST">
	  		<input type="hidden" name="idpesanan" value="<?=$_GET['id'];?>">
	    <li class="list-group-item">Nik Almarhum : <input type="text" name="nik" class="form-control" pattern="[0-9]{16}" title="16 Angka Nik" required placeholder="16 Angka NIK KTP Almarhum"></li>
	    <li class="list-group-item">Nama Almarhum : <input type="text" name="nama" class="form-control" placeholder="Jolly Mangutang" required=""></li>
	    <li class="list-group-item">Umur Almarhum : <input type="text" name="umur" class="form-control" placeholder="21 Tahun" required=""></li>
	    <li class="list-group-item">Jenis Kelamin : 

	    	<input type="radio" name="jk" class="form-control-feedback" value="Pria" checked=""> Pria 
	    	<input type="radio" name="jk" class="form-control-feedback" value="Wanita"> Wanita
	    </li>
	    <li class="list-group-item">Agama : <input type="text" name="agama" class="form-control" placeholder="Islam" required=""></li>
	    <li class="list-group-item">Cara Pemakaman : 
		<select name="carapemakaman" class="form-control">
			<option value="Muslim">Muslim</option>
			<option value="Non-Muslim">Non-Muslim</option>
		</select>
	    </li>
	  </ul>
		<center>
			<button name="submit" class="btn btn-primary" onclick="return confirm('Apakah anda sudah yakin?');">Submit</button> 
			<input type="reset" class="btn btn-primary" value="Reset">
			<button class="btn btn-danger" data-toggle="modal" data-target="#Tolak">Tolak</button>
		</center><br>
	</div>
	<br><br><br>
</form>
	</div>
</div>

<!-- ================================================================================= -->

<div class="modal fade" id="Tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Berikan alasan yang jelas mengapa di tolak</h5>
      </div>
      <form method="POST" name="admin">
      	<input type="hidden" name="idpesanan" value="<?=$_GET['id'];?>">
      <div class="modal-body">
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alasan</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="alasan" required=""></textarea>
              </div>
          </div>

    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="tolak">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php 
if (isset($_POST['submit'])) {
	$object= new stdClass();
	$object->idpesanan=$_POST['idpesanan'];
	$object->nikalm=$_POST['nik'];
	$object->namaalm=$_POST['nama'];
	$object->umuralm=$_POST['umur'];
	$object->jkalm=$_POST['jk'];
	$object->carapemakaman=$_POST['carapemakaman'];
	$object->agamaalm=$_POST['agama'];
	$object->tanggalverifikasi=time();
	$object->idadmin=$_SESSION['idadmin'];
	$dbAdmin->Insert("proses",$object);

	$objUpdate= new stdClass();
	$objUpdate->status="1";
	$condition="idpesanan=$_POST[idpesanan]";
	$dbAdmin->Update("pesanan",$objUpdate,$condition);
	echo "<script> alert('Verifikasi berhasil!');location.replace('index.php?modules=pemesanan'); </script>";
} elseif (isset($_POST['tolak'])) {
	$object= new stdClass();
	$object->idpesanan=$_POST['idpesanan'];
	$object->idadmin=$_SESSION['idadmin'];
	$object->alasan=$_POST['alasan'];
	$object->tanggalverifikasi=time();
	$dbAdmin->Insert("proses",$object);

	$objUpdate= new stdClass();
	$objUpdate->status="4";
	$condition="idpesanan=$_POST[idpesanan]";
	$dbAdmin->Update("pesanan",$objUpdate,$condition);
	echo "<script> alert('Pemesanan ditolak!');location.replace('index.php?modules=pemesanan'); </script>";
}

 ?>