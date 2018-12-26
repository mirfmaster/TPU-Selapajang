<?php 
$klien=$db->getKlienByEmail($_SESSION['email']);
if (isset($_POST['btnOrder'])) {
  $time=time();

  $email=$klien->email;
  $hubungan=$db->quote($_POST['hubungan']);
  $catatan=$db->quote($_POST['catatan']);
  $tablePesanan=$db->nameQuote("pesanan_detail");
  $persyaratan=array("f_ktpalm"=>$_FILES['ktpalm'],
                    "f_ktpahliwaris"=>$_FILES['ktpaw'],
                    "f_kk"=>$_FILES['kk'],
                    "f_suratkematian"=>$_FILES['skk']);  
  
  $idklien=$_SESSION['idklien'];
  foreach ($persyaratan as $k => $v) {
    $qUpload=$db->Upload($k,$email,$v);
    $imageFileType = strtolower(pathinfo($v["name"],PATHINFO_EXTENSION));
    $target_file = $k."_". $time .".".$imageFileType;
    $key[] = $db->nameQuote($k);
    $hasil[] = $db->quote($target_file);
  }

  $query="INSERT INTO `pesanan` (idpesanan , idklien , tanggalpesanan) VALUES ( NULL , $idklien , $time )";
  $db->setQuery($query);

  $getinfo="SELECT MAX(idpesanan) as id from pesanan";
  $db->setQuery($getinfo);
  $idpesanan=$db->loadObject();
  $query2 = "INSERT INTO `pesanan_detail` (`iddetail` , `idpesanan` , `hubungan`,`catatan`, $key[0],$key[1],$key[2],$key[3]) VALUES ( NULL  , $idpesanan->id,$hubungan,$catatan, $hasil[0],$hasil[1],$hasil[2],$hasil[3] )";
  $db->setQuery($query2);
    echo "<script> alert('Order berhasil! Silahkan cek tab My Order!');location.replace('index.php?i=myorder'); </script>";
}
?>

<div class="jumbotron">
  <h1 class="display-5">Silahkan upload berkas almarhum.</h1>
  <!-- <p class="lead font-weight-bold" style="color: #E10000">Tolong isi data dengan lengkap!</p> -->
  <hr class="my-4">
  <form enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label>Nama Pemohon</label>
    <input type="text" class="form-control"  name="nama" value="<?=$klien->nama;?>" readonly="true">
  </div>
  <div class="form-group">
    <label>Alamat Pemohon</label>
    <input type="text" class="form-control"  name="alamat" value="<?=$klien->alamat;?>" readonly="true" >
  </div>
  <div class="form-group">
    <label>Kontak</label>
    <input type="text" class="form-control" name="kontak" value="<?=$klien->kontak;?>" readonly="true">
  </div>
  <div class="form-group">
    <label>Hubungan dengan almarhum</label>
    <input type="text" class="form-control" name="hubungan" placeholder="Orang Tua Kandung">
  </div>
  <div class="form-group">
    <label>Catatan</label>
    <textarea name="catatan" class="form-control" rows="3" placeholder=""></textarea>
  </div>
  <div class="form-group col-3" style="float: left;">
    <label>Foto KTP Almarhum</label>
    <input type="file" class="form-control" name="ktpalm" accept="x-png,gif,jpeg" value="" required="required">
  </div>
  <div class="form-group col-3" style="float: left;">
    <label>Foto KTP Ahli Waris</label>
    <input type="file" class="form-control" name="ktpaw" accept="x-png,gif,jpeg" required="required">
  </div>
  <div class="form-group col-3" style="float: left;">
    <label>Foto KK</label>
    <input type="file" class="form-control" name="kk" accept="x-png,gif,jpeg" required="required">
  </div>
  <div class="form-group col-3" style="float: left;">
    <label>Foto Surat Keterangan Kematian </label><br>
  <input type="file" class="form-control" name="skk" accept="x-png,gif,jpeg" required="required">

  </div>
<br>
<input type="hidden" value="">
  <center>
    <input type="submit" class="btn btn-info" name="btnOrder">
    <button type="reset" class="btn btn-info" autofocus>Reset</button>
  </center>
</form>
</div>
