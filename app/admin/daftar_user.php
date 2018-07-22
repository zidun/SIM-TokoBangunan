<?php  
if (!isset($_GET['menu'])) {
	header("location:index.php?menu=daftaruser");
}
		
	@$username = $_POST['tuser'];
	@$password = $_POST['tpass'];
	@$nama_user = $_POST['tnama'];
	@$jk = $_POST['cjk'];
	@$alamat_user = $_POST['talamat'];
	@$no_telp_user = $_POST['tnohp'];
	@$jabatan = $_POST['cjabatan'];


	@$table = "tbl_user";
	@$alamat = "?menu=daftaruser";
	@$where = "id_user = $_GET[id]";
	@$field = array(
		'nama_user' => $nama_user,
		'jk_user' => $jk,
		'alamat_user' => $alamat_user,
		'no_telp_user' => $no_telp_user,
		'username' => $username,
		'password' => $password,
		'type_user' => $jabatan
		);

	if (isset($_POST['bsimpan'])) {
		$aksi->simpan($table, $field, $alamat);
	}
	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
		$edit = $aksi->edit("qw_user",$where);
	}
	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where,$alamat);
	}
	if (isset($_POST['bubah'])) {
		$aksi->ubah($table, $field, $where, $alamat);
	}
	if (isset($_POST['bcari'])) {
		@$text = $_POST['tcari'];
		@$cari = "WHERE nama_user  LIKE '%$text%'";
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
    <title>FORM USER</title>
</head>
<body>
<br><br><br><br>
<div class="container-fluid" id="mrg">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-primary">
				<?php if(!isset($_GET['edit'])){ ?>
					<div class="panel-heading">Tambah User
				<?php }else{ ?>
					<div class="panel-heading">Ubah User
				<?php } ?>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
						<!-- <label>Username</label> -->
							<div class="input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-user"></div></span>
								<input type="text" name="tuser" value="<?php echo @$edit['username'] ?>" class="form-control" placeholder="Username" required  maxlength="20" <?php if(isset($_GET['edit'])){ echo "readonly tabindex='1'";}else{echo "tabindex='0' autofocus";} ?> autocomplete="off">
							</div>
						</div>

						<div class="form-group">
						<!-- <label>Password</label> -->
							<div class="col-md-12 input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-lock"></div></span>
								<input type="password" name="tpass" id="password" value="<?php echo @$edit['password'] ?>" class="form-control" placeholder="Password" required  maxlength="30" tabindex="0" autocomplete="off" <?php if(isset($_GET['edit'])){echo "autofocus";} ?>>
							</div>
						</div>

						<div class="form-group">
						<!-- <label>Nama User</label> -->
							<div class="input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-text-size"></div></span>
								<input type="text" name="tnama" value="<?php echo @$edit['nama_user'] ?>" class="form-control" placeholder="Nama" required  maxlength="50" tabindex="0" autocomplete="off">
							</div>
						</div>

						<div class="form-group">
						<!-- <label>Jabatan</label> -->
							<div class="input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-education"></div></span>
								<select name="cjabatan" class="form-control" required tabindex="0" autocomplete="off">
									<option value="<?php echo @$edit['type_user']; ?>"><?php echo @$edit['jabatan']; ?></option>
									<?php
										@$qw=mysql_query("SELECT * FROM tbl_type_user");
										while ($a=mysql_fetch_array($qw)) {
									?>
										<option class="form-control" value="<?php echo @$a['0']; ?>" <?php if (@$edit[8]==@$a['0']) {echo "selected";} ?>><?php echo $a['1']; ?></option>
									<?php }?>
								</select>
							</div>
						</div>

						<div class="form-group">
						<!-- <label>Jabatan</label> -->
							<div class="input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-heart"></div></span>
								<select name="cjk" class="form-control" required>
									<?php if(@$edit['jk_user']=="Laki-Laki"){ @$j = "Laki-Laki"; }elseif(@$edit['jk_user']=="Perempuan"){ $j = "Perempuan"; } ?>
									<option value="<?php echo @$edit['jk_user'] ?>" selected><?php echo @$j ?></option>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
						<!-- <label>Alamat</label> -->
							<div class="input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-home"></div></span>
								<textarea name="talamat" placeholder="Alamat" class="form-control" required autocomplete="off"><?php echo @$edit['alamat_user']?></textarea>
							</div>
						</div>

						<div class="form-group">
						<!-- <label>No Telepon</label> -->
							<div class="input-group" style="margin:0 2px;">
								<span class="input-group-addon"><div class="glyphicon glyphicon-phone-alt"></div></span>
								<input type="text" name="tnohp" value="<?php echo @$edit['no_telp_user']; ?>" class="form-control" placeholder="No Telepon" required autocomplete="off"  maxlength="13" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
				<div class="panel-heading">Daftar User</div>
				<div class="panel-body">
					<form method="post">
						<div class="table table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<div class="col-md-12"style="margin-bottom:10px;">
									<div class="input-group">
										<input type="text" name="tcari" value="<?php echo @$text; ?>" class="form-control" placeholder="Cari User" maxlength="50">
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
								<thead>	
									<tr id="pri">
										<th width="5%">No.</th>
										<th>Username</th>
										<th>Nama</th>
										<th>Jabatan</th>
										<th>Jenis Kelamin</th>
										<th>Alamat</th>
										<th>No Telepon</th>
										<th><center>Hapus</center></th>
										<th><center>Ubah</center></th>
									</tr>
								</thead>
								<tbody>	
								<tr>
									<?php  
										$a = $aksi->tampil("qw_user",$cari," ORDER BY id_user DESC");
										@$no = 0;
										if ($a=="") {
											echo "<tr><td colspan='9' align='center'>Data Tidak Ada</td></tr>";
										}else{
											foreach ($a as $data) {
												$us = $data[5];
												$nm = $data[1];
												$jt = $data[8];
												$alm = $data[3];
												$nohp = $data[4];
												$jk = $data[2];
													if ($us!==@$_SESSION['user']) {
														$no++;
												?>
												<td><center><b><?php echo $no; ?></b></center></td>
												<td><?php echo $us; ?></td>
												<td><?php echo $nm; ?></td>
												<td><?php echo $jt; ?></td>
												<td><?php echo $jk; ?></td>
												<td><?php echo $alm; ?></td>
												<td><?php echo $nohp; ?></td>
												<td><a href="?menu=daftaruser&hapus&id=<?php echo $data['0'];?>" onClick="return confirm('Anda Yakin Akan Menghapus <?php echo $nm ?> ini ?')"><center><span class="glyphicon glyphicon-trash" id="red"></span></center></a></td>
												<td><a href="?menu=daftaruser&edit&id=<?php echo $data['0']; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
											</tr>
								<?php	} }} ?>
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