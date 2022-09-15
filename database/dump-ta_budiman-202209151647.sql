-- mysql dump 10.13  distrib 5.7.33, for win64 (x86_64)
--
-- host: localhost    database: ta_budiman
-- ------------------------------------------------------
-- server version	5.7.33

/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!40101 set names utf8 */;
/*!40103 set @old_time_zone=@@time_zone */;
/*!40103 set time_zone='+00:00' */;
/*!40014 set @old_unique_checks=@@unique_checks, unique_checks=0 */;
/*!40014 set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0 */;
/*!40101 set @old_sql_mode=@@sql_mode, sql_mode='no_auto_value_on_zero' */;
/*!40111 set @old_sql_notes=@@sql_notes, sql_notes=0 */;

--
-- table structure for table `barang`
--

drop table if exists `barang`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `barang` (
  `kode_barang` varchar(20) not null,
  `kode_tipe` varchar(10) default null,
  `kode_merek` varchar(10) default null,
  `nama_barang` varchar(20) not null,
  `kode_satuan` varchar(10) character set utf8mb4 not null,
  `stok` int(11) not null,
  `harga_beli` float not null,
  `harga_jual` float not null,
  primary key (`kode_barang`),
  key `relationship_1_fk` (`kode_merek`),
  key `relationship_2_fk` (`kode_tipe`),
  key `kode_satuan_barang` (`kode_satuan`),
  constraint `kode_merek_barang` foreign key (`kode_merek`) references `merek` (`kode_merek`),
  constraint `kode_satuan_barang` foreign key (`kode_satuan`) references `satuan` (`kode_satuan`),
  constraint `kode_tipe_barang` foreign key (`kode_tipe`) references `tipe` (`kode_tipe`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `barang`
--

lock tables `barang` write;
/*!40000 alter table `barang` disable keys */;
/*!40000 alter table `barang` enable keys */;
unlock tables;

--
-- table structure for table `booking`
--

drop table if exists `booking`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `booking` (
  `no_booking` varchar(20) not null,
  `tgl_booking` date default null,
  `kode_customer` varchar(50) character set utf8mb4 not null,
  primary key (`no_booking`),
  key `kode_customer` (`kode_customer`),
  constraint `kode_customer` foreign key (`kode_customer`) references `customer` (`kode_customer`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `booking`
--

lock tables `booking` write;
/*!40000 alter table `booking` disable keys */;
/*!40000 alter table `booking` enable keys */;
unlock tables;

--
-- table structure for table `customer`
--

drop table if exists `customer`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `customer` (
  `kode_customer` varchar(50) not null,
  `kode_kota` varchar(10) character set latin1 not null,
  `nama_customer` varchar(100) not null,
  `alamat` text,
  `telepon` varchar(20) default null,
  primary key (`kode_customer`),
  key `kode_kota` (`kode_kota`),
  constraint `kode_kota` foreign key (`kode_kota`) references `kota` (`kode_kota`)
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `customer`
--

lock tables `customer` write;
/*!40000 alter table `customer` disable keys */;
/*!40000 alter table `customer` enable keys */;
unlock tables;

--
-- table structure for table `d_booking`
--

drop table if exists `d_booking`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `d_booking` (
  `no_booking` varchar(20) not null,
  `kode_barang` varchar(20) default null,
  `jumlah` int(11) default null,
  key `kode_barang_booking` (`kode_barang`),
  key `no_booking_detail` (`no_booking`),
  constraint `kode_barang_booking` foreign key (`kode_barang`) references `barang` (`kode_barang`),
  constraint `no_booking_detail` foreign key (`no_booking`) references `booking` (`no_booking`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `d_booking`
--

lock tables `d_booking` write;
/*!40000 alter table `d_booking` disable keys */;
/*!40000 alter table `d_booking` enable keys */;
unlock tables;

--
-- table structure for table `d_hutang`
--

drop table if exists `d_hutang`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `d_hutang` (
  `no_hutang` varchar(20) character set latin1 not null,
  `tgl_bayar` date not null,
  `total_bayar` float not null,
  key `no_hutang_d` (`no_hutang`),
  constraint `no_hutang_d` foreign key (`no_hutang`) references `h_hutang` (`no_hutang`)
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `d_hutang`
--

lock tables `d_hutang` write;
/*!40000 alter table `d_hutang` disable keys */;
/*!40000 alter table `d_hutang` enable keys */;
unlock tables;

--
-- table structure for table `d_piutang`
--

drop table if exists `d_piutang`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `d_piutang` (
  `no_piutang` varchar(20) character set latin1 not null,
  `tgl_piutang` date not null,
  `total_bayar` float not null
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `d_piutang`
--

lock tables `d_piutang` write;
/*!40000 alter table `d_piutang` disable keys */;
/*!40000 alter table `d_piutang` enable keys */;
unlock tables;

--
-- table structure for table `dretur_beli`
--

drop table if exists `dretur_beli`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `dretur_beli` (
  `no_retur_beli` varchar(10) not null,
  `kode_barang` varchar(20) not null,
  `jumlah` int(11) default null,
  `harga` float not null,
  key `no_retur_beli` (`no_retur_beli`),
  key `kode_barang_retur_beli` (`kode_barang`),
  constraint `kode_barang_retur_beli` foreign key (`kode_barang`) references `barang` (`kode_barang`),
  constraint `no_retur_beli` foreign key (`no_retur_beli`) references `hretur_beli` (`no_retur_beli`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `dretur_beli`
--

lock tables `dretur_beli` write;
/*!40000 alter table `dretur_beli` disable keys */;
/*!40000 alter table `dretur_beli` enable keys */;
unlock tables;

--
-- table structure for table `dretur_jual`
--

drop table if exists `dretur_jual`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `dretur_jual` (
  `no_retur_jual` varchar(20) character set utf8mb4 not null,
  `kode_barang` varchar(20) not null,
  `jumlah` int(11) default null,
  `harga` float not null,
  key `no_retur_jual` (`no_retur_jual`),
  key `kode_barang` (`kode_barang`),
  constraint `kode_barang` foreign key (`kode_barang`) references `barang` (`kode_barang`),
  constraint `no_retur_jual` foreign key (`no_retur_jual`) references `hretur_jual` (`no_retur_jual`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `dretur_jual`
--

lock tables `dretur_jual` write;
/*!40000 alter table `dretur_jual` disable keys */;
/*!40000 alter table `dretur_jual` enable keys */;
unlock tables;

--
-- table structure for table `dtrans_beli`
--

drop table if exists `dtrans_beli`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `dtrans_beli` (
  `no_trans_beli` varchar(20) character set utf8mb4 not null,
  `kode_barang` varchar(20) default null,
  `jumlah` int(11) default null,
  `harga` float not null,
  `disc` float default null,
  key `no_trans_beli` (`no_trans_beli`),
  key `kode_barang_trans_beli` (`kode_barang`),
  constraint `kode_barang_trans_beli` foreign key (`kode_barang`) references `barang` (`kode_barang`),
  constraint `no_trans_beli` foreign key (`no_trans_beli`) references `htrans_beli` (`no_trans_beli`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `dtrans_beli`
--

lock tables `dtrans_beli` write;
/*!40000 alter table `dtrans_beli` disable keys */;
/*!40000 alter table `dtrans_beli` enable keys */;
unlock tables;

--
-- table structure for table `dtrans_jual`
--

drop table if exists `dtrans_jual`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `dtrans_jual` (
  `no_trans_jual` varchar(20) not null,
  `kode_barang` varchar(20) default null,
  `jumlah` int(11) default null,
  `harga` float not null,
  `disc` int(11) default null,
  key `no_trans_jual_detail` (`no_trans_jual`),
  key `kode_barang_detail` (`kode_barang`),
  constraint `kode_barang_detail` foreign key (`kode_barang`) references `barang` (`kode_barang`),
  constraint `no_trans_jual_detail` foreign key (`no_trans_jual`) references `htrans_jual` (`no_trans_jual`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `dtrans_jual`
--

lock tables `dtrans_jual` write;
/*!40000 alter table `dtrans_jual` disable keys */;
/*!40000 alter table `dtrans_jual` enable keys */;
unlock tables;

--
-- table structure for table `h_hutang`
--

drop table if exists `h_hutang`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `h_hutang` (
  `no_hutang` varchar(20) not null,
  `kode_bayar` char(10) default null,
  `no_trans_beli` varchar(20) character set utf8mb4 not null,
  `tgl_hutang` date default null,
  `total_hutang` decimal(10,0) default null,
  `bayar_hutang` decimal(10,0) default null,
  primary key (`no_hutang`),
  key `kode_bayar_hutang` (`kode_bayar`),
  key `no_trans_beli_hutang` (`no_trans_beli`),
  constraint `kode_bayar_hutang` foreign key (`kode_bayar`) references `pembayaran` (`kode_bayar`),
  constraint `no_trans_beli_hutang` foreign key (`no_trans_beli`) references `htrans_beli` (`no_trans_beli`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `h_hutang`
--

lock tables `h_hutang` write;
/*!40000 alter table `h_hutang` disable keys */;
/*!40000 alter table `h_hutang` enable keys */;
unlock tables;

--
-- table structure for table `h_piutang`
--

drop table if exists `h_piutang`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `h_piutang` (
  `no_piutang` varchar(20) not null,
  `no_trans_jual` varchar(20) not null,
  `kode_bayar` char(10) default null,
  `tgl_piutang` date default null,
  `total_piutang` decimal(10,0) default null,
  primary key (`no_piutang`),
  key `no_trans_jual_piutang` (`no_trans_jual`),
  constraint `no_trans_jual_piutang` foreign key (`no_trans_jual`) references `htrans_jual` (`no_trans_jual`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `h_piutang`
--

lock tables `h_piutang` write;
/*!40000 alter table `h_piutang` disable keys */;
/*!40000 alter table `h_piutang` enable keys */;
unlock tables;

--
-- table structure for table `hretur_beli`
--

drop table if exists `hretur_beli`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `hretur_beli` (
  `no_retur_beli` varchar(10) not null,
  `no_trans_beli` varchar(20) character set utf8mb4 not null,
  `tgl_retur_beli` date not null,
  `total_retur_beli` float default null,
  primary key (`no_retur_beli`),
  key `no_trans_beli_retur` (`no_trans_beli`),
  constraint `no_trans_beli_retur` foreign key (`no_trans_beli`) references `htrans_beli` (`no_trans_beli`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `hretur_beli`
--

lock tables `hretur_beli` write;
/*!40000 alter table `hretur_beli` disable keys */;
/*!40000 alter table `hretur_beli` enable keys */;
unlock tables;

--
-- table structure for table `hretur_jual`
--

drop table if exists `hretur_jual`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `hretur_jual` (
  `no_retur_jual` varchar(20) not null,
  `no_trans_jual` varchar(20) character set latin1 not null,
  `tgl_retur_jual` date not null,
  `total_retur_jual` float not null,
  primary key (`no_retur_jual`),
  key `no_trans_jual` (`no_trans_jual`),
  constraint `no_trans_jual` foreign key (`no_trans_jual`) references `htrans_jual` (`no_trans_jual`)
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `hretur_jual`
--

lock tables `hretur_jual` write;
/*!40000 alter table `hretur_jual` disable keys */;
/*!40000 alter table `hretur_jual` enable keys */;
unlock tables;

--
-- table structure for table `htrans_beli`
--

drop table if exists `htrans_beli`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `htrans_beli` (
  `no_trans_beli` varchar(20) not null,
  `kd_supplier` varchar(20) character set latin1 not null,
  `kode_bayar` char(10) character set latin1 not null,
  `nomor_po` varchar(50) not null,
  `tgl_trans_beli` date not null,
  `tgl_max_garansi` date default null,
  `disc` float default null,
  `total_bayar` float not null,
  primary key (`no_trans_beli`),
  key `kd_supplier` (`kd_supplier`),
  key `kode_bayar_trans_beli` (`kode_bayar`),
  constraint `kd_supplier` foreign key (`kd_supplier`) references `supplier` (`kd_supplier`),
  constraint `kode_bayar_trans_beli` foreign key (`kode_bayar`) references `pembayaran` (`kode_bayar`)
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `htrans_beli`
--

lock tables `htrans_beli` write;
/*!40000 alter table `htrans_beli` disable keys */;
/*!40000 alter table `htrans_beli` enable keys */;
unlock tables;

--
-- table structure for table `htrans_jual`
--

drop table if exists `htrans_jual`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `htrans_jual` (
  `no_trans_jual` varchar(20) not null,
  `kode_promo` varchar(10) default null,
  `kode_jasa` varchar(10) default null,
  `kode_bayar` varchar(10) default null,
  `no_booking` varchar(20) default null,
  `tgl_trans_jual` date default null,
  `total_jual` decimal(10,0) default null,
  `bayar_jual` decimal(10,0) default null,
  `kembali_jual` decimal(10,0) default null,
  `tgl_max_garansi` date default null,
  primary key (`no_trans_jual`),
  key `kode_bayar_trans_jual` (`kode_bayar`),
  key `kode_promo_trans_jual` (`kode_promo`),
  key `kode_jasa_trans_jual` (`kode_jasa`),
  key `no_booking_trans_jual` (`no_booking`),
  constraint `kode_bayar_trans_jual` foreign key (`kode_bayar`) references `pembayaran` (`kode_bayar`),
  constraint `kode_jasa_trans_jual` foreign key (`kode_jasa`) references `jasa` (`kode_jasa`) on delete cascade on update cascade,
  constraint `kode_promo_trans_jual` foreign key (`kode_promo`) references `promo` (`kode_promo`),
  constraint `no_booking_trans_jual` foreign key (`no_booking`) references `booking` (`no_booking`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `htrans_jual`
--

lock tables `htrans_jual` write;
/*!40000 alter table `htrans_jual` disable keys */;
/*!40000 alter table `htrans_jual` enable keys */;
unlock tables;

--
-- table structure for table `jasa`
--

drop table if exists `jasa`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `jasa` (
  `kode_jasa` varchar(10) not null,
  `nama_jasa` varchar(20) default null,
  primary key (`kode_jasa`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `jasa`
--

lock tables `jasa` write;
/*!40000 alter table `jasa` disable keys */;
/*!40000 alter table `jasa` enable keys */;
unlock tables;

--
-- table structure for table `koreksi`
--

drop table if exists `koreksi`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `koreksi` (
  `no_koreksi` varchar(20) not null,
  `kode_barang` varchar(20) not null,
  `tgl_koreksi` date not null,
  `jumlah` int(11) not null,
  `jenis` enum('in','out') not null,
  `keterangan` text,
  primary key (`no_koreksi`),
  key `kode_barang_koreksi` (`kode_barang`),
  constraint `kode_barang_koreksi` foreign key (`kode_barang`) references `barang` (`kode_barang`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `koreksi`
--

lock tables `koreksi` write;
/*!40000 alter table `koreksi` disable keys */;
/*!40000 alter table `koreksi` enable keys */;
unlock tables;

--
-- table structure for table `kota`
--

drop table if exists `kota`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `kota` (
  `kode_kota` varchar(10) not null,
  `nama_kota` varchar(50) default null,
  primary key (`kode_kota`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `kota`
--

lock tables `kota` write;
/*!40000 alter table `kota` disable keys */;
insert into `kota` values ('1101','kabupaten simeulue'),('1102','kabupaten aceh singkil'),('1103','kabupaten aceh selatan'),('1104','kabupaten aceh tenggara'),('1105','kabupaten aceh timur'),('1106','kabupaten aceh tengah'),('1107','kabupaten aceh barat'),('1108','kabupaten aceh besar'),('1109','kabupaten pidie'),('1110','kabupaten bireuen'),('1111','kabupaten aceh utara'),('1112','kabupaten aceh barat daya'),('1113','kabupaten gayo lues'),('1114','kabupaten aceh tamiang'),('1115','kabupaten nagan raya'),('1116','kabupaten aceh jaya'),('1117','kabupaten bener meriah'),('1118','kabupaten pidie jaya'),('1171','kota banda aceh'),('1172','kota sabang'),('1173','kota langsa'),('1174','kota lhokseumawe'),('1175','kota subulussalam'),('1201','kabupaten nias'),('1202','kabupaten mandailing natal'),('1203','kabupaten tapanuli selatan'),('1204','kabupaten tapanuli tengah'),('1205','kabupaten tapanuli utara'),('1206','kabupaten toba samosir'),('1207','kabupaten labuhan batu'),('1208','kabupaten asahan'),('1209','kabupaten simalungun'),('1210','kabupaten dairi'),('1211','kabupaten karo'),('1212','kabupaten deli serdang'),('1213','kabupaten langkat'),('1214','kabupaten nias selatan'),('1215','kabupaten humbang hasundutan'),('1216','kabupaten pakpak bharat'),('1217','kabupaten samosir'),('1218','kabupaten serdang bedagai'),('1219','kabupaten batu bara'),('1220','kabupaten padang lawas utara'),('1221','kabupaten padang lawas'),('1222','kabupaten labuhan batu selatan'),('1223','kabupaten labuhan batu utara'),('1224','kabupaten nias utara'),('1225','kabupaten nias barat'),('1271','kota sibolga'),('1272','kota tanjung balai'),('1273','kota pematang siantar'),('1274','kota tebing tinggi'),('1275','kota medan'),('1276','kota binjai'),('1277','kota padangsidimpuan'),('1278','kota gunungsitoli'),('1301','kabupaten kepulauan mentawai'),('1302','kabupaten pesisir selatan'),('1303','kabupaten solok'),('1304','kabupaten sijunjung'),('1305','kabupaten tanah datar'),('1306','kabupaten padang pariaman'),('1307','kabupaten agam'),('1308','kabupaten lima puluh kota'),('1309','kabupaten pasaman'),('1310','kabupaten solok selatan'),('1311','kabupaten dharmasraya'),('1312','kabupaten pasaman barat'),('1371','kota padang'),('1372','kota solok'),('1373','kota sawah lunto'),('1374','kota padang panjang'),('1375','kota bukittinggi'),('1376','kota payakumbuh'),('1377','kota pariaman'),('1401','kabupaten kuantan singingi'),('1402','kabupaten indragiri hulu'),('1403','kabupaten indragiri hilir'),('1404','kabupaten pelalawan'),('1405','kabupaten siak'),('1406','kabupaten kampar'),('1407','kabupaten rokan hulu'),('1408','kabupaten bengkalis'),('1409','kabupaten rokan hilir'),('1410','kabupaten kepulauan meranti'),('1471','kota pekanbaru'),('1473','kota dumai'),('1501','kabupaten kerinci'),('1502','kabupaten merangin'),('1503','kabupaten sarolangun'),('1504','kabupaten batang hari'),('1505','kabupaten muaro jambi'),('1506','kabupaten tanjung jabung timur'),('1507','kabupaten tanjung jabung barat'),('1508','kabupaten tebo'),('1509','kabupaten bungo'),('1571','kota jambi'),('1572','kota sungai penuh'),('1601','kabupaten ogan komering ulu'),('1602','kabupaten ogan komering ilir'),('1603','kabupaten muara enim'),('1604','kabupaten lahat'),('1605','kabupaten musi rawas'),('1606','kabupaten musi banyuasin'),('1607','kabupaten banyu asin'),('1608','kabupaten ogan komering ulu selatan'),('1609','kabupaten ogan komering ulu timur'),('1610','kabupaten ogan ilir'),('1611','kabupaten empat lawang'),('1612','kabupaten penukal abab lematang ilir'),('1613','kabupaten musi rawas utara'),('1671','kota palembang'),('1672','kota prabumulih'),('1673','kota pagar alam'),('1674','kota lubuklinggau'),('1701','kabupaten bengkulu selatan'),('1702','kabupaten rejang lebong'),('1703','kabupaten bengkulu utara'),('1704','kabupaten kaur'),('1705','kabupaten seluma'),('1706','kabupaten mukomuko'),('1707','kabupaten lebong'),('1708','kabupaten kepahiang'),('1709','kabupaten bengkulu tengah'),('1771','kota bengkulu'),('1801','kabupaten lampung barat'),('1802','kabupaten tanggamus'),('1803','kabupaten lampung selatan'),('1804','kabupaten lampung timur'),('1805','kabupaten lampung tengah'),('1806','kabupaten lampung utara'),('1807','kabupaten way kanan'),('1808','kabupaten tulangbawang'),('1809','kabupaten pesawaran'),('1810','kabupaten pringsewu'),('1811','kabupaten mesuji'),('1812','kabupaten tulang bawang barat'),('1813','kabupaten pesisir barat'),('1871','kota bandar lampung'),('1872','kota metro'),('1901','kabupaten bangka'),('1902','kabupaten belitung'),('1903','kabupaten bangka barat'),('1904','kabupaten bangka tengah'),('1905','kabupaten bangka selatan'),('1906','kabupaten belitung timur'),('1971','kota pangkal pinang'),('2101','kabupaten karimun'),('2102','kabupaten bintan'),('2103','kabupaten natuna'),('2104','kabupaten lingga'),('2105','kabupaten kepulauan anambas'),('2171','kota batam'),('2172','kota tanjung pinang'),('3101','kabupaten kepulauan seribu'),('3171','kota jakarta selatan'),('3172','kota jakarta timur'),('3173','kota jakarta pusat'),('3174','kota jakarta barat'),('3175','kota jakarta utara'),('3201','kabupaten bogor'),('3202','kabupaten sukabumi'),('3203','kabupaten cianjur'),('3204','kabupaten bandung'),('3205','kabupaten garut'),('3206','kabupaten tasikmalaya'),('3207','kabupaten ciamis'),('3208','kabupaten kuningan'),('3209','kabupaten cirebon'),('3210','kabupaten majalengka'),('3211','kabupaten sumedang'),('3212','kabupaten indramayu'),('3213','kabupaten subang'),('3214','kabupaten purwakarta'),('3215','kabupaten karawang'),('3216','kabupaten bekasi'),('3217','kabupaten bandung barat'),('3218','kabupaten pangandaran'),('3271','kota bogor'),('3272','kota sukabumi'),('3273','kota bandung'),('3274','kota cirebon'),('3275','kota bekasi'),('3276','kota depok'),('3277','kota cimahi'),('3278','kota tasikmalaya'),('3279','kota banjar'),('3301','kabupaten cilacap'),('3302','kabupaten banyumas'),('3303','kabupaten purbalingga'),('3304','kabupaten banjarnegara'),('3305','kabupaten kebumen'),('3306','kabupaten purworejo'),('3307','kabupaten wonosobo'),('3308','kabupaten magelang'),('3309','kabupaten boyolali'),('3310','kabupaten klaten'),('3311','kabupaten sukoharjo'),('3312','kabupaten wonogiri'),('3313','kabupaten karanganyar'),('3314','kabupaten sragen'),('3315','kabupaten grobogan'),('3316','kabupaten blora'),('3317','kabupaten rembang'),('3318','kabupaten pati'),('3319','kabupaten kudus'),('3320','kabupaten jepara'),('3321','kabupaten demak'),('3322','kabupaten semarang'),('3323','kabupaten temanggung'),('3324','kabupaten kendal'),('3325','kabupaten batang'),('3326','kabupaten pekalongan'),('3327','kabupaten pemalang'),('3328','kabupaten tegal'),('3329','kabupaten brebes'),('3371','kota magelang'),('3372','kota surakarta'),('3373','kota salatiga'),('3374','kota semarang'),('3375','kota pekalongan'),('3376','kota tegal'),('3401','kabupaten kulon progo'),('3402','kabupaten bantul'),('3403','kabupaten gunung kidul'),('3404','kabupaten sleman'),('3471','kota yogyakarta'),('3501','kabupaten pacitan'),('3502','kabupaten ponorogo'),('3503','kabupaten trenggalek'),('3504','kabupaten tulungagung'),('3505','kabupaten blitar'),('3506','kabupaten kediri'),('3507','kabupaten malang'),('3508','kabupaten lumajang'),('3509','kabupaten jember'),('3510','kabupaten banyuwangi'),('3511','kabupaten bondowoso'),('3512','kabupaten situbondo'),('3513','kabupaten probolinggo'),('3514','kabupaten pasuruan'),('3515','kabupaten sidoarjo'),('3516','kabupaten mojokerto'),('3517','kabupaten jombang'),('3518','kabupaten nganjuk'),('3519','kabupaten madiun'),('3520','kabupaten magetan'),('3521','kabupaten ngawi'),('3522','kabupaten bojonegoro'),('3523','kabupaten tuban'),('3524','kabupaten lamongan'),('3525','kabupaten gresik'),('3526','kabupaten bangkalan'),('3527','kabupaten sampang'),('3528','kabupaten pamekasan'),('3529','kabupaten sumenep'),('3571','kota kediri'),('3572','kota blitar'),('3573','kota malang'),('3574','kota probolinggo'),('3575','kota pasuruan'),('3576','kota mojokerto'),('3577','kota madiun'),('3578','kota surabaya'),('3579','kota batu'),('3601','kabupaten pandeglang'),('3602','kabupaten lebak'),('3603','kabupaten tangerang'),('3604','kabupaten serang'),('3671','kota tangerang'),('3672','kota cilegon'),('3673','kota serang'),('3674','kota tangerang selatan'),('5101','kabupaten jembrana'),('5102','kabupaten tabanan'),('5103','kabupaten badung'),('5104','kabupaten gianyar'),('5105','kabupaten klungkung'),('5106','kabupaten bangli'),('5107','kabupaten karang asem'),('5108','kabupaten buleleng'),('5171','kota denpasar'),('5201','kabupaten lombok barat'),('5202','kabupaten lombok tengah'),('5203','kabupaten lombok timur'),('5204','kabupaten sumbawa'),('5205','kabupaten dompu'),('5206','kabupaten bima'),('5207','kabupaten sumbawa barat'),('5208','kabupaten lombok utara'),('5271','kota mataram'),('5272','kota bima'),('5301','kabupaten sumba barat'),('5302','kabupaten sumba timur'),('5303','kabupaten kupang'),('5304','kabupaten timor tengah selatan'),('5305','kabupaten timor tengah utara'),('5306','kabupaten belu'),('5307','kabupaten alor'),('5308','kabupaten lembata'),('5309','kabupaten flores timur'),('5310','kabupaten sikka'),('5311','kabupaten ende'),('5312','kabupaten ngada'),('5313','kabupaten manggarai'),('5314','kabupaten rote ndao'),('5315','kabupaten manggarai barat'),('5316','kabupaten sumba tengah'),('5317','kabupaten sumba barat daya'),('5318','kabupaten nagekeo'),('5319','kabupaten manggarai timur'),('5320','kabupaten sabu raijua'),('5321','kabupaten malaka'),('5371','kota kupang'),('6101','kabupaten sambas'),('6102','kabupaten bengkayang'),('6103','kabupaten landak'),('6104','kabupaten mempawah'),('6105','kabupaten sanggau'),('6106','kabupaten ketapang'),('6107','kabupaten sintang'),('6108','kabupaten kapuas hulu'),('6109','kabupaten sekadau'),('6110','kabupaten melawi'),('6111','kabupaten kayong utara'),('6112','kabupaten kubu raya'),('6171','kota pontianak'),('6172','kota singkawang'),('6201','kabupaten kotawaringin barat'),('6202','kabupaten kotawaringin timur'),('6203','kabupaten kapuas'),('6204','kabupaten barito selatan'),('6205','kabupaten barito utara'),('6206','kabupaten sukamara'),('6207','kabupaten lamandau'),('6208','kabupaten seruyan'),('6209','kabupaten katingan'),('6210','kabupaten pulang pisau'),('6211','kabupaten gunung mas'),('6212','kabupaten barito timur'),('6213','kabupaten murung raya'),('6271','kota palangka raya'),('6301','kabupaten tanah laut'),('6302','kabupaten kota baru'),('6303','kabupaten banjar'),('6304','kabupaten barito kuala'),('6305','kabupaten tapin'),('6306','kabupaten hulu sungai selatan'),('6307','kabupaten hulu sungai tengah'),('6308','kabupaten hulu sungai utara'),('6309','kabupaten tabalong'),('6310','kabupaten tanah bumbu'),('6311','kabupaten balangan'),('6371','kota banjarmasin'),('6372','kota banjar baru'),('6401','kabupaten paser'),('6402','kabupaten kutai barat'),('6403','kabupaten kutai kartanegara'),('6404','kabupaten kutai timur'),('6405','kabupaten berau'),('6409','kabupaten penajam paser utara'),('6411','kabupaten mahakam hulu'),('6471','kota balikpapan'),('6472','kota samarinda'),('6474','kota bontang'),('6501','kabupaten malinau'),('6502','kabupaten bulungan'),('6503','kabupaten tana tidung'),('6504','kabupaten nunukan'),('6571','kota tarakan'),('7101','kabupaten bolaang mongondow'),('7102','kabupaten minahasa'),('7103','kabupaten kepulauan sangihe'),('7104','kabupaten kepulauan talaud'),('7105','kabupaten minahasa selatan'),('7106','kabupaten minahasa utara'),('7107','kabupaten bolaang mongondow utara'),('7108','kabupaten siau tagulandang biaro'),('7109','kabupaten minahasa tenggara'),('7110','kabupaten bolaang mongondow selatan'),('7111','kabupaten bolaang mongondow timur'),('7171','kota manado'),('7172','kota bitung'),('7173','kota tomohon'),('7174','kota kotamobagu'),('7201','kabupaten banggai kepulauan'),('7202','kabupaten banggai'),('7203','kabupaten morowali'),('7204','kabupaten poso'),('7205','kabupaten donggala'),('7206','kabupaten toli-toli'),('7207','kabupaten buol'),('7208','kabupaten parigi moutong'),('7209','kabupaten tojo una-una'),('7210','kabupaten sigi'),('7211','kabupaten banggai laut'),('7212','kabupaten morowali utara'),('7271','kota palu'),('7301','kabupaten kepulauan selayar'),('7302','kabupaten bulukumba'),('7303','kabupaten bantaeng'),('7304','kabupaten jeneponto'),('7305','kabupaten takalar'),('7306','kabupaten gowa'),('7307','kabupaten sinjai'),('7308','kabupaten maros'),('7309','kabupaten pangkajene dan kepulauan'),('7310','kabupaten barru'),('7311','kabupaten bone'),('7312','kabupaten soppeng'),('7313','kabupaten wajo'),('7314','kabupaten sidenreng rappang'),('7315','kabupaten pinrang'),('7316','kabupaten enrekang'),('7317','kabupaten luwu'),('7318','kabupaten tana toraja'),('7322','kabupaten luwu utara'),('7325','kabupaten luwu timur'),('7326','kabupaten toraja utara'),('7371','kota makassar'),('7372','kota parepare'),('7373','kota palopo'),('7401','kabupaten buton'),('7402','kabupaten muna'),('7403','kabupaten konawe'),('7404','kabupaten kolaka'),('7405','kabupaten konawe selatan'),('7406','kabupaten bombana'),('7407','kabupaten wakatobi'),('7408','kabupaten kolaka utara'),('7409','kabupaten buton utara'),('7410','kabupaten konawe utara'),('7411','kabupaten kolaka timur'),('7412','kabupaten konawe kepulauan'),('7413','kabupaten muna barat'),('7414','kabupaten buton tengah'),('7415','kabupaten buton selatan'),('7471','kota kendari'),('7472','kota baubau'),('7501','kabupaten boalemo'),('7502','kabupaten gorontalo'),('7503','kabupaten pohuwato'),('7504','kabupaten bone bolango'),('7505','kabupaten gorontalo utara'),('7571','kota gorontalo'),('7601','kabupaten majene'),('7602','kabupaten polewali mandar'),('7603','kabupaten mamasa'),('7604','kabupaten mamuju'),('7605','kabupaten mamuju utara'),('7606','kabupaten mamuju tengah'),('8101','kabupaten maluku tenggara barat'),('8102','kabupaten maluku tenggara'),('8103','kabupaten maluku tengah'),('8104','kabupaten buru'),('8105','kabupaten kepulauan aru'),('8106','kabupaten seram bagian barat'),('8107','kabupaten seram bagian timur'),('8108','kabupaten maluku barat daya'),('8109','kabupaten buru selatan'),('8171','kota ambon'),('8172','kota tual'),('8201','kabupaten halmahera barat'),('8202','kabupaten halmahera tengah'),('8203','kabupaten kepulauan sula'),('8204','kabupaten halmahera selatan'),('8205','kabupaten halmahera utara'),('8206','kabupaten halmahera timur'),('8207','kabupaten pulau morotai'),('8208','kabupaten pulau taliabu'),('8271','kota ternate'),('8272','kota tidore kepulauan'),('9101','kabupaten fakfak'),('9102','kabupaten kaimana'),('9103','kabupaten teluk wondama'),('9104','kabupaten teluk bintuni'),('9105','kabupaten manokwari'),('9106','kabupaten sorong selatan'),('9107','kabupaten sorong'),('9108','kabupaten raja ampat'),('9109','kabupaten tambrauw'),('9110','kabupaten maybrat'),('9111','kabupaten manokwari selatan'),('9112','kabupaten pegunungan arfak'),('9171','kota sorong'),('9401','kabupaten merauke'),('9402','kabupaten jayawijaya'),('9403','kabupaten jayapura'),('9404','kabupaten nabire'),('9408','kabupaten kepulauan yapen'),('9409','kabupaten biak numfor'),('9410','kabupaten paniai'),('9411','kabupaten puncak jaya'),('9412','kabupaten mimika'),('9413','kabupaten boven digoel'),('9414','kabupaten mappi'),('9415','kabupaten asmat'),('9416','kabupaten yahukimo'),('9417','kabupaten pegunungan bintang'),('9418','kabupaten tolikara'),('9419','kabupaten sarmi'),('9420','kabupaten keerom'),('9426','kabupaten waropen'),('9427','kabupaten supiori'),('9428','kabupaten mamberamo raya'),('9429','kabupaten nduga'),('9430','kabupaten lanny jaya'),('9431','kabupaten mamberamo tengah'),('9432','kabupaten yalimo'),('9433','kabupaten puncak'),('9434','kabupaten dogiyai'),('9435','kabupaten intan jaya'),('9436','kabupaten deiyai'),('9471','kota jayapura');
/*!40000 alter table `kota` enable keys */;
unlock tables;

--
-- table structure for table `level_user`
--

drop table if exists `level_user`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `level_user` (
  `kode_level` varchar(10) not null,
  `nama_level` varchar(20) not null,
  primary key (`kode_level`)
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `level_user`
--

lock tables `level_user` write;
/*!40000 alter table `level_user` disable keys */;
insert into `level_user` values ('1','owner'),('2','admin'),('3','kasir');
/*!40000 alter table `level_user` enable keys */;
unlock tables;

--
-- table structure for table `merek`
--

drop table if exists `merek`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `merek` (
  `kode_merek` varchar(10) not null,
  `nama_merek` varchar(20) default null,
  primary key (`kode_merek`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `merek`
--

lock tables `merek` write;
/*!40000 alter table `merek` disable keys */;
insert into `merek` values ('cst','castrol'),('hnd','honda'),('shl','shell'),('ymh','yamaha');
/*!40000 alter table `merek` enable keys */;
unlock tables;

--
-- table structure for table `pegawai`
--

drop table if exists `pegawai`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `pegawai` (
  `kode_pegawai` varchar(10) not null,
  `nama_pegawai` varchar(20) default null,
  primary key (`kode_pegawai`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `pegawai`
--

lock tables `pegawai` write;
/*!40000 alter table `pegawai` disable keys */;
insert into `pegawai` values ('a001','nurul'),('a002','tutik'),('k001','fian'),('o001','hasan');
/*!40000 alter table `pegawai` enable keys */;
unlock tables;

--
-- table structure for table `pembayaran`
--

drop table if exists `pembayaran`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `pembayaran` (
  `kode_bayar` char(10) not null,
  `nama_bayar` char(10) default null,
  primary key (`kode_bayar`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `pembayaran`
--

lock tables `pembayaran` write;
/*!40000 alter table `pembayaran` disable keys */;
/*!40000 alter table `pembayaran` enable keys */;
unlock tables;

--
-- table structure for table `promo`
--

drop table if exists `promo`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `promo` (
  `kode_promo` varchar(10) not null,
  `tgl_mulai` date not null,
  `tgl_selesai` date not null,
  `nama_promo` varchar(20) default null,
  `kode_barang` varchar(20) not null,
  `qty_sk` int(11) not null,
  `disc` decimal(10,0) not null,
  primary key (`kode_promo`),
  key `kode_barang_promo` (`kode_barang`),
  constraint `kode_barang_promo` foreign key (`kode_barang`) references `barang` (`kode_barang`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `promo`
--

lock tables `promo` write;
/*!40000 alter table `promo` disable keys */;
/*!40000 alter table `promo` enable keys */;
unlock tables;

--
-- table structure for table `satuan`
--

drop table if exists `satuan`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `satuan` (
  `kode_satuan` varchar(10) not null,
  `nama_satuan` varchar(15) not null,
  primary key (`kode_satuan`)
) engine=innodb default charset=utf8mb4;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `satuan`
--

lock tables `satuan` write;
/*!40000 alter table `satuan` disable keys */;
insert into `satuan` values ('lsn','lusin'),('ltr','liter'),('pcs','pieces');
/*!40000 alter table `satuan` enable keys */;
unlock tables;

--
-- table structure for table `subtitusi`
--

drop table if exists `subtitusi`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `subtitusi` (
  `tgl_subtitusi` date not null,
  `no_subtitusi` varchar(20) not null,
  `kode_barang1` varchar(20) not null,
  `kode_barang2` varchar(20) not null,
  primary key (`no_subtitusi`),
  key `kode_barang1_d_subtitusi` (`kode_barang1`),
  key `kode_barang2_d_subtitusi` (`kode_barang2`),
  constraint `kode_barang1_d_subtitusi` foreign key (`kode_barang1`) references `barang` (`kode_barang`),
  constraint `kode_barang2_d_subtitusi` foreign key (`kode_barang2`) references `barang` (`kode_barang`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `subtitusi`
--

lock tables `subtitusi` write;
/*!40000 alter table `subtitusi` disable keys */;
/*!40000 alter table `subtitusi` enable keys */;
unlock tables;

--
-- table structure for table `supplier`
--

drop table if exists `supplier`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `supplier` (
  `kd_supplier` varchar(20) not null,
  `kode_kota` varchar(10) default null,
  `nama_supplier` varchar(20) default null,
  `alamat_supplier` varchar(200) default null,
  `telepon_supplier` varchar(20) default null,
  primary key (`kd_supplier`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `supplier`
--

lock tables `supplier` write;
/*!40000 alter table `supplier` disable keys */;
/*!40000 alter table `supplier` enable keys */;
unlock tables;

--
-- table structure for table `tipe`
--

drop table if exists `tipe`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `tipe` (
  `kode_tipe` varchar(10) not null,
  `nama_tipe` varchar(20) default null,
  primary key (`kode_tipe`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `tipe`
--

lock tables `tipe` write;
/*!40000 alter table `tipe` disable keys */;
insert into `tipe` values ('001','oli'),('002','busi'),('003','filter udara'),('004','filter ac'),('005','kampas rem'),('006','aki');
/*!40000 alter table `tipe` enable keys */;
unlock tables;

--
-- table structure for table `user`
--

drop table if exists `user`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `user` (
  `kode_user` varchar(20) not null,
  `kode_level` varchar(10) character set utf8mb4 not null,
  `kode_pegawai` varchar(10) not null,
  `email` varchar(255) not null,
  `email_verified_at` timestamp null default null,
  `password` varchar(255) not null,
  `remember_token` varchar(255) default null,
  `created_at` timestamp null default null,
  `updated_at` timestamp null default null,
  primary key (`kode_user`),
  key `kode_level_user` (`kode_level`),
  key `kode_pegawai_user` (`kode_pegawai`),
  constraint `kode_level_user` foreign key (`kode_level`) references `level_user` (`kode_level`),
  constraint `kode_pegawai_user` foreign key (`kode_pegawai`) references `pegawai` (`kode_pegawai`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- dumping data for table `user`
--

lock tables `user` write;
/*!40000 alter table `user` disable keys */;
insert into `user` values ('admin1','2','a001','admin@gmail.com','2022-08-30 13:49:13','$2y$10$ktu04ic39wu98qerxs5dlezfc5dmgal0gcoduiafhkjtviay0ifkm',null,null,null),('kasir1','3','k001','kasir@gmail.com','2022-08-30 13:49:13','$2y$10$abghtgc2y7kmbcdzf61w...vzh8kpyw2qaha0os49s60oweptxhbu',null,null,null),('owner1','1','o001','owner@gmail.com','2022-08-30 13:49:13','$2y$10$vn1iivyqtwxckejwo6hje.ucpqxu/yt4c/l4/dwszinnqr/aakgeu',null,null,null);
/*!40000 alter table `user` enable keys */;
unlock tables;

--
-- dumping routines for database 'ta_budiman'
--
/*!40103 set time_zone=@old_time_zone */;

/*!40101 set sql_mode=@old_sql_mode */;
/*!40014 set foreign_key_checks=@old_foreign_key_checks */;
/*!40014 set unique_checks=@old_unique_checks */;
/*!40101 set character_set_client=@old_character_set_client */;
/*!40101 set character_set_results=@old_character_set_results */;
/*!40101 set collation_connection=@old_collation_connection */;
/*!40111 set sql_notes=@old_sql_notes */;

-- dump completed on 2022-09-15 16:47:31
