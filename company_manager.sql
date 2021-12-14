-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 04:40 PM
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
  `ACTIVE` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`USER_NAME`, `PASSWORD`, `ACTIVE`) VALUES
('huybaHN', 'daicaHn123', 1),
('longtrong123', '123456789', 1),
('namvippro123', 'vipprohehe', 1),
('ngamytho', 'depgaihonquynh', 1),
('phucmapyoutuber', 'phucmapyoutuber', 0),
('quangit', 'kocaiwinnhe123', 1),
('quynhxinhdep123', 'bonghoa1123', 1),
('tankimcokhi', 'tankimcokhi', 0),
('thinhnguyen', 'thinhnguyen', 0),
('vietlatui', 'vietlatui', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_nghi`
--

CREATE TABLE `chi_tiet_don_nghi` (
  `MA_NGHI` int(11) NOT NULL,
  `MA_NV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `don_nghi`
--

CREATE TABLE `don_nghi` (
  `MA_NGHI` int(11) NOT NULL,
  `NOI_DUNG` text DEFAULT NULL,
  `MINH_CHUNG` text DEFAULT NULL,
  `SO_NGAY` int(11) DEFAULT NULL,
  `TRANG_THAI` enum('approved','refused','waiting') DEFAULT 'waiting'
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

--
-- Dumping data for table `phong_ban`
--

INSERT INTO `phong_ban` (`MA_PHONG_BAN`, `TEN_PB`, `MO_TA`, `SO_PHONG`) VALUES
(1, 'Phòng IT', 'Lập trình theo ý của bạn. Khóc là việc của developer', 'L4.001'),
(2, 'Cơ Khí', 'Kết hợp với dân IT. Tạo robot thống trị thể giới.', 'L2.002'),
(3, 'Điện tử', 'Làm các chip, link kiện máy tính', 'L2.001'),
(4, 'Thiết kế giao diện', 'Thiết kế các giao diện người dùng, banner quảng cáo, cái gì cũng được miễn sao có lương, đi vẽ tường cũng được.', 'L3.001'),
(5, 'Ban an ninh', 'Trông giữ các chiến mã quý giá của các nhân viên, bộ phận bảo vệ tòa nhà. Rất quan trọng', 'L1.001');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TASK_ID` int(11) NOT NULL,
  `TIEU_DE` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `MO_TA` text DEFAULT NULL,
  `DEADLINE` time DEFAULT NULL,
  `SUPPORT_FOLDER_PATH` text DEFAULT NULL,
  `SUBMIT_FOLDER_PATH` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_info`
--

CREATE TABLE `task_info` (
  `TASK_ID` int(11) DEFAULT NULL,
  `MA_NGUOI_GIAO` int(11) DEFAULT NULL,
  `MA_NGUOI_NHAN` int(11) DEFAULT NULL,
  `STATUS` enum('New','In progress','Canceled','Waiting','Rejected') DEFAULT 'New',
  `COMPLETE_STATUS` enum('Bad','Ok','Good','None') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `truong_phong`
--

CREATE TABLE `truong_phong` (
  `MA_PHONG_BAN` int(11) NOT NULL,
  `MA_NV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `truong_phong`
--

INSERT INTO `truong_phong` (`MA_PHONG_BAN`, `MA_NV`) VALUES
(1, 3),
(2, 9),
(3, 8),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `MA_USER` int(11) NOT NULL,
  `HO_TEN` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `AVATAR_PATH` text DEFAULT NULL,
  `ADDRESS` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `PHONE` varchar(15) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` enum('1','0') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`MA_USER`, `HO_TEN`, `AVATAR_PATH`, `ADDRESS`, `PHONE`, `ngay_sinh`, `gioi_tinh`, `email`) VALUES
(1, 'Tân Kim', NULL, '404, Thôn 1, Phường 56, Huyện Thịnh Thụy\nHà Tĩnh', '0186018571', '1990-06-01', '1', 'inguy@diep.info.vn'),
(2, 'Quỳnh Vũ', NULL, '479 Phố Đoàn Tâm Yến, Ấp Hiếu Bích, Quận Nhân\nĐà Nẵng', '8465085261', '1995-12-09', '0', 'hanh89@gmail.com'),
(3, 'Quang Võ', NULL, '74 Phố Quang, Phường Hiền, Quận Trung Khu\nBắc Giang', '0283935612', '1980-09-16', '1', 'klu@phung.info.vn\n'),
(4, 'Thịnh Nguyễn', NULL, '79, Thôn Lạc Sang, Ấp Chiêu Hảo, Quận 2\nĐắk Lắk', '0166196042', '1980-08-01', '1', 'vung@dang.gov.vn'),
(5, 'Nga Mỹ', NULL, '22, Ấp Sỹ Lạc, Xã 8, Huyện Phượng\nKon Tum', '8425734083', '1986-03-12', '0', 'thuy.luong@can.com'),
(6, 'Thế Nam', NULL, '1107 Phố Âu Anh Duy, Phường Khoa, Quận Thu Ý\nLai Châu', '8424037119', '1975-02-01', '1', 'hung.ong@ong.biz'),
(7, 'Long Trọng', NULL, '3842, Thôn Vân, Phường Nghị, Huyện Bùi Điền\nKhánh Hòa', '0163844090', '2000-06-03', '1', 'ttrung@hotmail.com'),
(8, 'Phúc Sỹ', NULL, '8083 Phố Lò Duyên Cát, Phường Trang, Quận Đài\nSơn La', '0156878658', '1985-06-08', '1', 'can.hoa@gmail.com'),
(9, 'Bá Huy', NULL, '05 Phố Phí Hảo Huy, Phường Quỳnh Khu, Huyện Thanh Trân\nBắc Giang', '0943777267', '1999-02-04', '1', 'tra.phi@vo.com'),
(10, 'Việt Lý', NULL, '0 Phố Chiêm Bình Thụy, Xã Hà, Huyện Đoàn\nĐắk Lắk', '0589777870', '1986-07-12', '1', 'nhan75@trang.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `MA_NV` int(11) NOT NULL,
  `USER_NAME` char(150) DEFAULT NULL,
  `MA_PHONG_BAN` int(11) DEFAULT NULL,
  `CHUC_VU` enum('admin','employee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`MA_NV`, `USER_NAME`, `MA_PHONG_BAN`, `CHUC_VU`) VALUES
(1, 'tankimcokhi', 2, 'employee'),
(2, 'quynhxinhdep123', 4, 'employee'),
(3, 'quangit', 1, 'employee'),
(4, 'thinhnguyen', 1, 'employee'),
(5, 'ngamytho', 2, 'employee'),
(6, 'namvippro123', 5, 'admin'),
(7, 'longtrong123', NULL, 'admin'),
(8, 'phucmapyoutuber', 3, 'employee'),
(9, 'huybaHN', 2, 'employee'),
(10, 'vietlatui', 4, 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`USER_NAME`);

--
-- Indexes for table `chi_tiet_don_nghi`
--
ALTER TABLE `chi_tiet_don_nghi`
  ADD PRIMARY KEY (`MA_NGHI`,`MA_NV`),
  ADD KEY `FK_CHI_TIET_DON_NGHI_MA_NHAN_VIEN` (`MA_NV`);

--
-- Indexes for table `don_nghi`
--
ALTER TABLE `don_nghi`
  ADD PRIMARY KEY (`MA_NGHI`);

--
-- Indexes for table `phong_ban`
--
ALTER TABLE `phong_ban`
  ADD PRIMARY KEY (`MA_PHONG_BAN`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TASK_ID`);

--
-- Indexes for table `task_info`
--
ALTER TABLE `task_info`
  ADD KEY `FK_TASK_INFO_TASK_ID` (`TASK_ID`),
  ADD KEY `FK_TASK_INFO_MA_NGUOI_GIAO` (`MA_NGUOI_GIAO`),
  ADD KEY `FK_TASK_INFO_MA_NGUOI_NHAN` (`MA_NGUOI_NHAN`);

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
  ADD UNIQUE KEY `USER_NAME` (`USER_NAME`),
  ADD KEY `FK_USER_INFO_MA_PHONG_BAN` (`MA_PHONG_BAN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chi_tiet_don_nghi`
--
ALTER TABLE `chi_tiet_don_nghi`
  MODIFY `MA_NGHI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `don_nghi`
--
ALTER TABLE `don_nghi`
  MODIFY `MA_NGHI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phong_ban`
--
ALTER TABLE `phong_ban`
  MODIFY `MA_PHONG_BAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TASK_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `MA_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_nghi`
--
ALTER TABLE `chi_tiet_don_nghi`
  ADD CONSTRAINT `FK_CHI_TIET_DON_NGHI_MA_NGHI` FOREIGN KEY (`MA_NGHI`) REFERENCES `don_nghi` (`MA_NGHI`),
  ADD CONSTRAINT `FK_CHI_TIET_DON_NGHI_MA_NHAN_VIEN` FOREIGN KEY (`MA_NV`) REFERENCES `user_info` (`MA_NV`);

--
-- Constraints for table `task_info`
--
ALTER TABLE `task_info`
  ADD CONSTRAINT `FK_TASK_INFO_MA_NGUOI_GIAO` FOREIGN KEY (`MA_NGUOI_GIAO`) REFERENCES `truong_phong` (`MA_NV`),
  ADD CONSTRAINT `FK_TASK_INFO_MA_NGUOI_NHAN` FOREIGN KEY (`MA_NGUOI_NHAN`) REFERENCES `user_info` (`MA_NV`),
  ADD CONSTRAINT `FK_TASK_INFO_TASK_ID` FOREIGN KEY (`TASK_ID`) REFERENCES `task` (`TASK_ID`);

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
  ADD CONSTRAINT `FK_USER_INFO_MA_NV` FOREIGN KEY (`MA_NV`) REFERENCES `user` (`MA_USER`),
  ADD CONSTRAINT `FK_USER_INFO_MA_PHONG_BAN` FOREIGN KEY (`MA_PHONG_BAN`) REFERENCES `phong_ban` (`MA_PHONG_BAN`),
  ADD CONSTRAINT `FK_USER_INFO_USER_NAME` FOREIGN KEY (`USER_NAME`) REFERENCES `account` (`USER_NAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
