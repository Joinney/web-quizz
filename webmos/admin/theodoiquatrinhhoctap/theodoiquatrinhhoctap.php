<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn SQL để lấy dữ liệu trạng thái học tập
$sql = "
    SELECT 
        t.username,
        d.tendethi,
        COUNT(k.idketqua) AS so_lan_thi,
        COALESCE(MAX(k.diem), 0) AS diem_cao_nhat,
        CASE 
            WHEN COALESCE(MAX(k.diem), 0) >= 4 THEN 'Đạt'
            ELSE 'Không đạt'
        END AS tinh_trang
    FROM 
        taikhoan t
    LEFT JOIN 
        ketqua k ON t.idtaikhoan = k.idtaikhoan
    LEFT JOIN 
        dethi d ON k.iddethi = d.iddethi
    WHERE
        t.idtaikhoan != 1
    GROUP BY 
        t.username, d.tendethi
    ORDER BY 
        t.username, d.tendethi;
";

$result = $conn->query($sql);

// Mảng lưu trữ dữ liệu
$data = [];

// Tạo mảng dữ liệu cho mỗi username
while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $tendethi = $row['tendethi'];
    
    if (!isset($data[$username])) {
        $data[$username] = [];
    }
    
    $data[$username][$tendethi] = [
        'so_lan_thi' => $row['so_lan_thi'],
        'diem_cao_nhat' => $row['diem_cao_nhat'],
        'tinh_trang' => $row['tinh_trang']
    ];
}

// Truy vấn SQL để lấy danh sách tất cả các đề thi
$allExamsResult = $conn->query("SELECT iddethi, tendethi FROM dethi");

