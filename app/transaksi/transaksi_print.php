<?php
	include "../config/koneksi.php";
	include "../library/fungsi.php";

	@$aksi = new oop();

	@$no_transaksi = $_GET['no_transaksi'];

	@$sql = mysql_fetch_array(mysql_query("SELECT * FROM qw_transaksi WHERE no_transaksi = '$no_transaksi'"));
	@$subtotal = $sql['subtotal'];
	@$diskon = $sql['diskon']; 
	@$total_akhir = $sql['total_akhir']; 
	@$bayar = $sql['bayar']; 
	@$kembalian = $sql['kembalian'];
	@$tanggal = $sql['waktu']; 
	@$kasir = $sql['nama_kasir'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Struk</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" href="../img/logo1.png">
</head>
<body onload="window.print()" style="font-family:monospace;">
<table>
	<tr><td colspan="4" align="center"><strong><div class="pt">PB.SAMI AGUNG</div></strong></td></tr>
	<tr><td colspan="4" align="center">Sedia: bahan bangunan,keramik,besi beton Dll.</td></tr>
	<tr><td colspan="4" align="center">Jl. Raya Tajur No.129 BOGOR<br>Tlp.0251-8313-764 / Hp.0818204720</td></tr>
	<tr><td colspan="4">----------------------------------------------------</tr>
	<tr>
		<td colspan="2"><?php echo @$no_transaksi; ?></td>
		<td colspan="2" align="right">Kasir :</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo @$tanggal; ?></td>
		<td colspan="2" align="right"><?php echo @$kasir; ?></td>
	</tr>
	<tr><td colspan="4">----------------------------------------------------</tr>
	<tr>
		<td>Barang</td>
		<td align="right">Harga<br>Satuan</td>
		<td align="center">Jumlah<br>Beli</td>
		<td align="right">Total Harga</td>
	</tr>
	<tr></tr>
	<tr><td colspan="4">----------------------------------------------------</tr>
	<tbody>
		<?php  
			@$b = $aksi->tampil("tbl_transaksi_detail","WHERE no_transaksi = '$no_transaksi'","");
			@$no = 0;
			if ($b == "") {
				echo "<tr><td colspan='7' align='center'><b>Belum Ada Barang Yang Ditambahkan !!!</b></td></tr>";
			}else{
				foreach ($b as $data) {
			?>		
		<tr>
			<td><?php echo @$data['barang']; ?></td>
			<td align="right"><?php echo number_format(@$data['harga'],0,'','.'); ?></td>
			<td align="center"><?php echo number_format(@$data['banyak'],0,'','.'); ?></td>
			<td align="right"><?php echo number_format(@$data['total'],0,'','.'); ?></td>
		</tr>
		<?php }}?>
		<tr><td colspan="4">----------------------------------------------------</tr>
		<tr>
			<td  colspan="2" align="right"><b>TOTAL KESELURUHAN</b></td>
			<td align="center"><b>Rp.</td>
			<td align="right"><b><?php echo number_format(@$subtotal, 0,'','.'); ?></b></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><b>DISKON</b></td>
			<td align="center"><b>%</b></td>
			<td align="right"><b><?php echo @$diskon?> %</b></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><b>TOTAL AKHIR</b></td>
			<td align="center"><b>Rp.</td>
			<td align="right"><b><?php echo number_format(@$total_akhir, 0,'','.'); ?></b></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><b>BAYAR</b></td>
			<td align="center"><b>Rp.</td>
			<td align="right"><b><?php echo number_format(@$bayar, 0,'','.'); ?></b></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><b>KEMBALIAN</b></td>
			<td align="center"><b>Rp.</td>
			<td align="right"><b><?php echo number_format(@$kembalian, 0,'','.'); ?></b></td>
		</tr>
		<tr><td colspan="4">----------------------------------------------------</tr>						
		<tr><td colspan="4" align="center">PERHATIAN !!!<br>BARANG YANG SUDAH DIBELI TIDAK BISA DITUKAR LAGI</td></tr>
		<tr><td colspan="4" align="center">TERIMA KASIH ATAS KUNJUNGANNYA</td></tr>
		<tr><td colspan="4">----------------------------------------------------</tr>						
	</tbody>
</table>
</body>
</html>