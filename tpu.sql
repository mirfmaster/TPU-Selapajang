-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2018 at 05:03 PM
-- Server version: 10.2.16-MariaDB
-- PHP Version: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u436601698_tpu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `namaadmin` varchar(30) NOT NULL,
  `alamatadmin` text NOT NULL,
  `kontakadmin` varchar(25) NOT NULL,
  `emailadmin` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `auth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `namaadmin`, `alamatadmin`, `kontakadmin`, `emailadmin`, `password`, `auth`) VALUES
(1, 'Widi', 'Jl. Kedaung', '0812882181', 'mirfmaster@gmail.com', '1234', 2),
(2, 'Devi Darmawanti', 'Jl. Marsekal Suryadharma', '081287127124', 'admin@admin.com', '1234', 1),
(3, 'Dedi Yuri Hernawan, S.H, M. Si', 'csa', '412', 'admin2@gmail.com', '1234', 1),
(22, 'Muhamad Iqbal', 'Jl. Teladan Raya', '087887587287', 'iqbal@gmail.com', '123', 1),
(23, 'Zainal Aripin', 'Jl. Marsekal Suryadharma', '08128128', 'za@gmail.com', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blok`
--

CREATE TABLE `blok` (
  `idblok` int(11) NOT NULL,
  `namablok` varchar(20) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blok`
--

INSERT INTO `blok` (`idblok`, `namablok`, `keterangan`) VALUES
(1, 'A', 'Muslim'),
(2, 'B', 'Non-muslim'),
(3, 'C', 'Unused'),
(9, 'Memorial', 'Korban tragedi krisis moneter ');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `idklien` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`idklien`, `nama`, `alamat`, `kontak`, `email`, `password`) VALUES
(1, 'Muhamad Iqbal', 'Jl. Tenggara Timur', '08218418248', 'mirfmaster@gmail.com', '123'),
(2, 'Marina Pratiwi', 'Jl. Perkutut', '8012804081', 'mp@gmail.com', '123'),
(3, 'Billy', 'Jl.Nusa Tenggara', '0812013212', 'dummy@gmail.com', '1234'),
(4, 'Azriel', 'Jl. Kutilang', '08128218182', 'dummy2@gmail.com', '1234'),
(9, 'Iqbalee', 'Jl. Perkutut Raya', '0812841824', 'bale@gmail.com', '123'),
(10, 'Davis', 'Jl. Perkutut', '08128128812', 'davis@gmail.com', '123'),
(11, 'Ghjj', 'Jhghhj', '987', 'fghjj@hh', '12'),
(12, 'Suharto', 'Jl. Nenas', '08128182', 'testing@testing', '123'),
(13, 'dava', 'jl. nanas', '0812081208', 'dava@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `makam`
--

CREATE TABLE `makam` (
  `idmakam` int(11) NOT NULL,
  `nomormakam` int(11) NOT NULL,
  `idsubblok` int(11) NOT NULL,
  `baris` varchar(2) NOT NULL,
  `kolom` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makam`
--

INSERT INTO `makam` (`idmakam`, `nomormakam`, `idsubblok`, `baris`, `kolom`) VALUES
(1, 1, 1, '1', '1'),
(2, 2, 1, '1', '2'),
(3, 3, 1, '1', '3'),
(4, 4, 1, '1', '4'),
(5, 5, 1, '1', '5');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` int(11) NOT NULL,
  `idmakam` int(11) DEFAULT NULL,
  `idklien` int(11) NOT NULL,
  `tanggalpesanan` int(11) NOT NULL,
  `tanggalkonfirmasi` int(11) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `idmakam`, `idklien`, `tanggalpesanan`, `tanggalkonfirmasi`, `status`) VALUES
(1, NULL, 9, 1534130460, NULL, '1'),
(2, 1, 9, 1534130684, 1534132346, '3'),
(3, NULL, 9, 1534144120, NULL, '0'),
(4, 5, 1, 1534144815, 1534147165, '3');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `iddetail` int(11) NOT NULL,
  `idpesanan` int(11) DEFAULT NULL,
  `hubungan` varchar(30) DEFAULT NULL,
  `f_ktpahliwaris` varchar(50) DEFAULT NULL,
  `f_ktpalm` varchar(50) DEFAULT NULL,
  `f_kk` varchar(50) DEFAULT NULL,
  `f_suratkematian` varchar(50) DEFAULT NULL,
  `f_skrd` varchar(50) DEFAULT NULL,
  `catatan` varchar(50) DEFAULT NULL,
  `tanggaluploadskrd` int(11) NOT NULL,
  `tanggalpemakaman` int(11) NOT NULL,
  `jampemakaman` varchar(10) DEFAULT NULL,
  `lokasipenjemputan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`iddetail`, `idpesanan`, `hubungan`, `f_ktpahliwaris`, `f_ktpalm`, `f_kk`, `f_suratkematian`, `f_skrd`, `catatan`, `tanggaluploadskrd`, `tanggalpemakaman`, `jampemakaman`, `lokasipenjemputan`) VALUES
