-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 10:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhom18_quanlynhanvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `ID` int(5) UNSIGNED NOT NULL,
  `HOTEN` varchar(255) NOT NULL,
  `MAPB` varchar(10) DEFAULT NULL,
  `PHAI` varchar(10) NOT NULL,
  `DIACHI` varchar(255) DEFAULT NULL,
  `SDT` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `USERNAME` varchar(32) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `LUONG` varchar(100) DEFAULT NULL,
  `isAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`ID`, `HOTEN`, `MAPB`, `PHAI`, `DIACHI`, `SDT`, `EMAIL`, `USERNAME`, `PASSWORD`, `LUONG`, `isAdmin`) VALUES
(1, 'Administrator', 'IT', 'Nam', '', '', 'hoangarmylau@gmail.com', 'admin', 'f5bb0c8de146c67b44babbf4e6584cc0', 'bị ẩn hihi', 1),
(2, 'Nguyễn Đăng Dương', 'KD', 'Nam', '104 Tăng Nhơn Phú', '0987657677', 'nv2@quanlynhanvien.com', 'nv2', 'LzoxGn1KONhP', 'emtvTSkPZw==', 0),
(3, 'Nguyễn Văn Vinh', 'IT', 'Nam', 'Hoàn Kiếm, Hà Nội', '0945646464', 'nv3@quanlynhanvien.com', 'nv3', 'PToxCWxeOQ==', 'eWtvTSkPZw==', 0),
(41, 'Hồ Huy Hiếu', 'KD', 'Nam', 'Sơn Hàm, Hương Sơn, Hà Tĩnh', '0445665544', 'nv25@quanlynhanvien.com', 'nv25', 'Iy4mFXZeOdE=', 'eGtvTSkPZw==', 0),
(51, 'Nguyễn Văn Hậu', 'IT', 'Nam', 'Lagi, Bình Thuận', '09321321333', 'nv25c2@quanlynhanvien.com', 'tests', 'PToxCXxQM8w=', 'fmtvTSkPZw==', 0);

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `MAPB` varchar(5) NOT NULL,
  `TENPB` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`MAPB`, `TENPB`) VALUES
('IT', 'Công Nghệ Thông Tin'),
('KD', 'Kinh Doanh'),
('MKT', 'Marketing'),
('NS', 'Nhân Sự');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MAPB` (`MAPB`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MAPB`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`MAPB`) REFERENCES `phongban` (`MAPB`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
