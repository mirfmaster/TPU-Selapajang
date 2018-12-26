<div class="content-box-large">
	<div class="panel-heading">
	<div class="panel-title"><?php echo $headercontent[0]; ?></div>
</div>
	<div class="panel-body">

<table class="table">
      <?php 
      $no=1;
      $query="SELECT * FROM barang ORDER by namabarang ASC";
      $dbAdmin->setQuery($query);
      $hasil=$dbAdmin->loadObjectList();
      // var_dump($hasil);
      ?>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Stock</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($hasil as $h){?>
        <tr class="success">
          <td><?=$no?></td>
          <td><?=$h->namabarang?></td>
          <td><?=$h->stock?></td>
        </tr>
      <?php $no++; } ?>
      </tbody>
    </table>

	</div>
</div>