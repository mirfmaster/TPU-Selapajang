<?php 
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("CUR", getcwd());
define("ASSETS", ROOT."assets/");
require_once (ROOT."cfg/command.php");
$dbAdmin= new DB();
if (isset($_GET['filter'])) {
$filter=$_GET['filter'];    
}
$judul = "Laporan Izin Penggunaan Tanah Makam";
$a = [
  0 => [
    'label' => [ "ID", "Tanggal Pesanan", "Nama Pemohon", "Alamat", "Kontak", "Email", "Catatan", "Nama Alm", "Nama Petugas", "Status" ],
    'length' => [ "15", "35", "30", "50", "30", "40", "30", "30", "30", "30"],
    'align' => [ "C", "C", "C", "C", "C", "C", "C", "C", "C", "C"]
  ]
];
// dnd($a[0]['label'][0]);die;
$headerTable = array();
for($i = 0; $i <= 9; $i++) {
  $headerTable[] = ['label'=> $a[0]['label'][$i],'length' => $a[0]['length'][$i],'align' => $a[0]['align'][$i]];
} 
$query="
SELECT a.idpesanan, DATE_FORMAT(FROM_UNIXTIME(a.tanggalpesanan), '%d-%c-%Y') as tanggalpesanan,b.nama,b.alamat,b.kontak,b.email,c.catatan,d.namaalm,e.namaadmin,a.status FROM pesanan a 
LEFT JOIN klien b ON a.idklien = b.idklien 
LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
LEFT JOIN proses d ON a.idpesanan=d.idpesanan
LEFT JOIN admin e ON e.idadmin=d.idadmin WHERE a.status='3'
";
(isset($filter))?$query .= "AND DATE_FORMAT(FROM_UNIXTIME(tanggalpesanan), '%c')=".$_POST['filter']:"";
$dbAdmin->setQuery($query);
$col=$dbAdmin->loadObjectList();

require_once (ASSETS."fpdf181/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage("L","Legal");
#tampilkan judul laporan
$pdf->SetFont('Arial','B','16');

$pdf->Cell(0,20, $judul, '0', 1, 'C');
#buat header tabel
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
// dnd($headerTable);
$pdf->Cell(15,5,"No",1, '0', "C", true);
foreach ($headerTable as $kolom) {
    $pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
#tampilkan data tabelnya
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('Arial','','10');
$fill=false;
foreach ($col as $baris) {
    $i = 0;
    $pdf->Cell(15,5,$i+1,1, '0', $kolom['align'], $fill);
    foreach ($baris as $key => $cell) {
        if ($key == "status") {
          $cell = "Selesai";
        }
        $pdf->Cell($headerTable[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
        $i++;
    }
    $fill = !$fill;
    $pdf->Ln();
}
#output file PDF
$pdf->Output();

 ?>