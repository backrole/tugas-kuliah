/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.9-MariaDB : Database - pendaftaran
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pendaftaran` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pendaftaran`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`) values (1,'RedHat404','9e12dbf80967d1a7965b5ba16e986f1bfc5c2477');

/*Table structure for table `audisi` */

DROP TABLE IF EXISTS `audisi`;

CREATE TABLE `audisi` (
  `id_audisi` int(5) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_audisi`),
  UNIQUE KEY `lokasi_2` (`lokasi`),
  KEY `lokasi` (`lokasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `audisi` */

insert  into `audisi`(`id_audisi`,`lokasi`) values (3,'Bandung'),(2,'Jakarta'),(1,'Surabaya');

/*Table structure for table `daftar` */

DROP TABLE IF EXISTS `daftar`;

CREATE TABLE `daftar` (
  `no_pendaftaran` int(5) NOT NULL AUTO_INCREMENT,
  `audisi` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jk` enum('','laki-laki','perempuan') DEFAULT NULL,
  `status` enum('belum menikah','menikah','pernah menikah') DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_identitas` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kode_pos` int(10) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`no_pendaftaran`),
  KEY `provinsi_2` (`provinsi`),
  KEY `audisi` (`audisi`),
  FULLTEXT KEY `provinsi` (`provinsi`),
  CONSTRAINT `daftar_ibfk_1` FOREIGN KEY (`provinsi`) REFERENCES `t_provinsi` (`nama`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `daftar_ibfk_2` FOREIGN KEY (`audisi`) REFERENCES `audisi` (`lokasi`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `daftar` */

insert  into `daftar`(`no_pendaftaran`,`audisi`,`nama`,`jk`,`status`,`tempat_lahir`,`tgl_lahir`,`no_identitas`,`alamat`,`kota`,`provinsi`,`kode_pos`,`pekerjaan`,`telepon`) values (3,'Bandung','ss','laki-laki','belum menikah','sdukfjn','1111-11-11','39487','sdoifhlkn','odsdflkn','Aceh',234,'dsihflkn','2323423423');

/*Table structure for table `t_provinsi` */

DROP TABLE IF EXISTS `t_provinsi`;

CREATE TABLE `t_provinsi` (
  `id_provinsi` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `t_provinsi` */

insert  into `t_provinsi`(`id_provinsi`,`nama`) values (1,'Aceh'),(2,'Bali'),(3,'Banten'),(4,'Bengkulu'),(5,'Gorontalo'),(6,'Jakarta'),(7,'Jambi'),(8,'Jawa Barat'),(9,'Jawa Tengah'),(10,'Jawa Timur'),(11,'Kalimantan Barat'),(12,'Kalimantan Selatan'),(13,'Kalimantan Tengah'),(14,'Kalimantan Timur'),(15,'Kalimantan Utara'),(16,'Kep. Bangka Belitung'),(17,'Kep. Riau'),(18,'Lampung'),(19,'Maluku'),(20,'NTB'),(21,'NTT'),(22,'Papua'),(23,'Papua Barat'),(24,'Riau'),(25,'Sulawesi Barat'),(26,'Sulawesi Selatan'),(27,'Sulawesi Tengah'),(28,'Sulawesi Tenggara'),(29,'Sulawesi Utara'),(30,'Sumatera Barat'),(31,'Sumatera Selatan'),(32,'Sumatera Utara'),(33,'Yogyakarta');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
