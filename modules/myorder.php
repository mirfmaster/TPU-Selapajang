<?php 
      $query="
      SELECT * FROM pesanan a 
      LEFT JOIN klien b ON a.idklien = b.idklien 
      LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
      LEFT JOIN proses d ON a.idpesanan=d.idpesanan
      LEFT JOIN admin e ON e.idadmin=d.idadmin
      WHERE a.idklien=".$_SESSION['idklien']." ORDER BY a.idpesanan 
      ";
      $db->setQuery($query);
      $col=$db->loadObjectList();
      $no=1;
?>
<div class="jumbotron" style="width: 130%;margin-left: -10%">
  <h1 class="display-5">Pesanan Anda</h1>
  <hr class="my-4">         
    <div class="table-responsive">
      <table class="table table-condensed" style="font-size: 15px;font-size: 14px">
        <thead>
          <tr style="text-align: center;">
            <th>No</th>
            <th>Nama Pemohon</th>
            <th>Tanggal<br>Pesanan</th>
            <th>Tanggal<br>Verifikasi</th>
            <th>Tanggal<br>Upload Bukti</th>
            <th>Status</th>
            <th>Nama<br>Almarhum</th>
            <th>Nama <br>Petugas</th>
            <th>Kontak Petugas</th>
            <th>Actions</th>
          </tr>
        </thead>
        <?php foreach ($col as $c): ?>
        <tbody>
        <tr class="success" style="text-align: center;">
          <td><?=$no;?></td>
          <td><?=$c->nama;?></td>
          <td><?=date('d-m-Y',substr($c->tanggalpesanan, 0));?></td>
          <td>
            <?=$c->tanggalverifikasi==0?"Masih <br>menunggu verifikasi":date('d-m-Y',substr($c->tanggalverifikasi, 0));?>
          </td>
          <td>
            <?=$c->tanggaluploadskrd==0?"Masih menunggu upload":date('d-m-Y',substr($c->tanggaluploadskrd, 0));?>
          </td>
          <td>
            <?php 
              if ($c->status=="0") {
                echo "Menunggu verifikasi berkas";
              } elseif ($c->status=="1") {
                echo "Terverifikasi";
              } elseif ($c->status=="2") {
                echo "Menunggu konfirmasi pembayaran";
              } elseif ($c->status=="3") {
                echo "Pemesanan selesai";
              } elseif ($c->status=="4") {
                echo "Pemesanan gagal";
              }
            ?>
          </td>
          <td><?=$c->namaalm==0?$c->namaalm:"Masih menunggu verifikasi";?></td>
          <td><?=$c->namaadmin==0?$c->namaadmin:"Masih menunggu verifikasi";?></td>
          <td><?=$c->kontakadmin==0?$c->kontakadmin:"Masih menunggu verifikasi";?></td>
          <td>
            <?php 
              if ($c->status=="0") {
                echo "Menunggu verifikasi berkas";
              } elseif ($c->status=="1") {
                echo "<a href='index.php?i=upload&iddetail=$c->iddetail&idpesanan=$c->idpesanan'>Upload bukti</a>";
              } elseif ($c->status=="2") {
                echo "<a href='index.php?i=upload&iddetail=$c->iddetail&idpesanan=$c->idpesanan'>Reupload bukti pembayaran</a>";
              } elseif ($c->status=="3") {
                echo "<a href='index.php?i=detail&idpesanan=$c->idpesanan&email=".$_SESSION['email']."'>Lihat Detail</a>";
              } elseif ($c->status=="4") {
                echo "<a href=''>Reset</a>";
              }
            ?>

          </td>
        </tr>
        <?php $no++;endforeach ?>
        </tbody>
      </table>
    </div>
</div>
