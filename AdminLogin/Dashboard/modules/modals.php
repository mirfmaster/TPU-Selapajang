<!-- Modal makam -->
  <?php 
$object= new stdClass();
if (isset($_POST['btnBlok'])) {
  $table="blok";
  $object->namablok=$_POST['namablok'];
  $object->keterangan=$_POST['keterangan'];

  $query=$dbAdmin->Insert($table,$object);
  
// var_dump($query);

} ?>

<div class="modal fade" id="makamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" name="blok">
      <div class="modal-body">
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Blok</label>
              <div class="col-sm-10">
                <input type="text" name="namablok" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="keterangan"></textarea>
              </div>
          </div>

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnBlok">Save changes</button></form>
      </div>
    </div>
  </div>
</div>
</div>


<!-- ---------------------------------------------------------------------- -->
<!-- Modal Sub Blok -->
<?php 
$que="SELECT * FROM blok";
$dbAdmin->setQuery($que);
$sub=$dbAdmin->loadObjectList();

$subobject= new stdClass();
if (isset($_POST['btnSub'])) {
  $table="subblok";
  $subobject->idblok=$_POST['blok'];
  $subobject->subblok=$_POST['subblok'];
  $subobject->panjangkolom=$_POST['panjangkolom'];
  $subobject->lebarbaris=$_POST['lebarbaris'];

  $query=$dbAdmin->Insert($table,$subobject);
  
// var_dump($query);

} ?>

<div class="modal fade" id="subBlok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" name="blok">
      <div class="modal-body">
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Sub-Blok</label>
              <div class="col-sm-10">
                <input type="text" name="subblok" class="form-control">
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Sub-Blok Dari</label>
              <div class="col-sm-10">
                <select name="blok">
                  <?php foreach ($sub as $s) {
                    echo "<option value='$s->idblok'>$s->namablok</option>";
                  } ?>
                </select>
              </div>
           </div>
          <div class="form-group row">
             <label class="col-sm-2 col-form-label">Panjang Kolom</label>
             <div class="col-sm-10">
             <input type="text" name="panjangkolom" class="form-control">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Lebar Baris</label>
              <div class="col-sm-10">
              <input type="text" name="lebarbaris" class="form-control">
              </div>
          </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="keterangan"></textarea>
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
</div>

