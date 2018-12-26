<div class="content-box-large">
	<div class="panel-heading">
 <div class="panel-title">Pesanan menunggu</div>
</div>
	<div class="panel-body">
<table class="table">
      <?php 
      
      $limit=10;
      $query="
      SELECT a.idpesanan,a.tanggalpesanan,b.nama,b.alamat,b.kontak,b.email,a.status,c.hubungan,c.catatan FROM pesanan a 
      LEFT JOIN klien b ON a.idklien = b.idklien 
      LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
      WHERE a.status=0 ORDER BY a.tanggalpesanan DESC LIMIT $limit 
      ";
      if (isset($_GET['paging'])) {
      	$get=$_GET['paging'];
      	$offset=$limit*$get;
      	$query .= "OFFSET $offset";
      }
      $dbAdmin->setQuery($query);
      $col=$dbAdmin->loadObjectList();
      // dnd($query);die;
      $no=1;
      ?>
      <thead>
        <tr>
          <th style="text-align: center;">No</th>
          <th style="text-align: center;">ID</th>
          <th style="text-align: center;">Nama Pemohon</th>
          <th style="text-align: center;">Alamat</th>
          <th style="text-align: center;">Kontak</th>
          <th style="text-align: center;">Tanggal Pesanan</th>
          <th style="text-align: center;">Email</th>
          <th style="text-align: center;">Status</th>
          <th style="text-align: center;">Hubungan</th>
          <th style="text-align: center;">Catatan</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
		<?php if ($col): ?>
			<?php foreach ($col as $c): ?>
			<tr class="success">
	          <td><?=$no;?></td>
	          <td><?=$c->idpesanan;?></td>
	          <td><?=$c->nama;?></td>
	          <td><?=$c->alamat;?></td>
	          <td><?=$c->kontak;?></td>
	          <td><?=date('d-m-Y',substr($c->tanggalpesanan, 0));?></td>
	          <td><?=$c->email;?></td>
	          <td>
	            <?php 
	              if ($c->status=="0") {
	                echo "Menunggu verifikasi";
	              }
	            ?>
	          </td>
	          <td><?=$c->hubungan;?></td>
	          <td><?=$c->catatan;?></td>
	          <td>
	            <?php 
	              if ($c->status=="0") {
	                echo "<a href='index.php?modules=verifikasi&id=$c->idpesanan&email=$c->email'>Verifikasi</a>";
	              }
	            ?>

	          </td>
        	</tr>
			<?php $no++; endforeach ?>
		<?php else: ?>
			<tr><td align="center" colspan="10"><h3>Tidak ada pesanan</h3></td></tr>
		<?php endif ?>
      </tbody>
    </table>
	<ul class="pagination pull-right">
	  <li><a href="index.php?paging=1">1</a></li>
	  <li><a href="index.php?paging=2">2</a></li>
	  <li><a href="index.php?paging=3">3</a></li>
	  <li><a href="index.php?paging=4">4</a></li>
	  <li><a href="index.php?paging=5">5</a></li>
	</ul> 
	</div>
</div>

<script>
  $("#filter").on("change",function(){
    $("#submit").click();
  })

</script>