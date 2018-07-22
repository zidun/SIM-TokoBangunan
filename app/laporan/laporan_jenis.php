<?php 
	date_default_timezone_set("Asia/Jakarta"); 
	@$table = "tbl_jenis";
	@$alamat = "?menu=lapjenisbarang";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Laporan Jenis Barang</title>
</head>
<body>
<br><br><br><br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height:40px;">
				<h3 class="panel-title pull-left">Daftar Jenis Barang</h3>
				<!-- <div class="pull-right">
					<a href="../laporan/cetak_jenisbarang.php" target="_blank" style="color:white;"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak Laporan</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_pdf.php?menu=jenisbarang" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_excel.php?menu=jenisbarang" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a>
					&nbsp;&nbsp;
				</div> -->
			</div>
			<div class="panel-body">
				<!-- <div class="col-md-12" style="margin-left:-10px;margin-top:10px;">
					<label>Tampilkan Data Sebanyak :</label>
					<select>
						<option>10</option>
						<option>25</option>
						<option>50</option>
						<option>100</option>
					<label>Baris</label>
					</select>
				</div> -->
				<!-- <div class="col-md-12">
					<div class="col-md-4"></div>
					<div class="col-md-8">
						<div class="form-group">
							 
						</div>
					</div>
				</div> -->
				<div class="col-md-12" style="margin-bottom:10px;">
					<div class="col-md-4" style="margin-left:-27px;">
						<div class="input-group">
							<div class="input-group-btn">
								<a href="../laporan/cetak_jenisbarang.php" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak</a>
								<a href="../laporan/cetak_pdf.php?menu=jenisbarang" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
								<!-- <a href="../laporan/cetak_excel.php?menu=jenisbarang" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a> -->
							</div>
						</div>
					</div>			
				</div>
		
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr id="pri">
							<th width="8%"><center>No.</center></th>
							<th width="10%"><center>ID Jenis</center></th>
							<th>Jenis Barang</th>
							<th width="20%"><center>Banyak Barang<center></th>
							<th width="10%"><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = $aksi->tampil($table,"","ORDER BY jenis ASC");
							@$no = 0;
							if ($sql =="") {
								echo "<tr><td align='center' colspan='5'>Data Tidak Ada</td></tr>";
							}else{
								foreach ($sql as $data) {
									$no++;
									@$kd = $data['id_jenis'];
								@$jml = mysql_num_rows(mysql_query("SELECT * FROM tbl_barang WHERE id_jenis = '$kd'"));  

						?>
							<tr>
								<td align="center"><?php echo $no; ?>.</td>
								<td align="center"><?php echo $data['id_jenis']; ?></td>
								<td><?php echo $data['jenis']; ?></td>
								<td align="center"><?php echo $jml; ?>  &nbsp;Barang</td>
								<!-- 
									<?php  
										if ($jml > 0) {
											echo "<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#$kd' >Detail</button>";
										}
									?>
								<td align="center"><a href="?menu=lapjenisbarang&id=<?php echo $kd; ?>"><?php if($jml > 0){echo "Detail";} ?></a></td> -->
							
								<td align="center">
									
<a href="#" data-toggle="modal" data-target="#<?php echo $kd ?>"><?php if($jml > 0){echo "Detail";} ?></a>
<div class="modal fade" id="<?php echo $data['id_jenis']; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Jenis Barang : <?php echo $data['jenis']; ?></h4>
			</div>
			<table class="table">
				<thead id="pri">
	       			<th>No.</th>
	       			<th>Kode Barang</th>
	       			<th>Nama Barang</th>
	       			<th>Satuan</th>
	       			<th>stok</th>
	       			<th>Harga pokok</th>
	       			<th>PPN (%)</th>
	       			<th>Harga Jual</th>
	       			<th>Jenis</th>
	       		</thead>
				<tbody>
                    <?php
                    @$nmr=0;
                    @$a=$aksi->tampil("qw_barang"," WHERE id_jenis = '$kd'","");
                    if (!$a=="") {
                        foreach ($a as $b) {
                        	@$nmr++;
                    ?>
                    <tr>
                    	<td><?php echo $nmr; ?></td>
                        <td><?php echo @$b['kd_barang']; ?></td>
                        <td><?php echo @$b['nama_barang']; ?></td>
                        <td><?php echo @$b['satuan']; ?></td>
                        <td><?php echo @$b['stok']; ?></td>
                        <td><?php echo @$b['harga_pokok']; ?></td>
                        <td><?php echo @$b['ppn']; ?></td>
                        <td><?php echo @$b['harga_jual']; ?></td>
                        <td><?php echo @$b['jenis']; ?></td>
                    </tr>
                    <?php }} ?>
			</table>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
								</td>
							</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">&nbsp;</div>
		</div>
	</div>
</div>
</body>
</html>