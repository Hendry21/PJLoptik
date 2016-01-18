-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2015 at 08:01 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `optik`
--
CREATE DATABASE IF NOT EXISTS `optik` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `optik`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) DEFAULT NULL,
  `harga_beli` int(10) DEFAULT NULL,
  `harga_jual` int(10) DEFAULT NULL,
  `nama_jenis` varchar(10) DEFAULT NULL,
  `ukuran` int(11) DEFAULT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `nama_jenis`, `ukuran`, `merk`, `stok`) VALUES
('BR150002', 'Vortu', 4000, 4000, '+', 8, 'Red buluk', 8),
('BR150000', 'Puma', 1000, 2000, '-', 5, 'Sundul Glass', 12),
('BR150001', 'Lens Optik (Plus)', 1000, 2000, '+', 5, 'Red buluk', 8),
('BR150003', 'Lens Optik ', 3000, 5000, '+', 5, 'Red buluk', 9),
('BR150004', 'Nike', 1000, 2000, '+', 5, 'Transfaran', 12),
('BR150005', 'Vorte', 500000, 600000, '+', 2, 'Red buluk', 8),
('BR150006', 'Vorto', 500000, 600000, '+', 5, 'Sundul Glass', 7),
('BR150007', 'fbdf', 4, 4, '-', 5, 'Sundul Glass', 4),
('BR150008', 'Nike', 500000, 600000, '-', 5, 'Sundul Glass', 5);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE IF NOT EXISTS `jenis` (
  `kd_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(10) DEFAULT NULL,
  `ukuran` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kd_jenis`, `nama_jenis`, `ukuran`) VALUES
(2, '-', 5),
(1, '-', 5),
(5, '+', 2),
(3, '+', 8),
(4, '-', 5),
(6, '+', 2);

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE IF NOT EXISTS `merk` (
  `kd_merk` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kd_merk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`kd_merk`, `merk`) VALUES
(1, 'Sundul Glass'),
(2, 'Red buluk'),
(4, 'Transfaran');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `kd_jual` varchar(8) NOT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `uang_bayar` int(12) DEFAULT NULL,
  PRIMARY KEY (`kd_jual`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kd_jual`, `tgl_penjualan`, `uang_bayar`) VALUES
('JL150006', '2015-05-26', 12000),
('JL150005', '2015-05-26', 12000),
('JL150004', '2015-05-26', 2000),
('JL150003', '2015-05-26', 2000),
('JL150002', '2015-05-26', 100000),
('JL150001', '2015-05-25', 60000),
('JL150007', '2015-05-26', 12000),
('JL150008', '2015-05-26', 12000),
('JL150009', '2015-05-26', 12000),
('JL150010', '2015-05-26', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_item`
--

CREATE TABLE IF NOT EXISTS `penjualan_item` (
  `kd_jual` varchar(8) NOT NULL,
  `kd_barang` varchar(8) DEFAULT NULL,
  `jumlah` int(12) DEFAULT NULL,
  `harga` int(12) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_item`
--

INSERT INTO `penjualan_item` (`kd_jual`, `kd_barang`, `jumlah`, `harga`) VALUES
('JL150001', 'BR150000', 1, 2000),
('JL150001', 'BR150001', 1, 2000),
('JL150001', 'BR150004', 1, 2000),
('JL150002', 'BR150000', 8, 2000),
('JL150002', 'BR150001', 8, 2000),
('JL150002', 'BR150002', 8, 4000),
('JL150002', 'BR150004', 8, 2000),
('JL150003', 'BR150004', 1, 2000),
('JL150005', 'BR150000', 5, 2000),
('JL150005', 'BR150004', 1, 2000),
('JL150006', 'BR150004', 1, 2000),
('JL150007', 'BR150004', 1, 2000),
('JL150009', 'BR150004', 1, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penjualan`
--

CREATE TABLE IF NOT EXISTS `tmp_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(8) CHARACTER SET latin1 NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `kd_user` varchar(6) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `nm_user`, `username`, `password`) VALUES
('USER00', 'Hendry Cahyana', 'admin', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
