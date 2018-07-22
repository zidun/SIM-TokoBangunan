<?php
	ob_start(); 
	include "../config/koneksi.php";
	include "../library/fungsi.php";
	@session_start();
	date_default_timezone_set("Asia/Jakarta");
	

	@$aksi = new oop();
	@$table = "qw_barang";

	$blnini=date("m");
	switch ($blnini) {
		case '1': @$blnskrg="Januari"; break;
		case '2': @$blnskrg="Februari"; break;
		case '3': @$blnskrg="Maret"; break;
		case '4': @$blnskrg="April"; break;
		case '5': @$blnskrg="Mei"; break;
		case '6': @$blnskrg="Juni"; break;
		case '7': @$blnskrg="Juli"; break;
		case '8': @$blnskrg="Agustus"; break;
		case '9': @$blnskrg="September"; break;
		case '10': @$blnskrg="Oktober"; break;
		case '11': @$blnskrg="Novemmber"; break;
		case '12': @$blnskrg="Desember"; break;
		default: @$blnskrg=""; break;
	}
	$hrini=date("N");
	switch ($hrini) {
		case '1': @$hrskrg="Senin"; break;
		case '2': @$hrskrg="Selasa"; break;
		case '3': @$hrskrg="Rabu"; break;
		case '4': @$hrskrg="Kamis"; break;
		case '5': @$hrskrg="Jumat"; break;
		case '6': @$hrskrg="Sabtu"; break;
		case '7': @$hrskrg="Minggu"; break;
		default: @$hrskrg=""; break;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Cetak Barang</title>
	<link rel="icon" href="../img/logo1.png">
<body onload="window.print()" style="font-family:'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma,  sans-serif;width:21cm;">
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
			<thead>
				<tr>
				 	<td colspan="2"><img src="http://localhost:81/CBT/revisi/toko bangunan/img/logo1.png" alt="logo" width="160" height="90"></td>
				 	<td colspan="5">
				 		<h1 style="margin:0">PB.SAMI AGUNG</h1>
				 		<h4 style="margin:0;margin-top:4px;">Jl. Raya Tajur No.129 BOGOR</h4>
				 	</td>
				</tr>
				<tr><td colspan="7"><hr></td></tr>
				<tr>
				 	<td colspan="7" align="center"><h3 align="center">Daftar Barang</h3></td>
				</tr>
				<tr>
					<th width="5%"  style="border:1px solid black">No.</th>
					<th width="12%" style="border:1px solid black">Kode</th>
					<th width="23%" style="border:1px solid black">Nama Barang</th>
					<th  style="border:1px solid black">Satuan</th>
					<th  style="border:1px solid black">Jenis </th>
					<th  style="border:1px solid black">Stok</th>
					<th  style="border:1px solid black">Harga Pokok</th>
					<th  style="border:1px solid black">PPN</th>
					<th  style="border:1px solid black">Harga Jual</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$sql = $aksi->tampil($table,"","ORDER BY nama_barang ASC");
					@$no = 0;
					if ($sql =="") {
						echo "<tr><td align='center' colspan='5'></td></tr>";
					}else{
						foreach ($sql as $data) {
							$no++;
				?>
					<tr>
						<td align="center" style="border:1px solid black"><?php echo $no; ?>.</td>
						<td align="center" style="border:1px solid black"><?php echo $data['kd_barang']; ?></td>
						<td align="center" style="border:1px solid black"><?php echo $data['nama_barang']; ?></td>
						<td align="center" style="border:1px solid black"><?php echo $data['satuan']; ?></td>
						<td align="center" style="border:1px solid black"><?php echo $data['jenis']; ?></td>
						<td align="right" style="border:1px solid black"><?php echo number_format($data['stok'],0,'','.'); ?></td>
						<td align="right" style="border:1px solid black"><?php echo number_format($data['harga_pokok'],0,'','.'); ?></td>
						<td align="right" style="border:1px solid black"><?php echo number_format($data['ppn'],0,'','.'); ?></td>
						<td align="right" style="border:1px solid black"><?php echo number_format($data['harga_jual'],0,'','.'); ?></td>
					</tr>
				<?php } } ?>
			</tbody>
		</table>
		<table align="right" style="margin-right:40px;">
			<tr><td rowspan="10" width="50px"></td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td align="center"><?php echo $hrskrg.", ".date(" j ").$blnskrg.date(" Y "); ?></td>
			</tr>
			<tr>
				<td align="center">Hormat Saya,</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td align="center"><?php echo $_SESSION['nama']; ?></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		</table>
</body>
</html>