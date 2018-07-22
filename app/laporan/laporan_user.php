<?php
	date_default_timezone_set("Asia/Jakarta");
  
	@$table = "qw_user";
	@$alamat = "?menu=lapuser";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Laporan User</title>
</head>
<body>
<br><br><br><br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height:40px;">
				<h3 class="panel-title pull-left">Daftar User</h3>
				<!-- <div class="pull-right">
					<a href="../laporan/cetak_user.php" target="_blank" style="color:white;"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak Laporan</a>
					&nbsp;&nbsp;
					<a href="../laporan/cetak_pdf.php?menu=user" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
					&nbsp;&nbsp;
					<a href="#" target="_blank" style="color:white;"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a>
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
				<div class="col-md-12" style="margin-bottom:10px;">
					<div class="col-md-4" style="margin-left:-27px;">
						<div class="input-group">
							<div class="input-group-btn">
								<a href="../laporan/cetak_user.php" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-print"></div>&nbsp;Cetak</a>
								<a href="../laporan/cetak_pdf.php?menu=user" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan PDF</a>
								<!-- <a href="../laporan/cetak_excel.php?menu=user" target="_blank" class="btn btn-success"><div class="glyphicon glyphicon-floppy-save"></div>&nbsp;Simpan Excel</a> -->
							</div>
						</div>
					</div>			
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr id="pri">
							<th>No.</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>No.HP</th>
							<th>Jabatan</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$sql = $aksi->tampil($table,"","ORDER BY nama_user ASC");
							@$no = 0;
							if ($sql =="") {
								echo "<tr><td align='center' colspan='5'>Data Tidak Ada</td></tr>";
							}else{
								foreach ($sql as $data) {
									$no++;
						?>
							<tr>
								<td align="center"><?php echo $no; ?>.</td>
								<td><?php echo $data['nama_user']; ?></td>
								<td><?php echo $data['alamat_user']; ?></td>
								<td><?php echo $data['no_telp_user']; ?></td>
								<td><?php echo $data['jabatan']; ?></td>
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