<!DOCTYPE html>
<html>
<head>
	<title>Cetak Excel</title>
	<link rel="icon" href="../img/logo1.png">
</head>
<body>

</body>
</html>
<?php 
	date_default_timezone_set("Asia/Jakarta");
	
	@$bln = $_GET['bln'];
	@$thn = $_GET['thn'];

	@$tgl=$_GET['tgl'];
	@$a=substr($tgl, 8,2);
	@$b=substr($tgl, 5,2);
	@$c=substr($tgl, 0,4);

	@$tgl_awal=$_GET['tgl_awal'];
	@$aa=substr($tgl_awal, 8,2);
	@$ab=substr($tgl_awal, 5,2);
	@$ac=substr($tgl_awal, 0,4);

	@$tgl_akhir=$_GET['tgl_akhir'];
	@$ba=substr($tgl_akhir, 8,2);
	@$bb=substr($tgl_akhir, 5,2);
	@$bc=substr($tgl_akhir, 0,4);

	switch ($bln) {
		case '1': @$bulaninitext="Januari"; break;
		case '2': @$bulaninitext="Februari"; break;
		case '3': @$bulaninitext="Maret"; break;
		case '4': @$bulaninitext="April"; break;
		case '5': @$bulaninitext="Mei"; break;
		case '6': @$bulaninitext="Juni"; break;
		case '7': @$bulaninitext="Juli"; break;
		case '8': @$bulaninitext="Agustus"; break;
		case '9': @$bulaninitext="September"; break;
		case '10': @$bulaninitext="Oktober"; break;
		case '11': @$bulaninitext="Novemmber"; break;
		case '12': @$bulaninitext="Desember"; break;
		default: @$bulaninitext=""; break;
	}

	switch ($b) {
		case '1': @$bln="Januari"; break;
		case '2': @$bln="Februari"; break;
		case '3': @$bln="Maret"; break;
		case '4': @$bln="April"; break;
		case '5': @$bln="Mei"; break;
		case '6': @$bln="Juni"; break;
		case '7': @$bln="Juli"; break;
		case '8': @$bln="Agustus"; break;
		case '9': @$bln="September"; break;
		case '10': @$bln="Oktober"; break;
		case '11': @$bln="Novemmber"; break;
		case '12': @$bln="Desember"; break;
		default: @$bln=""; break;
	}

	switch ($ab) {
		case '1': @$bln1="Januari"; break;
		case '2': @$bln1="Februari"; break;
		case '3': @$bln1="Maret"; break;
		case '4': @$bln1="April"; break;
		case '5': @$bln1="Mei"; break;
		case '6': @$bln1="Juni"; break;
		case '7': @$bln1="Juli"; break;
		case '8': @$bln1="Agustus"; break;
		case '9': @$bln1="September"; break;
		case '10': @$bln1="Oktober"; break;
		case '11': @$bln1="Novemmber"; break;
		case '12': @$bln1="Desember"; break;
		default: @$bln1=""; break;
	}

	switch ($bb) {
		case '1': @$bln2="Januari"; break;
		case '2': @$bln2="Februari"; break;
		case '3': @$bln2="Maret"; break;
		case '4': @$bln2="April"; break;
		case '5': @$bln2="Mei"; break;
		case '6': @$bln2="Juni"; break;
		case '7': @$bln2="Juli"; break;
		case '8': @$bln2="Agustus"; break;
		case '9': @$bln2="September"; break;
		case '10': @$bln2="Oktober"; break;
		case '11': @$bln2="Novemmber"; break;
		case '12': @$bln2="Desember"; break;
		default: @$bln2=""; break;
	}
@$inc="";
@$nama="";
switch ($_GET['menu']) {
	case 'keuangan': @$inc="cetak_keuangan.php"; @$nama="Laporan Keuangan - ".$bulaninitext." ".$thn.".xls"; break;
	case 'pembelian': @$inc="cetak_pembelian.php"; @$nama="Laporan Pembelian Barang - ".$bulaninitext." ".$thn.".xls"; break;
	case 'transaksi': @$inc="cetak_transaksi.php"; @$nama="Laporan Transaksi - ".$bulaninitext." ".$thn.".xls"; break;
	case 'transaksi_harian': @$inc="cetak_transaksi_harian.php"; @$nama="Laporan Transaksi Harian - Tanggal $a $bln $c.xls"; break;
	case 'barang': @$inc="cetak_barang.php"; @$nama="Daftar Barang.xls"; break;
	case 'jenisbarang': @$inc="cetak_jenisbarang.php"; @$nama="Daftar Jenis Barang.xls"; break;
	case 'user': @$inc="cetak_user.php"; @$nama="Daftar User.xls"; break;
	case 'supplier': @$inc="cetak_supplier.php"; @$nama="Daftar Supplier.xls"; break;
	default: break;
}

header("Content-type: application/vnd.ms-excel;charset:UTF-8");
header("Content-type: application/image/png");
header("Content-Disposition: attachment; filename=$nama");
include($inc);

?>