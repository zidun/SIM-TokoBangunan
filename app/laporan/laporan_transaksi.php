<?php
	date_default_timezone_set("Asia/Jakarta");
 
	@$table = "tbl_keuangan";
	@$alamat = "?menu=laptransaksibulanan";

	if (isset($_POST['txt_bulan']) || isset($_POST['txt_tahun'])) {
		@$bulanini=$_POST['txt_bulan'];
		@$tahunini=$_POST['txt_tahun'];
	}else{
		@$bulanini=date("m");
		@$tahunini=date("Y");
	}
	@$cari="WHERE MONTH(tanggal)='$bulanini' AND YEAR(tanggal)='$tahunini' AND jenis_keuangan='Pendapatan Harian'";
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
	<title>Laporan Transaksi Bulan - <?php echo @$bulaninitext." ".@$tahunini; ?></title>
</head>
<body>
<br><br><br><br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height:40px;">
				<h3 class="panel-title pull-left">Daftar Transaksi Bulanan - Bulan <?php echo @$bulaninitext." ".@$tahunini ; ?></h3>
				<!-- <div class="pull-right">
					<a href="../laporan/cetak_transaksi.php?bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak Laporan</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_pdf.php?menu=transaksi&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
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
								<a href="../laporan/cetak_transaksi.php?bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak</a>
								<a href="../laporan/cetak_pdf.php?menu=transaksi&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
								<!-- <a href="../laporan/cetak_excel.php?menu=transaksi&bln=<?php echo $bulanini; ?>&thn=<?php echo $tahunini; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a> -->
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
							<th  width="18%"><center>Jumlah</center></th>
							<th width="10%"><center>Detail</center></th>
						</thead>
						<tbody>
							<?php  
								$sql = $aksi->tampil($table,$cari,"ORDER BY waktu DESC");
								@$no = 0;
								if ($sql =="") {
									echo "<tr><td align='center' colspan='5'>Data Tidak Ada</td></tr>";
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

									<td align="center">
<a href="#" data-toggle="modal" data-target="#<?php echo $tgl; ?>">Detail</a>
<div class="modal fade" id="<?php echo $tgl; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Daftar Transaksi Tanggal : <?php echo $tgl ?></h4>
			</div>
			<table class="table table-hover table-bordered table-striped">
				<thead id="pri">
					<th><center>No.</center></th>
	       			<th>No.Transaksi</th>
					<th>Tanggal</th>
					<th>Nama Kasir</th>
					<th>Subtotal</th>
					<th>Diskon</th>
					<th>Total Akhir</th>
					<th>Bayar</th>
					<th>Kembalian</th>
	       		</thead>
				<tbody>
                    <?php
                    @$nmr=0;
                    @$a=$aksi->tampil("qw_transaksi"," WHERE tgl_transaksi = '$tgl'","");
                    if (!$a=="") {
                        foreach ($a as $b) {
                        	@$nmr++;
                    ?>
                    <tr> 
                    	<td><?php echo $nmr; ?></td>
                      	<td><?php echo $b[0]; ?></td>
						<td><?php echo $b[1]; ?></td>
						<td><?php echo $b[9]; ?></td>
						<td align="center"><?php echo number_format($b[4],0,'','.'); ?></td>
						<td align="center"><?php echo number_format($b[5],0,'','.'); ?></td>
						<td align="center"><?php echo number_format($b[6],0,'','.'); ?></td>
						<td align="center"><?php echo number_format($b[7],0,'','.'); ?></td>
						<td align="center"><?php echo number_format($b[8],0,'','.'); ?></td>
                    </tr>
                    <?php }} 
                    	@$ttl = mysql_fetch_array(mysql_query("SELECT SUM(total_akhir) as 'total' FROM tbl_transaksi WHERE tgl_transaksi = '$data[2]'"));
                    	@$tot = $ttl['total'];
                    ?>
                    <tr>
                    	<td colspan="6" align="right"><b>Pendapatan Harian : </b></td>
                    	<td align="right"><b>Rp. <?php echo number_format($tot,0,'','.'); ?></b></td>
                    	<td colspan="2"></td>
                    </tr>
			</table>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
								</td>
								</tr>
							<?php } } 
								@$tl = mysql_fetch_array(mysql_query("SELECT SUM(masuk) as 'total_dapat' FROM tbl_keuangan WHERE MONTH(tanggal)='$bulanini' AND YEAR(tanggal)='$tahunini' AND jenis_keuangan='Pendapatan Harian'"));
								@$pendapatan = $tl['total_dapat'];
							?>
							<tr>
								<td colspan="3" align="right"><b>Total Pendapatan : </b></td>
								<td align="right"><b>Rp. <?php echo number_format($pendapatan,0,'','.');?></b></td>
								<td>&nbsp;</td>
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