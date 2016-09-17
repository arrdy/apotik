-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2016 at 06:59 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
('AD-0000001', 'Ninik', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `det_pembelian`
--

CREATE TABLE IF NOT EXISTS `det_pembelian` (
  `id_det_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(10) NOT NULL,
  `kd_obat` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  PRIMARY KEY (`id_det_pembelian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `det_pembelian`
--

INSERT INTO `det_pembelian` (`id_det_pembelian`, `faktur`, `kd_obat`, `harga`, `jumlah`, `tgl_kadaluarsa`) VALUES
(6, 'FK-0000006', 'OB-0000004', 4000, 2, '2014-08-13'),
(7, 'FK-0000006', 'OB-0000005', 50000, 10, '2014-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `det_penjualan`
--

CREATE TABLE IF NOT EXISTS `det_penjualan` (
  `id_det_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `nota` varchar(10) NOT NULL,
  `kd_obat` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_det_penjualan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `det_penjualan`
--

INSERT INTO `det_penjualan` (`id_det_penjualan`, `nota`, `kd_obat`, `harga`, `jumlah`) VALUES
(11, 'TR-0000001', 'OB-0000004', 6000, 2),
(12, 'TR-0000002', 'OB-0000005', 7500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `username`, `password`) VALUES
('KR-0000001', 'Ardy', 'karyawan1', '123'),
('KR-0000002', 'Riadi', 'karyawan2', '123');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('KT-0000001', 'Obat Batuk dan pilek'),
('KT-0000002', 'Obat kulit'),
('KT-0000003', 'Obat asma');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE IF NOT EXISTS `obat` (
  `kd_obat` varchar(10) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `id_satuan` varchar(10) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `nama_obat` varchar(40) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`kd_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kd_obat`, `id_kategori`, `id_satuan`, `jenis`, `nama_obat`, `harga`) VALUES
('OB-0000002', 'KT-0000002', 'ST-0000002', '10 tablet', 'Mycoral', 4500),
('OB-0000003', 'KT-0000001', 'ST-0000001', '12 ml', 'Komik', 1500),
('OB-0000004', 'KT-0000001', 'ST-0000002', '6 Tablet', 'Panadol', 3000),
('OB-0000005', 'KT-0000002', 'ST-0000003', 'Botol salep', 'Geliga', 7500);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` varchar(10) NOT NULL,
  `faktur` varchar(10) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `faktur`, `id_karyawan`, `tgl`, `jumlah`) VALUES
('PB-0000001', 'FK-0000006', 'KR-0000001', '2015-08-10', 2000),
('PB-0000002', 'FK-0000006', 'KR-0000001', '2016-08-14', 52000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `faktur` varchar(10) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `id_suplier` varchar(10) NOT NULL,
  PRIMARY KEY (`faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`faktur`, `id_karyawan`, `tgl`, `id_suplier`) VALUES
('FK-0000006', 'KR-0000001', '2016-08-13', 'SP-0000001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `nota` varchar(10) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`nota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nota`, `id_karyawan`, `tgl`) VALUES
('TR-0000001', 'KR-0000001', '2016-08-14'),
('TR-0000002', 'KR-0000001', '2016-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE IF NOT EXISTS `satuan` (
  `id_satuan` varchar(10) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
('ST-0000001', 'Sachet'),
('ST-0000002', 'Tablet'),
('ST-0000003', 'Botol'),
('ST-0000004', 'Serbuk');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE IF NOT EXISTS `suplier` (
  `id_suplier` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama`, `alamat`, `no_hp`) VALUES
('SP-0000001', 'PT Prima', 'Jakarta ', '0899887667'),
('SP-0000002', 'Cv. Potenya', 'Jl Kebumen', '0989748430'),
('SP-0000003', 'PT. Jaya ', 'Jl yogyakarta', '08994875039');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
