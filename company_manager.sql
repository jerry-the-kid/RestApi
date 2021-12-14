-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 09:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `USER_NAME` char(150) NOT NULL,
  `PASSWORD` varchar(150) DEFAULT NULL,
  `ACTIVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vu`
--

CREATE TABLE `chuc_vu` (
  `MA_CHUC_VU` int(11) NOT NULL,
  `CHUC_DANH` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `phong_ban`
--

CREATE TABLE `phong_ban` (
  `MA_PHONG_BAN` int(11) NOT NULL,
  `TEN_PB` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `MO_TA` text DEFAULT NULL,
  `SO_PHONG` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `truong_phong`
--

CREATE TABLE `truong_phong` (
  `MA_PHONG_BAN` int(11) NOT NULL,
  `MA_NV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `MA_USER` int(11) NOT NULL,
  `HO_TEN` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `AVATAR_PATH` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `MA_NV` int(11) NOT NULL,
  `USER_NAME` char(150) DEFAULT NULL,
  `MA_CHUC_VU` int(11) DEFAULT NULL,
  `MA_PHONG_BAN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`USER_NAME`);

--
-- Indexes for table `chuc_vu`
--
ALTER TABLE `chuc_vu`
  ADD PRIMARY KEY (`MA_CHUC_VU`);

--
-- Indexes for table `phong_ban`
--
ALTER TABLE `phong_ban`
  ADD PRIMARY KEY (`MA_PHONG_BAN`);

--
-- Indexes for table `truong_phong`
--
ALTER TABLE `truong_phong`
  ADD PRIMARY KEY (`MA_PHONG_BAN`,`MA_NV`),
  ADD KEY `FK_TRUONGPHONG_MANV` (`MA_NV`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`MA_USER`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`MA_NV`),
  ADD KEY `FK_USER_INFO_USER_NAME` (`USER_NAME`),
  ADD KEY `FK_USER_INFO_CHUC_VU` (`MA_CHUC_VU`),
  ADD KEY `FK_USER_INFO_MA_PHONG_BAN` (`MA_PHONG_BAN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phong_ban`
--
ALTER TABLE `phong_ban`
  MODIFY `MA_PHONG_BAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `MA_USER` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `truong_phong`
--
ALTER TABLE `truong_phong`
  ADD CONSTRAINT `FK_TRUONGPHONG_MANV` FOREIGN KEY (`MA_NV`) REFERENCES `user_info` (`MA_NV`),
  ADD CONSTRAINT `FK_TRUONGPHONG_MAPB` FOREIGN KEY (`MA_PHONG_BAN`) REFERENCES `phong_ban` (`MA_PHONG_BAN`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `FK_USER_INFO_CHUC_VU` FOREIGN KEY (`MA_CHUC_VU`) REFERENCES `chuc_vu` (`MA_CHUC_VU`),
  ADD CONSTRAINT `FK_USER_INFO_MA_NV` FOREIGN KEY (`MA_NV`) REFERENCES `user` (`MA_USER`),
  ADD CONSTRAINT `FK_USER_INFO_MA_PHONG_BAN` FOREIGN KEY (`MA_PHONG_BAN`) REFERENCES `phong_ban` (`MA_PHONG_BAN`),
  ADD CONSTRAINT `FK_USER_INFO_USER_NAME` FOREIGN KEY (`USER_NAME`) REFERENCES `account` (`USER_NAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
