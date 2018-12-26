<?php include_once "modals.php"; ?>
<div class="content-box-large">
	<div class="panel-heading">
	<div class="panel-title">Pengaturan Sub-Blok</div>
</div>
	<div class="panel-body">
<table class="table">
<?php 
$query="SELECT * FROM subblok a,blok b WHERE a.idblok=b.idblok ";
$dbAdmin->setQuery($query);
$blok=$dbAdmin->loadObjectList();
$no=1;
if (isset($_GET['id'])) {
  $table="subblok";
  $condition="idsubblok=$_GET[id]";
  $dbAdmin->Delete($table,$condition);
}
 ?>
       <thead>
        <tr>
          <th>No</th>
          <th>Sub-Blok Dari</th>
          <th>Nama Sub-Blok</th>
          <th>Panjang Kolom Blok</th>
          <th>Lebar Baris Blok</th>
          <th>Keterangan Blok</th>
          <th>Status</th>
          <?=$_SESSION['auth']==1?"<th>Actions</th>":"";?>
        </tr>
      </thead>
      <tbody>
        <?php foreach($blok as $b){?>
        <tr class="success">
          <td><?=$no?></td>
          <td>Blok <?=$b->namablok?></td>
          <td>Blok <?=$b->subblok?></td>
          <td><?=$b->panjangkolom?></td>
          <td><?=$b->lebarbaris?></td>
          <td><?=$b->keterangan?></td>
          <td><?=$b->status_subblok==0?"Tidak Terpakai":"Terpakai"?></td>
          <?=$_SESSION['auth']==1?"<td><a href='?modules=editsubblok&&id=$b->idsubblok'>Edit</a> || <a href='?modules=settingsubblok&&id=$b->idsubblok'>Delete</a></td>":"";?>

        </tr>
      <?php $no++; } ?>
      </tbody>
    </table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subBlok">
  Tambahkan Data
</button>
	</div>


<!-- ---------------------------------------------------------------------------------------------------- -->