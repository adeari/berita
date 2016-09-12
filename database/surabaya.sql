-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2016 at 10:12 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
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
-- Table structure for table `tbberita`
--

DROP TABLE IF EXISTS `tbberita`;
CREATE TABLE `tbberita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori` varchar(30) NOT NULL,
  `filename` text,
  `useridinput` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbberita`
--

INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(1, 'bersama', 'kita', '2016-09-08 07:33:31', '2016-09-08 07:33:31', 'Umum', NULL, 6);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(2, 'ada', 'acara', '2016-09-08 07:45:54', '2016-09-08 07:45:54', 'Acara', NULL, 6);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(3, 'adukan ', 'lebih dulu', '2016-09-08 07:46:09', '2016-09-08 07:46:09', 'Pengaduan', NULL, 6);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(6, 'ya', 'ada', '2016-09-08 09:07:07', '2016-09-08 09:07:07', '9', 'andr_iw12moh4.png', 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(7, 'a', 's', '2016-09-08 09:10:27', '2016-09-08 09:10:27', '9', NULL, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(8, 's', 'a', '2016-09-08 09:12:41', '2016-09-08 09:12:41', '9', NULL, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(9, 'a', 's', '2016-09-08 09:13:36', '2016-09-08 09:13:36', '9', NULL, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(10, 'a', 's', '2016-09-08 09:20:49', '2016-09-08 09:20:49', '9', NULL, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(11, 'a', 'a', '2016-09-08 09:21:18', '2016-09-08 09:21:18', '9', NULL, 0);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(12, 'ada dia', 'kahn bener', '2016-09-11 00:44:55', '2016-09-10 17:44:55', 'Acara', NULL, 9);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(13, 'roindaba1 1', 'adukan  1', '2016-09-11 00:46:08', '2016-09-10 17:46:08', 'Pengaduan', NULL, 9);
INSERT INTO `tbberita` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`, `kategori`, `filename`, `useridinput`) VALUES(15, 'permudah', 'urusannya', '2016-09-11 02:37:12', '2016-09-10 19:51:56', 'Umum', 'andr_x4hafkam.png', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbkomentar`
--

DROP TABLE IF EXISTS `tbkomentar`;
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

INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(1, '2016-09-10 19:48:14', '2016-09-10 19:48:14', 'tyui', NULL, 9, 13);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(2, '2016-09-10 19:52:08', '2016-09-10 19:52:08', 'mencoba', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(3, '2016-09-10 19:58:05', '2016-09-10 19:58:05', 'beri satu', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(4, '2016-09-10 19:59:54', '2016-09-10 19:59:54', 'beri satu lagi', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(5, '2016-09-10 20:54:52', '2016-09-10 20:54:52', 'yui', 'andr_vxs4srf8.png', 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(6, '2016-09-10 21:30:14', '2016-09-10 21:30:14', 'retry', 'andr_bw4l01qc.png', 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(7, '2016-09-10 21:31:24', '2016-09-10 21:31:24', '', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(8, '2016-09-11 01:48:03', '2016-09-11 01:48:03', 'berada', NULL, 9, 13);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(9, '2016-09-11 01:48:16', '2016-09-11 01:48:16', 'kenpa', 'andr_7h9iqf6n.png', 9, 13);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(10, '2016-09-11 02:17:41', '2016-09-11 02:17:41', 'bagaikan', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(11, '2016-09-11 02:17:52', '2016-09-11 02:17:52', 'ad ajah', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(12, '2016-09-11 02:19:45', '2016-09-11 02:19:45', 'ya', NULL, 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(13, '2016-09-11 02:20:00', '2016-09-11 02:20:00', 'bisa', 'andr_knxz87mr.png', 9, 15);
INSERT INTO `tbkomentar` (`id`, `created_at`, `updated_at`, `komentar`, `gambar`, `useridinput`, `idberita`) VALUES(14, '2016-09-11 03:35:32', '2016-09-11 03:35:32', 'dan', NULL, 9, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
  `isadmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(1, 'a', '$2y$10$i/dRjfO8mBkSChRZzPQon.8gnkd5TbgtWM.bK29lyoLT3YCQ4EUoi', '$2y$10$HKGdP9kGdxHbROTguP8kwu5xT13pjhDIPiH/5qRPsgTPU5eM.v0FS', NULL, '2016-09-03 09:38:36', '2016-09-03 09:38:36', '', '$2y$10$mHNcd7j9X0fTy', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(2, 'sdsd', 'sdwe@sdffs.com', '$2y$10$CHgNcPdDvldkyCz3m/KUz.D/ot9yIxjLP4P2m5Gl9ThXPmIigt5oG', NULL, '2016-09-03 09:39:49', '2016-09-03 09:39:49', 's', 'sdsd', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(3, 'mmilka', 'mmilka@yo.net', '$2y$10$akRc3Nx/cbOmAtiGgxc2ReVKIGORdvDYAzIC3DNLB4K8OMnDjhsR6', NULL, '2016-09-03 09:57:07', '2016-09-03 09:57:07', 'mmilka', 'mmilka', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(4, 'mmilka1', 'mmilka1@yo.net', '$2y$10$aP8YLkeNMEzUxTonqiuL5uXCxyhw7yLBTnzSgR6JdtGaGsnyX/5vi', NULL, '2016-09-03 10:01:11', '2016-09-03 10:01:11', 'asdf1234', 'mmilka1', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(5, 'jikan1', 'jikan@yo.net', '$2y$10$w97AiWf3ApaPENpjkdQmMeeCBTHt2uEF0y1LzUq6A.6sHLU8DpUWq', '8zJQ4xLjh5XxhHHOTcTrppnEb8482hdYMdDyaKzJ6gxNegrttS6GEBva9PFW', '2016-09-03 10:36:59', '2016-09-03 10:05:29', 'jikan', 'jikan', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(6, 'rukan', 'rukan@yo.net', '$2y$10$5S0bjmvLlHpiFjh.yKb0xuShZNPhzRjloaleOA0Ie9WWDqIMA08YK', 'LhJRb44d78gTB4Sat1wI22LHyMy72KVJTD07lzLMOKapXaOra7LwjC0v94iA', '2016-09-08 07:06:26', '2016-09-03 10:37:30', 'rukan', 'rukan', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(7, 'leka', 'leka@yo.net', '$2y$10$.K.FGK0F4DYTfXbNWMFm8.HrHbJpIitVs0t3QcR8tENtMSxhCe3xe', NULL, '2016-09-04 07:45:47', '2016-09-04 07:45:47', 'leka', 'leka', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(8, 'mira', 'mira@yo.net', '$2y$10$Y202h9JO64cn8fEQrUZx8uFZ3Zyhh6/UVsfyP5tN67cPKZGUQazI2', NULL, '2016-09-04 07:52:52', '2016-09-04 07:52:52', 'mira', 'mira', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(9, 'indro', 'indro@yo.net', '$2y$10$QfRizcm10qfqfA4U003u2eHy7OfveSiQLO.Z/BMk.67ey0DDy0Zxq', NULL, '2016-09-08 08:30:38', '2016-09-08 08:30:38', 'indro', 'indro', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(10, 'lika', 'likato@y.com', '$2y$10$2lFd2hRNB.9OkMKtxjChleMkBaDBPGy9Dt7gMovkElQA0rOYrQvzy', NULL, '2016-09-11 18:34:01', '2016-09-11 18:34:01', 'likana', 'lika', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(11, 'helen', 'helen@yo.net', '$2y$10$qcYU9AfUEDheEOFVNhUG8uWsQp5zaFdujYEB6sAcP0bFzRd.sN1pO', NULL, '2016-09-11 19:41:23', '2016-09-11 19:41:23', 'helen', 'helen', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(12, 'dikan', '', '$2y$10$NrwDDXoO873CS0tUoWn8eezIw/Fh0NqEASs0WdeWnH7y.af86Asb6', NULL, '2016-09-11 19:44:13', '2016-09-11 19:44:13', 'dikan', 'dikan', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(13, 'deri', 'deri@y.net', '$2y$10$wEsVjP064Z/EGZIrcAFzSuukXooJw3oPf4DZOdv5XQgg3Wq.9V5iG', NULL, '2016-09-11 19:46:38', '2016-09-11 19:46:38', 'deri', 'deri', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(14, 'derio', 'derio@yo.newt', '$2y$10$K8n30U0P2o1koWQKDR1lLe3.tgf.ThBOeaZ4skjHsjiiXcAtce9bq', NULL, '2016-09-11 19:50:39', '2016-09-11 19:50:39', 'derio', 'derio', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(15, 'riska', 'riska@yo.net', '$2y$10$MjZvgTH3PXek/8aNfHteJ.ORAqVeRBoV8jWGNLFV.75ZPY2DVT.LC', NULL, '2016-09-11 19:51:52', '2016-09-11 19:51:52', 'riska', 'riska', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(16, 'rika', 'rika@yo.net', '$2y$10$OORdZsux3yLam7Tv5kKEMOkV67Z.2kOwDP6ssX3bjw7/G2tepO696', NULL, '2016-09-11 20:08:10', '2016-09-11 20:08:10', 'rika', 'rika', NULL, 0);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `updated_at`, `created_at`, `realpassword`, `nik`, `lastlogin`, `isadmin`) VALUES(17, 'rika1', 'rika1@yo.net', '$2y$10$leXavmiD/NOVZun/y.oAmea.KD0EM/QhunsJKGXZiwQfJ3uTmRulS', NULL, '2016-09-11 20:09:26', '2016-09-11 20:09:26', 'rika', 'rika1', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbberita`
--
ALTER TABLE `tbberita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
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
-- AUTO_INCREMENT for table `tbberita`
--
ALTER TABLE `tbberita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