(1, 1, 'Saudara', 'f_ktpahliwaris_1534130460.jpg', 'f_ktpalm_1534130460.jpg', 'f_kk_1534130460.jpg', 'f_suratkematian_1534130460.jpg', NULL, '\r\n', 0, 0, NULL, NULL),
(2, 2, '', 'f_ktpahliwaris_1534130684.jpg', 'f_ktpalm_1534130684.jpg', 'f_kk_1534130684.jpg', 'f_suratkematian_1534130684.jpg', 'f_skrd_1534130819.jpg', '', 1534130819, 1534896000, '12:12', ''),
(3, 3, '', 'f_ktpahliwaris_1534144120.jpg', 'f_ktpalm_1534144120.jpg', 'f_kk_1534144120.jpg', 'f_suratkematian_1534144120.jpg', NULL, '', 0, 0, NULL, NULL),
(4, 4, '', 'f_ktpahliwaris_1534144815.jpg', 'f_ktpalm_1534144815.jpg', 'f_kk_1534144815.jpg', 'f_suratkematian_1534144815.jpg', 'f_skrd_1534145747.jpg', '', 1534145747, 1534291200, '13:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `idpesanan` int(11) NOT NULL,
  `idadmin` int(11) NOT NULL,
  `nikalm` varchar(20) DEFAULT NULL,
  `namaalm` varchar(50) DEFAULT NULL,
  `jkalm` varchar(5) DEFAULT NULL,
  `umuralm` varchar(10) NOT NULL,
  `agamaalm` varchar(15) DEFAULT NULL,
  `tanggalverifikasi` int(11) DEFAULT NULL,
  `alasan` varchar(50) DEFAULT NULL,
  `carapemakaman` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`idpesanan`, `idadmin`, `nikalm`, `namaalm`, `jkalm`, `umuralm`, `agamaalm`, `tanggalverifikasi`, `alasan`, `carapemakaman`) VALUES
(2, 2, '1234567890123456', 'Suharto', 'Pria', '21 Tahun', 'Buddha', 1534130785, NULL, 'Muslim'),
(1, 2, '1234567890123456', 'Suharto', 'Pria', '21 Tahun', 'Buddha', 1534134652, NULL, 'Non-Muslim'),
(4, 1, '1234567890123456', 'Suharto', 'Pria', '21 Tahun', 'Buddha', 1534145534, NULL, 'Muslim');

-- --------------------------------------------------------

--
-- Table structure for table `subblok`
--

CREATE TABLE `subblok` (
  `idsubblok` int(11) NOT NULL,
  `idblok` int(11) NOT NULL,
  `subblok` varchar(20) NOT NULL,
  `panjangkolom` varchar(3) NOT NULL,
  `lebarbaris` varchar(3) NOT NULL,
  `status_subblok` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subblok`
--

INSERT INTO `subblok` (`idsubblok`, `idblok`, `subblok`, `panjangkolom`, `lebarbaris`, `status_subblok`) VALUES
(1, 1, 'A1', '10', '5', '1'),
(2, 2, 'B2', '20', '10', '0'),
(4, 1, 'A2', '12', '1', '0'),
(5, 2, 'B3', '6', '12', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `blok`
--
ALTER TABLE `blok`
  ADD PRIMARY KEY (`idblok`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`idklien`);

--
-- Indexes for table `makam`
--
ALTER TABLE `makam`
  ADD PRIMARY KEY (`idmakam`),
  ADD KEY `idsubblok` (`idsubblok`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`),
  ADD KEY `idklien` (`idklien`),
  ADD KEY `idmakam` (`idmakam`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `idpesanan` (`idpesanan`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD KEY `idpesanan` (`idpesanan`),
  ADD KEY `idadmin` (`idadmin`);

--
-- Indexes for table `subblok`
--
ALTER TABLE `subblok`
  ADD PRIMARY KEY (`idsubblok`),
  ADD KEY `idblok` (`idblok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `blok`
--
ALTER TABLE `blok`
  MODIFY `idblok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `idklien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `makam`
--
ALTER TABLE `makam`
  MODIFY `idmakam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idpesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `iddetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subblok`
--
ALTER TABLE `subblok`
  MODIFY `idsubblok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `makam`
--
ALTER TABLE `makam`
  ADD CONSTRAINT `makam_ibfk_1` FOREIGN KEY (`idsubblok`) REFERENCES `subblok` (`idsubblok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`idklien`) REFERENCES `klien` (`idklien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_6` FOREIGN KEY (`idmakam`) REFERENCES `makam` (`idmakam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`idpesanan`) REFERENCES `pesanan` (`idpesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proses`
--
ALTER TABLE `proses`
  ADD CONSTRAINT `proses_ibfk_1` FOREIGN KEY (`idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proses_ibfk_2` FOREIGN KEY (`idpesanan`) REFERENCES `pesanan` (`idpesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subblok`
--
ALTER TABLE `subblok`
  ADD CONSTRAINT `subblok_ibfk_1` FOREIGN KEY (`idblok`) REFERENCES `blok` (`idblok`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
