<?php 
$idpesanan=$_GET['idpesanan'];
$iddetail=$_GET['iddetail'];
$query="
      SELECT a.idpesanan,a.tanggalpesanan,b.nama,c.iddetail,d.namaalm,d.tanggalverifikasi,a.status FROM pesanan a 
      LEFT JOIN klien b ON a.idklien = b.idklien 
      LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
      LEFT JOIN proses d ON a.idpesanan=d.idpesanan
      WHERE a.idpesanan=$idpesanan
      ";
$db->setQuery($query);
$l=$db->loadObject();

if (isset($_POST['submit'])) {
  $object=new stdClass();
  $object->tanggalpemakaman=strtotime($_POST['tanggal']);
  $object->jampemakaman=$_POST['jam'];
  $object->lokasipenjemputan=$_POST['lokasi'];
  $object->tanggaluploadskrd=time();
  $persyaratan=array("f_skrd"=>$_FILES['skrd']); 
  foreach ($persyaratan as $k => $v) {
    $qUpload=$db->Upload($k,$_SESSION['email'],$v);
    if ($qUpload==true) {
      $imageFileType = strtolower(pathinfo($v["name"],PATHINFO_EXTENSION));
      $target_file = $k."_". time().".".$imageFileType;
      $object->$k=$target_file;
      $condition="iddetail=$iddetail";
      $db->Update("pesanan_detail",$object,$condition); 

      $objUpdate=new stdClass();
      $objUpdate->status="2";
      $cond="idpesanan=$idpesanan";
      $db->Update("pesanan",$objUpdate,$cond);
      echo "<script> alert('Upload bukti berhasil!');location.replace('?i=myorder'); </script>";
    }
  }
    
}
 ?>
<div class="jumbotron">
  <h2 class="display-5">Silahkan upload bukti pembayaran & atur waktu pemakaman.</h2>
  <hr class="my-4">
  <form enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label>Nama Pemohon</label>
    <input type="text" class="form-control" value="<?=$l->nama;?>" readonly="true">
  </div>
  <div class="form-group">
    <label>Tanggal Pemesanan</label>
    <input type="text" class="form-control" value="<?=date('d-m-Y',substr($l->tanggalpesanan, 0));;?>" readonly="true" >
  </div>
  <div class="form-group">
    <label>Tanggal Verifikasi</label>
    <input type="text" class="form-control" value="<?=date('d-m-Y',substr($l->tanggalverifikasi, 0));;?>" readonly="true" >
  </div>
  <div class="form-group">
    <label>Status</label>
    <input type="text" class="form-control" name="status" value="<?php 
              if ($l->status=="0") {
                echo "Menunggu verifikasi berkas";
              } elseif ($l->status=="1") {
                echo "Menunggu pembayaran retribusi";
              } elseif ($l->status=="2") {
                echo "Menunggu konfirmasi pembayaran";
              } elseif ($l->status=="3") {
                echo "Proses selesai";
              } elseif ($l->status=="4") {
                echo "Proses gagal";
              }
            ?>" readonly="true">
  </div>
  <div class="form-group">
    <label>Foto Bukti Pembayaran Retribusi</label>
    <input type="file" class="form-control" name="skrd" accept="x-png,gif,jpeg" value="" required="required">
    <label>Transfer ke rekening 114124124 dengan jumlah Rp. 100.000</label>
  </div>
  <div class="form-group">
    <label>Tanggal Pemakaman</label>
    <input type="date" class="form-control" name="tanggal" required="required">
  </div>
  <div class="form-group">
    <label>Jam</label>
    <input type="time" class="form-control" name="jam" required="required">
    <label>9:10-AM(malam s/d siang) / 3:30-PM(siang s/d malam) </label>
  </div>
  <div class="form-group">
    <label>Menggunakan jasa mobil jenazah gratis.</label><br>
    <input type="checkbox" style="margin-top: 5px;margin-left: 5px;" onclick="OnChange (this)"> Gunakan
  </div>
    <div class="form-group" style="display: none;" id="txtToggle">
    <label>Lokasi Penjemputan</label>
    <textarea rows="4" cols="50" name="lokasi" class="form-control" ></textarea> 
  </div>
<br>
<label>Note : <br>1. Cakupan wilayah mobil jenazah gratis hanya dalam wilayah Kota Tangerang. <br>2. Jika penggunaan jasa diluar dari Kota Tangerang silahkan hubungi admin.</label>
  <center>
    <input type="submit" class="btn btn-info" name="submit" onclick="return  confirm('Apakah anda sudah yakin dengan berkas uploadnya? (Y/N)')">
    <button type="reset" class="btn btn-info" autofocus>Reset</button>
  </center>
</form>
</div>
<script type="text/javascript">
    function OnChange (checkbox) {
        if (checkbox.checked) {
            document.getElementById('txtToggle').style.display="block"; 
        }
        else {
            document.getElementById('txtToggle').style.display="none"; 
        }
    }
</script>