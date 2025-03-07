-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2024 at 02:14 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngamobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `ID_kendaraan` int NOT NULL,
  `plat_nomor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `VIN` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_mobil` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi_pemeliharaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`ID_kendaraan`, `plat_nomor`, `status`, `VIN`, `model`, `jenis_mobil`, `harga`, `deskripsi_pemeliharaan`) VALUES
(1, 'B 0941 GT', 'Available', 'JGPA1409318130', 'Toyota GT-86', 'coupe', 1500000.00, 'recently serviced'),
(2, 'B 6141 AV', 'Available', 'JGAB1353513530', 'Toyota Avanza', 'MPV', 500000.00, 'recently serviced'),
(3, 'B 1355 AG', 'Available', 'GEPA31U5983593', 'Toyota Agya', 'LCGC', 300000.00, 'recently serviced'),
(4, 'B 1541 HT', 'Available', 'KAPA1352352479', 'Honda Beat', 'convertible', 1000000.00, 'recently serviced'),
(5, 'B 1345 MN', 'Available', 'JAIJ1409318130', 'Honda HR-V', 'MSUV', 700000.00, 'recently serviced'),
(6, 'B 2441 KK', 'Available', 'J41A1409318130', 'Honda Brio', 'LCGC', 300000.00, 'recently serviced'),
(7, 'B 1941 BR', 'Available', 'AGKJ1349183498', 'Nissan Magnite', 'LCGC', 500000.00, 'recently serviced'),
(8, 'A 4241 GL', 'Available', 'JGBW1409318130', 'Nissan Grand-Livina', 'MPV', 300000.00, 'recently serviced'),
(9, 'C 2415 TR', 'Available', 'JGGA14091343152', 'Nissan Terra', 'SUV', 1000000.00, 'recently serviced');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_pembayaran` int NOT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `metode_pembayaran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_promo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ID_pemesanan` int DEFAULT NULL,
  `ID_penyewa` int DEFAULT NULL,
  `ID_kendaraan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `ID_pemesanan` int NOT NULL,
  `waktu_awal` datetime NOT NULL,
  `waktu_akhir` datetime NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `lokasi_pengantaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam_penjemputan` time NOT NULL,
  `ID_kendaraan` int DEFAULT NULL,
  `ID_penyewa` int DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `ID_penyewa` int NOT NULL,
  `nama_depan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_belakang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nomor_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi_kendaraan`
--

CREATE TABLE `spesifikasi_kendaraan` (
  `ID_kendaraan` int NOT NULL,
  `warna` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_bbm` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CC` int DEFAULT NULL,
  `jumlah_kursi` int DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `transmisi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kapasitas_bagasi` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spesifikasi_kendaraan`
--

INSERT INTO `spesifikasi_kendaraan` (`ID_kendaraan`, `warna`, `jenis_bbm`, `CC`, `jumlah_kursi`, `tahun`, `transmisi`, `kapasitas_bagasi`) VALUES
(1, 'White', 'Pertamax', 2000, 4, 2019, 'Automatic', 300.00),
(2, 'White', 'Pertalite', 1500, 7, 2020, 'Manual', 500.00),
(3, 'White', 'Pertalite', 1000, 5, 2018, 'Automatic', 200.00),
(4, 'Yellow', 'Pertalite', 1100, 2, 2004, 'Manual', 100.00),
(5, 'White', 'Pertamax', 1800, 5, 2022, 'Automatic', 400.00),
(6, 'Black', 'Pertalite', 1200, 5, 2017, 'Manual', 150.00),
(7, 'Red', 'Pertalite', 1400, 5, 2016, 'Automatic', 250.00),
(8, 'White', 'Pertamax', 1600, 7, 2015, 'Manual', 350.00),
(9, 'White', 'Pertamax Dex', 2500, 7, 2023, 'Automatic', 600.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`ID_kendaraan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_pembayaran`),
  ADD KEY `ID_pemesanan` (`ID_pemesanan`),
  ADD KEY `fk_penyewa` (`ID_penyewa`),
  ADD KEY `fk_kendaraan` (`ID_kendaraan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`ID_pemesanan`),
  ADD KEY `ID_kendaraan` (`ID_kendaraan`),
  ADD KEY `ID_penyewa` (`ID_penyewa`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`ID_penyewa`);

--
-- Indexes for table `spesifikasi_kendaraan`
--
ALTER TABLE `spesifikasi_kendaraan`
  ADD PRIMARY KEY (`ID_kendaraan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `ID_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID_pembayaran` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `ID_pemesanan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `ID_penyewa` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_kendaraan` FOREIGN KEY (`ID_kendaraan`) REFERENCES `kendaraan` (`ID_kendaraan`),
  ADD CONSTRAINT `fk_penyewa` FOREIGN KEY (`ID_penyewa`) REFERENCES `penyewa` (`ID_penyewa`),
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`ID_pemesanan`) REFERENCES `pemesanan` (`ID_pemesanan`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`ID_kendaraan`) REFERENCES `kendaraan` (`ID_kendaraan`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`ID_penyewa`) REFERENCES `penyewa` (`ID_penyewa`);

--
-- Constraints for table `spesifikasi_kendaraan`
--
ALTER TABLE `spesifikasi_kendaraan`
  ADD CONSTRAINT `spesifikasi_kendaraan_ibfk_1` FOREIGN KEY (`ID_kendaraan`) REFERENCES `kendaraan` (`ID_kendaraan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
