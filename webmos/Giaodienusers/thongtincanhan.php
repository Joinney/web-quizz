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
$sql = "SELECT hoten, username, diachi, sdt, image FROM taikhoan WHERE username = ?";
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
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/thongtincanhan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="../Css/doimk.css">
    
    
    <style>


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
                    <img src="../img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
    
                <li><a href="../Giaodienusers/index.php">Trang Chủ</a></li>
                <li><a href="../Giaodienusers/gioithieu.php">Giới Thiệu </a></li>            
                <li><a href="../Giaodienusers/tailieu.php" class="active">Tài liệu</a></li>
                <li><a href="../Giaodienusers/diendan.php" class="active">Diễn đàn</a></li>
                <li class="nav-user-info">
                    <a href="kiemtra.php">Kiểm Tra</a>
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
                                echo '<li><a href="../Giaodienusers/kiemtra.php?id=' . $idDanhMuc . '">' . $tenDanhMuc . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found.</a></li>';
                        }

                        mysqli_close($conn3);
                        ?>
                    </ul>
                </li>
                <li><a href="../Giaodienusers/tintuc.php">Tin tức</a></li>
                <li><a href="../Giaodienusers/lienhe.php" class="active">Liên hệ</a></li>
                <?php if (isset($_SESSION['hoten'])): ?>
                <li class="nav-user-info">
                    <span class="user-name">Xin chào, <?php echo $_SESSION['hoten']; ?>!</span>
                    <div class="user-dropdown">
                        <a href="../Giaodienusers/thongtincanhan.php">Thông tin cá nhân</a>
                        <!-- Modal Đổi Mật Khẩu -->
                        <a id="openModal">Đổi mật khẩu</a>
                        <div id="changePasswordModal" class="modal" style="display:none;">
                            <div class="modal-content">
                                <span class="close" id="closeModal">&times;</span>
                                <h2>Đổi mật khẩu</h2>
                                <form action="../Giaodienusers/thongtincanhan/doi_password.php" method="POST">
                                    <div class="form-group">
                                        <label for="newPassword">Mật khẩu mới:</label>
                                        <input type="password" name="newPassword" id="newPassword" required>
                                    </div>
                                    <button type="submit" class="btns">Cập nhật mật khẩu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="../index.php?logout=true" class="btn">Đăng xuất</a>
                </li>
            <?php else: ?>
                <li><a href="login.php" class="btn">Đăng nhập</a></li>
            <?php endif; ?>
            </ul>
             
        </div>
    </nav>
    <!-- Thêm thanh tìm kiếm -->
    <div class="search-container">
                <form action="./timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>


    