$allExams = [];
while ($row = $allExamsResult->fetch_assoc()) {
    $allExams[$row['iddethi']] = $row['tendethi'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="../../Css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
        h1 {
            text-align: center;
            color: orange;
        }
        /* Dropdown styles */
        .dropdown {
            margin-bottom: 20px;
            text-align: center;
        }

        .dropdown select {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Header styles */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        /* Timeline Container */
        .timeline-container {
            width: 100%;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Timeline */
        .timeline {
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px 0;
            justify-content:center;
        }

        /* Timeline Item */
        .timeline-item {
            flex: 0 0 auto;
            min-width: 180px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: relative;
            transition: background-color 0.3s, border-color 0.3s;
        }

        /* Timeline Connector */
        .timeline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #3498db, #3498db 50%, #ddd 50%);
            z-index: 0;
            transform: translateY(-50%);
        }

        /* Timeline Content */
        .timeline-content {
            position: relative;
            z-index: 1;
        }

        .timeline-content h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .timeline-content p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        /* Styles for passed exams */
        .passed {
            border-color: #28a745; /* Green border */
            background: linear-gradient(to bottom right, #d4edda, #c3e6cb); /* Light green gradient */
        }

        .passed::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #28a745; /* Green circle */
            box-shadow: 0 0 0 3px #fff; /* White ring */
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Styles for not attempted exams */
        .not-attempted {
            border-color: #ddd;
            background: linear-gradient(to bottom right, #ffe5e5, #f8d7da); /* Light orange gradient */
        }

        .not-attempted::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ccc; /* Grey circle */
            box-shadow: 0 0 0 3px #fff; /* White ring */
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Styles for opened exams */
        .opened {
            border-color: #007bff; /* Blue border */
            background: linear-gradient(to bottom right, #d1ecf1, #bee5eb); /* Light blue gradient */
        }

        .opened::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #007bff; /* Blue circle */
            box-shadow: 0 0 0 3px #fff; /* White ring */
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Additional styling for opened label */
        .opened-label {
            font-size: 13px;
            color: #007bff;
            margin-top: 5px;
            display: block;
            font-weight: 500;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
  <!-- Top Bar with Contact Information and Social Media Links -->
  <div class="top-bar">
        <div class="left">
            <a href="tel:0933008831">📞 0933 008831</a>
            <a href="#">08:00 - 17:00</a>
        </div>
        <div class="right social-icons">
            <a href="https://www.facebook.com/YourPage" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://github.com/YourPage" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://zalo.me/YourPage" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
                <i class="fab fa-whatsapp"></i> <!-- Zalo icon is not available in Font Awesome, using WhatsApp as placeholder -->
            </a>
        </div>
    </div>
    

     <!-- Thanh điều hướng -->
     <nav>
        <div class="container">
            
            <ul class="nav-links">
                <li class="logo-item"><a href="#" class="logo">
                    <img src="../../img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
    
                <li><a href="../../Giaodienusers/index.php">Trang Chủ</a></li>
                <li><a href="../../Giaodienusers/gioithieu.php">Giới Thiệu </a></li>            
                <li><a href="../../Giaodienusers/tailieu.php" class="active">Tài liệu</a></li>
                <li><a href="../../Giaodienusers/diendan.php" class="active">Diễn đàn</a></li>
                <li class="nav-user-info">
                    <a href="../../Giaodienusers/kiemtra.php">Kiểm Tra</a>
                    <ul class="dropdown">
                        <?php
                        $conn3 = mysqli_connect("localhost", "root", "", "webmos");

                        if (!$conn3) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql3 = "SELECT * FROM danhmuc";
                        $ketqua3 = mysqli_query($conn3, $sql3);

                        if (mysqli_num_rows($ketqua3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($ketqua3)) {
                                $idDanhMuc = htmlspecialchars($row3['iddanhmuc']);
                                $tenDanhMuc = htmlspecialchars($row3['tendanhmuc']);
                                echo '<li><a href="../../Giaodienusers/kiemtra.php?id=' . $idDanhMuc . '">' . $tenDanhMuc . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found.</a></li>';
                        }

                        mysqli_close($conn3);
                        ?>
                    </ul>
                </li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="../../Giaodienusers/lienhe.php" class="active">Liên hệ</a></li>
                <?php if (isset($_SESSION['hoten'])): ?>
                        <li class="nav-user-info">
                            <span class="user-name">Xin chào, <?php echo $_SESSION['hoten']; ?>!</span>
                            <div class="user-dropdown">
                                <a href="profile.php">Thông tin cá nhân</a>
                                <a href="change_password.php">Đổi mật khẩu</a>
                               
                            </div>
                            <a href="../../index.php" class="btn">Đăng xuất</a>
                        </li>
                        
                    <?php else: ?>
                        <li><a href="login.php" class="btn">Đăng nhập</a></li>
                    <?php endif; ?>
            </ul>
            
        </div>
    </nav>
<!-- Thêm thanh tìm kiếm -->
<div class="search-container">
                <form action="../../timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>

    
    <h1>Theo dõi quá trình học tập </h1>

    <div class="dropdown">
        <select id="userSelect" onchange="showUserTimeline()">
            <option value="">Chọn người dùng</option>
            <?php foreach (array_keys($data) as $username): ?>
                <option value="<?php echo htmlspecialchars($username); ?>"><?php echo htmlspecialchars($username); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="timeline-container" id="timelineContainer">
        <!-- Timeline content will be injected here by JavaScript -->
    </div>

    <script>
        const data = <?php echo json_encode($data); ?>;
        const allExams = <?php echo json_encode($allExams); ?>;

        function showUserTimeline() {
            const username = document.getElementById('userSelect').value;
            const container = document.getElementById('timelineContainer');

            if (!username) {
                container.innerHTML = ''; // Clear container if no user selected
                return;
            }

            let timelineHTML = `<h2>User: ${username}</h2><div class="timeline">`;

            const exams = data[username];
            let previousPassed = false;

            for (const [examId, tendethi] of Object.entries(allExams)) {
                const examData = exams[tendethi] || {
                    'so_lan_thi': 0,
                    'diem_cao_nhat': 0,
                    'tinh_trang': 'Chưa làm'
                };

                const isPassed = examData['tinh_trang'] === 'Đạt' ? 'passed' : '';
                const isNotAttempted = examData['tinh_trang'] === 'Chưa làm' ? 'not-attempted' : '';
                const isOpened = previousPassed && examData['tinh_trang'] !== 'Chưa làm' ? 'opened' : '';

                previousPassed = examData['tinh_trang'] === 'Đạt';

                timelineHTML += `
                    <div class="timeline-item ${isPassed} ${isNotAttempted} ${isOpened}">
                        <div class="timeline-content">
                            <h3>${tendethi}</h3>
                            <p>Số lần thi: ${examData['so_lan_thi']}</p>
                            <p>Điểm cao nhất: ${examData['diem_cao_nhat']}</p>
                            <p>Tình trạng: ${examData['tinh_trang']}</p>
                            ${isOpened ? '<span class="opened-label">Đã mở</span>' : ''}
                        </div>
                    </div>
                `;
            }

            timelineHTML += '</div>';
            container.innerHTML = timelineHTML;
        }
    </script>
 <section id="section__footer" class="body__section">
    <div id="block__logo" class="block__footer">
        <li class="logo-item">
            <a href="" class="logo">
                <img src="../../img/LogoMOS.jpg" alt="MOS Learning Logo">
            </a>
        </li>
    </div>
    <div id="block__address" class="block__footer">
        <p class="footer-title">Work Place</p>
        <div class="footer-description">
            <p>NTT Institute of International Education</p>
            <p>458/3F Nguyen Huu Tho Str.</p>
            <p> Dist. 7, HCMC</p>
        </div>
    </div>
    <div id="block__contact" class="block__footer">
        <p class="footer-title">Contact me</p>
        <div class="footer-description">
            <p>(+84) 97 975 87 44</p>
            <p>voduyduydlk@gmail.com</p>
        </div>
    </div>
    <div id="block__followMe" class="block__footer">
        <p class="footer-title">Contact me</p>
        <div class="contact-icons">
            <a href="https://www.facebook.com/zVoDuyToanz"><i class="bx bxl-facebook"></i></a>
            <a href="https://github.com/Joinney"><i class="bx bxl-github"></i></a>
            <a href=""><i class="bx bxl-instagram"></i></a>
        </div>
    </div>
</section>

    <!-- Chân trang -->
    <footer>
        <div class="container">
            <p>&copy; 2024 MOSLearning. All rights reserved.</p>
            
        </div>
    </footer>

</body>
</html>
