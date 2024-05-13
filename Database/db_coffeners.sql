-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_coffeners.tb_bayar
CREATE TABLE IF NOT EXISTS `tb_bayar` (
  `id_bayar` bigint NOT NULL,
  `nominal_uang` bigint DEFAULT NULL,
  `total_bayar` bigint DEFAULT NULL,
  `waktu_bayar` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_coffeners.tb_bayar: ~6 rows (approximately)
INSERT INTO `tb_bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
	(24042300703, 50000, 50000, '2024-04-27 15:15:10'),
	(24042319336, 100000, 50000, '2024-04-24 13:33:04'),
	(24042323846, 100000, 90000, '2024-04-24 13:28:50'),
	(24042421160, 100000, 75000, '2024-04-27 15:16:00'),
	(24042421181, 30000, 25000, '2024-04-24 14:11:47'),
	(24042421379, 50000, 40000, '2024-04-25 06:28:36'),
	(24050710185, 100000, 75000, '2024-05-07 03:49:54');

-- Dumping structure for table db_coffeners.tb_daftar_menu
CREATE TABLE IF NOT EXISTS `tb_daftar_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama_menu` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `keterangan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kategori` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_coffeners.tb_daftar_menu: ~11 rows (approximately)
INSERT INTO `tb_daftar_menu` (`id`, `gambar`, `nama_menu`, `keterangan`, `kategori`, `harga`) VALUES
	(2, '2.png', 'Burger', 'Daging Wahyu A5', 1, 15000),
	(3, '3.png', 'Kare Kambing', 'Kambing Himalaya', 1, 15000),
	(4, '4.png', 'Kopi Susu', 'Bikin Relax', 2, 10000),
	(9, '80159-10.png', 'Teh Jawa', 'Dari daun teh pilihan', 2, 10000),
	(13, '10027-5.png', 'Es Jeruk Nipis', 'Dengan tingkat keasaman tinggi', 2, 10000),
	(17, '92240-13.png', 'Juss Jeruk', 'Dari Jeruk Aarab', 2, 10000),
	(19, '10001-14.png', 'Kepiting Saus Tiram', 'Kepiting dari samudra atlantis', 1, 35000),
	(20, '65913-12.png', 'Juss Mangga', 'Dari mangga masak pohon', 2, 10000),
	(21, '76566-7.png', 'Bakso Mas Roy', 'Bakso Tanpa Tepung', 1, 20000),
	(22, '33703-1.png', 'Mie Pedas', 'Pedasnya Bikin Nagih', 1, 15000),
	(23, '54473-9.png', 'Lontong soto', 'enak', 1, 15000);

-- Dumping structure for table db_coffeners.tb_list_order
CREATE TABLE IF NOT EXISTS `tb_list_order` (
  `id_list_order` int NOT NULL AUTO_INCREMENT,
  `menu` int DEFAULT NULL,
  `kode_order` bigint DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id_list_order`),
  KEY `menu` (`menu`),
  KEY `order` (`kode_order`) USING BTREE,
  CONSTRAINT `FK_tb_list_order_tb_daftar_menu` FOREIGN KEY (`menu`) REFERENCES `tb_daftar_menu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_tb_list_order_tb_order` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table db_coffeners.tb_list_order: ~18 rows (approximately)
INSERT INTO `tb_list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `status`) VALUES
	(1, 2, 24042300703, 2, 2),
	(2, 2, 24042319336, 2, 2),
	(3, 13, 24042319336, 2, 2),
	(6, 9, 24042300703, 2, 2),
	(9, 17, 24042323846, 3, 2),
	(10, 2, 24042323846, 4, 2),
	(13, 2, 24042421181, 1, 2),
	(14, 17, 24042421181, 1, 2),
	(16, 4, 24042421379, 4, 2),
	(18, 3, 24042421160, 3, 2),
	(20, 4, 24042421160, 2, 2),
	(21, 9, 24042421160, 1, 2),
	(27, 21, 24042621950, 3, NULL),
	(28, 17, 24042621950, 2, NULL),
	(29, 20, 24042621950, 1, NULL),
	(30, 23, 24050710185, 3, 2),
	(31, 20, 24050710185, 2, 2),
	(32, 17, 24050710185, 1, 2);

-- Dumping structure for table db_coffeners.tb_order
CREATE TABLE IF NOT EXISTS `tb_order` (
  `id_order` bigint NOT NULL DEFAULT '0',
  `pelanggan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `meja` int DEFAULT NULL,
  `pelayan` int DEFAULT NULL,
  `waktu_order` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_order`) USING BTREE,
  KEY `pelayan` (`pelayan`),
  CONSTRAINT `FK_tb_order_tb_userc` FOREIGN KEY (`pelayan`) REFERENCES `tb_userc` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_coffeners.tb_order: ~6 rows (approximately)
INSERT INTO `tb_order` (`id_order`, `pelanggan`, `meja`, `pelayan`, `waktu_order`) VALUES
	(24042300703, 'Valdo', 7, 8, '2024-04-24 14:08:51'),
	(24042319336, 'Novas', 9, 8, '2024-04-24 14:08:54'),
	(24042323846, 'Septian', 3, 8, '2024-04-23 16:31:19'),
	(24042421160, 'Cahya', 3, 8, '2024-04-24 14:21:44'),
	(24042421181, 'Budi', 2, 8, '2024-04-24 14:11:02'),
	(24042421379, 'Tasya', 1, 8, '2024-04-24 14:15:21'),
	(24042621950, 'Alfado', 5, 3, '2024-04-26 14:07:04'),
	(24050710185, 'Noval', 3, 8, '2024-05-07 03:47:38');

-- Dumping structure for table db_coffeners.tb_userc
CREATE TABLE IF NOT EXISTS `tb_userc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `username` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `leveluser` int DEFAULT NULL,
  `telepon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_coffeners.tb_userc: ~5 rows (approximately)
INSERT INTO `tb_userc` (`id`, `nama`, `username`, `password`, `leveluser`, `telepon`) VALUES
	(1, ' Admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '081223998007'),
	(2, ' Hana', 'kasir@kasir.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '085124537895'),
	(3, 'Cahya', 'pelayan@pelayan.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, '085478936785'),
	(4, '  Ima', 'dapur@dapur.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, '081488299874'),
	(8, ' Nova', 'novaseptian@gmail.com', 'df5e19a3690bb58c4d459193b04b55f6', 1, '         081230990881');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
