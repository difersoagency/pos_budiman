-- MySQL dump 10.13  Distrib 5.7.33, for Win64 (x86_64)
--
-- Host: localhost    Database: ta_budiman
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `KODE_BARANG` varchar(20) NOT NULL,
  `KODE_TIPE` varchar(10) DEFAULT NULL,
  `KODE_MEREK` varchar(10) DEFAULT NULL,
  `NAMA_BARANG` varchar(20) NOT NULL,
  `KODE_SATUAN` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `STOK` int(11) NOT NULL,
  `HARGA_BELI` float NOT NULL,
  `HARGA_JUAL` float NOT NULL,
  PRIMARY KEY (`KODE_BARANG`),
  KEY `RELATIONSHIP_1_FK` (`KODE_MEREK`),
  KEY `RELATIONSHIP_2_FK` (`KODE_TIPE`),
  KEY `KODE_SATUAN_BARANG` (`KODE_SATUAN`),
  CONSTRAINT `KODE_MEREK_BARANG` FOREIGN KEY (`KODE_MEREK`) REFERENCES `merek` (`KODE_MEREK`),
  CONSTRAINT `KODE_SATUAN_BARANG` FOREIGN KEY (`KODE_SATUAN`) REFERENCES `satuan` (`KODE_SATUAN`),
  CONSTRAINT `KODE_TIPE_BARANG` FOREIGN KEY (`KODE_TIPE`) REFERENCES `tipe` (`KODE_TIPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `NO_BOOKING` varchar(20) NOT NULL,
  `TGL_BOOKING` date DEFAULT NULL,
  `KODE_CUSTOMER` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`NO_BOOKING`),
  KEY `KODE_CUSTOMER` (`KODE_CUSTOMER`),
  CONSTRAINT `KODE_CUSTOMER` FOREIGN KEY (`KODE_CUSTOMER`) REFERENCES `customer` (`KODE_CUSTOMER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `KODE_CUSTOMER` varchar(50) NOT NULL,
  `KODE_KOTA` varchar(10) CHARACTER SET latin1 NOT NULL,
  `NAMA_CUSTOMER` varchar(100) NOT NULL,
  `ALAMAT` text,
  `TELEPON` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KODE_CUSTOMER`),
  KEY `KODE_KOTA` (`KODE_KOTA`),
  CONSTRAINT `KODE_KOTA` FOREIGN KEY (`KODE_KOTA`) REFERENCES `kota` (`KODE_KOTA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_booking`
--

DROP TABLE IF EXISTS `d_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_booking` (
  `NO_BOOKING` varchar(20) NOT NULL,
  `KODE_BARANG` varchar(20) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  KEY `KODE_BARANG_BOOKING` (`KODE_BARANG`),
  KEY `NO_BOOKING_DETAIL` (`NO_BOOKING`),
  CONSTRAINT `KODE_BARANG_BOOKING` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  CONSTRAINT `NO_BOOKING_DETAIL` FOREIGN KEY (`NO_BOOKING`) REFERENCES `booking` (`NO_BOOKING`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_booking`
--

LOCK TABLES `d_booking` WRITE;
/*!40000 ALTER TABLE `d_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_hutang`
--

DROP TABLE IF EXISTS `d_hutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_hutang` (
  `NO_HUTANG` varchar(20) CHARACTER SET latin1 NOT NULL,
  `TGL_BAYAR` date NOT NULL,
  `TOTAL_BAYAR` float NOT NULL,
  KEY `NO_HUTANG_D` (`NO_HUTANG`),
  CONSTRAINT `NO_HUTANG_D` FOREIGN KEY (`NO_HUTANG`) REFERENCES `h_hutang` (`NO_HUTANG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_hutang`
--

LOCK TABLES `d_hutang` WRITE;
/*!40000 ALTER TABLE `d_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_hutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_piutang`
--

DROP TABLE IF EXISTS `d_piutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_piutang` (
  `NO_PIUTANG` varchar(20) CHARACTER SET latin1 NOT NULL,
  `TGL_PIUTANG` date NOT NULL,
  `TOTAL_BAYAR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_piutang`
--

LOCK TABLES `d_piutang` WRITE;
/*!40000 ALTER TABLE `d_piutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_piutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dretur_beli`
--

DROP TABLE IF EXISTS `dretur_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dretur_beli` (
  `NO_RETUR_BELI` varchar(10) NOT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL,
  KEY `NO_RETUR_BELI` (`NO_RETUR_BELI`),
  KEY `KODE_BARANG_RETUR_BELI` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG_RETUR_BELI` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  CONSTRAINT `NO_RETUR_BELI` FOREIGN KEY (`NO_RETUR_BELI`) REFERENCES `hretur_beli` (`NO_RETUR_BELI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dretur_beli`
--

LOCK TABLES `dretur_beli` WRITE;
/*!40000 ALTER TABLE `dretur_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `dretur_beli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dretur_jual`
--

DROP TABLE IF EXISTS `dretur_jual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dretur_jual` (
  `NO_RETUR_JUAL` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL,
  KEY `NO_RETUR_JUAL` (`NO_RETUR_JUAL`),
  KEY `KODE_BARANG` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  CONSTRAINT `NO_RETUR_JUAL` FOREIGN KEY (`NO_RETUR_JUAL`) REFERENCES `hretur_jual` (`NO_RETUR_JUAL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dretur_jual`
--

LOCK TABLES `dretur_jual` WRITE;
/*!40000 ALTER TABLE `dretur_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `dretur_jual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dtrans_beli`
--

DROP TABLE IF EXISTS `dtrans_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dtrans_beli` (
  `NO_TRANS_BELI` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `KODE_BARANG` varchar(20) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL,
  `DISC` float DEFAULT NULL,
  KEY `NO_TRANS_BELI` (`NO_TRANS_BELI`),
  KEY `KODE_BARANG_TRANS_BELI` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG_TRANS_BELI` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  CONSTRAINT `NO_TRANS_BELI` FOREIGN KEY (`NO_TRANS_BELI`) REFERENCES `htrans_beli` (`NO_TRANS_BELI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtrans_beli`
--

LOCK TABLES `dtrans_beli` WRITE;
/*!40000 ALTER TABLE `dtrans_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `dtrans_beli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dtrans_jual`
--

DROP TABLE IF EXISTS `dtrans_jual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dtrans_jual` (
  `NO_TRANS_JUAL` varchar(20) NOT NULL,
  `KODE_BARANG` varchar(20) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA` float NOT NULL,
  `DISC` int(11) DEFAULT NULL,
  KEY `NO_TRANS_JUAL_DETAIL` (`NO_TRANS_JUAL`),
  KEY `KODE_BARANG_DETAIL` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG_DETAIL` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`),
  CONSTRAINT `NO_TRANS_JUAL_DETAIL` FOREIGN KEY (`NO_TRANS_JUAL`) REFERENCES `htrans_jual` (`NO_TRANS_JUAL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtrans_jual`
--

LOCK TABLES `dtrans_jual` WRITE;
/*!40000 ALTER TABLE `dtrans_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `dtrans_jual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_hutang`
--

DROP TABLE IF EXISTS `h_hutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_hutang` (
  `NO_HUTANG` varchar(20) NOT NULL,
  `KODE_BAYAR` char(10) DEFAULT NULL,
  `NO_TRANS_BELI` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `TGL_HUTANG` date DEFAULT NULL,
  `TOTAL_HUTANG` decimal(10,0) DEFAULT NULL,
  `BAYAR_HUTANG` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`NO_HUTANG`),
  KEY `KODE_BAYAR_HUTANG` (`KODE_BAYAR`),
  KEY `NO_TRANS_BELI_HUTANG` (`NO_TRANS_BELI`),
  CONSTRAINT `KODE_BAYAR_HUTANG` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`),
  CONSTRAINT `NO_TRANS_BELI_HUTANG` FOREIGN KEY (`NO_TRANS_BELI`) REFERENCES `htrans_beli` (`NO_TRANS_BELI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_hutang`
--

LOCK TABLES `h_hutang` WRITE;
/*!40000 ALTER TABLE `h_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_hutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_piutang`
--

DROP TABLE IF EXISTS `h_piutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_piutang` (
  `NO_PIUTANG` varchar(20) NOT NULL,
  `NO_TRANS_JUAL` varchar(20) NOT NULL,
  `KODE_BAYAR` char(10) DEFAULT NULL,
  `TGL_PIUTANG` date DEFAULT NULL,
  `TOTAL_PIUTANG` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`NO_PIUTANG`),
  KEY `NO_TRANS_JUAL_PIUTANG` (`NO_TRANS_JUAL`),
  CONSTRAINT `NO_TRANS_JUAL_PIUTANG` FOREIGN KEY (`NO_TRANS_JUAL`) REFERENCES `htrans_jual` (`NO_TRANS_JUAL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_piutang`
--

LOCK TABLES `h_piutang` WRITE;
/*!40000 ALTER TABLE `h_piutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_piutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hretur_beli`
--

DROP TABLE IF EXISTS `hretur_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hretur_beli` (
  `NO_RETUR_BELI` varchar(10) NOT NULL,
  `NO_TRANS_BELI` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `TGL_RETUR_BELI` date NOT NULL,
  `TOTAL_RETUR_BELI` float DEFAULT NULL,
  PRIMARY KEY (`NO_RETUR_BELI`),
  KEY `NO_TRANS_BELI_RETUR` (`NO_TRANS_BELI`),
  CONSTRAINT `NO_TRANS_BELI_RETUR` FOREIGN KEY (`NO_TRANS_BELI`) REFERENCES `htrans_beli` (`NO_TRANS_BELI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hretur_beli`
--

LOCK TABLES `hretur_beli` WRITE;
/*!40000 ALTER TABLE `hretur_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `hretur_beli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hretur_jual`
--

DROP TABLE IF EXISTS `hretur_jual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hretur_jual` (
  `NO_RETUR_JUAL` varchar(20) NOT NULL,
  `NO_TRANS_JUAL` varchar(20) CHARACTER SET latin1 NOT NULL,
  `TGL_RETUR_JUAL` date NOT NULL,
  `TOTAL_RETUR_JUAL` float NOT NULL,
  PRIMARY KEY (`NO_RETUR_JUAL`),
  KEY `NO_TRANS_JUAL` (`NO_TRANS_JUAL`),
  CONSTRAINT `NO_TRANS_JUAL` FOREIGN KEY (`NO_TRANS_JUAL`) REFERENCES `htrans_jual` (`NO_TRANS_JUAL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hretur_jual`
--

LOCK TABLES `hretur_jual` WRITE;
/*!40000 ALTER TABLE `hretur_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `hretur_jual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `htrans_beli`
--

DROP TABLE IF EXISTS `htrans_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htrans_beli` (
  `NO_TRANS_BELI` varchar(20) NOT NULL,
  `KD_SUPPLIER` varchar(20) CHARACTER SET latin1 NOT NULL,
  `KODE_BAYAR` char(10) CHARACTER SET latin1 NOT NULL,
  `NOMOR_PO` varchar(50) NOT NULL,
  `TGL_TRANS_BELI` date NOT NULL,
  `TGL_MAX_GARANSI` date DEFAULT NULL,
  `DISC` float DEFAULT NULL,
  `TOTAL_BAYAR` float NOT NULL,
  PRIMARY KEY (`NO_TRANS_BELI`),
  KEY `KD_SUPPLIER` (`KD_SUPPLIER`),
  KEY `KODE_BAYAR_TRANS_BELI` (`KODE_BAYAR`),
  CONSTRAINT `KD_SUPPLIER` FOREIGN KEY (`KD_SUPPLIER`) REFERENCES `supplier` (`KD_SUPPLIER`),
  CONSTRAINT `KODE_BAYAR_TRANS_BELI` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `htrans_beli`
--

LOCK TABLES `htrans_beli` WRITE;
/*!40000 ALTER TABLE `htrans_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `htrans_beli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `htrans_jual`
--

DROP TABLE IF EXISTS `htrans_jual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `TGL_MAX_GARANSI` date DEFAULT NULL,
  PRIMARY KEY (`NO_TRANS_JUAL`),
  KEY `KODE_BAYAR_TRANS_JUAL` (`KODE_BAYAR`),
  KEY `KODE_PROMO_TRANS_JUAL` (`KODE_PROMO`),
  KEY `KODE_JASA_TRANS_JUAL` (`KODE_JASA`),
  KEY `NO_BOOKING_TRANS_JUAL` (`NO_BOOKING`),
  CONSTRAINT `KODE_BAYAR_TRANS_JUAL` FOREIGN KEY (`KODE_BAYAR`) REFERENCES `pembayaran` (`KODE_BAYAR`),
  CONSTRAINT `KODE_JASA_TRANS_JUAL` FOREIGN KEY (`KODE_JASA`) REFERENCES `jasa` (`KODE_JASA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `KODE_PROMO_TRANS_JUAL` FOREIGN KEY (`KODE_PROMO`) REFERENCES `promo` (`KODE_PROMO`),
  CONSTRAINT `NO_BOOKING_TRANS_JUAL` FOREIGN KEY (`NO_BOOKING`) REFERENCES `booking` (`NO_BOOKING`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `htrans_jual`
--

LOCK TABLES `htrans_jual` WRITE;
/*!40000 ALTER TABLE `htrans_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `htrans_jual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jasa`
--

DROP TABLE IF EXISTS `jasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jasa` (
  `KODE_JASA` varchar(10) NOT NULL,
  `NAMA_JASA` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KODE_JASA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jasa`
--

LOCK TABLES `jasa` WRITE;
/*!40000 ALTER TABLE `jasa` DISABLE KEYS */;
/*!40000 ALTER TABLE `jasa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koreksi`
--

DROP TABLE IF EXISTS `koreksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koreksi` (
  `NO_KOREKSI` varchar(20) NOT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `TGL_KOREKSI` date NOT NULL,
  `JUMLAH` int(11) NOT NULL,
  `JENIS` enum('IN','OUT') NOT NULL,
  `KETERANGAN` text,
  PRIMARY KEY (`NO_KOREKSI`),
  KEY `KODE_BARANG_KOREKSI` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG_KOREKSI` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koreksi`
--

LOCK TABLES `koreksi` WRITE;
/*!40000 ALTER TABLE `koreksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `koreksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kota`
--

DROP TABLE IF EXISTS `kota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kota` (
  `KODE_KOTA` varchar(10) NOT NULL,
  `NAMA_KOTA` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KODE_KOTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kota`
--

LOCK TABLES `kota` WRITE;
/*!40000 ALTER TABLE `kota` DISABLE KEYS */;
/*!40000 ALTER TABLE `kota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level_user`
--

DROP TABLE IF EXISTS `level_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level_user` (
  `KODE_LEVEL` varchar(10) NOT NULL,
  `NAMA_LEVEL` varchar(20) NOT NULL,
  PRIMARY KEY (`KODE_LEVEL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level_user`
--

LOCK TABLES `level_user` WRITE;
/*!40000 ALTER TABLE `level_user` DISABLE KEYS */;
INSERT INTO `level_user` VALUES ('1','Owner'),('2','Admin'),('3','Kasir');
/*!40000 ALTER TABLE `level_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merek`
--

DROP TABLE IF EXISTS `merek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merek` (
  `KODE_MEREK` varchar(10) NOT NULL,
  `NAMA_MEREK` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KODE_MEREK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merek`
--

LOCK TABLES `merek` WRITE;
/*!40000 ALTER TABLE `merek` DISABLE KEYS */;
/*!40000 ALTER TABLE `merek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pegawai` (
  `KODE_PEGAWAI` varchar(10) NOT NULL,
  `NAMA_PEGAWAI` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KODE_PEGAWAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pegawai`
--

LOCK TABLES `pegawai` WRITE;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
INSERT INTO `pegawai` VALUES ('A001','Nurul'),('A002','Tutik'),('K001','Fian'),('O001','Hasan');
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `KODE_BAYAR` char(10) NOT NULL,
  `NAMA_BAYAR` char(10) DEFAULT NULL,
  PRIMARY KEY (`KODE_BAYAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo` (
  `KODE_PROMO` varchar(10) NOT NULL,
  `TGL_MULAI` date NOT NULL,
  `TGL_SELESAI` date NOT NULL,
  `NAMA_PROMO` varchar(20) DEFAULT NULL,
  `KODE_BARANG` varchar(20) NOT NULL,
  `QTY_SK` int(11) NOT NULL,
  `DISC` decimal(10,0) NOT NULL,
  PRIMARY KEY (`KODE_PROMO`),
  KEY `KODE_BARANG_PROMO` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG_PROMO` FOREIGN KEY (`KODE_BARANG`) REFERENCES `barang` (`KODE_BARANG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `satuan`
--

DROP TABLE IF EXISTS `satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `satuan` (
  `KODE_SATUAN` varchar(10) NOT NULL,
  `NAMA_SATUAN` varchar(15) NOT NULL,
  PRIMARY KEY (`KODE_SATUAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satuan`
--

LOCK TABLES `satuan` WRITE;
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtitusi`
--

DROP TABLE IF EXISTS `subtitusi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtitusi` (
  `TGL_SUBTITUSI` date NOT NULL,
  `NO_SUBTITUSI` varchar(20) NOT NULL,
  `KODE_BARANG1` varchar(20) NOT NULL,
  `KODE_BARANG2` varchar(20) NOT NULL,
  PRIMARY KEY (`NO_SUBTITUSI`),
  KEY `KODE_BARANG1_D_SUBTITUSI` (`KODE_BARANG1`),
  KEY `KODE_BARANG2_D_SUBTITUSI` (`KODE_BARANG2`),
  CONSTRAINT `KODE_BARANG1_D_SUBTITUSI` FOREIGN KEY (`KODE_BARANG1`) REFERENCES `barang` (`KODE_BARANG`),
  CONSTRAINT `KODE_BARANG2_D_SUBTITUSI` FOREIGN KEY (`KODE_BARANG2`) REFERENCES `barang` (`KODE_BARANG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtitusi`
--

LOCK TABLES `subtitusi` WRITE;
/*!40000 ALTER TABLE `subtitusi` DISABLE KEYS */;
/*!40000 ALTER TABLE `subtitusi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `KD_SUPPLIER` varchar(20) NOT NULL,
  `KODE_KOTA` varchar(10) DEFAULT NULL,
  `NAMA_SUPPLIER` varchar(20) DEFAULT NULL,
  `ALAMAT_SUPPLIER` varchar(200) DEFAULT NULL,
  `TELEPON_SUPPLIER` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KD_SUPPLIER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipe`
--

DROP TABLE IF EXISTS `tipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipe` (
  `KODE_TIPE` varchar(10) NOT NULL,
  `NAMA_TIPE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`KODE_TIPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipe`
--

LOCK TABLES `tipe` WRITE;
/*!40000 ALTER TABLE `tipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `KODE_USER` varchar(20) NOT NULL,
  `KODE_LEVEL` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `KODE_PEGAWAI` varchar(10) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `EMAIL_VERIFIED_AT` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `REMEMBER_TOKEN` varchar(255) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`KODE_USER`),
  KEY `KODE_LEVEL_USER` (`KODE_LEVEL`),
  KEY `KODE_PEGAWAI_USER` (`KODE_PEGAWAI`),
  CONSTRAINT `KODE_LEVEL_USER` FOREIGN KEY (`KODE_LEVEL`) REFERENCES `level_user` (`KODE_LEVEL`),
  CONSTRAINT `KODE_PEGAWAI_USER` FOREIGN KEY (`KODE_PEGAWAI`) REFERENCES `pegawai` (`KODE_PEGAWAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin1','2','A001','admin@gmail.com','2022-08-30 13:49:13','$2y$10$Ktu04iC39Wu98QErXs5dlezFc5DmgAl0gCODUiaFHKjTVIay0ifKm',NULL,NULL,NULL),('kasir1','3','K001','kasir@gmail.com','2022-08-30 13:49:13','$2y$10$aBghtGc2Y7kmBcdZF61w...Vzh8Kpyw2QahA0Os49s60OweptXhBu',NULL,NULL,NULL),('owner1','1','O001','owner@gmail.com','2022-08-30 13:49:13','$2y$10$vN1IiVyQTwxcKejwo6HJE.UCpqxU/YT4c/l4/DwSzinnqr/AaKGeu',NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ta_budiman'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-14 16:53:16
