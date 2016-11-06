-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2016 at 04:47 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surabaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadminpesan`
--

CREATE TABLE `tbadminpesan` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `pesan` text NOT NULL,
  `userid` bigint(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbadminpesan`
--

INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(1, 'da', 'ada', 0, '2016-10-23 10:28:34', '2016-10-23 10:28:34');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(2, 'fere', 'sswwewe', 0, '2016-10-23 10:29:01', '2016-10-23 10:29:01');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(3, 'dert', 'rtyy', 0, '2016-10-23 10:34:36', '2016-10-23 10:34:36');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(4, 'ya', 'bagaimana', 3, '2016-10-26 23:06:46', '2016-10-26 23:06:46');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(5, 't', 'y', 3, '2016-10-26 23:07:08', '2016-10-26 23:07:08');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(6, 'aaa', 'sdsd', 3, '2016-10-26 23:09:55', '2016-10-26 23:09:55');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(7, 'ss', 'dfdf', 3, '2016-10-26 23:12:49', '2016-10-26 23:12:49');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(8, 'yaa ngapain', 'ada', 2, '2016-10-30 11:11:12', '2016-10-30 11:11:12');
INSERT INTO `tbadminpesan` (`id`, `judul`, `pesan`, `userid`, `updated_at`, `created_at`) VALUES(9, 'baru ya', 'iya', 2, '2016-10-30 11:11:19', '2016-10-30 11:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbberita`
--

CREATE TABLE `tbberita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori` varchar(30) NOT NULL,
  `filename` text,
  `useridinput` bigint(20) NOT NULL,
  `jumlah_komentar` int(11) NOT NULL DEFAULT '0',
  `jumlah_share` int(11) NOT NULL DEFAULT '0',
  `populer` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbberita`
--

INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(26, 'bersama', 'ada dia', '2016-10-21 22:03:13', '2016-10-21 22:18:13', 'Umum', 'download.jpg', 2, 1, 0, 1);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(28, 'kalau bisa begitu ', 'kenaap ndak begini', '2016-10-21 22:03:38', '2016-10-22 19:53:37', 'Umum', NULL, 2, 0, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(32, 'berita ', 'dasaty', '2016-10-01 22:04:37', '2016-10-02 11:31:36', 'Umum', NULL, 2, 2, 2, 1);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(34, 'kalauun ada', 'ada apa ya di sana', '2016-10-21 22:05:10', '2016-10-21 22:05:10', 'Umum', NULL, 2, 0, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(36, 'sebentar', 'ada daaaadatang dan', '2015-10-14 22:05:40', '2015-10-21 22:05:40', 'Acara', NULL, 2, 0, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(38, 'jadi', 'bisa jadi bisa enggak', '2016-10-21 22:06:25', '2016-10-21 22:06:25', 'Pengaduan', NULL, 2, 3, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(42, 'ada bersama', 'bukan dia', '2016-10-22 21:59:31', '2016-10-22 21:59:31', 'Acara', NULL, 5, 0, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(43, 'bari aua 4', 'ada berita', '2016-10-23 02:13:06', '2016-10-23 02:13:17', 'Umum', NULL, 3, 1, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(44, 'ada kah dia', 'ya ada', '2016-10-23 03:20:11', '2016-10-23 03:20:11', 'Acara', NULL, 3, 0, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(45, 'ahsan', 'dadaada<div>dfdfdfdferer</div><div>rtryrtrerwerwewe</div><div>ada ajaj</div><div><br></div>', '2016-10-28 22:17:21', '2016-10-28 22:17:21', 'Umum', 'download61zxb9.jpg', 3, 0, 0, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`, `jumlah_komentar`, `jumlah_share`, `populer`) VALUES(46, 'berada', 'adas dsd sd', '2016-10-29 14:30:09', '2016-10-29 14:30:09', 'Acara', 'buku2ubnn5p.jpeg', 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbbroadcastpesan`
--

CREATE TABLE `tbbroadcastpesan` (
  `pesan` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbbroadcastpesan`
--

INSERT INTO `tbbroadcastpesan` (`pesan`, `updated_at`, `created_at`, `id`) VALUES('&nbsp;ada aaua rtuuii ssss dddd bbbbb fdfdfg hhhhhhhhhh<div>dfdfd</div><div>fd</div><div>f</div><div>df</div><div>d</div><div>fswww ad sadsdsf</div>', '2016-10-28 22:14:12', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbkomentar`
--

CREATE TABLE `tbkomentar` (
  `id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `komentar` varchar(200) NOT NULL,
  `gambar` varchar(250) DEFAULT NULL,
  `useridinput` bigint(20) NOT NULL,
  `idberita` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbkomentar`
--

INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(28, '2016-10-21 22:37:16', '2016-10-21 22:37:16', 'ada nih', NULL, 2, 38);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(29, '2016-10-21 22:37:22', '2016-10-21 22:37:22', 'berapaan', NULL, 2, 38);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(30, '2016-10-21 22:37:33', '2016-10-21 22:37:33', 'yaa', 'downloaddp8omo.jpg', 2, 38);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(36, '2016-10-22 03:16:37', '2016-10-22 03:16:37', 'baru ada', NULL, 2, 32);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(37, '2016-10-22 03:17:08', '2016-10-22 03:17:08', 'baru', NULL, 2, 32);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(38, '2016-10-23 02:13:26', '2016-10-23 02:13:26', 'namha 1', NULL, 3, 43);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(39, '2016-10-29 14:24:27', '2016-10-29 14:26:24', 'yaa mengapa ada', 'dsfdetet6i68qn.jpg', 2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tblokasi`
--

CREATE TABLE `tblokasi` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `langitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblokasi`
--

INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(1, 0, '-7.33432572', '112.6365496', '2016-09-24 17:16:49', '2016-09-24 17:16:49');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(2, 0, '-7.33432572', '112.6365496', '2016-09-24 17:16:53', '2016-09-24 17:16:53');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(3, 0, '-7.33440339', '112.6363331', '2016-09-24 17:25:52', '2016-09-24 17:25:52');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(4, 0, '-7.33437121', '112.63638114', '2016-09-24 17:26:51', '2016-09-24 17:26:51');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(5, 0, '-7.33437028', '112.63638184', '2016-09-24 17:28:14', '2016-09-24 17:28:14');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(6, 0, '-7.33437028', '112.63638184', '2016-09-24 17:28:19', '2016-09-24 17:28:19');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(7, 0, '-7.33437028', '112.63638184', '2016-09-24 17:28:28', '2016-09-24 17:28:28');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(8, 1, '-7.33433202', '112.63640174', '2016-09-24 17:29:28', '2016-09-24 17:29:28');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(9, 1, '-7.33436639', '112.63626161', '2016-09-24 17:37:32', '2016-09-24 17:37:32');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(10, 1, '-7.33420343', '112.63647143', '2016-09-24 17:38:18', '2016-09-24 17:38:18');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(11, 1, '-7.3341152', '112.6367325', '2016-09-24 17:40:38', '2016-09-24 17:40:38');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(12, 1, '-7.33435449', '112.63627271', '2016-09-24 17:42:31', '2016-09-24 17:42:31');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(13, 1, '-7.33435449', '112.63627271', '2016-09-24 17:43:31', '2016-09-24 17:43:31');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(14, 1, '-7.33435449', '112.63627271', '2016-09-24 17:44:32', '2016-09-24 17:44:32');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(15, 1, '-7.33435449', '112.63627271', '2016-09-24 17:45:36', '2016-09-24 17:45:36');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(16, 1, '-7.33435449', '112.63627271', '2016-09-24 17:46:54', '2016-09-24 17:46:54');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(17, 1, '-7.33435449', '112.63627271', '2016-09-24 17:48:07', '2016-09-24 17:48:07');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(18, 1, '-7.33435449', '112.63627271', '2016-09-24 17:49:20', '2016-09-24 17:49:20');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(19, 1, '-7.33435449', '112.63627271', '2016-09-24 17:50:22', '2016-09-24 17:50:22');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(20, 1, '-7.33435449', '112.63627271', '2016-09-24 17:51:22', '2016-09-24 17:51:22');
INSERT INTO `tblokasi` (`id`, `userid`, `langitude`, `longitude`, `created_at`, `updated_at`) VALUES(21, 1, '-7.33435449', '112.63627271', '2016-09-24 17:52:37', '2016-09-24 17:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbpesancustomer`
--

CREATE TABLE `tbpesancustomer` (
  `id` int(11) NOT NULL,
  `emailcustomer` varchar(250) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `pesan` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `judulbalasan` varchar(250) DEFAULT NULL,
  `pesanbalasan` text,
  `tanggalbalasan` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbpesancustomer`
--

INSERT INTO `tbpesancustomer` (`id`, `emailcustomer`, `judul`, `pesan`, `updated_at`, `created_at`, `judulbalasan`, `pesanbalasan`, `tanggalbalasan`) VALUES(4, 'konin@yo.net', 'kan ada kenapa', 'ada yaa ya ada ajah', '2016-10-30 04:07:39', '2016-10-30 04:07:39', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `remember_token` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `realpassword` varchar(200) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `lastlogin` timestamp NULL DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `gambar` text NOT NULL,
  `jumlah_berita` int(11) NOT NULL DEFAULT '0',
  `jumlah_komentar` int(11) NOT NULL DEFAULT '0',
  `jumlah_share` int(11) NOT NULL DEFAULT '0',
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(1, 'ade', 'jio@Y.NET', '$2y$10$beswiWLl/1kaXYkFtMfQHOtIidPsZGr.KSjqJeDj8gUZilZi62eYK', NULL, '2016-09-28 17:32:45', '2016-09-23 21:28:16', '', 'ade123', '2016-09-29 00:32:45', 0, 'ade kan', 'andr_g6sjvw9r.jpg', 0, 0, 0, 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(2, 'ari', 'mika62@yo.net', '$2y$10$WGuS7OSe3P0.USmDOUiWHOIefUZ.JDPQBugXo45/ggTXz58VcSPpi', 'tJEOn2ANjqpmzStfxH3csDUQOuGkLH9pUYGK8bhd8nsDEfVEWO9pzrQCHnKr', '2016-11-04 05:11:09', '2016-09-23 21:58:30', 'ari', 'mmika1', '2016-11-04 12:10:33', 0, 'nama kua', 'buku2kxg42a.jpeg', 7, 6, 1, 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(3, 'deri', 'deri@yo.net', '$2y$10$2ByXkWyD2iMYC9OrfWdwQuvZuJ4T2G6TjOwY5gzZIf7DUNS9C1C/q', 'SiuMGla2joHBttJgS4BY9cjQjYXJ3i2Zp0ES67QSdJ9MRjUmD3WV7utpHh5z', '2016-10-28 22:19:19', '2016-09-29 16:20:51', '1234', 'deri', '2016-10-29 05:18:51', 0, 'deri', '', 3, 1, 0, 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(4, 'widi', 'widi3@yo.net', '$2y$10$eh.hDGus8Jh7XJ.Ed/hCyemuN8LBBzL69ddfY/Zj1prhcPpOEKsye', '3VoA9yrom3cAM5mFhqsyGQ5pa9Wt1cYDmGzzCVBLwrRQGwjv9CQhlO3RomiJ', '2016-10-26 16:46:35', '2016-09-30 19:31:24', 'widi', '3wi2di1', '2016-10-03 23:51:40', 0, 'widi2152', 'dsfdetet.jpg', 0, 0, 0, 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(5, 'dikan', 'dikan@yo.net', '$2y$10$pFpw6Ua9Qw7gdcIcQwZfi.YQ4rwPFkd.N/sUd4xRjSRNeHkeOP/Ii', 'tXKbXg6EmULYyajl3v3ZE2rop8XIo2LWUaTAwEbwv472NPADjPdDUjMu6Ssf', '2016-10-26 16:46:35', '2016-10-03 16:59:29', 'dikan12', 'dikan', '2016-10-23 04:59:31', 0, 'dikan', '', 1, 0, 0, 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(8, 'admin', 'cek@yaya.com', '$2y$10$Hu8ciBEEbJYb/8dAf.TV1ur4SOjLHp3iP6JG562W2ok/e3cAqlXfW', 'm4joXNsLn5O3r6YlI8Jlmmj0vzPCvZaEPCoEGC08tC6d3oVtGWPbrboFMYDs', '2016-11-04 05:22:32', '2016-10-12 17:18:03', 'asdf1234', '0', NULL, 1, 'Admin', '', 0, 0, 0, 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`, `name`, `gambar`, `jumlah_berita`, `jumlah_komentar`, `jumlah_share`, `aktif`) VALUES(9, 'mmika', 'mika@yo.net', '$2y$10$TsaLdzNBJWE1uNj3Euc6A.Si7Oxb1pR2kcoCeorYQ2YzTB7xAOrIm', NULL, '2016-10-29 00:25:22', '2016-10-29 00:25:22', 'mika', 'mmika', NULL, 0, 'mmika', '', 0, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadminpesan`
--
ALTER TABLE `tbadminpesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbberita`
--
ALTER TABLE `tbberita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbbroadcastpesan`
--
ALTER TABLE `tbbroadcastpesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblokasi`
--
ALTER TABLE `tblokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpesancustomer`
--
ALTER TABLE `tbpesancustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadminpesan`
--
ALTER TABLE `tbadminpesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbberita`
--
ALTER TABLE `tbberita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tbbroadcastpesan`
--
ALTER TABLE `tbbroadcastpesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tblokasi`
--
ALTER TABLE `tblokasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbpesancustomer`
--
ALTER TABLE `tbpesancustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
