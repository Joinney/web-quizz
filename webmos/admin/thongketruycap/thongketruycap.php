<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');

    exit();
}
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webmos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu thống kê
$sql = "SELECT t.idtaikhoan, t.hoten, t.username, COUNT(*) AS so_luot_truy_cap
        FROM thongketruycap tc
        JOIN taikhoan t ON tc.idtaikhoan = t.idtaikhoan
        GROUP BY t.idtaikhoan
        ORDER BY t.hoten, so_luot_truy_cap DESC";
$result = $conn->query($sql);
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
       body {
    margin: 0;
    padding: 0;

    flex-direction: column;
    align-items: center;
    background-color: #f9f9f9;
}

h1 {
    text-align: center;
    color: #333;
    margin: 20px 0;
}

table {
    width: 80%; /* Giảm kích thước bảng còn 80% chiều rộng của trang */
    max-width: 1200px; /* Đặt kích thước tối đa để bảng không quá rộng */
    border-collapse: collapse;
    margin: 20px auto; /* Căn giữa bảng với khoảng cách trên và dưới */
    font-size: 16px;
    text-align: center;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
}

th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    text-align: center;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

caption {
    font-size: 24px;
    margin: 10px 0;
    font-weight: bold;
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




    
    <h1>Thống kê số lượt truy cập</h1>
    <table>
        <caption>Danh sách lượt truy cập theo tài khoản</caption>
        <thead>
            <tr>
                <th>Họ Tên</th>
                <th>Tên Đăng Nhập</th>
                <th>Số Lượt Truy Cập</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["hoten"]) . "</td><td>" . htmlspecialchars($row["username"]) . "</td><td>" . htmlspecialchars($row["so_luot_truy_cap"]) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

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
