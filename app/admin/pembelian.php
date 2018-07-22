<?php 	 
	if(!isset($_GET['menu'])){
		header("location:index.php?menu=pembelianbarang");
	}

	@$sql = mysql_query("SELECT * FROM tbl_barang WHERE kd_barang='$_GET[kd]'");
	@$r = mysql_fetch_array($sql);

	@$tgl = date("dm");
	@$que = mysql_query("SELECT * FROM tbl_barang_masuk WHERE kd_barang_masuk LIKE '$tgl%' ORDER BY kd_barang_masuk DESC");
	@$kd = mysql_fetch_array($que);

	if (@$kd == "") {
		@$no_urut = "001";
	}else{
		@$no_urut = substr($kd['kd_barang_masuk'], 8,3)+1;
		if (@$no_urut < 10) {
			@$no_urut = "00$no_urut";
		}elseif (@$no_urut < 100) {
			@$no_urut = "0$no_urut";
		}
	}
	@$kd_masuk = "$tgl"."BELI"."$no_urut";
	@$supplier = $_POST['csupplier'];
	@$kode = $_POST['tkode'];
	@$nama = $_POST['tnama'];
	@$satuan = $_POST['tsatuan'];
	@$harga = $_POST['tharga'];
	@$total = $_POST['ttotal'];
	@$jumlah = $_POST['tjumlah'];
	@$tanggal = date("Y-m-d");
	@$table = "tbl_barang_masuk";
	@$alamat = "?menu=pembelianbarang";
	@$where = "kd_barang_masuk = '$_GET[id]'";
	@$field = array(
			'kd_barang_masuk'=>$kd_masuk,
			'kd_supplier' => $supplier,
			'kd_barang' => $kode,
			'nama_barang' => $nama,
			'satuan' => $satuan,
			'harga' => $harga,
			'jumlah' => $jumlah,
			'total_harga' => $total,
			'tanggal' => $tanggal
		);
	@$field2 = array(
			'kd_supplier' => $supplier,
			'jumlah' => $jumlah,
			'total_harga' => $total,
		);
	@$field_uang = array(
			'id_asal'=>$kd_masuk,
			'tanggal'=>$tanggal,
			'jenis_keuangan '=>"Pembelian ".$nama,
			'keluar'=>$total
		);
	

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

	// if (isset($_POST['bcari'])) {
	// 	@$text = $_POST['tcari'];
	// 	@$cari = $cari." AND nama_barang LIKE '%$text%'";
	// }	else{
	// 	@$cari = "";
	// }


	if (isset($_POST['bsimpan'])) {
		if ($kode=="" || $supplier=="" || $jumlah=="") {
			$aksi->pesan("Lengkapi Data Terlebih Dulu !!!");
		}else{
			$aksi->simpan($table,$field,$alamat);
			$aksi->simpanlsg("tbl_keuangan",$field_uang,"#");
		}
	}
	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where,$alamat);
	}
	if (isset($_GET['edit'])) {
		@$edit = $aksi->edit($table,$where);
	}
	if (isset($_POST['bubah'])) {
		$aksi->ubah($table,$field2,$where,$alamat);
	}


	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<title>Form Pembelian Barang</title>
