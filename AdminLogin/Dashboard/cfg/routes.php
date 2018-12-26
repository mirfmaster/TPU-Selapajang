<?php 
$headercontent=array();
if (isset($_GET['modules']))
{
	switch ($_GET['modules']) {
		case "struktur":
			$title="Admin | Struktur Organisasi";
			$headercontent[0]="Struktur Organisasi";
			$headercontent[1]="Daftar Karyawan";
			$include= "modules/users.php";
		break;
		case 'settingblok':
			$title="Admin | Pengaturan";
			$headercontent[0]="Pengaturan";
			$include= "modules/settingblok.php";
		break;
		case 'settingsubblok':
			$title="Admin | Pengaturan";
			$headercontent[0]="Pengaturan";
			$include= "modules/settingsubblok.php";
		break;
		case 'editsubblok':
			$title="Admin | Edit";
			$headercontent[0]="Pengaturan";
			$include= "modules/editblok.php";
		break;
		case 'pemesanan':
			$title="Admin | Order";
			$headercontent[0]="Pemesanan";
			$include ="modules/pemesanan.php";
		break;
		case 'verifikasi':
			$title="Admin | Verify";
			$headercontent[0]="Verifikasi Berkas Pemakaman";
			$include ="modules/prosesadmin/verif.php";
		break;
		case 'konfirmasi':
			$title="Admin | Confirm";
			$headercontent[0]="Konfirmasi";
			$include ="modules/prosesadmin/konfirmasi.php";
		break;
		case 'details':
			$title="Admin | Detail";
			$headercontent[0]="Detail Transaksi";
			$include ="modules/prosesadmin/details.php";
		break;
		case 'logout':
			$dbAdmin->logoutAdmin();
			header('location: ../general.php');
		break;
		case 'back':
			$dbAdmin->logoutAdmin();
			header('location: ../../index.php');
		break;
		case 'pilih':
			$title="Admin | Pilih Blok";
			$headercontent[0]="Pilih Blok Yang Ingin Digunakan";
			$include ="modules/pilih.php";
		break;
		case 'ajax':
			$title="Admin | Pilih Blok";
			$include ="modules/prosesadmin/ajax.php";
		break;
		case 'report':
			$title="Admin | Report";
			$headercontent[0]="Laporan pemesanan yang sudah selesai";
			$include ="modules/prosesadmin/report.php";
		break;
		// tambahan by billy
		case 'printPdf':
			$title="Admin | Report";
			$headercontent[0]="";
			$include ="";
			header("Location: modules/prosesadmin/printPdf.php");
		break;
		// end tambahan by billy
		case 'editadmin':
			$title="Admin | Edit Admin";
			$headercontent[0]="";
			$include ="modules/prosesadmin/editadmin.php";
		break;
		default:
			$title="Error 404!";
			$headercontent[0]="Whoops! We encountered: Error 404 PHP Not found.";
			$include="modules/homepage.php";
		break;
	}
}
else {
	$title="Admin Page";
	$headercontent[0]="Welcome to the homepage";
	$include="modules/homepage.php";
}



 ?>