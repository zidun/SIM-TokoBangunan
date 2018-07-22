<?php 
	if (!isset($_GET['menu'])) {
	    header("location:index.php?menu=keuangan");
	}

	@$tanggal = date("Y-m-d");
	@$jenis_keuangan = $_POST['tjenis'];
	@$masuk = $_POST['tmasuk'];
	@$keluar = $_POST['tkeluar'];

	@$table ="tbl_keuangan";
	@$alamat = "?menu=keuangan";
	@$id_keuangan ="$_GET[id]";
	@$where = "id_keuangan ='$id_keuangan'";
	@$field = array(
		'tanggal'=>$tanggal,
		'jenis_keuangan'=>$jenis_keuangan,
		'masuk'=>$masuk,
		'keluar'=>$keluar
	);

	if (isset($_POST['tbulan']) || isset($_POST['ttahun'])) {
		@$bulanini=$_POST['tbulan'];
		@$tahunini=$_POST['ttahun'];
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
	@$cari = $cari." AND id_asal=''";

	if (isset($_POST['bsimpan'])) {
		if (@$_POST['tjenis']=="Saldo Awal") {
			@$i = mysql_query("SELECT * FROM tbl_keuangan WHERE jenis_keuangan ='Saldo Awal' AND MONTH(tanggal)='$bulanini'");
			@$cek = mysql_num_rows($i);
			if ($cek > 0) {
				$aksi->pesan("Anda Sudah masukan Saldo Bulan ini !!!");
				$aksi->alamat($alamat);
			}else{
				$aksi->simpan($table,$field,$alamat);
			}
		}else{
			$aksi->simpan($table,$field,$alamat);
		}
	}
	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where,$alamat);
	}
	if (isset($_GET['edit'])) {
		@$edit = $aksi->edit($table,$where);
	}
	if (isset($_POST['bubah'])) {
		$aksi->ubah($table,$field,$where,$alamat);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Form Keuangan Tambahan</title>
</head>
<body>
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">Pengeluaran dan Pemasukan Tambahan - Bulan <?php echo @$bulaninitext." ".@$tahunini ?></div>
				<div class="panel-body">
				<form method="post">
					<table class="table table-bordered">
						<thead id="pri">
							<th><center>Tanggal</center></th>
							<th><center>Jenis Keuangan</center></th>
							<th><center>Masuk</center></th>
							<th><center>Keluar</center></th>
							<th><center>Aksi</center></th>
						</thead>
						<tbody>
							<tr>
								<td>
									<input type="date" name="ttanggal" value="<?php if (isset($_GET['edit'])) { echo @$edit['tanggal']; }else{ echo @$tanggal; } ?>" class="form-control" plaaceholder="Tanggal" readonly required autocomplete="off" tabindex="1">
								</td>
								<td>
									<input type="text" name="tjenis" class="form-control" value="<?php echo @$edit['jenis_keuangan']; ?>" placeholder="Jenis Keuangan" list="list" required autocomplete="off" maxlength="25" autofocus>
									<datalist id="list">
										<option>Saldo Awal</option>
										<option>Gaji Pegawai</option>
									</datalist>
								</td>
								<td><input type="text" name="tmasuk" value="<?php echo @$edit['masuk']; ?>" class="form-control" placeholder="Masuk" autocomplete="off" tabindex="0" maxlength="11" required onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
								<td><input type="text" name="tkeluar" value="<?php echo @$edit['keluar']; ?>" class="form-control" placeholder="Keluar" autocomplete="off" tabindex="0" maxlength="11" required onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
								<td>
									<?php  
										if (@$_GET['id']=="") { ?>
											<button name="bsimpan" type="submit" class="btn btn-primary btn-block">SIMPAN</button></td>
										<?php }else{ ?>		
											<button name="bubah" type="submit" class="btn btn-success btn-block">UBAH</button></td>						
										<?php } ?>
							</tr>
						</tbody>
					</table>
					<div class="col-md-12" style="margin-left:-30px;margin-bottom:10px;">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-addon" id="pri">Bulan</div>
								<select name="tbulan" class="form-control" onchange="submit()">
									<?php 
									for ($a=1; $a < 13; $a++) {
									?>
									<option value="<?php echo $a; ?>" <?php if($a==$bulanini){echo "selected";} ?>><?php echo $a; ?></option>
									<?php } ?>
								</select>
								<div class="input-group-addon" id="pri">Tahun</div>
								<select name="ttahun" class="form-control" onchange="submit()">
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
				</form>		
				<form method="post">
					<div class="table table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead id="pri">
								<th width="5%">No.</th>
								<th width="15%"><center>Tanggal</center></th>
								<th>Jenis Keuangan</th>
								<th width="15%"><center>Masuk</center></th>
								<th width="15%"><center>Keluar</center></th>
								<th width="7%"><center>Hapus</center></th>
								<th width="7%"><center>Edit</center></th>
							</thead>
							<tbody>
								<tr>
								<?php  
									@$sql = $aksi->tampil("tbl_keuangan",$cari,"ORDER BY waktu DESC");
									@$no = 0;

									if ($sql == "") {
										echo "<tr><td colspan='7' align='center'>Data Tidak Ada !!!</td></tr>";
									}else{
										foreach ($sql as $data) {
											@$no++;
									?>
										<td align="center"><b><?php echo $no; ?></b></td>
										<td align="center"><?php echo $data['tanggal']; ?></td>
										<td><?php echo $data['jenis_keuangan']; ?></td>
										<td align="right"><?php echo number_format($data['masuk'],0,'','.') ?></td>
										<td align="right"><?php echo number_format($data['keluar'],0,'','.') ?></td>
										<td><a href="?menu=keuangan&hapus&id=<?php echo $data[0]; ?>" onClick="return confirm('Yakin Akan Menghapus da');"><center><span class="glyphicon glyphicon-trash" id="red"></span></center></a></td>
										<td><a href="?menu=keuangan&edit&id=<?php echo $data[0]; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
								</tr>
								<?php	} }	?>								
							</tbody>
						</table>
					</div>
				</form>			
				</div>
				<div class="panel-footer">&nbsp;</div>
			</div>
		</div>
	</div>
</body>
</html>