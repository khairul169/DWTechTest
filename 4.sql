-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2020 at 11:55 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dw_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten_tb`
--

CREATE TABLE `kabupaten_tb` (
  `id` int(255) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `provinsi_id` int(255) NOT NULL,
  `diresmikan` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten_tb`
--

INSERT INTO `kabupaten_tb` (`id`, `nama`, `provinsi_id`, `diresmikan`, `photo`) VALUES
(1, 'Bandung', 1, '1641-04-20', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Lambang_Kabupaten_Bandung%2C_Jawa_Barat%2C_Indonesia.svg/200px-Lambang_Kabupaten_Bandung%2C_Jawa_Barat%2C_Indonesia.svg.png'),
(2, 'Bekasi', 1, '1950-08-15', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/Logo_Kabupaten_Bekasi.jpg/120px-Logo_Kabupaten_Bekasi.jpg'),
(3, 'Cilacap', 2, '1950-08-15', 'https://upload.wikimedia.org/wikipedia/id/thumb/0/00/Logo-Cilacap.png/150px-Logo-Cilacap.png'),
(4, 'Klaten', 2, '1950-08-15', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/LOGO_KABUPATEN_KLATEN.png/150px-LOGO_KABUPATEN_KLATEN.png'),
(5, 'Kota Pontianak', 3, '1771-10-23', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Seal_of_Pontianak.svg/100px-Seal_of_Pontianak.svg.png'),
(10, 'Mempawah', 3, '2007-01-01', 'https://upload.wikimedia.org/wikipedia/id/thumb/0/0e/Kabupaten_mempawah.png/120px-Kabupaten_mempawah.png'),
(12, 'Kota Singkawang', 3, '2001-10-17', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Lambang_KotaSingkawang.png/100px-Lambang_KotaSingkawang.png'),
(13, 'Bogor', 1, '1745-01-01', 'https://upload.wikimedia.org/wikipedia/id/thumb/e/e2/Lambang_Kabupaten_Bogor.png/80px-Lambang_Kabupaten_Bogor.png'),
(15, 'Kota Denpasar', 6, '1788-02-27', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Lambang_Kota_Denpasar_%281%29.png/100px-Lambang_Kota_Denpasar_%281%29.png'),
(16, 'Kota Banda Aceh', 7, '1205-04-22', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Lambang_Kota_Banda_Aceh.png/100px-Lambang_Kota_Banda_Aceh.png');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi_tb`
--

CREATE TABLE `provinsi_tb` (
  `id` int(255) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `diresmikan` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `pulau` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi_tb`
--

INSERT INTO `provinsi_tb` (`id`, `nama`, `diresmikan`, `photo`, `pulau`) VALUES
(1, 'Jawa Barat', '1945-08-19', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/100px-Coat_of_arms_of_West_Java.svg.png', 'Jawa'),
(2, 'Jawa Tengah', '1950-08-15', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Coat_of_arms_of_Central_Java.svg/100px-Coat_of_arms_of_Central_Java.svg.png', 'Jawa'),
(3, 'Kalimantan Barat', '1957-01-01', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Coat_of_arms_of_West_Kalimantan.svg/100px-Coat_of_arms_of_West_Kalimantan.svg.png', 'Kalimantan'),
(6, 'Bali', '1959-08-14', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/10/Coat_of_arms_of_Bali.svg/100px-Coat_of_arms_of_Bali.svg.png', 'Bali'),
(7, 'Aceh', '1956-12-07', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Coat_of_arms_of_Aceh.svg/100px-Coat_of_arms_of_Aceh.svg.png', 'Sumatera');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kabupaten_tb`
--
ALTER TABLE `kabupaten_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinsi_id` (`provinsi_id`);

--
-- Indexes for table `provinsi_tb`
--
ALTER TABLE `provinsi_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kabupaten_tb`
--
ALTER TABLE `kabupaten_tb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `provinsi_tb`
--
ALTER TABLE `provinsi_tb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kabupaten_tb`
--
ALTER TABLE `kabupaten_tb`
  ADD CONSTRAINT `kabupaten_tb_ibfk_1` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi_tb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
