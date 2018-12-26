<?php 
$a=$db->getKlienByEmail($_SESSION['email']); 

$object= new stdClass();
$key=new stdClass();
if (isset($_POST['btnProfile'])) {
  $table="klien";
  $condition="idklien=".$a->idklien;
  $object->email=$_SESSION['email'];
  $object->nama=$_POST['nama'];
  $object->alamat=$_POST['alamat'];
  $object->kontak=$_POST['kontak'];
  $object->password=$_POST['password'];
  $query=$db->Update($table,$object,$condition);
  if ($result=true) {
        header("Refresh:0");
  }
}
?>
<div class="jumbotron">
  <h1 class="display-5">Your Profile</h1>
  <hr class="my-4">
<form enctype="multipart/form-data" id="myForm" method="POST">
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" value="<?=$a->email;?>" readonly="readonly" name="email">
  </div>
  <div class="form-group">
    <label>Nama</label>
    <input type="text" class="form-control" value="<?=$a->nama;?>" name="nama">
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <textarea class="form-control" rows="5" name="alamat"><?=$a->alamat;?></textarea>
  </div>
  <div class="form-group">
    <label>Kontak</label>
    <input type="text" class="form-control" id="number" value="<?=$a->kontak;?>" name="kontak">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" value="<?=$a->password;?>" name="password">
  </div>
<br>
  <center><button type="submit" name="btnProfile" class="btn btn-info" onclick="return  confirm('Apakah anda yakin? (Y/N)')">Save Changes</button>
  <button type="reset" class="btn btn-info" autofocus>Reset</button></center>
</form>
</div>
