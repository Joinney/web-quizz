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




// Lấy danh sách các danh mục
$sql_categories = "SELECT * FROM danhmuc";
$categories_result = $conn->query($sql_categories);

// Lấy ID danh mục từ URL nếu có
$category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy tất cả các đề thi hoặc lọc theo danh mục
if ($category_id > 0) {
    $sql_exams = "SELECT * FROM dethi WHERE iddanhmuc = ?";
    $stmt = $conn->prepare($sql_exams);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $exams_result = $stmt->get_result();
} else {
    $sql_exams = "SELECT * FROM dethi";
    $exams_result = $conn->query($sql_exams);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục và Đề thi</title>
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/kiemtras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="../Css/doimk.css">

    <style>
        .countdown-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            text-align: center;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            z-index: 9999;
        }
        .countdown {
            margin-bottom: 20px;
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
                <i class="fab fa-whatsapp"></i>
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

    <h1>Danh mục và Đề thi</h1>
    <style>h1 {
                text-align: center;
            }</style>                   
    <div class="containers">
        <!-- Danh mục -->
        <section class="categories-section">
            <h2>Danh mục</h2>
            <ul class="categories-list">
                <?php while($category = $categories_result->fetch_assoc()): ?>
                    <li class="category-item">
                        <a href="?id=<?php echo $category['iddanhmuc']; ?>">
                            <?php echo $category['tendanhmuc']; ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>

        <!-- Đề thi -->
        <section class="exams-section">
            <h2>Tất cả Đề thi</h2>
            <?php if ($exams_result->num_rows > 0): ?>
                <div class="exams-list">
                    <?php while($exam = $exams_result->fetch_assoc()): ?>
                        <div class="exam-item">
                            <img src="../img/<?php echo $exam['hinhanh']; ?>" alt="<?php echo $exam['tendethi']; ?>">
                            <div class="new-badge">New</div>
                            <div class="rating">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="time">
                                <?php echo $exam['thoigian']; ?>
                            </div>
                            <div class="exam-details">
                                <h3><?php echo $exam['tendethi']; ?></h3>
                                <p><?php echo $exam['mota']; ?></p>
                                <a href="../dethichitiet.php?id=<?php echo $exam['iddethi']; ?>" class="details-button">Xem chi tiết</a>
                                <a href="../Giaodienusers/tracnghiem/kiemtradk.php?id=<?php echo $exam['iddethi']; ?>" class="start-button" >Bắt đầu thi</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Không có đề thi nào.</p>
            <?php endif; ?>
        </section>
    </div>

    <!-- 10s sẳn sàng exam questions -->
    <div id="countdown-container" class="countdown-container">
        <div class="countdown">Sẵn sàng trong <span id="countdown">10</span> giây...</div>
    </div>


    <!-- Đoạn mã JavaScript để bắt đầu bài thi -->
    <script>
        function startExam(examId) {
            fetch('kiemtradk.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'examId=' + encodeURIComponent(examId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.allowed) {
                    if (data.redirectUrl) {
                        window.location.href = data.redirectUrl;
                    }
                } else {
                    alert(data.message); // Hiển thị thông báo nếu không đủ điều kiện
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>

    
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
                <a href="https://www.facebook.com/zVoDuyToanz"><i class="bx bxl-facebook"></i></a>
                <a href="https://github.com/Toanvo712"><i class="bx bxl-github"></i></a>
            </div>
        </div>
    </section>

    <footer class="footer__bottom">
        <div class="text-center">
            <p>Copyright © 2023 MOS Learning All Rights Reserved.</p>
        </div>
    </footer>

    <script src="../Js/10giayss.js"></script>
    <script src="../Js/doimk.js"></script>
</body>
</html>
