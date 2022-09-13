-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2022 at 10:10 PM
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
  `KODE_BARANG` varchar(20) NOT NULL,
  `KODE_TIPE` varchar(10) DEFAULT NULL,
  `KODE_MEREK` varchar(10) DEFAULT NULL,
  `NAMA_BARANG` varchar(20) NOT NULL,
  `KODE_SATUAN` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `STOK` int(11) NOT NULL,
  `HARGA_BELI` float NOT NULL,
  `HARGA_JUAL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `NO_BOOKING` varchar(20) NOT NULL,
  `TGL_BOOKING` date DEFAULT NULL,
  `KODE_CUSTOMER` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `KODE_CUSTOMER` varchar(50) NOT NULL,
  `KODE_KOTA` varchar(10) CHARACTER SET latin1 NOT NULL,
  `NAMA_CUSTOMER` varchar(100) NOT NULL,
  `ALAMAT` text DEFAULT NULL,
  `TELEPON` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dretur_beli`
--

CREATE TABLE `dretur_beli` (
  `NO_RETUR_BELI` varchar(10) NOT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dretur_jual`
--

CREATE TABLE `dretur_jual` (
  `NO_RETUR_JUAL` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_beli`
--

CREATE TABLE `dtrans_beli` (
  `NO_TRANS_BELI` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `KODE_BARANG` varchar(20) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL,
  `DISC` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_jual`
--

CREATE TABLE `dtrans_jual` (
  `NO_TRANS_JUAL` varchar(20) NOT NULL,
  `KODE_BARANG` varchar(20) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL,
  `DISC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_booking`
--

CREATE TABLE `d_booking` (
  `NO_BOOKING` varchar(20) NOT NULL,
  `KODE_BARANG` varchar(20) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_hutang`
--

CREATE TABLE `d_hutang` (
  `NO_HUTANG` varchar(20) CHARACTER SET latin1 NOT NULL,
  `TGL_BAYAR` date NOT NULL,
  `TOTAL_BAYAR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `d_piutang`
--

CREATE TABLE `d_piutang` (
  `NO_PIUTANG` varchar(20) CHARACTER SET latin1 NOT NULL,
  `TGL_PIUTANG` date NOT NULL,
  `TOTAL_BAYAR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hretur_beli`
--

CREATE TABLE `hretur_beli` (
  `NO_RETUR_BELI` varchar(10) NOT NULL,
  `NO_TRANS_BELI` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `TGL_RETUR_BELI` date NOT NULL,
  `TOTAL_RETUR_BELI` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hretur_jual`
--

CREATE TABLE `hretur_jual` (
  `NO_RETUR_JUAL` varchar(20) NOT NULL,
  `NO_TRANS_JUAL` varchar(20) CHARACTER SET latin1 NOT NULL,
  `TGL_RETUR_JUAL` date NOT NULL,
  `TOTAL_RETUR_JUAL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `htrans_beli`
--

CREATE TABLE `htrans_beli` (
  `NO_TRANS_BELI` varchar(20) NOT NULL,
  `KD_SUPPLIER` varchar(20) CHARACTER SET latin1 NOT NULL,
  `KODE_BAYAR` char(10) CHARACTER SET latin1 NOT NULL,
  `NOMOR_PO` varchar(50) NOT NULL,
  `TGL_TRANS_BELI` date NOT NULL,
  `TGL_MAX_GARANSI` date DEFAULT NULL,
  `DISC` float DEFAULT NULL,
  `TOTAL_BAYAR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `htrans_jual`
--

CREATE TABLE `htrans_jual` (
  `NO_TRANS_JUAL` varchar(20) NOT NULL,
  `KODE_PROMO` varchar(10) DEFAULT NULL,
  `KODE_JASA` varchar(10) DEFAULT NULL,
  `KODE_BAYAR` varchar(10) DEFAULT NULL,
  `NO_BOOKING` varchar(20) DEFAULT NULL,
  `TGL_TRANS_JUAL` date DEFAULT NULL,
  `TOTAL_JUAL` decimal(10,0) DEFAULT NULL,
  `BAYAR_JUAL` decimal(10,0) DEFAULT NULL,
  `KEMBALI_JUAL` decimal(10,0) DEFAULT NULL,
  `TGL_MAX_GARANSI` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_hutang`
--

CREATE TABLE `h_hutang` (
  `NO_HUTANG` varchar(20) NOT NULL,
  `KODE_BAYAR` char(10) DEFAULT NULL,
  `NO_TRANS_BELI` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `TGL_HUTANG` date DEFAULT NULL,
  `TOTAL_HUTANG` decimal(10,0) DEFAULT NULL,
  `BAYAR_HUTANG` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_piutang`
--

CREATE TABLE `h_piutang` (
  `NO_PIUTANG` varchar(20) NOT NULL,
  `NO_TRANS_JUAL` varchar(20) NOT NULL,
  `KODE_BAYAR` char(10) DEFAULT NULL,
  `TGL_PIUTANG` date DEFAULT NULL,
  `TOTAL_PIUTANG` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `KODE_JASA` varchar(10) NOT NULL,
  `NAMA_JASA` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `koreksi`
--

CREATE TABLE `koreksi` (
  `NO_KOREKSI` varchar(20) NOT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `TGL_KOREKSI` date NOT NULL,
  `JUMLAH` int(11) NOT NULL,
  `JENIS` enum('IN','OUT') NOT NULL,
  `KETERANGAN` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `KODE_KOTA` varchar(10) NOT NULL,
  `NAMA_KOTA` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `KODE_LEVEL` varchar(10) NOT NULL,
  `NAMA_LEVEL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`KODE_LEVEL`, `NAMA_LEVEL`) VALUES
('1', 'Owner'),
('2', 'Admin'),
('3', 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `KODE_MEREK` varchar(10) NOT NULL,
  `NAMA_MEREK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `KODE_PEGAWAI` varchar(10) NOT NULL,
  `NAMA_PEGAWAI` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`KODE_PEGAWAI`, `NAMA_PEGAWAI`) VALUES
('A001', 'Nurul'),
('A002', 'Tutik'),
('K001', 'Fian'),
('O001', 'Hasan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `KODE_BAYAR` char(10) NOT NULL,
  `NAMA_BAYAR` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `KODE_PROMO` varchar(10) NOT NULL,
  `TGL_MULAI` date NOT NULL,
  `TGL_SELESAI` date NOT NULL,
  `NAMA_PROMO` varchar(20) DEFAULT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `QTY_SK` int(11) NOT NULL,
  `DISC` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `KODE_SATUAN` varchar(10) NOT NULL,
  `NAMA_SATUAN` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subtitusi`
--

CREATE TABLE `subtitusi` (
  `TGL_SUBTITUSI` date NOT NULL,
  `NO_SUBTITUSI` varchar(20) NOT NULL,
  `KODE_BARANG1` varchar(20) NOT NULL,
  `KODE_BARANG2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `KD_SUPPLIER` varchar(20) NOT NULL,
  `KODE_KOTA` varchar(10) DEFAULT NULL,
  `NAMA_SUPPLIER` varchar(20) DEFAULT NULL,
  `ALAMAT_SUPPLIER` varchar(200) DEFAULT NULL,
  `TELEPON_SUPPLIER` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `KODE_TIPE` varchar(10) NOT NULL,
  `NAMA_TIPE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `KODE_USER` varchar(20) NOT NULL,
  `LEVEL_USER` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `KODE_PEGAWAI` varchar(10) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `EMAIL_VERIFIED_AT` timestamp NULL DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `REMEMBER_TOKEN` varchar(255) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`KODE_USER`, `LEVEL_USER`, `KODE_PEGAWAI`, `EMAIL`, `EMAIL_VERIFIED_AT`, `PASSWORD`, `REMEMBER_TOKEN`, `CREATED_AT`, `UPDATED_AT`) VALUES
('admin1', '2', 'A001', 'admin@gmail.com', NULL, '$2y$10$Ktu04iC39Wu98QErXs5dlezFc5DmgAl0gCODUiaFHKjTVIay0ifKm', NULL, NULL, NULL),
('kasir1', '3', 'K001', 'kasir@gmail.com', NULL, '$2y$10$aBghtGc2Y7kmBcdZF61w...Vzh8Kpyw2QahA0Os49s60OweptXhBu', NULL, NULL, NULL),
('owner1', '1', 'O001', 'owner@gmail.com', NULL, '$2y$10$vN1IiVyQTwxcKejwo6HJE.UCpqxU/YT4c/l4/DwSzinnqr/AaKGeu', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`KODE_BARANG`),
  ADD KEY `RELATIONSHIP_1_FK` (`KODE_MEREK`),
  ADD KEY `RELATIONSHIP_2_FK` (`KODE_TIPE`),
  ADD KEY `KODE_SATUAN_BARANG` (`KODE_SATUAN`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`NO_BOOKING`),
  ADD KEY `KODE_CUSTOMER` (`KODE_CUSTOMER`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`KODE_CUSTOMER`),
  ADD KEY `KODE_KOTA` (`KODE_KOTA`);

--
-- Indexes for table `dretur_beli`
--
ALTER TABLE `dretur_beli`
  ADD KEY `NO_RETUR_BELI` (`NO_RETUR_BELI`),
  ADD KEY `KODE_BARANG_RETUR_BELI` (`KODE_BARANG`);

--
-- Indexes for table `dretur_jual`
--
ALTER TABLE `dretur_jual`
  ADD KEY `NO_RETUR_JUAL` (`NO_RETUR_JUAL`),
  ADD KEY `KODE_BARANG` (`KODE_BARANG`);

--
-- Indexes for table `dtrans_beli`
--
ALTER TABLE `dtrans_beli`
  ADD KEY `NO_TRANS_BELI` (`NO_TRANS_BELI`),
  ADD KEY `KODE_BARANG_TRANS_BELI` (`KODE_BARANG`);

--
-- Indexes for table `dtrans_jual`
--
ALTER TABLE `dtrans_jual`
  ADD KEY `NO_TRANS_JUAL_DETAIL` (`NO_TRANS_JUAL`),
  ADD KEY `KODE_BARANG_DETAIL` (`KODE_BARANG`);

--
-- Indexes for table `d_booking`
--
ALTER TABLE `d_booking`
  ADD KEY `KODE_BARANG_BOOKING` (`KODE_BARANG`),
  ADD KEY `NO_BOOKING_DETAIL` (`NO_BOOKING`);

--
-- Indexes for table `d_hutang`
--
ALTER TABLE `d_hutang`
  ADD KEY `NO_HUTANG_D` (`NO_HUTANG`);

--
-- Indexes for table `hretur_beli`
--
ALTER TABLE `hretur_beli`
  ADD PRIMARY KEY (`NO_RETUR_BELI`),
  ADD KEY `NO_TRANS_BELI_RETUR` (`NO_TRANS_BELI`);

--
-- Indexes for table `hretur_jual`
--
ALTER TABLE `hretur_jual`
  ADD PRIMARY KEY (`NO_RETUR_JUAL`),
  ADD KEY `NO_TRANS_JUAL` (`NO_TRANS_JUAL`);

--
-- Indexes for table `htrans_beli`
--
ALTER TABLE `htrans_beli`
  ADD PRIMARY KEY (`NO_TRANS_BELI`),
  ADD KEY `KD_SUPPLIER` (`KD_SUPPLIER`),
  ADD KEY `KODE_BAYAR_TRANS_BELI` (`KODE_BAYAR`);

--
-- Indexes for table `htrans_jual`
--
ALTER TABLE `htrans_jual`
  ADD PRIMARY KEY (`NO_TRANS_JUAL`),
  ADD KEY `KODE_BAYAR_TRANS_JUAL` (`KODE_BAYAR`),
  ADD KEY `KODE_PROMO_TRANS_JUAL` (`KODE_PROMO`),
  ADD KEY `KODE_JASA_TRANS_JUAL` (`KODE_JASA`),
  ADD KEY `NO_BOOKING_TRANS_JUAL` (`NO_BOOKING`);

--
-- Indexes for table `h_hutang`
--
ALTER TABLE `h_hutang`
  ADD PRIMARY KEY (`NO_HUTANG`),
  ADD KEY `KODE_BAYAR_HUTANG` (`KODE_BAYAR`),
  ADD KEY `NO_TRANS_BELI_HUTANG` (`NO_TRANS_BELI`);

--
-- Indexes for table `h_piutang`
--
ALTER TABLE `h_piutang`
  ADD PRIMARY KEY (`NO_PIUTANG`),
  ADD KEY `NO_TRANS_JUAL_PIUTANG` (`NO_TRANS_JUAL`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`KODE_JASA`);

--
-- Indexes for table `koreksi`
--
ALTER TABLE `koreksi`
  ADD PRIMARY KEY (`NO_KOREKSI`),
  ADD KEY `KODE_BARANG_KOREKSI` (`KODE_BARANG`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`KODE_KOTA`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`KODE_LEVEL`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`KODE_MEREK`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`KODE_PEGAWAI`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`KODE_BAYAR`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`KODE_PROMO`),
  ADD KEY `KODE_BARANG_PROMO` (`KODE_BARANG`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`KODE_SATUAN`);

--
-- Indexes for table `subtitusi`
--
ALTER TABLE `subtitusi`
  ADD PRIMARY KEY (`NO_SUBTITUSI`),
  ADD KEY `KODE_BARANG1_D_SUBTITUSI` (`KODE_BARANG1`),
  ADD KEY `KODE_BARANG2_D_SUBTITUSI` (`KODE_BARANG2`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`KD_SUPPLIER`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`KODE_TIPE`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`KODE_USER`),
  ADD KEY `KODE_LEVEL_USER` (`LEVEL_USER`),
  ADD KEY `KODE_PEGAWAI_USER` (`KODE_PEGAWAI`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `KODE_MEREK_BARANG` FOREIGN KEY (`KODE_MEREK`) REFERENCES `merek` (`KODE_MEREK`),
  ADD CONSTRAINT `KODE_SATUAN_BARANG` FOREIGN KEY (`KODE_SATUAN`) REFERENCES `satuan` (`KODE_SATUAN`),
  ADD CONSTRAINT `KODE_TIPE_BARANG` FOREIGN KEY (`KODE_TIPE`) REFERENCES `tipe` (`KODE_TIPE`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `KODE_CUSTOMER` FOREIGN KEY (`KODE_CUSTOMER`) REFERENCES `customer` (`KODE_CUSTOMER`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `KODE_KOTA` FOREIGN KEY (`KODE_KOTA`) REFERENCES `kota` (`KODE_KOTA`);

--
-- Constraints for table `dretur_beli`
--
ALTER TABLE `dretur_beli`
  ADD CONSTRAINT `KODE_BARANG_RETUR_BELI` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  ADD CONSTRAINT `NO_RETUR_BELI` FOREIGN KEY (`NO_RETUR_BELI`) REFERENCES `hretur_beli` (`NO_RETUR_BELI`);

--
-- Constraints for table `dretur_jual`
--
ALTER TABLE `dretur_jual`
  ADD CONSTRAINT `KODE_BARANG` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  ADD CONSTRAINT `NO_RETUR_JUAL` FOREIGN KEY (`NO_RETUR_JUAL`) REFERENCES `hretur_jual` (`NO_RETUR_JUAL`);

--
-- Constraints for table `dtrans_beli`
--
ALTER TABLE `dtrans_beli`
  ADD CONSTRAINT `KODE_BARANG_TRANS_BELI` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  ADD CONSTRAINT `NO_TRANS_BELI` FOREIGN KEY (`NO_TRANS_BELI`) REFERENCES `htrans_beli` (`NO_TRANS_BELI`);

--
-- Constraints for table `dtrans_jual`
--
ALTER TABLE `dtrans_jual`
  ADD CONSTRAINT `KODE_BARANG_DETAIL` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  ADD CONSTRAINT `NO_TRANS_JUAL_DETAIL` FOREIGN KEY (`NO_TRANS_JUAL`) REFERENCES `htrans_jual` (`NO_TRANS_JUAL`);

--
-- Constraints for table `d_booking`
--
ALTER TABLE `d_booking`
  ADD CONSTRAINT `KODE_BARANG_BOOKING` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  ADD CONSTRAINT `NO_BOOKING_DETAIL` FOREIGN KEY (`NO_BOOKING`) REFERENCES `booking` (`NO_BOOKING`);

--
-- Constraints for table `d_hutang`
--
ALTER TABLE `d_hutang`
  ADD CONSTRAINT `NO_HUTANG_D` FOREIGN KEY (`NO_HUTANG`) REFERENCES `h_hutang` (`NO_HUTANG`);

--
-- Constraints for table `hretur_beli`
--
ALTER TABLE `hretur_beli`
  ADD CONSTRAINT `NO_TRANS_BELI_RETUR` FOREIGN KEY (`NO_TRANS_BELI`) REFERENCES `htrans_beli` (`NO_TRANS_BELI`);

--
-- Constraints for table `hretur_jual`
--
ALTER TABLE `hretur_jual`
  ADD CONSTRAINT `NO_TRANS_JUAL` FOREIGN KEY (`NO_TRANS_JUAL`) REFERENCES `htrans_jual` (`NO_TRANS_JUAL`);

--
-- Constraints for table `htrans_beli`
--
ALTER TABLE `htrans_beli`
  ADD CONSTRAINT `KD_SUPPLIER` FOREIGN KEY (`KD_SUPPLIER`) REFERENCES `supplier` (`KD_SUPPLIER`),
  ADD CONSTRAINT `KODE_BAYAR_TRANS_BELI` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`);

--
-- Constraints for table `htrans_jual`
--
ALTER TABLE `htrans_jual`
  ADD CONSTRAINT `KODE_BAYAR_TRANS_JUAL` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`),
  ADD CONSTRAINT `KODE_JASA_TRANS_JUAL` FOREIGN KEY (`KODE_JASA`) REFERENCES `jasa` (`KODE_JASA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `KODE_PROMO_TRANS_JUAL` FOREIGN KEY (`KODE_PROMO`) REFERENCES `promo` (`KODE_PROMO`),
  ADD CONSTRAINT `NO_BOOKING_TRANS_JUAL` FOREIGN KEY (`NO_BOOKING`) REFERENCES `booking` (`NO_BOOKING`);

--
-- Constraints for table `h_hutang`
--
ALTER TABLE `h_hutang`
  ADD CONSTRAINT `KODE_BAYAR_HUTANG` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`),
  ADD CONSTRAINT `NO_TRANS_BELI_HUTANG` FOREIGN KEY (`NO_TRANS_BELI`) REFERENCES `htrans_beli` (`NO_TRANS_BELI`);

--
-- Constraints for table `h_piutang`
--
ALTER TABLE `h_piutang`
  ADD CONSTRAINT `NO_TRANS_JUAL_PIUTANG` FOREIGN KEY (`NO_TRANS_JUAL`) REFERENCES `htrans_jual` (`NO_TRANS_JUAL`);

--
-- Constraints for table `koreksi`
--
ALTER TABLE `koreksi`
  ADD CONSTRAINT `KODE_BARANG_KOREKSI` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`);

--
-- Constraints for table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `KODE_BARANG_PROMO` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`);

--
-- Constraints for table `subtitusi`
--
ALTER TABLE `subtitusi`
  ADD CONSTRAINT `KODE_BARANG1_D_SUBTITUSI` FOREIGN KEY (`KODE_BARANG1`) REFERENCES `barang` (`KODE_BARANG`),
  ADD CONSTRAINT `KODE_BARANG2_D_SUBTITUSI` FOREIGN KEY (`KODE_BARANG2`) REFERENCES `barang` (`KODE_BARANG`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `KODE_LEVEL_USER` FOREIGN KEY (`LEVEL_USER`) REFERENCES `level_user` (`KODE_LEVEL`),
  ADD CONSTRAINT `KODE_PEGAWAI_USER` FOREIGN KEY (`KODE_PEGAWAI`) REFERENCES `pegawai` (`KODE_PEGAWAI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
