-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2022 at 04:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-library2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `adminid` varchar(16) NOT NULL,
  `pasw` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `adminid`, `pasw`) VALUES
(44, 'alief', 'aliefanugerah03@gmail.com', 'alief', '1234'),
(45, 'admin Ganteng', 'admin@gmail.com', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `idagt` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `t4lahir` varchar(40) NOT NULL,
  `tglhr` date NOT NULL,
  `jkel` varchar(11) NOT NULL,
  `alamat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `idagt`, `nama`, `password`, `t4lahir`, `tglhr`, `jkel`, `alamat`) VALUES
(13, 'ali4', 'Alipo', '123', 'Makassar', '2001-09-03', 'Laki-Laki', 'Bontonompo'),
(14, 'user', 'user Jelek', 'user', 'Makassar', '2019-07-17', 'Laki-Laki', 'TPA');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `kdbuku` varchar(15) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `idpeng` int(11) NOT NULL,
  `idpen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kdbuku`, `judul`, `tahun`, `jumlah`, `idpeng`, `idpen`) VALUES
(24, 'CBK', 'Cinta Bunga Kembang', '2001', 4, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kembali`
--

CREATE TABLE `kembali` (
  `id` int(11) NOT NULL,
  `idagt` varchar(10) NOT NULL,
  `kdbuku` varchar(10) NOT NULL,
  `tglp` date NOT NULL,
  `tglhk` date NOT NULL,
  `tglk` date NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `idpen` int(11) NOT NULL,
  `penerbit` varchar(40) NOT NULL,
  `alamat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`idpen`, `penerbit`, `alamat`) VALUES
(8, 'Bahar', 'Antang');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `idpeng` int(11) NOT NULL,
  `nm_pengarang` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`idpeng`, `nm_pengarang`) VALUES
(9, 'bahar');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(11) NOT NULL,
  `idagt` varchar(10) NOT NULL,
  `kdbuku` varchar(10) NOT NULL,
  `tglp` date NOT NULL,
  `tglhk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id`, `idagt`, `kdbuku`, `tglp`, `tglhk`) VALUES
(42, 'ali4', 'CBK', '2022-05-29', '2022-06-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`adminid`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idagt` (`idagt`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kdbuku` (`kdbuku`),
  ADD KEY `idpen` (`idpen`),
  ADD KEY `idpeng` (`idpeng`);

--
-- Indexes for table `kembali`
--
ALTER TABLE `kembali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kembali_ibfk_1` (`idagt`),
  ADD KEY `kdbuku` (`kdbuku`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`idpen`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`idpeng`),
  ADD KEY `idpeng` (`idpeng`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjam_ibfk_1` (`idagt`),
  ADD KEY `pinjam_ibfk_2` (`kdbuku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kembali`
--
ALTER TABLE `kembali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `idpen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `idpeng` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`idpen`) REFERENCES `penerbit` (`idpen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`idpeng`) REFERENCES `pengarang` (`idpeng`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kembali`
--
ALTER TABLE `kembali`
  ADD CONSTRAINT `kembali_ibfk_1` FOREIGN KEY (`idagt`) REFERENCES `anggota` (`idagt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kembali_ibfk_2` FOREIGN KEY (`kdbuku`) REFERENCES `buku` (`kdbuku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`idagt`) REFERENCES `anggota` (`idagt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjam_ibfk_2` FOREIGN KEY (`kdbuku`) REFERENCES `buku` (`kdbuku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
