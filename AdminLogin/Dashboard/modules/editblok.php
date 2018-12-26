<?php 
$id=$_GET['id'];
$q="SELECT * FROM subblok WHERE idsubblok=$id";
$dbAdmin->setQuery($q);
$h=$dbAdmin->loadObjectList();
?>

<div class="content-box-large">
<div class="panel-heading">
<div class="panel-title">Pengaturan Sub-Blok</div>
</div>
<div class="panel-body">
      <form method="POST" name="blok">
      <div class="modal-body">
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama Sub-Blok</label>
          <div class="col-sm-10">
            <input type="text" name="subblok" class="form-control" value="<?=$h[0]->subblok;?>">
          </div>
        </div>
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Sub-Blok Dari</label>
          <div class="col-sm-10">
            <select name="blok">
              <?php 
              foreach ($sub as $s) {
                echo "<option value='$s->idblok'>$s->namablok</option>";
              } ?>
            </select>
          </div>
       </div>
      <div class="form-group row">
         <label class="col-sm-2 col-form-label">Panjang Kolom</label>
         <div class="col-sm-10">
         <input type="text" name="panjangkolom" class="form-control" value="<?=$h[0]->panjangkolom;?>">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Lebar Baris</label>
          <div class="col-sm-10">
          <input type="text" name="lebarbaris" class="form-control" value="<?=$h[0]->lebarbaris;?>">
          </div>
      </div>
    </div>
  </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnSub">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
</div>
