<div class="content-box-large">
	<div class="panel-heading">
	<!-- <div class="panel-title"><?php echo $headercontent[0];?></div> -->
</div>
	<div class="panel-body">
<div class="form-group search">
  <form method="POST">
    <div class="form-group col-md-3">
      <label for="sel1">Filter By:</label>
      <select class="form-control" id="filter" name="filter">
        <option >Filter berdasarkan</option>
        <option value="0">Baru dipesan</option>
        <option value="1">Terverifikasi</option>
        <option value="3">Terkonfirmasi</option>
        <option value="4">Ditolak</option>
      </select>
      <input type="submit" class="btn" id="submit" style="display: none;">
    </div> 
  </form>
</div>
<?php 

      $query="
      SELECT a.idpesanan,a.status,a.tanggalpesanan,b.nama,b.alamat,b.kontak,b.email,c.catatan,d.namaalm,e.namaadmin FROM pesanan a 
      LEFT JOIN klien b ON a.idklien = b.idklien 
      LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
      LEFT JOIN proses d ON a.idpesanan=d.idpesanan
      LEFT JOIN admin e ON e.idadmin=d.idadmin
      ";
      if (isset($_POST['filter'])) {
        $query .= "WHERE a.status=".$_POST['filter']." ORDER BY tanggalpesanan DESC";
      } else {
        $query .="ORDER BY tanggalpesanan DESC";}
      $dbAdmin->setQuery($query);
      $col=$dbAdmin->loadObjectList();
      $no=1;
?>
<table class="table table-responsive">
      <thead>
        <tr>
          <th style="text-align: center;">No</th>
          <th style="text-align: center;">ID</th>
          <th style="text-align: center;">Tanggal Pesanan</th>
          <th style="text-align: center;">Nama Pemohon</th>
          <th style="text-align: center;">Alamat</th>
          <th style="text-align: center;">Kontak</th>
          <th style="text-align: center;">Email</th>
          <th style="text-align: center;">Catatan</th>
          <th style="text-align: center;">Nama Alm</th>
          <th style="text-align: center;">Nama <br>Petugas</th>
          <th style="text-align: center;">Status</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($col as $c) {
        	
        ?>
        <tr class="success">
          <td><?=$no;?></td>
          <td><?=$c->idpesanan;?></td>
          <td><?=date('d-m-Y',substr($c->tanggalpesanan, 0));?></td>
          <td><?=$c->nama;?></td>
          <td><?=$c->alamat;?></td>
          <td><?=$c->kontak;?></td>
          <td><?=$c->email;?></td>
          <td><?=$c->catatan;?></td>
          <td><?=$c->namaalm;?></td>
          <td><?=$c->namaadmin;?></td>
          <td style="text-align: center;">
            <?php 
              if ($c->status=="0") {
                echo "Menunggu verifikasi";
              } elseif ($c->status=="1") {
                echo "Menunggu pembayaran <br>retribusi";
              } elseif ($c->status=="2") {
                echo "Menunggu konfirmasi <br>pembayaran retribusi";
              } elseif ($c->status=="3") {
                echo "Proses selesai";
              } elseif ($c->status=="4") {
                echo "Proses gagal";
              }
            ?>
          </td>
          <td>
            <?php 
              if ($c->status=="0") {
                echo "<a href='index.php?modules=verifikasi&id=$c->idpesanan&email=$c->email'>Verifikasi</a>";
              } elseif ($c->status=="1") {
                echo "Terverifikasi";
              } elseif ($c->status=="2") {
                echo "<a href='index.php?modules=konfirmasi&id=$c->idpesanan&email=$c->email'>Konfirmasi</a>";
              } elseif ($c->status=="3") {
                echo "<a href='index.php?modules=details&id=$c->idpesanan&email=$c->email'>Lihat Detail</a>";
              } elseif ($c->status=="4") {
                echo "<a href=''>Reset</a>";
              }
            ?>

          </td>
        </tr>
        <?php $no++;} ?>
      </tbody>
    </table>

	</div>
</div>

<script>
  $("#filter").on("change",function(){
    $("#submit").click();
  })

</script>