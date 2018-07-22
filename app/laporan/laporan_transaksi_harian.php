<?php
	date_default_timezone_set("Asia/Jakarta");
 
	@$table = "qw_transaksi";
	@$alamat = "?menu=laptransaksiharian";
	@$tgl = date("Y-m-d");
	@$tanggal = date("d-m-Y");
	@$cari = "WHERE tgl_transaksi = '$tgl'";
	@$tgl_awal = $_POST['tgl_awal'];
	@$tgl_akhir = $_POST['tgl_akhir'];

	if (isset($_POST['blihat'])) {
		if (empty($tgl_awal)||empty($tgl_akhir)) {
			echo "<script>alert('Pilih Dulu Tanggal Awal dan Taggal Akhir');</script>";
		}else{
			@$cari = " WHERE tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
		}
	}else{
		@$cari = "WHERE tgl_transaksi = '$tgl'";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Laporan Transaksi Harian</title>
</head>
<body>
<br><br><br><br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height:40px;">
				<?php  
					if (isset($_POST['blihat'])) { ?>						
						<h3 class="panel-title pull-left">Daftar Transaksi Harian - Tanggal &nbsp;<?php echo @$tgl_awal." &nbsp;Sampai&nbsp;&nbsp;".@$tgl_akhir ; ?></h3>
				<?php }else{ ?>
						<h3 class="panel-title pull-left">Daftar Transaksi Harian - Tanggal &nbsp;<?php echo @$tanggal?></h3>
				<?php } ?>
				<!-- <div class="pull-right">
					<a href="../laporan/cetak_transaksi_harian.php?tgl=<?php echo $tgl ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak Laporan</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_pdf.php?menu=transaksi_harian&tgl=<?php echo $tgl ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_excel.php?menu=transaksi_harian&tgl=<?php echo $tgl ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a>
					&nbsp;&nbsp;
				</div> -->
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="col-md-8" style="margin-left:-30px;margin-bottom:10px;">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-addon" id="pri">Dari</div>
								<input type="date" name="tgl_awal" value="<?php if(isset($_POST['blihat'])){echo $tgl_awal;}else{ echo $tgl;} ?>" class="form-control" autofocus=>
								<div class="input-group-addon" id="pri">Sampai</div>
								<input type="date" name="tgl_akhir" value="<?php if(isset($_POST['blihat'])){echo $tgl_akhir;}else{ echo $tgl;} ?>" class="form-control">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-primary" name="blihat"><div class="glyphicon glyphicon-eye-open"></div>&nbsp;Tampil</button>
									<a href="" class="btn btn-success">
										<div class="glyphicon glyphicon-refresh"></div> Refresh
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 pull-right">
						<div class="input-group">
							<div class="input-group-btn">
								<a href="../laporan/cetak_transaksi_harian.php?tgl=<?php echo $tgl ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak</a>
								<a href="../laporan/cetak_pdf.php?menu=transaksi_harian&tgl=<?php echo $tgl ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
								<!-- <a href="../laporan/cetak_excel.php?menu=transaksi_harian&tgl=<?php echo $tgl ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a> -->
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
							<th width="15%"><center>Tanggal</center></th>
							<th width="15%"><center>No.Transaksi</center></th>
							<th width="15%"><center>Kasir</center></th>
							<th  width="15%"><center>Total</center></th>
							<th  width="8%"><center>Diskon</center></th>
							<th  width="18%"><center>Total Akhir</center></th>
							<th width="10%"><center>Detail</center></th>
							<th width="10%"><center>Struk</center></th>
						</thead>
						<tbody>
							<?php  
								$sql = $aksi->tampil($table,$cari,"ORDER BY waktu ASC");
								@$no = 0;
								if ($sql =="") {
									echo "<tr><td align='center' colspan='8'>Data Tidak Ada</td></tr>";
								}else{
									foreach ($sql as $data) {
										$no++;
										@$no_transaksi = $data[0];
							
										
							?>
								<tr>
									<td><center><?php echo $no; ?>.</center></td>
									<td><center><?php echo $data[1]; ?></center></td>
									<td><center><?php echo $data[0]; ?></center></td>
									<td><center><?php echo $data[9]; ?></center></td>
									<td align="right"><?php echo number_format($data[4],0,'','.'); ?></td>
									<td align="right"><?php echo number_format($data[5],0,'','.'); ?></td>
									<td align="right"><?php echo number_format($data[6],0,'','.'); ?></td>
									<td align="center">
<a href="#" data-toggle="modal" data-target="#<?php echo $no_transaksi ?>">Detail</a>
<div class="modal fade" id="<?php echo $no_transaksi; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">No. Transaksi : <?php echo $no_transaksi?> - Nama Kasir : <?php echo $data[9]; ?></h4>
			</div>
			<table class="table table-hover table-stripped"  style="overflow-y: scroll;">
				<thead id="pri">
					<th><center>No.</center></th>
	       			<th><center>Kode Barang</center></th>
					<th>Nama Barang</th>
					<th><center>Harga</center></th>
					<th><center>Jumlah</center></th>
					<th><center>Total Harga</center></th>
	       		</thead>
				<tbody>
                    <?php
                    @$nmr=0;
                    @$a=$aksi->tampil("tbl_transaksi_detail"," WHERE no_transaksi = '$no_transaksi'","");
                    if (!$a=="") {
                        foreach ($a as $b) {
                        	@$nmr++;
                    ?>
                    <tr> 
                    	<td><center><?php echo $nmr; ?></center></td>
                      	<td><center><?php echo $b[2]; ?></center></td>
						<td><?php echo $b[3]; ?></td>
						<td align="center"><?php echo number_format($b[4],0,'','.'); ?></td>
						<td align="center"><?php echo number_format($b[5],0,'','.'); ?></td>
						<td align="center"><?php echo number_format($b[6],0,'','.'); ?></td>
                    </tr>
                    <?php }} 
                    	@$ta = mysql_fetch_array(mysql_query("SELECT SUM(total) as 'total_akhir' FROM tbl_transaksi_detail WHERE no_transaksi = '$no_transaksi'"));
                    	@$totakhir = $ta['total_akhir'];
                    ?>
                 </tbody>
                 <tfoot style="border-top:1px solid #2c3e50;">
                 	<td colspan="5" align="right"><b>Total Akhir :</b></td>
                 	<td align="center"><b>Rp. <?php echo number_format($totakhir,0,'','.') ; ?></b></td>
                 </tfoot>
			</table>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
								</td>
								<td><center><a href="../transaksi/transaksi_print.php?no_transaksi=<?php echo $no_transaksi; ?>" target="_blank"><div class="glyphicon glyphicon-print" id="red"></div></a></center></td>
								</tr>
							<?php } }
							if (isset($_POST['blihat'])) {
							 	@$tl = mysql_fetch_array(mysql_query("SELECT SUM(total_akhir) as 'total_dapat' FROM tbl_transaksi WHERE tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
								@$pendapatan = $tl['total_dapat'];
							?>
								<tr>
									<td colspan="6" align="right"><b>Pendapatan dari Tangal <?php echo $tgl_awal."&nbsp; Sampai &nbsp;".$tgl_akhir; ?> : </b></td>
									<td align="right"><b>Rp. <?php echo number_format($pendapatan,0,'','.');?></b></td>
									<td colspan="2">&nbsp;</td>
								</tr>

							<?php }else{
							 	@$tl = mysql_fetch_array(mysql_query("SELECT SUM(total_akhir) as 'total_dapat' FROM tbl_transaksi WHERE tgl_transaksi = '$tgl'"));
								@$pendapatan = $tl['total_dapat']; 
							?>
								<tr>
									<td colspan="6" align="right"><b>Pendapatan Harian Tanggal <?php echo $tgl; ?> : </b></td>
									<td align="right"><b>Rp. <?php echo number_format($pendapatan,0,'','.');?></b></td>
									<td colspan="2">&nbsp;</td>
								</tr>

							<?php } ?>
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