<div class="profile-container">
    <h2>Thông tin cá nhân</h2>
    
    <div class="profile-header">
        <div class="profile-details">
            <div class="profile-item">
                <span>Họ tên:</span> <?php echo htmlspecialchars($user['hoten']); ?>
            </div>
            <div class="profile-item">
                <span>Tên đăng nhập:</span> <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="profile-item">
                <span>Địa chỉ:</span> <?php echo htmlspecialchars($user['diachi']); ?>
            </div>
            <div class="profile-item">
                <span>Số điện thoại:</span> <?php echo htmlspecialchars($user['sdt']); ?>
            </div>
        </div>

        <!-- Display user's profile picture -->
        <img src="../img/<?php echo htmlspecialchars($user['image']); ?>" alt="Profile Picture">

    </div>

    <div class="profile-buttons">
        <button class="btns" id="changeImageBtn">Đổi hình ảnh</button>
        <button class="btns" id="changePasswordBtn">Đổi mật khẩu</button>
        <button class="btns" id="lichsubaithi">Lịch sử bài thi</button>

    <!-- Modal Đổi Hình Ảnh -->
    <div id="changeImageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Đổi hình ảnh</h3>
            <form action="../Giaodienusers/thongtincanhan/upload_image.php " method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="newImage">Chọn hình ảnh mới:</label>
                    <input type="file" name="newImage" id="newImage" required>
                </div>
                <button type="submit" class="btns">Cập nhật hình ảnh</button>
            </form>
        </div>
    </div>

    <!-- Modal Đổi Mật Khẩu -->
    <div id="changePasswordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Đổi mật khẩu</h3>
            <form action="../Giaodienusers/thongtincanhan/doi_password.php" method="POST">
             
                <div class="form-group">
                    <label for="newPassword">Mật khẩu mới:</label>
                    <input type="password" name="newPassword" id="newPassword" required>
                </div>
                <button type="submit" class="btns">Cập nhật mật khẩu</button>
            </form>
        </div>
    </div>
    <!-- Modal Lịch Sử Bài Thi -->
    <div id="examHistoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Lịch sử bài thi</h3>
            <div id="examHistoryContent">
                <!-- Content will be dynamically loaded here -->
            </div>
        </div>
    </div>

        <!-- Admin button -->
        <?php if ($username === 'admin@gmail.com'): ?>
            <a href="../admin/admin.php" class="btns">Quản trị viên</a>
        <?php endif; ?>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Khi tài liệu đã được tải xong

    var changeImageBtn = document.getElementById('changeImageBtn');
    // Lấy nút đổi hình ảnh

    var changePasswordBtn = document.getElementById('changePasswordBtn');
    // Lấy nút đổi mật khẩu

    var lichsuBaiThiBtn = document.getElementById('lichsubaithi');
    // Lấy nút lịch sử bài thi

    var modals = document.querySelectorAll('.modal');
    // Lấy tất cả các modal

    var closeBtns = document.querySelectorAll('.modal .close');
    // Lấy tất cả các nút đóng modal

    function showModal(modalId) {
        // Hàm hiển thị modal
        var modal = document.getElementById(modalId);
        // Lấy modal theo ID
        modal.style.display = 'block';
        // Hiển thị modal
    }

    function closeModal() {
        // Hàm đóng tất cả các modal
        modals.forEach(modal => {
            modal.style.display = 'none';
            // Ẩn modal
        });
    }

    changeImageBtn.addEventListener('click', function () {
        // Khi nút đổi hình ảnh được nhấp
        showModal('changeImageModal');
        // Hiển thị modal đổi hình ảnh
    });

    changePasswordBtn.addEventListener('click', function () {
        // Khi nút đổi mật khẩu được nhấp
        showModal('changePasswordModal');
        // Hiển thị modal đổi mật khẩu
    });

    lichsuBaiThiBtn.addEventListener('click', function () {
        // Khi nút lịch sử bài thi được nhấp
        showModal('examHistoryModal');
        // Hiển thị modal lịch sử bài thi
        loadExamHistory(); // Hàm tải nội dung lịch sử bài thi
    });

    closeBtns.forEach(btn => {
        // Thêm sự kiện click cho tất cả các nút đóng modal
        btn.addEventListener('click', function () {
            closeModal();
            // Đóng modal khi nút đóng được nhấp
        });
    });

    // Hàm tải nội dung lịch sử bài thi
    function loadExamHistory() {
        var xhr = new XMLHttpRequest();
        // Tạo một yêu cầu XMLHttpRequest mới
        xhr.open('GET', '../Giaodienusers/thongtincanhan/exam_history.php', true);
        // Mở yêu cầu GET tới URL 'get_exam_history.php'
        xhr.onload = function () {
            // Khi yêu cầu hoàn tất
            if (xhr.status === 200) {
                document.getElementById('examHistoryContent').innerHTML = xhr.responseText;
                // Cập nhật nội dung của phần tử với ID 'examHistoryContent' với phản hồi từ yêu cầu
            } else {
                document.getElementById('examHistoryContent').innerHTML = 'Không thể tải lịch sử bài thi.';
                // Hiển thị thông báo lỗi nếu không thể tải nội dung
            }
        };
        xhr.send();
        // Gửi yêu cầu
    }
    
});


    </script>
</div>

    <section id="section__footer" class="body__section">
    <div id="block__logo" class="block__footer">
        <li class="logo-item">
            <a href="" class="logo">
                <img src="../img/LogoMOS.jpg" alt="MOS Learning Logo">
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
            <a href=""><i class="bx bxl-facebook"></i></a>
            <a href=""><i class="bx bxl-github"></i></a>
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
    <script src="../Js/doimk.js"></script>
</body>
</html>