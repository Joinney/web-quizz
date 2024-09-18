<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$admin_username = "admin@gmail.com"; // Username của admin
$admin_id = null; // Khởi tạo biến để lưu ID của admin

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Dò ID của admin dựa trên username
$sql = "SELECT idtaikhoan FROM taikhoan WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$stmt->bind_result($admin_id);
$stmt->fetch();
$stmt->close();

// Kiểm tra nếu không tìm thấy ID của admin
if ($admin_id === null) {
    die("Admin không được tìm thấy trong cơ sở dữ liệu.");
}

// Kiểm tra số lượng tin nhắn chưa đọc
$sql = "SELECT COUNT(*) FROM tinnhan WHERE idnguoinhan = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$stmt->bind_result($unread_count);
$stmt->fetch();
$stmt->close();

// Xử lý gửi trả lời tin nhắn
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply']) && isset($_POST['id'])) {
    $message = $conn->real_escape_string($_POST['reply']);
    $sender_id = $admin_id; // ID của quản lý (admin)
    $receiver_id = $_POST['id']; // ID của người dùng
    $sql = "INSERT INTO tinnhan (idtaikhoan, idnguoinhan, tinnhan, thoigiangui, is_read) VALUES (?, ?, ?, NOW(), 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
    $stmt->execute();
    $stmt->close();
}

// Lấy danh sách người dùng để chọn (ngoại trừ admin)
$sql = "SELECT idtaikhoan, username FROM taikhoan WHERE idtaikhoan != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$users = $stmt->get_result();

// Kiểm tra tin nhắn chưa đọc cho người dùng đã chọn
if (isset($_POST['id'])) {
    $user_id = $_POST['id'];
    
    // Đánh dấu tin nhắn là đã đọc
    $sql = "UPDATE tinnhan SET is_read = 1 WHERE idtaikhoan = ? AND idnguoinhan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $admin_id);
    $stmt->execute();
    $stmt->close();
    
    // Hiển thị tin nhắn giữa admin và người dùng đã chọn
    $sql = "SELECT * FROM tinnhan WHERE (idtaikhoan = ? AND idnguoinhan = ?) OR (idnguoinhan = ? AND idtaikhoan = ?) ORDER BY thoigiangui";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $user_id, $admin_id, $user_id, $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="../../Css/main.css">
    <link rel="stylesheet" href="../Css/tinhan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .admin-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .admin-container h1 {
            font-size: 24px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .admin-container label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
        }
        .admin-container select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .messages-box {
            border: 1px solid #ddd;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
        }
        .message.user {
            background-color: #e0f7fa;
        }
        .message.admin {
            background-color: #ffebee;
            color: #c62828;
            text-align: right;
        }
        .message p {
            margin: 0;
        }
        .message p strong {
            color: #007bff;
        }
        .message p small {
            display: block;
            color: #999;
            font-size: 12px;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            resize: none;
            margin-bottom: 10px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        button:disabled {
            background-color: #eed809;
            cursor: not-allowed;
        }
        .notification {
            background-color: #ffeb3b;
            color: #333;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
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
    
    <div class="admin-container">
        <h1>Quản lý Tin Nhắn</h1>

        <!-- Hiển thị thông báo nếu có tin nhắn chưa đọc -->
        <?php if (isset($unread_count) && $unread_count > 0): ?>
            <div class="notification">
                <p>Bạn có <?php echo $unread_count; ?> tin nhắn mới chưa đọc!</p>
            </div>
        <?php endif; ?>

        <!-- Form chọn người dùng -->
        <form method="post" action="">
            <label for="id">Chọn người dùng:</label>
            <select name="id" id="id" required>
                <option value="">-- Chọn người dùng --</option>
                <?php while ($row = $users->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['idtaikhoan']); ?>" 
                        <?php echo (isset($_POST['id']) && $_POST['id'] == $row['idtaikhoan']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['username']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Xem Tin Nhắn</button>
        </form>

        <!-- Hiển thị tin nhắn giữa admin và người dùng đã chọn -->
        <?php if (isset($_POST['id']) && $result): ?>
            <div class="messages-box">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="message <?php echo ($row['idtaikhoan'] == $admin_id ? 'admin' : 'user'); ?>">
                        <p><strong><?php echo ($row['idtaikhoan'] == $admin_id ? 'Quản lý' : 'Người dùng'); ?>:</strong> <?php echo htmlspecialchars($row['tinnhan']); ?></p>
                        <p><small><?php echo htmlspecialchars($row['thoigiangui']); ?></small></p>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Form gửi tin nhắn -->
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id']); ?>">
                <textarea name="reply" placeholder="Nhập tin nhắn trả lời..." required></textarea>
                <button type="submit">Gửi</button>
            </form>
        <?php endif; ?>
    </div>


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
