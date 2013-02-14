-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2012 at 01:13 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE IF NOT EXISTS `absensi_guru` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `guru_nip` varchar(111) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `keterangan` varchar(111) NOT NULL,
  `tanggal` varchar(111) NOT NULL,
  `bulan` varchar(111) NOT NULL,
  `selesai` varchar(111) NOT NULL,
  `waktu` varchar(111) NOT NULL,
  `terlambat` varchar(111) NOT NULL,
  `in_out` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id`, `guru_nip`, `id_finger`, `keterangan`, `tanggal`, `bulan`, `selesai`, `waktu`, `terlambat`, `in_out`) VALUES
(16, '44', 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', '-'),
(18, '43', 0, 'a', '01-07-2012', '07-2012', 'yes', '-', '-', '-'),
(14, '43', 43, 'h', '12-11-2012', '11-2012', 'yes', '07:49:16', 'y', 'in'),
(17, '43', 43, 'out', '12-11-2012', '11-2012', 'yes', '15:51:38', '-', 'out'),
(19, '44', 0, 'a', '01-07-2012', '07-2012', 'yes', '-', '-', '-'),
(20, '43', 0, 'a', '11-11-2012', '11-2012', 'yes', '-', '-', '-'),
(21, '44', 0, 'a', '11-11-2012', '11-2012', 'yes', '-', '-', '-'),
(22, '43', 0, 'a', '01-07-2013', '07-2013', 'yes', '-', '-', '-'),
(23, '44', 0, 'a', '01-07-2013', '07-2013', 'yes', '-', '-', '-'),
(24, '43', 0, 'a', '01-07-2014', '07-2014', 'yes', '-', '-', '-'),
(25, '44', 0, 'a', '01-07-2014', '07-2014', 'yes', '-', '-', '-'),
(26, '43', 0, 'a', '01-12-2013', '12-2013', 'yes', '-', '-', '-'),
(27, '44', 0, 'a', '01-12-2013', '12-2013', 'yes', '-', '-', '-'),
(28, '43', 0, 'a', '01-12-2014', '12-2014', 'yes', '-', '-', '-'),
(29, '44', 0, 'a', '01-12-2014', '12-2014', 'yes', '-', '-', '-'),
(30, '43', 0, 'a', '01-12-2015', '12-2015', 'yes', '-', '-', '-'),
(31, '44', 0, 'a', '01-12-2015', '12-2015', 'yes', '-', '-', '-'),
(32, '43', 0, 'a', '02-12-2012', '12-2012', 'yes', '-', '-', '-'),
(33, '44', 0, 'a', '02-12-2012', '12-2012', 'yes', '-', '-', '-'),
(34, '43', 0, 'a', '06-12-2012', '12-2012', 'yes', '-', '-', '-'),
(35, '44', 0, 'a', '06-12-2012', '12-2012', 'yes', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_karyawan`
--

CREATE TABLE IF NOT EXISTS `absensi_karyawan` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `karyawan_nup` int(50) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `selesai` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `terlambat` varchar(100) NOT NULL,
  `in_out` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `absensi_karyawan`
--

