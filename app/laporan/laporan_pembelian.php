<?php
	date_default_timezone_set("Asia/Jakarta");
 
	@$table = "qw_barang_masuk";
	@$alamat = "?menu=lapbelibarang";

	if (isset($_POST['txt_bulan']) || isset($_POST['txt_tahun'])) {
		@$bulanini=$_POST['txt_bulan'];
		@$tahunini=$_POST['txt_tahun'];
	}else{
		@$bulanini=date("m");
		@$tahunini=date("Y");
	}
	@$cari="WHERE MONTH(tanggal)='$bulanini' AND YEAR(tanggal)='$tahunini'";
	switch ($bulanini) {
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Laporan Pembelian Barang</title>
</head>
<body>
<br><br><br><br>
<div class="container-fluid" id="mrg">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height:40px;">
				<h3 class="panel-title pull-left">Daftar Pembelian Barang - Bulan <?php echo @$bulaninitext." ".@$tahunini ; ?></h3>
				<!-- <div class="pull-right">
					<a href="../laporan/cetak_pembelian.php?bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak Laporan</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_pdf.php?menu=pembelian&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
					&nbsp;&nbsp;
					<a href="#" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a>
					&nbsp;&nbsp;
				</div> -->
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="col-md-8" style="margin-left:-30px;margin-bottom:10px;">
						<div class="col-md-8">
							<div class="input-group">
								<div class="input-group-addon" id="pri">Bulan</div>
								<select name="txt_bulan" class="form-control" onchange="submit()">
									<?php 
									for ($a=1; $a < 13; $a++) {
									?>
									<option value="<?php echo $a; ?>" <?php if($a==$bulanini){echo "selected";} ?>><?php echo $a; ?></option>
									<?php } ?>
								</select>
								<div class="input-group-addon" id="pri">Tahun</div>
								<select name="txt_tahun" class="form-control" onchange="submit()">
									<?php 
									for ($a=2016; $a < 2031; $a++) {
									?>
									<option value="<?php echo $a; ?>" <?php if($a==$tahunini){echo "selected";} ?>><?php echo $a; ?></option>
									<?php } ?>
								</select>
								<div class="input-group-btn">
									<a href="" class="btn btn-success">
										<div class="glyphicon glyphicon-refresh"></div> Refresh
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 pull-right" style="margin-right:-40px;">
						<div class="input-group">
							<div class="input-group-btn">
								<a href="../laporan/cetak_pembelian.php?bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak</a>
								<a href="../laporan/cetak_pdf.php?menu=pembelian&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
								<!-- <a href="../laporan/cetak_excel.php?menu=pembelian&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a> -->
							</div>
						</div>
					</div>
					<!-- <div class="col-md-12" style="margin-left:-10px;margin-top:10px;">
						<label>Tampilkan Data Sebanyak :</label>
						<select>
							<option>10</option>
							<option>25</option>
							<option>50</option>
							<option>100</option>
						</select>
						<label>Baris</label>
					</div> -->
					<table class="table table-bordered table-hover table-striped">
						<thead id="pri">
							<th width="5%"><center>No.</center></th>
							<th width="12%"><center>No.Pembelian</center></th>
							<th width="9%"><center>Tanggal</center></th>
							<th width="12%"><center>Kode Barang</center></th>
							<th width="17%"><center>Nama Barang</center></th>
							<th width="8%"><center>Satuan</center></th>
							<th><center>Supplier</center></th>
							<th width="8%"><center>Harga</center></th>
							<th width="8%"><center>Jumlah</center></th>
							<th width="10%"><center>Total Harga</center></th>
						</thead>
						<tbody>
							<?php  
								$sql = $aksi->tampil($table,$cari,"ORDER BY kd_barang_masuk DESC");
								@$no = 0;
								if ($sql =="") {
									echo "<tr><td align='center' colspan='10'>Data Tidak Ada</td></tr>";
								}else{
									foreach ($sql as $data) {
										$no++;
							?>
								<tr>
									<td><center><?php echo $no; ?>.</center></td>
									<td><center><?php echo $data[0]; ?></center></td>
									<td><?php echo $data[8]; ?></td>
									<td><center><?php echo $data[2]; ?></center></td>
									<td><?php echo $data[3]; ?></td>
									<td><?php echo $data[4]; ?></td>
									<td><?php echo $data[9]; ?></td>
									<td align="right"><?php echo number_format($data[5],0,'','.'); ?></td>
									<td align="right"><?php echo number_format($data[6],0,'','.'); ?></td>
									<td align="right"><?php echo number_format($data[7],0,'','.'); ?></td>
								</tr>
							<?php } } 
								@$ttl = mysql_query("SELECT SUM(total_harga) AS total_seluruh FROM qw_barang_masuk WHERE MONTH(tanggal)='$bulanini' AND YEAR(tanggal)='$tahunini'");
								@$tl = mysql_fetch_array($ttl);
								@$totbeli = $tl['total_seluruh'];
							?>
							<tr>
								<td colspan="9" align="right"><b>Total Pembelian Barang :</b></td>
								<td align="right" ><b>Rp. <?php echo number_format(@$totbeli,0,'','.'); ?></b></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="panel-footer">&nbsp;</div>
		</div>
	</div>
</div>
</body>
</html>