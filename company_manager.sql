-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 09:39 AM
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
('akaichi21', '$2y$10$WVIiVTJ9Qwh1Z8CiJpqgluO.r4xyy/a3E2mUHvgj6OZA/vkvs24wa', 1),
('hieutran795', '$2y$10$GbNYTAqkuOOI2rS2X0wVcOdr7bWtaOFIecMfiID4nF9E4z4JS32oC', 1),
('huybaHN', '$2y$10$aIeKEUo7nqJPuaqOWAjfPO7cBnmcCScZONMHcfFwhNpLwX6azxLeC', 1),
('longtrong123', '$2y$10$6vzWSQYx3q4MUwgDZS7peerg045WJrbDBlEmHzChTuTj7b5Pcxxn6', 1),
('namvippro123', '$2y$10$.VU2cccMu3axRYbXHFJ3UeFhmHUrDPgLGFem77jZf6H0VwCCUOJvW', 1),
('ngamytho', '$2y$10$jN6sJ14LrsYEVlMw8FsnbufOywpSTBsvJxXBIiqMFbJfzgyJXIpKK', 1),
('phucmapyoutuber', '$2y$10$Wl/zHoqcsWSrsNjfIFo/8OC13Ue3H8rJvoxWz1mLoCC5tAejolMzG', 0),
('quangit', '$2y$10$yt5m79aYeG3Bo.ZkKy4DlOwPMXaK0L.JHDDvnEeCDRfZG5KCkJ4J2', 1),
('quynhxinhdep123', '$2y$10$DHXF6wQNolPnvDoZTTePFuH2F69PaVTeNA5pSk2a68plBelVoZiN6', 1),
('tankimcokhi', '$2y$10$7AWoqWRyMYUR6Yf78iTcgeboMQDZPZ5nj6FJlVtmOHH.RF2sl9UH6', 0),
('test', NULL, 0),
('thanhnguyen', '$2y$10$sXGYDxQ82cTbAvmlXoZIY.Y1AErg5DdFGV9BZOddfk7VYSzalSVM2', 1),
('thaonguyen811', '$2y$10$P95wzBtuVWJETuSFQ3041eo4TcqpbdyAaRJ7HuMRmBKlHko6V5wra', 0),
('thinhnguyen', '$2y$10$YyY.sxvZHEiu2qkwuVdOMeifkGeSYTZ940DU/V0gFdGOCdu1nZFS2', 0),
('vietlatui', '$2y$10$lWGKpWYHYehN6Y/fTuq9HO2HUFtkMRiikvuPszQ61cB.1TCc6Vu76', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_nghi`
--

CREATE TABLE `chi_tiet_don_nghi` (
  `MA_NGHI` int(11) NOT NULL,
  `MA_NV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chi_tiet_don_nghi`
--

INSERT INTO `chi_tiet_don_nghi` (`MA_NGHI`, `MA_NV`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 14),
(5, 14),
(6, 14),
(7, 14),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 2),
(13, 2),
(14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `don_nghi`
--

CREATE TABLE `don_nghi` (
  `MA_NGHI` int(11) NOT NULL,
  `TIEU_DE` text DEFAULT NULL,
  `MINH_CHUNG` text DEFAULT NULL,
  `SO_NGAY` int(11) DEFAULT NULL,
  `TRANG_THAI` enum('approved','refused','waiting') DEFAULT 'waiting',
  `NGAY_LAM_DON` date DEFAULT curdate(),
  `NOI_DUNG` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `don_nghi`
--

INSERT INTO `don_nghi` (`MA_NGHI`, `TIEU_DE`, `MINH_CHUNG`, `SO_NGAY`, `TRANG_THAI`, `NGAY_LAM_DON`, `NOI_DUNG`) VALUES
(1, 'Đi khám nghĩa vụ quân sự', '../minh_chung/vA064njj/minh_chung.pdf', 1, 'waiting', '2022-01-15', 'Em chào sếp, phường em đưa giấy triệu tập đi khám nghĩa vụ quân sự nên ngày 15 này em xin nghỉ để đi ạ. Mong sếp duyệt giúp em, em cảm ơn sếp nhiều.'),
(2, 'Về quê thăm gia đình', '../minh_chung/ZsIoH9w7/MV01.pdf', 4, 'approved', '2022-01-08', 'Em chào sếp, sếp cho em xin nghỉ vài ngày về quê thăm gia đình của em ạ, em nghe bảo dạo này trái gió nên mẹ em không được khỏe nên em rất lo, mong sếp duyệt giúp em, em cảm ơn sếp.'),
(3, 'Đi khám bệnh', '../minh_chung/1LMs1IPK/minh_chung.png', 1, 'approved', '2022-01-07', 'Chào sếp, em có lịch hẹn đi khám bệnh nên xin sếp duyệt cho em nghỉ hôm đó đi khám nha sếp. Em cảm ơn sếp.'),
(4, 'Đi thi Toeic', '../minh_chung/fLNYu5hT/minh_chung.pdf', 1, 'waiting', '2022-01-10', 'Em chào sếp đẹp trai, sếp cho em xin off 1 bữa đi thi lấy cái chứng chỉ tiếng anh nha sếp. Yêu sếp !!!'),
(5, 'Nhà có đám cưới', '../minh_chung/pocPIiAO/minh_chung.pdf', 3, 'refused', '2022-01-01', 'Chào sếp, con trai nhà họ hàng xa bên ngoại em có đám cưới nên sếp cho em xin nghỉ đi đám cưới nha sếp.'),
(6, 'Nghi ngờ mắc covid', '../minh_chung/JqXHFKKi/minh_chung.pdf', 7, 'approved', '2022-01-06', 'Chào sếp ạ, xin lỗi sếp vì đã làm phiền sếp giờ này nhưng có vẻ em cảm giác cảm sốt và mất vị giác nên sáng mai em sẽ test và báo sếp sau. Sếp cho em xin off 1 tuần, có thể em làm remote ở nhà cũng được ạ. Mong sếp duyệt giúp, cảm ơn sếp ạ.'),
(7, 'Họp đồng hương Bến Tre', '../minh_chung/bpauaiqT/minh_chung.docx', 1, 'refused', '2022-01-01', 'Chào sếp, mong sếp có ngày tốt lành, sếp duyệt giúp cho em off 1 ngày để đi họp đồng hương ạ. Cảm ơn sếp.'),
(8, 'Đi khám nghĩa vụ quân sự', '../minh_chung/LO1mErFj/minh_chung.png', 1, 'waiting', '2022-01-12', 'Em chào sếp, phường em đưa giấy triệu tập đi khám nghĩa vụ quân sự nên ngày 15 này em xin nghỉ để đi ạ. Mong sếp duyệt giúp em, em cảm ơn sếp nhiều.'),
(9, 'Đi Đà Lạt', '../minh_chung/o91EURSW/minh_chung.pdf', 5, 'refused', '2022-01-08', 'Em muốn xả stress và đi đâu đó chơi ạ.'),
(10, 'Đi nhổ răng khôn', '../minh_chung/bgeE9VMa/minh_chung.png', 2, 'approved', '2022-01-01', 'Chào sếp, dạo này răng em nhức nhối với đau quá, sếp cho em xin nghỉ để em đi nhổ răng ạ. Cảm ơn sếp.'),
(11, 'Đi dự hội thảo khoa học', '../minh_chung/hcCFOSzQ/minh_chung.pdf', 1, 'waiting', '2022-01-13', 'Em chào anh, mấy bữa nữa có cuộc hội thảo khoa học nên sếp duyệt giúp em đi nha sếp. Em cảm ơn sếp ạ.'),
(12, 'Xem đất mua nhà', '../minh_chung/FDAbVUqW/minh_chung.pdf', 1, 'refused', '2022-01-01', 'Chào sếp, em tính đi mua nhà nên em xin off 1 ngày để đi xem đất ạ.'),
(13, 'Đi du lịch cùng gia đình', '../minh_chung/y6aUF33P/minh_chung.txt', 6, 'approved', '2022-01-02', 'Em chào sếp, dạo này công việc khá áp lực nên sếp cho em xin vài ngày off để đi chơi với gia đình ạ. Em cảm ơn sếp.'),
(14, 'Hưởng tuần trăng mật cùng vợ', '../minh_chung/bwMv5X7U/minh_chung.ppt', 7, 'approved', '2022-01-01', 'Em chào sếp, dạo này thời công việc khá bận rộn nên sau đám cưới em chưa đưa vợ em đi đâu đó chơi được. Em xin sếp cho em nghỉ 1 tuần em đưa vợ đi hưởng trăng mật ạ. Em cảm ơn sếp nhiều ạ.');

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
(1, 'Phòng Công Nghệ Thông Tin', 'Xây dựng chiến lược và kế hoạch phát triển CNTT trong từng giai đoạn phát triển của doanh nghiệp. Chịu trách nhiệm điều hành và quản lý hoạt động CNTT.', 'L4.001'),
(2, 'Phòng Kế Toán', 'Thực hiện công việc về nghiệp vụ chuyên môn tài chính kế toán theo quy định của Nhà nước. Theo dõi sự vận động vốn kinh doanh của doanh nghiệp dưới mọi hình thái và cố vấn cho Ban lãnh đạo về các vấn đề liên quan.', 'L2.002'),
(3, 'Phòng Hành Chính', 'Tiếp nhận và xử lý các công việc nội bộ trong doanh nghiệp. Tiếp khách, xử lý các công văn mà khách hàng gửi tới, tổ chức hội thảo hay hội nghị cho công ty và lưu trữ, phát hành văn bản, con dấu và chịu trách nhiệm trước ban giám đốc và pháp luật về tính pháp lý.', 'L2.001'),
(4, 'Phòng Nhân Sự', 'Lập kế hoạch và triển khai công tác tuyển dụng nhằm đáp ứng nhu cầu hoạt động của doanh nghiệp. Tiếp cận các kênh truyền thông để đưa thông tin tuyển dụng đến gần hơn với ứng viên tiềm năng và tạo mối liên kết với các nguồn cung ứng nhân lực như trường đại học, cao đẳng, đơn vị đào tạo nghề… ', 'L3.001'),
(5, 'Phòng Marketing', 'Xây dựng và quản lý hệ thống chăm sóc khách hàng tốt nhất. Thiết kế chương trình khuyến mãi và bảo hành sản phẩm cho khách hàng và tham gia tài trợ các hoạt động xã hội để quảng bá hình ảnh thương hiệu.', 'L1.001'),
(6, 'Phòng Kinh Doanh', 'Nghiên cứu và thực hiện các công việc tiếp cận thị trường, đưa ra các chiến lược giới thiệu sản phẩm và việc mở rộng phát triển thị trường và lên kế hoạch tổ chức và thực hiện các hoạt động kinh doanh cũng như tính toán báo cáo về giá thành để tạo hợp đồng với khách.', 'L1.002'),
(7, 'Phòng Nghiên cứu và phát triển Sản phẩm', 'Nghiên cứu định hướng và phát triển sản phẩm, cải tiến công nghệ sản xuất, nghiên cứu và thay thế dần các vật liệu và công nghệ nhằm nâng cao chất lượng sản phẩm và nghiên cứu nội địa hóa một số nguyên liệu nhằm tăng giá trị và chủ động trong sản xuất với chi phí hợp lý hơn.', 'L4.002'),
(9, 'Phòng Giáo Dục', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TASK_ID` int(11) NOT NULL,
  `TIEU_DE` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `MO_TA` text DEFAULT NULL,
  `DEADLINE` datetime DEFAULT NULL,
  `SUPPORT_FOLDER_PATH` text DEFAULT NULL,
  `SUBMIT_FOLDER_PATH` text DEFAULT NULL,
  `message_employee` text DEFAULT NULL,
  `message_tlead` text DEFAULT NULL,
  `DATE_CREATE` date DEFAULT current_timestamp(),
  `SUBMIT_DATE` datetime DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TASK_ID`, `TIEU_DE`, `MO_TA`, `DEADLINE`, `SUPPORT_FOLDER_PATH`, `SUBMIT_FOLDER_PATH`, `message_employee`, `message_tlead`, `DATE_CREATE`) VALUES
(1, 'Kế hoạch dự án công nghệ thông tin cho công ty', 'Trong kế hoạch phải cho thấy hiểu rõ mục tiêu, chi phí làm việc cũng như nguồn nhân lực cho phòng công nghệ thông tin cần bổ sung', '2022-01-10 15:00:00', '../file_gui/kg8I5lFSnN/huongdanne.txt', '', '', NULL, '2022-01-01'),
(2, 'Thống kê báo cáo doanh thu', 'Trong báo cáo phải có phân tích nghiệp vụ và đồ thị doanh thu trong năm 2021', NULL, NULL, NULL, NULL, NULL, '2021-11-19'),
(3, 'Bảng kế hoạch công việc năm 2022', 'Trong bảng kế hoạch phải có chi tiết thời gian, địa điểm và xây dựng trước kịch bản công việc', NULL, NULL, NULL, NULL, NULL, '2021-12-16'),
(4, 'Thống kê nhân sự mới của các trường đại học', 'Nghiên cứu, phân tích kĩ những sinh viên có thành tích tốt và các dự án sinh viên đó tham gia', '2022-01-07 08:00:00', '../file_gui/yanYfyHe3M/data.csv', NULL, NULL, NULL, '2021-01-05'),
(5, 'Kế hoạch tiếp thị sản phẩm', 'Có kế hoạch cụ thể cho dự án tiếp thị sản phẩm mới, lên ý tưởng cụ thể', NULL, NULL, NULL, NULL, NULL, '2022-01-01'),
(6, 'Bảng phân tích thị trường năm 2022', 'Thu thập thông tin tình hình các doanh nghiệp khác và ngành nào hay sản phẩm nào đang có xu hướng phát triển mạnh mẽ trong năm nay', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(7, 'Ứng dụng điểm danh bằng Trí Tuệ Nhân Tạo', 'Nhận diện khuôn mặt và ghi nhận điểm danh cho nhân viên công ty', NULL, NULL, NULL, NULL, NULL, '2021-12-23'),
(8, 'Tạo trang web tiếp thị sản phẩm', 'Trang web có phân quyền truy cập cho nhân viên và cho khách hàng riêng', '2022-01-08 15:00:00', '../file_gui/9CWtqp2XsH/demo.zip', '', '', NULL, '2022-01-04'),
(9, 'Phiếu thu chi trong ngày của việc marketing', 'Phải có thông tin chi tiết những khoảng chi tiêu cho việc marketing trong ngày', NULL, NULL, NULL, NULL, NULL, '2021-12-02'),
(10, 'Thống kê lại các văn bản pháp luật của công ty', 'Trong bản thống kê phải có ghi rõ ngày tháng cũng như chi tiết từng loại văn bản', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(11, 'Bảng kế hoạch tuyển dụng', 'Có ngày tháng, địa điểm tuyển dụng rõ ràng và cả chi phí cụ thể cho ngày tuyển dụng', '2022-01-05 11:59:00', '../file_gui/A3kynytwAq/baoCao.docx', '', '', NULL, '2022-01-04'),
(12, 'Báo cáo công việc tiếp thị tháng 12', 'Chỉ chú trọng kết quả', NULL, NULL, NULL, NULL, NULL, '2021-12-02'),
(13, 'Bảng phân tích thị trường năm 2022', 'Thu thập thông tin tình hình các doanh nghiệp khác và ngành nào hay sản phẩm nào đang có xu hướng phát triển mạnh mẽ trong năm nay', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(14, 'Nghiên cứu mô hình đề xuất sản phẩm', 'Đề xuất sản phẩm theo đánh giá của người dùng', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(15, 'Xây dựng ứng dụng di động để bán sản phẩm', 'Ứng dụng dễ nhìn, đầy đủ các chức năng', '2022-02-10 12:00:00', '../file_gui/3e636mEz02/test.js', NULL, NULL, NULL, '2022-01-04'),
(16, 'Bảng phát lương cho nhân viên', 'Chỉ cần có tên nhân viên, số tiền họ nhận được và tiền thưởng', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(17, 'Làm một bảng hợp đồng buôn bán ở lề đường', 'Yêu cầu có đầy đủ thông tin theo quy định của phường, xã', NULL, NULL, NULL, NULL, NULL, '2022-01-01'),
(18, 'Lên danh sách nhân sự có nhu cầu nghỉ việc', 'Có đầy đủ thông tin, lí do họ muốn nghỉ việc', '2022-01-20 15:00:00', '../file_gui/A3kynytwAq/baoCao.docx', NULL, NULL, NULL, '2022-01-04'),
(19, 'Lên kế hoạch cho chương trình tiếp thị sản phẩm ng', 'Có địa điểm cụ thể, lí do chọn địa điểm đó và kế hoạch hoàn chỉnh cho chương trình tiếp thị', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(20, 'Lên kế hoạch buôn bán ngoài lề đường cho bộ phận t', 'Nêu rõ cách thức bán hàng, văn phong cũng như kiến nghị địa điểm bán hàng.', NULL, NULL, NULL, NULL, NULL, '2022-01-01'),
(21, 'Nghiên cứu mã vạch riêng cho sản phẩm công ty', 'Mã vạch phải rõ ràng, dễ quét để trích xuất thông tin', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(22, 'Kế hoạch dự án công nghệ thông tin tháng 1', 'Trong kế hoạch phải cho thấy hiểu rõ mục tiêu, chi phí làm việc cũng như nguồn nhân lực cho phòng công nghệ thông tin cần bổ sung', '2022-01-01 08:33:31', '../file_gui/AuM2eW7ygj/baocao.docx', '../file_nop/Lsmzh1u6wQ/Bacon.zip', NULL, NULL, '2022-01-03'),
(23, 'Thống kê báo cáo doanh thu tháng 12', 'Trong báo cáo phải có phân tích nghiệp vụ và đồ thị doanh thu tháng 12', NULL, NULL, NULL, NULL, NULL, '2022-01-01'),
(24, 'Bảng kế hoạch công việc cho tháng 1', 'Trong bảng kế hoạch phải có chi tiết thời gian, địa điểm và xây dựng trước kịch bản công việc', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(25, 'Thống kê nhân sự mới vào công ty', 'Nghiên cứu, phân tích kĩ những sinh viên có thành tích tốt và các dự án sinh viên đó tham gia', '2022-02-20 15:30:00', '../file_gui/IaYAlpc84n/document.pdf', '../file_nop/F4UYIr02D8/Lab01.zip', NULL, NULL, '2022-01-03'),
(26, 'Kế hoạch tiếp thị sản phẩm tháng 1', 'Có kế hoạch cụ thể cho dự án tiếp thị sản phẩm mới, lên ý tưởng cụ thể', NULL, '', NULL, NULL, NULL, '2022-01-04'),
(27, 'Bảng phân tích thị trường tháng 1', 'Thu thập thông tin tình hình các doanh nghiệp khác và ngành nào hay sản phẩm nào đang có xu hướng phát triển mạnh mẽ trong năm nay', NULL, NULL, NULL, NULL, NULL, '2022-01-01'),
(28, 'Ứng dụng trao đổi văn bản riêng cho công ty', 'Có đầy đủ chức năng như zalo', NULL, NULL, NULL, NULL, NULL, '2022-01-01'),
(29, 'Ứng dụng xử lí tự động đóng gói hàng hóa', 'Chương trình phải biết phân biệt các mặt hàng khác nhau.', '2022-01-04 15:00:00', '../file_gui/XIaKJYV81g/test_1.zip+../file_gui/C1rXOk2stK/huongdanne.txt', '../file_nop/9Neey26yUL/MC001.zip', NULL, NULL, '2022-12-23'),
(30, 'Báo cáo kinh phí của dự án ứng dụng xử lí tự động ', 'Trong báo cáo phải có chi tiết việc thu phí cho nhân viên, điện và cả các máy móc', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(31, 'Làm giấy tờ mua đất làm nhà máy công nghiệp', 'Chỉ cần có đầy đủ thông tin theo quy định pháp luật', NULL, NULL, NULL, NULL, NULL, '2021-12-16'),
(32, 'Báo cáo nhân sự đi thực tập ở nước ngoài', 'Nêu thành tích, khả năng phát triển cũng như các dự án mà nhân sự đó tham gia', '2022-04-06 00:00:00', '../file_gui/isUPVSCAiE/demo.rar', '../file_nop/WuedeDYo8O/baocao.docx', NULL, NULL, '2021-12-18'),
(33, 'Báo cáo chương trình tiếp thị tháng 12', 'Có thông tin cụ thể của dự án tiếp thị sản phẩm, ý tưởng cụ thể và kết quả đạt được', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(34, 'Báo cáo kế hoạch kinh doanh mặt hàng tiêu dùng', 'Đầy đủ thông tin và đặt biệt kết quả đạt được, lợi nhuận', NULL, NULL, NULL, NULL, NULL, '2021-12-11'),
(35, 'Nghiên cứu kĩ thuật bảo quản mặt hàng tiêu dùng', 'Tuân thủ theo quy định của Bộ y tế', NULL, NULL, NULL, NULL, NULL, '2022-12-02'),
(36, 'Kế hoạch dự án công nghệ thông tin tháng 12', 'Trong kế hoạch phải cho thấy hiểu rõ mục tiêu, chi phí làm việc cũng như nguồn nhân lực cho phòng công nghệ thông tin cần bổ sung', '2022-01-20 23:59:00', '../file_gui/Dhwh2w1xjl/baoCao.pdf', '../file_nop/gu2aWSSR6z/Lab02.zip', 'Hoàn thành ngày sớm', 'Ủa em', '2022-01-04'),
(37, 'Thống kê báo cáo doanh thu tháng 11', 'Trong báo cáo phải có phân tích nghiệp vụ và đồ thị doanh thu tháng 11', NULL, NULL, NULL, NULL, NULL, '2022-12-02'),
(38, 'Bảng kế hoạch công việc cho tháng 12', 'Trong bảng kế hoạch phải có chi tiết thời gian, địa điểm và xây dựng trước kịch bản công việc', NULL, NULL, NULL, NULL, NULL, '2021-12-15'),
(39, 'Thống kê nhân sự xuất sắc tháng 11', 'Số dự án mà nhân sự đó tham gia cũng như lợi ích mà nó đem lại', '2022-01-02 08:00:51', '../file_gui/9K9uulMJRu/danhsach.csv', '../file_nop/HGz2MDHWqm/seven11.zip', NULL, NULL, '2022-01-04'),
(40, 'Kế hoạch tiếp thị sản phẩm tháng 12', 'Có kế hoạch cụ thể cho dự án tiếp thị sản phẩm mới, lên ý tưởng cụ thể', NULL, NULL, NULL, NULL, NULL, '2021-12-01'),
(41, 'Bảng phân tích thị trường tháng 12', 'Thu thập thông tin tình hình các doanh nghiệp khác và ngành nào hay sản phẩm nào đang có xu hướng phát triển mạnh mẽ trong năm nay', NULL, NULL, NULL, NULL, NULL, '2022-01-04'),
(42, 'Nghiên cứu cách đo lường hạn sử dụng cho sản phẩm', 'Áp dụng các công nghệ hiện đại để nghiên cứu và có một bài phân tích cho công ty mang lên báo nghiên cứu khoa học', NULL, NULL, NULL, NULL, NULL, '2022-12-03'),
(58, 'Nộp cuối kì', 'task _ 1 ', '2022-01-15 12:00:00', '../file_gui/H19Rdlrs/Final.pdf', NULL, NULL, NULL, '2022-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `task_info`
--

CREATE TABLE `task_info` (
  `TASK_ID` int(11) NOT NULL,
  `MA_NGUOI_GIAO` int(11) NOT NULL,
  `MA_NGUOI_NHAN` int(11) NOT NULL,
  `STATUS` enum('New','In progress','Canceled','Waiting','Rejected','Completed') DEFAULT 'New',
  `COMPLETE_STATUS` enum('Bad','Ok','Good','None') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_info`
--

INSERT INTO `task_info` (`TASK_ID`, `MA_NGUOI_GIAO`, `MA_NGUOI_NHAN`, `STATUS`, `COMPLETE_STATUS`) VALUES
(1, 3, 14, 'New', 'None'),
(2, 5, 1, 'New', 'None'),
(3, 4, 12, 'New', 'None'),
(4, 3, 14, 'New', 'None'),
(5, 6, 13, 'New', 'None'),
(6, 11, 8, 'New', 'None'),
(7, 9, 7, 'New', 'None'),
(8, 3, 14, 'In progress', 'None'),
(9, 5, 1, 'In progress', 'None'),
(10, 4, 12, 'In progress', 'None'),
(11, 3, 14, 'In progress', 'None'),
(12, 6, 13, 'In progress', 'None'),
(13, 11, 8, 'In progress', 'None'),
(14, 9, 7, 'In progress', 'None'),
(15, 3, 14, 'Canceled', 'None'),
(16, 5, 1, 'Canceled', 'None'),
(17, 4, 12, 'Canceled', 'None'),
(18, 3, 14, 'Canceled', 'None'),
(19, 6, 13, 'Canceled', 'None'),
(20, 11, 8, 'Canceled', 'None'),
(21, 9, 7, 'Canceled', 'None'),
(22, 3, 14, 'Waiting', 'None'),
(23, 5, 1, 'Waiting', 'None'),
(24, 4, 12, 'Waiting', 'None'),
(25, 3, 14, 'Waiting', 'None'),
(26, 6, 13, 'Waiting', 'None'),
(27, 11, 8, 'Waiting', 'None'),
(28, 9, 7, 'Waiting', 'None'),
(29, 3, 14, 'Rejected', 'None'),
(30, 5, 1, 'Rejected', 'None'),
(31, 4, 12, 'Rejected', 'None'),
(32, 3, 14, 'Rejected', 'None'),
(33, 6, 13, 'Rejected', 'None'),
(34, 11, 8, 'Rejected', 'None'),
(35, 9, 7, 'Rejected', 'None'),
(36, 3, 14, 'Completed', 'Bad'),
(37, 5, 1, 'Completed', 'Ok'),
(38, 4, 12, 'Completed', 'Good'),
(39, 3, 14, 'Completed', 'Ok'),
(40, 6, 13, 'Completed', 'Bad'),
(41, 11, 8, 'Completed', 'Bad'),
(42, 9, 7, 'Completed', 'Good'),
(58, 3, 14, 'New', NULL);

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
(2, 5),
(3, 4),
(4, 2),
(5, 6),
(6, 11),
(7, 9),
(9, 15);

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
(1, 'Tân Kim', '../image/1vSole7m/tankim.jpg', '404, Thôn 1, Phường 56, Huyện Thịnh Thụy\nHà Tĩnh', '0186018571', '1990-06-01', '1', 'inguy@diep.info.vn'),
(2, 'Quỳnh Vũ', '../image/dAOFcclA/quynhvu.jpg', '479 Phố Đoàn Tâm Yến, Ấp Hiếu Bích, Quận Nhân\nĐà Nẵng', '8465085261', '1995-12-09', '0', 'hanh89@gmail.com'),
(3, 'Quang Võ', '../image/VdQDbfgS/quangvo.jpg', '74 Phố Quang, Phường Hiền, Quận Trung Khu\nBắc Giang', '0283935612', '1980-09-16', '1', 'klu@phung.info.vn\n'),
(4, 'Thịnh Nguyễn', '../image/IXtahr0A/thinhnguyen.jpg', '79, Thôn Lạc Sang, Ấp Chiêu Hảo, Quận 2\nĐắk Lắk', '0166196042', '1980-08-01', '1', 'vung@dang.gov.vn'),
(5, 'Nga Mỹ', '../image/dc0wtf1M/ngamy.jpg', '22, Ấp Sỹ Lạc, Xã 8, Huyện Phượng\nKon Tum', '8425734083', '1986-03-12', '0', 'thuy.luong@can.com'),
(6, 'Thế Nam', '../image/R0cwZdlf/thenam.jpg', '1107 Phố Âu Anh Duy, Phường Khoa, Quận Thu Ý\nLai Châu', '8424037119', '1975-02-01', '1', 'hung.ong@ong.biz'),
(7, 'Long Trọng', '../image/PIZR1Lzb/longtrong.jpg', '3842, Thôn Vân, Phường Nghị, Huyện Bùi Điền\nKhánh Hòa', '0163844090', '2000-06-03', '1', 'ttrung@hotmail.com'),
(8, 'Phúc Sỹ', '../image/4DpmqEEm/phusyjpg.jpg', '8083 Phố Lò Duyên Cát, Phường Trang, Quận Đài\nSơn La', '0156878658', '1985-06-08', '1', 'can.hoa@gmail.com'),
(9, 'Bá Huy', '../image/FjAvHHlG/bahuy.jpg', '05 Phố Phí Hảo Huy, Phường Quỳnh Khu, Huyện Thanh Trân\nBắc Giang', '0943777267', '1999-02-04', '1', 'tra.phi@vo.com'),
(10, 'Việt Lý', '../image/5R5naMUj/vietly.jpg', '0 Phố Chiêm Bình Thụy, Xã Hà, Huyện Đoàn\nĐắk Lắk', '0589777870', '1986-07-12', '1', 'nhan75@trang.com'),
(11, 'Anh Khoa', '../image/XZ0FDSHK/anhkhoa.jpg', '20 Thôn Bình Lục, Xã Vĩnh Kí, Huyện Lâm Đồng', '0209888128', '2001-05-21', '1', 'khoanguyen@.com'),
(12, 'Phú Thành', '../image/Xkbl9Q7g/thanhnguyen.jpg', '9 Phố Hàng Mã, Quận Hà Thanh, Thành Phố Hà Nội', '0372198562', '1990-02-08', '1', 'thanhphu82@trang.com'),
(13, 'Thảo Nguyên', '../image/Zk44UN1W/thaonguyen.jpg', '981 Đường Cách Mạng Tháng 8, Phường Tân Bình, Thành Phố Hồ Chí Minh', '0811200121', '2001-11-08', '1', 'nguyenthao811@trang.com'),
(14, 'Trung Hiếu', '../image/U0pwstOg/trunghieu.jpg', '377 Thôn An Vĩnh, Xã Hà Thiên, Huyện Phú Yên', '0971180256', '1998-01-12', '1', 'hieu12@trang.com'),
(15, 'test', NULL, '377 Thôn An Vĩnh, Xã Hà Thiên, Huyện Phú Yên', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `MA_NV` int(11) NOT NULL,
  `USER_NAME` char(150) DEFAULT NULL,
  `MA_PHONG_BAN` int(11) DEFAULT NULL,
  `CHUC_VU` enum('admin','employee') DEFAULT NULL,
  `MA_USER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`MA_NV`, `USER_NAME`, `MA_PHONG_BAN`, `CHUC_VU`, `MA_USER`) VALUES
(1, 'tankimcokhi', 1, 'employee', 1),
(2, 'quynhxinhdep123', 4, 'employee', 2),
(3, 'quangit', 1, 'employee', 3),
(4, 'thinhnguyen', 3, 'employee', 4),
(5, 'ngamytho', 2, 'employee', 5),
(6, 'namvippro123', 5, 'admin', 6),
(7, 'longtrong123', 7, 'admin', 7),
(8, 'phucmapyoutuber', 6, 'employee', 8),
(9, 'huybaHN', 7, 'employee', 9),
(10, 'vietlatui', 4, 'employee', 10),
(11, 'akaichi21', 6, 'employee', 11),
(12, 'thanhnguyen', 3, 'employee', 12),
(13, 'thaonguyen811', 5, 'employee', 13),
(14, 'hieutran795', 1, 'employee', 14),
(15, 'test', 9, NULL, 15);

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
  ADD KEY `FK_USER_INFO_MA_PHONG_BAN` (`MA_PHONG_BAN`),
  ADD KEY `FK_USER_INFO_MA_USER` (`MA_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `don_nghi`
--
ALTER TABLE `don_nghi`
  MODIFY `MA_NGHI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `phong_ban`
--
ALTER TABLE `phong_ban`
  MODIFY `MA_PHONG_BAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TASK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `MA_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `FK_USER_INFO_MA_PHONG_BAN` FOREIGN KEY (`MA_PHONG_BAN`) REFERENCES `phong_ban` (`MA_PHONG_BAN`),
  ADD CONSTRAINT `FK_USER_INFO_MA_USER` FOREIGN KEY (`MA_USER`) REFERENCES `user` (`MA_USER`),
  ADD CONSTRAINT `FK_USER_INFO_USER_NAME` FOREIGN KEY (`USER_NAME`) REFERENCES `account` (`USER_NAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
