<?php 
$a=$dbAdmin->getAdminByEmail($_GET['emailadmin']); 

$object= new stdClass();
if (isset($_POST['btnProfile'])) {
  $condition="idadmin=".$a->idadmin;
  $object->namaadmin=$_POST['nama'];
  $object->alamatadmin=$_POST['alamat'];
  $object->kontakadmin=$_POST['kontak'];
  $object->password=$_POST['password'];
  $query=$dbAdmin->Update("admin",$object,$condition);
  if ($result=true) {
        header("Location: ?modules=struktur");
  }
}
?>
<div class="jumbotron">
  <h1 class="display-5">Profile Admin</h1>
  <hr class="my-4">
<form enctype="multipart/form-data" id="myForm" method="POST">
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" value="<?=$a->emailadmin;?>" readonly="readonly" name="email">
  </div>
  <div class="form-group">
    <label>Nama</label>
    <input type="text" class="form-control" value="<?=$a->namaadmin;?>" name="nama">
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <textarea class="form-control" rows="5" name="alamat"><?=$a->alamatadmin;?></textarea>
  </div>
  <div class="form-group">
    <label>Kontak</label>
    <input type="text" class="form-control" id="number" value="<?=$a->kontakadmin;?>" name="kontak">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" value="<?=$a->password;?>" name="password">
  </div>
  <div class="form-group">
    <label>Level</label>
    <select name="auth" class="form-control">
      <option value="1">Admin</option>
      <option value="2">Staff</option>
    </select>
  </div>
<br>
  <center><button type="submit" name="btnProfile" class="btn btn-info" onclick="return  confirm('Apakah anda yakin? (Y/N)')">Save Changes</button>
  <button type="reset" class="btn btn-info" autofocus>Reset</button></center>
</form>
</div>
