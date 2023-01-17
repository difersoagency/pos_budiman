-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 04:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir_budiman`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `tipe_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `merek_id` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `tipe_id`, `satuan_id`, `merek_id`, `kode_barang`, `nama_barang`, `stok`, `harga_beli`, `harga_jual`) VALUES
(1, 1, 2, 1, 'F1-OLIMOTOR', 'Super Top Oli Motor', 9, 100000, 120000),
(2, 1, 3, 1, 'ACCU-0192', 'Accu First Choice', 11, 500000, 540000),
(3, 4, 1, 4, 'FILTER-AC', 'FILTER AC', 11, 80000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `no_booking` varchar(20) NOT NULL,
  `tgl_booking` date DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `no_booking`, `tgl_booking`, `customer_id`) VALUES
(4, 'BK/10/22/003', '2022-10-17', 1),
(6, 'BK/11/22/002', '2022-11-26', 1),
(7, 'BK/11/22/003', '2022-11-26', 1),
(10, 'BK/11/22/006', '2022-11-26', 1),
(11, 'Booking1', '2022-12-20', 1),
(13, 'Book/3', '2022-12-26', 1),
(15, 'Book/4', '2023-01-09', 2),
(16, 'TES1111', '2023-01-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `kota_id`, `nama_customer`, `alamat`, `telepon`) VALUES
(1, 3578, 'Cahya Dewi Kirana', 'Jl. Panglima Sudirman Gg V No 17', '08909096767'),
(2, 3515, 'Tio', 'Sedati', '08363289262'),
(3, 3578, 'Dela', 'Rungkut', '08575858697');

-- --------------------------------------------------------

--
-- Table structure for table `dretur_beli`
--

CREATE TABLE `dretur_beli` (
  `id` int(11) NOT NULL,
  `hretur_beli_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dretur_beli`
--

INSERT INTO `dretur_beli` (`id`, `hretur_beli_id`, `barang_id`, `jumlah`, `harga`) VALUES
(2, 2, 1, 1, 120000),
(3, 3, 2, 1, 540000);

-- --------------------------------------------------------

--
-- Table structure for table `dretur_jual`
--

CREATE TABLE `dretur_jual` (
  `hretur_jual_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dretur_jual`
--

INSERT INTO `dretur_jual` (`hretur_jual_id`, `id`, `barang_id`, `jumlah`, `harga`) VALUES
(5, 4, 2, 1, 540000),
(6, 5, 2, 1, 540000),
(7, 6, 2, 1, 540000);

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_beli`
--

CREATE TABLE `dtrans_beli` (
  `id` int(11) NOT NULL,
  `htrans_beli_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` float NOT NULL,
  `disc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtrans_beli`
--

INSERT INTO `dtrans_beli` (`id`, `htrans_beli_id`, `barang_id`, `jumlah`, `harga`, `disc`) VALUES
(13, 10, 3, 1, 100000, 0),
(22, 9, 3, 1, 540000, 0),
(23, 9, 1, 1, 120000, 0),
(24, 11, 3, 1, 100000, 0),
(25, 12, 1, 1, 120000, 0),
(29, 8, 2, 1, 540000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_jual`
--

CREATE TABLE `dtrans_jual` (
  `id` int(11) NOT NULL,
  `htrans_jual_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `disc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtrans_jual`
--

INSERT INTO `dtrans_jual` (`id`, `htrans_jual_id`, `barang_id`, `promo_id`, `jumlah`, `harga`, `disc`) VALUES
(3, 15, 2, NULL, 1, 540000, NULL),
(7, 20, 2, NULL, 1, 540000, NULL),
(14, 25, 1, NULL, 2, 120000, NULL),
(18, 27, 2, 4, 1, 540000, NULL),
(19, 28, 2, 4, 1, 540000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_jual_jasa`
--

CREATE TABLE `dtrans_jual_jasa` (
  `id` int(11) NOT NULL,
  `htrans_jual_id` int(11) NOT NULL,
  `jasa_id` int(11) NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `disc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dtrans_jual_jasa`
--

INSERT INTO `dtrans_jual_jasa` (`id`, `htrans_jual_id`, `jasa_id`, `promo_id`, `harga`, `disc`) VALUES
(3, 15, 1, NULL, 200000, NULL),
(12, 20, 2, NULL, 200000, NULL),
(13, 20, 1, NULL, 200000, NULL),
(14, 13, 2, NULL, 200000, NULL),
(15, 25, 4, NULL, 100000, NULL),
(17, 27, 1, NULL, 200000, NULL),
(18, 28, 2, NULL, 200000, 1),
(19, 29, 1, NULL, 200000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `d_booking`
--

CREATE TABLE `d_booking` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `jasa_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_booking`
--

INSERT INTO `d_booking` (`id`, `booking_id`, `barang_id`, `jasa_id`, `jumlah`) VALUES
(1, 4, NULL, 1, 1),
(3, 10, 1, NULL, 1),
(4, 10, NULL, 1, 1),
(5, 11, NULL, 2, 1),
(6, 11, 2, NULL, 1),
(11, 13, NULL, 2, 1),
(12, 13, NULL, 1, 1),
(16, 15, NULL, 1, 1),
(17, 15, 2, NULL, 1),
(20, 16, 1, NULL, 1),
(21, 16, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `d_hutang`
--

CREATE TABLE `d_hutang` (
  `id` int(11) NOT NULL,
  `h_hutang_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `no_giro` varchar(50) DEFAULT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_hutang`
--

INSERT INTO `d_hutang` (`id`, `h_hutang_id`, `pembayaran_id`, `no_giro`, `tgl_bayar`, `total_bayar`) VALUES
(2, 1, 4, '10000', '2023-01-01', 100000),
(3, 1, 3, 'TEST', '2023-01-16', 40000),
(4, 1, 1, NULL, '2023-01-17', 140000);

-- --------------------------------------------------------

--
-- Table structure for table `d_piutang`
--

CREATE TABLE `d_piutang` (
  `id` int(11) NOT NULL,
  `h_piutang_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `no_giro` varchar(50) DEFAULT NULL,
  `tgl_piutang` date NOT NULL,
  `total_bayar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_piutang`
--

INSERT INTO `d_piutang` (`id`, `h_piutang_id`, `pembayaran_id`, `no_giro`, `tgl_piutang`, `total_bayar`) VALUES
(1, 3, 1, NULL, '2022-11-06', 60000),
(2, 3, 1, NULL, '2022-11-06', 60000),
(3, 4, 4, 'GIRX202281271', '2023-01-01', 100000),
(4, 11, 1, NULL, '2023-01-15', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `hretur_beli`
--

CREATE TABLE `hretur_beli` (
  `id` int(11) NOT NULL,
  `htrans_beli_id` int(11) NOT NULL,
  `tgl_retur_beli` date NOT NULL,
  `total_retur_beli` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hretur_beli`
--

INSERT INTO `hretur_beli` (`id`, `htrans_beli_id`, `tgl_retur_beli`, `total_retur_beli`) VALUES
(2, 5, '2023-01-10', 120000),
(3, 1, '2023-01-10', 540000);

-- --------------------------------------------------------

--
-- Table structure for table `hretur_jual`
--

CREATE TABLE `hretur_jual` (
  `id` int(11) NOT NULL,
  `htrans_jual_id` int(11) NOT NULL,
  `no_retur_jual` varchar(20) NOT NULL,
  `tgl_retur_jual` date NOT NULL,
  `total_retur_jual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hretur_jual`
--

INSERT INTO `hretur_jual` (`id`, `htrans_jual_id`, `no_retur_jual`, `tgl_retur_jual`, `total_retur_jual`) VALUES
(5, 15, 'NORETUR', '2022-12-20', 540000),
(6, 20, 'NORETUR1', '2023-01-09', 540000),
(7, 28, 'TRJ001', '2023-01-17', 540000);

-- --------------------------------------------------------

--
-- Table structure for table `htrans_beli`
--

CREATE TABLE `htrans_beli` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `no_giro` varchar(50) DEFAULT NULL,
  `nomor_po` varchar(50) NOT NULL,
  `tgl_trans_beli` date NOT NULL,
  `tgl_max_garansi` date DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `total_bayar` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `htrans_beli`
--

INSERT INTO `htrans_beli` (`id`, `supplier_id`, `pembayaran_id`, `no_giro`, `nomor_po`, `tgl_trans_beli`, `tgl_max_garansi`, `disc`, `total_bayar`, `total`) VALUES
(1, 1, 3, NULL, 'TB/I/23/0001', '2023-01-01', '2023-02-01', NULL, 2700000, 2700000),
(5, 2, 3, NULL, 'TB/I/23/0005', '2023-01-01', '2023-02-01', NULL, 70000, 360000),
(8, 3, 2, '1234545', 'TB/I/23/0010', '2023-01-16', '2023-01-16', NULL, 540000, 540000),
(9, 1, 1, NULL, 'TB/I/23/0006', '2023-01-17', '2023-03-04', NULL, 100000, 660000),
(10, 2, 1, NULL, 'TB/I/23/0007', '2023-01-17', '2023-03-04', NULL, 100000, 100000),
(11, 3, 4, NULL, 'TB/I/23/0008', '2023-01-17', '2023-01-17', NULL, 100000, 100000),
(12, 2, 1, NULL, 'TB/I/23/0009', '2023-01-17', '2023-01-17', NULL, 120000, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `htrans_jual`
--

CREATE TABLE `htrans_jual` (
  `id` int(11) NOT NULL,
  `no_trans_jual` varchar(20) NOT NULL,
  `no_giro` varchar(100) DEFAULT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tgl_trans_jual` date DEFAULT NULL,
  `total_jual` decimal(10,0) DEFAULT NULL,
  `bayar_jual` decimal(10,0) DEFAULT NULL,
  `kembali_jual` decimal(10,0) DEFAULT NULL,
  `tgl_max_garansi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `htrans_jual`
--

INSERT INTO `htrans_jual` (`id`, `no_trans_jual`, `no_giro`, `pembayaran_id`, `booking_id`, `user_id`, `tgl_trans_jual`, `total_jual`, `bayar_jual`, `kembali_jual`, `tgl_max_garansi`) VALUES
(13, 'TJ/X/22/0004', '567576898', 2, 4, NULL, '2022-10-29', '200000', '20000', '0', '2022-11-29'),
(15, 'TJ/XI/22/0004', NULL, 1, 10, NULL, '2022-11-26', '740000', '550000', '0', '2023-01-07'),
(20, 'TJ/I/2023/0001', 'GIRI20238127180', 4, 13, NULL, '2023-01-01', '940000', '200000', '0', '2023-02-01'),
(25, 'TJ/I/23/0004', NULL, 1, 16, NULL, '2023-01-14', '316000', '316000', '0', '2023-03-14'),
(27, '312313', NULL, 1, 15, NULL, '2023-01-16', '686000', '686000', '0', '2023-01-30'),
(28, 'TJ/I/2023/0005', '3719731973107', 2, 11, NULL, '2023-01-17', '659700', '700000', '40300', '2023-03-14'),
(29, 'TJ/I/2023/0006', '123678900', 3, 7, 3, '2023-01-17', '200000', '200000', '0', '2023-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `h_hutang`
--

CREATE TABLE `h_hutang` (
  `id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `htrans_beli_id` int(11) NOT NULL,
  `tgl_hutang` date DEFAULT NULL,
  `total_hutang` decimal(10,0) DEFAULT NULL,
  `bayar_hutang` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_hutang`
--

INSERT INTO `h_hutang` (`id`, `pembayaran_id`, `htrans_beli_id`, `tgl_hutang`, `total_hutang`, `bayar_hutang`) VALUES
(1, 3, 5, '2023-01-01', '290000', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `h_piutang`
--

CREATE TABLE `h_piutang` (
  `id` int(11) NOT NULL,
  `htrans_jual_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `tgl_piutang` date DEFAULT NULL,
  `total_piutang` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_piutang`
--

INSERT INTO `h_piutang` (`id`, `htrans_jual_id`, `pembayaran_id`, `tgl_piutang`, `total_piutang`) VALUES
(4, 15, 1, '2022-11-26', '190000'),
(11, 20, 4, '2023-01-01', '740000'),
(12, 13, 2, '2022-10-29', '180000');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `nama_jasa` varchar(20) DEFAULT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `nama_jasa`, `harga`) VALUES
(1, 'Ganti Oli', 200000),
(2, 'Perbaiki Skok', 200000),
(4, 'Service Busi', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `koreksi`
--

CREATE TABLE `koreksi` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `tgl_koreksi` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` enum('in','out') NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koreksi`
--

INSERT INTO `koreksi` (`id`, `barang_id`, `tgl_koreksi`, `jumlah`, `jenis`, `keterangan`) VALUES
(1, 2, '2022-12-12', 1, 'in', NULL),
(2, 2, '2023-01-16', 1, 'in', 'teset');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `nama_kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama_kota`) VALUES
(1101, 'kabupaten simeulue'),
(1102, 'kabupaten aceh singkil'),
(1103, 'kabupaten aceh selatan'),
(1104, 'kabupaten aceh tenggara'),
(1105, 'kabupaten aceh timur'),
(1106, 'kabupaten aceh tengah'),
(1107, 'kabupaten aceh barat'),
(1108, 'kabupaten aceh besar'),
(1109, 'kabupaten pidie'),
(1110, 'kabupaten bireuen'),
(1111, 'kabupaten aceh utara'),
(1112, 'kabupaten aceh barat daya'),
(1113, 'kabupaten gayo lues'),
(1114, 'kabupaten aceh tamiang'),
(1115, 'kabupaten nagan raya'),
(1116, 'kabupaten aceh jaya'),
(1117, 'kabupaten bener meriah'),
(1118, 'kabupaten pidie jaya'),
(1171, 'kota banda aceh'),
(1172, 'kota sabang'),
(1173, 'kota langsa'),
(1174, 'kota lhokseumawe'),
(1175, 'kota subulussalam'),
(1201, 'kabupaten nias'),
(1202, 'kabupaten mandailing natal'),
(1203, 'kabupaten tapanuli selatan'),
(1204, 'kabupaten tapanuli tengah'),
(1205, 'kabupaten tapanuli utara'),
(1206, 'kabupaten toba samosir'),
(1207, 'kabupaten labuhan batu'),
(1208, 'kabupaten asahan'),
(1209, 'kabupaten simalungun'),
(1210, 'kabupaten dairi'),
(1211, 'kabupaten karo'),
(1212, 'kabupaten deli serdang'),
(1213, 'kabupaten langkat'),
(1214, 'kabupaten nias selatan'),
(1215, 'kabupaten humbang hasundutan'),
(1216, 'kabupaten pakpak bharat'),
(1217, 'kabupaten samosir'),
(1218, 'kabupaten serdang bedagai'),
(1219, 'kabupaten batu bara'),
(1220, 'kabupaten padang lawas utara'),
(1221, 'kabupaten padang lawas'),
(1222, 'kabupaten labuhan batu selatan'),
(1223, 'kabupaten labuhan batu utara'),
(1224, 'kabupaten nias utara'),
(1225, 'kabupaten nias barat'),
(1271, 'kota sibolga'),
(1272, 'kota tanjung balai'),
(1273, 'kota pematang siantar'),
(1274, 'kota tebing tinggi'),
(1275, 'kota medan'),
(1276, 'kota binjai'),
(1277, 'kota padangsidimpuan'),
(1278, 'kota gunungsitoli'),
(1301, 'kabupaten kepulauan mentawai'),
(1302, 'kabupaten pesisir selatan'),
(1303, 'kabupaten solok'),
(1304, 'kabupaten sijunjung'),
(1305, 'kabupaten tanah datar'),
(1306, 'kabupaten padang pariaman'),
(1307, 'kabupaten agam'),
(1308, 'kabupaten lima puluh kota'),
(1309, 'kabupaten pasaman'),
(1310, 'kabupaten solok selatan'),
(1311, 'kabupaten dharmasraya'),
(1312, 'kabupaten pasaman barat'),
(1371, 'kota padang'),
(1372, 'kota solok'),
(1373, 'kota sawah lunto'),
(1374, 'kota padang panjang'),
(1375, 'kota bukittinggi'),
(1376, 'kota payakumbuh'),
(1377, 'kota pariaman'),
(1401, 'kabupaten kuantan singingi'),
(1402, 'kabupaten indragiri hulu'),
(1403, 'kabupaten indragiri hilir'),
(1404, 'kabupaten pelalawan'),
(1405, 'kabupaten siak'),
(1406, 'kabupaten kampar'),
(1407, 'kabupaten rokan hulu'),
(1408, 'kabupaten bengkalis'),
(1409, 'kabupaten rokan hilir'),
(1410, 'kabupaten kepulauan meranti'),
(1471, 'kota pekanbaru'),
(1473, 'kota dumai'),
(1501, 'kabupaten kerinci'),
(1502, 'kabupaten merangin'),
(1503, 'kabupaten sarolangun'),
(1504, 'kabupaten batang hari'),
(1505, 'kabupaten muaro jambi'),
(1506, 'kabupaten tanjung jabung timur'),
(1507, 'kabupaten tanjung jabung barat'),
(1508, 'kabupaten tebo'),
(1509, 'kabupaten bungo'),
(1571, 'kota jambi'),
(1572, 'kota sungai penuh'),
(1601, 'kabupaten ogan komering ulu'),
(1602, 'kabupaten ogan komering ilir'),
(1603, 'kabupaten muara enim'),
(1604, 'kabupaten lahat'),
(1605, 'kabupaten musi rawas'),
(1606, 'kabupaten musi banyuasin'),
(1607, 'kabupaten banyu asin'),
(1608, 'kabupaten ogan komering ulu selatan'),
(1609, 'kabupaten ogan komering ulu timur'),
(1610, 'kabupaten ogan ilir'),
(1611, 'kabupaten empat lawang'),
(1612, 'kabupaten penukal abab lematang ilir'),
(1613, 'kabupaten musi rawas utara'),
(1671, 'kota palembang'),
(1672, 'kota prabumulih'),
(1673, 'kota pagar alam'),
(1674, 'kota lubuklinggau'),
(1701, 'kabupaten bengkulu selatan'),
(1702, 'kabupaten rejang lebong'),
(1703, 'kabupaten bengkulu utara'),
(1704, 'kabupaten kaur'),
(1705, 'kabupaten seluma'),
(1706, 'kabupaten mukomuko'),
(1707, 'kabupaten lebong'),
(1708, 'kabupaten kepahiang'),
(1709, 'kabupaten bengkulu tengah'),
(1771, 'kota bengkulu'),
(1801, 'kabupaten lampung barat'),
(1802, 'kabupaten tanggamus'),
(1803, 'kabupaten lampung selatan'),
(1804, 'kabupaten lampung timur'),
(1805, 'kabupaten lampung tengah'),
(1806, 'kabupaten lampung utara'),
(1807, 'kabupaten way kanan'),
(1808, 'kabupaten tulangbawang'),
(1809, 'kabupaten pesawaran'),
(1810, 'kabupaten pringsewu'),
(1811, 'kabupaten mesuji'),
(1812, 'kabupaten tulang bawang barat'),
(1813, 'kabupaten pesisir barat'),
(1871, 'kota bandar lampung'),
(1872, 'kota metro'),
(1901, 'kabupaten bangka'),
(1902, 'kabupaten belitung'),
(1903, 'kabupaten bangka barat'),
(1904, 'kabupaten bangka tengah'),
(1905, 'kabupaten bangka selatan'),
(1906, 'kabupaten belitung timur'),
(1971, 'kota pangkal pinang'),
(2101, 'kabupaten karimun'),
(2102, 'kabupaten bintan'),
(2103, 'kabupaten natuna'),
(2104, 'kabupaten lingga'),
(2105, 'kabupaten kepulauan anambas'),
(2171, 'kota batam'),
(2172, 'kota tanjung pinang'),
(3101, 'kabupaten kepulauan seribu'),
(3171, 'kota jakarta selatan'),
(3172, 'kota jakarta timur'),
(3173, 'kota jakarta pusat'),
(3174, 'kota jakarta barat'),
(3175, 'kota jakarta utara'),
(3201, 'kabupaten bogor'),
(3202, 'kabupaten sukabumi'),
(3203, 'kabupaten cianjur'),
(3204, 'kabupaten bandung'),
(3205, 'kabupaten garut'),
(3206, 'kabupaten tasikmalaya'),
(3207, 'kabupaten ciamis'),
(3208, 'kabupaten kuningan'),
(3209, 'kabupaten cirebon'),
(3210, 'kabupaten majalengka'),
(3211, 'kabupaten sumedang'),
(3212, 'kabupaten indramayu'),
(3213, 'kabupaten subang'),
(3214, 'kabupaten purwakarta'),
(3215, 'kabupaten karawang'),
(3216, 'kabupaten bekasi'),
(3217, 'kabupaten bandung barat'),
(3218, 'kabupaten pangandaran'),
(3271, 'kota bogor'),
(3272, 'kota sukabumi'),
(3273, 'kota bandung'),
(3274, 'kota cirebon'),
(3275, 'kota bekasi'),
(3276, 'kota depok'),
(3277, 'kota cimahi'),
(3278, 'kota tasikmalaya'),
(3279, 'kota banjar'),
(3301, 'kabupaten cilacap'),
(3302, 'kabupaten banyumas'),
(3303, 'kabupaten purbalingga'),
(3304, 'kabupaten banjarnegara'),
(3305, 'kabupaten kebumen'),
(3306, 'kabupaten purworejo'),
(3307, 'kabupaten wonosobo'),
(3308, 'kabupaten magelang'),
(3309, 'kabupaten boyolali'),
(3310, 'kabupaten klaten'),
(3311, 'kabupaten sukoharjo'),
(3312, 'kabupaten wonogiri'),
(3313, 'kabupaten karanganyar'),
(3314, 'kabupaten sragen'),
(3315, 'kabupaten grobogan'),
(3316, 'kabupaten blora'),
(3317, 'kabupaten rembang'),
(3318, 'kabupaten pati'),
(3319, 'kabupaten kudus'),
(3320, 'kabupaten jepara'),
(3321, 'kabupaten demak'),
(3322, 'kabupaten semarang'),
(3323, 'kabupaten temanggung'),
(3324, 'kabupaten kendal'),
(3325, 'kabupaten batang'),
(3326, 'kabupaten pekalongan'),
(3327, 'kabupaten pemalang'),
(3328, 'kabupaten tegal'),
(3329, 'kabupaten brebes'),
(3371, 'kota magelang'),
(3372, 'kota surakarta'),
(3373, 'kota salatiga'),
(3374, 'kota semarang'),
(3375, 'kota pekalongan'),
(3376, 'kota tegal'),
(3401, 'kabupaten kulon progo'),
(3402, 'kabupaten bantul'),
(3403, 'kabupaten gunung kidul'),
(3404, 'kabupaten sleman'),
(3471, 'kota yogyakarta'),
(3501, 'kabupaten pacitan'),
(3502, 'kabupaten ponorogo'),
(3503, 'kabupaten trenggalek'),
(3504, 'kabupaten tulungagung'),
(3505, 'kabupaten blitar'),
(3506, 'kabupaten kediri'),
(3507, 'kabupaten malang'),
(3508, 'kabupaten lumajang'),
(3509, 'kabupaten jember'),
(3510, 'kabupaten banyuwangi'),
(3511, 'kabupaten bondowoso'),
(3512, 'kabupaten situbondo'),
(3513, 'kabupaten probolinggo'),
(3514, 'kabupaten pasuruan'),
(3515, 'kabupaten sidoarjo'),
(3516, 'kabupaten mojokerto'),
(3517, 'kabupaten jombang'),
(3518, 'kabupaten nganjuk'),
(3519, 'kabupaten madiun'),
(3520, 'kabupaten magetan'),
(3521, 'kabupaten ngawi'),
(3522, 'kabupaten bojonegoro'),
(3523, 'kabupaten tuban'),
(3524, 'kabupaten lamongan'),
(3525, 'kabupaten gresik'),
(3526, 'kabupaten bangkalan'),
(3527, 'kabupaten sampang'),
(3528, 'kabupaten pamekasan'),
(3529, 'kabupaten sumenep'),
(3571, 'kota kediri'),
(3572, 'kota blitar'),
(3573, 'kota malang'),
(3574, 'kota probolinggo'),
(3575, 'kota pasuruan'),
(3576, 'kota mojokerto'),
(3577, 'kota madiun'),
(3578, 'kota surabaya'),
(3579, 'kota batu'),
(3601, 'kabupaten pandeglang'),
(3602, 'kabupaten lebak'),
(3603, 'kabupaten tangerang'),
(3604, 'kabupaten serang'),
(3671, 'kota tangerang'),
(3672, 'kota cilegon'),
(3673, 'kota serang'),
(3674, 'kota tangerang selatan'),
(5101, 'kabupaten jembrana'),
(5102, 'kabupaten tabanan'),
(5103, 'kabupaten badung'),
(5104, 'kabupaten gianyar'),
(5105, 'kabupaten klungkung'),
(5106, 'kabupaten bangli'),
(5107, 'kabupaten karang asem'),
(5108, 'kabupaten buleleng'),
(5171, 'kota denpasar'),
(5201, 'kabupaten lombok barat'),
(5202, 'kabupaten lombok tengah'),
(5203, 'kabupaten lombok timur'),
(5204, 'kabupaten sumbawa'),
(5205, 'kabupaten dompu'),
(5206, 'kabupaten bima'),
(5207, 'kabupaten sumbawa barat'),
(5208, 'kabupaten lombok utara'),
(5271, 'kota mataram'),
(5272, 'kota bima'),
(5301, 'kabupaten sumba barat'),
(5302, 'kabupaten sumba timur'),
(5303, 'kabupaten kupang'),
(5304, 'kabupaten timor tengah selatan'),
(5305, 'kabupaten timor tengah utara'),
(5306, 'kabupaten belu'),
(5307, 'kabupaten alor'),
(5308, 'kabupaten lembata'),
(5309, 'kabupaten flores timur'),
(5310, 'kabupaten sikka'),
(5311, 'kabupaten ende'),
(5312, 'kabupaten ngada'),
(5313, 'kabupaten manggarai'),
(5314, 'kabupaten rote ndao'),
(5315, 'kabupaten manggarai barat'),
(5316, 'kabupaten sumba tengah'),
(5317, 'kabupaten sumba barat daya'),
(5318, 'kabupaten nagekeo'),
(5319, 'kabupaten manggarai timur'),
(5320, 'kabupaten sabu raijua'),
(5321, 'kabupaten malaka'),
(5371, 'kota kupang'),
(6101, 'kabupaten sambas'),
(6102, 'kabupaten bengkayang'),
(6103, 'kabupaten landak'),
(6104, 'kabupaten mempawah'),
(6105, 'kabupaten sanggau'),
(6106, 'kabupaten ketapang'),
(6107, 'kabupaten sintang'),
(6108, 'kabupaten kapuas hulu'),
(6109, 'kabupaten sekadau'),
(6110, 'kabupaten melawi'),
(6111, 'kabupaten kayong utara'),
(6112, 'kabupaten kubu raya'),
(6171, 'kota pontianak'),
(6172, 'kota singkawang'),
(6201, 'kabupaten kotawaringin barat'),
(6202, 'kabupaten kotawaringin timur'),
(6203, 'kabupaten kapuas'),
(6204, 'kabupaten barito selatan'),
(6205, 'kabupaten barito utara'),
(6206, 'kabupaten sukamara'),
(6207, 'kabupaten lamandau'),
(6208, 'kabupaten seruyan'),
(6209, 'kabupaten katingan'),
(6210, 'kabupaten pulang pisau'),
(6211, 'kabupaten gunung mas'),
(6212, 'kabupaten barito timur'),
(6213, 'kabupaten murung raya'),
(6271, 'kota palangka raya'),
(6301, 'kabupaten tanah laut'),
(6302, 'kabupaten kota baru'),
(6303, 'kabupaten banjar'),
(6304, 'kabupaten barito kuala'),
(6305, 'kabupaten tapin'),
(6306, 'kabupaten hulu sungai selatan'),
(6307, 'kabupaten hulu sungai tengah'),
(6308, 'kabupaten hulu sungai utara'),
(6309, 'kabupaten tabalong'),
(6310, 'kabupaten tanah bumbu'),
(6311, 'kabupaten balangan'),
(6371, 'kota banjarmasin'),
(6372, 'kota banjar baru'),
(6401, 'kabupaten paser'),
(6402, 'kabupaten kutai barat'),
(6403, 'kabupaten kutai kartanegara'),
(6404, 'kabupaten kutai timur'),
(6405, 'kabupaten berau'),
(6409, 'kabupaten penajam paser utara'),
(6411, 'kabupaten mahakam hulu'),
(6471, 'kota balikpapan'),
(6472, 'kota samarinda'),
(6474, 'kota bontang'),
(6501, 'kabupaten malinau'),
(6502, 'kabupaten bulungan'),
(6503, 'kabupaten tana tidung'),
(6504, 'kabupaten nunukan'),
(6571, 'kota tarakan'),
(7101, 'kabupaten bolaang mongondow'),
(7102, 'kabupaten minahasa'),
(7103, 'kabupaten kepulauan sangihe'),
(7104, 'kabupaten kepulauan talaud'),
(7105, 'kabupaten minahasa selatan'),
(7106, 'kabupaten minahasa utara'),
(7107, 'kabupaten bolaang mongondow utara'),
(7108, 'kabupaten siau tagulandang biaro'),
(7109, 'kabupaten minahasa tenggara'),
(7110, 'kabupaten bolaang mongondow selatan'),
(7111, 'kabupaten bolaang mongondow timur'),
(7171, 'kota manado'),
(7172, 'kota bitung'),
(7173, 'kota tomohon'),
(7174, 'kota kotamobagu'),
(7201, 'kabupaten banggai kepulauan'),
(7202, 'kabupaten banggai'),
(7203, 'kabupaten morowali'),
(7204, 'kabupaten poso'),
(7205, 'kabupaten donggala'),
(7206, 'kabupaten toli-toli'),
(7207, 'kabupaten buol'),
(7208, 'kabupaten parigi moutong'),
(7209, 'kabupaten tojo una-una'),
(7210, 'kabupaten sigi'),
(7211, 'kabupaten banggai laut'),
(7212, 'kabupaten morowali utara'),
(7271, 'kota palu'),
(7301, 'kabupaten kepulauan selayar'),
(7302, 'kabupaten bulukumba'),
(7303, 'kabupaten bantaeng'),
(7304, 'kabupaten jeneponto'),
(7305, 'kabupaten takalar'),
(7306, 'kabupaten gowa'),
(7307, 'kabupaten sinjai'),
(7308, 'kabupaten maros'),
(7309, 'kabupaten pangkajene dan kepulauan'),
(7310, 'kabupaten barru'),
(7311, 'kabupaten bone'),
(7312, 'kabupaten soppeng'),
(7313, 'kabupaten wajo'),
(7314, 'kabupaten sidenreng rappang'),
(7315, 'kabupaten pinrang'),
(7316, 'kabupaten enrekang'),
(7317, 'kabupaten luwu'),
(7318, 'kabupaten tana toraja'),
(7322, 'kabupaten luwu utara'),
(7325, 'kabupaten luwu timur'),
(7326, 'kabupaten toraja utara'),
(7371, 'kota makassar'),
(7372, 'kota parepare'),
(7373, 'kota palopo'),
(7401, 'kabupaten buton'),
(7402, 'kabupaten muna'),
(7403, 'kabupaten konawe'),
(7404, 'kabupaten kolaka'),
(7405, 'kabupaten konawe selatan'),
(7406, 'kabupaten bombana'),
(7407, 'kabupaten wakatobi'),
(7408, 'kabupaten kolaka utara'),
(7409, 'kabupaten buton utara'),
(7410, 'kabupaten konawe utara'),
(7411, 'kabupaten kolaka timur'),
(7412, 'kabupaten konawe kepulauan'),
(7413, 'kabupaten muna barat'),
(7414, 'kabupaten buton tengah'),
(7415, 'kabupaten buton selatan'),
(7471, 'kota kendari'),
(7472, 'kota baubau'),
(7501, 'kabupaten boalemo'),
(7502, 'kabupaten gorontalo'),
(7503, 'kabupaten pohuwato'),
(7504, 'kabupaten bone bolango'),
(7505, 'kabupaten gorontalo utara'),
(7571, 'kota gorontalo'),
(7601, 'kabupaten majene'),
(7602, 'kabupaten polewali mandar'),
(7603, 'kabupaten mamasa'),
(7604, 'kabupaten mamuju'),
(7605, 'kabupaten mamuju utara'),
(7606, 'kabupaten mamuju tengah'),
(8101, 'kabupaten maluku tenggara barat'),
(8102, 'kabupaten maluku tenggara'),
(8103, 'kabupaten maluku tengah'),
(8104, 'kabupaten buru'),
(8105, 'kabupaten kepulauan aru'),
(8106, 'kabupaten seram bagian barat'),
(8107, 'kabupaten seram bagian timur'),
(8108, 'kabupaten maluku barat daya'),
(8109, 'kabupaten buru selatan'),
(8171, 'kota ambon'),
(8172, 'kota tual'),
(8201, 'kabupaten halmahera barat'),
(8202, 'kabupaten halmahera tengah'),
(8203, 'kabupaten kepulauan sula'),
(8204, 'kabupaten halmahera selatan'),
(8205, 'kabupaten halmahera utara'),
(8206, 'kabupaten halmahera timur'),
(8207, 'kabupaten pulau morotai'),
(8208, 'kabupaten pulau taliabu'),
(8271, 'kota ternate'),
(8272, 'kota tidore kepulauan'),
(9101, 'kabupaten fakfak'),
(9102, 'kabupaten kaimana'),
(9103, 'kabupaten teluk wondama'),
(9104, 'kabupaten teluk bintuni'),
(9105, 'kabupaten manokwari'),
(9106, 'kabupaten sorong selatan'),
(9107, 'kabupaten sorong'),
(9108, 'kabupaten raja ampat'),
(9109, 'kabupaten tambrauw'),
(9110, 'kabupaten maybrat'),
(9111, 'kabupaten manokwari selatan'),
(9112, 'kabupaten pegunungan arfak'),
(9171, 'kota sorong'),
(9401, 'kabupaten merauke'),
(9402, 'kabupaten jayawijaya'),
(9403, 'kabupaten jayapura'),
(9404, 'kabupaten nabire'),
(9408, 'kabupaten kepulauan yapen'),
(9409, 'kabupaten biak numfor'),
(9410, 'kabupaten paniai'),
(9411, 'kabupaten puncak jaya'),
(9412, 'kabupaten mimika'),
(9413, 'kabupaten boven digoel'),
(9414, 'kabupaten mappi'),
(9415, 'kabupaten asmat'),
(9416, 'kabupaten yahukimo'),
(9417, 'kabupaten pegunungan bintang'),
(9418, 'kabupaten tolikara'),
(9419, 'kabupaten sarmi'),
(9420, 'kabupaten keerom'),
(9426, 'kabupaten waropen'),
(9427, 'kabupaten supiori'),
(9428, 'kabupaten mamberamo raya'),
(9429, 'kabupaten nduga'),
(9430, 'kabupaten lanny jaya'),
(9431, 'kabupaten mamberamo tengah'),
(9432, 'kabupaten yalimo'),
(9433, 'kabupaten puncak'),
(9434, 'kabupaten dogiyai'),
(9435, 'kabupaten intan jaya'),
(9436, 'kabupaten deiyai'),
(9471, 'kota jayapura');

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id`, `nama_level`) VALUES
(1, 'owner'),
(2, 'admin'),
(3, 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id` int(11) NOT NULL,
  `kode_merek` varchar(10) NOT NULL,
  `nama_merek` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `kode_merek`, `nama_merek`) VALUES
(1, 'cst', 'castrol'),
(2, 'hnd', 'honda'),
(3, 'shl', 'shell'),
(4, 'ymh', 'yamaha'),
(5, 'F1', 'FormulaOne');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `kode_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(20) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `kode_pegawai`, `nama_pegawai`, `gender`, `telepon`) VALUES
(1, 'a001', 'nurul', 'L', NULL),
(2, 'a002', 'tutik', 'L', NULL),
(3, 'k001', 'fian', 'L', NULL),
(4, 'o001', 'hasan', 'L', '843298'),
(6, 'k0012', 'nita', 'P', '231313'),
(7, 'TES', 'TES', 'L', '124214141');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `nama_bayar` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `nama_bayar`) VALUES
(1, 'Cash'),
(2, 'Debit'),
(3, 'Kredit'),
(4, 'Giro');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `kode_promo` varchar(10) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `nama_promo` varchar(100) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `jasa_id` int(11) DEFAULT NULL,
  `qty_sk` int(11) NOT NULL,
  `disc` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `kode_promo`, `tgl_mulai`, `tgl_selesai`, `nama_promo`, `barang_id`, `jasa_id`, `qty_sk`, `disc`) VALUES
(1, 'OLIPROMO14', '2022-11-01', '2023-02-04', 'Diskon Oli', 1, NULL, 2, '5'),
(2, 'AKIFIRST', '2022-11-01', '2022-12-01', 'Promo AKI', 2, NULL, 1, '5'),
(3, 'SB2023STAR', '2022-12-31', '2023-03-01', 'Promo Busi', NULL, 4, 1, '12'),
(4, 'AKIPROMO', '2023-01-15', '2023-05-18', 'AKIPRO', 2, NULL, 1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `kode_satuan` varchar(10) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `kode_satuan`, `nama_satuan`) VALUES
(1, 'lsn', 'lusin'),
(2, 'ltr', 'liter'),
(3, 'pcs', 'pieces'),
(4, 'cm', 'centimeter');

-- --------------------------------------------------------

--
-- Table structure for table `subtitusi`
--

CREATE TABLE `subtitusi` (
  `tgl_subtitusi` date NOT NULL,
  `id` int(11) NOT NULL,
  `barang_id_1` int(11) NOT NULL,
  `barang_id_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subtitusi`
--

INSERT INTO `subtitusi` (`tgl_subtitusi`, `id`, `barang_id_1`, `barang_id_2`) VALUES
('2023-04-01', 4, 2, 1),
('2023-01-15', 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `nama_supplier` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kota_id`, `nama_supplier`, `alamat`, `telepon`) VALUES
(1, 1109, 'Syafii Store Group', 'Jl Kartini No 28 Aceh', '08190906789'),
(2, 3525, 'Zainuddin', 'Jl Panglima Sudirman No 1', '08133445566'),
(3, 3518, 'Toko Dor', 'Jl Akim Kayat', '90432948');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `id` int(11) NOT NULL,
  `kode_tipe` varchar(10) NOT NULL,
  `nama_tipe` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`id`, `kode_tipe`, `nama_tipe`) VALUES
(1, '001', 'oli'),
(2, '002', 'busi'),
(3, '003', 'filter udara'),
(4, '004', 'filter ac'),
(5, '005', 'kampas rem'),
(6, '006', 'aki');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `level_user_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `level_user_id`, `pegawai_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nurul_a1', 2, 1, 'nurull@gmail.com', '2022-08-30 06:49:13', '$2y$10$IkgmFFZ2/y2D0xi86RNxB.w2GLEmYPYnDxjQgSPINXBfuVLv2opH.', NULL, NULL, '2023-01-16 10:29:35'),
(2, 'kasir1', 3, 3, 'kasir@gmail.com', '2022-08-30 06:49:13', '$2y$10$aBghtGc2Y7kmBcdZF61w...Vzh8Kpyw2QahA0Os49s60OweptXhBu', NULL, NULL, NULL),
(3, 'owner1', 1, 4, 'owner@gmail.com', '2022-08-30 06:49:13', '$2y$10$vN1IiVyQTwxcKejwo6HJE.UCpqxU/YT4c/l4/DwSzinnqr/AaKGeu', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipe_id_barang` (`tipe_id`),
  ADD KEY `merek_id_barang` (`merek_id`),
  ADD KEY `satuan_id_barang` (`satuan_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id_booking` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota_id_customer` (`kota_id`);

--
-- Indexes for table `dretur_beli`
--
ALTER TABLE `dretur_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hretur_beli_id_dretur_beli` (`hretur_beli_id`),
  ADD KEY `barang_id_dretur_beli` (`barang_id`);

--
-- Indexes for table `dretur_jual`
--
ALTER TABLE `dretur_jual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hretur_jual_id_dretur_jual` (`hretur_jual_id`),
  ADD KEY `barang_id_dretur_jual` (`barang_id`);

--
-- Indexes for table `dtrans_beli`
--
ALTER TABLE `dtrans_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id_dtrans_beli` (`barang_id`),
  ADD KEY `htrans_beli_id_dtrans_beli` (`htrans_beli_id`);

--
-- Indexes for table `dtrans_jual`
--
ALTER TABLE `dtrans_jual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `htrans_jual_id_dtrans_jual` (`htrans_jual_id`),
  ADD KEY `barang_id_dtrans_jual` (`barang_id`),
  ADD KEY `promo_id_dtrans_jual` (`promo_id`);

--
-- Indexes for table `dtrans_jual_jasa`
--
ALTER TABLE `dtrans_jual_jasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_trans_jual_jasa` (`htrans_jual_id`),
  ADD KEY `jasa_id_dtrans_jual` (`jasa_id`);

--
-- Indexes for table `d_booking`
--
ALTER TABLE `d_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id_d_booking` (`booking_id`),
  ADD KEY `barang_id_d_booking` (`barang_id`),
  ADD KEY `jasa_id_d_booking` (`jasa_id`);

--
-- Indexes for table `d_hutang`
--
ALTER TABLE `d_hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_hutang_id_d_hutang` (`h_hutang_id`),
  ADD KEY `hutang_pembayaran_id` (`pembayaran_id`);

--
-- Indexes for table `d_piutang`
--
ALTER TABLE `d_piutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `h_piutang_piutang_id` (`h_piutang_id`),
  ADD KEY `piutang_pembayaran_id` (`pembayaran_id`);

--
-- Indexes for table `hretur_beli`
--
ALTER TABLE `hretur_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `htrans_beli_id_hretur_beli` (`htrans_beli_id`);

--
-- Indexes for table `hretur_jual`
--
ALTER TABLE `hretur_jual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `htrans_jual_id_h_retur_jual` (`htrans_jual_id`);

--
-- Indexes for table `htrans_beli`
--
ALTER TABLE `htrans_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_id_htans_beli` (`pembayaran_id`),
  ADD KEY `supplier_id_htrans_beli` (`supplier_id`);

--
-- Indexes for table `htrans_jual`
--
ALTER TABLE `htrans_jual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_id_htrans_jual` (`pembayaran_id`),
  ADD KEY `booking_id_htrans_jual` (`booking_id`),
  ADD KEY `user_id_htrans_jual` (`user_id`);

--
-- Indexes for table `h_hutang`
--
ALTER TABLE `h_hutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_id_h_hutang` (`pembayaran_id`),
  ADD KEY `htrans_beli_id_h_hutang` (`htrans_beli_id`);

--
-- Indexes for table `h_piutang`
--
ALTER TABLE `h_piutang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `htrans_jual_id_h_piutang` (`htrans_jual_id`),
  ADD KEY `pembayaran_id_h_piutang` (`pembayaran_id`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koreksi`
--
ALTER TABLE `koreksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id_koreksi` (`barang_id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subtitusi`
--
ALTER TABLE `subtitusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota_id_supplier` (`kota_id`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_user_id_user` (`level_user_id`),
  ADD KEY `pegawai_id_user` (`pegawai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dretur_beli`
--
ALTER TABLE `dretur_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dretur_jual`
--
ALTER TABLE `dretur_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dtrans_beli`
--
ALTER TABLE `dtrans_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dtrans_jual`
--
ALTER TABLE `dtrans_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dtrans_jual_jasa`
--
ALTER TABLE `dtrans_jual_jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `d_booking`
--
ALTER TABLE `d_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `d_hutang`
--
ALTER TABLE `d_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `d_piutang`
--
ALTER TABLE `d_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hretur_beli`
--
ALTER TABLE `hretur_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hretur_jual`
--
ALTER TABLE `hretur_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `htrans_beli`
--
ALTER TABLE `htrans_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `htrans_jual`
--
ALTER TABLE `htrans_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `h_hutang`
--
ALTER TABLE `h_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `h_piutang`
--
ALTER TABLE `h_piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `koreksi`
--
ALTER TABLE `koreksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9472;

--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subtitusi`
--
ALTER TABLE `subtitusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `merek_id_barang` FOREIGN KEY (`merek_id`) REFERENCES `merek` (`id`),
  ADD CONSTRAINT `satuan_id_barang` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id`),
  ADD CONSTRAINT `tipe_id_barang` FOREIGN KEY (`tipe_id`) REFERENCES `tipe` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `customer_id_booking` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `kota_id_customer` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`id`);

--
-- Constraints for table `dretur_beli`
--
ALTER TABLE `dretur_beli`
  ADD CONSTRAINT `barang_id_dretur_beli` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `hretur_beli_id_dretur_beli` FOREIGN KEY (`hretur_beli_id`) REFERENCES `hretur_beli` (`id`);

--
-- Constraints for table `dretur_jual`
--
ALTER TABLE `dretur_jual`
  ADD CONSTRAINT `barang_id_dretur_jual` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `hretur_jual_id_dretur_jual` FOREIGN KEY (`hretur_jual_id`) REFERENCES `hretur_jual` (`id`);

--
-- Constraints for table `dtrans_beli`
--
ALTER TABLE `dtrans_beli`
  ADD CONSTRAINT `barang_id_dtrans_beli` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `htrans_beli_id_dtrans_beli` FOREIGN KEY (`htrans_beli_id`) REFERENCES `htrans_beli` (`id`);

--
-- Constraints for table `dtrans_jual`
--
ALTER TABLE `dtrans_jual`
  ADD CONSTRAINT `barang_id_dtrans_jual` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `htrans_jual_id_dtrans_jual` FOREIGN KEY (`htrans_jual_id`) REFERENCES `htrans_jual` (`id`),
  ADD CONSTRAINT `promo_id_dtrans_jual` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`id`);

--
-- Constraints for table `dtrans_jual_jasa`
--
ALTER TABLE `dtrans_jual_jasa`
  ADD CONSTRAINT `h_trans_jual_jasa` FOREIGN KEY (`htrans_jual_id`) REFERENCES `htrans_jual` (`id`),
  ADD CONSTRAINT `jasa_id_dtrans_jual` FOREIGN KEY (`jasa_id`) REFERENCES `jasa` (`id`);

--
-- Constraints for table `d_booking`
--
ALTER TABLE `d_booking`
  ADD CONSTRAINT `barang_id_d_booking` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `booking_id_d_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `jasa_id_d_booking` FOREIGN KEY (`jasa_id`) REFERENCES `jasa` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `d_hutang`
--
ALTER TABLE `d_hutang`
  ADD CONSTRAINT `h_hutang_id_d_hutang` FOREIGN KEY (`h_hutang_id`) REFERENCES `h_hutang` (`id`),
  ADD CONSTRAINT `hutang_pembayaran_id` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`);

--
-- Constraints for table `d_piutang`
--
ALTER TABLE `d_piutang`
  ADD CONSTRAINT `piutang_pembayaran_id` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`);

--
-- Constraints for table `hretur_beli`
--
ALTER TABLE `hretur_beli`
  ADD CONSTRAINT `htrans_beli_id_hretur_beli` FOREIGN KEY (`htrans_beli_id`) REFERENCES `htrans_beli` (`id`);

--
-- Constraints for table `hretur_jual`
--
ALTER TABLE `hretur_jual`
  ADD CONSTRAINT `htrans_jual_id_h_retur_jual` FOREIGN KEY (`htrans_jual_id`) REFERENCES `htrans_jual` (`id`);

--
-- Constraints for table `htrans_beli`
--
ALTER TABLE `htrans_beli`
  ADD CONSTRAINT `pembayaran_id_htans_beli` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`),
  ADD CONSTRAINT `supplier_id_htrans_beli` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `htrans_jual`
--
ALTER TABLE `htrans_jual`
  ADD CONSTRAINT `booking_id_htrans_jual` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `pembayaran_id_htrans_jual` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`),
  ADD CONSTRAINT `user_id_htrans_jual` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `h_hutang`
--
ALTER TABLE `h_hutang`
  ADD CONSTRAINT `htrans_beli_id_h_hutang` FOREIGN KEY (`htrans_beli_id`) REFERENCES `htrans_beli` (`id`),
  ADD CONSTRAINT `pembayaran_id_h_hutang` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`);

--
-- Constraints for table `h_piutang`
--
ALTER TABLE `h_piutang`
  ADD CONSTRAINT `htrans_jual_id_h_piutang` FOREIGN KEY (`htrans_jual_id`) REFERENCES `htrans_jual` (`id`),
  ADD CONSTRAINT `pembayaran_id_h_piutang` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`);

--
-- Constraints for table `koreksi`
--
ALTER TABLE `koreksi`
  ADD CONSTRAINT `barang_id_koreksi` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `kota_id_supplier` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `level_user_id_user` FOREIGN KEY (`level_user_id`) REFERENCES `level_user` (`id`),
  ADD CONSTRAINT `pegawai_id_user` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
