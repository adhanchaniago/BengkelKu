-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 05:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(200) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `diskon` int(3) NOT NULL,
  `stok` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_jual`, `diskon`, `stok`) VALUES
('10', 'Ban ', 80000, 0, 0),
('07084323', 'knalpot', 200000, 0, 5),
('9', 'Spion', 61000, 0, 0),
('8', 'has cnmsa', 60000, 0, 4),
('13', 'Oli B5', 45000, 0, 24),
('7', 'Oli B6', 50000, 0, 9),
('5', 'nfsfn', 35000, 0, 11),
('4', 'Oli 89', 45000, 0, 3),
('3', 'Oli B4', 70000, 10, 2),
('1', 'Oli Top 1', 90000, 10, 2),
('2', 'Oli E2', 40000, 0, 24),
('11', 'sm dfjvnjfd', 60000, 0, 18),
('12', 'sjfbs sdfjbsk', 100000, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `jasaservice`
--

CREATE TABLE `jasaservice` (
  `kd_jasa` varchar(15) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jasaservice`
--

INSERT INTO `jasaservice` (`kd_jasa`, `nama_jasa`, `harga`, `diskon`) VALUES
('72814', 'Ganti Oli belakang dan depan', 7500, 10),
('24234', 'Service roda dua yang rusak', 67000, 10),
('76512', 'ganti spion', 20000, 0),
('761578', 'ganti ruji', 25000, 0),
('77777', 'ganti gigi', 30000, 10),
('1231', '30', 500000, 25),
('07084233', 'ganti knalpot', 45000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_invoice` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `namaPelanggan` varchar(225) NOT NULL,
  `no_polisi` varchar(12) NOT NULL,
  `totalharga` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_invoice`, `tanggal`, `namaPelanggan`, `no_polisi`, `totalharga`, `status`) VALUES
('77', '2019-05-04', '11', '11', 0, 1),
('54', '2019-05-04', 'ol', 'vf', 0, 1),
('07081617', '2019-05-07', 'ilya', 'BN 567 N', 206300, 0),
('24054645', '0000-00-00', 'alfred', '23456', 614000, 1),
('07013428', '2019-05-07', 'al', '231', 110300, 1),
('07084411', '2019-05-07', 'Al', 'BN 3636 N', 125300, 1),
('07080818', '2019-05-07', 'ali', 'N 77 K5', 130000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_item`
--

CREATE TABLE `transaksi_item` (
  `id` int(5) NOT NULL,
  `no_invoice` varchar(10) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `jenis_transaksi` varchar(1) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_item`
--

INSERT INTO `transaksi_item` (`id`, `no_invoice`, `kode`, `jenis_transaksi`, `jumlah`) VALUES
(174, '7081617', '24234', '1', 1),
(160, '7013428', '24234', '1', 1),
(159, '7013428', '7', '0', 1),
(175, '7081617', '76512', '1', 1),
(91, '54', '72814', '1', 1),
(92, '54', '24234', '1', 1),
(93, '54', '7', '0', 1),
(94, '77', '77777', '1', 1),
(96, '77', '2', '0', 2),
(166, '7014428', '13', '0', 1),
(165, '7014428', '1231', '1', 1),
(178, '7084411', '24234', '1', 1),
(179, '7084411', '76512', '1', 1),
(180, '7084411', '7084323', '0', 1),
(181, '7084411', '13', '0', 1),
(182, '24054645', '76512', '1', 1),
(183, '24054645', '77777', '1', 1),
(184, '24054645', '1', '0', 7),
(177, '7081617', '1', '0', 1),
(176, '7081617', '4', '0', 1),
(173, '7080818', '4', '0', 2),
(172, '7080818', '76512', '1', 1),
(171, '7080818', '76512', '1', 1);

--
-- Triggers `transaksi_item`
--
DELIMITER $$
CREATE TRIGGER `penambahan stok` AFTER DELETE ON `transaksi_item` FOR EACH ROW BEGIN 
	UPDATE barang set barang.stok = barang.stok + OLD.jumlah where barang.kd_barang = OLD.kode;
   END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengurangan stok` AFTER INSERT ON `transaksi_item` FOR EACH ROW BEGIN
	UPDATE barang SET barang.stok = barang.stok - new.jumlah WHERE barang.kd_barang = NEW.kode;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` enum('kasir','admin') NOT NULL DEFAULT 'kasir'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `password`, `nama`, `level`) VALUES
('admin', '123', 'Wahyu', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `jasaservice`
--
ALTER TABLE `jasaservice`
  ADD PRIMARY KEY (`kd_jasa`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indexes for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
