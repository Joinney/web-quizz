-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 15, 2024 lúc 09:21 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webmos`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baidang`
--

CREATE TABLE `baidang` (
  `idbaidang` int(11) NOT NULL,
  `idtaikhoan` int(11) DEFAULT NULL,
  `tieude` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thoigian` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `baidang`
--

INSERT INTO `baidang` (`idbaidang`, `idtaikhoan`, `tieude`, `image`, `thoigian`) VALUES
(1, 3, 'Chọn hộ cái nào mn !', 'hoidap.PNG', '2024-09-12 22:18:26'),
(4, 4, 'Xin chào! mình là thành viên mới.', '1.jpg', '2024-09-13 14:50:29'),
(5, 3, 'thử', 'tonghopdethi.PNG', '2024-09-14 14:47:03'),
(13, 3, 'thửu', 'word.jpg', '2024-09-14 21:08:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `idbinhluan` int(11) NOT NULL,
  `idbaidang` int(11) DEFAULT NULL,
  `idtaikhoan` int(11) DEFAULT NULL,
  `binhluan` text NOT NULL,
  `thoigian` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`idbinhluan`, `idbaidang`, `idtaikhoan`, `binhluan`, `thoigian`) VALUES
(3, 5, 3, 'okkk', '2024-09-14 18:23:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `iddanhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`iddanhmuc`, `tendanhmuc`) VALUES
(1, 'Word'),
(2, 'Excel'),
(3, 'Powerpoint'),
(4, 'Đề thi tổng hợp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dethi`
--

CREATE TABLE `dethi` (
  `iddethi` int(11) NOT NULL,
  `tendethi` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `thoigian` time NOT NULL,
  `danhgia` float DEFAULT NULL,
  `iddanhmuc` int(11) DEFAULT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `soluongnguoisudung` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dethi`
--

INSERT INTO `dethi` (`iddethi`, `tendethi`, `mota`, `thoigian`, `danhgia`, `iddanhmuc`, `hinhanh`, `soluongnguoisudung`) VALUES
(1, 'Đề Thi Kiến Thức Word', 'Kiểm tra kỹ năng sử dụng Microsoft Word.', '00:10:00', 4.5, 1, 'wordethi.png', 35),
(2, 'Đề Thi Kiến Thức Excel', 'Kiểm tra kỹ năng sử dụng Microsoft Excel.', '00:10:00', 4.6, 2, 'Excelethi.png', 32),
(3, 'Đề Thi Kiến Thức PowerPoint', 'Kiểm tra kỹ năng sử dụng Microsoft PowerPoint.', '00:10:00', 4.4, 3, 'powerlethi.png', 6),
(4, 'Đề Thi Tổng Hợp Phần Mềm Văn Phòng', 'Kiểm tra tổng hợp kỹ năng Word, Excel, và PowerPoint.', '00:30:00', 4.7, 4, 'tonghopdethi.PNG', 6),
(7, 'thư', 'ssss', '00:20:00', 0, 1, 'adminn.jpg', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dscauhoi`
--

CREATE TABLE `dscauhoi` (
  `idcauhoi` int(11) NOT NULL,
  `cauhoi` varchar(250) NOT NULL,
  `a` varchar(250) DEFAULT NULL,
  `b` varchar(250) DEFAULT NULL,
  `c` varchar(250) DEFAULT NULL,
  `d` varchar(250) DEFAULT NULL,
  `iddethi` int(11) DEFAULT NULL,
  `traloi` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dscauhoi`
--

INSERT INTO `dscauhoi` (`idcauhoi`, `cauhoi`, `a`, `b`, `c`, `d`, `iddethi`, `traloi`) VALUES
(1, 'Để chèn một slide mới vào bài thuyết trình, bạn sử dụng tab nào?', 'Home', 'Insert', 'Design', 'Transitions', 3, 'Home'),
(2, 'Để thay đổi kiểu chuyển tiếp giữa các slide, bạn sử dụng tab nào?', 'Transitions', 'Animations', 'Design', 'Slide Show', 3, 'Transitions'),
(3, 'Để thêm một hiệu ứng động vào một đối tượng, bạn sử dụng tab nào?', 'Animations', 'Transitions', 'Design', 'Insert', 3, 'Animations'),
(4, 'Để chèn một video vào slide, bạn sử dụng công cụ nào?', 'Insert > Video', 'Home > Media', 'Design > Video', 'Transitions > Video', 3, 'Insert > Video'),
(5, 'Để thay đổi thiết kế của toàn bộ bài thuyết trình, bạn sử dụng tab nào?', 'Design', 'Insert', 'Transitions', 'Animations', 3, 'Design'),
(6, 'Để áp dụng một định dạng chung cho tất cả các slide, bạn sử dụng?', 'Slide Master', 'Layout', 'Themes', 'Format', 3, 'Slide Master'),
(7, 'Để chèn một đồ thị vào slide, bạn sử dụng tab nào?', 'Insert', 'Design', 'Animations', 'Transitions', 3, 'Insert'),
(8, 'Để chèn một hộp văn bản vào slide, bạn sử dụng tab nào?', 'Insert', 'Home', 'Design', 'Animations', 3, 'Insert'),
(9, 'Để xem trước hiệu ứng chuyển tiếp trên slide, bạn sử dụng công cụ nào?', 'Preview', 'Animations', 'Transitions', 'Slide Show', 3, 'Preview'),
(10, 'Để thay đổi thứ tự của các slide trong bài thuyết trình, bạn sử dụng?', 'Slide Sorter View', 'Normal View', 'Outline View', 'Reading View', 3, 'Slide Sorter View'),
(11, 'Để chèn một bảng vào tài liệu Word, bạn sử dụng tab nào?', 'Insert', 'Home', 'Design', 'View', 1, 'Insert'),
(12, 'Để thay đổi kích thước văn bản, bạn sử dụng công cụ nào?', 'Font Size', 'Text Size', 'Paragraph', 'Style', 1, 'Font Size'),
(13, 'Cách nào để chèn một ảnh vào tài liệu?', 'Tab Insert > Pictures', 'Tab Home > Pictures', 'Tab Design > Pictures', 'Tab Layout > Pictures', 1, 'Tab Insert > Pictures'),
(14, 'Để tạo một tiêu đề trong tài liệu Word, bạn sử dụng công cụ nào?', 'Heading Styles', 'Font Style', 'Text Effects', 'Paragraph', 1, 'Heading Styles'),
(15, 'Để thêm một trang mới vào tài liệu, bạn chọn?', 'Insert > Blank Page', 'Layout > Page Break', 'Home > New Page', 'Design > Page Setup', 1, 'Insert > Blank Page'),
(16, 'Để tạo danh sách số thứ tự, bạn chọn?', 'Home > Numbering', 'Insert > Bullets', 'Layout > Numbering', 'Design > Lists', 1, 'Home > Numbering'),
(17, 'Để chèn một liên kết vào tài liệu, bạn sử dụng tab nào?', 'Insert', 'Home', 'Design', 'View', 1, 'Insert'),
(18, 'Để sử dụng công cụ kiểm tra chính tả, bạn chọn?', 'Review > Spelling', 'Home > Spell Check', 'Insert > Proofing', 'Design > Grammar', 1, 'Review > Spelling'),
(19, 'Để thay đổi kiểu chữ trong tài liệu, bạn sử dụng công cụ nào?', 'Font', 'Style', 'Effects', 'Format', 1, 'Font'),
(20, 'Để áp dụng định dạng chữ nghiêng, bạn sử dụng?', 'Italic', 'Bold', 'Underline', 'Highlight', 1, 'Italic'),
(21, 'Hàm nào dùng để tính tổng của một dãy số?', 'SUM', 'AVERAGE', 'COUNT', 'MAX', 2, 'SUM'),
(22, 'Để chèn một biểu đồ vào bảng tính, bạn sử dụng tab nào?', 'Insert', 'Home', 'Data', 'View', 2, 'Insert'),
(23, 'Để áp dụng định dạng số tiền, bạn sử dụng?', 'Currency', 'Percent', 'Date', 'Time', 2, 'Currency'),
(24, 'Hàm nào dùng để tìm giá trị lớn nhất trong một dãy số?', 'MAX', 'MIN', 'SUM', 'AVERAGE', 2, 'MAX'),
(25, 'Để sắp xếp dữ liệu theo thứ tự tăng dần, bạn chọn?', 'Sort A to Z', 'Sort Z to A', 'Filter', 'Group', 2, 'Sort A to Z'),
(26, 'Để chèn một ô mới vào bảng tính, bạn nhấn phím nào?', 'Ctrl + Shift + =', 'Ctrl + =', 'Ctrl + N', 'Ctrl + M', 2, 'Ctrl + Shift + ='),
(27, 'Hàm nào dùng để đếm số ô chứa dữ liệu?', 'COUNTA', 'COUNTIF', 'COUNT', 'SUM', 2, 'COUNTA'),
(28, 'Để bảo vệ một bảng tính khỏi việc chỉnh sửa, bạn sử dụng?', 'Protect Sheet', 'Lock Sheet', 'Hide Sheet', 'Share Sheet', 2, 'Protect Sheet'),
(29, 'Để tính giá trị trung bình của một dãy số, bạn sử dụng?', 'AVERAGE', 'SUM', 'COUNT', 'MEDIAN', 2, 'AVERAGE'),
(30, 'Để sử dụng hàm VLOOKUP, bạn cần có?', 'Một bảng dữ liệu và giá trị tìm kiếm', 'Một bảng dữ liệu và một giá trị số', 'Một giá trị và một ô', 'Một hàm COUNT và một ô', 2, 'Một bảng dữ liệu và giá trị tìm kiếm'),
(31, 'Để chèn một bảng vào tài liệu Word, bạn sử dụng tab nào?', 'Insert', 'Home', 'Design', 'View', 4, 'Insert'),
(32, 'Hàm nào dùng để tính tổng của một dãy số trong Excel?', 'SUM', 'AVERAGE', 'COUNT', 'MAX', 4, 'SUM'),
(33, 'Để chèn một slide mới vào bài thuyết trình PowerPoint, bạn sử dụng tab nào?', 'Home', 'Insert', 'Design', 'Transitions', 4, 'Home'),
(34, 'Để thay đổi kích thước văn bản trong Word, bạn sử dụng công cụ nào?', 'Font Size', 'Text Size', 'Paragraph', 'Style', 4, 'Font Size'),
(35, 'Để chèn một biểu đồ vào bảng tính Excel, bạn sử dụng tab nào?', 'Insert', 'Home', 'Data', 'View', 4, 'Insert'),
(36, 'Để thay đổi kiểu chuyển tiếp giữa các slide trong PowerPoint, bạn sử dụng tab nào?', 'Transitions', 'Animations', 'Design', 'Slide Show', 4, 'Transitions'),
(37, 'Để tạo danh sách số thứ tự trong Word, bạn chọn?', 'Home > Numbering', 'Insert > Bullets', 'Layout > Numbering', 'Design > Lists', 4, 'Home > Numbering'),
(38, 'Hàm nào dùng để đếm số ô chứa dữ liệu trong Excel?', 'COUNTA', 'COUNTIF', 'COUNT', 'SUM', 4, 'COUNTA'),
(39, 'Để chèn một ảnh vào tài liệu Word, bạn sử dụng tab nào?', 'Insert', 'Home', 'Design', 'View', 4, 'Insert'),
(40, 'Để bảo vệ một bảng tính khỏi việc chỉnh sửa trong Excel, bạn sử dụng?', 'Protect Sheet', 'Lock Sheet', 'Hide Sheet', 'Share Sheet', 4, 'Protect Sheet'),
(42, 'ssss', 'ấdss', 'aaaa', 'dđ', 'vvv', 7, 'vvv');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketqua`
--

CREATE TABLE `ketqua` (
  `idketqua` int(11) NOT NULL,
  `idtaikhoan` int(11) DEFAULT NULL,
  `iddethi` int(11) DEFAULT NULL,
  `thoigian` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cauhoitext` text DEFAULT NULL,
  `diem` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ketqua`
--

INSERT INTO `ketqua` (`idketqua`, `idtaikhoan`, `iddethi`, `thoigian`, `cauhoitext`, `diem`) VALUES
(5, 3, 1, '2024-09-13 01:51:51', '[{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t b\\u1ea3ng v\\u00e0o t\\u00e0i li\\u1ec7u Word, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Design\",\"d\":\"View\"},\"user_answer\":\"b\",\"correct_answer\":\"Insert\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 thay \\u0111\\u1ed5i k\\u00edch th\\u01b0\\u1edbc v\\u0103n b\\u1ea3n, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Font Size\",\"b\":\"Text Size\",\"c\":\"Paragraph\",\"d\":\"Style\"},\"user_answer\":\"a\",\"correct_answer\":\"Font Size\",\"is_correct\":true},{\"question\":\"C\\u00e1ch n\\u00e0o \\u0111\\u1ec3 ch\\u00e8n m\\u1ed9t \\u1ea3nh v\\u00e0o t\\u00e0i li\\u1ec7u?\",\"options\":{\"a\":\"Tab Insert > Pictures\",\"b\":\"Tab Home > Pictures\",\"c\":\"Tab Design > Pictures\",\"d\":\"Tab Layout > Pictures\"},\"user_answer\":\"b\",\"correct_answer\":\"Tab Insert > Pictures\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 t\\u1ea1o m\\u1ed9t ti\\u00eau \\u0111\\u1ec1 trong t\\u00e0i li\\u1ec7u Word, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Heading Styles\",\"b\":\"Font Style\",\"c\":\"Text Effects\",\"d\":\"Paragraph\"},\"user_answer\":\"b\",\"correct_answer\":\"Heading Styles\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 th\\u00eam m\\u1ed9t trang m\\u1edbi v\\u00e0o t\\u00e0i li\\u1ec7u, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Insert > Blank Page\",\"b\":\"Layout > Page Break\",\"c\":\"Home > New Page\",\"d\":\"Design > Page Setup\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert > Blank Page\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 t\\u1ea1o danh s\\u00e1ch s\\u1ed1 th\\u1ee9 t\\u1ef1, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Home > Numbering\",\"b\":\"Insert > Bullets\",\"c\":\"Layout > Numbering\",\"d\":\"Design > Lists\"},\"user_answer\":\"b\",\"correct_answer\":\"Home > Numbering\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t li\\u00ean k\\u1ebft v\\u00e0o t\\u00e0i li\\u1ec7u, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Design\",\"d\":\"View\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 ki\\u1ec3m tra ch\\u00ednh t\\u1ea3, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Review > Spelling\",\"b\":\"Home > Spell Check\",\"c\":\"Insert > Proofing\",\"d\":\"Design > Grammar\"},\"user_answer\":\"b\",\"correct_answer\":\"Review > Spelling\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 thay \\u0111\\u1ed5i ki\\u1ec3u ch\\u1eef trong t\\u00e0i li\\u1ec7u, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Font\",\"b\":\"Style\",\"c\":\"Effects\",\"d\":\"Format\"},\"user_answer\":\"d\",\"correct_answer\":\"Font\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 \\u00e1p d\\u1ee5ng \\u0111\\u1ecbnh d\\u1ea1ng ch\\u1eef nghi\\u00eang, b\\u1ea1n s\\u1eed d\\u1ee5ng?\",\"options\":{\"a\":\"Italic\",\"b\":\"Bold\",\"c\":\"Underline\",\"d\":\"Highlight\"},\"user_answer\":\"b\",\"correct_answer\":\"Italic\",\"is_correct\":false}]', 3),
(7, 3, 1, '2024-09-13 02:09:45', '[{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t b\\u1ea3ng v\\u00e0o t\\u00e0i li\\u1ec7u Word, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Design\",\"d\":\"View\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 thay \\u0111\\u1ed5i k\\u00edch th\\u01b0\\u1edbc v\\u0103n b\\u1ea3n, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Font Size\",\"b\":\"Text Size\",\"c\":\"Paragraph\",\"d\":\"Style\"},\"user_answer\":\"a\",\"correct_answer\":\"Font Size\",\"is_correct\":true},{\"question\":\"C\\u00e1ch n\\u00e0o \\u0111\\u1ec3 ch\\u00e8n m\\u1ed9t \\u1ea3nh v\\u00e0o t\\u00e0i li\\u1ec7u?\",\"options\":{\"a\":\"Tab Insert > Pictures\",\"b\":\"Tab Home > Pictures\",\"c\":\"Tab Design > Pictures\",\"d\":\"Tab Layout > Pictures\"},\"user_answer\":\"b\",\"correct_answer\":\"Tab Insert > Pictures\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 t\\u1ea1o m\\u1ed9t ti\\u00eau \\u0111\\u1ec1 trong t\\u00e0i li\\u1ec7u Word, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Heading Styles\",\"b\":\"Font Style\",\"c\":\"Text Effects\",\"d\":\"Paragraph\"},\"user_answer\":\"a\",\"correct_answer\":\"Heading Styles\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 th\\u00eam m\\u1ed9t trang m\\u1edbi v\\u00e0o t\\u00e0i li\\u1ec7u, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Insert > Blank Page\",\"b\":\"Layout > Page Break\",\"c\":\"Home > New Page\",\"d\":\"Design > Page Setup\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert > Blank Page\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 t\\u1ea1o danh s\\u00e1ch s\\u1ed1 th\\u1ee9 t\\u1ef1, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Home > Numbering\",\"b\":\"Insert > Bullets\",\"c\":\"Layout > Numbering\",\"d\":\"Design > Lists\"},\"user_answer\":\"a\",\"correct_answer\":\"Home > Numbering\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t li\\u00ean k\\u1ebft v\\u00e0o t\\u00e0i li\\u1ec7u, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Design\",\"d\":\"View\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 ki\\u1ec3m tra ch\\u00ednh t\\u1ea3, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Review > Spelling\",\"b\":\"Home > Spell Check\",\"c\":\"Insert > Proofing\",\"d\":\"Design > Grammar\"},\"user_answer\":\"a\",\"correct_answer\":\"Review > Spelling\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 thay \\u0111\\u1ed5i ki\\u1ec3u ch\\u1eef trong t\\u00e0i li\\u1ec7u, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Font\",\"b\":\"Style\",\"c\":\"Effects\",\"d\":\"Format\"},\"user_answer\":\"b\",\"correct_answer\":\"Font\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 \\u00e1p d\\u1ee5ng \\u0111\\u1ecbnh d\\u1ea1ng ch\\u1eef nghi\\u00eang, b\\u1ea1n s\\u1eed d\\u1ee5ng?\",\"options\":{\"a\":\"Italic\",\"b\":\"Bold\",\"c\":\"Underline\",\"d\":\"Highlight\"},\"user_answer\":\"b\",\"correct_answer\":\"Italic\",\"is_correct\":false}]', 7),
(13, 4, 1, '2024-09-13 14:33:53', '[{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t b\\u1ea3ng v\\u00e0o t\\u00e0i li\\u1ec7u Word, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Design\",\"d\":\"View\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 thay \\u0111\\u1ed5i k\\u00edch th\\u01b0\\u1edbc v\\u0103n b\\u1ea3n, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Font Size\",\"b\":\"Text Size\",\"c\":\"Paragraph\",\"d\":\"Style\"},\"user_answer\":\"c\",\"correct_answer\":\"Font Size\",\"is_correct\":false},{\"question\":\"C\\u00e1ch n\\u00e0o \\u0111\\u1ec3 ch\\u00e8n m\\u1ed9t \\u1ea3nh v\\u00e0o t\\u00e0i li\\u1ec7u?\",\"options\":{\"a\":\"Tab Insert > Pictures\",\"b\":\"Tab Home > Pictures\",\"c\":\"Tab Design > Pictures\",\"d\":\"Tab Layout > Pictures\"},\"user_answer\":\"d\",\"correct_answer\":\"Tab Insert > Pictures\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 t\\u1ea1o m\\u1ed9t ti\\u00eau \\u0111\\u1ec1 trong t\\u00e0i li\\u1ec7u Word, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Heading Styles\",\"b\":\"Font Style\",\"c\":\"Text Effects\",\"d\":\"Paragraph\"},\"user_answer\":\"a\",\"correct_answer\":\"Heading Styles\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 th\\u00eam m\\u1ed9t trang m\\u1edbi v\\u00e0o t\\u00e0i li\\u1ec7u, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Insert > Blank Page\",\"b\":\"Layout > Page Break\",\"c\":\"Home > New Page\",\"d\":\"Design > Page Setup\"},\"user_answer\":\"a\",\"correct_answer\":\"Insert > Blank Page\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 t\\u1ea1o danh s\\u00e1ch s\\u1ed1 th\\u1ee9 t\\u1ef1, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Home > Numbering\",\"b\":\"Insert > Bullets\",\"c\":\"Layout > Numbering\",\"d\":\"Design > Lists\"},\"user_answer\":\"c\",\"correct_answer\":\"Home > Numbering\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t li\\u00ean k\\u1ebft v\\u00e0o t\\u00e0i li\\u1ec7u, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Design\",\"d\":\"View\"},\"user_answer\":\"d\",\"correct_answer\":\"Insert\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 ki\\u1ec3m tra ch\\u00ednh t\\u1ea3, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Review > Spelling\",\"b\":\"Home > Spell Check\",\"c\":\"Insert > Proofing\",\"d\":\"Design > Grammar\"},\"user_answer\":\"c\",\"correct_answer\":\"Review > Spelling\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 thay \\u0111\\u1ed5i ki\\u1ec3u ch\\u1eef trong t\\u00e0i li\\u1ec7u, b\\u1ea1n s\\u1eed d\\u1ee5ng c\\u00f4ng c\\u1ee5 n\\u00e0o?\",\"options\":{\"a\":\"Font\",\"b\":\"Style\",\"c\":\"Effects\",\"d\":\"Format\"},\"user_answer\":\"a\",\"correct_answer\":\"Font\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 \\u00e1p d\\u1ee5ng \\u0111\\u1ecbnh d\\u1ea1ng ch\\u1eef nghi\\u00eang, b\\u1ea1n s\\u1eed d\\u1ee5ng?\",\"options\":{\"a\":\"Italic\",\"b\":\"Bold\",\"c\":\"Underline\",\"d\":\"Highlight\"},\"user_answer\":\"a\",\"correct_answer\":\"Italic\",\"is_correct\":true}]', 5),
(14, 4, 2, '2024-09-13 14:36:33', '[{\"question\":\"H\\u00e0m n\\u00e0o d\\u00f9ng \\u0111\\u1ec3 t\\u00ednh t\\u1ed5ng c\\u1ee7a m\\u1ed9t d\\u00e3y s\\u1ed1?\",\"options\":{\"a\":\"SUM\",\"b\":\"AVERAGE\",\"c\":\"COUNT\",\"d\":\"MAX\"},\"user_answer\":\"a\",\"correct_answer\":\"SUM\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t bi\\u1ec3u \\u0111\\u1ed3 v\\u00e0o b\\u1ea3ng t\\u00ednh, b\\u1ea1n s\\u1eed d\\u1ee5ng tab n\\u00e0o?\",\"options\":{\"a\":\"Insert\",\"b\":\"Home\",\"c\":\"Data\",\"d\":\"View\"},\"user_answer\":\"c\",\"correct_answer\":\"Insert\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 \\u00e1p d\\u1ee5ng \\u0111\\u1ecbnh d\\u1ea1ng s\\u1ed1 ti\\u1ec1n, b\\u1ea1n s\\u1eed d\\u1ee5ng?\",\"options\":{\"a\":\"Currency\",\"b\":\"Percent\",\"c\":\"Date\",\"d\":\"Time\"},\"user_answer\":\"a\",\"correct_answer\":\"Currency\",\"is_correct\":true},{\"question\":\"H\\u00e0m n\\u00e0o d\\u00f9ng \\u0111\\u1ec3 t\\u00ecm gi\\u00e1 tr\\u1ecb l\\u1edbn nh\\u1ea5t trong m\\u1ed9t d\\u00e3y s\\u1ed1?\",\"options\":{\"a\":\"MAX\",\"b\":\"MIN\",\"c\":\"SUM\",\"d\":\"AVERAGE\"},\"user_answer\":\"a\",\"correct_answer\":\"MAX\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 s\\u1eafp x\\u1ebfp d\\u1eef li\\u1ec7u theo th\\u1ee9 t\\u1ef1 t\\u0103ng d\\u1ea7n, b\\u1ea1n ch\\u1ecdn?\",\"options\":{\"a\":\"Sort A to Z\",\"b\":\"Sort Z to A\",\"c\":\"Filter\",\"d\":\"Group\"},\"user_answer\":\"a\",\"correct_answer\":\"Sort A to Z\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 ch\\u00e8n m\\u1ed9t \\u00f4 m\\u1edbi v\\u00e0o b\\u1ea3ng t\\u00ednh, b\\u1ea1n nh\\u1ea5n ph\\u00edm n\\u00e0o?\",\"options\":{\"a\":\"Ctrl + Shift + =\",\"b\":\"Ctrl + =\",\"c\":\"Ctrl + N\",\"d\":\"Ctrl + M\"},\"user_answer\":\"a\",\"correct_answer\":\"Ctrl + Shift + =\",\"is_correct\":true},{\"question\":\"H\\u00e0m n\\u00e0o d\\u00f9ng \\u0111\\u1ec3 \\u0111\\u1ebfm s\\u1ed1 \\u00f4 ch\\u1ee9a d\\u1eef li\\u1ec7u?\",\"options\":{\"a\":\"COUNTA\",\"b\":\"COUNTIF\",\"c\":\"COUNT\",\"d\":\"SUM\"},\"user_answer\":\"b\",\"correct_answer\":\"COUNTA\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 b\\u1ea3o v\\u1ec7 m\\u1ed9t b\\u1ea3ng t\\u00ednh kh\\u1ecfi vi\\u1ec7c ch\\u1ec9nh s\\u1eeda, b\\u1ea1n s\\u1eed d\\u1ee5ng?\",\"options\":{\"a\":\"Protect Sheet\",\"b\":\"Lock Sheet\",\"c\":\"Hide Sheet\",\"d\":\"Share Sheet\"},\"user_answer\":\"b\",\"correct_answer\":\"Protect Sheet\",\"is_correct\":false},{\"question\":\"\\u0110\\u1ec3 t\\u00ednh gi\\u00e1 tr\\u1ecb trung b\\u00ecnh c\\u1ee7a m\\u1ed9t d\\u00e3y s\\u1ed1, b\\u1ea1n s\\u1eed d\\u1ee5ng?\",\"options\":{\"a\":\"AVERAGE\",\"b\":\"SUM\",\"c\":\"COUNT\",\"d\":\"MEDIAN\"},\"user_answer\":\"a\",\"correct_answer\":\"AVERAGE\",\"is_correct\":true},{\"question\":\"\\u0110\\u1ec3 s\\u1eed d\\u1ee5ng h\\u00e0m VLOOKUP, b\\u1ea1n c\\u1ea7n c\\u00f3?\",\"options\":{\"a\":\"M\\u1ed9t b\\u1ea3ng d\\u1eef li\\u1ec7u v\\u00e0 gi\\u00e1 tr\\u1ecb t\\u00ecm ki\\u1ebfm\",\"b\":\"M\\u1ed9t b\\u1ea3ng d\\u1eef li\\u1ec7u v\\u00e0 m\\u1ed9t gi\\u00e1 tr\\u1ecb s\\u1ed1\",\"c\":\"M\\u1ed9t gi\\u00e1 tr\\u1ecb v\\u00e0 m\\u1ed9t \\u00f4\",\"d\":\"M\\u1ed9t h\\u00e0m COUNT v\\u00e0 m\\u1ed9t \\u00f4\"},\"user_answer\":\"a\",\"correct_answer\":\"M\\u1ed9t b\\u1ea3ng d\\u1eef li\\u1ec7u v\\u00e0 gi\\u00e1 tr\\u1ecb t\\u00ecm ki\\u1ebfm\",\"is_correct\":true}]', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `idlikes` int(11) NOT NULL,
  `idbaidang` int(11) NOT NULL,
  `idtaikhoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `likes`
--

INSERT INTO `likes` (`idlikes`, `idbaidang`, `idtaikhoan`) VALUES
(1, 1, 3),
(3, 4, 4),
(6, 13, 1),
(10, 13, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `idtaikhoan` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `diachi` text NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'users.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`idtaikhoan`, `hoten`, `username`, `password`, `diachi`, `sdt`, `image`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin@123', 'Hcm', '08979454147', 'adminn.jpg'),
(3, 'tèo', 'voduyduydlk@gmail.com', 'vdt@123', 'dhdh', '095946565', 'users.jpg'),
(4, 'Huyền Diệu', 'huyendieu071@gmail.com', 'dieu@123', 'Đà Lạt', '03043850348', 'usersn.jpg'),
(9, 'sss', 'test@gmail.com', 'ccc@123', 'ss', 'ss', 'users.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongkebaithi`
--

CREATE TABLE `thongkebaithi` (
  `idthongke` int(11) NOT NULL,
  `idtaikhoan` int(11) DEFAULT NULL,
  `iddethi` int(11) DEFAULT NULL,
  `thoigiansudung` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongkebaithi`
--

INSERT INTO `thongkebaithi` (`idthongke`, `idtaikhoan`, `iddethi`, `thoigiansudung`) VALUES
(1, 3, 1, '2024-09-13 00:14:15'),
(2, 3, 1, '2024-09-13 00:14:45'),
(3, 3, 2, '2024-09-13 00:18:43'),
(4, 3, 2, '2024-09-13 00:21:57'),
(5, 3, 2, '2024-09-13 01:16:59'),
(6, 3, 2, '2024-09-13 01:18:03'),
(7, 3, 2, '2024-09-13 01:20:48'),
(8, 3, 1, '2024-09-13 01:44:34'),
(9, 3, 1, '2024-09-13 01:45:06'),
(10, 3, 2, '2024-09-13 01:45:29'),
(11, 3, 2, '2024-09-13 01:46:40'),
(12, 3, 2, '2024-09-13 01:48:15'),
(13, 3, 1, '2024-09-13 01:48:22'),
(14, 3, 2, '2024-09-13 01:49:59'),
(15, 3, 2, '2024-09-13 01:51:19'),
(16, 3, 1, '2024-09-13 01:51:34'),
(17, 3, 2, '2024-09-13 01:52:07'),
(18, 3, 1, '2024-09-13 01:53:41'),
(19, 3, 1, '2024-09-13 01:53:41'),
(20, 3, 1, '2024-09-13 01:53:42'),
(21, 3, 1, '2024-09-13 01:57:20'),
(22, 3, 1, '2024-09-13 01:57:28'),
(23, 3, 1, '2024-09-13 01:59:59'),
(24, 3, 1, '2024-09-13 02:03:21'),
(25, 3, 2, '2024-09-13 02:03:24'),
(26, 3, 3, '2024-09-13 02:03:27'),
(27, 3, 1, '2024-09-13 02:06:37'),
(28, 3, 1, '2024-09-13 02:06:41'),
(29, 3, 1, '2024-09-13 02:09:06'),
(30, 3, 1, '2024-09-13 02:09:10'),
(31, 3, 1, '2024-09-13 02:11:22'),
(32, 3, 1, '2024-09-13 02:18:36'),
(33, 3, 1, '2024-09-13 02:19:47'),
(34, 3, 1, '2024-09-13 02:35:58'),
(35, 3, 1, '2024-09-13 02:37:02'),
(36, 3, 1, '2024-09-13 10:06:20'),
(37, 3, 2, '2024-09-13 11:06:10'),
(38, 3, 1, '2024-09-13 11:07:57'),
(39, 3, 2, '2024-09-13 11:08:01'),
(40, 3, 2, '2024-09-13 11:56:21'),
(41, 3, 2, '2024-09-13 11:57:19'),
(42, 3, 2, '2024-09-13 12:23:32'),
(43, 3, 2, '2024-09-13 12:24:01'),
(44, 4, 1, '2024-09-13 14:30:02'),
(45, 4, 1, '2024-09-13 14:32:25'),
(46, 4, 2, '2024-09-13 14:35:01'),
(47, 4, 3, '2024-09-13 14:37:47'),
(48, 4, 4, '2024-09-13 14:40:54'),
(49, 3, 1, '2024-09-14 15:08:07'),
(50, 3, 1, '2024-09-14 15:09:55'),
(51, 3, 2, '2024-09-14 15:10:51'),
(52, 3, 1, '2024-09-14 15:10:54'),
(53, 3, 1, '2024-09-14 15:13:42'),
(54, 3, 1, '2024-09-14 15:18:45'),
(55, 3, 1, '2024-09-14 15:18:49'),
(56, 3, 1, '2024-09-14 15:19:14'),
(57, 1, 1, '2024-09-15 00:52:50'),
(58, 3, 7, '2024-09-15 01:33:56'),
(59, 3, 7, '2024-09-15 01:34:36'),
(60, 3, 7, '2024-09-15 11:53:59'),
(61, 3, 2, '2024-09-15 11:54:06'),
(62, 3, 2, '2024-09-15 12:01:31'),
(63, 3, 3, '2024-09-15 12:05:19'),
(64, 3, 4, '2024-09-15 12:05:21'),
(78, 3, 2, '2024-09-15 12:06:59'),
(79, 3, 3, '2024-09-15 12:07:01'),
(80, 3, 4, '2024-09-15 12:07:04'),
(84, 3, 2, '2024-09-15 12:12:49'),
(85, 3, 2, '2024-09-15 12:12:51'),
(86, 3, 2, '2024-09-15 12:12:54'),
(87, 3, 2, '2024-09-15 12:13:00'),
(88, 3, 3, '2024-09-15 12:13:02'),
(89, 3, 4, '2024-09-15 12:13:05'),
(90, 3, 1, '2024-09-15 12:13:07'),
(91, 3, 2, '2024-09-15 12:13:30'),
(92, 3, 3, '2024-09-15 12:20:48'),
(93, 3, 4, '2024-09-15 12:20:52'),
(94, 3, 2, '2024-09-15 12:20:55'),
(95, 3, 2, '2024-09-15 12:21:10'),
(96, 3, 2, '2024-09-15 12:23:58'),
(97, 3, 4, '2024-09-15 12:24:00'),
(98, 3, 7, '2024-09-15 12:24:33'),
(99, 3, 7, '2024-09-15 12:25:39'),
(100, 3, 7, '2024-09-15 12:26:56'),
(101, 3, 2, '2024-09-15 12:26:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongketruycap`
--

CREATE TABLE `thongketruycap` (
  `idtruycap` int(11) NOT NULL,
  `idtaikhoan` int(11) DEFAULT NULL,
  `trang` varchar(255) DEFAULT NULL,
  `thoigian` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongketruycap`
--

INSERT INTO `thongketruycap` (`idtruycap`, `idtaikhoan`, `trang`, `thoigian`) VALUES
(1, 1, '/webmos/Giaodienusers/index.php', '0000-00-00 00:00:00'),
(2, 1, '/webmos/Giaodienusers/index.php', '0000-00-00 00:00:00'),
(3, 1, '/webmos/Giaodienusers/index.php', '0000-00-00 00:00:00'),
(4, 1, '/webmos/Giaodienusers/index.php', '0000-00-00 00:00:00'),
(5, 3, '/webmos/Giaodienusers/index.php', '0000-00-00 00:00:00'),
(7, 3, '/webmos/Giaodienusers/index.php', '0000-00-00 00:00:00'),
(8, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:16:51'),
(9, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:17:48'),
(10, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:18:45'),
(11, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:18:49'),
(12, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:22:11'),
(13, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:22:32'),
(14, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:22:37'),
(15, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 15:22:41'),
(16, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:25:57'),
(17, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:26:41'),
(18, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:26:46'),
(19, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:26:57'),
(20, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:27:32'),
(21, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:27:35'),
(22, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:27:58'),
(23, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:28:01'),
(24, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 15:32:38'),
(25, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:04:12'),
(26, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:04:22'),
(27, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:05:50'),
(28, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:03'),
(29, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:07'),
(30, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:34'),
(31, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:35'),
(32, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:36'),
(33, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:40'),
(34, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:45'),
(35, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:50'),
(36, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:53'),
(37, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:06:54'),
(38, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:07:09'),
(39, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:07:20'),
(40, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:07:30'),
(41, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:09:42'),
(42, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:40:31'),
(43, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:40:43'),
(44, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:42:06'),
(45, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:42:09'),
(46, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:42:11'),
(47, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:43:57'),
(48, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:44:47'),
(49, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 16:45:03'),
(50, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:45:21'),
(51, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:45:46'),
(52, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:45:50'),
(53, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:46:01'),
(54, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:46:56'),
(55, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:47:18'),
(56, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:47:22'),
(57, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:47:25'),
(58, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:48:16'),
(59, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 16:48:22'),
(60, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 17:05:20'),
(61, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 17:08:18'),
(62, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 17:10:36'),
(63, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 17:14:00'),
(64, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 17:14:02'),
(65, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 17:15:09'),
(66, 1, '/webmos/Giaodienusers/index.php', '2024-09-12 17:15:37'),
(67, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 17:16:49'),
(68, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:02:19'),
(69, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:19:35'),
(70, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:49:45'),
(71, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:53:44'),
(72, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:54:07'),
(73, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:54:26'),
(74, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:54:52'),
(75, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:54:57'),
(76, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:55:00'),
(77, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:55:01'),
(78, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:55:02'),
(79, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:55:38'),
(80, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 18:55:42'),
(81, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 19:11:16'),
(82, 3, '/webmos/Giaodienusers/index.php', '2024-09-12 19:37:28'),
(83, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 02:23:11'),
(84, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 02:23:25'),
(85, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 02:23:58'),
(86, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 02:54:27'),
(87, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 02:54:52'),
(88, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 04:56:14'),
(89, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 04:59:52'),
(90, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 05:23:19'),
(91, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 05:24:39'),
(92, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 05:24:53'),
(93, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 06:00:51'),
(94, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 06:40:54'),
(95, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:11:38'),
(96, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 07:12:36'),
(97, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 07:29:26'),
(98, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:29:41'),
(99, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 07:34:18'),
(100, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:46:06'),
(101, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:46:13'),
(102, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:46:55'),
(103, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:50:47'),
(104, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 07:50:57'),
(105, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 07:52:26'),
(106, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 07:53:09'),
(107, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 07:53:54'),
(108, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 07:59:08'),
(109, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:07:02'),
(110, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:07:06'),
(111, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:07:32'),
(112, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:14:57'),
(113, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:15:11'),
(114, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:15:21'),
(115, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:15:45'),
(116, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:35:13'),
(117, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:36:39'),
(118, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:37:04'),
(119, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:37:08'),
(120, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:37:10'),
(121, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:38:45'),
(122, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:39:15'),
(123, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:39:20'),
(124, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:39:53'),
(125, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 20:40:21'),
(126, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:42:33'),
(127, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:43:29'),
(128, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:43:35'),
(129, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:43:50'),
(130, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:44:11'),
(131, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:44:36'),
(132, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:44:44'),
(133, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:44:49'),
(134, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:49:03'),
(135, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:49:09'),
(136, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:50:31'),
(137, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:50:38'),
(138, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:50:47'),
(139, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 20:50:53'),
(140, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:00:45'),
(141, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:02:07'),
(142, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:02:13'),
(143, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:02:18'),
(144, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:02:19'),
(145, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:02:33'),
(146, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:16:02'),
(147, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 21:16:21'),
(148, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 21:19:31'),
(149, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:20:44'),
(150, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:20:45'),
(151, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 21:21:14'),
(152, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 21:21:16'),
(153, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 21:21:16'),
(154, 4, '/webmos/Giaodienusers/index.php', '2024-09-13 21:21:16'),
(155, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 21:34:34'),
(156, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:20:03'),
(157, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:20:08'),
(158, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:35:44'),
(159, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:36:06'),
(160, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:36:39'),
(161, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:37:11'),
(162, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:37:33'),
(163, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:37:57'),
(164, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:37:59'),
(165, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:38:01'),
(166, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:40:21'),
(167, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:41:44'),
(168, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:41:51'),
(169, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:41:57'),
(170, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:42:08'),
(171, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:42:09'),
(172, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:42:46'),
(173, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 22:45:36'),
(174, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:46:04'),
(175, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:49:52'),
(176, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:51:02'),
(177, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:51:06'),
(178, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:51:09'),
(179, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:51:21'),
(180, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:53:43'),
(181, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 22:53:48'),
(182, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:00:02'),
(183, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:00:07'),
(184, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:00:25'),
(185, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:01:23'),
(186, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:03:12'),
(187, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:03:22'),
(188, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:03:38'),
(189, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:05:26'),
(190, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:09:17'),
(191, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:10:55'),
(192, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:11:54'),
(193, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:13:09'),
(194, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:13:13'),
(195, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:13:14'),
(196, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:14:37'),
(197, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:14:40'),
(198, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:14:47'),
(199, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:14:55'),
(200, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:15:03'),
(201, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:15:05'),
(202, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:15:37'),
(203, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:15:39'),
(204, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:15:49'),
(205, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:16:01'),
(206, 1, '/webmos/Giaodienusers/index.php', '2024-09-13 23:16:12'),
(208, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:38:58'),
(209, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:41:16'),
(210, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:41:21'),
(211, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:41:33'),
(212, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:41:39'),
(213, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:47:27'),
(214, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:49:53'),
(215, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:50:12'),
(216, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:50:17'),
(217, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:50:40'),
(218, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:50:43'),
(219, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:51:32'),
(220, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:56:09'),
(221, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:56:49'),
(222, 3, '/webmos/Giaodienusers/index.php', '2024-09-13 23:56:51'),
(223, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 07:46:50'),
(224, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 07:51:47'),
(225, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 07:56:53'),
(226, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:06:18'),
(227, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:08:11'),
(228, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:08:20'),
(229, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:08:27'),
(230, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:08:32'),
(231, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:08:36'),
(232, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:11:22'),
(233, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:12:43'),
(234, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:13:55'),
(235, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:14:54'),
(236, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:14:57'),
(237, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 08:18:41'),
(238, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 11:21:35'),
(239, 4, '/webmos/Giaodienusers/index.php', '2024-09-14 11:33:41'),
(240, 4, '/webmos/Giaodienusers/index.php', '2024-09-14 11:33:50'),
(241, 4, '/webmos/Giaodienusers/index.php', '2024-09-14 11:33:55'),
(242, 4, '/webmos/Giaodienusers/index.php', '2024-09-14 11:57:31'),
(243, 4, '/webmos/Giaodienusers/index.php', '2024-09-14 11:59:17'),
(244, 4, '/webmos/Giaodienusers/index.php', '2024-09-14 11:59:21'),
(245, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:00:14'),
(246, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:00:28'),
(247, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:00:35'),
(248, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:02:03'),
(249, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:02:05'),
(250, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:02:16'),
(251, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:38:38'),
(252, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:40:10'),
(253, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:40:29'),
(254, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:40:31'),
(255, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:43:09'),
(256, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:45:30'),
(257, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:50:10'),
(258, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:50:22'),
(259, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:50:53'),
(260, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:51:00'),
(261, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:51:33'),
(262, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 12:53:11'),
(263, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:07:52'),
(264, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:12:40'),
(265, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:15:45'),
(266, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:17:34'),
(267, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:17:41'),
(268, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:17:49'),
(269, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:17:51'),
(270, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 14:18:44'),
(271, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:21:29'),
(272, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:21:52'),
(273, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:22:00'),
(274, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:22:57'),
(275, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:23:15'),
(276, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:24:19'),
(277, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:24:49'),
(278, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:25:16'),
(279, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:47:15'),
(280, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:51:14'),
(281, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:51:37'),
(282, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:52:34'),
(283, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:52:53'),
(284, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:53:32'),
(285, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:53:54'),
(286, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:54:22'),
(287, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 14:55:46'),
(288, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:00:16'),
(289, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:02:56'),
(290, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:03:01'),
(291, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:20:36'),
(292, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:21:19'),
(293, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:21:41'),
(294, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:29:44'),
(295, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:30:19'),
(296, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:31:00'),
(297, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:31:28'),
(298, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:31:52'),
(299, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:32:24'),
(300, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:32:29'),
(301, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:32:48'),
(302, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:34:07'),
(303, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:34:22'),
(304, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:35:18'),
(305, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:35:59'),
(306, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:36:01'),
(307, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:40:35'),
(308, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:45:39'),
(309, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:49:40'),
(310, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:49:44'),
(311, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:51:01'),
(312, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:51:44'),
(313, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:52:06'),
(314, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:52:21'),
(315, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:54:19'),
(316, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 15:57:03'),
(317, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 16:04:42'),
(318, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 16:05:03'),
(319, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 16:06:01'),
(320, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 16:06:10'),
(321, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 16:52:40'),
(322, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 17:54:16'),
(323, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 17:54:31'),
(324, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 17:54:39'),
(325, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 17:56:19'),
(326, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:01:31'),
(327, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:01:34'),
(328, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:02:35'),
(331, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:24:32'),
(332, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:24:34'),
(333, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:24:40'),
(334, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:24:47'),
(335, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:24:56'),
(336, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:26:06'),
(337, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:29:30'),
(338, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:29:57'),
(339, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:34:27'),
(340, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:34:58'),
(341, 3, '/webmos/Giaodienusers/index.php', '2024-09-14 18:35:02'),
(342, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:35:16'),
(343, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:35:44'),
(344, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:35:49'),
(345, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:35:56'),
(346, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:36:22'),
(347, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:37:13'),
(348, 1, '/webmos/Giaodienusers/index.php', '2024-09-14 18:46:45'),
(349, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:34:06'),
(350, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:35:10'),
(351, 3, '/webmos/Giaodienusers/index.php?search=ss', '2024-09-15 04:35:24'),
(352, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:35:26'),
(353, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:35:38'),
(354, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:35:42'),
(355, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:38:03'),
(356, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:38:07'),
(357, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:38:38'),
(358, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:38:41'),
(359, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 04:39:16'),
(360, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 04:39:26'),
(361, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 04:39:53'),
(362, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 04:40:09'),
(363, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 04:40:16'),
(364, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 04:40:57'),
(365, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 04:54:48'),
(366, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 05:29:22'),
(367, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 05:29:31'),
(368, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 05:32:13'),
(369, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:46:48'),
(370, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 06:53:12'),
(371, 3, '/webmos/Giaodienusers/index.php', '2024-09-15 06:53:17'),
(372, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:53:33'),
(373, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:55:29'),
(374, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:55:34'),
(375, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:56:52'),
(376, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:57:06'),
(377, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:57:12'),
(378, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:57:38'),
(379, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 06:59:53'),
(380, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 07:04:23'),
(381, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 07:04:38'),
(382, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 07:04:58'),
(383, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 07:06:15'),
(384, 1, '/webmos/Giaodienusers/index.php', '2024-09-15 07:06:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinnhan`
--

CREATE TABLE `tinnhan` (
  `idtinnhan` int(11) NOT NULL,
  `idtaikhoan` int(11) NOT NULL,
  `idnguoinhan` int(11) NOT NULL,
  `tinnhan` text NOT NULL,
  `thoigiangui` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tinnhan`
--

INSERT INTO `tinnhan` (`idtinnhan`, `idtaikhoan`, `idnguoinhan`, `tinnhan`, `thoigiangui`, `is_read`) VALUES
(1, 4, 1, 'hello ', '2024-09-13 14:50:57', 1),
(2, 1, 4, 'heloo', '2024-09-15 01:46:10', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baidang`
--
ALTER TABLE `baidang`
  ADD PRIMARY KEY (`idbaidang`),
  ADD KEY `idtaikhoan` (`idtaikhoan`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`idbinhluan`),
  ADD KEY `idbaidang` (`idbaidang`),
  ADD KEY `idtaikhoan` (`idtaikhoan`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`iddanhmuc`);

--
-- Chỉ mục cho bảng `dethi`
--
ALTER TABLE `dethi`
  ADD PRIMARY KEY (`iddethi`),
  ADD KEY `iddanhmuc` (`iddanhmuc`);

--
-- Chỉ mục cho bảng `dscauhoi`
--
ALTER TABLE `dscauhoi`
  ADD PRIMARY KEY (`idcauhoi`),
  ADD KEY `iddethi` (`iddethi`);

--
-- Chỉ mục cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  ADD PRIMARY KEY (`idketqua`),
  ADD KEY `idtaikhoan` (`idtaikhoan`),
  ADD KEY `iddethi` (`iddethi`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idlikes`),
  ADD KEY `idbaidang` (`idbaidang`),
  ADD KEY `idtaikhoan` (`idtaikhoan`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`idtaikhoan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `thongkebaithi`
--
ALTER TABLE `thongkebaithi`
  ADD PRIMARY KEY (`idthongke`),
  ADD KEY `idtaikhoan` (`idtaikhoan`),
  ADD KEY `iddethi` (`iddethi`);

--
-- Chỉ mục cho bảng `thongketruycap`
--
ALTER TABLE `thongketruycap`
  ADD PRIMARY KEY (`idtruycap`),
  ADD KEY `idtaikhoan` (`idtaikhoan`);

--
-- Chỉ mục cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD PRIMARY KEY (`idtinnhan`),
  ADD KEY `idtaikhoan` (`idtaikhoan`),
  ADD KEY `idnguoinhan` (`idnguoinhan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baidang`
--
ALTER TABLE `baidang`
  MODIFY `idbaidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `idbinhluan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `iddanhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `dethi`
--
ALTER TABLE `dethi`
  MODIFY `iddethi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `dscauhoi`
--
ALTER TABLE `dscauhoi`
  MODIFY `idcauhoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  MODIFY `idketqua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `idlikes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `idtaikhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `thongkebaithi`
--
ALTER TABLE `thongkebaithi`
  MODIFY `idthongke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `thongketruycap`
--
ALTER TABLE `thongketruycap`
  MODIFY `idtruycap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  MODIFY `idtinnhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baidang`
--
ALTER TABLE `baidang`
  ADD CONSTRAINT `baidang_ibfk_1` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`);

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`idbaidang`) REFERENCES `baidang` (`idbaidang`) ON DELETE CASCADE,
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`);

--
-- Các ràng buộc cho bảng `dethi`
--
ALTER TABLE `dethi`
  ADD CONSTRAINT `dethi_ibfk_1` FOREIGN KEY (`iddanhmuc`) REFERENCES `danhmuc` (`iddanhmuc`);

--
-- Các ràng buộc cho bảng `dscauhoi`
--
ALTER TABLE `dscauhoi`
  ADD CONSTRAINT `dscauhoi_ibfk_1` FOREIGN KEY (`iddethi`) REFERENCES `dethi` (`iddethi`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  ADD CONSTRAINT `ketqua_ibfk_1` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`),
  ADD CONSTRAINT `ketqua_ibfk_2` FOREIGN KEY (`iddethi`) REFERENCES `dethi` (`iddethi`);

--
-- Các ràng buộc cho bảng `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`idbaidang`) REFERENCES `baidang` (`idbaidang`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`);

--
-- Các ràng buộc cho bảng `thongkebaithi`
--
ALTER TABLE `thongkebaithi`
  ADD CONSTRAINT `thongkebaithi_ibfk_1` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`),
  ADD CONSTRAINT `thongkebaithi_ibfk_2` FOREIGN KEY (`iddethi`) REFERENCES `dethi` (`iddethi`);

--
-- Các ràng buộc cho bảng `thongketruycap`
--
ALTER TABLE `thongketruycap`
  ADD CONSTRAINT `thongketruycap_ibfk_1` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD CONSTRAINT `tinnhan_ibfk_1` FOREIGN KEY (`idtaikhoan`) REFERENCES `taikhoan` (`idtaikhoan`),
  ADD CONSTRAINT `tinnhan_ibfk_2` FOREIGN KEY (`idnguoinhan`) REFERENCES `taikhoan` (`idtaikhoan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
