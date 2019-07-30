/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.9-MariaDB : Database - poliklinik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`poliklinik` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `poliklinik`;

/*Table structure for table `dokter` */

DROP TABLE IF EXISTS `dokter`;

CREATE TABLE `dokter` (
  `KdDok` varchar(6) NOT NULL,
  `NamaDok` text,
  `AlmDok` text,
  `TelpDok` text,
  `KdPoli` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`KdDok`),
  UNIQUE KEY `KdPoli` (`KdPoli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dokter` */

insert  into `dokter`(`KdDok`,`NamaDok`,`AlmDok`,`TelpDok`,`KdPoli`) values ('DKR00','ytry','hgfhg','654','23'),('DOK01','asdbjk','dsbkj','98234283','KDG');

/*Table structure for table `jadwalpraktek` */

DROP TABLE IF EXISTS `jadwalpraktek`;

CREATE TABLE `jadwalpraktek` (
  `KdJadwal` varchar(6) NOT NULL,
  `Hari` varchar(15) DEFAULT NULL,
  `JamMulai` time DEFAULT NULL,
  `JamSelesai` time DEFAULT NULL,
  `KdDokter` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`KdJadwal`),
  UNIQUE KEY `KdDokter` (`KdDokter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwalpraktek` */

insert  into `jadwalpraktek`(`KdJadwal`,`Hari`,`JamMulai`,`JamSelesai`,`KdDokter`) values ('JP02','Senin','07:00:00','12:00:00','DOK01'),('JPK00','Senin','13:22:00','10:58:00','DKR00');

/*Table structure for table `jenisbiaya` */

DROP TABLE IF EXISTS `jenisbiaya`;

CREATE TABLE `jenisbiaya` (
  `IDJenisBiaya` varchar(6) NOT NULL,
  `NamaBiaya` tinytext,
  `Tarif` varchar(10) DEFAULT NULL,
  `NoPendaftaran` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IDJenisBiaya`),
  UNIQUE KEY `NoPendaftaran` (`NoPendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jenisbiaya` */

insert  into `jenisbiaya`(`IDJenisBiaya`,`NamaBiaya`,`Tarif`,`NoPendaftaran`) values ('12','Loe','10291','12'),('JBA00','asd','1222','123');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `tipeuser` text,
  `NIP` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `NIP` (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`username`,`password`,`tipeuser`,`NIP`) values ('admin','d033e22ae348aeb5660fc2140aec35850c4da997',NULL,'9987993477');

/*Table structure for table `obat` */

DROP TABLE IF EXISTS `obat`;

CREATE TABLE `obat` (
  `KdObat` varchar(10) NOT NULL,
  `NamaObt` text,
  `Merk` text,
  `Satuan` text,
  `HargaJual` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`KdObat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obat` */

insert  into `obat`(`KdObat`,`NamaObt`,`Merk`,`Satuan`,`HargaJual`) values ('12','Lorem','Bodrex1','Pcs','17.000'),('OBT001','viostin','uytyu','tablet','1200');

/*Table structure for table `pasien` */

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `NoPasien` varchar(10) NOT NULL,
  `NamaPas` text,
  `AlmPas` text,
  `TelpPas` text,
  `TglLhrPas` date DEFAULT NULL,
  `JnsKelPas` text,
  `TglRegistrasi` date DEFAULT NULL,
  PRIMARY KEY (`NoPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pasien` */

insert  into `pasien`(`NoPasien`,`NamaPas`,`AlmPas`,`TelpPas`,`TglLhrPas`,`JnsKelPas`,`TglRegistrasi`) values ('1','Sandika A','Lorem','087737432xx','1980-12-31','Laki-laki','2024-10-16'),('2','Andri','Sawoo','09845xxx','1970-12-19','Perempuan','2024-10-16'),('3','Loem','sdjf','23229423xx','1980-09-09','Laki-laki','2024-10-16'),('4','siudfkjb','dukfj','2934','1980-12-07','Laki-laki','2024-10-16'),('5','sdfjb','jhvfc','876576','1988-09-09','Laki-laki','2024-10-16'),('6','sfdbm','ytasvjhbn','34567890','1970-07-07','Perempuan','2024-10-16'),('PAS001','asd','asd','12312','2012-10-28','Perempuan','2031-10-16');

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `NIP` varchar(18) NOT NULL,
  `NamaPeg` text,
  `AlmPeg` text,
  `TelpPeg` text,
  `TglLhrPeg` date DEFAULT NULL,
  `JnsKelPeg` text,
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pegawai` */

insert  into `pegawai`(`NIP`,`NamaPeg`,`AlmPeg`,`TelpPeg`,`TglLhrPeg`,`JnsKelPeg`) values ('8787875','yteyteasdasd','uyruasdasd','765','2013-10-29','Laki-laki'),('99898348','asbdas','iuwefdh','874324166','1980-12-19','Laki-laki');

/*Table structure for table `pemeriksaan` */

DROP TABLE IF EXISTS `pemeriksaan`;

CREATE TABLE `pemeriksaan` (
  `NoPemeriksaan` varchar(10) NOT NULL,
  `Keluhan` varchar(225) DEFAULT NULL,
  `Diagnosa` varchar(225) DEFAULT NULL,
  `Perawatan` varchar(225) DEFAULT NULL,
  `Tindakan` varchar(225) DEFAULT NULL,
  `BeratBadan` varchar(10) DEFAULT NULL,
  `TensiDiastolik` int(11) DEFAULT NULL,
  `TensiSistolik` int(11) DEFAULT NULL,
  `NoPendaftaran` varchar(10) DEFAULT NULL,
  `NoResep` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`NoPemeriksaan`),
  UNIQUE KEY `NoPendaftaran` (`NoPendaftaran`),
  UNIQUE KEY `NoResep` (`NoResep`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemeriksaan` */

insert  into `pemeriksaan`(`NoPemeriksaan`,`Keluhan`,`Diagnosa`,`Perawatan`,`Tindakan`,`BeratBadan`,`TensiDiastolik`,`TensiSistolik`,`NoPendaftaran`,`NoResep`) values ('PMR0002','kasgfbasjb','hsdbfjsdf','KSDHF K','SDFNSDF','34',77,77,'','23'),('PMR003','ytrytryt','jkgkjg','kjgkjg','kjgkjgkj','67',67,67,'123','RSP00');

/*Table structure for table `pendaftaran` */

DROP TABLE IF EXISTS `pendaftaran`;

CREATE TABLE `pendaftaran` (
  `NoPendaftaran` varchar(6) NOT NULL,
  `TglPendaftaran` date DEFAULT NULL,
  `NoUrut` int(10) DEFAULT NULL,
  `NoPasien` varchar(10) DEFAULT NULL,
  `NipPegawai` varchar(20) DEFAULT NULL,
  `KdJadwal` varchar(10) DEFAULT NULL,
  `NoPemeriksaan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`NoPendaftaran`),
  UNIQUE KEY `NoPasien` (`NoPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pendaftaran` */

insert  into `pendaftaran`(`NoPendaftaran`,`TglPendaftaran`,`NoUrut`,`NoPasien`,`NipPegawai`,`KdJadwal`,`NoPemeriksaan`) values ('123','2014-10-29',12,'PAS001',NULL,'JP02',NULL),('75','2016-11-11',65,'6',NULL,'JP02',NULL),('99','2016-11-11',87,'4',NULL,'JP02',NULL);

/*Table structure for table `poliklinik` */

DROP TABLE IF EXISTS `poliklinik`;

CREATE TABLE `poliklinik` (
  `KodePoli` varchar(6) NOT NULL,
  `NamaPoli` text,
  PRIMARY KEY (`KodePoli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `poliklinik` */

insert  into `poliklinik`(`KodePoli`,`NamaPoli`) values ('23','hghg'),('THT','Telinga Hidung & Tenggorokan');

/*Table structure for table `resep` */

DROP TABLE IF EXISTS `resep`;

CREATE TABLE `resep` (
  `NoResep` varchar(6) NOT NULL,
  `Dosis` text,
  `Jumlah` varchar(10) DEFAULT NULL,
  `KdObat` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`NoResep`),
  UNIQUE KEY `KdObat` (`KdObat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `resep` */

insert  into `resep`(`NoResep`,`Dosis`,`Jumlah`,`KdObat`) values ('23','23ms','101','12'),('RSP00','12','12','OBT001');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
