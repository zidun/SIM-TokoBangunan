<?php  
if (!isset($_GET['menu'])) {
	header("location:index.php?menu=daftarbarang");
}

	@$i = mysql_query("SELECT * FROM tbl_barang ORDER BY kd_barang DESC");
	@$j = mysql_fetch_array($i);

	if (@$j == "") {
		@$kd = "BRG000001";
	}else{
		@$kode = substr($j['kd_barang'], 3,6)+1;
		if ($kode < 10) { @$kd = "BRG00000".$kode;}
		elseif ($kode < 100 ) {@$kd = "BRG0000".$kode;}
		elseif ($kode < 1000 ) {@$kd = "BRG000".$kode;}
		elseif ($kode < 10000 ) {@$kd = "BRG00".$kode;}
		elseif ($kode < 100000 ) {@$kd = "BRG0".$kode;}
		else{@$kd = "BRG".$kode;}
	}

	@$kd_barang = $_POST['tkode'];
	@$nama_barang = $_POST['tnama'];
	@$jenis = $_POST['cjenis'];
	@$satuan = $_POST['tsatuan'];
	@$harga_pokok = $_POST['thargapokok'];
	@$ppn = $_POST['tppn'];
	@$harga_jual = $_POST['thargajual'];

	@$table = "tbl_barang";
	@$alamat = "?menu=daftarbarang";
	@$where = "kd_barang = '$_GET[id]'";

	@$field = array(
			'kd_barang' => $kd_barang,
			'nama_barang' => $nama_barang,
			'id_jenis' => $jenis,
			'satuan' => $satuan,
			'stok' => 0,
			'harga_pokok' => $harga_pokok,
			'ppn' => $ppn,
			'harga_jual' => $harga_jual
		);

	@$field2 = array(
			'nama_barang' => $nama_barang,
			'id_jenis' => $jenis,
			'satuan' => $satuan,
			'harga_pokok' => $harga_pokok,
			'ppn' => $ppn,
			'harga_jual' => $harga_jual
		);

	if (isset($_POST['bsimpan'])) {
		$aksi->simpan($table,$field,$alamat);
	}
	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}
	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where,$alamat);
	}
	if (isset($_POST['bubah'])) {
		$aksi->ubah($table,$field2,$where,$alamat);
	}
	if (isset($_POST['bcari'])) {
		@$text = $_POST['tcari'];
		@$cari = "WHERE nama_barang LIKE '%$text%'";
	}else{
		@$cari = "";
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Barang </title>
</head>
<body>
<br><br>
<br><br>
	<div class="container-fluid" id="mrg">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-primary">
					<?php if(!isset($_GET['edit'])){ ?>
						<div class="panel-heading">Tambah Barang
					<?php }else { ?>
						<div class="panel-heading">Ubah Barang
					<?php } ?>
						</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><div class="glyphicon glyphicon-lock"></div></span>
									<input type="text" name="tkode" value="<?php if(@$_GET['id']==""){echo @$kd;}else{echo @$edit['kd_barang'];} ?>" placeholder="Masukan Kode" class="form-control" required readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><div class="glyphicon glyphicon-text-size"></div></span>
									<input type="text" name="tnama" value="<?php echo @$edit['nama_barang']; ?>" placeholder="Nama Barang" class="form-control" maxlength="50" required autocomplete="off" tabindex="0" autofocus>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><div class="glyphicon glyphicon-tags"></div></span>
									<select name="cjenis" class="form-control" required tabindex="0">
										<option value="<?php echo @$edit['id_jenis']; ?>">--------Jenis Barang--------</option>
										<?php  
											@$qw = mysql_query("SELECT * FROM tbl_jenis ORDER BY jenis ASC");
											while (@$a=mysql_fetch_array($qw)) {
										?>
											<option class="form-control" value="<?php echo @$a['0']; ?>" <?php if(@$edit['2']==@$a['0']){echo "selected";} ?>><?php echo @$a['1']; ?></option>
											<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><div class="glyphicon glyphicon-oil"></div></span>
									<input type="text" name="tsatuan" value="<?php echo @$edit['satuan']; ?>" placeholder="Satuan Barang" class="form-control" required maxlength="25" autocomplete="off" tabindex="0">
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><div class="glyphicon glyphicon-usd"></div></span>
									<input type="text" name="thargapokok" id="thargapokok" value="<?php echo @$edit['harga_pokok']; ?>" placeholder="Harga Pokok / Satuan" class="form-control" maxlength="11" required autocomplete="off" tabindex="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
								</div>
							</div>

							 <td>
                                <div class="form-group">
                                	<div class="input-group">
	                                    <div class="input-group-addon"><div class="glyphicon glyphicon-erase"></div></div>
	                                    <input type="text" name="tppn" id="tppn" value="<?php echo @$edit['ppn']; ?>" class="form-control" placeholder="PPN (10%)"  required maxlength="11" readonly autocomplete="off" tabindex="1">
	                                	 <div class="input-group-addon">
	                                        <input type="checkbox" name="cekppn" id="cekppn" value="y" checked="checked" tabindex="0">10%
	                                    </div>
	                                </div>
                                </div>	
                            </td>

                            <div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><div class="glyphicon glyphicon-usd"></div></span>
									<input type="text" name="thargajual" id="thargajual" value="<?php echo @$edit['harga_jual']; ?>" placeholder="Harga Jual / Satuan" class="form-control" maxlength="25"length="11" required readonly tabindex="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
								</div>
							</div>

							<div class="form-group">
								<?php if (@$_GET['id']=="") { ?>
									<button type="submit" name="bsimpan" class="btn btn-primary btn-block" tabindex="0">SIMPAN</button>
								<?php }else{ ?>
									<button type="submit" name="bubah" class="btn btn-success btn-block" tabindex="0">UBAH</button>
								<?php } ?>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-primary">
					<div class="panel-heading">Daftar Barang</div>
					<div class="panel-body">
						<form method="post">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped">
									<div class="col-md-12" style="margin-bottom:10px;">
										<div class="input-group">
											<input type="text" name="tcari" value="<?php echo @$text; ?>" class="form-control" placeholder="Cari Barang" maxlength="50">
											<span class="input-group-btn">
												<button type="submit"  name="bcari" class="btn btn-primary"><div class="glyphicon glyphicon-search"></div></button>
												<button type="submit" name="refresh" class="btn btn-success"><div class="glyphicon glyphicon-refresh">Refresh</div></button>
											</span>
										</div>
									</div>
									<!-- <div class="col-md-12" style="margin-left:-10px;margin-top:10px;">
										<br>
										<label>Tampilkan Data Sebanyak :</label>
										<select>
											<option>10</option>
											<option>25</option>
											<option>50</option>
											<option>100</option>
										<label>Baris</label>
										</select>
									</div> -->
									<tr id="pri">
										<th>No.</th>
										<th width="10%">Kode Barang</th>
										<th>Nama Barang</th>
										<th>Jenis Barang</th>
										<th>Satuan</th>
										<th>Stok</th>
										<th width="12%">Harga Pokok</th>
										<th width="7%">PPN (10%)</th>
										<th width="11%">Harga Jual</th>
										<th width="5%">Hapus</th>
										<th width="5%">Edit</th>
										<th width="5%">Tambah<br><center>Stok</center></th>
									</tr>
									<tbody>
										<tr>
											<?php  
												$a = $aksi->tampil("qw_barang",$cari," ORDER BY kd_barang DESC");
												@$no = 0;
												if ($a=="") {
													echo "<tr><td colspan='11' align='center'><b>Data Tidak Ada</b></td></tr>";
												}else{
													foreach ($a as $data) {
														$kdbrg = $data[0];
														$no++;
														?>
												
														<td><center><b><?php echo $no; ?>.</b></center></td>
														<td><?php echo $kdbrg ?></td>
														<td><?php echo $data[1]; ?></td>
														<td><?php echo $data[8]; ?></td>
														<td><?php echo $data[3]; ?></td>
														<td <?php if($data[4] < 10 ){echo "class='danger'" ;}?>> <?php echo $data[4]; ?></td>
														<td align="right"><?php echo number_format($data[5],0,'','.'); ?></td>
														<td align="right"><?php echo number_format($data[6],0,'','.');?></td>
														<td align="right"><?php echo number_format($data[7],0,'','.'); ?></td>
														<td><a href="?menu=daftarbarang&hapus&id=<?php echo $kdbrg;?>" onClick="return confirm('Anda Yakin Akan Menghapus Barang <?php echo $data[1] ?> ini ?')"><center><span class="glyphicon glyphicon-trash" id="red"></span></center></a></td>
														<td><a href="?menu=daftarbarang&edit&id=<?php echo $kdbrg; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
														<td><center><a href="?menu=pembelianbarang&kd=<?php echo $kdbrg; ?>"><span class="glyphicon glyphicon-share" id="blue"></span></a></center></td>
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