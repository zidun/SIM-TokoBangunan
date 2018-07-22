<?php  
if (!isset($_GET['menu'])) {
	header("location:index.php?menu=daftarsupplier");
}

	@$i = mysql_query("SELECT * FROM tbl_supplier ORDER BY kd_supplier DESC");
	@$j=mysql_fetch_array($i);

	if (@$j == "") {
	    @$kd= "SPL001";
	}else{
	   	@$kode = substr($j['kd_supplier'], 3,3)+1;
	   	if ($kode < 10) {
	   		@$kd = "SPL00".$kode;
	   	}elseif($kode<100){
	   		@$kd ="SPL0".$kode;
	   	}
	}
	@$kd_supplier = $_POST['tkode'];
	@$nama_supplier = $_POST['tnama'];
	@$alamat_supplier = $_POST['talamat'];
	@$no_telp_supplier = $_POST['tnohp'];

	@$table = "tbl_supplier";
	@$alamat = "?menu=daftarsupplier";
	@$where = "kd_supplier = '$_GET[id]'";
	@$field = array(
		'kd_supplier' => $kd_supplier,
		'nama_supplier' => $nama_supplier,
		'alamat_supplier' => $alamat_supplier,
		'no_telp_supplier' => $no_telp_supplier
		);
	@$field2 = array(
		'nama_supplier' => $nama_supplier,
		'alamat_supplier' => $alamat_supplier,
		'no_telp_supplier' => $no_telp_supplier
		);

	if (isset($_POST['bsimpan'])) {
		$aksi->simpan($table, $field, $alamat);
	}
	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}
	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where,$alamat);			
	}
	if (isset($_POST['bubah'])) {
		$aksi->ubah($table, $field2, $where, $alamat);
	}
	if (isset($_POST['bcari'])) {
		@$text = $_POST['tcari'];
		@$cari = "WHERE nama_supplier LIKE '%$text%'";
	}else{
		@$cari="";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier Barang </title>
</head>
<body>
<br><br><br><br>
<div class="container-fluid" id="mrg">
	<div class="row">
	<div class="col-md-3">
		<div class="panel panel-primary">
			<?php if(!isset($_GET['edit'])){ ?>
					<div class="panel-heading">Tambah Supplier
				<?php }else{ ?>
					<div class="panel-heading">Ubah Supplier
				<?php } ?>
				</div>
			<div class="panel-body">
				<form method="post">

					<div class="form-group">
					<!-- <label>Kode Supplier</label> -->
						<div class="input-group" style="margin:0 2px;">
							<span class="input-group-addon"><div class="glyphicon glyphicon-qrcode"></div></span>
							 <input type="text" name="tkode" value="<?php if(@$_GET['id']==""){echo @$kd;}else{echo @$edit['kd_supplier'];} ?>" class="form-control" placeholder="Kode Supplier" readonly>
						</div> 
					</div>

					<div class="form-group">
					<!-- <label>Nama Supplier</label> -->
						<div class="input-group" style="margin:0 2px;">
							<span class="input-group-addon"><div class="glyphicon glyphicon-user"></div></span>
							<input type="text" name="tnama" value="<?php echo @$edit['nama_supplier'] ?>" class="form-control" placeholder="Nama" required  autofocus tabindex="0" autocomplete="off" maxlength="50">
						</div>
					</div>

					<div class="form-group">
					<!-- <label>Alamat Supplier</label> -->
						<div class="input-group" style="margin:0 2px;">
							<span class="input-group-addon"><div class="glyphicon glyphicon-home"></div></span>
							<textarea name="talamat" placeholder="Alamat" class="form-control" required tabindex="0" autocomplete="off"><?php echo @$edit['alamat_supplier']?></textarea>
						</div>
					</div>

					<div class="form-group">
					<!-- <label>No Telepon Supplier</label> -->
						<div class="input-group" style="margin:0 2px;">
							<span class="input-group-addon"><div class="glyphicon glyphicon-phone-alt"></div></span>
							<input type="text" name="tnohp" value="<?php echo @$edit['no_telp_supplier']; ?>" class="form-control" placeholder="No Telepon" required  maxlength="13" tabindex="0" autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
						</div>
					</div>

					<div class="form-group">
						<?php  
						if (@$_GET['id']=="") { ?>
							<button type="submit" name="bsimpan" class="btn btn-primary btn-block">SIMPAN
						<?php }else{ ?>
							<button type="submit" name="bubah" class="btn btn-success btn-block">UBAH
						<?php }?>
							</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-primary">	
			<div class="panel-heading">Daftar Supplier</div>
			<div class="panel-body">
				<form method="post">
					<div class="col-md-12"style="margin-bottom:10px;">
						<div class="input-group">
							<input type="text" name="tcari" value="<?php echo @$text; ?>" class="form-control" maxlength="50"  placeholder="Cari Nama Supplier">
							<span class="input-group-btn">
								<button type="submit"  name="bcari" class="btn btn-primary"><div class="glyphicon glyphicon-search"></div></button>
								<button type="submit" name="refresh" class="btn btn-success"><div class="glyphicon glyphicon-refresh">Refresh</div></button>
							</span>
						</div>
					</div>
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
					<div class="table table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<tr id="pri">
								<th width="5%">No.</th>
								<th width="10%">Kode</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th width="20%">No Telepon</th>
								<th width="8%"><center>Hapus</center></th>
								<th width="8%"><center>Ubah</center></th>
							</tr>
							<tbody>	
								<tr>
									<?php  
										$a = $aksi->tampil($table,$cari," ORDER BY kd_supplier DESC");
										@$no = 0;
										if ($a=="") {
											echo "<tr><td colspan='7' align='center'>Data Tidak Ada</td></tr>";
										}else{
											foreach ($a as $data) {
												$kdsup = $data[0];
												$nm = $data[1];
												$almt = $data[2];
												$nohp = $data[3];
												$no++;
												@$del = mysql_num_rows(mysql_query("SELECT * FROM tbl_barang_masuk WHERE kd_supplier = '$kdsup'"));

												?>
										
												<td><center><b><?php echo $no; ?>.</b></center></td>
												<td><?php echo $kdsup; ?></td>
												<td><?php echo $nm; ?></td>
												<td><?php echo $almt; ?></td>
												<td><?php echo $nohp; ?></td>
												<td><a href="?menu=daftarsupplier&hapus&id=<?php echo $kdsup; ?>" onClick="return confirm('Anda Yakin Akan Menghapus Supplier <?php echo $nm ?> ini ?')"><?php if($del > 0){echo "";}else{echo "<center><span class='glyphicon glyphicon-trash' id='red'></span></center>";} ?></a></td>
												<td><a href="?menu=daftarsupplier&edit&id=<?php echo $kdsup; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
											</tr>
								<?php	} } ?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
			<div class="panel-footer">&nbsp;</div>
		</div>	
	</div>
	</div>
</div>
</body>
</html>