-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 05:04 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quaktis`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(2, 'Celana Jens Pria'),
(3, 'Baju Pria'),
(4, 'Sepatu');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detai` text,
  `stok` varchar(3) NOT NULL,
  `gambar` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detai`, `stok`, `gambar`) VALUES
(0, NULL, 'Tshirt Spongebob', '120000', NULL, 'Ukuran L,M,S', '21', 0x696d675f36353961613131353639613930302e38313435303736302e6a7067),
(0, NULL, 'Adult Ultra Cotton Long Sleeve T-Shirt, Style G2400, Multipack', '150000', NULL, 'Ukuran L,M,S', '15', 0x696d675f36353962646430653236663235332e33333936363437362e6a7067),
(0, NULL, 'Men''s Regular-Fit Long-Sleeve T-Shirt', '80000', NULL, 'Ukuran L,M,S', '50', 0x696d675f36353962646465373930366466332e30343234323235392e6a7067),
(0, NULL, 'Mens Slim Fit Jeans Skinny Stretch Denim Pants for Men Straight Fit', '250000', NULL, 'Size 29-34', '18', 0x696d675f36353962646535313933306364322e30373638313737362e6a7067),
(0, NULL, 'Men''s Super Skinny Stretch Tapered Leg Slim Fit Ripped Distressed Jeans', '220000', NULL, 'Size 29-34', '20', 0x696d675f36353962646537666266623232372e32303335303736362e6a7067),
(0, NULL, 'Men''s Classic 5-Pocket Regular Fit Cotton Jean', '180000', NULL, 'Size 29-34', '25', 0x696d675f36353962646561313333653536372e37383930393738352e6a7067),
(0, NULL, 'Men''s Charged Assert 9 Running Shoe', '300000', NULL, 'Size 29-37', '13', 0x696d675f36353962646565333163313365382e37363938313736362e6a7067),
(0, NULL, 'Men''s Striper Ii CVO Kick Back Sneaker', '280000', NULL, 'Size 29-37', '20', 0x696d675f36353962646631303165626331312e32313133343031382e6a7067),
(0, NULL, 'Men''s Oxfords Formal Dress Shoes', '320000', NULL, 'Size 29-34', '10', 0x696d675f36353962646634613336396233352e34363032353834372e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `userID` int(5) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'default_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`userID`, `username`, `password`, `nama`, `no_hp`, `profile_image`) VALUES
(0, 'AZHARI', '2311', 'AZHARI', '082267423365', 'WhatsApp Image 2024-01-02 at 15.40.44.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
