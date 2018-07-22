<?php  
	include "../config/koneksi.php";
	include "../library/fungsi.php";
	@session_start();
	date_default_timezone_set("Asia/Jakarta");
	

	@$aksi = new oop();
	@$table = "qw_transaksi";

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

	if (empty($_GET['tgl_awal'])||empty($_GET['tgl_awal'])) {
		@$cari = "WHERE tgl_transaksi = '$tgl'";		
	}else{
		@$cari = " WHERE tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
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
	<title>Cetak Trasnsaksi Harian</title>
	<link rel="icon" href="../img/logo1.png">
<body onload="window.print();" style="font-family:'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma,  sans-serif;width:21cm;">
		<table>
			
		</table>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" >
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
				 	<td colspan="7" align="center">
				 		
						<?php  
							if (empty($_GET['tgl_awal'])||empty($_GET['tgl_awal'])) {
						?>
							<h3 align="center">Daftar Transaksi Harian - Tanggal <?php echo $a." ".$bln." ".$c; ?></h3>
						<?php }else{ ?>
							<h3 align="center">Daftar Transaksi Harian - Dari Tanggal <?php echo $aa." ".$bln1." ".$ac; ?> &nbsp;-&nbsp;<?php echo $ba." ".$bln2." ".$bc; ?></h3>
						<?php } ?>

				 	</td>
				</tr>

				<tr style="border:1px solid black;">
					<th width="6%"  style="border:1px solid black">No.</th>
					<th width="15%"  style="border:1px solid black">Tanggal</th>
					<th width="15%"  style="border:1px solid black">No.Transaksi</th>
					<th width="15%"  style="border:1px solid black">Kasir</th>
					<th width="15%"  style="border:1px solid black">Total</th>
					<th width="8%"  style="border:1px solid black">Diskon</th>
					<th width="20%"  style="border:1px solid black">Total Akhir</th>
				</tr>
			</thead>
			<tbody  style="border:1px solid black;">
				<?php  
					$sql = $aksi->tampil($table,$cari,"ORDER BY waktu ASC");
					@$no = 0;
					if ($sql =="") {
						echo "<tr><td align='center' colspan='7'><b>Data Tidak Ada</b></td></tr>";
					}else{
						foreach ($sql as $data) {
							$no++;
				?>
					<tr  style="border:1px solid black;">
						<td align="center" style="border:1px solid black"><?php echo $no; ?>.</td>
						<td align="center" style="border:1px solid black"><?php echo $data[1]; ?></td>
						<td align="center" style="border:1px solid black"><?php echo $data[0]; ?></td>
						<td align="center" style="border:1px solid black"><?php echo $data[9]; ?></td>
						<td align="right" style="border:1px solid black;padding-right:10px"><?php echo number_format($data[4],0,'','.');?></td>
						<td align="center" style="border:1px solid black;padding-right:10px"><?php echo number_format($data[5],0,'','.');?></td>
						<td align="right" style="border:1px solid black;padding-right:10px"><?php echo number_format($data[6],0,'','.');?></td>
					</tr>
				<?php } } 
					if (empty($_GET['tgl_awal'])||empty($_GET['tgl_awal'])) {
						@$tl = mysql_fetch_array(mysql_query("SELECT SUM(total_akhir) as 'total_dapat' FROM tbl_transaksi WHERE tgl_transaksi = '$tgl'"));
						@$pendapatan = $tl['total_dapat']; 
					?>
						<tr>
							<td colspan="6" align="right" style="border:1px solid black;padding-right:10px"><b>Pendapatan Harian Tanggal <?php echo $a." ".$bln." ".$c; ?> : </b></td>
							<td align="right" style="border:1px solid black;padding-right:10px"><b>Rp. <?php echo number_format($pendapatan,0,'','.');?></b></td>
						</tr>
					<?php }else{
					 	@$tl = mysql_fetch_array(mysql_query("SELECT SUM(total_akhir) as 'total_dapat' FROM tbl_transaksi WHERE tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
						@$pendapatan = $tl['total_dapat'];
					?>
						<tr>
							<td colspan="6" align="right" style="border:1px solid black;padding-right:10px"><b>Pendapatan dari Tanggal <?php echo $aa." ".$bln1." ".$ac; ?> &nbsp;-&nbsp;<?php echo $ba." ".$bln2." ".$bc; ?> : </b></td>
							<td align="right" style="border:1px solid black;padding-right:10px" ><b>Rp. <?php echo number_format($pendapatan,0,'','.');?></b></td>
						</tr>

					<?php } ?>
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