INSERT INTO `absensi_karyawan` (`id`, `karyawan_nup`, `id_finger`, `keterangan`, `tanggal`, `bulan`, `selesai`, `waktu`, `terlambat`, `in_out`) VALUES
(1, 8, 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', '-'),
(2, 1, 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', '-'),
(3, 8, 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', 'out_auto'),
(4, 1, 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', 'out_auto'),
(5, 8, 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', 'out_auto'),
(6, 1, 0, 'a', '12-11-2012', '11-2012', 'yes', '-', '-', 'out_auto'),
(7, 8, 0, 'a', '01-07-2012', '07-2012', 'yes', '-', '-', '-'),
(8, 1, 0, 'a', '01-07-2012', '07-2012', 'yes', '-', '-', '-'),
(9, 8, 0, 'a', '11-11-2012', '11-2012', 'yes', '-', '-', '-'),
(10, 1, 0, 'a', '11-11-2012', '11-2012', 'yes', '-', '-', '-'),
(11, 8, 0, 'a', '01-07-2013', '07-2013', 'yes', '-', '-', '-'),
(12, 1, 0, 'a', '01-07-2013', '07-2013', 'yes', '-', '-', '-'),
(13, 8, 0, 'a', '01-07-2014', '07-2014', 'yes', '-', '-', '-'),
(14, 1, 0, 'a', '01-07-2014', '07-2014', 'yes', '-', '-', '-'),
(15, 8, 0, 'a', '01-12-2013', '12-2013', 'yes', '-', '-', '-'),
(16, 1, 0, 'a', '01-12-2013', '12-2013', 'yes', '-', '-', '-'),
(17, 8, 0, 'a', '01-12-2014', '12-2014', 'yes', '-', '-', '-'),
(18, 1, 0, 'a', '01-12-2014', '12-2014', 'yes', '-', '-', '-'),
(19, 8, 0, 'a', '01-12-2015', '12-2015', 'yes', '-', '-', '-'),
(20, 1, 0, 'a', '01-12-2015', '12-2015', 'yes', '-', '-', '-'),
(21, 8, 0, 'a', '02-12-2012', '12-2012', 'yes', '-', '-', '-'),
(22, 1, 0, 'a', '02-12-2012', '12-2012', 'yes', '-', '-', '-'),
(23, 8, 0, 'a', '06-12-2012', '12-2012', 'yes', '-', '-', '-'),
(24, 1, 0, 'a', '06-12-2012', '12-2012', 'yes', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_siswa`
--

CREATE TABLE IF NOT EXISTS `absensi_siswa` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `no_siswa` int(111) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` varchar(222) NOT NULL,
  `bulan` varchar(222) NOT NULL,
  `tahun` varchar(111) DEFAULT NULL,
  `kd_kelas` int(222) NOT NULL,
  `selesai` varchar(222) DEFAULT NULL,
  `waktu` varchar(222) NOT NULL,
  `terlambat` varchar(222) NOT NULL,
  `in_out` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(111) NOT NULL,
  `semester` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `absensi_siswa`
--

INSERT INTO `absensi_siswa` (`id`, `no_siswa`, `id_finger`, `keterangan`, `tanggal`, `bulan`, `tahun`, `kd_kelas`, `selesai`, `waktu`, `terlambat`, `in_out`, `tahun_ajaran`, `semester`) VALUES
(45, 1, 0, 'a', '06-12-2012', '12-2012', NULL, 33, 'yes', '-', '-', '-', '2012-2013', '1'),
(44, 1, 0, 'a', '02-12-2012', '12-2012', NULL, 33, 'yes', '-', '-', '-', '2012-2013', '1');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(111) NOT NULL,
  `pass` varchar(111) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `pass` (`pass`),
  UNIQUE KEY `pass_2` (`pass`),
  UNIQUE KEY `pass_3` (`pass`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `fp`
--

CREATE TABLE IF NOT EXISTS `fp` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `ip` varchar(111) NOT NULL,
  `key` int(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fp`
--

INSERT INTO `fp` (`id`, `ip`, `key`) VALUES
(2, '', 0),
(1, '192.168.1.3', 0),
(3, '', 0),
(4, '', 0),
(5, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `No` int(50) NOT NULL AUTO_INCREMENT,
  `nip` bigint(50) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `id_pel` int(244) DEFAULT NULL,
  `foto` varchar(200) NOT NULL,
  PRIMARY KEY (`No`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `pelajaran` (`id_pel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`No`, `nip`, `id_finger`, `nama`, `pasword`, `id_pel`, `foto`) VALUES
(18, 43, 43, '43', '17e62166fc8586dfa4d1bc0e1742c08b', NULL, ''),
(19, 44, 44, '44', 'f7177163c833dff4b38fc8d2872f1ec6', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `hari_libur`
--

CREATE TABLE IF NOT EXISTS `hari_libur` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` varchar(111) NOT NULL,
  `tanggal_akhir` varchar(111) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hari_libur`
--

INSERT INTO `hari_libur` (`id`, `tanggal_mulai`, `tanggal_akhir`, `keterangan`) VALUES
(2, '12-12-2012', '20-12-2012', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `nama` varchar(111) NOT NULL,
  `keterangan` varchar(222) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `keterangan`) VALUES
(19, '5', 'TKJTKJTKJTKJTKJTKJTKJTKJ'),
(15, '1', '1'),
(16, '2', 'TKJTKJTKJ'),
(17, '3', 'TKJTKJTKJTKJ'),
(18, '4', 'TKJTKJTKJTKJTKJ'),
(14, 'TKJ', 'TKJ'),
(13, 'RPL1', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `nup` bigint(222) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `nama` varchar(222) NOT NULL,
  `tempat_lahir` varchar(222) NOT NULL,
  `tanggal_lahir` varchar(222) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(222) NOT NULL,
  `foto` varchar(222) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nup` (`nup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nup`, `id_finger`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `foto`) VALUES
(9, 8, 88, '8', '8', '8', '8 ', 'Islam', ''),
(1, 1, 10, '1k', '1k', '1k', '1k', 'Islam', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `Nama_Kelas` varchar(222) NOT NULL,
  `id_jurusan` varchar(111) NOT NULL,
  `id_guru` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `Nama_Kelas`, `id_jurusan`, `id_guru`) VALUES
(40, 'X-2', '16 X', '18'),
(37, 'X-1', '15 X', '18'),
(38, 'XI-1', '15 XI', '18'),
(39, 'XII-1', '15 XII', '18'),
(36, 'XII-TKJ', '14 XII', '18'),
(35, 'XI-TKJ', '14 XI', '18'),
(34, 'X-TKJ', '14 X', '18'),
(33, 'XII-RPL1', '13 XII', '18'),
(32, 'XI-RPL1', '13 XI', '18'),
(31, 'X-RPL1', '13 X', '18'),
(41, 'XII-2', '16 XII', '18'),
(42, 'X-3', '17 X', '18'),
(43, 'XI-3', '17 XI', '18'),
(44, 'XII-3', '17 XII', '18'),
(45, 'X-4', '18 X', '18'),
(46, 'X-5', '19 X', '18'),
(47, 'XI-4', '18 XI', '18'),
(48, 'XII-4', '18 XII', '18'),
(49, 'XI-5', '19 XI', '18'),
(50, 'XII-5', '19 XII', '18');

-- --------------------------------------------------------

--
-- Table structure for table `mp_kabkot`
--

CREATE TABLE IF NOT EXISTS `mp_kabkot` (
  `id_prov` int(2) NOT NULL,
  `id_kabkot` int(4) NOT NULL,
  `nama_kabkot` char(40) NOT NULL,
  PRIMARY KEY (`id_kabkot`),
  KEY `id_prov` (`id_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_kabkot`
--

INSERT INTO `mp_kabkot` (`id_prov`, `id_kabkot`, `nama_kabkot`) VALUES
(1, 1, 'jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `pel`
--

CREATE TABLE IF NOT EXISTS `pel` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `buku` varchar(255) NOT NULL,
  `id_guru` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pel`
--


-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `isi` text NOT NULL,
  `tanggal_mulai` varchar(111) NOT NULL,
  `tanggal_akhir` varchar(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `isi`, `tanggal_mulai`, `tanggal_akhir`) VALUES
(1, 'HARI SENIN LIBUR WOY', '05-12-2012', '12-12-2012');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_semester` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `semester`
--


-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nis` bigint(111) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `Nama_siswa` varchar(50) NOT NULL,
  `nama_panggilan` varchar(111) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` varchar(100) NOT NULL,
  `agama` varchar(22) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_kelas` int(50) NOT NULL,
  `absen` int(111) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `id_finger`, `Nama_siswa`, `nama_panggilan`, `kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `password`, `id_kelas`, `absen`, `foto`) VALUES
(65, 1, 1, '1', '1', 'L', '1', '1', 'Islam', ' 1', 'c4ca4238a0b923820dcc509a6f75849b', 33, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`) VALUES
(28, '2014-2015'),
(29, '2015-2016'),
(27, '2013-2014'),
(26, '2012-2013'),
(30, '2012-2013');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `label` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `title`, `label`, `logo`) VALUES
(1, 'LAUGH!! :D', 'LAUGH!! :D', '44a168c5a420dc371d1e5ec2b78c3bb7_t.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `top_telat`
--

CREATE TABLE IF NOT EXISTS `top_telat` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `value` varchar(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `top_telat`
--

INSERT INTO `top_telat` (`id`, `value`) VALUES
(1, '14'),
(2, '3'),
(3, '4');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_telat`
--

CREATE TABLE IF NOT EXISTS `waktu_telat` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `waktu` varchar(111) NOT NULL,
  `jam` varchar(111) NOT NULL,
  `menit` varchar(111) NOT NULL,
  `detik` varchar(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `waktu_telat`
--

INSERT INTO `waktu_telat` (`id`, `waktu`, `jam`, `menit`, `detik`) VALUES
(1, '06:30:00', '6', '30', '00'),
(2, '15:00:00', '15', '0', '00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
