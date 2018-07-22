<?php 
	@$no_transaksi = $_GET['no_transaksi'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="window=device-width, initial-scale=1">
	<title>Detail Transaksi Penjualan</title>
</head>
<body>
<br><br><br><br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">Detail Transaksi Penjualan - <?php echo @$no_transaksi ?></div>
			<div class="panel-body">
				<div class="tanle-responsice">
					<table class="table table-bordered table-striped table-hover">
						<thead id="pri">
							<th width="5%">No.</th>
							<th width="12%">Kode Barang</th>
							<th>Nama Barang</th>
							<th>Harga Barang</th>
							<th>Jumlah Beli</th>
							<th>Total Harga</th>
						</thead>
						<tbody>
							<?php  
								@$b = $aksi->tampil("tbl_transaksi_detail","WHERE no_transaksi = '$no_transaksi'","");
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
							</tr>
							<?php }}?>
							<?php 
								@$sql = mysql_fetch_array(mysql_query("SELECT * FROM tbl_transaksi WHERE no_transaksi = '$no_transaksi'"));
								@$subtotal = $sql['subtotal'];
								@$diskon = $sql['diskon']; 
								@$total_akhir = $sql['total_akhir']; 
								@$bayar = $sql['bayar']; 
								@$kembalian = $sql['kembalian']; 

							 ?>
							<tr style="background-color: rgba(44, 62, 80, 0.1);">
								<td  colspan="5" align="right"><b id="blue">TOTAL KESELURUHAN</b></td>
								<td align="right"><b >Rp. <?php echo number_format(@$subtotal, 0,'','.'); ?></b></td>
							</tr>
							<tr style="background-color: rgba(44, 62, 80, 0.07);">
								<td colspan="5" align="right"><b id="blue">DISKON</b></td>
								<td  align="right"><b id="blue"><?php echo @$diskon?> %</b></td>
							</tr>
							<tr style="background-color: rgba(44, 62, 80, 0.1);">
								<td colspan="5" align="right"><b id="blue">TOTAL AKHIR</b></td>
								<td align="right"><b >Rp. <?php echo number_format(@$total_akhir, 0,'','.'); ?></b></td>
							</tr>
							<tr style="background-color: rgba(44, 62, 80, 0.07">
								<td colspan="5" align="right"><b id="blue">BAYAR</b></td>
								<td align="right"><b id="blue">Rp. <?php echo number_format(@$bayar, 0,'','.'); ?></b></td>
							</tr>
							<tr style="background-color: rgba(44, 62, 80, 0.1);">
								<td colspan="5" align="right"><b id="blue">KEMBALIAN</b></td>
								<td align="right"><b id="blue">Rp. <?php echo number_format(@$kembalian, 0,'','.'); ?></b></td>
							</tr>							
						</tbody>
					</table>
				</div>
				<form method="post">
					<a href="../transaksi/transaksi_print.php?no_transaksi=<?php echo @$no_transaksi; ?>" target="_blank" class="btn btn-block btn-primary"><h4><b>C&nbsp;E&nbsp;T&nbsp;A&nbsp;K&nbsp;&nbsp;&nbsp;S&nbsp;T&nbsp;R&nbsp;U&nbsp;K&nbsp;&nbsp;&nbsp;&nbsp;P&nbsp;E&nbsp;N&nbsp;J&nbsp;U&nbsp;A&nbsp;L&nbsp;A&nbsp;N</b></h4></a>
					<a href="?menu=daftarpenjualan" class="btn btn-block btn-default"><h4><b>K&nbsp;E&nbsp;M&nbsp;B&nbsp;A&nbsp;L&nbsp;I</b></h4></a>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>