<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin người dùng từ session
$username = $_SESSION['username'];

// Truy vấn thông tin người dùng từ cơ sở dữ liệu
$sql = "SELECT hoten, username, diachi, sdt FROM taikhoan WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Đóng kết nối
$stmt->close();
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

      
      
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
        button:hover:not(:disabled) {
            background-color: #45a049;
        }
        button + button {
            background-color: #f44336;
            margin-left: 10px;
        }
        button + button:hover {
            background-color: #d73727;
        }
        td button {
            margin-right: 5px;
            background-color: #007BFF;
        }
        td button:hover {
            background-color: #0056b3;
        }
    </style>

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
                <li><a href="#tutorials">Giới Thiệu </a></li>            
                <li><a href="tai-lieu.html" class="active">Tài liệu</a></li>
                <li><a href="dien-dan.html" class="active">Diễn đàn</a></li>
                <li><a href="../../Giaodienusers/kiemtra.php">Kiểm Tra</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="../../Giaodienusers/lienhe.php" class="active">Liên hệ</a></li>
                <?php if (isset($_SESSION['hoten'])): ?>
                        <li class="nav-user-info">
                            <span class="user-name">Xin chào, <?php echo $_SESSION['hoten']; ?>!</span>
                            <div class="user-dropdown">
                                <a href="../../Giaodienusers/thongtincanhan.php">Thông tin cá nhân</a>
                                <a href="change_password.php">Đổi mật khẩu</a>
                               
                            </div>
                            <a href="../index.php" class="btn">Đăng xuất</a>
                        </li>
                        
                    <?php else: ?>
                        <li><a href="login.php" class="btn">Đăng nhập</a></li>
                    <?php endif; ?>
            </ul>
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
    
    <!-- PHẦN THÂN Ở ĐÂY -->

    <h2>Quản lý Danh mục</h2>

    <!-- Form thêm/sửa danh mục -->
    <form action="themxoasuadm.php" method="POST">
        <input type="hidden" name="iddanhmuc" id="iddanhmuc" value="">
        <label for="tendanhmuc">Tên Danh mục:</label>
        <input type="text" id="tendanhmuc" name="tendanhmuc" required>
        <button type="submit" name="action" value="add">Thêm</button>
        <button type="submit" name="action" value="update" disabled>Sửa</button>
    </form>

    <!-- Danh sách danh mục -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP để hiển thị danh sách danh mục -->
            <?php
            include '../../connection.php';
            $sql = "SELECT * FROM danhmuc";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["iddanhmuc"] . "</td>";
                    echo "<td>" . $row["tendanhmuc"] . "</td>";
                    echo "<td>
                        <button type='button' onclick=\"editCategory('" . $row["iddanhmuc"] . "', '" . $row["tendanhmuc"] . "')\">Sửa</button>
                        <form action='themxoasuadm.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='iddanhmuc' value='" . $row["iddanhmuc"] . "'>
                            <button type='submit' name='action' value='delete'>Xóa</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Không có danh mục nào.</td></tr>";
            }
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
    <script>
        function editCategory(id, name) {
            document.getElementById('iddanhmuc').value = id;
            document.getElementById('tendanhmuc').value = name;
            document.querySelector('button[name="action"][value="update"]').disabled = false;
        }
    </script>
</body>
</html>


















