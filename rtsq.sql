-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2021 at 12:26 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtsq`
--

-- --------------------------------------------------------

--
-- Table structure for table `absenpengajar`
--

DROP TABLE IF EXISTS `absenpengajar`;
CREATE TABLE IF NOT EXISTS `absenpengajar` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengajar` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('hadir','alfa','sakit','izin') NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `absen` (`id_pengajar`),
  KEY `kelas` (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absenpengajar`
--

INSERT INTO `absenpengajar` (`id_absen`, `id_pengajar`, `id_kelas`, `tanggal`, `keterangan`, `foto`) VALUES
(38, 25, 18, '2021-12-12', 'izin', '1639367223_ca5ef217e4893fbfd0b8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `absensantri`
--

DROP TABLE IF EXISTS `absensantri`;
CREATE TABLE IF NOT EXISTS `absensantri` (
  `id_absen` int(11) NOT NULL AUTO_INCREMENT,
  `id_santri` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('hadir','alfa','sakit','izin') NOT NULL,
  PRIMARY KEY (`id_absen`),
  KEY `absens` (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensantri`
--

INSERT INTO `absensantri` (`id_absen`, `id_santri`, `tanggal`, `keterangan`) VALUES
(204, 47, '2021-12-10', 'hadir'),
(205, 46, '2021-12-10', 'hadir'),
(206, 45, '2021-12-10', 'hadir'),
(207, 44, '2021-12-10', 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

DROP TABLE IF EXISTS `galeri`;
CREATE TABLE IF NOT EXISTS `galeri` (
  `id_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` text NOT NULL,
  `tgl` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_galeri`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `nama_kegiatan`, `tgl`, `foto`) VALUES
(1, 'Pembuatan sistem informasi rumah tahfidz 2021', '2021-08-30', '1633248369_36ad8d4b964a3a507926.jpg'),
(3, 'Pemberian buku ke rumah tahfidz', '2021-06-05', '1633248278_2163061e33e8028bc96c.jpg'),
(4, '<p>Foto Bersama dengan Politeknik Negeri Padang</p>', '2021-08-08', '1634295314_966c8bac6fa09440ab58.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hafalan`
--

DROP TABLE IF EXISTS `hafalan`;
CREATE TABLE IF NOT EXISTS `hafalan` (
  `id_hafalan` int(11) NOT NULL AUTO_INCREMENT,
  `id_santri` int(11) NOT NULL,
  `tgl_setor` date NOT NULL,
  `id_surah` int(11) NOT NULL,
  `awal_hafalan` int(11) NOT NULL,
  `akhir_hafalan` int(11) NOT NULL,
  `keterangan` text,
  `status` enum('Selesai','Belum Selesai') NOT NULL DEFAULT 'Belum Selesai',
  `dibuat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_hafalan`),
  KEY `santrihaf` (`id_santri`),
  KEY `surahhaf` (`id_surah`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) NOT NULL,
  `id_pengajar` int(11) NOT NULL,
  `keterangan_kelas` text NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `pengajar_kelas` (`id_pengajar`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_pengajar`, `keterangan_kelas`) VALUES
(6, 'Athfal level 1', 14, '<p>Usia 6 - 7 Tahun<br></p>'),
(7, 'TAUD', 14, '<p>Balita usia 3 - 5 tahun<br></p>'),
(9, 'Banat', 18, '<p>Usia 8 - 18 tahun </p><p>Perempuan<br></p>'),
(10, 'Banat', 17, '<p>Usia 8 - 18 tahun</p><p>Perempuan<br></p>'),
(11, 'Banat', 20, '<p>Usia 8 - 18 tahun Perempuan</p>'),
(12, 'Banat', 17, '<p>Usia 8 - 18 tahun</p>Perempuan'),
(13, 'Banat', 21, '<p>Usia 8 - 18 tahun</p>Perempuan'),
(14, 'Aulad', 24, '<p>Usia 8 - 18 tahun</p>Laki - Laki<br>'),
(15, 'Aulad', 19, '<p>Usia 8 - 18 tahun</p>Laki - Laki<br>'),
(16, 'Aulad', 23, '<p>Usia 8 - 18 tahun</p>Laki - Laki'),
(17, 'TQM', 18, '<p>1. Santri minimal hafal 1 juz</p><p>2. tidak menjadi santri di TPA / MDA</p><p>3. Santri menghafal juz 29 keatas<br></p>'),
(18, 'TQM', 25, '<p>1. Santri minimal hafal 1 juz</p><p>2. tidak menjadi santri di TPA / MDA</p><p>3. Santri menghafal juz 29 keatas<br></p>'),
(22, 'Balita Level2', 14, '<p>-<br></p>');

-- --------------------------------------------------------

--
-- Table structure for table `kelassantri`
--

DROP TABLE IF EXISTS `kelassantri`;
CREATE TABLE IF NOT EXISTS `kelassantri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_santri` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idkelas` (`id_kelas`),
  KEY `idsantri` (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelassantri`
--

INSERT INTO `kelassantri` (`id`, `id_kelas`, `id_santri`) VALUES
(38, 17, 44),
(39, 17, 45),
(40, 17, 46),
(41, 17, 47),
(43, 14, 49),
(44, 14, 50),
(45, 14, 51),
(46, 14, 52),
(47, 14, 53),
(48, 14, 54),
(49, 14, 55),
(50, 14, 56),
(51, 14, 57),
(52, 14, 58),
(53, 9, 59),
(54, 9, 60),
(55, 9, 61),
(56, 9, 62),
(57, 9, 63),
(58, 9, 64),
(59, 9, 65),
(60, 9, 66),
(61, 9, 67),
(62, 11, 68),
(63, 11, 69),
(64, 11, 70),
(65, 11, 71),
(66, 11, 72),
(67, 11, 73),
(68, 11, 74),
(69, 11, 75),
(70, 11, 76),
(71, 11, 77),
(72, 11, 78);

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

DROP TABLE IF EXISTS `pengajar`;
CREATE TABLE IF NOT EXISTS `pengajar` (
  `id_pengajar` int(11) NOT NULL AUTO_INCREMENT,
  `no_pengajar` varchar(20) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(12) NOT NULL,
  `pendidikan_terakhir` varchar(100) DEFAULT NULL,
  `alamat` text,
  `jml_hafalan` varchar(10) DEFAULT NULL,
  `thn_masuk` varchar(4) DEFAULT NULL,
  `nohp` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `keterangan` varchar(15) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengajar`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `no_pengajar`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `pendidikan_terakhir`, `alamat`, `jml_hafalan`, `thn_masuk`, `nohp`, `foto`, `keterangan`, `status`) VALUES
(14, 'P20130014', 'Hafsah Elvi Ramadhani', 'Bukittinggi', '1987-05-02', 'Perempuan', 'D3 keperawatan', 'Koto Tinggi, Pandai Sikek Kec. X Koto, Kab. Tanah Datar', '30', '2013', '086789890990', 'default.jpg', 'Active', 'Sertifikasi Tabarak Internasional 2018'),
(17, 'P20170017', 'Rima Sasmita', 'Padang', '1983-10-05', 'Perempuan', 'S1', 'pandai sikek', '1', '2017', '1234567890', 'default.jpg', 'Passive', '-'),
(18, 'P20170018', 'Wira Anggraini', 'Koto Baru', '1991-05-16', 'Perempuan', NULL, NULL, NULL, '2017', '1234567890', 'default.jpg', 'Active', NULL),
(19, 'P20180019', 'Dimas Albukhari R. Muslim', 'Padang Panjang', '2000-11-30', 'Laki - Laki', NULL, NULL, NULL, '2018', '1234567890', 'default.jpg', 'Active', NULL),
(20, 'P20180020', 'Dina Hanifah Apandi', 'Bandung', '2001-03-11', 'Perempuan', 'S1', 'pandai sikek', '1', '2018', '1234567890', 'default.jpg', 'Passive', '-'),
(21, 'P20190021', 'Lidya Oktaviani', 'Koto Baru', '1998-10-13', 'Perempuan', NULL, NULL, NULL, '2019', '1234567890', 'default.jpg', 'Active', NULL),
(23, 'P20200023', 'Hamzah', 'Sukoharjo', '1994-07-25', 'Laki - Laki', NULL, NULL, NULL, '2020', '1234567890', 'default.jpg', 'Active', NULL),
(24, 'P20200024', 'Harif Pratama', 'Padang Panjang', '1996-03-19', 'Laki - Laki', '-', '-', '0', '2020', '082678988970', 'default.jpg', 'Passive', '-'),
(25, 'P20160025', 'Ainun Mardiyah', 'Medan', '1985-04-12', 'Perempuan', 'Ma\'had Tahfidz', 'Koto tinggi pandai sikek kec. X Koto Kab. Tanah Datar', '30', '2016', '089090890989', 'default.jpg', 'Active', '-'),
(29, 'P20190029', 'Safari Yati', 'Bukittinggi', '1998-10-13', 'Perempuan', 'SLTA', ' Koto Tinggi Pandai Sikek Kec. X Koto, Kab Tanah Datar', '3', '2019', '0989898298392', 'default.jpg', 'Active', '-');

-- --------------------------------------------------------

--
-- Table structure for table `rumahtahfidz`
--

DROP TABLE IF EXISTS `rumahtahfidz`;
CREATE TABLE IF NOT EXISTS `rumahtahfidz` (
  `id_rumahtahfidz` int(11) NOT NULL,
  `namart` varchar(100) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp1` varchar(15) NOT NULL,
  `telp2` varchar(15) NOT NULL,
  `maps` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rumahtahfidz`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumahtahfidz`
--

INSERT INTO `rumahtahfidz` (`id_rumahtahfidz`, `namart`, `pemilik`, `alamat`, `email`, `telp1`, `telp2`, `maps`, `foto`) VALUES
(1, 'Shohibul Qur\'an', 'Ummi Hafhsah', 'Rumah Tahfizh Shohibul Quran Depan Masjid Taqwa Koto Tinggi Nagari Pandai Sikek Kec. X Koto Kab. Tanah Datar Sumatera Barat.<br>', 'rtsq@gmail.com', '+6282287289768', '089876543222', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d997.4312729596462!2d100.39104342917678!3d-0.39168439998213594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd53bb47ed0c9d9%3A0xbc44b0f00cbe3d43!2sRumah%20Tahfizh%20Shohibul%20Qur&#39;an!5e0!3m2!1sid!2sid!4v1633566096156!5m2!1sid!2sid\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '1633650634_d93d5a321780a6d9e229.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

DROP TABLE IF EXISTS `santri`;
CREATE TABLE IF NOT EXISTS `santri` (
  `id_santri` int(11) NOT NULL AUTO_INCREMENT,
  `no_santri` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` varchar(15) NOT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `alamat` text,
  `nohp` varchar(15) DEFAULT NULL,
  `jml_hafalan` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `nohp_ortu` varchar(15) DEFAULT NULL,
  `foto` varchar(100) DEFAULT 'default.jpg',
  PRIMARY KEY (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id_santri`, `no_santri`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `pendidikan`, `alamat`, `nohp`, `jml_hafalan`, `tgl_masuk`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `nohp_ortu`, `foto`) VALUES
(44, 'S210044', 'Ghina Syafa Muthmainnah', NULL, NULL, 'Perempuan', NULL, NULL, '085356085641', 0, '2021-10-05', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(45, 'S210045', 'Qisti Khairatun Hisan', NULL, NULL, 'Perempuan', NULL, NULL, '085364200310', NULL, '2021-10-05', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(46, 'S210046', 'Salma Hidayati', NULL, NULL, 'Perempuan', NULL, NULL, '081261877921', NULL, '2021-10-06', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(47, 'S210047', 'Nadira Tazkia', NULL, NULL, 'Perempuan', NULL, NULL, '081363121518', NULL, '2021-10-07', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(49, 'S210049', 'Stievano Al-Fatih', NULL, NULL, 'Laki - Laki', NULL, NULL, '085263330354', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(50, 'S210050', 'Tegar', NULL, NULL, 'Laki - Laki', NULL, NULL, '082386824749', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(51, 'S210051', 'Jundi Syarif Deslim', NULL, NULL, 'Laki - Laki', NULL, NULL, '085835285048', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(52, 'S210052', 'Nuzul Aulia Deslim', NULL, NULL, 'Laki - Laki', NULL, NULL, '085835285048', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(53, 'S210053', 'Wahidul Musthaqim', NULL, NULL, 'Laki - Laki', NULL, NULL, '085265055861', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(54, 'S210054', 'Syahrul Ramadhan', NULL, NULL, 'Laki - Laki', NULL, NULL, '085263402158', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(55, 'S210055', 'Davin Naufal Tsaqief', NULL, NULL, 'Laki - Laki', NULL, NULL, '082162002232', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(56, 'S210056', 'Imam Maulana Siddiq', NULL, NULL, 'Laki - Laki', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(57, 'S210057', 'Ifdhal', NULL, NULL, 'Laki - Laki', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(58, 'S210058', 'Yusuf Purnama', NULL, NULL, 'Laki - Laki', NULL, NULL, '082389562425', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(59, 'S210059', 'Almira Alya Askana', NULL, NULL, 'Perempuan', NULL, NULL, '081364457481', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(60, 'S210060', 'Keysa Khairani', NULL, NULL, 'Perempuan', NULL, NULL, '085263113764', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(61, 'S210061', 'Regina Putri', NULL, NULL, 'Perempuan', NULL, NULL, '085263594002', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(62, 'S210062', 'Raisya Maulida Raffi', NULL, NULL, 'Perempuan', NULL, NULL, '085263365943', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(63, 'S210063', 'Nurul Rahmadani', NULL, NULL, 'Perempuan', NULL, NULL, '081275956411', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(64, 'S210064', 'Na\'ilah Rahmadina', NULL, NULL, 'Perempuan', NULL, NULL, '081270201579', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(65, 'S210065', 'Rumaysha Al Kayyisa', NULL, NULL, 'Perempuan', NULL, NULL, '081363289235', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(66, 'S210066', 'Salma Adra Syifa', NULL, NULL, 'Perempuan', NULL, NULL, '08128776744', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(67, 'S210067', 'Miftahurrahmi Ghofur', NULL, NULL, 'Perempuan', NULL, NULL, '082268777420', NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(68, 'S210068', 'Serlina Lathifa Rahmi', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(69, 'S210069', 'Aprisilla Puspita', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(70, 'S210070', 'Kania', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(71, 'S210071', 'Niki Veronika', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(72, 'S210072', 'Adzkia Salsabila', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(73, 'S210073', 'Aisyah', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(74, 'S210074', 'Salsabila Nur Adha', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(75, 'S210075', 'Zahra Melika', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(76, 'S210076', 'Vanesa Reva Violin', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(77, 'S210077', 'Chesya Bunga Rasika', NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, '2021-10-08', NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(78, 'S210078', 'Kanaya', 'pandai sikek', '2012-09-05', 'Perempuan', 'sd', 'pandai sikek x koto', '098888888888888', 1, '2021-10-08', 'aki', 'guru', 'sari', 'IRT', '090900900909009', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `surah`
--

DROP TABLE IF EXISTS `surah`;
CREATE TABLE IF NOT EXISTS `surah` (
  `id_surah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_surah` varchar(100) NOT NULL,
  `juz` varchar(3) NOT NULL,
  `jumlah_ayat` int(11) NOT NULL,
  `awal` int(11) NOT NULL,
  `akhir` int(11) NOT NULL,
  PRIMARY KEY (`id_surah`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surah`
--

INSERT INTO `surah` (`id_surah`, `nama_surah`, `juz`, `jumlah_ayat`, `awal`, `akhir`) VALUES
(1, 'Al Fatihah', '1', 7, 1, 7),
(2, 'Al Baqarah', '1', 141, 1, 141),
(3, 'Al Baqarah', '2', 111, 142, 252),
(4, 'Al Baqarah', '3', 34, 253, 286),
(5, 'Ali \'Imran ', '3', 91, 1, 91),
(6, 'Ali \'Imran ', '4', 109, 92, 200),
(7, 'An Nisaa\'', '4', 23, 1, 23),
(8, 'An Nisaa\'', '5', 124, 24, 147),
(9, 'An Nisaa\'', '6', 29, 148, 176),
(10, 'Al Maidah', '6', 82, 1, 82),
(11, 'Al Maidah', '7', 38, 83, 120),
(12, 'Al An\'am', '7', 110, 1, 110),
(13, 'Al An\'am', '8', 55, 111, 165),
(14, 'Al A\'raf', '8', 87, 1, 87),
(15, 'Al A\'raf', '9', 119, 88, 206),
(16, 'Al Anfal', '9', 40, 1, 40),
(17, 'Al Anfal', '10', 35, 41, 75),
(18, 'At Taubah', '10', 93, 1, 93),
(19, 'At Taubah', '11', 36, 94, 129),
(20, 'Yunus', '11', 109, 1, 109),
(21, 'Huud', '11', 5, 1, 5),
(22, 'Huud', '12', 118, 6, 123),
(23, 'Yusuf', '12', 52, 1, 52),
(24, 'Yusuf', '13', 59, 53, 111),
(25, 'Ar Ra\'du', '13', 43, 1, 43),
(26, 'Ibrahim', '13', 52, 1, 52),
(27, 'Al Hijr', '14', 99, 1, 99),
(28, 'An Nahl', '14', 128, 1, 128),
(29, 'Al Israa\'', '15', 111, 1, 111),
(30, 'Al Kahfi', '15', 74, 1, 74),
(31, 'Al Kahfi', '16', 36, 75, 110),
(32, 'Maryam', '16', 98, 1, 98),
(33, 'Thaahaa', '16', 135, 1, 135),
(34, 'Al Anbiyaa', '17', 112, 1, 112),
(35, 'Al Hajj', '17', 78, 1, 78),
(36, 'Al Mu\'minun', '18', 118, 1, 118),
(37, 'An Nuur', '18', 64, 1, 64),
(38, 'Al Furqaan', '18', 20, 1, 20),
(39, 'Al Furqaan', '19', 57, 21, 77),
(40, 'Asy Syu\'ara', '19', 227, 1, 227),
(41, 'An Naml', '19', 55, 1, 55),
(42, 'An Naml', '20', 38, 56, 93),
(43, 'Al Qashash', '20', 88, 1, 88),
(44, 'Al \'Ankabut', '20', 44, 1, 44),
(45, 'Al \'Ankabut', '21', 25, 45, 69),
(46, 'Ar Ruum', '21', 60, 1, 60),
(47, 'Luqman', '21', 34, 1, 34),
(48, 'As Sajdah', '21', 30, 1, 30),
(49, 'Al Ahzab', '21', 30, 1, 30),
(50, 'Al Ahzab', '22', 43, 31, 73),
(51, 'Saba\'', '22', 54, 1, 54),
(52, 'Faathir', '22', 45, 1, 45),
(53, 'Yaa Siin', '22', 21, 1, 21),
(54, 'Yaa Siin', '23', 62, 22, 83),
(55, 'Ash Shaffat', '23', 182, 1, 182),
(56, 'Shaad', '23', 88, 1, 88),
(57, 'Az Zumar', '23', 31, 1, 31),
(58, 'Az Zumar', '24', 44, 32, 75),
(59, 'Al Ghaafir', '24', 85, 1, 85),
(60, 'Al Fushilat', '24', 46, 1, 46),
(61, 'Al Fushilat', '25', 8, 47, 54),
(62, 'Asy Syuura', '25', 53, 1, 53),
(63, 'Az Zukhruf', '25', 89, 1, 89),
(64, 'Ad Dukhaan', '25', 59, 1, 59),
(65, 'Al Jaatsiyah ', '25', 37, 1, 37),
(66, 'Al Ahqaaf', '26', 35, 1, 35),
(67, 'Muhammad', '26', 38, 1, 38),
(68, 'Al Fath', '26', 29, 1, 29),
(69, 'Al Hujuraat', '26', 18, 1, 18),
(70, 'Qaaf', '26', 45, 1, 45),
(71, 'Adz Dzaariyaat', '26', 30, 1, 30),
(72, 'Adz Dzaariyaat', '27', 30, 31, 60),
(73, 'Ath Thuur', '27', 49, 1, 49),
(74, 'An Najm', '27', 62, 1, 62),
(75, 'Al Qamar', '27', 55, 1, 55),
(76, 'Ar Rahmaan', '27', 78, 1, 78),
(77, 'Al Waaqi\'ah', '27', 96, 1, 96),
(78, 'Al Hadiid', '27', 29, 1, 29),
(79, 'Al Mujaadalah', '28', 22, 1, 22),
(80, 'Al Hasyr', '28', 24, 1, 24),
(81, 'Al Mumtahanah', '28', 13, 1, 13),
(82, 'Ash Shaff', '28', 14, 1, 14),
(83, 'Al Jumuah', '28', 11, 1, 11),
(84, 'Al Munafiqun', '28', 11, 1, 11),
(85, 'Ath Taghabun', '28', 18, 1, 18),
(86, 'Ath Thalaaq', '28', 12, 1, 12),
(87, 'At Tahrim', '28', 12, 1, 12),
(88, 'Al Mulk', '29', 30, 1, 30),
(89, 'Al Qalam', '29', 52, 1, 52),
(90, 'Al Haaqqah', '29', 52, 1, 52),
(91, 'Al Ma\'arij', '29', 44, 1, 44),
(92, 'Nuh', '29', 28, 1, 28),
(93, 'Al Jin', '29', 28, 1, 28),
(94, 'Al Muzammil', '29', 20, 1, 20),
(95, 'Al Muddastir', '29', 56, 1, 56),
(96, 'Al Qiyaamah', '29', 40, 1, 40),
(97, 'Al Insaan', '29', 31, 1, 31),
(98, 'Al Mursalaat', '29', 50, 1, 50),
(102, ' At-Takwir', '30', 29, 1, 29),
(103, ' Al-Infitar', '30', 19, 1, 19),
(104, ' Al-Tatfif', '30', 36, 1, 36),
(105, ' Al-Insyiqaq', '30', 25, 1, 25),
(106, ' Al-Buruj', '30', 22, 1, 22),
(107, ' At-Tariq', '30', 17, 1, 17),
(109, ' Al-Gasyiyah', '30', 26, 1, 26),
(110, ' Al-Fajr', '30', 30, 1, 30),
(111, ' Al-Balad', '30', 20, 1, 20),
(112, ' Asy-Syams', '30', 15, 1, 15),
(113, ' Al-Lail', '30', 21, 1, 21),
(114, ' Ad-Duha', '30', 11, 1, 11),
(115, ' Al-Insyirah', '30', 8, 1, 8),
(116, ' At-Tin', '30', 8, 1, 8),
(118, ' Al-Qadr', '30', 5, 1, 5),
(119, ' Al-Bayyinah', '30', 8, 1, 8),
(120, ' Az-Zalzalah', '30', 8, 1, 8),
(123, ' At-Takasur', '30', 8, 1, 8),
(125, ' Al-Humazah', '30', 9, 1, 9),
(126, ' Al-Fil', '30', 5, 1, 5),
(127, ' Quraisy', '30', 4, 1, 4),
(129, ' Al-Kausar', '30', 3, 1, 3),
(130, ' Al-Kafirun', '30', 6, 1, 6),
(131, ' An-Nasr', '30', 3, 1, 3),
(132, ' Al-Lahab', '30', 5, 1, 5),
(133, ' Al-Ikhlas', '30', 4, 1, 4),
(134, ' Al-Falaq', '30', 5, 1, 5),
(135, ' An-Nas', '30', 6, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_data` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `role` enum('Admin','Pengajar','Santri','Pemilik') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_data`, `username`, `password`, `telp`, `role`) VALUES
(1, NULL, 'admin', '$2y$10$qFaN8vznbBF1BWwjsdQEFuNctKkI44ocicm6EXJo46UgO4uT3cF8G', '123', 'Admin'),
(9, 14, 'P20130014', '$2y$10$TwpWCihuuMUNdRS5o/m64uMUNi3jWKhlxfxX9dx3m0msrVuTABbwO', '086789890990', 'Pengajar'),
(13, 17, 'P20170017', '$2y$10$lP3Ll0o9bJsr1wTd329zAeodyFFPIdgwqXE380zTE.w6gOfp1Rq76', '1234567890', 'Pengajar'),
(14, 18, 'P20170018', '$2y$10$.AILM/jIFq2EfjV43dp10OsS4.DwwfydAww14ok1h66vq7QPS/UMq', '1234567890', 'Pengajar'),
(15, 19, 'P20180019', '$2y$10$gTCQdVQI7gkFEStJEEI6m.9AJm777J6N2y6pRnXdCEeGPa9weFITi', '1234567890', 'Pengajar'),
(16, 20, 'P20180020', '$2y$10$tEPS5tJYWt3DX.rX3LWMTO6vB73kbi.yG8NnFBO/CyZt.bHXtQpcW', '1234567890', 'Pengajar'),
(17, 21, 'P20190021', '$2y$10$d4GHLz9EXPtruj6SPre.COfqixhz6YQLbgn7KAkKXgfI//cFhsMwC', '1234567890', 'Pengajar'),
(19, 23, 'P20200023', '$2y$10$HPmlyyER6jt2K2ZrQuzVy.tK2OqdCcbTrjG4hh7Ebm2wYEu7L8de2', '1234567890', 'Pengajar'),
(20, 24, 'P20200024', '$2y$10$vAh5GykUGUvIUF.trzmDkeHWcF2M1R7uUi4a3snJ11eGvWG1NikLC', '082678988970', 'Pengajar'),
(26, 25, 'P20160025', '$2y$10$WVz2bniY8RowuOGCAZCkDe8EExLz0BUom8zDvYCSUEPb8Ghc4x6Yu', '089090890989', 'Pengajar'),
(27, 44, 'S210044', '$2y$10$NthmXRtuJozpfmZevYJZMuWQnsfPf3ZDKpYd4VDNsgb542dGWM3My', '085356085641', 'Santri'),
(28, 45, 'S210045', '$2y$10$DqCLX4qWKx5j61FmWcCB.OTC9yFvw9Rb8qQ5aYs9q2.05MLqzMG.y', '085364200310', 'Santri'),
(29, 46, 'S210046', '$2y$10$i2w2wzGcWaCZcrCjWQ9Ywekvy79hTmV5pIWqJDQgEXRwfg0cwuLcm', '081261877921', 'Santri'),
(30, 47, 'S210047', '$2y$10$SRuvIjaajpQvJ2JOm9TBpeug/NGZGvLio65z4FZ4RZQJurdzsb//C', '081363121518', 'Santri'),
(34, NULL, 'pemilik1', '$2y$10$AmITQgkzIvouVMCvl6teWe0rBN6rxng0KR4YFg/r/2Jm/RsmdIBpG', '089898987889', 'Pemilik'),
(35, 49, 'S210049', '$2y$10$hsvZVFqMb7jH2POf.IckFeR2RsICMbmP3vnPsE5KedwfJ6S7Vs1c.', '085263330354', 'Santri'),
(36, 50, 'S210050', '$2y$10$IzNka2y37m2rw7dJbOQET.GxCOsCclUEm8iEQJ6FDCnYbMq.dXgUi', '082386824749', 'Santri'),
(37, 51, 'S210051', '$2y$10$6TlXHTf0zZjqnh9apuSRXOZxAj.pB6gIv64sOsmkypa/HoV4CQ/Ri', '085835285048', 'Santri'),
(38, 52, 'S210052', '$2y$10$RwX3xKq.CNB0e.2F2qDnfebw5eMJkJBbe.l1eDvP75Ifq.XTgXBka', '085835285048', 'Santri'),
(39, 53, 'S210053', '$2y$10$X54xvR0Nncna5vKQvmWYU.cqOoT0Pz6YRDH8sR.KLzj8PtXECJqla', '085265055861', 'Santri'),
(40, 54, 'S210054', '$2y$10$yLqcjUISHj4ubCJSu4i.JOZ0r5LdBnl/2JI6lK8iICfIEvg7WfhZi', '085263402158', 'Santri'),
(41, 55, 'S210055', '$2y$10$vR3Kl37meRdarncshHVxX.RngwKxAi.4VgvvknNcKS7/ZDUpIMk3K', '082162002232', 'Santri'),
(42, 56, 'S210056', '$2y$10$3ggLfct4CnalclJlzNJjDOc8G4mFX7nN8EKA.RfjJsO1QLE84qXm6', NULL, 'Santri'),
(43, 57, 'S210057', '$2y$10$PZQh7Lm/vesJfWjxd.bNA.fhG9GvTzW7cyNS87dfM4lF3cS38t6i6', NULL, 'Santri'),
(44, 58, 'S210058', '$2y$10$0fa6el0nEPTchYSQfjOTxeAaeYsiFE7XqRHaiVbbuwOz2Ymr3aofy', '082389562425', 'Santri'),
(45, 59, 'S210059', '$2y$10$pynuOuf.Vr4nXk1Aa4zJm.5oVbs/9Un9YAo86FD/mBRvf7E.3fdUa', '081364457481', 'Santri'),
(46, 60, 'S210060', '$2y$10$OvlMM1ArODyvsMveexqIweLet6wP25tFD.7hem10dmDk/jtSjORci', '085263113764', 'Santri'),
(47, 61, 'S210061', '$2y$10$ounWzyA3xHSoLryOHf20duLBL.FPG.47.sWQEscaFoWfp3yaEzsEu', '085263594002', 'Santri'),
(48, 62, 'S210062', '$2y$10$FMl1mqFElGmlq/d0HWSKqem2X6.TG4.cva/SBFl.q6AV2vAQyqxu6', '085263365943', 'Santri'),
(49, 63, 'S210063', '$2y$10$cvSHuG47iUkYK//qHcVbOuSOpAq8dEjSUrvJo/XUlrOtDyzctQRSa', '081275956411', 'Santri'),
(50, 64, 'S210064', '$2y$10$W2T01xDEM3mx/urO7KRyDuTDAQeGMiNtoTqRdcqPuZZoe0wz.QSgK', '081270201579', 'Santri'),
(51, 65, 'S210065', '$2y$10$XWkt6wq8Diy1g52ZR4Bg1ObxINoGYDv6cAmVLsbY4uxL/U5AfM2zW', '081363289235', 'Santri'),
(52, 66, 'S210066', '$2y$10$KaLxC4kRUwoj24WyFIiIvOjhI55wGu28HhBD.6SpaXsOzDZFxDINq', '08128776744', 'Santri'),
(53, 67, 'S210067', '$2y$10$8RNdVRdLTez8Hl4IbCF1ZeBLhZaQQ0ebL.8rYyferXA1XVAL1Q13m', '082268777420', 'Santri'),
(54, 68, 'S210068', '$2y$10$653xUIMszSR/IQcpWQRzxusHs4aDWRHahTlKa7B6yiUoTzVqH.9uq', NULL, 'Santri'),
(55, 69, 'S210069', '$2y$10$P9jgcJ/Jztl12GvrQNQk1.e/.27OppHzmv/F3gFdEN5.CpmF4EDQO', NULL, 'Santri'),
(56, 70, 'S210070', '$2y$10$s1z3WjZLYw3xR5M7HB1zcu6BAIGyMh7Qjf01NKX.//XDVf.ZmyB2C', NULL, 'Santri'),
(57, 71, 'S210071', '$2y$10$WN.HBZPze8u9Nhh4/OrT/.SyphOEPb2F6nse5vCJ0bWd3/tD7Hbz.', NULL, 'Santri'),
(58, 72, 'S210072', '$2y$10$LP2BdAhxoSA2MFuaHUO61uVIes7Lr86hnn9U1HTP9Bk8nqxwuB.Py', NULL, 'Santri'),
(59, 73, 'S210073', '$2y$10$U6fKOUbus.o/jbaee.MfiOq.lw1kwtLfw53HKktgL0gvWv.bruAey', NULL, 'Santri'),
(60, 74, 'S210074', '$2y$10$szv13VYMZhdCYwFjyNrMxOF7Hxz.WY63v9wcBKo9fKqM1ZT71zVxC', NULL, 'Santri'),
(61, 75, 'S210075', '$2y$10$bb4rU8xTakPxaWG4wcj4G.13bbyTGqJILVqvxuHrbBKsvNAp8nIw.', NULL, 'Santri'),
(62, 76, 'S210076', '$2y$10$1qXHb88cWzfX2mc1G2uB3.M3.ASAsg.l2T4SIEPHMiDZ4XCemrnM6', NULL, 'Santri'),
(63, 77, 'S210077', '$2y$10$TnMKxoSXoU1kr2yPZftERO3wl.dKjoQQ3PbtXiRU8vSSKaF2LAV4e', NULL, 'Santri'),
(64, 78, 'S210078', '$2y$10$6bt12AGz65oS.5nH8FB21u0VUa9u.8.opxC.darvo8HX6G0y9DAbO', '098888888888888', 'Santri'),
(71, 29, 'P20190029', '$2y$10$7B0HFXOLEH.Yo6b/JaWhPexM0OzEH4N7dzYqslVhm8frQQe1RirXa', '0989898298392389', 'Pengajar'),
(84, NULL, 'admin1', '$2y$10$olOX0HJ6rXmeK31V/lECv.a.wFhBH0GHy0Z1QHRvVue2eRZGzzhzm', '0897987987878', 'Admin'),
(85, NULL, 'owner', '$2y$10$Rk/J.JGFJdkZJPgdUhxok.zRB/laIWqo1WVrvMsiecVsiYjy00kmS', '082290909090', 'Pemilik'),
(89, NULL, 'adminrtsq', '$2y$10$rqx0xhsEqOIRxFYLzBwwIubuucZJR8Av92AHVatSsqPhHu29YSoxm', '087898678998', 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absenpengajar`
--
ALTER TABLE `absenpengajar`
  ADD CONSTRAINT `absen` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`),
  ADD CONSTRAINT `kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `hafalan`
--
ALTER TABLE `hafalan`
  ADD CONSTRAINT `santrihaf` FOREIGN KEY (`id_santri`) REFERENCES `santri` (`id_santri`),
  ADD CONSTRAINT `surahhaf` FOREIGN KEY (`id_surah`) REFERENCES `surah` (`id_surah`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `pengajar_kelas` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`);

--
-- Constraints for table `kelassantri`
--
ALTER TABLE `kelassantri`
  ADD CONSTRAINT `idkelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `idsantri` FOREIGN KEY (`id_santri`) REFERENCES `santri` (`id_santri`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
