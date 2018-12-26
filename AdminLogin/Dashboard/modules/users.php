<?php 
$no=1;
$query="SELECT * FROM admin";
$dbAdmin->setQuery($query);
$admin=$dbAdmin->loadObjectList();
if (isset($_GET['id'])) {
  $table="subblok";
  $condition="idsubblok=$_GET[id]";
  $dbAdmin->Delete($table,$condition);
} elseif (isset($_POST['btnSub'])) {
  $object=new stdClass();
  $object->namaadmin=$_POST['namaadmin'];
  $object->alamatadmin=$_POST['alamatadmin'];
  $object->kontakadmin=$_POST['kontakadmin'];
  $object->emailadmin=$_POST['emailadmin'];
  $object->password=$_POST['password'];
  $object->auth=$_POST['auth'];
  $command=$dbAdmin->Insert("admin",$object);
  if ($command) {
    echo "<script> alert('Penambahan berhasil!');location.replace('index.php?modules=struktur'); </script>";
  }
}
?>
<div class="content-box-large">
	<div class="panel-heading">
	<div class="panel-title"><?php echo $headercontent[1]; ?></div>
</div>
	<div class="panel-body">
		<table class="table">

      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Kontak Person</th>
          <th>Email</th>
          <th>Level</th>
          <?php if($_SESSION['auth']<=1){echo "<th>Actions</th>";}?> 
        </tr>
      </thead>
      <tbody>
        <?php foreach($admin as $a){?>
        <tr class="success">
          <td><?=$no?></td>
          <td><?=$a->namaadmin?></td>
          <td><?=$a->alamatadmin?></td>
          <td><?=$a->kontakadmin?></td>
          <td><?=$a->emailadmin?></td>
          <td><?=$a->auth<=1?"Admin":"Staff"?></td>
          <?php if($_SESSION['auth']<=1){echo "<td><a href='?modules=editadmin&&emailadmin=$a->emailadmin'>Edit</a> || <a href='?modules=struktur&&id=$a->idadmin'>Delete</a></td>";}?> 
        </tr>
      <?php $no++; }?>
      </tbody>
    </table>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#admin">
      Tambahkan admin
    </button>
	</div>
</div>

<!-- ================================================================================= -->

<div class="modal fade" id="admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" name="admin">
      <div class="modal-body">
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="namaadmin" class="form-control" required="">
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="alamatadmin" required=""></textarea>
              </div>
          </div>
          <div class="form-group row">
             <label class="col-sm-2 col-form-label">Kontak</label>
             <div class="col-sm-10">
             <input type="number" name="kontakadmin" class="form-control" required="">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
              <input type="email" name="emailadmin" class="form-control" required="">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
              <input type="text" name="password" class="form-control" required="">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Auth</label>
              <div class="col-sm-10">
                <select name="auth" class="form-control">
                  <option value="1">Admin</option>
                  <option value="2">Staff</option>
                </select>
              </div>
          </div>

    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnSub">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>