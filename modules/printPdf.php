<?php 
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("CUR", getcwd());
define("ASSETS", ROOT."assets/");

require_once (ROOT."cfg/command.php");
$dbAdmin= new DB();
if (isset($_GET['idpesanan'])) {
$idpesanan=$_GET['idpesanan'];    
}
$judul = "Invoice Pemesanan";
$a = [
  0 => [
    'label' => [ "ID", "Tanggal Pesanan", "Nama Pemohon", "Alamat", "Kontak", "Email", "Catatan", "Nama Alm", "Nama Petugas", "Status" ],
    'length' => [ "15", "35", "30", "50", "30", "30", "30", "30", "30", "30"],
    'align' => [ "C", "C", "C", "C", "C", "C", "C", "C", "C", "C"]
  ]
];
$query="
SELECT a.idpesanan, DATE_FORMAT(FROM_UNIXTIME(a.tanggalpesanan), '%d-%c-%Y') as tanggalpesanan,b.nama,b.alamat,b.kontak,b.email,c.catatan,c.f_skrd,d.namaalm,e.namaadmin,a.status FROM pesanan a 
LEFT JOIN klien b ON a.idklien = b.idklien 
LEFT JOIN pesanan_detail c ON a.idpesanan=c.idpesanan
LEFT JOIN proses d ON a.idpesanan=d.idpesanan
LEFT JOIN admin e ON e.idadmin=d.idadmin WHERE a.idpesanan='$idpesanan'
";
$dbAdmin->setQuery($query);
$data=$dbAdmin->loadObject();
define("UPLOADS", ASSETS."uploads/".$data->email.'/');

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
$pdf->Ln();
#tampilkan data tabelnya
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFontSize(15);
$fill=false;
if ($data->status=='3'){
    $data->status="Pemesanan berhasil.";
}
$pdf->Image(UPLOADS.$data->f_skrd,200,40, -1100);
$height = 10;
$pdf->Cell(50, $height, "ID Pesanan ", 0, '0', "L", false);
$pdf->Cell(20, $height, ": ".$data->idpesanan, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Tanggal", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->tanggalpesanan, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Nama Pemesan", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->nama, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Alamat", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->alamat, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Kontak", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->kontak, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Email", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->email, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Catatan", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->catatan, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Nama Alm", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->namaalm, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Nama Petugas", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->namaadmin, 0, '0', "L", false);
$pdf->Ln(8);
$pdf->Cell(50, $height, "Status Pemesanan", 0, '0', "L", false);
$pdf->Cell(50, $height, ": ".$data->status, 0, '0', "L", false);
$pdf->Ln(8);

#output file PDF
$pdf->Output();

 ?>