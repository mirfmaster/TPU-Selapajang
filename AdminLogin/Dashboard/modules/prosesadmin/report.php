<div class="content-box-large">
	<div class="panel-heading">
</div>
	<div class="panel-body">
<div class="form-group search">
  <form method="POST">
    <div class="form-group col-md-3">
      <label for="sel1">Filter berdasarkan bulan:</label>
      <select class="form-control" id="filter" name="filter">
        <option >Filter berdasarkan</option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
      </select>
      <input type="submit" class="btn btn-info form-control" id="submit" style="display: none;">
    </div> 
  </form>
</div>
<?php 
      $query="
      SELECT a.idpesanan,a.status,a.tanggalpesanan,b.nama,b.alamat,b.kontak,b.email,c.catatan,d.namaalm,e.namaadmin FROM pesanan a 
      LEFT JOIN klien b ON a.idklien = b.idklien 
      LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
      LEFT JOIN proses d ON a.idpesanan=d.idpesanan
      LEFT JOIN admin e ON e.idadmin=d.idadmin WHERE a.status='3' 
      ";
      (isset($_POST['filter']))?$query .= "AND DATE_FORMAT(FROM_UNIXTIME(tanggalpesanan), '%c')=".$_POST['filter']:"";
      $dbAdmin->setQuery($query);
      $col=$dbAdmin->loadObjectList();
      $no=1;
?>
<table class="table">
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
        </tr>
        <?php $no++;} 
        $filter="";
        if (isset($_POST['filter'])) {
          $filter="&filter=".$_POST['filter'];
        }

         ?>
      </tbody>
    </table>

    <a href="index.php?modules=printPdf<?=$filter;?>">Print</a>
	</div>
</div>



<script>
  $("#filter").on("change",function(){
    $("#submit").click();
  })

</script>