<?php 
/* $a=$db->getKlienByEmail($_SESSION['email']);
// $object= new stdClass();
// if (isset($_POST['btnOrder'])) {
//   $table="pesanan";
//   $object->iduser=$_SESSION['iduser'];
//   $object->nikalm=$_POST['nik'];
//   $object->namaalm=$_POST['namaalm'];
//   $object->umur=$_POST['umur'];
//   $object->jk=$_POST['jk'];
//   $query=$db->Insert($table,$object);
  
// // var_dump($query);

// }
<div class="jumbotron">
  <h1 class="display-5">Formulir pemesanan makam.</h1>
  <p class="lead font-weight-bold" style="color: #E10000">Tolong isi data dengan lengkap!</p>
  <hr class="my-4">
<form enctype="multipart/form-data" method="POST" action="">
  <div class="form-group">
    <label>Nama Pemohon</label>
    <input type="text" class="form-control"  name="nama" value="<?=$a->nama;?>" readonly="true">
  </div>
  <div class="form-group">
    <label>Alamat Pemohon</label>
    <input type="text" class="form-control"  name="alamat" value="<?=$a->alamat;?>" readonly="true" >
  </div>
  <div class="form-group">
    <label>Kontak</label>
    <input type="text" class="form-control" name="kontak" value="<?=$a->kontak;?>" readonly="true">
  </div>
  <div class="form-group">
    <label>NIK Almarhum</label>
    <input type="text" class="form-control" name="nik"  id="number" placeholder="123123" >
  </div>
  <div class="form-group">
    <label>Nama Almarhum</label>
    <input type="text" class="form-control" name="namaalm" placeholder="John Doe" >
  </div>
  <div class="form-group">
    <label>Umur</label>
    <input type="text" class="form-control" name="umur"  placeholder="24 Tahun" >
  </div>
  <div class="form-group">
    <label>Jenis Kelamin</label><br>
    <input type="radio"  name="jk" value="Pria" checked="">Pria <br>
    <input type="radio"  name="jk" value="Wanita">Wanita

  </div>
<!--   <div class="form-group">
    <label for="formGroupExampleInput2">Bukti Setoran Retribusi IPTM</label>&nbsp;
  <input type="file" name="bukti">
  </div> -->
<br>
  <center><button type="submit" class="btn btn-info" name="btnOrder">Submit</button>
          <button type="reset" class="btn btn-info" autofocus>Reset</button></center>
</form>
</div>
*/

// $date=date();
echo time();
// echo $date;
?>

