<div id="print">
<div class="jumbotron">
  <h1 class="display-5">Detail Transaksi.</h1>
  <hr class="my-4">
<div class="content-box-large">
	<div class="panel-body">
		<?php 
		$idpesanan=$_GET['idpesanan'];
		$query="SELECT * FROM pesanan a
				LEFT JOIN klien b ON a.idklien = b.idklien 
      			LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
      			LEFT JOIN proses d ON a.idpesanan=d.idpesanan
      			LEFT JOIN admin e ON e.idadmin=d.idadmin
      			LEFT JOIN makam f ON f.idmakam=a.idmakam
      			LEFT JOIN subblok g ON g.idsubblok=f.idsubblok
      			LEFT JOIN blok h ON h.idblok=g.idblok 
        		WHERE f.idmakam=a.idmakam AND a.idpesanan='$idpesanan'
				";
		$db->setQuery($query);
		$a=$db->loadObject();
 		?>
		  	<h1 style="left: 0;right: 0;width: 100%">Data Pemohon</h1>
			<div class="row">		
			  <div class="form-group col-sm-4">
			    <label>Nama Pemohon</label>
			    <input type="text" class="form-control" value="<?=$a->nama;?>" name="nama" readonly>
			  </div>
			  <div class="form-group col-sm-4" style="float: left;">
			    <label>Kontak Pemohon</label>
			    <input type="text" class="form-control" id="number" value="<?=$a->kontak;?>" name="kontak" readonly>
			  </div>
			  <div class="form-group col-sm-4">
			    <label>Email Pemohon</label>
			    <input type="text" class="form-control" value="<?=$a->email;?>" name="password" readonly>
			  </div>
			</div>

			<div class="row">
		  <h1 style="width: 100%;">Data Almarhum</h1>
		  <div class="form-group col-sm-12">
		    <label>Nama Almarhum</label>
		    <input type="text" class="form-control" value="<?=$a->namaalm;?>" readonly>
		  </div>
		  <div class="form-group col-sm-4">
		    <label>Umur Almarhum</label>
		    <input type="text" class="form-control" value="<?=$a->umuralm;?>" readonly>
		  </div>
		  <div class="form-group col-sm-4">
		    <label>Jenis Kelamin</label>
		    <input type="text" class="form-control" value="<?=$a->jkalm;?>" readonly>
		  </div>
		  <div class="form-group col-sm-4">
		    <label>Agama Almarhum</label>
		    <input type="text" class="form-control" value="<?=$a->agamaalm;?>" readonly>
		  </div>
			<?php 
			$n=array("Foto Bukti SKRD","Foto KTP Ahli Waris","Foto KTP Almarhum/ah","Foto KK","Foto Surat Keterangan Kematian");
			$index=0;
			$email=$_GET['email'];
			$db->setQuery("SELECT f_skrd,f_ktpahliwaris,f_ktpalm,f_kk,f_suratkematian FROM pesanan_detail WHERE idpesanan=$idpesanan");
			$col=$db->loadObject();
			// var_dump($query);
			foreach ($col as $c) {
			 ?>
			<div class="form-group col-md-4" style="min-height: 450px">
				<div class="card bg-info text-white" style="width: 60%;height: 25%" id="">
				  <img class="card-img-top img-thumbnail" src="assets/uploads/<?php echo $_GET['email'];echo "/";echo $c;?>" >
				  <div class="card-body">
				    <h5 class="card-title"><center><?=$n[$index];?></center></h5>
				  </div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item bg-info">Namefile : <?=$c;?></li>
				  </ul>

				</div>
			</div>

			<?php
				;$index++;}
			 ?>

		  <div class="row">
		  <div class="form-group col-sm-12">
		  	<h1 style="width: 100%;">Tanggal Proses</h1>
		    <label>Tanggal Pesanan</label>
		    <input type="text" class="form-control" value="<?=date('d-m-Y',substr($a->tanggalpesanan, 0));?>" readonly>
		  </div>
		  <div class="form-group col-sm-4">
		    <label>Tanggal Pemakaman</label>
		    <input type="text" class="form-control form-control-danger" value="<?=date('d-m-Y',substr($a->tanggalpemakaman, 0));?>" readonly>
		  </div>
		  <div class="form-group col-sm-4">
		    <label>Tanggal Upload SKRD</label>
		    <input type="text" class="form-control form-control-danger" value="<?=date('d-m-Y',substr($a->tanggaluploadskrd, 0));?>" readonly>
		  </div>
		  <div class="form-group col-sm-4">
		    <label>Tanggal Verifikasi</label>
		    <input type="text" class="form-control form-control-danger" value="<?=date('d-m-Y',substr($a->tanggalverifikasi, 0));?>" readonly>
		  </div>
		  <div class="form-group col-sm-12" style="left: 0;right: 0;">
		    <label>Tanggal Konfirmasi</label>
		    <input type="text" class="form-control" value="<?=date('d-m-Y',substr($a->tanggalkonfirmasi, 0));?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Nama Staff</label>
		    <input type="text" class="form-control" value="<?=$a->namaadmin;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Kontak Staff</label>
		    <input type="text" class="form-control" value="<?=$a->namaadmin;?>" readonly>
		  </div>
		</div>

		  <div class="row">
		  <div class="form-group col-sm-12">
		  	<h1>Letak Makam</h1>
		    <label>Blok</label>
		    <input type="text" class="form-control" value="<?=$a->namablok;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Sub-Blok</label>
		    <input type="text" class="form-control" value="<?=$a->subblok;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Keterangan Blok</label>
		    <input type="text" class="form-control" value="<?=$a->keterangan;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Panjang Kolom Sub-Blok</label>
		    <input type="text" class="form-control" value="<?=$a->panjangkolom;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Lebar Baris Sub-Blok</label>
		    <input type="text" class="form-control" value="<?=$a->lebarbaris;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Baris Ke</label>
		    <input type="text" class="form-control" value="<?=$a->baris;?>" readonly>
		  </div>
		  <div class="form-group col-sm-6">
		    <label>Nomor Makam</label>
		    <input type="text" class="form-control" value="<?=$a->nomormakam;?>" readonly>
		  </div>
		</div>
</div>
		<a href="modules/printPdf.php?idpesanan=<?=$idpesanan;?>">Print Invoice</a>
	</div>
</div>

</div>
