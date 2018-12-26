<?php 
  if(isset($_POST['btnRegister'])){
    $q=$db->getKlienByEmail($_POST['email']);
    if ($q->email) {
      $db->messages="Sorry email already exist.";
    } else {
      $table="klien";
      $object= new stdClass();
      $object->email = $_POST['email'];
      $object->nama = $_POST['nama'];
      $object->alamat  = $_POST['alamat'];
      $object->kontak = $_POST['kontak'];
      $object->password= $_POST['password'];
      $query=$db->Insert($table,$object);
        if($query){
          echo '<script type="text/javascript">window.alert("Registrasi Berhasil!");window.location.href="index.php"</script>';
        }
    }
  }
?>
<div class="jumbotron">
  <h1 class="display-5">Registrasi</h1>
  <p class="lead font-weight-bold" style="color: #E10000;">Isi data secara lengkap dan benar dengan email yang belum pernah di daftarkan!</p>
  <hr class="my-4">
<form enctype="" method="POST">
  <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email" placeholder="Rere@gmail.com" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b">
  </div>
  <div class="form-group">
    <label>Nama</label>
    <input type="text" class="form-control" name="nama" placeholder="Rere Agustina" required="required">
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <textarea class="form-control" rows="5" name="alamat" placeholder="Jl. Perkutut Raya Rt. 03/02 Kel. Babakan Kec. Tangerang" required="required"></textarea>
  </div>
  <div class="form-group">
    <label>Kontak</label>
    <input type="text" class="form-control" id="number" name="kontak" placeholder="0812841XXX" required="required">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password" placeholder="" required="required">
  </div>
<br>
  <center><button type="submit" name="btnRegister" class="btn btn-info" onclick="return  confirm('Apakah anda yakin? (Y/N)')">Save Changes</button>
  <button type="reset" class="btn btn-info" autofocus>Reset</button></center>
</form>
<?php if (isset($db->messages[0])) {echo "<br><span style='color: #E10000;text-align: center;'>".$db->messages."</span>";}  ?>
</div>
