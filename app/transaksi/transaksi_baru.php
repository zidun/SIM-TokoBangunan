<?php  
	if (!isset($_GET['menu'])) {
	    header("location:index.php?menu=penjualanbaru");
	}

	@$sql = mysql_query("SELECT * FROM tbl_barang WHERE kd_barang='$_GET[kd]'");
	@$r = mysql_fetch_array($sql);

	@$today = date("dmY");	
	@$j = mysql_query("SELECT * FROM tbl_transaksi WHERE no_transaksi LIKE '$today%' ORDER BY no_transaksi DESC");
	@$k = mysql_fetch_array($j);

	if(@$k == ""){
		@$no_urut="001";
	}else{
		@$no_urut = substr($k['no_transaksi'], 8,3)+1;
		if(@$no_urut < 10){
			@$no_urut = "00$no_urut";
		}elseif (@$no_urut < 100) {
			@$no_urut = "0$no_urut";
		}
	}

//variable yang dibutuhkan
	@$no_transaksi ="$today$no_urut";
	@$tgl_transaksi = date("d/m/Y");
	@$tanggal = date("Y-m-d");
	@$alamat = "?menu=penjualanbaru";

	@$field = array(
		'no_transaksi' => @$no_transaksi,
	    'tgl_transaksi' => @$tanggal,
	    'id_kasir' => @$_SESSION['user'],
	    'subtotal' => @$_POST['tsubtotal'],
	    'diskon' => @$_POST['tdiskon'],
	    'total_akhir' => @$_POST['ttotalakhir'],
	    'bayar' => @$_POST['tbayar'],
	    'kembalian' => @$_POST['tkembalian']
		);

	@$field_uang = array(
		'id_asal' => @$no_transaksi,
		'tanggal' => @$tanggal,
		'jenis_keuangan' => "Pendapatan Harian",
		);

	@$field_detail = array(
		'no_transaksi' => $no_transaksi,
		'kd_barang' => @$_POST['tkode'],
		'barang'=>@$_POST['tbarang'],
		'harga'=>@$_POST['tharga'],
		'banyak'=>@$_POST['tbanyak'],
		'total'=>@$_POST['ttotal']
		);

//jika kode barang ada yang sama
	@$sql1 = mysql_query("SELECT * FROM tbl_transaksi_detail WHERE no_transaksi = '$no_transaksi' AND kd_barang = '$_GET[kd]'");	
	@$tmp = mysql_fetch_array($sql1);	

//eksekusi sebuah program
	if(isset($_POST['simpan_detail'])){
		if ($_POST['tbanyak'] > $r['stok'] ) {
			$aksi->pesan("Maff Stok ".$r['nama_barang']." tidak mencukupi ".$_POST['tbanyak']." barang pembelian.Stok yang tersedia hanya ".$r['stok']." barang lagi");
			$aksi->alamat($alamat);
		}else if($_POST['tbanyak'] == 0 || $_POST['tbanyak']==""){
			$aksi->pesan("jumlah beli harus di isi lebih dari 0");
			$aksi->alamat($alamat);
		}else{
			if ($_GET['kd'] == $tmp['kd_barang']) {
				// $aksi->pesan("get = ".$_GET['kd']."dan tmp = ".$tmp['kd_barang']);
				mysql_query("UPDATE tbl_transaksi_detail SET banyak = banyak +'$_POST[tbanyak]', total = total + $_POST[ttotal]  WHERE  no_transaksi = '$no_transaksi' AND kd_barang = '$_GET[kd]'");
				$aksi->alamat($alamat);
			}else{
				$aksi->simpanlsg("tbl_transaksi_detail",$field_detail,$alamat);
			}
		}
	}

