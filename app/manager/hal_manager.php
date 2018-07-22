<?php  
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MANAGER</title>
</head>
<body>
<br><br><br><br><br>
	<div class="container">
		<div class="alert alert-dismissible alert-warning">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Login Berhasil !<b><?php echo $_SESSION['nama']; ?></b></strong>
		  <br>
			Pilih Menu Untuk Menjalankan Aplikasi ini,Jika Anda Ingin keluar,klik <a href="?logout" onclick="return confirm('Apakah Anda yakin akan keluar dari akun ?');"><span id="blue"><b>Disini</b></span></a>
		</div>
		<div class="jumbotron" style="background-color:rgba(50, 100, 250, 0.1);">
			<div class="container">
				<h2>Selamat Datang, <b><?php echo $_SESSION['nama']; ?></b> di Halaman Manager</h2>
				<p>PIlih Menu untuk menjalankan Aplikasi ini. Jika Anda ingin keluar,klik <a href="?logout" onclick="return confirm('Apakah Anda yakin akan keluar dari akun ?');">disini</a></p>
			</div>
		</div>
	</div>
</body>
</html>