<?php  
	@$tanggal = date("Y-m-d");
	@$pecah = explode("-", $tanggal);
	@$tgl = $pecah[2];
	@$bln = $pecah[1];
	@$thn = $pecah[0];
	//keuangan
	@$pedapatanbulanan = mysql_fetch_array(mysql_query("SELECT SUM(masuk) as 'msk' FROM tbl_keuangan WHERE MONTH(tanggal)='$bln' AND YEAR(tanggal)='$thn'"));
	@$Pengeluaran = mysql_fetch_array(mysql_query("SELECT SUM(keluar) as 'klr' FROM tbl_keuangan WHERE MONTH(tanggal)='$bln' AND YEAR(tanggal)='$thn'"));
	@$Pendapatanharian = mysql_fetch_array(mysql_query("SELECT SUM(masuk) as 'hari' FROM tbl_keuangan WHERE tanggal ='$tanggal' AND jenis_keuangan = 'Pendapatan Harian'"));
	@$saldo = $pedapatanbulanan['msk'] - $Pengeluaran['klr'];

	//transaksi
	@$today = date("dmY");	
	@$stok = mysql_fetch_array(mysql_query("SELECT COUNT(stok) as 'stk' FROM tbl_barang WHERE stok < 10"));
	@$transaksihari = mysql_fetch_array(mysql_query("SELECT COUNT(*) as 'thari' FROM tbl_transaksi WHERE tgl_transaksi = '$tanggal'"));
	@$barangjual = mysql_fetch_array(mysql_query("SELECT SUM(banyak) as 'bjual' FROM tbl_transaksi_detail WHERE no_transaksi LIKE '%$today%'"));
	@$barangmasuk = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) as 'bmasuk' FROM tbl_barang_masuk WHERE tanggal = '$tanggal' "));

	//master
	@$jenis = mysql_fetch_array(mysql_query("SELECT COUNT(jenis) as 'jns' FROM tbl_jenis"));
	@$barang = mysql_fetch_array(mysql_query("SELECT SUM(stok) as 'brg' FROM tbl_barang"));
	@$user = mysql_fetch_array(mysql_query("SELECT COUNT(username) as 'us' FROM tbl_user"));
	@$supplier = mysql_fetch_array(mysql_query("SELECT COUNT(kd_supplier) as 'sup' FROM tbl_supplier"));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMINISTRATOR</title>
</head>
<body>
<br><br><br><br><br>
	<div class="container">
		<div class="col-md-12">
			<div class="alert alert-dismissible alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Login Berhasil ! <b><?php echo $_SESSION['nama']; ?></b></strong>
			  <br>
				Pilih Menu Untuk Menjalankan Aplikasi ini,Jika Anda Ingin keluar,klik  <a href="?logout" onclick="return confirm('Apakah Anda yakin akan keluar dari akun ?');"><span id="blue"><b>Disini</b></span></a>
			</div>

		</div>
	</div>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="text-center" style="font-size:40px;" id="blue">
				<div class="glyphicon glyphicon-fire"></div>
				Dashboard
			</div>
			<div style="width:100%;height:2px;background-color:#128f76; margin-bottom:15px;border-radius:20px;">&nbsp;</div>
			<div class="row">
				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-success">
				        <div class="panel-heading">
				            <div class="row">
				                <div class="col-xs-12 text-right">
				                    <div style="font-size:30px;margin-top:10px;" >Rp. <?php echo number_format($Pendapatanharian['hari'],0,'','.'); ?>,00</div>
				                    <div>Pendapatan Hari Ini</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=lapkeuangan">
				            <div class="panel-body text-success">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-info">
				        <div class="panel-heading">
				            <div class="row">
				                <div class="col-xs-12 text-right">
				                    <div style="font-size:30px;margin-top:10px;" >Rp. <?php echo number_format(@$pedapatanbulanan['msk'],0,'','.'); ?>,00</div>
				                    <div>Pendapatan Bulanan</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=lapkeuangan">
				            <div class="panel-body text-info">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-danger">
				        <div class="panel-heading">
				            <div class="row">
				                <div class="col-xs-12 text-right">
				                    <div style="font-size:30px;margin-top:10px;" >Rp. <?php echo number_format(@$Pengeluaran['klr'],0,'','.'); ?>,00</div>
				                    <div>Pengeluaran Bulanan</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=lapkeuangan">
				            <div class="panel-body text-danger">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-warning">
				        <div class="panel-heading">
				            <div class="row">
				                <div class="col-xs-12 text-right">
				                    <div style="font-size:30px;margin-top:10px;" >Rp. <?php echo number_format(@$saldo,0,'','.'); ?>,00</div>
				                    <div>Saldo Akhir</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=lapkeuangan">
				            <div class="panel-body text-warning">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>
			</div>

		</div>

		<div class="col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-primary">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa fa-shopping-cart fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $transaksihari['thari']; ?></div>
				                    <div>Transaksi Hari Ini!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=laptransaksiharian">
				            <div class="panel-body text-primary">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-success">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa fa-mail-forward fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $barangjual['bjual']; ?></div>
				                    <div>Barang Keluar Hari Ini!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=laptransaksiharian">
				            <div class="panel-body text-success">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-info">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa  fa-arrow-down fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $barangmasuk['bmasuk']; ?></div>
				                    <div>Barang Masuk Hari Ini!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=pembelianbarang">
				            <div class="panel-body text-info">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-danger">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa fa-times-circle fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $stok['stk']; ?></div>
				                    <div>Stok barang kurang dari 10!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=pembelianbarang">
				            <div class="panel-body text-danger">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row">
					<div class="col-lg-3 col-md-6">
				    <div class="panel panel-warning">
				        <div class="panel-heading">
				             <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa fa-tasks fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $jenis['jns']; ?></div>
				                    <div>Jumlah Jenis Barang!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=daftarjenis">
				            <div class="panel-body text-warning">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>
				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-primary">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa fa-inbox  fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $barang['brg']; ?></div>
				                    <div>Jumlah Barang Tersedia!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=daftarbarang">
				            <div class="panel-body text-primary">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-success">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa fa-user fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $user['us']; ?></div>
				                    <div>Jumlah User!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=daftaruser">
				            <div class="panel-body text-success">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>

				<div class="col-lg-3 col-md-6">
				    <div class="panel panel-info">
				        <div class="panel-heading">
				            <div class="row">
					            <div class="col-xs-3">
				                    <i class="fa  fa-users fa-5x"></i>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div style="font-size:40px;"><?php echo $supplier['sup']; ?></div>
				                    <div>Jumlah Supplier Barang!</div>
				                </div>
				            </div>
				        </div>
				        <a href="?menu=daftarsupplier">
				            <div class="panel-body text-info">
				                <span class="pull-left">Lihat Detail</span>
				                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>
			</div>
		</div>
		</div>

</body>
</html>