//edit pembelian
	if (isset($_GET['edit'])) {
		@$id = $_GET['id'];
		$edit = $aksi->edit("tbl_transaksi_detail"," id = '$id'");
	}

	if (isset($_POST['ubah_detail'])) {
		if ($_POST['tbanyak'] > $r['stok'] ) {
			$aksi->pesan("Maff Stok ".$r['nama_barang']." tidak mencukupi ".$_POST['tbanyak']." barang pembelian.Stok yang tersedia hanya ".$r['stok']." barang lagi");
			$aksi->alamat($alamat);
		}else if($_POST['tbanyak'] == 0 || $_POST['tbanyak']==""){
			$aksi->pesan("jumlah beli harus di isi lebih dari 0");
			$aksi->alamat($alamat);
		}else{
			mysql_query("UPDATE tbl_transaksi_detail SET banyak ='$_POST[tbanyak]', total = '$_POST[ttotal]'  WHERE  id = '$_GET[id]'");
			$aksi->pesan("Berhasil diubah");
			$aksi->alamat($alamat);
		}
	}

	if (isset($_POST['selesai'])) {
		if ($_POST['tsubtotal'] == "" || $_POST['ttotalakhir'] == "" || $_POST['tbayar'] == "" || $_POST['tkembalian'] == "" || $_POST['tkembalian'] > $_POST['tbayar']) {
			$aksi->pesan("Mohon Periksa Kembali Transaksi Anda !!!");
			$aksi->alamat($alamat);
		}else{
			if ($no_urut == "001") {
				$aksi->simpanlsg("tbl_keuangan",$field_uang,"#");
				$aksi->simpanlsg("tbl_transaksi",$field,"#");
			}else{
				$aksi->simpanlsg("tbl_transaksi",$field,"#");
			}
			echo "<script>window.open('../transaksi/transaksi_print.php?no_transaksi=$no_transaksi');document.location.href='$alamat'</script>";
		}
	}

	if (isset($_GET['hapus'])) {
		@$id = $_GET['id'];
		$aksi->hapus("tbl_transaksi_detail"," id = '$id'",$alamat);
	}

	if (isset($_POST['reset'])) {
		$aksi->hapus("tbl_transaksi_detail"," no_transaksi = '$no_transaksi'",$alamat);
		$aksi->hapus("tbl_transaksi"," no_transaksi = '$no_transaksi'",$alamat);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form Transaksi Penjual Barang</title>
</head>
<body>
<br><br><br><br>
<div class="conatainer-fluid" id="mrg">
	<div class="row">
		<form method="post">
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">Transaksi Penjualan Barang</div>
					<div class="panel-body">

						<div class="form-group">
							<label>KODE BARANG :</label>
							<div class="input-group">
								<span class="input-group-addon"><div class="glyphicon glyphicon-lock"></div></span>	
								<input type="text" name="tkode" value="<?php if(@$_GET['id']==""){echo @$r[0];}else{echo @$edit['kd_barang'];} ?>" class="form-control" placeholder="Kode  Barang" readonly>
								<span class="input-group-btn">
									<button type="button" class="btn btn-primary <?php if(isset($_GET['edit'])){echo 'disabled';} ?>" data-toggle="modal" tabindex="0" <?php if(!isset($_GET['edit'])){echo "data-target='#barang'";}if(!isset($_GET['kd'])){echo "autofocus";} ?>>Tampil</button>
								</span>
							</div>

							<!-- Modalll -->
							<div class="modal fade" id="barang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background-color:rgba(255,255,255,0.7);">
							  <div class="modal-dialog modal-lg" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close" tabindex="1"><span aria-hidden="true">&times;</span></button>
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
							       				@$a = $aksi->tampil("qw_barang","WHERE stok > 0 ","ORDER BY kd_barang ASC");
							       				@$no = 0;
												if ($a=="") {
													echo "<tr><td colspan='5' align='center'><b>Data Tidak Ada</b></td></tr>";
												}else{
													foreach ($a as $i) {
														$no++;
														?>
														<tbody id="mdl" onclick="window.location.href='?menu=penjualanbaru&kd=<?php echo $i[0]; ?>'">
															<td><?php echo $no ?></td>
															<td><?php echo $i[0]; ?></td>
															<td><?php echo $i[1]; ?></td>
															<td><?php echo $i[3]; ?></td>
															<td><?php echo $i[7]; ?></td>
															<td <?php if($i[4]<10 ){echo "class='danger'";}else{echo "id='pri'";} ?>><?php echo $i[4]; ?></td>
														</tbody>
										<?php	} } ?>
								       	</table>
							     	</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
							      </div>
							    </div>
							  </div>
							</div>
						</div>

						<div class="form-group">
							<label>NAMA BARANG :</label>
							<div class="input-group">
								<span class="input-group-addon"><div class="glyphicon glyphicon-text-size"></div></span>
								<input type="text" name="tbarang" value="<?php if(@$_GET['id']==""){echo @$r['nama_barang'];}else{echo @$edit['barang'];} ?>" required placeholder="Barang" class="form-control" readonly tabindex="1" autocomplete="off">
							</div>
						</div>

						<div class="form-group">
							<label>HARGA BARANG :</label>
							<div class="input-group">
								<span class="input-group-addon"><div class="glyphicon glyphicon-text-size"></div></span>
								<input type="text" name="tharga" id="tharga" value="<?php if(@$_GET['id']==""){echo @$r['harga_jual'];}else{echo @$edit['harga'];} ?>" required placeholder="Harga" class="form-control" readonly tabindex="1" autocomplete="off">	
							</div>
						</div>

						<div class="form-group">
							<label>JUMLAH BELI :</label>
							<div class="input-group">
								<span class="input-group-addon"><div class="glyphicon glyphicon-text-size"></div></span>
								<input type="text" name="tbanyak" id="tjumlah" value="<?php echo @$edit['banyak']; ?>" class="form-control" required placeholder="Banyak" maxlength="5" autofocus onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" tabindex="0" autofocus>	
							</div>
						</div>

						<div class="form-group">
							<label>TOTAL HARGA :</label>
							<div class="input-group">
								<span class="input-group-addon"><div class="glyphicon glyphicon-text-size"></div></span>
								<input type="text" name="ttotal" id="ttotal" value="<?php echo @$edit['total']; ?>" class="form-control" required placeholder="Total Harga" readonly onkeypress='return event.charCode >= 48 && event.charCode <= 57' autpcomplete="off" tabindex="1">	
							</div>
						</div>

						<div class="form-group">
							<?php if (@$_GET['id']=="") { ?>
								<button type="submit" name="simpan_detail" class="btn btn-block btn-lg btn-primary" tabindex="0">TAMBAH</button>			
							<?php }else{ ?>
								<button type="submit" name="ubah_detail" class="btn btn-block btn-lg btn-success" tabindex="0">UBAH</button>			
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			</form>
			<div class="col-md-9">
				<div class="panel panel-primary" >
					<div class="panel-heading" style="height:40px;">
						<h4 class="panel-title pull-left">PB.SAMI AGUNG </h4>
						<div class="pull-right">
							<a style="text-decoration:none;color:white;">No.Transaksi  &nbsp;&nbsp;: <?php echo @$no_transaksi; ?></a>
							&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<a style="text-decoration:none;color:white;">Tanggal Transaksi &nbsp;: <?php echo @$tgl_transaksi; ?></a>
							&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<a style="text-decoration:none;color:white;">Kasir&nbsp;&nbsp;: <?php echo @$_SESSION['nama']; ?></a>	
							&nbsp;&nbsp;	
						</div>
						
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover">
							<thead id="pri">
								<th width="4%">No.</th>
								<th width="12%">Kode Barang</th>
								<th width="20%">Barang</th>
								<th width="13%">Harga</th>
								<th width="8%">Jumlah</th>
								<th width="20%">Total Harga</th>
								<th width="10%" colspan="2"><center>Aksi</center></th>
							</thead>
							<tbody>
								<?php  
									@$b = $aksi->tampil("tbl_transaksi_detail","WHERE no_transaksi = '$no_transaksi'","ORDER BY id ASC");
									@$no = 0;
									if ($b == "") {
										echo "<tr><td colspan='7' align='center'><b>Belum Ada Barang Yang Ditambahkan !!!</b></td></tr>";
									}else{
										foreach ($b as $data) {
											$no++;
									?>		
								<tr>
									<td align="center"><?php echo $no;; ?></td>
									<td align="center"><?php echo @$data['kd_barang']; ?></td>
									<td><?php echo @$data['barang']; ?></td>
									<td align="right"><?php echo number_format(@$data['harga'],0,'','.'); ?></td>
									<td align="right"><?php echo number_format(@$data['banyak'],0,'','.'); ?></td>
									<td align="right"><?php echo number_format(@$data['total'],0,'','.'); ?></td>
									<td align="center"><a href="?menu=penjualanbaru&hapus&id=<?php echo @$data['id']; ?>" class="btn btn-danger btn-xs">Hapus</a></td>
									<td align="center"><a href="?menu=penjualanbaru&edit&id=<?php echo @$data['id']; ?>&kd=<?php echo $data['kd_barang']; ?>" class="btn btn-danger btn-xs">Edit</a></td>
								</tr>
								<?php }}?>
								<?php 
									@$sql = mysql_query("SELECT SUM(total) AS subtotal FROM tbl_transaksi_detail WHERE no_transaksi = '$no_transaksi'");
									@$tl = mysql_fetch_array($sql);
									@$subtotal = $tl['subtotal'];
								 ?>
								 <?php  
									@$sql = mysql_query("SELECT * FROM tbl_transaksi_detail WHERE no_transaksi='$no_transaksi'");
									@$cekbeli = mysql_num_rows($sql);

									if ($cekbeli > 0) { ?>

								<tr style="background-color: rgba(44, 62, 80, 0.1);">
									<td colspan="5" align="right"><b>TOTAL KESELURUHAN</b></td>
									<td align="right"><b>Rp. <?php echo number_format(@$subtotal, 0,'','.'); ?></b></td>
									<td colspan="2"></td>
								</tr>							
							</tbody>
						</table>
						<hr>
						<form method="post">
						<button type="button" id="pembayaran" class="btn btn-primary btn-block" data-toggle="modal" data-target="#bayar"><h4><b>P E M B A Y A R A N</b></h4></button>
							<!-- Modalll -->
							<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background-color:rgba(50, 100, 240, 0.2);">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close" tabindex="100"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><center>P E M B A Y A R A N</center> </h4>
							      </div>
							      <div class="modal-body">
							     	<form method="post">
							     		<div class="form-group">
							     			<label style="margin-right:310px;">SUBTOTAL</label>
							     			<label>DISKON</label>
							     			<div class="input-group">
							     				<span class="input-group-addon">Rp.</span>
							     				<b><input type="text" name="tsubtotal" id="tsubtotal" class="form-control" value="<?php echo @$subtotal; ?>" readonly tabindex="1" required></b>
							     				<span class="input-group-addon">%</span>
							     				<select name="tdiskon" id="tdiskon" class="form-control" required tabindex="0" autofocus>
							     					<option></option>
							     					<option value="0">0</option>
							     					<option value="10">10</option>
							     					<option value="25">25</option>
							     					<option value="50">50</option>
							     				</select>
							     			</div>
							     		</div>
							     		<div class="form-group">
							     			<label>TOTAL AKHIR</label>
							     			<div class="input-group">
							     				<input type="text" name="ttotalakhir" id="ttotalakhir" class="form-control total" readonly required tabindex="1">
							     			</div>
							     		</div>
							     		<div class="form-group">
							     			<label>BAYAR</label>
							     			<div class="input-group">
							     				<span class="input-group-addon">Rp.</span>
							     				<input type="text" name="tbayar" id="tbayar" class="form-control" required tabindex="0" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
							     			</div>
							     		</div>
							     		<div class="form-group">
							     			<label>KEMBALIAN</label>
							     			<div class="input-group">
							     				<span class="input-group-addon">Rp.</span>
							     				<input type="text" name="tkembalian" id="tkembalian" class="form-control" readonly required tabindex="1">
							     			</div>
							     		</div>
							     		<div class="form-group">
							     			<button type="submit" name="selesai" class="btn btn-primary btn-block btn-lg" tabindex="0">S E L E S A I</button>
							     		</div>
							     	</form>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
							      </div>
							    </div>
							  </div>
							</div>
					<form method="post">
						<button type="submit" name="reset" class="btn btn-block btn-default" onclick="return confirm('Apakah Anda yakin akan mereset Transaksi ini ?');"><h4><b>R E S E T</b></h4></button>			
						<a href="?menu=daftarpenjualan" class="btn btn-block btn-default" onclick="return confirm('Apakah Anda yakin akan kembali ?');"><h4><b>K E M B A L I</b></h4></a>			
					<?php } ?>
					</form>
					</div>	
				</div>
			</div>
	</div>
</div>
</body>
</html>