</head>
<body>
<br><br><br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3 class="panel-title">Pembelian Barang - Bulan <?php echo @$bulaninitext." ".@$tahunini  ; ?> </h3></div>	
				<div class="panel-body">
					<form method="post">
						<table class=" table table-bordered">
							<thead id="pri">
								<th width="8%">Tanggal</th>
								<th width="14%">Kode Barang</th>
								<th width="10%">Nama Barang</th>
								<th width="12%">Supplier</th>
								<th width="8%">Satuan</th>
								<th width="8%">Harga</th>
								<th width="7%">Jumlah</th>
								<th width="11%">Total Harga</th>
								<th width="1%">Aksi</th>
							</thead>
							<tbody>
								<tr>
									<td>
										<input type="date" name="ttanggal" value="<?php if (isset($_GET['edit'])) { echo @$edit['tanggal']; }else{ echo @$tanggal; } ?>" class="form-control" plaaceholder="Tanggal" readonly required style="width:175px;" autocomplete="off" tabindex="1">
									</td>
									
									<td>
										<div class="input-group">
											<span class="input-group-btn">
												<button type="button" class="btn btn-primary <?php if(isset($_GET['edit'])){echo 'disabled';} ?>" data-toggle="modal" tabindex="0" <?php if(!isset($_GET['edit'])){echo "data-target='#myModal' ";}if(!isset($_GET['kd'])){echo "autofocus";} ?>  style="padding:10px 5px;" >tampil</button>
											</span>
											<input type="text" name="tkode" value="<?php if(@$_GET['id']==""){echo @$r[0];}else{echo @$edit['kd_barang'];} ?>" class="form-control" placeholder="Kode  Barang" readonly autocomplete="off" tabindex="1">
										</div>
										<!-- Modalll -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title" id="myModalLabel">Daftar Nama Barang</h4>
										      </div>
										      <div class="modal-body">
										     	<div class="table table-responsive">
										     		<table class="table table-striped table-hover">
											       		<thead id="pri">
											       			<th>No</th>
											       			<th>Kode Barang</th>
											       			<th>Nama Barang</th>
											       			<th>Satuan</th>
											       			<th>Harga Barang</th>
											       			<th>Stok</th>
											       		</thead>

										       			<?php
										       				@$a = $aksi->tampil("qw_barang","","ORDER BY stok ASC");
										       				@$no = 0;
															if ($a=="") {
																echo "<tr><td colspan='5' align='center'><b>Data Tidak Ada</b></td></tr>";
															}else{
																foreach ($a as $i) {
																	$no++;
																	?>
																	<tbody onclick="window.location.href='?menu=pembelianbarang&kd=<?php echo $i[0]; ?>'">
																		<td><?php echo $no ?></td>
																		<td><?php echo $i[0]; ?></td>
																		<td><?php echo $i[1]; ?></td>
																		<td><?php echo $i[3]; ?></td>
																		<td><?php echo $i[5]; ?></td>
																		<td <?php if($i[4] < 10){echo "class='danger'";}else{echo "class='success'";} ?>><?php echo $i[4]; ?></td>
																	</tbody>
													<?php	} } ?>
											       	</table>
										     	</div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
										      </div>
										    </div>
										  </div>
										</div>
									</td>
									
									<td>
										<input type="text" name="tnama" value="<?php if(@$_GET['id']==""){echo @$r['nama_barang'];}else{echo @$edit['nama_barang'];} ?>" required placeholder="Nama" class="form-control" readonly autocomplete="off" tabindex="1">
									</td>

									<td>
										<select name="csupplier" class="form-control" required tabindex="0" autocomplete="off" autofocus>
											<option value="<?php echo @$edit['kd_supplier']; ?>"><?php echo @$edit['nama_supplier']; ?></option>
											<?php 
												@$qw = mysql_query("SELECT * FROM tbl_supplier");
												while (@$a = mysql_fetch_array($qw)) {
											 ?>
											 	<option class="form-control" value="<?php echo @$a[0]; ?>" <?php if(@$edit['1']==@$a['0']){echo "selected";} ?> ><?php echo @$a[1]; ?></option>
											<?php } ?>
										</select>
									</td>

									<td>
										<input type="text" name="tsatuan" value="<?php if(@$_GET['id']==""){echo @$r['satuan'];}else{echo @$edit['satuan'];} ?>" required placeholder="Satuan" class="form-control" readonly autocomplete="off" tabindex="1">
									</td>

									<td>
										<input type="text" name="tharga" id="tharga" value="<?php if(@$_GET['id']==""){echo @$r['harga_pokok'];}else{echo @$edit['harga'];} ?>" required placeholder="Harga" class="form-control" readonly autocomplete="off" tabindex="1">
									</td>

									<td>
										<input type="text" name="tjumlah" id="tjumlah" value="<?php echo @$edit['jumlah']; ?>" placeholder="Jumlah" class="form-control" required maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" tabindex="0">
									</td>

									<td>
										<input type="text" name="ttotal" id="ttotal" value="<?php echo @$edit['total_harga']; ?>" required placeholder="Total Harga" class="form-control" maxlength="11" readonly autocomplete="off" tabindex="1">
									</td>

									<td>
										<?php  if(@$_GET['id']==""){ ?>
											<button type="submit" name="bsimpan" class="btn btn-primary" tabindex="0">Simpan</button>
										<?php }else{ ?>
											<button type="submit" name="bubah" class="btn btn-success" tabindex="0">Ubah</button>
										<?php } ?>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="col-md-12" style="margin-left:-30px;margin-bottom:10px;">
							<div class="col-md-6">
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
									<th width="10%">Tanggal</th>
									<th width="10%">Kode Barang</th>
									<th width="17%">Nama Barang</th>
									<th width="8%">Satuan</th>
									<th>Supplier</th>
									<th width="10%">Harga</th>
									<th width="10%">Jumlah Barang</th>
									<th>Total Harga</th>
									<th width="5%"><center>Hapus</center></th>
									<th width="5%"><center>Edit</center></th>
								</thead>
								<tbody>	
									<tr>
										<?php 
											$a = $aksi->tampil("qw_barang_masuk",$cari," ORDER BY `tanggal` DESC");
											@$no =0;
											if ($a=="") {
												echo "<tr><td colspan='10' align='center'><b>Data Tidak Ada</b></td></tr>";
											}else{
												foreach ($a as $data) {
													$no++;
													
											?>
											<td><center><b><?php echo $no; ?>.</b></center></td>
											<td><?php echo $data[8]; ?></td>
											<td><?php echo $data[2]; ?></td>
											<td><?php echo $data[3]; ?></td>
											<td><?php echo $data[4]; ?></td>
											<td><?php echo $data[9]; ?></td>
											<td align="right"><?php echo number_format($data[5],0,'','.'); ?></td>
											<td align="right"><?php echo number_format($data[6],0,'','.'); ?></td>
											<td align="right"><?php echo number_format($data[7],0,'','.'); ?></td>
		 									<td><a href="?menu=pembelianbarang&hapus&id=<?php echo $data[0];?>" onClick="return confirm('Anda Yakin Akan Menghapus Pembelian Barang <?php echo $data[5] ?> ini ?')"><center><span class="glyphicon glyphicon-trash" id="red"></span></center></a></td>
											<td><a href="?menu=pembelianbarang&edit&id=<?php echo $data[0]; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
										</tr>
										<?php 	}} ?>	
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