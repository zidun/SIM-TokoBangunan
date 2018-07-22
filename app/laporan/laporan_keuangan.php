<?php 
	date_default_timezone_set("Asia/Jakarta");
	@$table = "tbl_keuangan";
	@$alamat = "?menu=lapkeuangan";

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
	<title>Laporan Keuangan Bulan - <?php echo @$bulaninitext." ".@$tahunini; ?></title>
</head>
<body>
<br><br><br><br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height:40px;">
				<h3 class="panel-title pull-left">Daftar Pemasukan dan Pengeluaran Keuangan - Bulan <?php echo @$bulaninitext." ".@$tahunini ; ?></h3>
				<!-- <div class="pull-right">
					<a href="../laporan/cetak_keuangan.php?bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak Laporan</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_pdf.php?menu=keuangan&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
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
					<div class="col-md-4 pull-right" style="margin-right:-5px;">
						<div class="input-group">
							<div class="input-group-btn">
								<a href="../laporan/cetak_keuangan.php?bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak</a>
								<a href="../laporan/cetak_pdf.php?menu=keuangan&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
								<!-- <a href="../laporan/cetak_excel.php?menu=keuangan&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a> -->
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
							<th width="8%"><center>No.</center></th>
							<th width="15%"><center>Tanggal</center></th>
							<th>Jenis Keuangan</th>
							<th  width="18%"><center>Masuk</center></th>
							<th  width="18%"><center>Keluar</center></th>
							<th width="18%"><center>Saldo</center></th>
						</thead>
						<tbody>
							<?php  
								$sql = $aksi->tampil($table,$cari,"ORDER BY waktu ASC");
								@$no = 0;
								if ($sql =="") {
									echo "<tr><td align='center' colspan='6'>Data Tidak Ada</td></tr>";
								}else{
									foreach ($sql as $data) {
										$no++;
										@$tgl = $data[2];
										
										
							?>
								<tr>
									<td><center><?php echo $no; ?>.</center></td>
									<td><center><?php echo $data[2]; ?></center></td>
									<td><?php echo $data[4]; ?></td>
									<td align="right"><?php echo number_format($data[5],0,'','.'); ?></td>
									<td align="right"><?php echo number_format($data[6],0,'','.'); ?></td>
									<td align="right">
									<?php 
										@$saldo = $saldo + $data['masuk'] - $data['keluar'];
										echo number_format($saldo,0,'','.'); 
										@$m = mysql_fetch_array(mysql_query("SELECT SUM(masuk) as 'msk' FROM tbl_keuangan WHERE 
											MONTH(tanggal)='$bulanini' AND YEAR(tanggal)='$tahunini'"));
										@$k = mysql_fetch_array(mysql_query("SELECT SUM(keluar) as 'klr' FROM tbl_keuangan WHERE 
											MONTH(tanggal)='$bulanini' AND YEAR(tanggal)='$tahunini'"));
									?>
									</td>

								</tr>
							<?php } } ?>
								<tfoot>
									<tr>
										<td colspan="5" align="right"><b>Total Pemasukan :</b></td>
										<td align="right"><b>Rp. <?php echo number_format(@$m['msk'],0,'','.'); ?></b></td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>Total Pengeluaran :</b></td>
										<td align="right"><b>Rp. <?php echo number_format(@$k['klr'],0,'','.'); ?></b></td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>Saldo Akhir : </b></td>
										<td align="right"><b>Rp. <?php echo number_format(@$saldo,0,'','.');?></b></td>
									</tr>
								</tfoot>
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