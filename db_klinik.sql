-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_klinik
CREATE DATABASE IF NOT EXISTS `db_klinik` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_klinik`;

-- Dumping structure for table db_klinik.kelurahan_m
CREATE TABLE IF NOT EXISTS `kelurahan_m` (
  `id_kelurahan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelurahan` varchar(60) DEFAULT NULL,
  `nama_kecamatan` varchar(60) DEFAULT NULL,
  `nama_kota` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kelurahan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_klinik.kelurahan_m: ~1 rows (approximately)
INSERT INTO `kelurahan_m` (`id_kelurahan`, `nama_kelurahan`, `nama_kecamatan`, `nama_kota`, `created_at`, `updated_at`) VALUES
	(1, 'CIPAMOKOLAN', 'RANCASARI', 'BANDUNG4', '2023-03-12 05:01:23', '2023-03-12 05:01:23');

-- Dumping structure for table db_klinik.obat_m
CREATE TABLE IF NOT EXISTS `obat_m` (
  `id_obat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(100) NOT NULL DEFAULT '0',
  `satuan` varchar(100) NOT NULL DEFAULT '0',
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `harga` int(11) NOT NULL DEFAULT 0,
  `keterangan` text NOT NULL,
  `code` varchar(50) NOT NULL DEFAULT '',
  `statusenabled` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_obat`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_klinik.obat_m: ~2 rows (approximately)
INSERT INTO `obat_m` (`id_obat`, `nama_obat`, `satuan`, `jumlah`, `harga`, `keterangan`, `code`, `statusenabled`, `created_at`, `updated_at`) VALUES
	(1, 'yey aqqq', '7y', 2, 2000000, 'w', 'BG78', b'1', '2025-05-24 09:42:28', '2025-05-24 09:10:04'),
	(2, 'test', 'Botol', 2, 100000, '1000', 'BHO09', b'1', '2025-05-24 09:42:59', '2025-05-24 09:42:59');

-- Dumping structure for table db_klinik.orderobat_detail_t
CREATE TABLE IF NOT EXISTS `orderobat_detail_t` (
  `norec` varchar(50) NOT NULL,
  `orderfk` varchar(50) DEFAULT NULL,
  `obatfk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `keterangan` float DEFAULT NULL,
  `statusenabled` bit(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`norec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_klinik.orderobat_detail_t: ~0 rows (approximately)

-- Dumping structure for table db_klinik.orderobat_t
CREATE TABLE IF NOT EXISTS `orderobat_t` (
  `norec` varchar(50) NOT NULL,
  `tanggal_order` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` float NOT NULL DEFAULT 0,
  `pegawaifk` int(11) NOT NULL DEFAULT 0,
  `noregistrasi` varchar(50) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  `statusenabled` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`norec`),
  KEY `norec` (`norec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_klinik.orderobat_t: ~0 rows (approximately)

-- Dumping structure for table db_klinik.pasien_m
CREATE TABLE IF NOT EXISTS `pasien_m` (
  `id_pasien` varchar(15) NOT NULL COMMENT 'xxxxxx',
  `nama_pasien` varchar(80) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(2) DEFAULT NULL,
  `statusenabled` bit(1) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pasien`),
  UNIQUE KEY `id_pasien` (`id_pasien`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_klinik.pasien_m: ~3 rows (approximately)
INSERT INTO `pasien_m` (`id_pasien`, `nama_pasien`, `nik`, `alamat`, `no_telepon`, `tanggal_lahir`, `tempat_lahir`, `jenis_kelamin`, `statusenabled`, `foto`, `created_at`, `updated_at`) VALUES
	('000001', 'Rio Ferdinand', '1234567890123456', 'Jl Kebangkitan Bangsa Rt 01 Rw 08 Kel. Jatiasih Balikpapan', '088787878787', '1999-05-24', 'Balikpapan', 'L', b'1', NULL, NULL, NULL),
	('000002', 'Andika Prasetya', '3274867863274867', 'Jl Bumi Langit No 293 Sukabumi', '088743676476', '2005-05-24', 'Bandung', 'L', b'1', NULL, NULL, NULL),
	('000003', 'Yulianti Ayu Anjani', '6487632746632478', 'Komplek Pemuda Pancasila No 34 Jakarta Selatan', '083627637623', '1989-02-12', 'Jakarta', 'P', b'1', NULL, NULL, NULL);

-- Dumping structure for table db_klinik.pemeriksaan_dokter_t
CREATE TABLE IF NOT EXISTS `pemeriksaan_dokter_t` (
  `norec` varchar(50) NOT NULL,
  `norm` varchar(50) DEFAULT NULL,
  `noregistrasi` varchar(50) DEFAULT NULL,
  `namadokter` varchar(100) DEFAULT NULL,
  `pegawaifk` int(11) DEFAULT NULL,
  `tanggal_pemeriksaan` datetime DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `diagnosa` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated-at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`norec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_klinik.pemeriksaan_dokter_t: ~1 rows (approximately)
INSERT INTO `pemeriksaan_dokter_t` (`norec`, `norm`, `noregistrasi`, `namadokter`, `pegawaifk`, `tanggal_pemeriksaan`, `keluhan`, `diagnosa`, `created_at`, `updated-at`) VALUES
	('87ec725c-9262-4e1b-875c-b6baa6b728cb', '000003', '2505000002', 'Dr Septian Baskoro', 5, '2025-05-24 14:22:56', 'Pemeriksaan Ok', 'Diagnosa Ok', NULL, NULL);

-- Dumping structure for table db_klinik.pemeriksaan_perawat_t
CREATE TABLE IF NOT EXISTS `pemeriksaan_perawat_t` (
  `norec` varchar(50) NOT NULL,
  `norm` varchar(50) DEFAULT NULL,
  `noregistrasi` varchar(50) DEFAULT NULL,
  `pegawaifk` varchar(50) DEFAULT NULL,
  `tanggal_pemeriksaan` datetime DEFAULT NULL,
  `namaperawat` varchar(100) DEFAULT NULL,
  `beratbadan` float DEFAULT NULL,
  `tekanandarah` varchar(50) DEFAULT NULL,
  `tinggibadan` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`norec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_klinik.pemeriksaan_perawat_t: ~1 rows (approximately)
INSERT INTO `pemeriksaan_perawat_t` (`norec`, `norm`, `noregistrasi`, `pegawaifk`, `tanggal_pemeriksaan`, `namaperawat`, `beratbadan`, `tekanandarah`, `tinggibadan`, `created_at`, `updated_at`) VALUES
	('6c691956-4eff-4b32-b5b7-2035b0b17760', '000003', '2505000002', NULL, '2025-05-24 14:16:18', NULL, 80, '180/80', NULL, NULL, NULL);

-- Dumping structure for table db_klinik.registrasi_t
CREATE TABLE IF NOT EXISTS `registrasi_t` (
  `norec` varchar(50) NOT NULL,
  `noregistrasi` varchar(20) DEFAULT NULL,
  `tanggal_registrasi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pegawaifk` int(11) NOT NULL DEFAULT 0,
  `norm` varchar(20) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  `statusenabled` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`norec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_klinik.registrasi_t: ~2 rows (approximately)
INSERT INTO `registrasi_t` (`norec`, `noregistrasi`, `tanggal_registrasi`, `pegawaifk`, `norm`, `keterangan`, `statusenabled`, `created_at`, `updated_at`) VALUES
	('b5864aa9-7aa3-41c1-aab1-37c6dbbbb6e7', '2505000003', '2025-05-24 07:52:17', 4, '000002', '', b'1', '2025-05-24 14:52:17', '2025-05-24 14:52:17'),
	('f7d68666-8d6c-4046-93c4-c5d9a04fe281', '2505000002', '2025-05-24 07:00:26', 4, '000003', '', b'1', '2025-05-24 14:00:26', '2025-05-24 14:00:26');

-- Dumping structure for table db_klinik.user_m
CREATE TABLE IF NOT EXISTS `user_m` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `statusenabled` bit(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_klinik.user_m: ~6 rows (approximately)
INSERT INTO `user_m` (`id_user`, `username`, `password`, `nik`, `nama`, `jabatan`, `statusenabled`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', NULL, 'Admin', 'admin', NULL, '2025-05-24 13:41:13', '2025-05-24 13:41:13'),
	(4, 'drjoni', 'd94f3f0ae1026aa2521b4c85e0179a291497577f338888a5a7f8118220cccf3e76f216f189d9541209d045b1950bdf0205415d1aea6ff4fca781c3694d5da809', '1111111111111111', 'Dr Joni', 'dokter', b'1', '2025-05-24 13:49:54', '2025-05-24 13:49:54'),
	(5, 'drseptian', '17efbc5197a936a22263846e635dc86ddef336be4836731e3c1415962bc19f9e581b2930d34833f666d5a0163ec4f2e949c3d4ed4f15ad849676d2eb7256b72d', '2222222222222222', 'Dr Septian Baskoro', 'dokter', b'1', NULL, NULL),
	(6, 'dian', 'ab286576acfeb745baf5f301567995d830df749488139345b302b9c3a86aaa5e152c080498e25a6b48bc91fb1786be868a23523650d976fa8f3bc63a20343c25', '3333333333333333', 'Dian Sharmayanti Amd.Kes', 'perawat', b'1', NULL, NULL),
	(7, 'budi', 'b1005764da6f1f25ce8581cbf92ecead4caf586ca19a35274494856ab7d587afab94ac86e2461d30d2f309e24038688bb9759673609055e50b77bc85179d6dc0', '4444444444444444', 'Budi Handoko Amd.Kes', 'perawat', b'1', NULL, NULL),
	(8, 'apoteker', 'e3913bfb9f465aae03b13bc761f8b4ff36c87b9e5adc71d9863661971eb38e50b23d03a214a34a8d6b252996f251133e488cf7a5bcca34c29f29c2de2e6b033f', '5555555555555555', 'Apoteker', 'apoteker', b'1', NULL, NULL),
	(9, 'daftar', 'd14f8ca45ae45c2a92157f7a5374038b7505a21b6bc8a0c5f8ca10a92489c2fab014638812ad06247270d1b24002c7aa2deb07376de8b419f78b80a51d9fbe00', '8888888888888888', 'pendaftaran', 'pendaftaran', b'1', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
