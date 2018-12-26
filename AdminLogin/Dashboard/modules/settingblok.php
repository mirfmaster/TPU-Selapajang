<?php 
include_once "modals.php";
$table="blok";
$query="SELECT * FROM $table ORDER BY namablok ASC";
$dbAdmin->setQuery($query);
$blok=$dbAdmin->loadObjectList();
$no=1;
if (isset($_GET['id'])) {
  $condition="idblok=$_GET[id]";
  $dbAdmin->Delete($table,$condition);
  // if ($result=true) {
  //       header('Location: index.php?modules=settingblok');
  //       }
}
 ?>
<div class="content-box-large">
	<div class="panel-heading">
	<div class="panel-title">Pengaturan Blok</div>
</div>
	<div class="panel-body">
<table class="table">
       <thead>
        <tr>
          <th>No</th>
          <th>Nama Blok</th>
          <th>Keterangan</th>
          
          <?=$_SESSION['auth']==1?"<th>Actions</th>":"";?>
        </tr>
      </thead>
      <tbody>
        <?php foreach($blok as $b){?>
        <tr class="success">
          <td><?=$no?></td>
          <td>Blok <?=$b->namablok?></td>
          <td><?=$b->keterangan?></td>
          
          <?=$_SESSION['auth']==1?"<td><a href=''>Edit</a> || <a href='?modules=settingblok&&id=".$b->idblok."'>Delete</a></td>":"";?>

        </tr>
      <?php $no++; } ?>
      </tbody>
    </table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#makamModal">
  Tambahkan Data
</button>
	</div>


<!-- ---------------------------------------------------------------------------------------------------- -->