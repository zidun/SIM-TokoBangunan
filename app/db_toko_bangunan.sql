-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2017 at 01:46 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_toko_bangunan`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_barang`
--
CREATE TABLE IF NOT EXISTS `qw_barang` (
`kd_barang` varchar(9)
,`nama_barang` varchar(50)
,`id_jenis` int(11)
,`satuan` varchar(25)
,`stok` int(11)
,`harga_pokok` int(11)
,`ppn` int(11)
,`harga_jual` int(11)
,`jenis` varchar(25)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_barang_masuk`
--
CREATE TABLE IF NOT EXISTS `qw_barang_masuk` (
`kd_barang_masuk` varchar(11)
,`kd_supplier` varchar(6)
,`kd_barang` varchar(9)
,`nama_barang` varchar(50)
,`satuan` varchar(25)
,`harga` int(11)
,`jumlah` int(11)
,`total_harga` int(11)
,`tanggal` date
,`nama_supplier` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `qw_transaksi`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_toko_bangunan`.`qw_transaksi` AS select `db_toko_bangunan`.`tbl_transaksi`.`no_transaksi` AS `no_transaksi`,`db_toko_bangunan`.`tbl_transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`db_toko_bangunan`.`tbl_transaksi`.`waktu` AS `waktu`,`db_toko_bangunan`.`tbl_transaksi`.`id_kasir` AS `id_kasir`,`db_toko_bangunan`.`tbl_transaksi`.`subtotal` AS `subtotal`,`db_toko_bangunan`.`tbl_transaksi`.`diskon` AS `diskon`,`db_toko_bangunan`.`tbl_transaksi`.`total_akhir` AS `total_akhir`,`db_toko_bangunan`.`tbl_transaksi`.`bayar` AS `bayar`,`db_toko_bangunan`.`tbl_transaksi`.`kembalian` AS `kembalian`,`db_toko_bangunan`.`tbl_user`.`nama_user` AS `nama_kasir` from (`db_toko_bangunan`.`tbl_transaksi` join `db_toko_bangunan`.`tbl_user` on((`db_toko_bangunan`.`tbl_user`.`username` = `db_toko_bangunan`.`tbl_transaksi`.`id_kasir`)));

--
-- Dumping data for table `qw_transaksi`
--

INSERT INTO `qw_transaksi` (`no_transaksi`, `tgl_transaksi`, `waktu`, `id_kasir`, `subtotal`, `diskon`, `total_akhir`, `bayar`, `kembalian`, `nama_kasir`) VALUES
('03042017001', '2017-04-04', '2017-04-04 10:54:49', 'kasir', 20027500, 50, 10013750, 20100000, 10086250, 'Muhammad zidun '),
('03042017002', '2017-04-04', '2017-04-04 11:00:55', 'kasir', 660000, 50, 330000, 400000, 70000, 'Muhammad zidun '),
('04042017003', '2017-04-04', '2017-04-04 10:48:07', 'kasir', 23760, 0, 23760, 30000, 6240, 'Muhammad zidun '),
('03042017004', '2017-04-04', '2017-04-04 09:39:42', 'kasir', 55000, 0, 55000, 100000, 45000, 'Muhammad zidun '),
('04042017001', '2017-04-04', '2017-04-04 09:39:24', 'kasir', 1320000, 0, 1320000, 2000000, 680000, 'Muhammad zidun '),
('04042017002', '2017-04-04', '2017-04-04 09:39:02', 'kasir', 27500000, 0, 27500000, 27500000, 0, 'Muhammad zidun '),
('06042017001', '2017-04-06', '2017-04-06 14:05:34', 'kasir', 27720000, 0, 27720000, 27800000, 80000, 'Muhammad zidun '),
('07042017001', '2017-04-07', '2017-04-06 20:40:08', 'kasir', 110000, 0, 110000, 120000, 10000, 'Muhammad zidun '),
('07042017002', '2017-04-07', '2017-04-06 20:45:52', 'kasir', 550000, 0, 550000, 600000, 50000, 'Muhammad zidun '),
('07042017003', '2017-04-07', '2017-04-06 20:49:58', 'kasir', 550000, 0, 550000, 650000, 100000, 'Muhammad zidun '),
('07042017004', '2017-04-07', '2017-04-06 22:38:01', 'kasir', 550000, 0, 550000, 600000, 50000, 'Muhammad zidun '),
('07042017007', '2017-04-07', '2017-04-06 23:44:57', 'kasir', 55116600, 0, 55116600, 55200000, 83400, 'Muhammad zidun '),
('07042017006', '2017-04-07', '2017-04-06 22:39:01', 'kasir', 550000, 0, 550000, 550000, 0, 'Muhammad zidun '),
('07042017008', '2017-04-07', '2017-04-06 23:52:05', 'kasir', 110000, 0, 110000, 110000, 0, 'Muhammad zidun '),
('07042017009', '2017-04-07', '2017-04-06 23:56:44', 'kasir', 550000, 0, 550000, 600000, 50000, 'Muhammad zidun '),
('07042017010', '2017-04-07', '2017-04-06 23:57:10', 'kasir', 550000, 0, 550000, 600000, 50000, 'Muhammad zidun '),
('07042017011', '2017-04-07', '2017-04-06 23:57:32', 'kasir', 1980, 0, 1980, 2000, 20, 'Muhammad zidun '),
('07042017012', '2017-04-07', '2017-04-07 02:24:47', 'kasir', 5500, 0, 5500, 100000, 94500, 'Muhammad zidun '),
('07042017013', '2017-04-07', '2017-04-07 02:51:56', 'kasir', 555000, 0, 555000, 600000, 45000, 'Muhammad zidun '),
('07042017014', '2017-04-07', '2017-04-07 02:59:43', 'kasir', 19800, 10, 17820, 100000, 82180, 'Muhammad zidun '),
('07042017015', '2017-04-07', '2017-04-07 14:17:26', 'kasir', 1980, 0, 1980, 2000, 20, 'Muhammad zidun '),
('08042017001', '2017-04-08', '2017-04-07 17:23:25', 'kasir', 5500, 0, 5500, 6000, 500, 'Muhammad zidun '),
('08042017002', '2017-04-08', '2017-04-07 17:24:39', 'kasir', 66000, 0, 66000, 70000, 4000, 'Muhammad zidun '),
('08042017003', '2017-04-08', '2017-04-07 17:25:22', 'kasir', 66000, 0, 66000, 70000, 4000, 'Muhammad zidun '),
('08042017004', '2017-04-08', '2017-04-07 17:28:33', 'kasir', 1118700, 10, 1006830, 1100000, 93170, 'Muhammad zidun '),
('08042017005', '2017-04-08', '2017-04-07 19:44:40', 'kasir', 55055000, 0, 55055000, 100000000, 44945000, 'Muhammad zidun '),
('08042017006', '2017-04-08', '2017-04-07 17:40:54', 'kasir', 5500, 0, 5500, 6000, 500, 'Muhammad zidun '),
('08042017007', '2017-04-08', '2017-04-07 17:43:48', 'kasir', 50000, 0, 50000, 50000, 0, 'Muhammad zidun '),
('08042017008', '2017-04-08', '2017-04-07 17:57:41', 'kasir', 1100000, 0, 1100000, 1100000, 0, 'Muhammad zidun '),
('08042017009', '2017-04-08', '2017-04-07 18:49:46', 'kasir', 110000, 0, 110000, 110000, 0, 'Muhammad zidun '),
('08042017010', '2017-04-08', '2017-04-07 18:51:02', 'kasir', 5500000, 0, 5500000, 5500000, 0, 'Muhammad zidun '),
('08042017011', '2017-04-08', '2017-04-07 19:01:58', 'kasir', 50278880, 0, 50278880, 50300000, 21120, 'Muhammad zidun '),
('08042017012', '2017-04-08', '2017-04-07 19:10:15', 'kasir', 247500, 0, 247500, 300000, 52500, 'Muhammad zidun '),
('08042017013', '2017-04-08', '2017-04-07 21:02:22', 'kasir', 110000, 0, 110000, 1000000, 890000, 'Muhammad zidun '),
('08042017014', '2017-04-08', '2017-04-07 21:27:13', 'kasir', 19800, 50, 9900, 10000, 100, 'Muhammad zidun '),
('08042017015', '2017-04-08', '2017-04-08 09:29:46', 'kasir', 220000, 0, 220000, 220000, 0, 'Muhammad zidun '),
('09042017001', '2017-04-09', '2017-04-08 15:33:03', 'kasir', 16000, 0, 16000, 16000, 0, 'Muhammad zidun '),
('12042017001', '2017-04-12', '2017-04-12 04:20:26', 'kasir', 59800, 0, 59800, 60000, 200, 'Muhammad zidun '),
('10042017002', '2017-04-10', '2017-04-10 11:40:07', 'kasir', 4000, 0, 4000, 4000, 0, 'Muhammad zidun '),
('15042017001', '2017-04-15', '2017-04-15 05:09:00', 'kasir', 315000, 0, 315000, 320000, 5000, 'Muhammad zidun '),
('15042017002', '2017-04-15', '2017-04-15 05:33:48', 'kasir', 5700000, 10, 5130000, 5200000, 70000, 'Muhammad zidun '),
('16042017001', '2017-04-16', '2017-04-15 16:36:36', 'kasir', 540000, 0, 540000, 540000, 0, 'Muhammad zidun '),
('16042017002', '2017-04-16', '2017-04-16 14:43:34', 'kasir', 550000, 0, 550000, 550000, 0, 'Muhammad zidun '),
('17042017001', '2017-04-17', '2017-04-17 03:24:29', 'kasir', 590000, 0, 590000, 600000, 10000, 'Muhammad zidun '),
('21042017001', '2017-04-21', '2017-04-20 14:05:42', 'kasir', 178200, 10, 160380, 170000, 9620, 'Muhammad zidun '),
('24042017001', '2017-04-24', '2017-04-23 15:10:25', 'kasir', 550000, 0, 550000, 600000, 50000, 'Muhammad zidun '),
('26042017001', '2017-04-26', '2017-04-25 15:38:49', 'kasir', 3890000, 0, 3890000, 4000000, 110000, 'Muhammad zidun '),
('27042017001', '2017-04-27', '2017-04-26 12:21:40', 'kasir', 590000, 0, 590000, 600000, 10000, 'Muhammad zidun '),
('28042017001', '2017-04-28', '2017-04-28 04:30:34', 'kasir', 1140000, 10, 1026000, 7000000, 5974000, 'Muhammad zidun '),
('28042017002', '2017-04-28', '2017-04-28 04:34:36', 'kasir', 570000, 0, 570000, 600000, 30000, 'Muhammad zidun '),
('28042017003', '2017-04-28', '2017-04-28 04:38:53', 'kasir', 6040000, 25, 4530000, 70000000, 65470000, 'Muhammad zidun '),
('29042017001', '2017-04-29', '2017-04-28 17:44:32', 'kasir', 54819800, 0, 54819800, 60000000, 5180200, 'Muhammad zidun '),
('05052017001', '2017-05-05', '2017-05-04 18:29:10', 'kasir', 5540000, 0, 5540000, 5550000, 10000, 'Muhammad zidun '),
('09052017001', '2017-05-09', '2017-05-08 10:15:20', 'kasir', 248000, 0, 248000, 250000, 2000, 'Muhammad zidun '),
('09052017002', '2017-05-09', '2017-05-08 10:37:32', 'kasir', 4000, 0, 4000, 5000, 1000, 'Muhammad zidun '),
('15052017001', '2017-05-15', '2017-05-14 14:16:44', 'kasir', 362000, 50, 181000, 190000, 9000, 'Muhammad zidun '),
('17052017001', '2017-05-17', '2017-05-16 14:43:33', 'kasir', 28000, 0, 28000, 30000, 2000, 'Muhammad zidun '),
('17052017002', '2017-05-17', '2017-05-16 17:56:31', 'kasir', 47300, 0, 47300, 50000, 2700, 'Muhammad zidun '),
('17052017003', '2017-05-17', '2017-05-16 18:02:48', 'kasir', 40000, 0, 40000, 40000, 0, 'Muhammad zidun '),
('18052017001', '2017-05-18', '2017-05-17 17:56:19', 'kasir', 1265000, 0, 1265000, 1300000, 35000, 'Muhammad zidun '),
('18052017002', '2017-05-18', '2017-05-17 23:39:51', 'kasir', 1875000, 0, 1875000, 1900000, 25000, 'Muhammad zidun '),
('18052017003', '2017-05-18', '2017-05-17 23:56:00', 'kasir', 457820, 0, 457820, 500000, 42180, 'Muhammad zidun '),
('16042017003', '2017-04-16', '2017-04-16 14:45:17', 'admin', 825000, 0, 825000, 830000, 5000, 'Muhammad Ramdan'),
('21042017002', '2017-04-22', '2017-04-21 17:46:40', 'ramdan', 700000, 0, 700000, 700000, 0, 'Kasir Ganteng'),
('22042017001', '2017-04-22', '2017-04-21 17:45:41', 'ramdan', 51050000, 10, 45945000, 46000000, 55000, 'Kasir Ganteng');

-- --------------------------------------------------------

--
-- Table structure for table `qw_user`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_toko_bangunan`.`qw_user` AS select `db_toko_bangunan`.`tbl_user`.`id_user` AS `id_user`,`db_toko_bangunan`.`tbl_user`.`nama_user` AS `nama_user`,`db_toko_bangunan`.`tbl_user`.`jk_user` AS `jk_user`,`db_toko_bangunan`.`tbl_user`.`alamat_user` AS `alamat_user`,`db_toko_bangunan`.`tbl_user`.`no_telp_user` AS `no_telp_user`,`db_toko_bangunan`.`tbl_user`.`username` AS `username`,`db_toko_bangunan`.`tbl_user`.`password` AS `password`,`db_toko_bangunan`.`tbl_user`.`type_user` AS `type_user`,`db_toko_bangunan`.`tbl_type_user`.`jabatan` AS `jabatan` from (`db_toko_bangunan`.`tbl_user` join `db_toko_bangunan`.`tbl_type_user` on((`db_toko_bangunan`.`tbl_type_user`.`type_user` = `db_toko_bangunan`.`tbl_user`.`type_user`)));

--
-- Dumping data for table `qw_user`
--

INSERT INTO `qw_user` (`id_user`, `nama_user`, `jk_user`, `alamat_user`, `no_telp_user`, `username`, `password`, `type_user`, `jabatan`) VALUES
(1, 'Muhammad', 'Laki-Laki', 'Kp.Sukabirus RT.01/01 Desa Sukamahi,Kec.Megamendung', '083811941421', 'ZIdun', 'Zidun123', 1, 'Manager'),
(3, 'Muhammad zidun ', 'Laki-Laki', 'Kp.sukabirus ', '08381187323', 'kasir', 'kasir123', 3, 'Kasir'),
(4, 'Muhammad Ramdan', 'Laki-Laki', 'Di Komputer INI', '0998123134', 'admin', 'admin123', 2, 'Admin'),
(5, 'Manager Jakat', 'Perempuan', 'jl. raya cianjur', '01231504', 'Manager', 'Manager123', 1, 'Manager'),
(7, 'Kasir Ganteng', 'Laki-Laki', 'kp. Sukabirus RT 01/01', '0912838412449', 'ramdan', 'ramdan123', 3, 'Kasir'),
(8, 'Koko Pecinta Motor', 'Laki-Laki', 'bojong nyocok', '087812347363', 'koko', 'koko123', 2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kd_barang` varchar(9) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kd_barang`, `nama_barang`, `id_jenis`, `satuan`, `stok`, `harga_pokok`, `ppn`, `harga_jual`) VALUES
('BRG000001', 'Paku 4cm', 1, 'per-kg', 8, 4000, 0, 4000),
('BRG000002', 'paku payung', 1, 'per-dus', 60, 1800, 180, 1980),
('BRG000003', 'Besi Beton', 4, 'per-meter', 40, 50000, 5000, 55000),
('BRG000004', 'Keramik 16 X !6', 7, 'per-dus', 8, 50000, 0, 50000),
('BRG000005', 'Keramik 2', 7, 'per-dus', 73, 50000, 5000, 55000),
('BRG000013', 'Pipa 10cm', 8, 'meter', 40, 12000, 1200, 13200),
('BRG000016', 'Saklar Listrik', 3, 'pcs', 60, 10000, 1000, 11000),
('BRG000006', 'triplek 3 meter', 5, 'per-meter', 17, 100000, 10000, 110000),
('BRG000007', 'kaca 2 x 3 meter', 6, 'per-meter', 43, 25000, 2500, 27500),
('BRG000008', 'semen tiga roda 50kg', 5, 'zak', 285, 50000, 5000, 55000),
('BRG000009', 'besi baja', 4, 'batang', 59, 200000, 0, 200000),
('BRG000010', 'kabel kawat ', 3, 'meter', 129, 20000, 2000, 22000),
('BRG000011', 'palu besi', 4, 'buah', 100, 25000, 2500, 27500),
('BRG000012', 'lampu 25 wat philips', 3, 'pcs', 110, 20000, 2000, 22000),
('BRG000015', 'drup penguin 100 liter', 13, 'pcs', 100, 500000, 0, 500000),
('BRG000019', 'Asbes ', 16, 'pcs', 100, 100000, 10000, 110000),
('BRG000017', 'Sapu', 12, 'pcs', 50, 5000, 500, 5500),
('BRG000018', 'Djabesmetn 2 meter hijau', 13, 'pcs', 140, 300000, 30000, 330000),
('BRG000020', 'A', 13, 'meter', 10, 2222, 222, 2444),
('BRG000021', 'kloset duduk sedang', 17, 'pcs', 110, 450000, 45000, 495000),
('BRG000022', 'asdfasd', 12, 'kg', 110, 10000, 1000, 11000),
('BRG000023', 'besik 7 cm', 4, 'pcs', 100, 400000, 0, 400000),
('BRG000024', 'Asbes 1x2 meter', 13, 'm', 100, 50000, 0, 50000),
('BRG000025', 'air accu', 27, 'liter', 30, 10000, 1000, 11000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_masuk`
--

CREATE TABLE IF NOT EXISTS `tbl_barang_masuk` (
  `kd_barang_masuk` varchar(11) NOT NULL,
  `kd_supplier` varchar(6) NOT NULL,
  `kd_barang` varchar(9) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`kd_barang_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`kd_barang_masuk`, `kd_supplier`, `kd_barang`, `nama_barang`, `satuan`, `harga`, `jumlah`, `total_harga`, `tanggal`) VALUES
('0905BELI001', 'SPL005', 'BRG000025', 'air accu', 'liter', 10000, 50, 500000, '2017-05-09'),
('1004BELI001', 'SPL001', 'BRG000003', 'Besi Beton', 'per-meter', 50000, 100, 5000000, '2017-04-10'),
('1004BELI002', 'SPL002', 'BRG000018', 'Djabesmetn 2 meter hijau', 'pcs', 300000, 10, 3000000, '2017-04-10'),
('1004BELI003', 'SPL002', 'BRG000018', 'Djabesmetn 2 meter hijau', 'pcs', 300000, 100, 30000000, '2017-04-10'),
('1004BELI004', 'SPL001', 'BRG000007', 'kaca 2 x 3 meter', 'per-meter', 25000, 20, 500000, '2017-04-10'),
('1204BELI001', 'SPL012', 'BRG000010', 'kabel kawat ', 'meter', 20000, 100, 2000000, '2017-04-12'),
('1305BELI001', 'SPL003', 'BRG000001', 'Paku 4cm', 'per-kg', 4000, 10, 40000, '2017-05-13'),
('1305BELI002', 'SPL002', 'BRG000004', 'Keramik 16 X !6', 'per-dus', 50000, 12, 600000, '2017-05-13'),
('1404BELI001', 'SPL001', 'BRG000007', 'kaca 2 x 3 meter', 'per-meter', 25000, 11, 275000, '2017-04-14'),
('1404BELI002', 'SPL003', 'BRG000007', 'kaca 2 x 3 meter', 'per-meter', 25000, 10, 250000, '2017-04-14'),
('1404BELI003', 'SPL003', 'BRG000018', 'Djabesmetn 2 meter hijau', 'pcs', 300000, 10, 3000000, '2017-04-14'),
('1404BELI004', 'SPL003', 'BRG000018', 'Djabesmetn 2 meter hijau', 'pcs', 300000, 10, 3000000, '2017-04-14'),
('1504BELI001', 'SPL001', 'BRG000019', 'Asbes ', 'pcs', 100000, 100, 10000000, '2017-04-15'),
('1604BELI001', 'SPL002', 'BRG000001', 'Paku 4cm', 'per-kg', 4000, 100, 400000, '2017-04-16'),
('1704BELI001', 'SPL007', 'BRG000021', 'kloset duduk sedang', 'pcs', 450000, 10, 4500000, '2017-04-17'),
('1705BELI001', 'SPL003', 'BRG000001', 'Paku 4cm', 'per-kg', 4000, 10, 40000, '2017-05-17'),
('1805BELI002', 'SPL013', 'BRG000022', 'asdfasd', 'kg', 10000, 100, 1000000, '2017-05-18'),
('1805BELI003', 'SPL009', 'BRG000026', 'pipa pvc 10 m', 'metee', 100000, 100, 10000000, '2017-05-18'),
('2104BELI001', 'SPL003', 'BRG000004', 'Keramik 16 X !6', 'per-dus', 50000, 10, 500000, '2017-04-21'),
('2104BELI002', 'SPL002', 'BRG000021', 'kloset duduk sedang', 'pcs', 450000, 100, 45000000, '2017-04-21'),
('2104BELI003', 'SPL001', 'BRG000002', 'paku payung', 'per-dus', 1800, 100, 180000, '2017-04-21'),
('2104BELI004', 'SPL001', 'BRG000020', 'A', '100', 2222, 10, 22220, '2017-04-21'),
('2604BELI001', 'SPL007', 'BRG000022', 'asdfasd', 'kg', 10000, 10, 100000, '2017-04-26'),
('2604BELI002', 'SPL007', 'BRG000023', 'besik 7 cm', 'pcs', 400000, 100, 40000000, '2017-04-26'),
('2604BELI003', 'SPL011', 'BRG000024', 'Asbes 1x2 meter', 'm', 50000, 100, 5000000, '2017-04-26');

--
-- Triggers `tbl_barang_masuk`
--
DROP TRIGGER IF EXISTS `tambah_barangmasuk`;
DELIMITER //
CREATE TRIGGER `tambah_barangmasuk` AFTER INSERT ON `tbl_barang_masuk`
 FOR EACH ROW UPDATE tbl_barang SET stok = stok+NEW.jumlah WHERE kd_barang = NEW.kd_barang
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_barangmasuk1`;
DELIMITER //
CREATE TRIGGER `update_barangmasuk1` BEFORE UPDATE ON `tbl_barang_masuk`
 FOR EACH ROW UPDATE tbl_keuangan SET keluar = (keluar-OLD.total_harga)+NEW.total_harga WHERE id_asal = NEW.kd_barang_masuk
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_barangmasuk`;
DELIMITER //
CREATE TRIGGER `update_barangmasuk` AFTER UPDATE ON `tbl_barang_masuk`
 FOR EACH ROW UPDATE tbl_barang SET stok = (stok - OLD.jumlah) + NEW.jumlah  WHERE kd_barang = NEW.kd_barang
//
DELIMITER ;
DROP TRIGGER IF EXISTS `hapus_barangmasuk1`;
DELIMITER //
CREATE TRIGGER `hapus_barangmasuk1` BEFORE DELETE ON `tbl_barang_masuk`
 FOR EACH ROW DELETE FROM tbl_keuangan WHERE id_asal = OLD.kd_barang_masuk
//
DELIMITER ;
DROP TRIGGER IF EXISTS `hapus_barangmasuk`;
DELIMITER //
CREATE TRIGGER `hapus_barangmasuk` AFTER DELETE ON `tbl_barang_masuk`
 FOR EACH ROW UPDATE tbl_barang SET stok = stok-OLD.jumlah WHERE kd_barang = OLD.kd_barang
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis`
--

CREATE TABLE IF NOT EXISTS `tbl_jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(25) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Paku'),
(2, 'Batako'),
(3, 'Alat Alat Listrik'),
(4, 'besi'),
(5, 'kayu'),
(6, 'kaca'),
(7, 'keramik'),
(8, 'pipa'),
(9, 'cat'),
(10, 'genting'),
(11, 'batu'),
(12, 'Alat-alat Bangunan'),
(13, 'Atap rumah'),
(21, 'batu'),
(27, 'bahan kimia');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keuangan`
--

CREATE TABLE IF NOT EXISTS `tbl_keuangan` (
  `id_keuangan` int(11) NOT NULL AUTO_INCREMENT,
  `id_asal` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis_keuangan` varchar(25) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  PRIMARY KEY (`id_keuangan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `tbl_keuangan`
--

INSERT INTO `tbl_keuangan` (`id_keuangan`, `id_asal`, `tanggal`, `waktu`, `jenis_keuangan`, `masuk`, `keluar`) VALUES
(3, '03042017002', '2017-04-04', '2017-04-04 11:00:55', 'Pendapatan Harian', 38890510, 0),
(33, '15042017002', '2017-04-15', '2017-04-15 05:33:48', 'Pendapatan Harian', 5445000, 0),
(4, '06042017001', '2017-04-06', '2017-04-06 14:05:34', 'Pendapatan Harian', 27720000, 0),
(5, '07042017015', '2017-04-07', '2017-04-07 14:17:26', 'Pendapatan Harian', 59218880, 0),
(6, '08042017015', '2017-04-08', '2017-04-08 09:29:46', 'Pendapatan Harian', 113831110, 0),
(7, '', '2017-04-08', '2017-04-08 07:33:09', 'beli bensin', 0, 500000),
(12, '', '2017-04-08', '2017-04-08 08:01:43', 'Gaji Pegawai', 0, 1000000),
(9, '', '2017-04-08', '2017-04-08 07:41:47', 'Gaji Pegawai', 0, 3000000),
(10, '', '2017-04-08', '2017-04-08 07:55:39', 'Saldo Awal', 10000, 0),
(20, '', '2017-04-09', '2017-04-08 15:27:54', 'Gaji Pegawai', 0, 4000000),
(22, '1004BELI003', '2017-04-10', '2017-04-10 11:36:48', 'Pembelian Djabesmetn 2 me', 0, 30000000),
(23, '10042017002', '2017-04-10', '2017-04-10 11:40:32', 'Pendapatan Harian', 4000, 0),
(24, '1004BELI004', '2017-04-10', '2017-04-10 11:52:30', 'Pembelian kaca 2 x 3 mete', 0, 500000),
(21, '09042017001', '2017-04-09', '2017-04-08 15:33:03', 'Pendapatan Harian', 16000, 0),
(25, '12042017001', '2017-04-12', '2017-04-12 04:20:26', 'Pendapatan Harian', 59800, 0),
(26, '1204BELI001', '2017-04-12', '2017-04-12 06:40:52', 'Pembelian kabel kawat ', 0, 2000000),
(27, '1404BELI001', '2017-04-14', '2017-04-13 19:29:15', 'Pembelian kaca 2 x 3 mete', 0, 250000),
(28, '1404BELI002', '2017-04-14', '2017-04-13 23:13:00', 'Pembelian kaca 2 x 3 mete', 0, 250000),
(29, '1404BELI003', '2017-04-14', '2017-04-13 23:13:30', 'Pembelian Djabesmetn 2 me', 0, 3000000),
(30, '', '2017-04-14', '2017-04-14 13:48:15', 'makan pegawai', 0, 100000),
(31, '1404BELI004', '2017-04-14', '2017-04-14 14:24:57', 'Pembelian Djabesmetn 2 me', 0, 3000000),
(35, '1504BELI001', '2017-04-15', '2017-04-15 10:17:29', 'Pembelian Asbes ', 0, 10000000),
(36, '', '2017-04-15', '2017-04-15 10:18:11', 'ongkos kirim', 50000, 0),
(37, '16042017003', '2017-04-16', '2017-04-16 14:45:17', 'Pendapatan Harian', 1915000, 0),
(38, '1604BELI001', '2017-04-16', '2017-04-16 13:59:40', 'Pembelian Paku 4cm', 0, 400000),
(40, '17042017002', '2017-04-17', '2017-04-17 14:42:40', 'Pendapatan Harian', 590000, 0),
(41, '1704BELI001', '2017-04-17', '2017-04-17 12:52:57', 'Pembelian kloset duduk se', 0, 4500000),
(42, '2104BELI001', '2017-04-21', '2017-04-20 13:59:45', 'Pembelian Keramik 16 X !6', 0, 500000),
(43, '21042017002', '2017-04-21', '2017-04-20 23:42:18', 'Pendapatan Harian', 860380, 0),
(44, '2104BELI002', '2017-04-21', '2017-04-20 23:00:33', 'Pembelian kloset duduk se', 0, 45000000),
(45, '2104BELI003', '2017-04-21', '2017-04-21 05:26:35', 'Pembelian paku payung', 0, 180000),
(46, '2104BELI004', '2017-04-21', '2017-04-21 05:44:43', 'Pembelian A', 0, 22220),
(47, '21042017002', '2017-04-22', '2017-04-21 17:46:40', 'Pendapatan Harian', 45945000, 0),
(48, '24042017001', '2017-04-24', '2017-04-23 15:10:25', 'Pendapatan Harian', 550000, 0),
(49, '2604BELI001', '2017-04-26', '2017-04-25 13:03:09', 'Pembelian asdfasd', 0, 100000),
(50, '2604BELI002', '2017-04-26', '2017-04-25 13:46:44', 'Pembelian besik 7 cm', 0, 40000000),
(51, '26042017001', '2017-04-26', '2017-04-25 15:38:49', 'Pendapatan Harian', 3890000, 0),
(52, '2604BELI003', '2017-04-26', '2017-04-25 15:44:10', 'Pembelian Asbes 1x2 meter', 0, 5000000),
(54, '', '2017-04-26', '2017-04-25 15:45:42', 'Pembelian Bensin', 0, 150000),
(56, '27042017001', '2017-04-27', '2017-04-26 12:21:40', 'Pendapatan Harian', 590000, 0),
(57, '28042017003', '2017-04-28', '2017-04-28 04:38:53', 'Pendapatan Harian', 6126000, 0),
(59, '29042017001', '2017-04-29', '2017-04-28 17:44:32', 'Pendapatan Harian', 54819800, 0),
(60, '05052017001', '2017-05-05', '2017-05-04 18:29:10', 'Pendapatan Harian', 5540000, 0),
(61, '0905BELI001', '2017-05-09', '2017-05-08 10:01:15', 'Pembelian air accu', 0, 500000),
(62, '', '2017-05-18', '2017-05-17 19:24:20', 'Saldo Awal', 1000000, 0),
(63, '09052017002', '2017-05-09', '2017-05-08 10:37:32', 'Pendapatan Harian', 252000, 0),
(64, '1305BELI001', '2017-05-13', '2017-05-12 19:02:41', 'Pembelian Paku 4cm', 0, 40000),
(65, '1305BELI002', '2017-05-13', '2017-05-12 19:02:52', 'Pembelian Keramik 16 X !6', 0, 600000),
(66, '14052017002', '2017-05-14', '2017-05-14 14:11:17', 'Pendapatan Harian', 0, 0),
(67, '15052017001', '2017-05-15', '2017-05-14 14:16:44', 'Pendapatan Harian', 181000, 0),
(69, '17052017003', '2017-05-17', '2017-05-16 18:02:48', 'Pendapatan Harian', 115300, 0),
(70, '1705BELI001', '2017-05-17', '2017-05-16 15:58:30', 'Pembelian Paku 4cm', 0, 40000),
(74, '1805BELI003', '2017-05-18', '2017-05-17 23:33:11', 'Pembelian pipa pvc 10 m', 0, 10000000),
(72, '18052017003', '2017-05-18', '2017-05-17 23:56:00', 'Pendapatan Harian', 3597820, 0),
(73, '1805BELI002', '2017-05-18', '2017-05-17 18:26:00', 'Pembelian asdfasd', 0, 1000000),
(75, '', '2017-05-18', '2017-05-17 23:35:50', 'bensin mobil', 0, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `kd_supplier` varchar(6) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_telp_supplier` varchar(13) NOT NULL,
  PRIMARY KEY (`kd_supplier`),
  UNIQUE KEY `no_telp_supplier` (`no_telp_supplier`),
  UNIQUE KEY `kd_supplier` (`kd_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`kd_supplier`, `nama_supplier`, `alamat_supplier`, `no_telp_supplier`) VALUES
('SPL001', 'PT. Indo Jaya', 'Jl.raya Tajur N0.16 Bogor', '02511194421'),
('SPL002', 'cv.maju terus', 'Jl.Raya Sukabumi NO.50', '0218412494011'),
('SPL003', 'PT.Unitex', 'Jl.Raya Tajur No.99', '08381234142'),
('SPL004', 'PB. Sami Agung', 'Jl.Raya Wangun N0.10 Bogor', '0812353235100'),
('SPL005', 'Cv. Makmur Sentosa', 'Cengkareng,Jakarta Timur', '08781230382'),
('SPL006', 'PT.Nippon Paint', 'Jl.Ir.Soekarno-Hatta No.59 Jakarta Timur', '0213452171'),
('SPL007', 'PT. Jaya Besi', 'Jl.Raya Ciawi No.01', '02513441231'),
('SPL010', 'PT. Hanura Abadi', 'penggansaan timur no 12', '0218232914'),
('SPL009', 'PT.Wavin Indo', 'Jl.Tebet Utara Dalam No.26 Jakarta Selatan', '0212318761283'),
('SPL012', 'indo materian', 'bogor 0251', '02511123334'),
('SPL013', 'asdf', 'sdf', '234'),
('SPL011', 'Pt. bersih bersama', 'jl.cinere 12 bandung', '089739102413');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `no_transaksi` varchar(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_kasir` varchar(20) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `diskon` int(3) NOT NULL,
  `total_akhir` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`no_transaksi`, `tgl_transaksi`, `waktu`, `id_kasir`, `subtotal`, `diskon`, `total_akhir`, `bayar`, `kembalian`) VALUES
('03042017001', '2017-04-04', '2017-04-04 10:54:49', 'kasir', 20027500, 50, 10013750, 20100000, 10086250),
('03042017002', '2017-04-04', '2017-04-04 11:00:55', 'kasir', 660000, 50, 330000, 400000, 70000),
('04042017003', '2017-04-04', '2017-04-04 10:48:07', 'kasir', 23760, 0, 23760, 30000, 6240),
('03042017004', '2017-04-04', '2017-04-04 09:39:42', 'kasir', 55000, 0, 55000, 100000, 45000),
('04042017001', '2017-04-04', '2017-04-04 09:39:24', 'kasir', 1320000, 0, 1320000, 2000000, 680000),
('04042017002', '2017-04-04', '2017-04-04 09:39:02', 'kasir', 27500000, 0, 27500000, 27500000, 0),
('06042017001', '2017-04-06', '2017-04-06 14:05:34', 'kasir', 27720000, 0, 27720000, 27800000, 80000),
('07042017001', '2017-04-07', '2017-04-06 20:40:08', 'kasir', 110000, 0, 110000, 120000, 10000),
('07042017002', '2017-04-07', '2017-04-06 20:45:52', 'kasir', 550000, 0, 550000, 600000, 50000),
('07042017003', '2017-04-07', '2017-04-06 20:49:58', 'kasir', 550000, 0, 550000, 650000, 100000),
('07042017004', '2017-04-07', '2017-04-06 22:38:01', 'kasir', 550000, 0, 550000, 600000, 50000),
('07042017007', '2017-04-07', '2017-04-06 23:44:57', 'kasir', 55116600, 0, 55116600, 55200000, 83400),
('07042017006', '2017-04-07', '2017-04-06 22:39:01', 'kasir', 550000, 0, 550000, 550000, 0),
('07042017008', '2017-04-07', '2017-04-06 23:52:05', 'kasir', 110000, 0, 110000, 110000, 0),
('07042017009', '2017-04-07', '2017-04-06 23:56:44', 'kasir', 550000, 0, 550000, 600000, 50000),
('07042017010', '2017-04-07', '2017-04-06 23:57:10', 'kasir', 550000, 0, 550000, 600000, 50000),
('07042017011', '2017-04-07', '2017-04-06 23:57:32', 'kasir', 1980, 0, 1980, 2000, 20),
('07042017012', '2017-04-07', '2017-04-07 02:24:47', 'kasir', 5500, 0, 5500, 100000, 94500),
('07042017013', '2017-04-07', '2017-04-07 02:51:56', 'kasir', 555000, 0, 555000, 600000, 45000),
('07042017014', '2017-04-07', '2017-04-07 02:59:43', 'kasir', 19800, 10, 17820, 100000, 82180),
('07042017015', '2017-04-07', '2017-04-07 14:17:26', 'kasir', 1980, 0, 1980, 2000, 20),
('08042017001', '2017-04-08', '2017-04-07 17:23:25', 'kasir', 5500, 0, 5500, 6000, 500),
('08042017002', '2017-04-08', '2017-04-07 17:24:39', 'kasir', 66000, 0, 66000, 70000, 4000),
('08042017003', '2017-04-08', '2017-04-07 17:25:22', 'kasir', 66000, 0, 66000, 70000, 4000),
('08042017004', '2017-04-08', '2017-04-07 17:28:33', 'kasir', 1118700, 10, 1006830, 1100000, 93170),
('08042017005', '2017-04-08', '2017-04-07 19:44:40', 'kasir', 55055000, 0, 55055000, 100000000, 44945000),
('08042017006', '2017-04-08', '2017-04-07 17:40:54', 'kasir', 5500, 0, 5500, 6000, 500),
('08042017007', '2017-04-08', '2017-04-07 17:43:48', 'kasir', 50000, 0, 50000, 50000, 0),
('08042017008', '2017-04-08', '2017-04-07 17:57:41', 'kasir', 1100000, 0, 1100000, 1100000, 0),
('08042017009', '2017-04-08', '2017-04-07 18:49:46', 'kasir', 110000, 0, 110000, 110000, 0),
('08042017010', '2017-04-08', '2017-04-07 18:51:02', 'kasir', 5500000, 0, 5500000, 5500000, 0),
('08042017011', '2017-04-08', '2017-04-07 19:01:58', 'kasir', 50278880, 0, 50278880, 50300000, 21120),
('08042017012', '2017-04-08', '2017-04-07 19:10:15', 'kasir', 247500, 0, 247500, 300000, 52500),
('08042017013', '2017-04-08', '2017-04-07 21:02:22', 'kasir', 110000, 0, 110000, 1000000, 890000),
('08042017014', '2017-04-08', '2017-04-07 21:27:13', 'kasir', 19800, 50, 9900, 10000, 100),
('08042017015', '2017-04-08', '2017-04-08 09:29:46', 'kasir', 220000, 0, 220000, 220000, 0),
('09042017001', '2017-04-09', '2017-04-08 15:33:03', 'kasir', 16000, 0, 16000, 16000, 0),
('12042017001', '2017-04-12', '2017-04-12 04:20:26', 'kasir', 59800, 0, 59800, 60000, 200),
('10042017002', '2017-04-10', '2017-04-10 11:40:07', 'kasir', 4000, 0, 4000, 4000, 0),
('15042017001', '2017-04-15', '2017-04-15 05:09:00', 'kasir', 315000, 0, 315000, 320000, 5000),
('15042017002', '2017-04-15', '2017-04-15 05:33:48', 'kasir', 5700000, 10, 5130000, 5200000, 70000),
('16042017001', '2017-04-16', '2017-04-15 16:36:36', 'kasir', 540000, 0, 540000, 540000, 0),
('16042017002', '2017-04-16', '2017-04-16 14:43:34', 'kasir', 550000, 0, 550000, 550000, 0),
('16042017003', '2017-04-16', '2017-04-16 14:45:17', 'admin', 825000, 0, 825000, 830000, 5000),
('17042017001', '2017-04-17', '2017-04-17 03:24:29', 'kasir', 590000, 0, 590000, 600000, 10000),
('21042017001', '2017-04-21', '2017-04-20 14:05:42', 'kasir', 178200, 10, 160380, 170000, 9620),
('21042017002', '2017-04-22', '2017-04-21 17:46:40', 'ramdan', 700000, 0, 700000, 700000, 0),
('22042017001', '2017-04-22', '2017-04-21 17:45:41', 'ramdan', 51050000, 10, 45945000, 46000000, 55000),
('24042017001', '2017-04-24', '2017-04-23 15:10:25', 'kasir', 550000, 0, 550000, 600000, 50000),
('26042017001', '2017-04-26', '2017-04-25 15:38:49', 'kasir', 3890000, 0, 3890000, 4000000, 110000),
('27042017001', '2017-04-27', '2017-04-26 12:21:40', 'kasir', 590000, 0, 590000, 600000, 10000),
('28042017001', '2017-04-28', '2017-04-28 04:30:34', 'kasir', 1140000, 10, 1026000, 7000000, 5974000),
('28042017002', '2017-04-28', '2017-04-28 04:34:36', 'kasir', 570000, 0, 570000, 600000, 30000),
('28042017003', '2017-04-28', '2017-04-28 04:38:53', 'kasir', 6040000, 25, 4530000, 70000000, 65470000),
('29042017001', '2017-04-29', '2017-04-28 17:44:32', 'kasir', 54819800, 0, 54819800, 60000000, 5180200),
('05052017001', '2017-05-05', '2017-05-04 18:29:10', 'kasir', 5540000, 0, 5540000, 5550000, 10000),
('09052017001', '2017-05-09', '2017-05-08 10:15:20', 'kasir', 248000, 0, 248000, 250000, 2000),
('09052017002', '2017-05-09', '2017-05-08 10:37:32', 'kasir', 4000, 0, 4000, 5000, 1000),
('15052017001', '2017-05-15', '2017-05-14 14:16:44', 'kasir', 362000, 50, 181000, 190000, 9000),
('17052017001', '2017-05-17', '2017-05-16 14:43:33', 'kasir', 28000, 0, 28000, 30000, 2000),
('17052017002', '2017-05-17', '2017-05-16 17:56:31', 'kasir', 47300, 0, 47300, 50000, 2700),
('17052017003', '2017-05-17', '2017-05-16 18:02:48', 'kasir', 40000, 0, 40000, 40000, 0),
('18052017001', '2017-05-18', '2017-05-17 17:56:19', 'kasir', 1265000, 0, 1265000, 1300000, 35000),
('18052017002', '2017-05-18', '2017-05-17 23:39:51', 'kasir', 1875000, 0, 1875000, 1900000, 25000),
('18052017003', '2017-05-18', '2017-05-17 23:56:00', 'kasir', 457820, 0, 457820, 500000, 42180);

--
-- Triggers `tbl_transaksi`
--
DROP TRIGGER IF EXISTS `tambah_transaksi`;
DELIMITER //
CREATE TRIGGER `tambah_transaksi` AFTER INSERT ON `tbl_transaksi`
 FOR EACH ROW UPDATE tbl_keuangan SET id_asal = NEW.no_transaksi, masuk = masuk+NEW.total_akhir WHERE tanggal = NEW.tgl_transaksi AND jenis_keuangan = 'Pendapatan Harian'
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_transaksi`;
DELIMITER //
CREATE TRIGGER `update_transaksi` AFTER UPDATE ON `tbl_transaksi`
 FOR EACH ROW UPDATE tbl_keuangan SET id_asal = NEW.no_transaksi, masuk = (masuk-OLD.total_akhir)+NEW.total_akhir WHERE tanggal = NEW.tgl_transaksi AND jenis_keuangan = 'Pendapatan Harian'
//
DELIMITER ;
DROP TRIGGER IF EXISTS `hapus_transaksi`;
DELIMITER //
CREATE TRIGGER `hapus_transaksi` AFTER DELETE ON `tbl_transaksi`
 FOR EACH ROW UPDATE tbl_keuangan SET masuk = masuk-OLD.total_akhir WHERE tanggal = OLD.tgl_transaksi AND jenis_keuangan = 'Pendapatan Harian'
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(11) NOT NULL,
  `kd_barang` varchar(9) NOT NULL,
  `barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `banyak` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

--
-- Dumping data for table `tbl_transaksi_detail`
--

INSERT INTO `tbl_transaksi_detail` (`id`, `no_transaksi`, `kd_barang`, `barang`, `harga`, `banyak`, `total`) VALUES
(1, '03042017001', 'BRG000001', 'Paku 4cm', 5500, 5, 27500),
(17, '03042017002', 'BRG000005', 'Keramik 2', 55000, 12, 660000),
(16, '04042017002', 'BRG000008', 'semen tiga roda 50kg', 550000, 50, 27500000),
(12, '03042017004', 'BRG000001', 'Paku 4cm', 5500, 10, 55000),
(14, '04042017001', 'BRG000006', 'triplek 3 meter', 110000, 12, 1320000),
(18, '04042017003', 'BRG000002', 'paku payung', 1980, 12, 23760),
(19, '03042017001', 'BRG000009', 'besi baja', 200000, 100, 20000000),
(20, '06042017001', 'BRG000010', 'kabel kawat ', 22000, 10, 220000),
(21, '06042017001', 'BRG000008', 'semen tiga roda 50kg', 550000, 50, 27500000),
(22, '07042017001', 'BRG000006', 'triplek 3 meter', 110000, 1, 110000),
(23, '07042017002', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(24, '07042017003', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(25, '07042017004', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(26, '07042017006', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(29, '07042017007', 'BRG000002', 'paku payung', 1980, 10, 19800),
(30, '07042017007', 'BRG000008', 'semen tiga roda 50kg', 550000, 10, 5500000),
(31, '07042017007', 'BRG000002', 'paku payung', 1980, 10, 19800),
(32, '07042017007', 'BRG000001', 'Paku 4cm', 5500, 10, 55000),
(33, '07042017007', 'BRG000008', 'semen tiga roda 50kg', 550000, 90, 49500000),
(34, '07042017007', 'BRG000012', 'lampu 25 wat philips', 22000, 1, 22000),
(35, '07042017008', 'BRG000006', 'triplek 3 meter', 110000, 1, 110000),
(36, '07042017009', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(37, '07042017011', 'BRG000002', 'paku payung', 1980, 1, 1980),
(38, '07042017012', 'BRG000001', 'Paku 4cm', 5500, 1, 5500),
(40, '07042017013', 'BRG000001', 'Paku 4cm', 5500, 10, 55000),
(41, '07042017013', 'BRG000004', 'Keramik 16 X !6', 50000, 10, 500000),
(42, '07042017014', 'BRG000002', 'paku payung', 1980, 10, 19800),
(43, '07042017015', 'BRG000002', 'paku payung', 1980, 1, 1980),
(44, '08042017001', 'BRG000001', 'Paku 4cm', 5500, 1, 5500),
(45, '08042017002', 'BRG000001', 'Paku 4cm', 5500, 12, 66000),
(46, '08042017004', 'BRG000002', 'paku payung', 1980, 40, 79200),
(47, '08042017004', 'BRG000012', 'lampu 25 wat philips', 22000, 1, 22000),
(48, '08042017004', 'BRG000005', 'Keramik 2', 55000, 12, 660000),
(49, '08042017004', 'BRG000006', 'triplek 3 meter', 110000, 3, 330000),
(50, '08042017004', 'BRG000001', 'Paku 4cm', 5500, 5, 27500),
(51, '08042017005', 'BRG000001', 'Paku 4cm', 5500, 10, 55000),
(52, '08042017005', 'BRG000008', 'semen tiga roda 50kg', 550000, 100, 55000000),
(53, '08042017006', 'BRG000001', 'Paku 4cm', 5500, 1, 5500),
(54, '08042017007', 'BRG000004', 'Keramik 16 X !6', 50000, 1, 50000),
(55, '08042017008', 'BRG000006', 'triplek 3 meter', 110000, 10, 1100000),
(59, '08042017011', 'BRG000006', 'triplek 3 meter', 110000, 1, 110000),
(57, '08042017009', 'BRG000006', 'triplek 3 meter', 110000, 1, 110000),
(58, '08042017010', 'BRG000008', 'semen tiga roda 50kg', 550000, 10, 5500000),
(60, '08042017011', 'BRG000002', 'paku payung', 1980, 6, 11880),
(61, '08042017011', 'BRG000007', 'kaca 2 x 3 meter', 27500, 10, 275000),
(62, '08042017011', 'BRG000004', 'Keramik 16 X !6', 50000, 5, 250000),
(63, '08042017011', 'BRG000008', 'semen tiga roda 50kg', 550000, 90, 49500000),
(64, '08042017011', 'BRG000012', 'lampu 25 wat philips', 22000, 6, 132000),
(65, '08042017012', 'BRG000010', 'kabel kawat ', 22000, 10, 220000),
(66, '08042017012', 'BRG000007', 'kaca 2 x 3 meter', 27500, 1, 27500),
(67, '08042017013', 'BRG000006', 'triplek 3 meter', 110000, 1, 110000),
(69, '08042017014', 'BRG000002', 'paku payung', 1980, 10, 19800),
(70, '08042017015', 'BRG000001', 'Paku 4cm', 5500, 10, 55000),
(71, '08042017015', 'BRG000007', 'kaca 2 x 3 meter', 27500, 2, 55000),
(72, '08042017015', 'BRG000003', 'Besi Beton', 55000, 2, 110000),
(73, '09042017001', 'BRG000001', 'Paku 4cm', 4000, 4, 16000),
(78, '12042017001', 'BRG000002', 'paku payung', 1980, 10, 19800),
(77, '12042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(76, '10042017002', 'BRG000001', 'Paku 4cm', 4000, 1, 4000),
(81, '15042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(82, '15042017001', 'BRG000007', 'kaca 2 x 3 meter', 27500, 10, 275000),
(83, '15042017002', 'BRG000008', 'semen tiga roda 50kg', 550000, 10, 5500000),
(84, '15042017002', 'BRG000001', 'Paku 4cm', 4000, 50, 200000),
(85, '16042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(86, '16042017001', 'BRG000004', 'Keramik 16 X !6', 50000, 10, 500000),
(87, '16042017002', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(88, '16042017003', 'BRG000003', 'Besi Beton', 55000, 15, 825000),
(89, '17042017001', 'BRG000003', 'Besi Beton', 55000, 10, 550000),
(90, '17042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(96, '21042017002', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(95, '21042017001', 'BRG000002', 'paku payung', 1980, 90, 178200),
(97, '21042017002', 'BRG000003', 'Besi Beton', 55000, 12, 660000),
(98, '21042017003', 'BRG000006', 'triplek 3 meter', 110000, 10, 1100000),
(99, '21042017003', 'BRG000001', 'Paku 4cm', 4000, 3, 12000),
(100, '22042017001', 'BRG000004', 'Keramik 16 X !6', 50000, 1, 50000),
(101, '22042017001', 'BRG000008', 'semen tiga roda 50kg', 550000, 90, 49500000),
(102, '22042017001', 'BRG000004', 'Keramik 16 X !6', 50000, 30, 1500000),
(103, '23042017001', 'BRG000001', 'Paku 4cm', 4000, 1, 4000),
(104, '23042017001', 'BRG000003', 'Besi Beton', 55000, 10, 550000),
(105, '23042017001', 'BRG000002', 'paku payung', 1980, 10, 19800),
(112, '26042017001', 'BRG000006', 'triplek 3 meter', 110000, 10, 1100000),
(110, '24042017001', 'BRG000003', 'Besi Beton', 55000, 10, 550000),
(111, '26042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(113, '26042017001', 'BRG000008', 'semen tiga roda 50kg', 550000, 5, 2750000),
(114, '27042017001', 'BRG000003', 'Besi Beton', 55000, 10, 550000),
(115, '27042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(116, '28042017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(117, '28042017001', 'BRG000006', 'triplek 3 meter', 110000, 10, 1100000),
(118, '28042017002', 'BRG000006', 'triplek 3 meter', 110000, 5, 550000),
(119, '28042017002', 'BRG000001', 'Paku 4cm', 4000, 5, 20000),
(120, '28042017003', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(121, '28042017003', 'BRG000009', 'besi baja', 200000, 30, 6000000),
(127, '29042017001', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(129, '29042017001', 'BRG000002', 'paku payung', 1980, 10, 19800),
(128, '29042017001', 'BRG000009', 'besi baja', 200000, 10, 2000000),
(130, '29042017001', 'BRG000008', 'semen tiga roda 50kg', 550000, 95, 52250000),
(131, '05052017001', 'BRG000008', 'semen tiga roda 50kg', 55000, 100, 5500000),
(133, '05052017001', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(135, '09052017001', 'BRG000025', 'air accu', 11000, 20, 220000),
(136, '09052017001', 'BRG000001', 'Paku 4cm', 4000, 7, 28000),
(137, '09052017002', 'BRG000001', 'Paku 4cm', 4000, 1, 4000),
(200, '17052017001', 'BRG000001', 'Paku 4cm', 4000, 7, 28000),
(197, '15052017001', 'BRG000001', 'Paku 4cm', 4000, 3, 12000),
(198, '15052017001', 'BRG000004', 'Keramik 16 X !6', 50000, 3, 150000),
(199, '15052017001', 'BRG000009', 'besi baja', 200000, 1, 200000),
(201, '17052017002', 'BRG000002', 'paku payung', 1980, 10, 19800),
(202, '17052017002', 'BRG000007', 'kaca 2 x 3 meter', 27500, 1, 27500),
(203, '17052017003', 'BRG000001', 'Paku 4cm', 4000, 10, 40000),
(215, '18052017001', 'BRG000008', 'semen tiga roda 50kg', 55000, 10, 550000),
(216, '18052017001', 'BRG000005', 'Keramik 2', 55000, 10, 550000),
(214, '18052017001', 'BRG000003', 'Besi Beton', 55000, 3, 165000),
(219, '18052017002', 'BRG000004', 'Keramik 16 X !6', 50000, 10, 500000),
(220, '18052017002', 'BRG000006', 'triplek 3 meter', 110000, 10, 1100000),
(221, '18052017002', 'BRG000008', 'semen tiga roda 50kg', 55000, 5, 275000),
(226, '18052017003', 'BRG000002', 'paku payung', 1980, 9, 17820),
(223, '18052017003', 'BRG000006', 'triplek 3 meter', 110000, 4, 440000),
(230, '18052017004', 'BRG000002', 'paku payung', 1980, 1, 1980);

--
-- Triggers `tbl_transaksi_detail`
--
DROP TRIGGER IF EXISTS `tambah_jualbarang`;
DELIMITER //
CREATE TRIGGER `tambah_jualbarang` AFTER INSERT ON `tbl_transaksi_detail`
 FOR EACH ROW UPDATE tbl_barang SET stok = stok - NEW.banyak WHERE kd_barang = NEW.kd_barang
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_jualbarang`;
DELIMITER //
CREATE TRIGGER `update_jualbarang` AFTER UPDATE ON `tbl_transaksi_detail`
 FOR EACH ROW UPDATE tbl_barang SET stok = (stok+OLD.banyak) - NEW.banyak WHERE kd_barang =NEW.Kd_barang
//
DELIMITER ;
DROP TRIGGER IF EXISTS `hapus_jualbarang`;
DELIMITER //
CREATE TRIGGER `hapus_jualbarang` AFTER DELETE ON `tbl_transaksi_detail`
 FOR EACH ROW UPDATE tbl_barang SET stok = stok+OLD.banyak WHERE kd_barang = OLD.kd_barang
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_user`
--

CREATE TABLE IF NOT EXISTS `tbl_type_user` (
  `type_user` int(1) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(7) NOT NULL,
  PRIMARY KEY (`type_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_type_user`
--

INSERT INTO `tbl_type_user` (`type_user`, `jabatan`) VALUES
(1, 'Manager'),
(2, 'Admin'),
(3, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `jk_user` varchar(9) NOT NULL,
  `alamat_user` text NOT NULL,
  `no_telp_user` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type_user` int(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `no_telp_user` (`no_telp_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `jk_user`, `alamat_user`, `no_telp_user`, `username`, `password`, `type_user`) VALUES
(1, 'Muhammad', 'Laki-Laki', 'Kp.Sukabirus RT.01/01 Desa Sukamahi,Kec.Megamendung', '083811941421', 'ZIdun', 'Zidun123', 1),
(3, 'Muhammad zidun ', 'Laki-Laki', 'Kp.sukabirus ', '08381187323', 'kasir', 'kasir123', 3),
(4, 'Muhammad Ramdan', 'Laki-Laki', 'Di Komputer INI', '0998123134', 'admin', 'admin123', 2),
(5, 'Manager Jakat', 'Perempuan', 'jl. raya cianjur', '01231504', 'Manager', 'Manager123', 1),
(7, 'Kasir Ganteng', 'Laki-Laki', 'kp. Sukabirus RT 01/01', '0912838412449', 'ramdan', 'ramdan123', 3),
(8, 'Koko Pecinta Motor', 'Laki-Laki', 'bojong nyocok', '087812347363', 'koko', 'koko123', 2);

-- --------------------------------------------------------

--
-- Structure for view `qw_barang`
--
DROP TABLE IF EXISTS `qw_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_barang` AS select `tbl_barang`.`kd_barang` AS `kd_barang`,`tbl_barang`.`nama_barang` AS `nama_barang`,`tbl_barang`.`id_jenis` AS `id_jenis`,`tbl_barang`.`satuan` AS `satuan`,`tbl_barang`.`stok` AS `stok`,`tbl_barang`.`harga_pokok` AS `harga_pokok`,`tbl_barang`.`ppn` AS `ppn`,`tbl_barang`.`harga_jual` AS `harga_jual`,`tbl_jenis`.`jenis` AS `jenis` from (`tbl_barang` join `tbl_jenis` on((`tbl_jenis`.`id_jenis` = `tbl_barang`.`id_jenis`)));

-- --------------------------------------------------------

--
-- Structure for view `qw_barang_masuk`
--
DROP TABLE IF EXISTS `qw_barang_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_barang_masuk` AS select `tbl_barang_masuk`.`kd_barang_masuk` AS `kd_barang_masuk`,`tbl_barang_masuk`.`kd_supplier` AS `kd_supplier`,`tbl_barang_masuk`.`kd_barang` AS `kd_barang`,`tbl_barang_masuk`.`nama_barang` AS `nama_barang`,`tbl_barang_masuk`.`satuan` AS `satuan`,`tbl_barang_masuk`.`harga` AS `harga`,`tbl_barang_masuk`.`jumlah` AS `jumlah`,`tbl_barang_masuk`.`total_harga` AS `total_harga`,`tbl_barang_masuk`.`tanggal` AS `tanggal`,`tbl_supplier`.`nama_supplier` AS `nama_supplier` from (`tbl_barang_masuk` join `tbl_supplier` on((`tbl_supplier`.`kd_supplier` = `tbl_barang_masuk`.`kd_supplier`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
