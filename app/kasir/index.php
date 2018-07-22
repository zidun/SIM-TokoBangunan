<?php  
	include "../config/koneksi.php";
	include "../library/fungsi.php";
	date_default_timezone_set("Asia/Jakarta");
	

	@$aksi = new oop();
	session_start();
	
	@$home = "../index.php";
	@$tipe = "3";

	$aksi->ceklogin($home,$tipe);

	if (isset($_GET['logout'])) {
		$aksi->logout();
		$aksi->alamat($home);
	}	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KASIR</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/glyphicons-halflings-regular.svg">
    <link rel="icon" href="../img/logo1.png">
    <style type="text/css">
    	body{
    		background-color: rgba(0, 0, 0, 0.05);
    	}

    	#hov:hover{
    		display: block;
    		background-color: rgba(0, 0, 0, 0.4);
    		border-radius: 5px 5px;
    		color: #1a242f;
    		transition: 0.3s ease-in-out;
    	}
    </style>
    <script type="text/javascript">
    	window.setTimeout("waktu()",1000);
    	function waktu(){
    		var tanggal = new Date();
    		setTimeout("waktu()",1000);
    		document.getElementById("output").innerHTML = 
    		tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
    	}
    </script>
    <script language="Javascript">
    	var tanggallengkap = new String();
    	var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    	namahari = namahari.split(" ");
    	var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    	namabulan = namabulan.split(" ");
    	var tgl = new Date();
    	var hari = tgl.getDay();
    	var tanggal = tgl.getDate();
    	var bulan = tgl.getMonth();
    	var tahun= tgl.getFullYear();
    	tanggallengkap =namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun;

    		var popupWindow = null;
    		function centerredPopup(url,winName,w,h,scroll){
    			LeftPosition = (screen.width) ?(screen.width-w)/2 : 0;
    			TopPosition = (screen.height) ?(screen.height-h)/2 : 0;
    			settings
    			='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
    			popupWindow = window.open(url,winName,settings)
    		}
    </script>
    
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toogle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>	
			<a class="navbar-brand" href="index.php">K A S I R</a>
		</div>
		<!-- akhir dari navbar atas -->
		<div class="navbar-collapse collaspse">
			<ul class="nav navbar-nav">
				<li class="dropdown" id="hov">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="transaksi"><div class="glyphicon glyphicon-shopping-cart"></div>&nbsp;&nbsp;TRANSAKSI&nbsp; <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="transaksi">
						<li>
							<a href="?menu=daftarpenjualan">Daftar Transaksasi Penjualan</a>
						</li>
						<li>
							<a href="?menu=penjualanbaru">Transaksi Baru</a>
						</li>
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right" style="margin-right:50px;">
				<li class="dropdown" id="hov">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="akun"><div class="glyphicon glyphicon-user"></div>&nbsp;<?php echo $_SESSION['nama']; ?>&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="akun">
						<li>
							<a href="?menu=profil"><div class="glyphicon glyphicon-cog"></div>&nbsp;&nbsp;Profil</a>
						</li>
						<li>
							<a href="?logout" onclick="return confirm('Apakah Anda yakin akan keluar dari akun ?');"><div class="glyphicon glyphicon-log-out"></div>&nbsp;&nbsp;Logout</a>
						</li>
					</ul>
				</li>
			</ul>


			<ul class="nav navbar-nav navbar-right">
				<li>
					<h4><a style="text-decoration:none;color:white;margin-right:30px;margin-top:10px;" class="nav navbar-nav navbar-right">
						<script language="javascript">document.write(tanggallengkap);</script>
					</a></h4>
				</li>
			</ul>
			
		</div>
	</nav>
	<nav></nav>
	<?php  
		switch (@$_GET['menu']) {
			case 'daftarpenjualan':include '../transaksi/daftar_penjualan.php'; break;
			case 'penjualanbaru':include '../transaksi/transaksi_baru.php'; break;
			case 'penjualanedit':include '../transaksi/transaksi_edit.php'; break;
			case 'detail':include '../transaksi/detail_transaksi.php'; break;
			case 'profil':include '../laporan/profil.php'; break;
			
			default:$aksi->alamat("index.php?menu=daftarpenjualan");break;
		}
	?>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/show-password.js"></script>

	<script>
		 $(function () {
                $('#password').password().on('show.bs.password', function (e) {
                    $('#methods').prop('checked', true);
                }).on('hide.bs.password', function (e) {
                    $('#methods').prop('checked', false);
                });
                $('#methods').click(function () {
                    $('#password').password('toggle');
                });
            });

		   $("#tjumlah").keyup(function(){
		   		var harga = parseInt($("#tharga").val());
		   		var jumlah = parseInt($("#tjumlah").val());
		   		var total = harga * jumlah;
		   		$("#ttotal").val(total);
		   })


		 $("#tdiskon").change(function(){
		 	var subtotal = $("#tsubtotal").val();
		 	var diskon = $("#tdiskon").val();
		 	var totalakhir = 0;
		 	if(diskon == "0"){totalakhir = subtotal};
		 	if(diskon == "10"){totalakhir = subtotal - (subtotal * 0.1)};
		 	if(diskon == "25"){totalakhir = subtotal -(subtotal * 0.25)};
		 	if(diskon == "50"){totalakhir = subtotal -(subtotal * 0.50)};
		 	$("#ttotalakhir").val(totalakhir);
		 	$("#tbayar").focus();

		 	var totalakhir = parseInt($("#ttotalakhir").val());
		 	var bayar = parseInt($("#tbayar").val());
		 	var kembalian = 0;
		 	if (bayar < totalakhir) { kembalian="";};
		 	if (bayar > totalakhir) { kembalian = bayar - totalakhir;};
		 	$("#tkembalian").val(kembalian);
		 });

		 $("#tbayar").keyup(function(){
		 	var totalakhir = parseInt($("#ttotalakhir").val());
		 	var bayar = parseInt($("#tbayar").val());
		 	var kembalian = 0;
		 	if (bayar < totalakhir) { kembalian="";};
		 	if (bayar > totalakhir) { kembalian = bayar - totalakhir;};
		 	$("#tkembalian").val(kembalian);
		 });

		 $("#pembayaran").click(function(){
		 	$("#tdiskon").focus();
		 });
	</script>
</body>	
</html>