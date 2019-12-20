/*
SQLyog Ultimate v10.42 
MySQL - 5.5.62-0ubuntu0.14.04.1 : Database - ptsp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ptsp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ptsp`;

/*Table structure for table `_account_reset` */

DROP TABLE IF EXISTS `_account_reset`;

CREATE TABLE `_account_reset` (
  `id_reset` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `id_user` int(10) NOT NULL,
  `email` varchar(99) NOT NULL,
  `created_date` datetime NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_account_reset` */

/*Table structure for table `_agama` */

DROP TABLE IF EXISTS `_agama`;

CREATE TABLE `_agama` (
  `kd_agama` int(11) NOT NULL,
  `agama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_agama` */

insert  into `_agama`(`kd_agama`,`agama`) values (1,'Islam'),(2,'Kristen');

/*Table structure for table `_display` */

DROP TABLE IF EXISTS `_display`;

CREATE TABLE `_display` (
  `id` int(1) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_display` */

insert  into `_display`(`id`,`title`) values (1,'Yes'),(2,'No');

/*Table structure for table `_gender` */

DROP TABLE IF EXISTS `_gender`;

CREATE TABLE `_gender` (
  `id_gender` int(11) NOT NULL,
  `kd_gender` char(1) NOT NULL,
  `jenis_kelamin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_gender` */

insert  into `_gender`(`id_gender`,`kd_gender`,`jenis_kelamin`) values (1,'L','Laki-Laki'),(2,'P','Perempuan');

/*Table structure for table `_group` */

DROP TABLE IF EXISTS `_group`;

CREATE TABLE `_group` (
  `id_group` int(11) NOT NULL,
  `nm_group` varchar(20) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_group` */

insert  into `_group`(`id_group`,`nm_group`,`id_status`,`id_user`) values (1,'Super Admin',1,1),(2,'Admin',1,1),(3,'Siswa',1,3),(4,'Walimurid',1,3),(5,'Guru',1,3),(6,'Guru BK',1,3),(7,'Tim Kurikulum',1,3),(8,'Kepala Sekolah',1,3);

/*Table structure for table `_lock` */

DROP TABLE IF EXISTS `_lock`;

CREATE TABLE `_lock` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `ip` text NOT NULL,
  `browser` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_lock` */

/*Table structure for table `_log_keyword` */

DROP TABLE IF EXISTS `_log_keyword`;

CREATE TABLE `_log_keyword` (
  `id_log` int(11) NOT NULL,
  `keyword` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_date_object` date NOT NULL,
  `ip` text NOT NULL,
  `browser` text NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_log_keyword` */

/*Table structure for table `_maintenance` */

DROP TABLE IF EXISTS `_maintenance`;

CREATE TABLE `_maintenance` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `setting` text NOT NULL,
  `id_status` enum('online','offline') NOT NULL,
  `wrong_password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_maintenance` */

insert  into `_maintenance`(`id`,`title`,`setting`,`id_status`,`wrong_password`) values (1,'Halaman Publik','1,2,3,4,5,6,7,8,9','online',10);

/*Table structure for table `_menu` */

DROP TABLE IF EXISTS `_menu`;

CREATE TABLE `_menu` (
  `id_menu` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon_menu` varchar(255) NOT NULL,
  `type_menu` int(255) NOT NULL,
  `_target` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_menu` */

insert  into `_menu`(`id_menu`,`parent_id`,`menu_name`,`link`,`icon_menu`,`type_menu`,`_target`,`order_no`,`position`,`id_status`,`id_user`) values (1,0,'Beranda','home','fa-home',1,1,1,1,1,1);

/*Table structure for table `_menu_admin` */

DROP TABLE IF EXISTS `_menu_admin`;

CREATE TABLE `_menu_admin` (
  `id_menu` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon_menu` varchar(255) NOT NULL,
  `type_menu` int(11) NOT NULL,
  `_target` int(255) NOT NULL,
  `order_no` int(11) NOT NULL,
  `id_group` varchar(255) NOT NULL,
  `display` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_menu_admin` */

insert  into `_menu_admin`(`id_menu`,`parent_id`,`menu_name`,`link`,`icon_menu`,`type_menu`,`_target`,`order_no`,`id_group`,`display`,`position`,`id_status`,`id_user`) values (1,0,'Administrator','administrator','fa-bars',1,1,1,'1,2,6',2,1,1,3),(2,0,'Konfigurasi','#','fa-cogs',1,1,2,'1',2,1,1,1),(3,2,'Modul Publik','privilege','fa-server',1,1,2,'1',2,1,1,1),(4,2,'Modul Admin','module','fa-lock',1,1,3,'1',2,1,1,1),(6,2,'Group','group','fa-users',1,1,1,'1',2,1,1,1),(7,0,'Menu Admin','#','fa-th-large',1,1,3,'1',2,1,1,1),(8,7,'Main Menu','main-menu-admin','fa-align-left',1,1,2,'1',2,1,1,1),(9,7,'Top Bar','#','fa-align-justify',1,1,1,'1',2,1,2,1),(10,0,'Menu Publik','#','fa-th-large',1,1,4,'1',2,1,2,1),(11,10,'Main Menu','main-menu','fa-align-left',1,1,2,'1',2,1,1,1),(12,10,'Top Bar','#','fa-align-justify',1,1,1,'1',2,1,2,1),(13,0,'Management User','#','fa-user',1,1,5,'1',2,1,1,1),(14,13,'Bagian','instansi','fa-university',1,1,1,'1',2,1,1,1),(15,13,'User','user','fa-users',1,1,2,'1',2,1,1,1),(16,2,'CI Sessions','session-site','fa-archive',1,1,5,'1',2,1,1,1),(17,0,'Logout','administrator/logout','fa-lock',1,1,9999,'1,2,3',1,1,1,1),(22,0,'Tutorial','#','fa-book',1,1,8,'1',2,1,1,1),(23,22,'Tag Kategori','category','fa-tag',1,1,21,'1',2,1,1,1),(24,22,'Content','content','fa-pencil',1,1,22,'1',2,1,1,1),(25,0,'Media Manager','media-manager','fa-box',1,2,9,'1',1,1,1,1),(37,13,'Block','user-block','fa-users',1,1,3,'1',2,1,1,1),(38,0,'Master Data','#','fa-database',1,1,9,'1,2,6',2,1,1,1),(43,38,'Master Kelas','master-kelas','fa-th-large',1,1,2,'1,2,6,7,8',2,1,1,1),(42,38,'Mata Pelajaran','mata-pelajaran','fa-book',1,1,3,'1,2,6,7',2,1,1,1),(44,0,'Siswa','#','fa-users',1,1,10,'1,2,6,7,8',2,1,1,1),(45,44,'Biodata','biodata-siswa','fa-info',1,1,1,'1,2,6,7,8',2,1,1,1),(46,0,'Layanan Terpadu','#','fa-cog',1,1,11,'1,2,3,4,5,6,7,8',2,1,1,1),(47,46,'Bimbingan Konseling','bimbingan-konseling','fa-hand-holding-heart',1,1,1,'1,2,6',2,1,1,1),(48,0,'Guru','#','fa-address-card',1,1,12,'1,2,6',2,1,1,1),(49,48,'Biodata','biodata-guru','fa-info',1,1,1,'1,2,6',2,1,1,1),(50,46,'Legalisir Ijazah','#','fa-gavel',1,1,2,'1,2,6',2,1,1,1),(51,0,'Mata Pelajaran di Kelas','mapel-kelas','',1,1,13,'1,2,8',1,1,1,1),(52,0,'Master Jam','master-jam','',2,1,14,'1,2,7,8',1,1,1,1),(53,0,'Absensi Guru','master-absensi-guru','',1,1,15,'1,2,7,8',2,1,2,1),(54,0,'Master Monitor Kelas','master-monitor-kelas','',1,1,16,'1,2,7,8',2,1,2,1),(55,0,'Master Jadwal Pelajaran','master-jadwal-pelajaran','',1,1,17,'1,2,7,8',1,1,1,1),(56,0,'Bahan Ajar','bahan-ajar','',1,1,18,'1,2,7,8',1,1,1,1),(57,0,'Nilai Siswa','nilai-siswa','',1,1,19,'1,2,7,8',1,1,1,1),(58,0,'Siswa Kelas','siswa-kelas','',1,2,20,'1,2,7,8',1,1,1,1),(59,0,'Tahun Ajaran','tahun-ajaran','',2,1,21,'1,2,7,8',1,1,1,1),(50,46,'Legalisir Ijazah','legalisir-ijazah','fa-gavel',1,1,2,'1,2,3,7',2,1,1,1),(51,46,'Izin Online','izin-online','fa-envelope',1,1,3,'1,2,3,4,5',2,1,1,1),(52,46,'Izin Kepala Sekolah','izin-kepala-sekolah','fa-envelope',1,1,4,'1,2,3,6',2,1,1,1),(53,46,'Izin Tata Usaha','izin-tata-usaha','fa-envelope',1,1,5,'1,2,3,6',2,1,1,1),(54,46,'Pembayaran SPP Sekolah','pembayaran-spp','fa-gavel',1,1,6,'1,2,3,4,5,6',2,1,1,1),(55,46,'Kartu Ujian Siswa','kartu-ujian','fa-gavel',1,1,8,'1,2,3,5,7',2,1,1,1),(56,46,'Pembayaran SPP Kelas','pembayaran-spp-kelas','fa-gavel',1,1,7,'1,2,5,6',2,1,1,1),(57,0,'Tahun Ajaran','tahun-ajaran','fa-envelope',1,1,13,'1,2,3,4,5,6,7,8',2,1,1,1);

/*Table structure for table `_module` */

DROP TABLE IF EXISTS `_module`;

CREATE TABLE `_module` (
  `id_module` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `_controller` varchar(255) NOT NULL,
  `_function` varchar(255) NOT NULL,
  `id_group` varchar(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_module` */

insert  into `_module`(`id_module`,`parent_id`,`module_name`,`_controller`,`_function`,`id_group`,`order_no`,`id_status`,`id_user`) values (1,0,'Dashboard','administrator','index','1,2,3,6,7',1,1,3),(2,1,'Logout','administrator','logout','1,2,3',2,1,1),(3,1,'Change Password','administrator','change_password','1,2,3',3,1,1),(4,1,'Change Password Save','administrator','save_password','1,2,3',4,1,1),(5,1,'Edit Profile','administrator','edit_profile','1,2,3',5,1,1),(6,1,'Update Profile','administrator','update_profile','1,2,3',1,1,1),(7,0,'Group (index)','group','index','1,2',2,1,1),(8,7,'Group (edit)','group','edit','1,2',2,1,1),(9,7,'Group (add)','group','add','1,2',1,1,1),(10,7,'Group (delete)','group','delete','1,2',3,1,1),(11,0,'Privilege (index)','privilege','index','1',3,1,1),(12,11,'Privilege (add)','privilege','add','1',1,1,1),(13,11,'Privilege (edit)','privilege','edit','1',2,1,1),(14,11,'Privilege (delete)','privilege','delete','1',3,1,1),(15,0,'Module (index)','module','index','1',4,1,1),(16,15,'Module (add)','module','add','1',1,1,1),(20,15,'Module (Edit)','module','edit','1',3,1,1),(19,18,'sub','','','1',1,1,1),(21,0,'Maintenance','maintenance','index','1',5,1,1),(22,0,'Session (index)','session_site','index','1',6,1,1),(23,22,'Session (search)','session_site','search','1',1,1,1),(24,15,'Module (search)','module','search','1',4,1,1),(25,11,'Privilege (search)','privilege','search','1',4,1,1),(26,7,'Group (search)','group','search','1,2',4,1,1),(27,22,'Session (delete)','session_site','delete','1',2,1,1),(28,0,'Main Menu Admin (index)','main_menu_admin','index','1',7,1,1),(29,28,'Main Menu Admin (search)','main_menu_admin','search','1',1,1,1),(30,28,'Main Menu Admin (Add)','main_menu_admin','add','1',2,1,1),(31,28,'Main Menu Admin (edit)','main_menu_admin','edit','1',3,1,1),(32,28,'Main Menu Admin (Delete)','main_menu_admin','delete','1',4,1,1),(33,0,'Main Menu Publik (index)','main_menu','index','1',8,1,1),(34,33,'Main Menu Publik (search)','main_menu','search','1',1,1,1),(35,33,'Main Menu Publik (Add)','main_menu','add','1',2,1,1),(36,33,'Main Menu Publik (edit)','main_menu','edit','1',3,1,1),(37,33,'Main Menu Publik (delete)','main_menu','delete','1',4,1,1),(38,0,'Instansi (index)','instansi','index','1',9,1,1),(39,38,'Instansi (search)','instansi','search','1',1,1,1),(40,38,'Instansi (add)','instansi','add','1',2,1,1),(41,38,'Instansi (edit)','instansi','edit','1',3,1,1),(42,38,'Instansi (delete)','instansi','delete','1',4,1,1),(43,0,'User (index)','user','index','1,2',10,1,1),(44,43,'User (search)','user','search','1,2',1,1,1),(45,43,'User (add)','user','add','1',2,1,1),(55,43,'User (edit)','user','edit','1,2',3,1,1),(56,43,'User (delete)','user','delete','1,2',4,1,1),(63,0,'Kategori (index)','category','index','1,2',15,1,1),(64,63,'Kategori (search)','category','search','1,2',1,1,1),(65,63,'Kategori (add)','category','add','1,2',2,1,1),(66,63,'Kategori (edit)','category','edit','1,2',3,1,1),(67,63,'Kategori (delete)','category','delete','1,2',4,1,1),(68,0,'Konten (index)','content','index','1,2',16,1,1),(69,68,'Konten (search)','content','search','1,2',1,1,1),(70,68,'Konten (add)','content','add','1,2',2,1,1),(71,0,'Media Upload (Full User)','media_upload','index','1,2',17,1,1),(72,71,'Media Upload (Full User)','media_upload','elfinder_connector','1,2',1,1,1),(73,0,'Media Manager','media_manager','index','1,2',18,1,1),(74,73,'Media Manager','media_manager','elfinder_connector','1,2',1,1,1),(75,68,'Konten (delete)','content','delete','1,2',3,1,1),(76,68,'Konten (delete gambar)','content','gambar','1,2',4,1,1),(77,68,'Konten (edit)','content','edit','1,2',5,1,1),(78,0,'User Block','user_block','index','1',19,1,1),(79,0,'Supir (index)','supir','index','1,2',16,1,1),(80,79,'Supir (save)','supir','save','1,2',1,1,1),(81,79,'Supir (delete)','supir','delete','1,2',5,1,1),(82,79,'Supir (list)','supir','list','1,2',3,1,1),(83,79,'Supir (edit)','supir','edit','1,2',4,1,1),(84,79,'Supir (Get Supir)','supir','get_supir','1,2',5,1,1),(85,0,'Mobil (index)','mobil','index','1,2',17,1,1),(86,85,'Mobil (get_mobil)','mobil','get_mobil','1,2',1,1,1),(87,85,'Mobil (edit)','mobil','edit','1,2',2,1,1),(88,85,'Mobil (list)','mobil','list','1,2',3,1,1),(89,85,'Mobil (delete)','mobil','delete','1,2',4,1,1),(90,85,'Mobil (save)','mobil','save','1,2',5,1,1),(91,0,'Mata Pelajaran (index)','Mata_pelajaran','index','1,2,6',18,1,1),(92,91,'Mata Pelajaran (add)','Mata_pelajaran','add','1,2,6,7',1,1,1),(93,91,'Mata Pelajaran (delete)','Mata_pelajaran','delete','1,2,6,7',2,1,1),(94,91,'Mata Pelajaran (edit)','Mata_pelajaran','edit','1,2,6,7',3,1,1),(95,0,'Master Kelas (index)','Master_kelas','index','1,2,6,7,8',19,1,1),(96,95,'Mata Pelajaran (add)','Master_kelas','add','1,2,6,7,8',1,1,1),(97,95,'Mata Pelajaran (delete)','Master_kelas','delete','1,2,6,7,8',2,1,1),(98,95,'Mata Pelajaran (edit)','Master_kelas','edit','1,2,6,7,8',3,1,1),(99,0,'Biodata Siswa','biodata_siswa','index','1,2,6,7,8',20,1,1),(100,99,'Siswa','biodata_siswa','search','1,2,6,7,8',1,1,1),(101,99,'Siswa','biodata_siswa','add','1,2,6,7,8',2,1,1),(102,0,'Bimbingan Konseling (index)','bimbingan_konseling','index','1,2,6',21,1,3),(103,102,'Bimbingan Konseling (add)','bimbingan_konseling','add','1,6',1,1,3),(104,102,'Bimbingan Konseling (ajax autocomplete)','bimbingan_konseling','cari_siswa','1,6',2,1,3),(105,99,'Siswa','biodata_siswa','edit','1,2,6,7,8',3,1,1),(106,99,'siswa','biodata_siswa','gambar','1,2,6,7,8',4,1,1),(107,0,'Biodata Guru','biodata_guru','index','1,2,6',22,1,1),(108,107,'Biodata Guru','biodata_guru','search','1,2,6',1,1,1),(109,107,'Biodata Guru','biodata_guru','add','1,2,6',2,1,1),(110,107,'Biodata Guru','biodata_guru','edit','1,2,6',3,1,1),(111,0,'Mata Pelajaran di Kelas','mapel_kelas','index','1,2,3,4,5,6',23,1,1),(112,111,'Mata Pelajaran di Kelas','mapel_kelas','add','1,2,8',1,1,1),(113,111,'Mata Pelajaran di Kelas','mapel_kelas','edit','1,2,8',2,1,1),(114,111,'Mata Pelajaran di Kelas','mapel_kelas','delete','1,2,6,7,8',3,1,1),(115,111,'Mata Pelajaran di Kelas','mapel_kelas','search','1,2,8',4,1,1),(116,0,'Jam Pelajaran Kelas','japel_kelas','index','1,2,7,8',24,1,1),(117,116,'Jam Pelajaran Kelas','japel_kelas','add','1,2,7,8',1,1,1),(118,116,'Jam Pelajaran Kelas','japel_kelas','edit','1,2,7,8',2,1,1),(119,116,'Jam Pelajaran Kelas','japel_kelas','delete','1,2,7,8',3,1,1),(120,116,'Jam Pelajaran Kelas','japel_kelas','search','1,2,7,8',4,1,1),(121,0,'Master Jam','Master_jam','index','1,2,7,8',25,1,1),(122,121,'Master Jam (Add)','Master_jam','add','1,2,7,8',1,1,1),(123,121,'Master Jam (Edit)','Master_jam','edit','1,2,7,8',2,1,1),(124,121,'Master Jam (Hapus)','Master_jam','delete','1,2,7,8',3,1,1),(125,0,'Absensi Guru','Master_absensi_guru','index','1,2,7,8',26,1,1),(126,125,'Absensi Guru','Master_absensi_guru','add','1,2,7,8',1,1,1),(127,125,'Absensi Guru','Master_absensi_guru','edit','1,2,7,8',2,1,1),(128,125,'Absensi Guru','Master_absensi_guru','delete','1,2,7,8',3,1,1),(129,0,'Master Monitor Kelas','Master_monitor_kelas','index','1,2,7,8',27,1,1),(130,129,'Master Monitor Kelas','Master_monitor_kelas','add','1,2,7,8',1,1,1),(131,129,'Master Monitor Kelas','Master_monitor_kelas','edit','1,2,7,8',2,1,1),(132,129,'Master Monitor Kelas','Master_monitor_kelas','delete','1,2,7,8',3,1,1),(133,0,'Master Jadwal Pelajaran','Master_jadwal_pelajaran','index','1,2,7,8',28,1,1),(134,133,'Master Jadwal Pelajaran','Master_jadwal_pelajaran','add','1,2,7,8',1,1,1),(135,133,'Master Jadwal Pelajaran','Master_jadwal_pelajaran','edit','1,2,7,8',2,1,1),(136,133,'Master Jadwal Pelajaran','Master_jadwal_pelajaran','delete','1,2,7,8',3,1,1),(137,133,'Master Jadwal Pelajaran','Master_jadwal_pelajaran','search','1,2,7,8',4,1,1),(138,107,'Biodata Guru','biodata_guru','delete','1,2,7,8',4,1,1),(139,0,'Bahan Ajar','bahan_ajar','index','1,2,7,8',29,1,1),(140,139,'Bahan Ajar','bahan_ajar','add','1,2,7,8',1,1,1),(141,139,'Bahan Ajar','bahan_ajar','edit','1,2,7,8',2,1,1),(142,139,'Bahan Ajar','bahan_ajar','delete','1,2,7,8',3,1,1),(143,139,'Bahan Ajar','bahan_ajar','search','1,2,7,8',4,1,1),(144,0,'Nilai Siswa','nilai_siswa','index','1,2,7,8',30,1,1),(145,144,'Nilai Siswa','nilai_siswa','add','1,2,7,8',1,1,1),(146,144,'Nilai Siswa','nilai_siswa','edit','1,2,7,8',2,1,1),(147,144,'Nilai Siswa','nilai_siswa','delete','1,2,7,8',3,1,1),(148,144,'Nilai Siswa','nilai_siswa','search','1,2,7,8',4,1,1),(149,0,'Siswa Kelas','siswa_kelas','index','1,2,7,8',31,1,1),(150,149,'Siswa Kelas','siswa_kelas','add','1,2,7,8',1,1,1),(151,149,'Siswa Kelas','siswa_kelas','edit','1,2,7,8',2,1,1),(152,149,'Siswa Kelas','siswa_kelas','delete','1,2,7,8',3,1,1),(153,0,'Tahun Ajaran','tahun_ajaran','index','1,2,7,8',32,1,1),(154,153,'Tahun Ajaran','tahun_ajaran','add','1,2,6,7,8',1,1,1),(155,153,'Tahun Ajaran','tahun_ajaran','edit','1,2,7,8',2,1,1),(156,153,'Tahun Ajaran','tahun_ajaran','delete','1,2,7,8',3,1,1),(157,144,'Nilai Siswa','nilai_siswa','search2','1,2,6,7,8',5,2,1),(113,102,'Bimbingan Konseling (edit)','bimbingan_konseling','edit','1,2,6',3,1,1),(112,15,'Module (delete)','module','delete','1',4,1,1);

/*Table structure for table `_position_menu` */

DROP TABLE IF EXISTS `_position_menu`;

CREATE TABLE `_position_menu` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_position_menu` */

insert  into `_position_menu`(`id`,`title`,`id_status`) values (1,'Main Menu',1),(2,'sidebar',1);

/*Table structure for table `_session` */

DROP TABLE IF EXISTS `_session`;

CREATE TABLE `_session` (
  `id_session` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `session_value` varchar(255) NOT NULL,
  `session_date` datetime NOT NULL,
  `ip` text NOT NULL,
  `browser` text NOT NULL,
  `id_status` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_session` */

insert  into `_session`(`id_session`,`id_user`,`username`,`session_value`,`session_date`,`ip`,`browser`,`id_status`) values (1,1,'beye','5a5cede07883b74f7478eef8f0cd6bc8','2019-07-15 08:19:14','::1','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0','2'),(2,1,'beye','9f9e22b6b0f04bf84ef5fb6e9ac9216b','2019-07-15 11:24:45','::1','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0','2'),(3,1,'beye','4ae1efc0b81b1c31f363f001a6457c12','2019-07-15 12:39:52','::1','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0','2'),(4,2,'admin1','8b65a27e56ff8b00172570d655d950d5','2019-07-15 16:15:58','::1','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0','1'),(5,1,'beye','2f13888c4a96b544d3383bd0ecb1188d','2019-07-15 20:42:22','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36','2'),(6,1,'beye','53298506431d7a2c7c1ccd6f4fae6335','2019-07-16 15:37:07','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36','2'),(7,1,'beye','38b10affb470d9db193ea2f58a3f372e','2019-07-16 19:49:19','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2'),(8,1,'beye','f3d6d034e21cd83448985a15c72f126a','2019-07-17 08:15:48','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0.1 Safari/605.1.15','2'),(9,1,'beye','a0b4d8ff43dbf86058b7fc20bdc0ecf5','2019-07-17 08:16:26','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2'),(10,1,'beye','d330aa96fb28b868c9e85da150b2e424','2019-07-17 14:57:58','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2'),(11,1,'beye','9d0d3fc06fda8424b3cccb45b6f17336','2019-08-06 11:30:32','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2'),(12,1,'beye','d61fdf3e9db8f9f862a98a7d90c4b538','2019-08-12 18:09:44','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(13,1,'beye','5e4e1f2702b65753b32ddd9f02e617e5','2019-08-13 09:57:53','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(14,1,'beye','490c0951b8319b89b3e0d4356b66577a','2019-08-13 10:30:17','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(15,1,'beye','949102b34021aca0f72cbd70a119e012','2019-08-13 10:31:24','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(16,1,'beye','849a229d1641575804579b0e234ce506','2019-08-13 10:32:05','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(17,1,'beye','9b6328ca1a89876dfc4f5a8248f957c6','2019-08-13 10:36:55','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(18,3,'dhanidwiputra','11c5d2947d6440bd63d08dfcdbf3713a','2019-08-13 10:39:23','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(19,3,'dhanidwiputra','689803dcf509848b9ace0b3a51bdc590','2019-08-13 10:40:06','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(20,3,'dhanidwiputra','bddfae5cf3eb9f21231bf57fdb0aab9d','2019-08-13 10:43:51','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(21,3,'dhanidwiputra','43593682859e9a40074a0863dd55ba66','2019-08-13 15:17:33','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(22,3,'dhanidwiputra','34ddb7a9eb694fa2e7b0598f47e6b4e4','2019-08-13 15:17:47','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(23,3,'dhanidwiputra','c85f1708ce1d6be7ffe7eae288a99bf8','2019-08-13 21:21:36','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(24,1,'beye','fed87f1258d262ee7f21f28355e85eaf','2019-08-13 22:56:33','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(25,3,'dhanidwiputra','13e45f9bbc8643cc8b147d2c4afc54d3','2019-08-14 12:35:23','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(26,3,'dhanidwiputra','b5b050f35612193e3c34032ffce7b8ad','2019-08-14 23:50:09','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(27,3,'dhanidwiputra','a74e92ba881493bb29a7495f121662b8','2019-08-15 09:02:10','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(28,3,'dhanidwiputra','7ddb5987950503d7504993b1679bd2c0','2019-08-23 09:40:02','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(29,3,'dhanidwiputra','8f554b5529dfccee6dc9d1d5264f1dfd','2019-08-24 12:16:46','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(30,3,'dhanidwiputra','be6fe8fdd3bccd973ef4141c1c69e124','2019-08-26 20:52:15','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(31,3,'dhanidwiputra','a480cad52517a8f99b98b9eb9563aae5','2019-08-27 08:22:06','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(32,3,'dhanidwiputra','ccbb2ad33399bd6cf6a9980d46767d07','2019-08-27 16:58:40','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(33,3,'dhanidwiputra','84637255f707f3e6ecc7ea8227e88e20','2019-08-28 21:10:16','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2'),(34,1,'beye','1c6137180549ccf87c5106306726f9bc','2019-09-03 19:38:03','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36','2'),(35,1,'beye','e18a08a21b4b040c05bdbfddd84f24ca','2019-09-04 08:43:31','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36','2'),(36,3,'dhanidwiputra','e650558307c35c1cbb3c438f844413fc','2019-09-04 16:22:32','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','2'),(37,3,'dhanidwiputra','2f664e8781d8a6a3ff27c2fb0635d080','2019-09-04 19:22:45','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','2'),(38,4,'fahmi','1e4a79394148fbe63dcf8cdbb8f78c51','2019-09-04 19:25:57','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','2'),(39,3,'dhanidwiputra','710830bd646ec763b708ad6b42d6319b','2019-09-12 08:08:53','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','2'),(40,4,'fahmi','7826ea44027b6871f7694ab4c5f3928d','2019-09-12 08:52:11','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','1'),(41,3,'dhanidwiputra','1ac89ac2dc81dbefe3a1316c1f86014f','2019-09-12 20:43:16','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','2'),(42,1,'beye','32c28c797386bdce548ec19cee8f5c45','2019-09-13 08:26:51','::1','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0','2'),(43,1,'beye','7a0e9b7a674d001e29a409a6f56a95b0','2019-10-31 10:39:59','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36','2'),(44,1,'beye','7cf18cb99e3a173b4911a2d9c3a979f5','2019-10-31 15:31:54','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36','2'),(45,1,'beye','31fd064a24e728348c135ea13c555616','2019-11-01 11:21:03','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(46,1,'beye','70ff074dcb8e9942b7cb4ffa6a45ed29','2019-11-02 15:27:48','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(47,1,'beye','8ae745130a7efb70773e074d7cdc2188','2019-11-03 23:40:06','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(48,1,'beye','8beed9b9a912987174e990a3bdcb78a2','2019-11-04 05:44:32','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(49,1,'beye','c5ea301d598332d72d21dfd2d5da6600','2019-11-06 00:46:38','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(50,1,'beye','3b55eb9be3055e7d6df572f42e0c6210','2019-11-10 09:06:59','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(51,1,'beye','e806c2addc9e95f1287fecd3c1e66288','2019-11-10 17:39:18','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(52,1,'beye','2adef234215a8cd64c9e1e42868bf8e2','2019-11-11 12:26:37','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(53,1,'beye','0fa8f0dc0847592652ccedde98285427','2019-11-11 17:34:41','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(54,1,'beye','4495dd51b4ccda7f569c85a93424d83b','2019-11-11 20:51:34','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','2'),(55,1,'beye','b1ed85c9ba5b755c09a72b57deaeba5c','2019-11-12 15:12:38','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(56,1,'beye','f125fb6249759ebd5a99b0a6e451e197','2019-11-12 16:26:43','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(57,1,'beye','dd2675039e8f9532e63b6072e98b57f6','2019-11-13 19:57:19','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(58,1,'beye','8864b213cfd968aa25ecb9933291e44b','2019-11-14 05:17:39','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(59,1,'beye','35fc306bd30cf09074a65da3d0b0a4f0','2019-11-14 17:27:47','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(60,1,'beye','d056a8c47ab1ca76b604971b5a62091a','2019-11-16 10:42:48','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(61,1,'beye','e89982645670b058ae1313ddc3f230e5','2019-11-16 16:09:24','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(62,1,'beye','b6f05f68dc3ae962e40d291023647201','2019-11-18 09:33:41','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(63,1,'beye','cb7b5ec2e94a6b2066a48a6799a3799c','2019-11-18 17:04:38','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(64,1,'beye','2fbf0343dd2bcf61ab83f624ba19cd7b','2019-11-19 10:34:36','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(65,1,'beye','87ce971afa381df44061818087801bdc','2019-11-22 10:21:27','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(66,1,'beye','7e8ce087eb557428b4211c0bee8d849d','2019-11-22 22:05:38','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(67,1,'beye','172e06d4b80c23b12be1d1146788b5f2','2019-11-24 22:47:06','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(68,1,'beye','d2cf9693852e2359104014d54c814183','2019-11-25 13:30:23','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(69,1,'beye','166c2b404bf8b4b1c5d52f0c6d68805b','2019-11-26 05:24:42','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(70,1,'beye','8e86b10cb46655f7efcc7a872e926a9d','2019-11-26 10:42:53','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(71,1,'beye','da9ca6e852be54d55c22a2fb65199225','2019-11-28 07:20:31','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(72,1,'beye','adc232eb1bb0f520370d8bae6c01683f','2019-11-28 20:42:24','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(73,1,'beye','09434f07142a96fafe3145a4335a2bfc','2019-12-03 16:01:37','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(74,1,'beye','531f255714f5f6753f19a6c43553e034','2019-12-05 19:15:45','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(75,1,'beye','113b8255d79095c265270fd0893dadac','2019-12-05 21:01:24','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(76,1,'beye','e52eb8a0088f6046db275ea79886cad0','2019-12-05 21:04:49','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(77,3,'dhanidwiputra','4a9f29e444354cd0bae2dc1636c3996a','2019-12-05 21:11:14','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(78,3,'dhanidwiputra','98a54f1dfc956e319f79f19cef4f0002','2019-12-05 21:11:57','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(79,1,'beye','447fd229dee492e341c78f441e652747','2019-12-05 21:21:54','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(80,1,'beye','730540e22fef95b555714db562c4c494','2019-12-05 21:25:15','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(81,1,'beye','46c7076851e5f3afc08de91ad5620b94','2019-12-05 21:37:07','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','2'),(82,1,'beye','05faa494381da61dc4f77f330dbc33f8','2019-12-05 22:09:38','::1','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(83,3,'dhanidwiputra','0dbd171a3689588d0536c35ce5a349f1','2019-12-05 22:31:52','36.68.55.173','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(84,1,'beye','28af50cea05160608ed880f3836f3759','2019-12-05 22:38:49','36.68.53.147','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','1'),(85,3,'dhanidwiputra','c71bffed27748adb5df596b10498a32e','2019-12-05 22:41:20','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2'),(86,3,'dhanidwiputra','ad8af44b90cf9c6cae7f35eebf54492c','2019-12-05 22:41:32','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','1');

/*Table structure for table `_status_anak` */

DROP TABLE IF EXISTS `_status_anak`;

CREATE TABLE `_status_anak` (
  `id_status_anak` int(11) NOT NULL,
  `status_anak` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_status_anak` */

insert  into `_status_anak`(`id_status_anak`,`status_anak`) values (1,'Kandung'),(2,'Angkat');

/*Table structure for table `_status_bayar` */

DROP TABLE IF EXISTS `_status_bayar`;

CREATE TABLE `_status_bayar` (
  `id_status_bayar` int(11) NOT NULL,
  `status_bayar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_status_bayar` */

insert  into `_status_bayar`(`id_status_bayar`,`status_bayar`) values (1,'Lunas'),(2,'Belum Bayar');

/*Table structure for table `_status_izin` */

DROP TABLE IF EXISTS `_status_izin`;

CREATE TABLE `_status_izin` (
  `id_status_izin` int(11) NOT NULL,
  `status_izin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_status_izin` */

insert  into `_status_izin`(`id_status_izin`,`status_izin`) values (1,'Pihak Sekolah'),(2,'Pihak Luar Sekolah');

/*Table structure for table `_status_legalisir` */

DROP TABLE IF EXISTS `_status_legalisir`;

CREATE TABLE `_status_legalisir` (
  `id_status_legalisir` int(11) NOT NULL,
  `status_legalisir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_status_legalisir` */

insert  into `_status_legalisir`(`id_status_legalisir`,`status_legalisir`) values (1,'Pending'),(2,'Selesai');

/*Table structure for table `_status_peserta_didik` */

DROP TABLE IF EXISTS `_status_peserta_didik`;

CREATE TABLE `_status_peserta_didik` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_status_peserta_didik` */

insert  into `_status_peserta_didik`(`id_status`,`nm_status`) values (1,'Aktif'),(2,'Skorsing'),(3,'Pindah Sekolah'),(4,'Alumni');

/*Table structure for table `_status_spp_kelas` */

DROP TABLE IF EXISTS `_status_spp_kelas`;

CREATE TABLE `_status_spp_kelas` (
  `id_status_spp_kelas` int(11) NOT NULL,
  `status_spp_kelas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_status_spp_kelas` */

insert  into `_status_spp_kelas`(`id_status_spp_kelas`,`status_spp_kelas`) values (1,'Lunas'),(2,'Belum Lunas');

/*Table structure for table `_status_system` */

DROP TABLE IF EXISTS `_status_system`;

CREATE TABLE `_status_system` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_status_system` */

insert  into `_status_system`(`id_status`,`nm_status`) values (1,'Aktif'),(2,'Non Aktif'),(3,'Blokir'),(4,'Publish'),(5,'Not Publish');

/*Table structure for table `_target_menu` */

DROP TABLE IF EXISTS `_target_menu`;

CREATE TABLE `_target_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_target_menu` */

insert  into `_target_menu`(`id`,`title`) values (1,'_self'),(2,'_blank'),(3,'_parent'),(4,'_top'),(5,'framename');

/*Table structure for table `_type_menu` */

DROP TABLE IF EXISTS `_type_menu`;

CREATE TABLE `_type_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_type_menu` */

insert  into `_type_menu`(`id`,`title`) values (1,'internal'),(2,'external');

/*Table structure for table `_users` */

DROP TABLE IF EXISTS `_users`;

CREATE TABLE `_users` (
  `id_user` int(11) NOT NULL,
  `nomor_identitas` text,
  `username` varchar(150) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` text NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_instansi` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `_users` */

insert  into `_users`(`id_user`,`nomor_identitas`,`username`,`password`,`email`,`registerDate`,`id_instansi`,`id_group`,`id_status`,`created_by`) values (1,'123','beye','48b5886a076c21966890f9e5bfe91969','riobayusentosa@gmail.com','2012-06-02 08:16:16',1,1,1,1),(2,'','admin1','210ea9050ce033901b386fc392192ae2','admin1@gmail.com','2019-07-15 16:15:45',2,2,1,0),(3,'Dhany','dhanidwiputra','992a5a9b1d182c2d8395d5d4d8e976d4','dhanidwiputra123@gmail.com','2019-08-13 22:56:59',1,1,1,0),(4,'10091','fahmi','2bfec0b87c331c4058842701233934ce','fahmi@gmail.com','2019-09-04 19:25:38',1,6,1,3),(5,NULL,'77779','8d9fe8aa3bc8c60b51593c4a99235857','','0000-00-00 00:00:00',0,0,0,0),(6,'100','100','5f25e9996728ae32e49dc9216ca49ad7','','0000-00-00 00:00:00',0,0,0,0),(7,'199','199','63653446c7c153d850ecf69e71e308d3','','2019-11-28 23:15:31',0,0,0,0);

/*Table structure for table `_users_account` */

DROP TABLE IF EXISTS `_users_account`;

CREATE TABLE `_users_account` (
  `id_account` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `telp` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_users_account` */

insert  into `_users_account`(`id_account`,`id_user`,`full_name`,`telp`,`alamat`) values (2,1,'Rio Bayu Sentosa','085263030913','Jalan bahari no. 38 ulak karang'),(3,2,'Admin 1','',''),(5,3,'Dhany Dwi Putra','','');

/*Table structure for table `_versi` */

DROP TABLE IF EXISTS `_versi`;

CREATE TABLE `_versi` (
  `id_versi` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_versi` */

insert  into `_versi`(`id_versi`,`title`,`description`,`created_date`) values (1,'1.0.0','Migrasi','2017-11-21 15:20:21'),(2,'2.0.1','Debuger','2018-04-13 15:20:21'),(3,'3.0.1','TSB Logistik','2019-07-12 15:20:21');

/*Table structure for table `_white_list` */

DROP TABLE IF EXISTS `_white_list`;

CREATE TABLE `_white_list` (
  `id_white` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `_controller` varchar(255) NOT NULL,
  `_function` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `_white_list` */

insert  into `_white_list`(`id_white`,`parent_id`,`module_name`,`_controller`,`_function`,`id_status`,`order_no`,`id_user`) values (1,0,'Welcome','welcome','index',3,1,1),(2,0,'Login','management','index',1,2,1),(3,2,'Cek Login','management','cek_login',1,1,1),(4,0,'Reset','reset','index',1,3,1),(5,4,'Reset','reset','akun',1,1,1),(6,4,'Halaman Reset Password','reset','account',1,2,1),(7,4,'Reset Password','reset','password',1,3,1),(8,0,'Homepage','home','index',2,4,1),(9,8,'Read','home','read',2,1,1),(10,0,'Searching','home','search',2,5,1),(11,8,'Category','home','category',2,2,1),(12,0,'Peta Situs','sitemap','index',2,6,1);

/*Table structure for table `bahan_ajar` */

DROP TABLE IF EXISTS `bahan_ajar`;

CREATE TABLE `bahan_ajar` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bahan_ajar` */

insert  into `bahan_ajar`(`id`,`id_guru`,`id_kelas`,`id_jurusan`,`foto`,`created_date`,`created_modified`) values (1,1,1,1,'a13.jpg','2019-11-18 17:19:11','2019-11-18 17:19:11'),(2,2,1,1,'Rizky_Efrian_1601091050.pdf','2019-11-18 17:51:06','2019-11-18 17:51:06');

/*Table structure for table `bimbingan_konseling` */

DROP TABLE IF EXISTS `bimbingan_konseling`;

CREATE TABLE `bimbingan_konseling` (
  `id` int(11) NOT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `nip_guru` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `permasalahan` text,
  `penyelesaian` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bimbingan_konseling` */

insert  into `bimbingan_konseling`(`id`,`nis`,`nip_guru`,`date`,`permasalahan`,`penyelesaian`) values (1,'1010','200002','2019-10-16','Cabut','Bunuh'),(5,'1011','9922','2019-02-01','Jomblo','Mati aja la');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `title` text NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `category` */

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values ('02nc0kb6n76fcfq24hf02f4vkq5ridto','::1',1574730630,'__ci_last_regenerate|i:1574730393;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;title|s:4:\"Edit\";'),('03g0buuufspihb9q7oihesniqvcgfhbl','::1',1574073592,'__ci_last_regenerate|i:1574073294;__ci_vars|a:1:{s:5:\"title\";s:3:\"old\";}system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";search_box|N;title|s:15:\"Data Bahan Ajar\";'),('047c7aghb09eqmoedkvgj64r8qnmnjgj','::1',1574730202,'__ci_last_regenerate|i:1574729955;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;title|s:6:\"Module\";'),('04rot5iqm5d8ee2tec3srbagoi2o3ars','::1',1574683095,'__ci_last_regenerate|i:1574683090;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title|s:12:\" Siswa_kelas\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('07t8sn9cucvm7f3gdoc81e9a2hdk74cr','::1',1575226834,'__ci_last_regenerate|i:1575226567;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('0hhnl6b89rn5ons50k6si2mikagpi6jd','::1',1574739844,'__ci_last_regenerate|i:1574739752;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";title|s:3:\"Add\";search_box|N;'),('0ims3sv0d28avdhh8qlhrnp2hvrsvmoh','::1',1575221658,'__ci_last_regenerate|i:1575221512;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('0is3md05aqkm7li6gods517lhmslsecb','::1',1574952954,'__ci_last_regenerate|i:1574952953;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:19:\"Panel Administrator\";'),('0p5r1lqeeelgr93ima8c6dnk8gcl50r6','::1',1575366333,'__ci_last_regenerate|i:1575366028;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"old\";}'),('0sl5sjqrp75tkbug5ek106fv2bk042m0','::1',1574740883,'__ci_last_regenerate|i:1574740721;__ci_vars|a:8:{s:8:\"id_kelas\";s:3:\"old\";s:8:\"id_mapel\";s:3:\"old\";s:7:\"id_guru\";s:3:\"old\";s:11:\"nilai_siswa\";s:3:\"old\";s:14:\"id_siswa_kelas\";s:3:\"old\";s:15:\"id_tahun_ajaran\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";search_box|N;id_kelas|s:1:\"3\";id_mapel|s:1:\"6\";id_guru|s:1:\"2\";nilai_siswa|s:3:\"100\";id_siswa_kelas|s:1:\"3\";id_tahun_ajaran|s:1:\"2\";pesan|s:403:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"http://localhost/sisfosekolah/nilai-siswa/edit/\" class=\"confirm-edit\"><u>Edit</u></a>\r\n                        </div>\";title|s:11:\"Nilai Siswa\";'),('0u5kgq8fvdl7kb8npqj5045ump09d33s','::1',1573879078,'__ci_last_regenerate|i:1573879051;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('10jio7ojs3h6bs3gk0am4bhk9v1hqcfs','::1',1575550472,'__ci_last_regenerate|i:1575550407;system_value|s:32:\"287049bba5371824023b69a67d3809c6\";title|s:19:\"Bimbingan Konseling\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('10vekbej6pm2pgeaec09rf3l8g5f5fjr','::1',1574069419,'__ci_last_regenerate|i:1574069417;'),('1a7g29p42qkj0id3ns98epm5cs4ad1gb','::1',1574948833,'__ci_last_regenerate|i:1574948537;__ci_vars|a:4:{s:10:\"title_menu\";s:3:\"old\";s:4:\"link\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title_menu|s:12:\"Absensi Guru\";link|s:19:\"master-absensi-guru\";pesan|s:411:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil diperbarui.<a href=\"http://localhost/sisfosekolah/main-menu-admin/edit/53\" class=\"confirm-edit\"><u>Edit</u></a>\r\n                        </div>\";title|s:15:\"Main Menu Admin\";'),('1dtd3b9vs08kjk827sia60rhu0j0b111','::1',1573876276,'__ci_last_regenerate|i:1573876060;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('1q6pc1o34lqpdss7t64kjcbqm16j1cpo','36.68.55.173',1575558924,'__ci_last_regenerate|i:1575558781;'),('1qoagnfdvf9dk73pb93ncbrnr3q14ceb','::1',1574952069,'__ci_last_regenerate|i:1574951890;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('1t50n4p9bi3i2gc2p26cpivpk4tp8dns','::1',1574667382,'__ci_last_regenerate|i:1574667191;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:4:\"Edit\";'),('1tsgls84cd6gbiq3imlrub0dfv40j7c1','::1',1574901116,'__ci_last_regenerate|i:1574900889;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";title|s:21:\"Data Jadwal Pelajaran\";search_box|s:3:\"X 2\";'),('1vi51if27ntckajj2q6m9phq95t8fh8t','::1',1575216587,'__ci_last_regenerate|i:1575216431;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:3:\"Add\";'),('25k4drihn5kh1sn2n1qtegvf5or9veos','::1',1575560456,'__ci_last_regenerate|i:1575560235;'),('260i5av8a75m0t83oga2np4s819ps36q','::1',1574721794,'__ci_last_regenerate|i:1574721504;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:11:\"Nilai Siswa\";search_box|N;'),('2ehg6vjmmn7dlpcifmjr1n8079ioqsru','::1',1574741949,'__ci_last_regenerate|i:1574741859;system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";search_box|N;title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"old\";}'),('2jgbthitfrlcsrmtbl20p4h3ik2d0u0a','::1',1575560697,'__ci_last_regenerate|i:1575560676;'),('2m2dcodevvdiqe89f7lrnr5bo6vo9hsg','::1',1574900562,'__ci_last_regenerate|i:1574900417;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";title|s:23:\"Master Jadwal Pelajaran\";search_box|N;'),('2m2f40t0cfctbg6k1u6srmkjf6qslm9q','::1',1575224963,'__ci_last_regenerate|i:1575224667;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:3:\"Add\";'),('2qljhsnjs8q39uurrka6pgci1k48b7pu','::1',1574678520,'__ci_last_regenerate|i:1574678369;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title|s:10:\"Data Siswa\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('2ugn942r20947s00qdar14jaaqlp75cf','::1',1575550143,'__ci_last_regenerate|i:1575550089;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"287049bba5371824023b69a67d3809c6\";title|s:11:\"Kartu Ujian\";'),('3702j9lt2gt7npmlkf12su6a33h0m1sd','::1',1574665699,'__ci_last_regenerate|i:1574665405;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:3:\"Add\";'),('3b94iqpn10fbd5da1cgk5e6cehc6gsej','::1',1573900310,'__ci_last_regenerate|i:1573900290;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:4:\"Edit\";'),('3shr6pmldhll0udhmenogeub2in50rb9','::1',1574665073,'__ci_last_regenerate|i:1574664785;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:12:\" Siswa_kelas\";'),('49vj687iebov7friifa6iq8udmm84797','::1',1574441847,'__ci_last_regenerate|i:1574441847;system_value|s:32:\"7e8ce087eb557428b4211c0bee8d849d\";search_box|N;title|s:3:\"Add\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('4h769uil26lb9qatrduoj0oluvgb2a5t','::1',1574073873,'__ci_last_regenerate|i:1574073599;system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";search_box|s:1:\"1\";__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}title|s:15:\"Data Bahan Ajar\";'),('4h7p15em0i278a6baqus7eo9p3eh2bq9','::1',1575558610,'__ci_last_regenerate|i:1575558480;system_value|s:32:\"05faa494381da61dc4f77f330dbc33f8\";username|s:4:\"beye\";__ci_vars|a:2:{s:8:\"username\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}title|s:19:\"Panel Administrator\";'),('4l98j9todpisbp8attd2hae2kll2k06k','::1',1574610871,'__ci_last_regenerate|i:1574610776;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"172e06d4b80c23b12be1d1146788b5f2\";search_box|N;title|s:11:\"Nilai Siswa\";'),('4u3rgqm4bvrptt1gsj9ac6j6kvi4lln8','::1',1575220583,'__ci_last_regenerate|i:1575220380;__ci_vars|a:8:{s:5:\"title\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"new\";s:7:\"id_guru\";s:3:\"new\";s:5:\"bulan\";s:3:\"new\";s:5:\"tahun\";s:3:\"new\";s:9:\"jml_bayar\";s:3:\"new\";s:15:\"jml_keseluruhan\";s:3:\"new\";s:19:\"id_status_spp_kelas\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:3:\"Add\";id_kelas|s:1:\"5\";id_guru|s:1:\"5\";bulan|s:5:\"April\";tahun|s:4:\"2018\";jml_bayar|s:6:\"300000\";jml_keseluruhan|s:6:\"500000\";id_status_spp_kelas|s:1:\"2\";'),('50e8qud8v369frii37sev1l00n7aqp7o','::1',1574665388,'__ci_last_regenerate|i:1574665102;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:3:\"Add\";'),('52jv39umqss66pin5iblvoo18sfge4v9','::1',1575363686,'__ci_last_regenerate|i:1575363685;'),('574lvi6bl36t372muhm5da6hp4me240c','::1',1575548274,'__ci_last_regenerate|i:1575548127;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"531f255714f5f6753f19a6c43553e034\";title|s:19:\"Panel Administrator\";search_box|N;'),('5cve5codgk9ilo301jbe23e99e1oct42','::1',1575554950,'__ci_last_regenerate|i:1575554643;system_value|s:32:\"e52eb8a0088f6046db275ea79886cad0\";title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('5etb97bsrb2nekd1lcqo21jr0oe0v9f4','::1',1575550483,'__ci_last_regenerate|i:1575550483;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"531f255714f5f6753f19a6c43553e034\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('5g9hao3d65a1qfu8pm2oqlcqnu497phi','::1',1575222954,'__ci_last_regenerate|i:1575222930;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";__ci_vars|a:4:{s:10:\"title_menu\";s:3:\"old\";s:4:\"link\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}search_box|N;title_menu|s:17:\"Kartu Ujian Siswa\";link|s:11:\"kartu-ujian\";pesan|s:407:\"<div class=\"alert alert-success\">\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\n                            Data Berhasil diperbarui.<a href=\"http://localhost/sisfosekolah/main-menu-admin/edit/55\" class=\"confirm-edit\"><u>Edit</u></a>\n                        </div>\";title|s:15:\"Main Menu Admin\";'),('5ht2v9iutmkijt5bsj8iav4i7fe3gcqj','::1',1575227824,'__ci_last_regenerate|i:1575227530;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:16:\"Legalisir Ijazah\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('5kru02r61ireel5u65pr2f909t1pt4ch','::1',1575372713,'__ci_last_regenerate|i:1575372420;tgl_izin|N;alasan|N;search_box|N;system_value|s:32:\"48bd231b13ba0eabcd0d659a25b4f3e0\";title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('5pc2s41m2abcfskacq97ql6vb1nn2419','::1',1574667905,'__ci_last_regenerate|i:1574667610;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:4:{s:5:\"title\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"new\";s:8:\"id_siswa\";s:3:\"new\";s:15:\"id_tahun_ajaran\";s:3:\"new\";}title|s:4:\"Edit\";id_kelas|s:1:\"1\";id_siswa|s:1:\"2\";id_tahun_ajaran|s:1:\"1\";'),('5ruu4g3k9a5gctpfmhe2u4sk2rqqedaq','::1',1575218578,'__ci_last_regenerate|i:1575218411;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('65atva2rdijsmuvpedldp8ujede9p39e','::1',1574674278,'__ci_last_regenerate|i:1574674277;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('6d32vrslnsq33pm9lr1otl4ofndcdpoa','::1',1574727860,'__ci_last_regenerate|i:1574727597;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:3:\"Add\";search_box|N;'),('6dp36lttun8ugugl6k1bc7kh5bjn6ool','::1',1575348348,'__ci_last_regenerate|i:1575348228;system_value|s:32:\"c527fc8702eb81ac0e54a3f51c917e21\";title|s:16:\"Legalisir Ijazah\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('6h9uansc5c4l7v13uoc2ckacv54umg5i','::1',1574074267,'__ci_last_regenerate|i:1574074013;system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";__ci_vars|a:5:{s:7:\"id_guru\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"old\";s:10:\"id_jurusan\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}id_guru|s:1:\"1\";id_kelas|s:1:\"1\";id_jurusan|s:1:\"1\";pesan|s:352:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:15:\"Data Bahan Ajar\";search_box|N;'),('6l0i783oqifsvco6pn9einso3cagohl4','::1',1575227438,'__ci_last_regenerate|i:1575227167;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:16:\"Legalisir Ijazah\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('6t21vqdmsnkggdq6a66mkv0jjer26t6o','::1',1574952384,'__ci_last_regenerate|i:1574952294;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:21:\"Data Jadwal Pelajaran\";'),('6ueeeniqugsqglfntukot4qk3aloqk9m','::1',1573903022,'__ci_last_regenerate|i:1573902723;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:9:\"Data Guru\";'),('70qj5ar899ruf677ue2ngdpjp2a068a6','::1',1574678977,'__ci_last_regenerate|i:1574678823;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title|s:10:\"Data Siswa\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('726p55vsgca7j4qnb3ahten5c30p7ggp','::1',1574436879,'__ci_last_regenerate|i:1574436879;system_value|s:32:\"7e8ce087eb557428b4211c0bee8d849d\";search_box|N;title|s:3:\"Add\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('7iapongp5rpvujhvm502673jj110uh0b','::1',1575560439,'__ci_last_regenerate|i:1575560439;system_value|s:32:\"98a54f1dfc956e319f79f19cef4f0002\";search_box|N;title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('7ivl63ugjvtps98m6m5r4l3q03nnuag6','::1',1575368758,'__ci_last_regenerate|i:1575368579;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('8fcj50gvbi2mobcaupf79nc7rdqr8542','::1',1575560707,'__ci_last_regenerate|i:1575560439;system_value|s:32:\"ad8af44b90cf9c6cae7f35eebf54492c\";search_box|N;title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('8kgt3vhu1nrull5k68nicicn3c1lsd3a','::1',1575368232,'__ci_last_regenerate|i:1575367959;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('94o88avf2k61hfbm4dtsh3ek7ablp42i','::1',1573896779,'__ci_last_regenerate|i:1573896523;__ci_vars|a:8:{s:3:\"nip\";s:3:\"old\";s:11:\"gelar_depan\";s:3:\"old\";s:14:\"gelar_belakang\";s:3:\"old\";s:12:\"nama_lengkap\";s:3:\"old\";s:12:\"tempat_lahir\";s:3:\"old\";s:13:\"tanggal_lahir\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;nip|s:4:\"7777\";gelar_depan|s:2:\"dr\";gelar_belakang|s:5:\"m.kom\";nama_lengkap|s:4:\"kiki\";tempat_lahir|s:6:\"padang\";tanggal_lahir|s:10:\"1990-01-01\";pesan|s:354:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil diperbarui.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:9:\"Data Guru\";'),('9882fns7rnalnnb63b01onp3lov6gvrd','::1',1574045278,'__ci_last_regenerate|i:1574045180;system_value|s:32:\"b6f05f68dc3ae962e40d291023647201\";__ci_vars|a:5:{s:12:\"title_module\";s:3:\"old\";s:11:\"_controller\";s:3:\"old\";s:9:\"_function\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}search_box|N;title_module|s:10:\"Bahan Ajar\";_controller|s:10:\"bahan_ajar\";_function|s:6:\"delete\";pesan|s:401:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"http://localhost/sisfosekolah/module/edit/142\" class=\"confirm-edit\"><u>Edit</u></a>\r\n                        </div>\";title|s:6:\"Module\";'),('992j37l0ds7t0fc3gij2dh18vii3vqvo','::1',1573899542,'__ci_last_regenerate|i:1573899257;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"old\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:4:\"Edit\";search_box|s:3:\"700\";'),('99duft5k17dp1667o018ose2i4bku24g','::1',1574901502,'__ci_last_regenerate|i:1574901202;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";title|s:23:\"Master Jadwal Pelajaran\";search_box|N;'),('9avighetn6paju9eah8986a20rvq6mjv','::1',1575270136,'__ci_last_regenerate|i:1575270136;'),('9c777bktgtp17om1jbr01d8s7ibcbtea','::1',1574948537,'__ci_last_regenerate|i:1574948536;'),('9j3c11u9ctiggnh01uu6oub8mn166n20','::1',1575555005,'__ci_last_regenerate|i:1575554977;system_value|s:32:\"e52eb8a0088f6046db275ea79886cad0\";title|s:19:\"Bimbingan Konseling\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('9ogm5p694f78n48l86v8quvfe32bkkss','::1',1573902406,'__ci_last_regenerate|i:1573902109;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;title|s:9:\"Data Guru\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('a6elfhmtu1gsj16svbvhebr6snlab770','::1',1573897262,'__ci_last_regenerate|i:1573897033;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:4:\"Edit\";search_box|N;'),('a6savpr01aamiqpqmbb8n7rs1uv3vni3','::1',1574072455,'__ci_last_regenerate|i:1574072174;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";search_box|N;title|s:15:\"Data Bahan Ajar\";'),('aakvk5b3q8oej2qn4q0di52fr6uu4f3e','::1',1575555784,'__ci_last_regenerate|i:1575555673;__ci_vars|a:1:{s:5:\"title\";s:3:\"old\";}system_value|s:32:\"447fd229dee492e341c78f441e652747\";title|s:19:\"Panel Administrator\";'),('aehhe3f8a62oaa24ri0rg2sgv48fe50l','::1',1573876892,'__ci_last_regenerate|i:1573876713;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('aqgdq071pkn7218t2t7cs7a65fv4sh9p','::1',1573903677,'__ci_last_regenerate|i:1573903377;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"old\";}title|s:9:\"Data Guru\";'),('assc02llmlhhq19qogrbma7khcgj66mi','::1',1574069419,'__ci_last_regenerate|i:1574069419;'),('audktuknsntro840cf1jgt33kn4ns4t5','::1',1573879708,'__ci_last_regenerate|i:1573879708;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('b20ojv72qluj2iq3bgs5m431evoc3ijg','::1',1575549455,'__ci_last_regenerate|i:1575549199;__ci_vars|a:7:{s:4:\"hari\";s:3:\"old\";s:6:\"id_jam\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"old\";s:14:\"id_mapel_kelas\";s:3:\"old\";s:10:\"tanda_guru\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"531f255714f5f6753f19a6c43553e034\";search_box|N;hari|s:5:\"Senin\";id_jam|s:1:\"1\";id_kelas|s:1:\"5\";id_mapel_kelas|s:1:\"2\";tanda_guru|s:1:\"2\";pesan|s:354:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil diperbarui.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:23:\"Master Jadwal Pelajaran\";'),('b4215ptad2e43uam9fp20692ame9igcd','::1',1574685517,'__ci_last_regenerate|i:1574685230;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:23:\"Master Jadwal Pelajaran\";'),('b5sl81uh695mghmvb853e51ckeakcmfp','::1',1573876581,'__ci_last_regenerate|i:1573876386;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('bdhukmqqtola296ggglnl7abjf1ejvcd','::1',1575550479,'__ci_last_regenerate|i:1575550182;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"531f255714f5f6753f19a6c43553e034\";search_box|N;title|s:19:\"Panel Administrator\";'),('bebu5r9du0u4n694phnkjqfcj0el2aee','::1',1575554485,'__ci_last_regenerate|i:1575554456;username|s:4:\"beye\";__ci_vars|a:1:{s:8:\"username\";s:3:\"new\";}system_value|s:32:\"113b8255d79095c265270fd0893dadac\";'),('bf0dsp3koejl679tqerosgjncp8ogfrr','::1',1574666075,'__ci_last_regenerate|i:1574665820;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:3:\"Add\";'),('bh9v1q23q6op9j40bkn1ruma2fsv82uj','::1',1575360994,'__ci_last_regenerate|i:1575360994;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:11:\"Kartu Ujian\";'),('bja030lanv7htfu7a84scat58a5q3d5i','::1',1574663743,'__ci_last_regenerate|i:1574663661;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title|s:18:\"Master Siswa_kelas\";'),('bn3glom79fpd15oseh0lmb54lvlp9coa','::1',1575219719,'__ci_last_regenerate|i:1575219452;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('bp7lmt8bfvevqi9ompngi6tckmlqlh3k','::1',1575374236,'__ci_last_regenerate|i:1575374212;tgl_izin|N;alasan|N;search_box|N;system_value|s:32:\"48bd231b13ba0eabcd0d659a25b4f3e0\";title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('btqitvcad7bo28ha3letnmvl8b225la9','::1',1574668265,'__ci_last_regenerate|i:1574667965;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:4:\"Edit\";'),('c0hsi9dmojdqqpqldk9nv05k6hc0nk9g','::1',1574903034,'__ci_last_regenerate|i:1574902773;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";title|s:12:\" Siswa_kelas\";search_box|N;'),('c0n19qccgop27ot355bqe26ttfeinmjn','::1',1575221070,'__ci_last_regenerate|i:1575221064;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:3:\"Add\";'),('c0pboa53l37qkhu8hn6ddl9fg24o4no1','::1',1575366514,'__ci_last_regenerate|i:1575366335;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('c2u1nuo2qr77b7ils33aggdo5doc20nk','::1',1575372108,'__ci_last_regenerate|i:1575371810;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('c627aa6evksqntg802mf9cs0t6vq81vv','::1',1575277238,'__ci_last_regenerate|i:1575277230;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"0cc071eea3e73e7412c99854ddb8b81c\";title|s:5:\"Index\";'),('c8u9av57i071uba8skhqbjgm8n0ppjen','::1',1575548667,'__ci_last_regenerate|i:1575548579;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"531f255714f5f6753f19a6c43553e034\";title|s:19:\"Panel Administrator\";search_box|N;'),('cjsom7g2c3it77dqvourvid062tu55sd','::1',1575369200,'__ci_last_regenerate|i:1575368906;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('cnddlghjstk3qrg4sbvcoas3ft6mbrtd','::1',1574074377,'__ci_last_regenerate|i:1574074377;system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:15:\"Data Bahan Ajar\";search_box|N;'),('cq9si68pfqosssaarnmuvpqhr2ero27q','::1',1574950770,'__ci_last_regenerate|i:1574950586;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:11:\"Nilai Siswa\";'),('cvmvsprb388hc5van0u49s25ntuvc4fj','36.68.55.173',1575558678,'__ci_last_regenerate|i:1575558450;'),('dadu67es241uaghnvcmfsoddhm17vg10','::1',1575371678,'__ci_last_regenerate|i:1575371477;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('dbd7ddbr76buq88pdjbt3g8lb5694cv7','::1',1574610711,'__ci_last_regenerate|i:1574610416;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"172e06d4b80c23b12be1d1146788b5f2\";search_box|N;title|s:3:\"Add\";'),('dffsq4ppollobp2saga5ds6pfo68iekl','::1',1574044761,'__ci_last_regenerate|i:1574044738;system_value|s:32:\"b6f05f68dc3ae962e40d291023647201\";__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}title|s:9:\"Data guru\";search_box|s:2:\"11\";'),('dhifrfk5ol9amclelte70odtt1hbkpt7','::1',1575220364,'__ci_last_regenerate|i:1575220068;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('dm7vq8jj2jaeser3jml3kp660r4hfoii','::1',1574728582,'__ci_last_regenerate|i:1574728349;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:3:\"Add\";search_box|N;'),('dn1lhu1geo4d2oh85u9n13ck7sas8o4d','::1',1575225317,'__ci_last_regenerate|i:1575225002;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"old\";}title|s:3:\"Add\";'),('dqjd1etq69jfut7r1is3gqkrt2c80eb4','::1',1575226524,'__ci_last_regenerate|i:1575226173;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;'),('e3be3iscigkbet7gempghuf4usa5c1lf','36.68.55.173',1575559544,'__ci_last_regenerate|i:1575559461;'),('e4d54vo0lm8i4cu0quot50pmtvp3v204','::1',1574685725,'__ci_last_regenerate|i:1574685571;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:7:{s:4:\"hari\";s:3:\"old\";s:6:\"id_jam\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"old\";s:14:\"id_mapel_kelas\";s:3:\"old\";s:10:\"tanda_guru\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}hari|s:5:\"Senin\";id_jam|s:1:\"1\";id_kelas|s:1:\"5\";id_mapel_kelas|s:1:\"2\";tanda_guru|s:1:\"2\";pesan|s:354:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil diperbarui.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:23:\"Master Jadwal Pelajaran\";'),('e7cnjfr4olgncqrb0so6e7rkgf3tqp7f','::1',1575364887,'__ci_last_regenerate|i:1575364630;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('e7dl5k2p71c3ltfocurru6bmb04447e1','::1',1574902402,'__ci_last_regenerate|i:1574902356;__ci_vars|a:5:{s:8:\"id_kelas\";s:3:\"old\";s:8:\"id_siswa\";s:3:\"old\";s:15:\"id_tahun_ajaran\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";id_kelas|s:1:\"1\";id_siswa|s:1:\"2\";id_tahun_ajaran|s:1:\"2\";pesan|s:403:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"http://localhost/sisfosekolah/siswa-kelas/edit/\" class=\"confirm-edit\"><u>Edit</u></a>\r\n                        </div>\";title|s:12:\" Siswa_kelas\";'),('ebn91iua3bg5qgjdg9v62qp7o25liscp','::1',1575369876,'__ci_last_regenerate|i:1575369576;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;'),('ec5c7dtu4ies0if48dstlo0pqq27q07l','::1',1574663655,'__ci_last_regenerate|i:1574663356;__ci_vars|a:5:{s:12:\"title_module\";s:3:\"old\";s:11:\"_controller\";s:3:\"old\";s:9:\"_function\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title_module|s:11:\"Siswa Kelas\";_controller|s:11:\"siswa_kelas\";_function|s:5:\"index\";pesan|s:401:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"http://localhost/sisfosekolah/module/edit/149\" class=\"confirm-edit\"><u>Edit</u></a>\r\n                        </div>\";title|s:6:\"Module\";'),('ed3bcaamhhaq6ngl8trjtsba8ke7ppp3','::1',1573878142,'__ci_last_regenerate|i:1573877925;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('eeefoqi123k7ettocuko915pp90mbdge','::1',1575224441,'__ci_last_regenerate|i:1575224317;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:20:\"Pembayaran SPP Kelas\";'),('ehnor2jsc5p9t0r4mhkmipp6jkr1usf4','::1',1574957731,'__ci_last_regenerate|i:1574957560;__ci_vars|a:23:{s:3:\"nis\";s:3:\"old\";s:4:\"nisn\";s:3:\"old\";s:12:\"nama_lengkap\";s:3:\"old\";s:12:\"tempat_lahir\";s:3:\"old\";s:13:\"tanggal_lahir\";s:3:\"old\";s:7:\"anak_ke\";s:3:\"old\";s:20:\"alamat_peserta_didik\";s:3:\"old\";s:10:\"telp_rumah\";s:3:\"old\";s:12:\"sekolah_asal\";s:3:\"old\";s:16:\"tanggal_diterima\";s:3:\"old\";s:8:\"di_kelas\";s:3:\"old\";s:9:\"nama_ayah\";s:3:\"old\";s:8:\"nama_ibu\";s:3:\"old\";s:16:\"alamat_orang_tua\";s:3:\"old\";s:14:\"telp_orang_tua\";s:3:\"old\";s:14:\"pekerjaan_ayah\";s:3:\"old\";s:13:\"pekerjaan_ibu\";s:3:\"old\";s:9:\"nama_wali\";s:3:\"old\";s:9:\"telp_wali\";s:3:\"old\";s:11:\"alamat_wali\";s:3:\"old\";s:14:\"pekerjaan_wali\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;nis|s:3:\"199\";nisn|s:3:\"199\";nama_lengkap|s:3:\"jkh\";tempat_lahir|s:4:\"jhkj\";tanggal_lahir|s:10:\"1111-11-11\";anak_ke|s:1:\"1\";alamat_peserta_didik|s:4:\"kjhj\";telp_rumah|s:2:\"11\";sekolah_asal|s:5:\"jkhjk\";tanggal_diterima|s:10:\"1111-11-11\";di_kelas|s:1:\"j\";nama_ayah|s:2:\"kk\";nama_ibu|s:3:\"jkh\";alamat_orang_tua|s:3:\"kjh\";telp_orang_tua|s:2:\"11\";pekerjaan_ayah|s:4:\"jkhk\";pekerjaan_ibu|s:3:\"jhj\";nama_wali|s:2:\"jk\";telp_wali|s:2:\"11\";alamat_wali|s:4:\"jhjk\";pekerjaan_wali|s:5:\"jkhjk\";pesan|s:352:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:10:\"Data Siswa\";'),('em4tcrduujusf7r63tttknq22erjde23','::1',1575367865,'__ci_last_regenerate|i:1575367570;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;'),('erf69p0tf5j2t0kr41d60rnrm6ttl2so','::1',1575349237,'__ci_last_regenerate|i:1575349237;system_value|s:32:\"c527fc8702eb81ac0e54a3f51c917e21\";title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('eso7atdb1mbveq8ivt1rokbnpaql57ek','::1',1575219417,'__ci_last_regenerate|i:1575219131;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('f9ur6h24p99np3nt83ej7a6gf47celp7','::1',1575222168,'__ci_last_regenerate|i:1575221946;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:14:\"Pembayaran SPP\";'),('fc94nlfjc07g8shra0u9768ha79sl15q','::1',1574072089,'__ci_last_regenerate|i:1574071824;__ci_vars|a:5:{s:7:\"id_guru\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"old\";s:10:\"id_jurusan\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";search_box|N;id_guru|s:1:\"1\";id_kelas|s:1:\"1\";id_jurusan|s:1:\"1\";pesan|s:293:\"<div class=\"alert alert-danger\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa \"></i> </strong>\r\n                            <a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:3:\"Add\";'),('feh0mp9r8kkmngmr7aij27u69lp58m5k','::1',1574901660,'__ci_last_regenerate|i:1574901630;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";title|s:23:\"Master Jadwal Pelajaran\";search_box|N;'),('feh172buvahd61ub6phqqr6igliouqvm','::1',1573900922,'__ci_last_regenerate|i:1573900646;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"old\";}title|s:4:\"Edit\";search_box|s:3:\"700\";'),('fip0q40l8sllk3d0v2bolle1jtlef178','::1',1575228090,'__ci_last_regenerate|i:1575227834;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:19:\"Bimbingan Konseling\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('fq7oo6lnkjbpcu3ucgpi8fle8fcpcrcd','::1',1573901573,'__ci_last_regenerate|i:1573901329;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:3:\"Add\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;'),('frh97pnt9aod1uuu6b6bqin7esd76kaj','::1',1574729950,'__ci_last_regenerate|i:1574729650;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;title|s:4:\"Edit\";'),('g790mv3dkoo7sq14iidv0137kvvrpeqn','::1',1575371355,'__ci_last_regenerate|i:1575371166;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:3:\"Add\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('gk1mcna2dm8i6jfp1dkfehrpb78lmp09','::1',1574731025,'__ci_last_regenerate|i:1574730807;__ci_vars|a:8:{s:8:\"id_kelas\";s:3:\"old\";s:8:\"id_mapel\";s:3:\"old\";s:7:\"id_guru\";s:3:\"old\";s:11:\"nilai_siswa\";s:3:\"old\";s:14:\"id_siswa_kelas\";s:3:\"old\";s:15:\"id_tahun_ajaran\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;id_kelas|s:1:\"3\";id_mapel|s:1:\"6\";id_guru|s:1:\"2\";nilai_siswa|s:3:\"801\";id_siswa_kelas|s:1:\"3\";id_tahun_ajaran|s:1:\"2\";pesan|s:354:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil diperbarui.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:11:\"Nilai Siswa\";'),('glodjh7o2kal2tqq8e2rrputn3b0je0v','::1',1575363902,'__ci_last_regenerate|i:1575363686;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"09434f07142a96fafe3145a4335a2bfc\";title|s:11:\"Nilai Siswa\";search_box|N;'),('gm2jpff0k5rss1jsplt2nsvp6v2528nf','::1',1575555947,'__ci_last_regenerate|i:1575555860;system_value|s:32:\"730540e22fef95b555714db562c4c494\";username|s:4:\"beye\";__ci_vars|a:2:{s:8:\"username\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}title|s:19:\"Panel Administrator\";'),('gq5bi27pscpu20n8jal4is5g7oknhrd0','::1',1574731477,'__ci_last_regenerate|i:1574731412;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:19:\"Panel Administrator\";search_box|N;'),('guvvqgj6rs5b55328g7mqk9jf82m5s8c','::1',1575368550,'__ci_last_regenerate|i:1575368271;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('h0tu47fguap60vtc525c1a6geavtuioo','::1',1574957154,'__ci_last_regenerate|i:1574956944;__ci_vars|a:23:{s:5:\"title\";s:3:\"old\";s:3:\"nis\";s:3:\"new\";s:4:\"nisn\";s:3:\"new\";s:12:\"nama_lengkap\";s:3:\"new\";s:12:\"tempat_lahir\";s:3:\"new\";s:13:\"tanggal_lahir\";s:3:\"new\";s:7:\"anak_ke\";s:3:\"new\";s:20:\"alamat_peserta_didik\";s:3:\"new\";s:10:\"telp_rumah\";s:3:\"new\";s:12:\"sekolah_asal\";s:3:\"new\";s:16:\"tanggal_diterima\";s:3:\"new\";s:8:\"di_kelas\";s:3:\"new\";s:9:\"nama_ayah\";s:3:\"new\";s:8:\"nama_ibu\";s:3:\"new\";s:16:\"alamat_orang_tua\";s:3:\"new\";s:14:\"telp_orang_tua\";s:3:\"new\";s:14:\"pekerjaan_ayah\";s:3:\"new\";s:13:\"pekerjaan_ibu\";s:3:\"new\";s:9:\"nama_wali\";s:3:\"new\";s:9:\"telp_wali\";s:3:\"new\";s:11:\"alamat_wali\";s:3:\"new\";s:14:\"pekerjaan_wali\";s:3:\"new\";s:5:\"pesan\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:3:\"Add\";nis|s:3:\"777\";nisn|s:4:\"7777\";nama_lengkap|s:4:\"ryan\";tempat_lahir|s:6:\"langsa\";tanggal_lahir|s:10:\"2019-11-06\";anak_ke|s:1:\"1\";alamat_peserta_didik|s:2:\"aa\";telp_rumah|s:2:\"11\";sekolah_asal|s:2:\"aa\";tanggal_diterima|s:10:\"2019-11-14\";di_kelas|s:1:\"X\";nama_ayah|s:1:\"a\";nama_ibu|s:1:\"a\";alamat_orang_tua|s:1:\"a\";telp_orang_tua|s:1:\"1\";pekerjaan_ayah|s:1:\"a\";pekerjaan_ibu|s:1:\"a\";nama_wali|s:1:\"a\";telp_wali|s:1:\"1\";alamat_wali|s:1:\"a\";pekerjaan_wali|s:1:\"a\";pesan|s:352:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";'),('h1l9ua6llv5rukpvdk0pi95bnfl6hqku','::1',1573876047,'__ci_last_regenerate|i:1573875750;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:3:\"Add\";'),('h25hmqfpl21tj9sdbtjk4qvam773mrbi','::1',1575225766,'__ci_last_regenerate|i:1575225510;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:20:\"Pembayaran SPP Kelas\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('h4gj86ms7iqsuinsq9o0aushn38qevv9','::1',1574134628,'__ci_last_regenerate|i:1574134462;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"2fbf0343dd2bcf61ab83f624ba19cd7b\";title|s:15:\"Data Bahan Ajar\";search_box|N;'),('h8jl6s3mk5hopujn8tdhnj17fr61al5a','::1',1574950107,'__ci_last_regenerate|i:1574949839;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:25:\"Data Mata Pelajaran Kelas\";'),('htpfsvahursnnljv7qclf7j0cifei6ik','::1',1573895533,'__ci_last_regenerate|i:1573895355;__ci_vars|a:2:{s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;pesan|s:351:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil dihapus.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:23:\"Master Jadwal Pelajaran\";'),('i53o7f4qb24frgqr6t585ub05s3botr7','::1',1575369300,'__ci_last_regenerate|i:1575369261;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('i64hvirfn84tm87ev66vrioe5u0m8t15','::1',1575362351,'__ci_last_regenerate|i:1575362120;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('i80o9c1hfrlseacigmcalnu1p34uf119','::1',1574741446,'__ci_last_regenerate|i:1574741445;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";search_box|N;title|s:19:\"Panel Administrator\";'),('i8tsua6bc52n2ifnkjqdj5ns3etlgpme','::1',1574949762,'__ci_last_regenerate|i:1574949536;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:25:\"Data Mata Pelajaran Kelas\";'),('id5rl244ndiqcvl7uaoah7mn5t137qse','::1',1575365591,'__ci_last_regenerate|i:1575365402;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('ihdqpn608p5e8a5sohagc64bpiqlrdmm','::1',1575216832,'__ci_last_regenerate|i:1575216819;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:14:\"Pembayaran SPP\";'),('ii0avl9nlcknu1co0f85v83lim4543ot','::1',1574729267,'__ci_last_regenerate|i:1574729035;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;title|s:4:\"Edit\";'),('ij6mhr81sm4o2u2m1le6i9t1e8cbddab','::1',1574667147,'__ci_last_regenerate|i:1574666877;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:4:\"Edit\";'),('iqojqe2h1aiv26p7j37l8r87g60sdvae','::1',1574666476,'__ci_last_regenerate|i:1574666188;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:3:\"Add\";'),('j0dvlu0og7pt6s3ol2pof2o7d9o8g5nr','::1',1574393683,'__ci_last_regenerate|i:1574393623;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}system_value|s:32:\"87ce971afa381df44061818087801bdc\";title|s:15:\"Data Bahan Ajar\";search_box|s:4:\"7656\";'),('j0t0nql12sda130keeodfuvig5u9s48n','::1',1573903777,'__ci_last_regenerate|i:1573903680;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;title|s:9:\"Data Guru\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('j2ckk7onl2d4p4mu067v0mjs87afo8pd','::1',1575373617,'__ci_last_regenerate|i:1575373414;tgl_izin|N;alasan|N;search_box|N;system_value|s:32:\"48bd231b13ba0eabcd0d659a25b4f3e0\";title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('j4o49598ua3r57o4a4stu8408bfr37m2','::1',1573899885,'__ci_last_regenerate|i:1573899879;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"old\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:4:\"Edit\";search_box|s:3:\"700\";'),('j5n2ppr9gb8qjad94k19lm38hajepih1','::1',1574951612,'__ci_last_regenerate|i:1574951382;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:11:\"Nilai Siswa\";'),('j9n6d15jgsvugasd6qguh49m5riamnoa','::1',1574684265,'__ci_last_regenerate|i:1574684129;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:19:\"Master Tahun Ajaran\";'),('ja4rfi9jjto6d247kfdjhs2g69dnbcri','::1',1574676071,'__ci_last_regenerate|i:1574675852;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;title|s:10:\"Master Jam\";'),('jefuv4idduhjg4cpec2b9r3b0ss56nt2','::1',1575556814,'__ci_last_regenerate|i:1575556814;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"98a54f1dfc956e319f79f19cef4f0002\";title|s:19:\"Panel Administrator\";search_box|N;'),('jk4qfpheaoa1r24gfuca1lp8dsodd8l2','::1',1573898591,'__ci_last_regenerate|i:1573898414;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|s:3:\"111\";title|s:9:\"Data guru\";'),('jlrj9q7jkmgvg2thu5fok3bjtprmtlb3','::1',1573903278,'__ci_last_regenerate|i:1573903056;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;title|s:9:\"Data Guru\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('jrtskrl5q5tu1et3lpsmp3dipk5os9eo','::1',1575360493,'__ci_last_regenerate|i:1575360368;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:11:\"Kartu Ujian\";'),('k54peeo5o1g6f3rvsjsgjk9a1h7ki6q4','::1',1574044705,'__ci_last_regenerate|i:1574044414;system_value|s:32:\"b6f05f68dc3ae962e40d291023647201\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;title|s:3:\"Add\";'),('kvtef4hlrasnt3io1q6hm232o1euj565','::1',1575363221,'__ci_last_regenerate|i:1575363221;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('l0bga0p86igoc1237qpg7o6dsifhv13k','::1',1573897836,'__ci_last_regenerate|i:1573897543;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:3:\"Add\";search_box|N;'),('l488j2sr4c4re5gc2ht0t47kgvescjjk','36.68.55.173',1575560150,'__ci_last_regenerate|i:1575559905;system_value|s:32:\"0dbd171a3689588d0536c35ce5a349f1\";title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('las4t3fh7a624tdu9olt1p8o6tkbsull','::1',1575228726,'__ci_last_regenerate|i:1575228549;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:16:\"Legalisir Ijazah\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('ldk16stmniei8jug2kh8gtqt15c4m2a4','::1',1574722089,'__ci_last_regenerate|i:1574721936;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:3:\"Add\";search_box|N;'),('lfeprr40ff5hgio1cjv6q0ajvba29331','::1',1575373054,'__ci_last_regenerate|i:1575372760;tgl_izin|N;alasan|N;search_box|N;system_value|s:32:\"48bd231b13ba0eabcd0d659a25b4f3e0\";title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('llqnnrqpkud5gthqa2e3u8hnpth17c02','::1',1575362026,'__ci_last_regenerate|i:1575361755;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('lnqohduhh2cco4pbe4muie4ih9cv385s','::1',1574727947,'__ci_last_regenerate|i:1574727938;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:11:\"Nilai Siswa\";search_box|N;'),('lqmje57kn4uudn0ve93ud61m5ls100gk','::1',1575365249,'__ci_last_regenerate|i:1575365027;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('m32n238ell3263g76pkte4rolinfu7d4','::1',1574727430,'__ci_last_regenerate|i:1574727197;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:3:\"Add\";search_box|N;'),('m4ucbustuljcd41is9069v1pofnqqovo','::1',1575556701,'__ci_last_regenerate|i:1575556549;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"46c7076851e5f3afc08de91ad5620b94\";title|s:19:\"Panel Administrator\";'),('m67crhs0bi2rt62r5u5qtcuv2oj78nc2','::1',1574442303,'__ci_last_regenerate|i:1574442241;system_value|s:32:\"7e8ce087eb557428b4211c0bee8d849d\";search_box|N;title|s:3:\"Add\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('m9d16l9roprmrhba1t4on0t2h3j3osqp','::1',1575218028,'__ci_last_regenerate|i:1575217745;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('mgp9f1spnoogl989dvq1km9s3msl6nir','::1',1575215353,'__ci_last_regenerate|i:1575215090;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('mkhj6pe69rb0he6p6l5nnng6ndnpqvsf','::1',1574956130,'__ci_last_regenerate|i:1574956086;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:10:\"Data Siswa\";'),('n183vb3oe170giu1lmfapvjpdah43du2','::1',1575219111,'__ci_last_regenerate|i:1575218816;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('n9co73tmqv0vmhlq24alf7efkevj60df','::1',1574395333,'__ci_last_regenerate|i:1574395330;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"87ce971afa381df44061818087801bdc\";title|s:10:\"Master Jam\";'),('ne70kq886oi2t26j66r2i9srltu1ut6u','::1',1573898059,'__ci_last_regenerate|i:1573897865;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;title|s:3:\"Add\";'),('nit1jp5kacts5euo6oqvidtcqg9ns8oe','::1',1574951246,'__ci_last_regenerate|i:1574950970;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:11:\"Nilai Siswa\";'),('o3br1e1m4n8dj7r238bqqu6e2dc1e5q4','::1',1574073273,'__ci_last_regenerate|i:1574072976;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";search_box|N;title|s:4:\"Edit\";'),('o6rvn9csl17ur4gdkcpblft8hmnmuqid','::1',1574675030,'__ci_last_regenerate|i:1574674777;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";__ci_vars|a:7:{s:4:\"hari\";s:3:\"old\";s:6:\"id_jam\";s:3:\"old\";s:8:\"id_kelas\";s:3:\"old\";s:14:\"id_mapel_kelas\";s:3:\"old\";s:10:\"tanda_guru\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}search_box|N;hari|s:5:\"Senin\";id_jam|s:1:\"1\";id_kelas|s:1:\"5\";id_mapel_kelas|s:1:\"2\";tanda_guru|s:1:\"2\";pesan|s:415:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"http://localhost/sisfosekolah/master-jadwal-pelajaran/edit/\" class=\"confirm-edit\"><u>Edit</u></a>\r\n                        </div>\";title|s:23:\"Master Jadwal Pelajaran\";'),('obfo347rrtc4va5sl7m0202uclmk7277','::1',1574044414,'__ci_last_regenerate|i:1574044412;'),('oblj6e11p0kiqbir4b8tr2mfvvh6d11v','::1',1574684582,'__ci_last_regenerate|i:1574684444;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:23:\"Master Jadwal Pelajaran\";'),('ochm5j5n0gmdfgmcogj7tjmchre60gm9','::1',1574664763,'__ci_last_regenerate|i:1574664480;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;title|s:12:\" Siswa_kelas\";'),('odkqlsb28jqc7u0cecllmf06f7s9sotp','::1',1574949081,'__ci_last_regenerate|i:1574948843;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:25:\"Data Mata Pelajaran Kelas\";'),('ogdp2hplbt2ed2oe954fvvej6qlgtp14','::1',1574728748,'__ci_last_regenerate|i:1574728658;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;title|s:4:\"Edit\";'),('okj7441qqe5m0ssn1tl8nnsg53gfgmnv','36.68.55.173',1575559142,'__ci_last_regenerate|i:1575559131;'),('oko8fj2o5jbabtubfg887c0m5m1djhm2','::1',1575372405,'__ci_last_regenerate|i:1575372111;tgl_izin|N;alasan|N;search_box|N;system_value|s:32:\"48bd231b13ba0eabcd0d659a25b4f3e0\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:11:\"Kartu Ujian\";'),('onakfgd515jsa7cfe9e1uuuac3uodken','::1',1573901876,'__ci_last_regenerate|i:1573901634;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;title|s:9:\"Data Guru\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('onqqqnlfqt7g3nc3p9dgdii3tcapqiqh','::1',1574742481,'__ci_last_regenerate|i:1574742181;system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";title|s:11:\"Nilai Siswa\";__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}search_box|s:3:\"X 2\";'),('orq1pg6ed8jebunaufvo8n7vosi92sfo','::1',1574742849,'__ci_last_regenerate|i:1574742559;system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";title|s:23:\"Master Jadwal Pelajaran\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;'),('otpbres1ao5tnk61i3mjd34prfvb13pf','::1',1575217475,'__ci_last_regenerate|i:1575217444;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:3:\"Add\";'),('p7plvn2j7uk24l3ve993shqcb8gggor3','::1',1573901303,'__ci_last_regenerate|i:1573901026;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}title|s:9:\"Data guru\";search_box|s:3:\"700\";'),('p8g8jg7thl6bka1l5birtgjgjdvbmuag','::1',1574666800,'__ci_last_regenerate|i:1574666501;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:3:\"Add\";'),('pc56l3b54mf4dft9eq7s6tmgk2bh75jt','::1',1574674572,'__ci_last_regenerate|i:1574674278;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";title|s:12:\" Siswa_kelas\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('pcihl2h8qicpqde0kuvi4414oeevnbvm','::1',1575216032,'__ci_last_regenerate|i:1575215866;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:16:\"Legalisir Ijazah\";'),('pe83ftdnh5nop6hiibkoga5k4m3m6n5c','::1',1574741594,'__ci_last_regenerate|i:1574741446;system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:19:\"Panel Administrator\";'),('ph6006j0i4aqas0ddeuqiioflj7hcbp2','::1',1575226083,'__ci_last_regenerate|i:1575225841;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;'),('pl9a4r1slerm4c7b1naiq6j4un0r65so','::1',1574071488,'__ci_last_regenerate|i:1574071478;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"cb7b5ec2e94a6b2066a48a6799a3799c\";title|s:3:\"Add\";search_box|N;'),('pohlnbhdcjkgrt6qn58s38ba9i4f7abf','::1',1575222821,'__ci_last_regenerate|i:1575222525;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:10:\"White List\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;'),('pojr96cvi3t9h52kvk859mc10asrtf5h','::1',1574953516,'__ci_last_regenerate|i:1574953317;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('pojrj1gqv096obh243c2dr8er1po1kbr','::1',1575540665,'__ci_last_regenerate|i:1575540607;system_value|s:32:\"a9de00c05c31ba14ce146cb2aab3bc44\";title|s:6:\"Module\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;'),('ppv2n04f4qn1a8taa0c0mcnba2fug9hv','::1',1574048470,'__ci_last_regenerate|i:1574048464;system_value|s:32:\"b6f05f68dc3ae962e40d291023647201\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;title|s:6:\"Module\";'),('pqho3rhpbis3p9t4ee2psh9m28cj40oj','::1',1574731406,'__ci_last_regenerate|i:1574731110;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|s:3:\"ipa\";title|s:21:\"Data Jadwal Pelajaran\";'),('q29blf2ih2gsrojg1tf707odehoheedu','::1',1574956072,'__ci_last_regenerate|i:1574955781;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:10:\"Data Siswa\";'),('qbmcg989vgqkahc0c1scqnv20ikg6q3a','::1',1574134876,'__ci_last_regenerate|i:1574134876;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"2fbf0343dd2bcf61ab83f624ba19cd7b\";title|s:10:\"Data Siswa\";search_box|N;'),('qoi5esc55urng3ibmh7a3621mvt0bo2n','::1',1574902272,'__ci_last_regenerate|i:1574902045;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"da9ca6e852be54d55c22a2fb65199225\";title|s:21:\"Data Jadwal Pelajaran\";search_box|N;'),('qpk25mgrq5vpjprvunq1ac58eobvjcq2','::1',1575218360,'__ci_last_regenerate|i:1575218061;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('r7fllhlfg6lj7feu8abaetbjd7ahgfp1','::1',1575367135,'__ci_last_regenerate|i:1575367078;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;'),('rbdpet173ksuo4nsmmd939lrdqfdql6u','::1',1574739753,'__ci_last_regenerate|i:1574739752;'),('rhrojhmsc5lh8mh0oj8e51diic329bms','::1',1573877400,'__ci_last_regenerate|i:1573877370;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"d056a8c47ab1ca76b604971b5a62091a\";search_box|N;title|s:23:\"Master Jadwal Pelajaran\";'),('rk03tj5r26f9q2vgfdsidqsfl95eqs6s','::1',1574435388,'__ci_last_regenerate|i:1574435130;system_value|s:32:\"7e8ce087eb557428b4211c0bee8d849d\";search_box|N;title|s:19:\"Panel Administrator\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('rmea747sd15uvcvfq0q9ifo3fpf3jppd','::1',1575362722,'__ci_last_regenerate|i:1575362424;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('routdtrqeolpbntc92314lesndqbf3nh','::1',1575373399,'__ci_last_regenerate|i:1575373109;tgl_izin|N;alasan|N;search_box|N;system_value|s:32:\"48bd231b13ba0eabcd0d659a25b4f3e0\";title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('rv4gnoobjlaniidp4sm2boilqf01ktjo','::1',1575555501,'__ci_last_regenerate|i:1575555501;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"98a54f1dfc956e319f79f19cef4f0002\";title|s:8:\"Instansi\";search_box|N;'),('s1gb4mbnok2v15msb561p015fmeqv5if','::1',1574610416,'__ci_last_regenerate|i:1574610416;'),('s7q293fn94ke0btpj03fh1ir28fdfh39','::1',1574949271,'__ci_last_regenerate|i:1574949190;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:25:\"Data Mata Pelajaran Kelas\";'),('sfql2nrqm6iiaedf3ke0u6ene98v06ob','::1',1574393061,'__ci_last_regenerate|i:1574392836;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}system_value|s:32:\"87ce971afa381df44061818087801bdc\";title|s:15:\"Data Bahan Ajar\";search_box|s:2:\"11\";'),('ss01i9mpno3loaa0ho3hm0irlivl1dga','::1',1573899156,'__ci_last_regenerate|i:1573898873;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"old\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|s:3:\"700\";title|s:4:\"Edit\";'),('stchi0ruup193p9fc4a1us3ra01ef1ia','::1',1574720878,'__ci_last_regenerate|i:1574720676;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";title|s:11:\"Nilai Siswa\";search_box|N;'),('t07mn9eg5gg5cp52ojm9t0r6291mftr8','36.68.53.147',1575560401,'__ci_last_regenerate|i:1575560314;system_value|s:32:\"28af50cea05160608ed880f3836f3759\";title|s:19:\"Bimbingan Konseling\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;'),('t4ilvml7v7lpfom2qceveu7makad6a6n','::1',1575556141,'__ci_last_regenerate|i:1575556111;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"98a54f1dfc956e319f79f19cef4f0002\";title|s:19:\"Panel Administrator\";search_box|N;'),('tcaafr3hetqjndbjjcggalfra2m7plfs','::1',1574399040,'__ci_last_regenerate|i:1574398740;system_value|s:32:\"87ce971afa381df44061818087801bdc\";search_box|N;title|s:11:\"Nilai Siswa\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('tg25e9uegvrbegr67sero4c5h7ijg0vv','::1',1574955590,'__ci_last_regenerate|i:1574955451;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;title|s:10:\"Data Siswa\";'),('tsq02dv9r0p9s0l9r2l28otpolqkp1j5','::1',1575370185,'__ci_last_regenerate|i:1575369891;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('u5dsufva80abr839osfrh8gu0voqcm0j','::1',1573899877,'__ci_last_regenerate|i:1573899578;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";title|s:9:\"Data Guru\";search_box|N;'),('u837n3pij2iru9a6vb7o1n4ospnuou4r','::1',1575364581,'__ci_last_regenerate|i:1575364318;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}title|s:11:\"Kartu Ujian\";'),('u9tdpgtu22t5jhilduggd1issh01fafm','::1',1574668275,'__ci_last_regenerate|i:1574668267;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";search_box|N;__ci_vars|a:5:{s:8:\"id_kelas\";s:3:\"old\";s:8:\"id_siswa\";s:3:\"old\";s:15:\"id_tahun_ajaran\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}id_kelas|s:1:\"1\";id_siswa|s:1:\"2\";id_tahun_ajaran|s:1:\"1\";pesan|s:354:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil diperbarui.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:12:\" Siswa_kelas\";'),('uiq9q389qqjq5hgvopnqu5u7cfshm7ih','::1',1574743026,'__ci_last_regenerate|i:1574742868;system_value|s:32:\"8e86b10cb46655f7efcc7a872e926a9d\";title|s:21:\"Data Jadwal Pelajaran\";__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}search_box|s:3:\"asd\";'),('ulqnkavtuk4vso5p2hab1tublgdkioh1','::1',1575370457,'__ci_last_regenerate|i:1575370209;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('v12q23m8g4n0g79t0f2oi94gs3kif79s','::1',1575362746,'__ci_last_regenerate|i:1575362746;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:4:\"Edit\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('v3c8ujd6gn7ksig9qig31r7r1nbptd45','::1',1574957469,'__ci_last_regenerate|i:1574957259;__ci_vars|a:23:{s:3:\"nis\";s:3:\"old\";s:4:\"nisn\";s:3:\"old\";s:12:\"nama_lengkap\";s:3:\"old\";s:12:\"tempat_lahir\";s:3:\"old\";s:13:\"tanggal_lahir\";s:3:\"old\";s:7:\"anak_ke\";s:3:\"old\";s:20:\"alamat_peserta_didik\";s:3:\"old\";s:10:\"telp_rumah\";s:3:\"old\";s:12:\"sekolah_asal\";s:3:\"old\";s:16:\"tanggal_diterima\";s:3:\"old\";s:8:\"di_kelas\";s:3:\"old\";s:9:\"nama_ayah\";s:3:\"old\";s:8:\"nama_ibu\";s:3:\"old\";s:16:\"alamat_orang_tua\";s:3:\"old\";s:14:\"telp_orang_tua\";s:3:\"old\";s:14:\"pekerjaan_ayah\";s:3:\"old\";s:13:\"pekerjaan_ibu\";s:3:\"old\";s:9:\"nama_wali\";s:3:\"old\";s:9:\"telp_wali\";s:3:\"old\";s:11:\"alamat_wali\";s:3:\"old\";s:14:\"pekerjaan_wali\";s:3:\"old\";s:5:\"pesan\";s:3:\"old\";s:5:\"title\";s:3:\"new\";}system_value|s:32:\"adc232eb1bb0f520370d8bae6c01683f\";search_box|N;nis|s:3:\"100\";nisn|s:3:\"100\";nama_lengkap|s:1:\"s\";tempat_lahir|s:1:\"s\";tanggal_lahir|s:10:\"1010-01-01\";anak_ke|s:1:\"1\";alamat_peserta_didik|s:1:\"a\";telp_rumah|s:0:\"\";sekolah_asal|s:1:\"a\";tanggal_diterima|s:10:\"1010-01-01\";di_kelas|s:1:\"a\";nama_ayah|s:1:\"q\";nama_ibu|s:1:\"q\";alamat_orang_tua|s:1:\"q\";telp_orang_tua|s:1:\"1\";pekerjaan_ayah|s:1:\"q\";pekerjaan_ibu|s:1:\"q\";nama_wali|s:1:\"q\";telp_wali|s:1:\"1\";alamat_wali|s:1:\"q\";pekerjaan_wali|s:1:\"q\";pesan|s:352:\"<div class=\"alert alert-success\">\r\n                            <button class=\"close\" data-dismiss=\"alert\">&times;</button>\r\n                            <strong><i class=\"fa fa-check-square-o\"></i> <b>Informasi: </b></strong>\r\n                            Data Berhasil disimpan.<a href=\"\" class=\"confirm-edit\"><u></u></a>\r\n                        </div>\";title|s:10:\"Data Siswa\";'),('v817h5u84hsobnpgg3qc5h8a86fa6jmi','::1',1574677959,'__ci_last_regenerate|i:1574677793;system_value|s:32:\"d2cf9693852e2359104014d54c814183\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}search_box|N;title|s:12:\" Siswa_kelas\";'),('vl880571gat8tag9pjdjnaskif32s4qu','::1',1573902692,'__ci_last_regenerate|i:1573902410;system_value|s:32:\"e89982645670b058ae1313ddc3f230e5\";search_box|N;title|s:9:\"Data Guru\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('vmobmar4mpphi843ffm6icnupmchkhli','::1',1575228462,'__ci_last_regenerate|i:1575228162;system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";search_box|N;title|s:16:\"Legalisir Ijazah\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}'),('vmtvfmoc8jurbtqpdur90b0tfrgff32c','::1',1574393613,'__ci_last_regenerate|i:1574393316;__ci_vars|a:2:{s:5:\"title\";s:3:\"new\";s:10:\"search_box\";s:3:\"new\";}system_value|s:32:\"87ce971afa381df44061818087801bdc\";title|s:15:\"Data Bahan Ajar\";search_box|s:4:\"7565\";'),('vshlmegc90ut65095oid2g1knas81up2','::1',1575220058,'__ci_last_regenerate|i:1575219760;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"a42301152c30a7e718345b70ffc32534\";title|s:4:\"Edit\";'),('vt8h2ft0o8pruot9as7btthpftpvlj4s','::1',1574729614,'__ci_last_regenerate|i:1574729339;__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}system_value|s:32:\"166c2b404bf8b4b1c5d52f0c6d68805b\";search_box|N;title|s:4:\"Edit\";'),('vvi0ovuh04cfijn5pegbqqbgtbfdl36o','::1',1575367003,'__ci_last_regenerate|i:1575366703;system_value|s:32:\"e425277f53c230594e64bf01164aeb54\";tgl_izin|N;alasan|N;search_box|N;title|s:11:\"Kartu Ujian\";__ci_vars|a:1:{s:5:\"title\";s:3:\"new\";}');

/*Table structure for table `content` */

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id_content` int(11) NOT NULL,
  `title` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `type_data` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_modified` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id_content`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `content` */

/*Table structure for table `content_statistik` */

DROP TABLE IF EXISTS `content_statistik`;

CREATE TABLE `content_statistik` (
  `id_read` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `ip` text NOT NULL,
  `id_content` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `from_tabel` text NOT NULL,
  PRIMARY KEY (`id_read`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `content_statistik` */

/*Table structure for table `generator_pass` */

DROP TABLE IF EXISTS `generator_pass`;

CREATE TABLE `generator_pass` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `value` text NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `generator_pass` */

insert  into `generator_pass`(`id`,`id_user`,`value`,`created_date`) values (1,2,'f497d5f1c2759752e1c28dfc64acb893e7ad5b1ea5df6f9e8dec1e2aa4c8c1e1327b9ed1eec681899d194294e2145ea3d62c353edbdad92cd5109e018d02e823aLdRpLh8EnTDlQvyc+m5wkZ2895yaj8d0toQtqokceM=','2019-07-15 16:15:45'),(2,3,'1eea51936fb61439a044868a7994ccc02a8ccc648b42258739e4fbb992ba02c541191dffa5d11eadac8d223efda0ef1c0739502052dc8cfc258541b463df20cb77IVVY3mG65owfKAvJzsRdf5auPl+D4ljm7A4wfrJw0=','2019-08-13 22:56:59'),(3,4,'125fa6fb79ddcd77ef5bbe99c835b7fa5ef4ae498a81c2ce76697c7ebb06d8a3c4679fb42778996773aa6ab5dd2d475fe3df2a1cb3f9b35cda4557f98dd40bb7QFNqKV2HbiLeSMvlsxLZ3oAfJHtzAbhoXJhf04roaB4=','2019-09-04 19:25:38');

/*Table structure for table `hubungi_kami` */

DROP TABLE IF EXISTS `hubungi_kami`;

CREATE TABLE `hubungi_kami` (
  `id_contact` int(11) NOT NULL,
  `title` text NOT NULL,
  `title_footer` text NOT NULL,
  `display_header` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `telp` text NOT NULL,
  `fax` text NOT NULL,
  `keterangan` text NOT NULL,
  `keyword` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `hubungi_kami` */

insert  into `hubungi_kami`(`id_contact`,`title`,`title_footer`,`display_header`,`email`,`alamat`,`telp`,`fax`,`keterangan`,`keyword`,`created_date`,`created_by`) values (1,'PTSP','PTSP','Administrator','PTSP@mail.com','-','-','-','PTSP','PTSP','2019-07-12 20:00:20',1);

/*Table structure for table `info_admin` */

DROP TABLE IF EXISTS `info_admin`;

CREATE TABLE `info_admin` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `pesan` text NOT NULL,
  `created_date` datetime NOT NULL,
  `no_urut` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `info_admin` */

insert  into `info_admin`(`id`,`title`,`pesan`,`created_date`,`no_urut`,`id_status`) values (1,'Layanan','TSB Logistik','2019-10-23 09:41:33',1,4);

/*Table structure for table `instansi` */

DROP TABLE IF EXISTS `instansi`;

CREATE TABLE `instansi` (
  `id_instansi` int(11) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `instansi` */

insert  into `instansi`(`id_instansi`,`nama_instansi`,`parent_id`,`order_no`) values (1,'Super Admin',0,0),(2,'TSB Logistik',0,2);

/*Table structure for table `izin_kepala_sekolah` */

DROP TABLE IF EXISTS `izin_kepala_sekolah`;

CREATE TABLE `izin_kepala_sekolah` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `asal` varchar(100) NOT NULL,
  `keperluan` text NOT NULL,
  `tgl_urusan` date NOT NULL,
  `jam_urusan` text NOT NULL,
  `status_izin` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `izin_kepala_sekolah` */

insert  into `izin_kepala_sekolah`(`id`,`nama`,`asal`,`keperluan`,`tgl_urusan`,`jam_urusan`,`status_izin`,`created_at`) values (3,'Rizky Efrian2','Jurusan TI2','Rapat Party2','2019-11-11','19:30',1,'2019-11-06 00:00:00'),(4,'Dia','Disana','Minta Piti','2019-11-09','03:01',1,'2019-11-26 20:50:11'),(5,'Rafki Mauliadi','Payakumbuh','Minta Piti','2019-11-30','02:34',1,'2019-11-26 21:13:59'),(6,'Coba','Coba','Coba','2019-11-01','19:04',0,'2019-11-26 21:32:24');

/*Table structure for table `izin_online` */

DROP TABLE IF EXISTS `izin_online`;

CREATE TABLE `izin_online` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `tgl_izin` date NOT NULL,
  `alasan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `izin_online` */

insert  into `izin_online`(`id`,`nis`,`tgl_izin`,`alasan`) values (1,'1010','2019-11-19','Sakit'),(2,'1010','2019-11-12','Sakits'),(4,'1011','2019-11-21','Sakit apa lu?\r\nentah mana gue tau'),(5,'1010','2019-11-20','Rafji');

/*Table structure for table `izin_tata_usaha` */

DROP TABLE IF EXISTS `izin_tata_usaha`;

CREATE TABLE `izin_tata_usaha` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `asal` varchar(100) NOT NULL,
  `keperluan` text NOT NULL,
  `tgl_urusan` date NOT NULL,
  `jam_urusan` text NOT NULL,
  `status_izin` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `izin_tata_usaha` */

insert  into `izin_tata_usaha`(`id`,`nama`,`asal`,`keperluan`,`tgl_urusan`,`jam_urusan`,`status_izin`,`created_at`) values (1,'Aku','padang','Caliak Mantan','2019-11-30','20:21',2,'2019-11-02 00:00:00'),(2,'Kamu','Padang Panjang','Mangaa yoooo','2019-11-21','19:09',1,'2019-11-21 00:00:00'),(3,'Test3','Test3','Test3','2019-11-08','20:10',1,'2019-11-26 23:44:45');

/*Table structure for table `jadwal_pelajaran` */

DROP TABLE IF EXISTS `jadwal_pelajaran`;

CREATE TABLE `jadwal_pelajaran` (
  `id` int(11) NOT NULL,
  `hari` varchar(25) NOT NULL,
  `id_jam` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel_kelas` int(11) NOT NULL,
  `tanda_guru` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal_pelajaran` */

insert  into `jadwal_pelajaran`(`id`,`hari`,`id_jam`,`id_kelas`,`id_mapel_kelas`,`tanda_guru`) values (18,'Rabu21',6,3,2,'Ada Guru'),(20,'Selasa',3,5,2,'Ada Guru'),(21,'Senin',6,5,2,'Ada Guru'),(23,'Senin',1,5,2,'Tidak Ada Guru');

/*Table structure for table `jam_pelajaran_kelas` */

DROP TABLE IF EXISTS `jam_pelajaran_kelas`;

CREATE TABLE `jam_pelajaran_kelas` (
  `id` int(11) NOT NULL,
  `hari` varchar(25) NOT NULL,
  `id_jam` int(11) NOT NULL,
  `id_mapel_kelas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jam_pelajaran_kelas` */

insert  into `jam_pelajaran_kelas`(`id`,`hari`,`id_jam`,`id_mapel_kelas`) values (1,'senin',1,2),(2,'selasa',3,2);

/*Table structure for table `legalisir_ijazah` */

DROP TABLE IF EXISTS `legalisir_ijazah`;

CREATE TABLE `legalisir_ijazah` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `no_ijazah` varchar(50) NOT NULL,
  `tahun_ijazah` int(4) NOT NULL,
  `tgl_masuk_legalisir` date NOT NULL,
  `tgl_selesai_legalisir` date NOT NULL,
  `status_legalisir` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `legalisir_ijazah` */

insert  into `legalisir_ijazah`(`id`,`nis`,`no_ijazah`,`tahun_ijazah`,`tgl_masuk_legalisir`,`tgl_selesai_legalisir`,`status_legalisir`) values (9,'1010','AB102010',2019,'2019-11-01','2019-11-02',2),(10,'1011','AC102011',2018,'2019-11-29','2019-11-30',1),(11,'1011','AC102011',2018,'2019-11-15','2019-11-21',1);

/*Table structure for table `master_absensi_guru` */

DROP TABLE IF EXISTS `master_absensi_guru`;

CREATE TABLE `master_absensi_guru` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `absen` enum('Hadir','Sakit','Tidak Hadir','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_absensi_guru` */

insert  into `master_absensi_guru`(`id`,`id_guru`,`absen`) values (4,1,'Hadir'),(5,3,'Hadir');

/*Table structure for table `master_bahan_ajar` */

DROP TABLE IF EXISTS `master_bahan_ajar`;

CREATE TABLE `master_bahan_ajar` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_bahan_ajar` */

/*Table structure for table `master_guru` */

DROP TABLE IF EXISTS `master_guru`;

CREATE TABLE `master_guru` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `gelar_depan` varchar(255) DEFAULT NULL,
  `gelar_belakang` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_gender` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `id_agama` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_status_pegawai` int(11) NOT NULL,
  `foto` text NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_modified` datetime NOT NULL,
  `id_status_guru` int(11) DEFAULT NULL,
  `status_guru` int(11) DEFAULT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tamat` varchar(50) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_guru` */

insert  into `master_guru`(`id`,`nama_lengkap`,`gelar_depan`,`gelar_belakang`,`nip`,`tempat_lahir`,`tanggal_lahir`,`id_gender`,`jenis_kelamin`,`id_agama`,`alamat`,`tanggal_masuk`,`id_jabatan`,`id_status_pegawai`,`foto`,`created_date`,`created_modified`,`id_status_guru`,`status_guru`,`pendidikan`,`jurusan`,`tamat`,`unit_kerja`) values (1,'kjh','jkh','jkh','11','kh','1010-01-01','1',NULL,1,'lkjl','1010-01-01',1,1,'a12.jpg','2019-11-18 09:38:58','2019-11-18 09:38:58',1,NULL,'jlk','lkj','111','lkjkj'),(2,'sadas','jg','jhgj','7656','jhgh','2019-09-03','1',NULL,1,'jgjh','2019-11-12',1,1,'a12.jpg','2019-11-18 09:38:58','2019-11-18 09:38:58',1,NULL,',mn1,mn','hj','11','asd'),(1,'Rio Bayu Sentosa','Dr.','M.Kom','20134','padang','1992-04-16',NULL,'1',1,'bahari','2019-09-13',1,2,'Koala.jpg','2019-09-13 10:57:06','2019-09-13 10:57:06',NULL,1,'S3','Komputer','1998','MAN 3 Padang'),(2,'Rafki Mauliadi','Dr.','M.Kom','101','Payakumbuh','1998-07-10',NULL,'1',1,'Payakumbuh','2019-06-05',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-31 11:49:26','2019-10-31 11:49:26',NULL,1,'S3','Sistem Informasi','2022','Universitas Andalas'),(3,'Nirmala Rahmi','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(4,'Rizky Rahmi','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(5,'Nirmala Rahmi2','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(6,'Nirmala Rahmi3','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(7,'Nirmala Rahmi4','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(8,'Nirmala Rahmi7','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(9,'Nirmala 2','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(10,'Nirmala 11','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom'),(11,'Nirmala 111','Dr.','M.Kom','10101','Padang Panjang','2019-10-22',NULL,'P',1,'Padang Panjang','2019-10-16',1,1,'RafkiMauliadi_MerahFix.jpg','2019-10-16 00:00:00','2019-10-29 00:00:00',NULL,1,'s1','Sistem Informasi','2021','Mkom');

/*Table structure for table `master_jabatan_guru` */

DROP TABLE IF EXISTS `master_jabatan_guru`;

CREATE TABLE `master_jabatan_guru` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_jabatan_guru` */

insert  into `master_jabatan_guru`(`id`,`nama_jabatan`,`created_at`) values (1,'Staf Guru Pengajar','2019-09-13 00:00:00');

/*Table structure for table `master_jam` */

DROP TABLE IF EXISTS `master_jam`;

CREATE TABLE `master_jam` (
  `id` int(11) NOT NULL,
  `jam` int(11) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_akhir` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_jam` */

insert  into `master_jam`(`id`,`jam`,`waktu_mulai`,`waktu_akhir`) values (1,1,'06:45:00','07:00:00'),(3,2,'07:00:00','07:45:00'),(4,3,'07:45:00','08:30:00'),(5,4,'08:30:00','09:15:00'),(6,5,'09:15:00','10:00:00'),(7,6,'10:00:00','10:20:00'),(8,7,'10:20:00','11:05:00'),(9,8,'11:05:00','11:50:00'),(10,9,'11:50:00','12:35:00'),(11,10,'12:35:00','13:00:00'),(12,11,'13:00:00','13:45:00'),(13,12,'13:45:00','14:30:00'),(14,13,'14:30:00','15:15:00'),(15,14,'15:15:00','16:00:00'),(16,15,'16:00:00','16:15:00'),(17,16,'16:15:00','17:00:00'),(18,17,'17:00:00','17:45:00');

/*Table structure for table `master_jurusan` */

DROP TABLE IF EXISTS `master_jurusan`;

CREATE TABLE `master_jurusan` (
  `id` int(11) NOT NULL,
  `nama_jurusan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_jurusan` */

insert  into `master_jurusan`(`id`,`nama_jurusan`,`created_at`) values (1,'IPA','2019-08-28 00:00:00'),(2,'IPS','2019-08-28 00:00:00');

/*Table structure for table `master_kelas` */

DROP TABLE IF EXISTS `master_kelas`;

CREATE TABLE `master_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_kelas` */

insert  into `master_kelas`(`id_kelas`,`nama_kelas`,`status`,`id_jurusan`,`created_at`) values (1,'X 1',1,2,'2019-08-28 22:31:31'),(3,'X 2',1,2,'2019-08-28 22:50:51'),(5,'asd',0,1,'2019-11-02 16:59:20'),(1,'X IPA 1',1,1,'2019-08-28 22:31:31'),(3,'X IPS 1',1,2,'2019-08-28 22:50:51'),(5,'XI IPA 1',1,1,'2019-10-31 20:57:39');

/*Table structure for table `master_kelompok_mapel` */

DROP TABLE IF EXISTS `master_kelompok_mapel`;

CREATE TABLE `master_kelompok_mapel` (
  `id` int(11) NOT NULL,
  `nama_kelompok` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_kelompok_mapel` */

insert  into `master_kelompok_mapel`(`id`,`nama_kelompok`,`created_at`) values (1,'Kelompok Wajib','2019-08-23 09:49:34'),(2,'Kelompok Peminatan','2019-08-23 09:49:50');

/*Table structure for table `master_kurikulum` */

DROP TABLE IF EXISTS `master_kurikulum`;

CREATE TABLE `master_kurikulum` (
  `id` int(11) NOT NULL,
  `nama_kurikulum` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_kurikulum` */

/*Table structure for table `master_mapel_kelas` */

DROP TABLE IF EXISTS `master_mapel_kelas`;

CREATE TABLE `master_mapel_kelas` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_mapel_kelas` */

insert  into `master_mapel_kelas`(`id`,`id_kelas`,`id_mata_pelajaran`,`id_guru`) values (2,3,6,2),(3,1,5,1),(4,1,5,2);

/*Table structure for table `master_mata_pelajaran` */

DROP TABLE IF EXISTS `master_mata_pelajaran`;

CREATE TABLE `master_mata_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `kode_mapel` varchar(255) DEFAULT NULL,
  `kelompok_mapel` int(255) DEFAULT NULL,
  `id_peminatan` int(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_mata_pelajaran` */

insert  into `master_mata_pelajaran`(`id_mata_pelajaran`,`nama_mapel`,`kode_mapel`,`kelompok_mapel`,`id_peminatan`,`created_at`,`last_update`) values (5,'Fiqih','FQ',1,4,'2019-08-23 09:50:41','2019-08-28 21:49:51'),(6,'Qur\'an Hadist','QH',1,3,'2019-09-13 09:56:31','2019-09-13 09:56:31');

/*Table structure for table `master_monitor_kelas` */

DROP TABLE IF EXISTS `master_monitor_kelas`;

CREATE TABLE `master_monitor_kelas` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanda_guru` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_monitor_kelas` */

insert  into `master_monitor_kelas`(`id`,`id_kelas`,`tanda_guru`) values (1,1,'ada');

/*Table structure for table `master_nilai` */

DROP TABLE IF EXISTS `master_nilai`;

CREATE TABLE `master_nilai` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nilai_siswa` double NOT NULL,
  `id_siswa_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_nilai` */

insert  into `master_nilai`(`id`,`id_kelas`,`id_mapel`,`id_guru`,`nilai_siswa`,`id_siswa_kelas`,`id_tahun_ajaran`) values (2,3,5,2,80,1,2),(3,1,5,2,100,1,2),(4,3,6,2,100,3,2);

/*Table structure for table `master_orangtua` */

DROP TABLE IF EXISTS `master_orangtua`;

CREATE TABLE `master_orangtua` (
  `id` int(11) NOT NULL,
  `id_siswa` int(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `alamat` text,
  `no_telepon` varchar(255) DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_orangtua` */

insert  into `master_orangtua`(`id`,`id_siswa`,`nama_ayah`,`nama_ibu`,`alamat`,`no_telepon`,`pekerjaan_ayah`,`pekerjaan_ibu`) values (1,1,'Herinal','Zulmaini','Jln. Sudirman','081371896365','swasta','ibu rumah tangga'),(2,2,'s','s','s','1','s','s'),(3,3,'a','a','a','1','a','a'),(4,4,'a','a','a','1','a','a'),(5,5,'q','q','q','1','q','q'),(6,6,'kk','jkh','kjh','11','jkhk','jhj'),(1,1,'Herinal','Zulmaini','Jln. Sudirman','081371896365','swasta','ibu rumah tangga');

/*Table structure for table `master_peminatan_mapel` */

DROP TABLE IF EXISTS `master_peminatan_mapel`;

CREATE TABLE `master_peminatan_mapel` (
  `id` int(11) NOT NULL,
  `nama_peminatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_peminatan_mapel` */

insert  into `master_peminatan_mapel`(`id`,`nama_peminatan`,`created_at`) values (1,'Peminatan Matematika dan IPA','2019-08-23 09:46:32'),(2,'Peminatan Sosial','2019-08-23 09:46:49'),(3,'Peminatan Bahasa','2019-08-23 09:47:05'),(4,'Peminatan Keagamaan','2019-08-23 09:47:26');

/*Table structure for table `master_siswa` */

DROP TABLE IF EXISTS `master_siswa`;

CREATE TABLE `master_siswa` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `status_dalam_keluarga` varchar(255) DEFAULT NULL,
  `anak_ke` int(255) DEFAULT NULL,
  `alamat` text,
  `no_telepon` varchar(255) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `kelas_diterima` varchar(255) DEFAULT NULL,
  `tanggal_diterima` date DEFAULT NULL,
  `foto` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_modified` datetime NOT NULL,
  `id_status_peserta_didik` int(11) NOT NULL,
  `no_ijazah` varchar(50) NOT NULL,
  `tahun_ijazah` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_siswa` */

insert  into `master_siswa`(`id`,`nama_lengkap`,`nis`,`nisn`,`tempat_lahir`,`tanggal_lahir`,`jenis_kelamin`,`agama`,`status_dalam_keluarga`,`anak_ke`,`alamat`,`no_telepon`,`asal_sekolah`,`kelas_diterima`,`tanggal_diterima`,`foto`,`created_date`,`created_modified`,`id_status_peserta_didik`,`no_ijazah`,`tahun_ijazah`) values (1,'Rio Bayu Sentosa','10101152610688','20178','Padang','1992-04-16','1','1','1',1,'Jalan Bahari','20713','SMP N 1 Bangkinang','X','2019-09-02','Hydrangeas.jpg','2019-09-13 09:57:55','2019-09-13 09:57:55',1,'-','2000'),(2,'aa','99','99','1','1010-01-01','1','1','1',1,'s','1','s','1','1010-01-01','Capture.JPG','2019-11-24 22:52:56','2019-11-24 22:52:56',1,'-','0000'),(3,'ryan','777','7777','langsa','2019-11-06','1','1','1',1,'aa','11','aa','X','2019-11-14','a14.jpg','2019-11-28 23:05:54','2019-11-28 23:05:54',1,'',''),(4,'ryan','7779','77779','langsa','2019-11-06','1','1','1',1,'aa','11','aa','X','2019-11-14','','2019-11-28 23:07:56','2019-11-28 23:07:56',1,'',''),(5,'s','100','100','s','1010-01-01','1','1','1',1,'a','','a','a','1010-01-01','a16.jpg','2019-11-28 23:11:09','2019-11-28 23:11:09',1,'',''),(6,'jkh','199','199','jhkj','1111-11-11','1','1','1',1,'kjhj','11','jkhjk','j','1111-11-11','a17.jpg','2019-11-28 23:15:30','2019-11-28 23:15:30',1,'',''),(1,'Rio Bayu Sentosa','1010','20178','Padang','1992-04-16','1','1','1',1,'Jalan Bahari','20713','SMP N 1 Bangkinang','X','2019-09-02','Hydrangeas.jpg','2019-09-13 09:57:55','2019-09-13 09:57:55',1,'AB102010','2019'),(2,'Rafki Gensaika','1011','20199','Padang','1992-04-16','1','1','1',1,'Jl SD 20','123','MTsN Payakumbuh','X','2019-09-02','Hydrangeas.jpg','2019-09-13 09:57:55','2019-10-09 09:57:55',1,'AC102011','2018');

/*Table structure for table `master_siswa_kelas` */

DROP TABLE IF EXISTS `master_siswa_kelas`;

CREATE TABLE `master_siswa_kelas` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_siswa_kelas` */

insert  into `master_siswa_kelas`(`id`,`id_kelas`,`id_siswa`,`id_tahun_ajaran`) values (1,1,1,1),(3,1,2,1),(4,1,1,2),(5,1,2,2);

/*Table structure for table `master_status_kelas` */

DROP TABLE IF EXISTS `master_status_kelas`;

CREATE TABLE `master_status_kelas` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_status_kelas` */

insert  into `master_status_kelas`(`id_status`,`nama_status`) values (1,'Aktif'),(2,'Non Aktif');

/*Table structure for table `master_status_pegawai` */

DROP TABLE IF EXISTS `master_status_pegawai`;

CREATE TABLE `master_status_pegawai` (
  `id` int(11) NOT NULL,
  `status_pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_status_pegawai` */

insert  into `master_status_pegawai`(`id`,`status_pegawai`) values (1,'PNS'),(2,'NON PNS');

/*Table structure for table `master_tahun_ajaran` */

DROP TABLE IF EXISTS `master_tahun_ajaran`;

CREATE TABLE `master_tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `title_tahun_ajaran` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_tahun_ajaran` */

/*Table structure for table `master_tahun_pelajaran` */

DROP TABLE IF EXISTS `master_tahun_pelajaran`;

CREATE TABLE `master_tahun_pelajaran` (
  `id` int(11) NOT NULL,
  `nama_tahu_pelajaran` varchar(255) DEFAULT NULL,
  `range_tahun` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_tahun_pelajaran` */

/*Table structure for table `master_wali` */

DROP TABLE IF EXISTS `master_wali`;

CREATE TABLE `master_wali` (
  `id` int(11) NOT NULL,
  `id_siswa` int(255) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `alamat` text,
  `pekerjaan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_wali` */

insert  into `master_wali`(`id`,`id_siswa`,`nama_wali`,`no_telepon`,`alamat`,`pekerjaan`) values (1,1,'Zuniar','08117415164','Jln. Bahari no. 38','swasta'),(2,2,'s','1','s','s'),(3,3,'a','1','a','a'),(4,4,'a','1','a','a'),(5,5,'q','1','q','q'),(6,6,'jk','11','jhjk','jkhjk'),(1,1,'Zuniar','08117415164','Jln. Bahari no. 38','swasta');

/*Table structure for table `mobil` */

DROP TABLE IF EXISTS `mobil`;

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `nomor_plat` varchar(30) NOT NULL,
  `merk_mobil` varchar(50) NOT NULL,
  `tahun_mobil` year(4) NOT NULL,
  `tahun_beli` year(4) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mobil` */

insert  into `mobil`(`id_mobil`,`nomor_plat`,`merk_mobil`,`tahun_mobil`,`tahun_beli`,`created_date`) values (1,'BA 1234 HV','Mitsubishi Colt Diesel D',2014,2017,'2019-07-17');

/*Table structure for table `orang_tua` */

DROP TABLE IF EXISTS `orang_tua`;

CREATE TABLE `orang_tua` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` text NOT NULL,
  `pekerjaan_ayah` varchar(255) NOT NULL,
  `pekerjaan_ibu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `orang_tua` */

/*Table structure for table `pembayaran_spp` */

DROP TABLE IF EXISTS `pembayaran_spp`;

CREATE TABLE `pembayaran_spp` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `bulan` varchar(25) NOT NULL,
  `tahun` int(11) NOT NULL,
  `total_bayar` double NOT NULL,
  `created_date` datetime NOT NULL,
  `created_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_spp` */

insert  into `pembayaran_spp`(`id`,`nis`,`id_kelas`,`bulan`,`tahun`,`total_bayar`,`created_date`,`created_modified`) values (3,'1010',1,'Mei',2019,80000,'2019-11-12 16:18:16','2019-11-12 16:21:35'),(4,'1011',3,'Maret',2018,120000,'2019-11-12 16:22:20','2019-11-28 22:31:19');

/*Table structure for table `pembayaran_spp_kelas` */

DROP TABLE IF EXISTS `pembayaran_spp_kelas`;

CREATE TABLE `pembayaran_spp_kelas` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` varchar(11) NOT NULL,
  `bulan` varchar(25) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jml_bayar` double NOT NULL,
  `jml_keseluruhan` double NOT NULL,
  `id_status_spp_kelas` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran_spp_kelas` */

insert  into `pembayaran_spp_kelas`(`id`,`id_kelas`,`id_guru`,`bulan`,`tahun`,`jml_bayar`,`jml_keseluruhan`,`id_status_spp_kelas`,`created_date`,`created_modified`) values (1,1,'5','Mei',2019,500000,1000000,2,'2019-11-12 16:18:16','2019-11-12 16:21:35'),(2,3,'22','Juli',2019,5000000,5000000,1,'2019-11-12 16:22:20','2019-11-28 22:31:19'),(3,3,'1','Januari',2017,500000,500000,1,'2019-12-02 00:32:07','2019-12-02 00:40:05');

/*Table structure for table `riwayat_jabatan` */

DROP TABLE IF EXISTS `riwayat_jabatan`;

CREATE TABLE `riwayat_jabatan` (
  `id` int(11) NOT NULL,
  `id_guru` int(255) DEFAULT NULL,
  `id_jabatan` int(255) DEFAULT NULL,
  `tahun_pelajaran` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `riwayat_jabatan` */

/*Table structure for table `riwayat_kelas` */

DROP TABLE IF EXISTS `riwayat_kelas`;

CREATE TABLE `riwayat_kelas` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_tahun_pelajaran` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `riwayat_kelas` */

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nis` text NOT NULL,
  `nisn` text NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(5) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `status_dalam_keluarga` varchar(30) NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` text NOT NULL,
  `asal_sekolah` varchar(255) NOT NULL,
  `kelas_diterima` varchar(50) NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `status_siswa` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

/*Table structure for table `status_guru` */

DROP TABLE IF EXISTS `status_guru`;

CREATE TABLE `status_guru` (
  `id` int(11) NOT NULL,
  `status_guru` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `status_guru` */

insert  into `status_guru`(`id`,`status_guru`,`created_at`) values (1,'Aktif','2019-09-13 00:00:00'),(2,'Pindah','2019-09-13 00:00:00'),(3,'Pensiun','2019-09-13 00:00:00');

/*Table structure for table `supir` */

DROP TABLE IF EXISTS `supir`;

CREATE TABLE `supir` (
  `id_supir` int(11) NOT NULL,
  `nama_supir` varchar(30) NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supir` */

insert  into `supir`(`id_supir`,`nama_supir`,`tanggal_bergabung`,`no_hp`,`created_date`) values (1,'Agung Surya','2019-07-16','0812765435243','2019-07-16'),(3,'Dhany Dwi Putra','2019-07-15','0812765467263','2019-07-16');

/*Table structure for table `tahun_ajaran` */

DROP TABLE IF EXISTS `tahun_ajaran`;

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tahun_ajaran` */

insert  into `tahun_ajaran`(`id`,`tahun`) values (2,2019),(2,2019),(3,2018),(4,2017);

/*Table structure for table `visitor` */

DROP TABLE IF EXISTS `visitor`;

CREATE TABLE `visitor` (
  `id_visitor` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `browser` text NOT NULL,
  `ip` text NOT NULL,
  `online` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `visitor` */

insert  into `visitor`(`id_visitor`,`created_date`,`browser`,`ip`,`online`,`hits`,`url`) values (1,'2019-07-13','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:67.0) Gecko/20100101 Firefox/67.0','::1','1563037711',2,''),(2,'2019-07-15','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0','::1','1563182175',14,''),(3,'2019-07-15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36','::1','1563198142',7,''),(4,'2019-07-16','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36','::1','1563266227',2,''),(5,'2019-07-16','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','::1','1563281359',3,''),(6,'2019-07-17','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0.1 Safari/605.1.15','::1','1563326148',2,''),(7,'2019-07-17','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','::1','1563350278',4,''),(8,'2019-08-06','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','::1','1565065832',2,''),(9,'2019-08-12','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1565608886',3,''),(10,'2019-08-13','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1565711821',87,''),(11,'2019-08-14','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1565801409',4,''),(12,'2019-08-15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1565834602',3,''),(13,'2019-08-23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1566528002',2,''),(14,'2019-08-24','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1566623806',2,''),(15,'2019-08-26','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1566827535',2,''),(16,'2019-08-27','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1566899920',5,''),(17,'2019-08-28','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','::1','1567006450',3,''),(18,'2019-09-03','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','::1','1567510827',12,''),(19,'2019-09-03','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36','::1','1567530321',4,''),(20,'2019-09-04','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36','::1','1567561411',2,''),(21,'2019-09-04','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','::1','1567600030',13,''),(22,'2019-09-12','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36','::1','1568295796',13,''),(23,'2019-09-13','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:69.0) Gecko/20100101 Firefox/69.0','::1','1568348701',9,''),(24,'2019-10-31','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36','::1','1572532836',7,''),(25,'2019-11-01','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1572582140',3,''),(26,'2019-11-02','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1572694199',5,''),(27,'2019-11-03','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1572821072',4,''),(28,'2019-11-05','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1572975998',3,''),(29,'2019-11-09','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1573315845',1,''),(30,'2019-11-10','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1573382358',6,''),(31,'2019-11-11','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36','::1','1573480294',7,''),(32,'2019-11-12','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1573553377',9,''),(33,'2019-11-13','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1573683459',7,''),(34,'2019-11-14','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1573736567',3,''),(35,'2019-11-16','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1573901376',5,''),(36,'2019-11-18','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574071478',7,''),(37,'2019-11-19','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574134476',3,''),(38,'2019-11-22','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574435388',8,''),(39,'2019-11-24','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574610426',3,''),(40,'2019-11-25','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574720682',7,''),(41,'2019-11-26','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574741859',6,''),(42,'2019-11-28','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1574948544',5,''),(43,'2019-12-03','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1575363697',3,''),(44,'2019-12-05','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36','::1','1575556624',9,''),(45,'2019-12-05','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','::1','1575560290',12,''),(46,'2019-12-05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','::1','1575560676',8,''),(47,'2019-12-05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','36.68.55.173','1575560150',12,''),(48,'2019-12-05','Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','36.68.53.147','1575560329',4,'');

/*Table structure for table `wali_murid` */

DROP TABLE IF EXISTS `wali_murid`;

CREATE TABLE `wali_murid` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `no_telepon` text NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wali_murid` */

/*Table structure for table `view_recent_content` */

DROP TABLE IF EXISTS `view_recent_content`;

/*!50001 DROP VIEW IF EXISTS `view_recent_content` */;
/*!50001 DROP TABLE IF EXISTS `view_recent_content` */;

/*!50001 CREATE TABLE  `view_recent_content`(
 `id_content` int(11) ,
 `title` text ,
 `isi` text ,
 `gambar` text ,
 `id_category` int(11) ,
 `created_date` datetime ,
 `created_modified` datetime ,
 `created_by` int(11) ,
 `hits` int(11) ,
 `id_status` int(11) ,
 `nm_status` varchar(20) ,
 `title_category` text ,
 `full_name` text 
)*/;

/*View structure for view view_recent_content */

/*!50001 DROP TABLE IF EXISTS `view_recent_content` */;
/*!50001 DROP VIEW IF EXISTS `view_recent_content` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_recent_content` AS select `a`.`id_content` AS `id_content`,`a`.`title` AS `title`,`a`.`isi` AS `isi`,`a`.`gambar` AS `gambar`,`a`.`id_category` AS `id_category`,`a`.`created_date` AS `created_date`,`a`.`created_modified` AS `created_modified`,`a`.`created_by` AS `created_by`,`a`.`hits` AS `hits`,`a`.`id_status` AS `id_status`,`b`.`nm_status` AS `nm_status`,`c`.`title` AS `title_category`,`d`.`full_name` AS `full_name` from (((`content` `a` left join `_status_system` `b` on((`a`.`id_status` = `b`.`id_status`))) left join `category` `c` on((`a`.`id_category` = `c`.`id_category`))) left join `_users_account` `d` on((`a`.`created_by` = `d`.`id_user`))) where (`a`.`id_status` = '4') order by `a`.`created_date` desc */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
