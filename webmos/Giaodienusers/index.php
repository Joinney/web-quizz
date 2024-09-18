
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

// Ghi Nhận Lượt Truy Cập
$idtaikhoan = $_SESSION['idtaikhoan'];
$trang = $_SERVER['REQUEST_URI'];

$sql = "INSERT INTO thongketruycap (idtaikhoan, trang) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $idtaikhoan, $trang);
$stmt->execute();
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
    <link rel="stylesheet" href="../Css/tinhan.css">
    <link rel="stylesheet" href="../Css/quangcaopos.css">
    <link rel="stylesheet" href="../Css/doimk.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
     
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
   

    <!-- Swiper Container -->
<div class="custom-swiper-container">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide custom-swiper-slide">
            <img src="https://csc.edu.vn/data/images/slider/Tin%20hoc%20Van%20Phong/297-ic3-spark.png" alt="Slide 1">
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide custom-swiper-slide">
            <img src="https://csc.edu.vn/data/images/slider/Tin%20hoc%20Van%20Phong/297-mos-word.png" alt="Slide 2">
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide custom-swiper-slide">
            <img src="https://csc.edu.vn/data/images/slider/Tin%20hoc%20Van%20Phong/297-mos-excel.png" alt="Slide 3">
        </div>
        <!-- Slide 4 -->
        <div class="swiper-slide custom-swiper-slide">
        <img src="https://scontent.fsgn2-11.fna.fbcdn.net/v/t39.30808-6/454320661_1502209007254628_8055042921658520676_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=xIO8DLoS5X4Q7kNvgE7QqgL&_nc_ht=scontent.fsgn2-11.fna&_nc_gid=AQlEhEFmeljdEcCTH1JB6ID&oh=00_AYCay6h5Rx6xN9qpspSSW5LA2SrNff7zev0F7kjpcUMPkw&oe=66EAAD3F" alt="Slide 4" style="width: 100%; height: 307px; object-fit: cover;">

        </div>
        <!-- Add more slides as needed -->
    </div>

    <!-- Pagination (dots) -->
    <div class="custom-swiper-pagination"></div>

    <!-- Navigation arrows -->
    <div class="custom-swiper-button-next"></div>
    <div class="custom-swiper-button-prev"></div>
</div>

<!-- Main banner section -->
<section class="hero">
    <div class="container">
        <h1>Học MOS cơ bản một cách dễ dàng và hiệu quả</h1>
        <p>Khám phá các khóa học và tài liệu chất lượng cao để nâng cao kỹ năng tin học văn phòng của bạn.</p>
        <a href="../Giaodienusers/kiemtra.php" class="btn">Bắt đầu ngay</a>
    </div>
</section>

    <!-- Mục tìm kiếm -->
    <section class="search">
        <div class="container">
            <h2>Tìm kiếm khóa học</h2>
            <form action="./timkiem.php" method="GET">
                <input type="text" name="search" id="search" placeholder="Nhập từ khoá tìm kiếm...">
                <button type="submit" class="btn" 
    style="background-color: #007aff; 
           color: white; 
           padding: 16px 24px; 
           border: none; 
           border-radius: 5px; 
           font-size: 16px; 
           cursor: pointer; 
           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
           transition: background-color 0.3s ease, transform 0.2s ease;">
    Tìm kiếm
</button>
            </form>
        </div>
    </section>

    <!-- Danh sách các khóa học -->
    <section id="courses" class="courses">
        <div class="container">
            <h2>Khóa học phổ biến</h2>
            <div class="course-grid">
                <div class="course-item course-word">
                    <h3>MOS Word</h3>
                    <p>Tìm hiểu các kỹ năng xử lý văn bản với Microsoft Word.</p>
                    <a href="./pasetailieu/mosword.php" class="btn">Xem chi tiết</a>
                </div>
                <div class="course-item course-excel">
                    <h3>MOS Excel</h3>
                    <p>Khám phá các công cụ phân tích và quản lý dữ liệu với Microsoft Excel.</p>
                    <a href="./pasetailieu/mosexcel.php" class="btn">Xem chi tiết</a>
                </div>
                <div class="course-item course-powerpoint">
                    <h3>MOS PowerPoint</h3>
                    <p>Học cách tạo và thiết kế các bài thuyết trình chuyên nghiệp.</p>
                    <a href="./pasetailieu/mospower.php" class="btn">Xem chi tiết</a>
                </div>                
            </div>
        </div>
    </section>

     <!-- Ôn tập -->
<section id="tutorials" class="tutorials">
    <div class="container">
        <h2>Các tính năng mới nhất</h2>
        <div class="tutorial-grid">
            <div class="tutorial-item word">
                <h3>Đề thi trắc nghiệm</h3>
                <p>Đa dạng đề tạo theo cấu trúc phân loại giúp bạn dễ dàng ôn tập online thi giữa kỳ, thi học kỳ theo các môn học.</p>
                <a href="../Giaodienusers/kiemtra.php" class="btn">Xem chi tiết</a>
            </div>
            <div class="tutorial-item excel">
                <h3>Tài liệu tham khảo</h3>
                <p>Tổng hợp đề thi minh họa và đề thi chính thức.</p>
                <a href="tailieu.php" class="btn">Xem chi tiết</a>
            </div>
            <div class="tutorial-item powerpoint">
                <h3>Ôn tập kiến thức</h3>
                <p>Hệ thống lý thuyết ngắn gọn, phương pháp giải nhanh dễ hiểu, bám sát đủ các môn.</p>
                <a href="../Giaodienusers/ontap.php" class="btn">Xem chi tiết</a>
            </div>
        </div>
    </div>
</section>



            <!--THEO DOI CHUNG TOI-->
            <section class="follow" id="follow">
                <h3 style="margin-top: 2rem;font-size: 1.5rem;">Theo dõi chúng tôi!</h3>
                <div class="container-fluid">
                    <div class="swiper-container containerP">
                        <div class="swiper-wrapper content">
                            <!--slide 1-->
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../img/users.jpg" alt="">
                                    </div>
            
                                    <div class="media-icons">
                                        <a href="#">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa-brands fa-github"></i>
                                        </a> 
                                    </div>
            
            
                                    <div class="name-profession">
                                        <span class="name">Phan Minh Thuận</span>
                                        <span class="profession">Front-End</span>
                                    </div>
            
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-stroke"></i>
                                    </div>
            
                                    <div class="button-1">
                                        <a href="https://rainja-web.github.io/Phan4/">
                                        <button  class="aboutme">Thông tin chi tiết!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end slide1-->  
            
                            <!--slide 2-->
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../img/users.jpg" alt="">
                                    </div>
            
                                    <div class="media-icons">
                                        <a href="#">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa-brands fa-github"></i>
                                        </a> 
                                    </div>
            
            
                                    <div class="name-profession">
                                        <span class="name">Võ Duy Toàn</span>
                                        <span class="profession">Back-End|Front-End</span>
                                    </div>
            
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-stroke"></i>
                                    </div>
            
                                    <div class="button-1">
                                        <a href="https://joinney.github.io/web-cv/">
                                        <button  class="aboutme">Thông tin chi tiết!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end slide2-->  
            
                            <!--slide 3-->
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../img/users.jpg" alt="">
                                    </div>
            
                                    <div class="media-icons">
                                        <a href="">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa-brands fa-github"></i>
                                        </a> 
                                    </div>
            
                                    <div class="name-profession">
                                        <span class="name">Lê Đoàn Anh Tuấn</span>
                                        <span class="profession">Front-End</span>
                                    </div>
            
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-stroke"></i>
                                    </div>
            
                                    <div class="button-1">
                                        <a href="https://9monsix.github.io/In4-LeTuan/">
                                        <button  class="aboutme">Thông tin chi tiết!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end slide3-->  
            
            
                            <!--slide 4-->
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../img/usersn.jpg" alt="">
                                    </div>
            
                                    <div class="media-icons">
                                        <a href="#">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa-brands fa-github"></i>
                                        </a> 
                                    </div>
            
                                    <div class="name-profession">
                                        <span class="name">Nguyễn Thị Huyền Diệu</span>
                                        <span class="profession">Front-End</span>
                                    </div>
            
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-stroke"></i>
                                    </div>
            
                                    <div class="button-1">
                                        <a href="https://dieuuhuyenn.github.io/web-myself/">
                                        <button  class="aboutme">Thông tin chi tiết!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end slide4-->  
            
                            <!--slide 5-->
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../img/users.jpg" alt="">
                                    </div>
            
                                    <div class="media-icons">
                                        <a href="#">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa-brands fa-github"></i>
                                        </a> 
                                    </div>
            
            
                                    <div class="name-profession">
                                        <span class="name">Nguyễn Văn Thuận</span>
                                        <span class="profession">Front-End</span>
                                    </div>
            
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-stroke"></i>
                                    </div>
            
                                    <div class="button-1">
                                        <a href="https://rainja-web.github.io/Van5/?">
                                        <button  class="aboutme">Thông tin chi tiết!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end slide5-->  

                            <!--slide 6-->
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../img/users.jpg" alt="">
                                    </div>
            
                                    <div class="media-icons">
                                        <a href="#">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa-brands fa-github"></i>
                                        </a> 
                                    </div>
            
            
                                    <div class="name-profession">
                                        <span class="name">Lê Thanh Trọng</span>
                                        <span class="profession">Front-End</span>
                                    </div>
            
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-stroke"></i>
                                    </div>
            
                                    <div class="button-1">
                                        <a href="https://trong-hacker.github.io/trang-proposal-gi-i-thi-u-b-n-th-n/">
                                        <button  class="aboutme">Thông tin chi tiết!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end slide6-->  
                        </div>
            
                    </div>
                </div>
                <!--end-->
                
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> 
                
            </section>




    <!-- Phản hồi từ học viên -->
    <section class="testimonials">
        <div class="container">
            <h2>Phản hồi từ học viên</h2>
            <div class="testimonial-item">
                <p>"Khóa học thật sự tuyệt vời! Tôi đã cải thiện kỹ năng Word của mình chỉ trong vài tuần."</p>
                <h4>- Nguyễn Văn A</h4>
            </div>
            <div class="testimonial-item">
                <p>"Các hướng dẫn chi tiết và dễ hiểu. Tôi cảm thấy tự tin hơn khi sử dụng Excel trong công việc."</p>
                <h4>- Lê Thị B</h4>
            </div>
        </div>
    </section>
    


    <?php
// Lấy ID người dùng từ session
$user_id = $_SESSION['idtaikhoan'];
$admin_id = 1; // ID của quản lý (admin@gmail.com)

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có tin nhắn mới được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $conn->real_escape_string($_POST['message']);

    // Chèn tin nhắn vào bảng tinnhan
    $sql = "INSERT INTO tinnhan (idtaikhoan, idnguoinhan, tinnhan, thoigiangui, is_read) VALUES (?, ?, ?, NOW(), 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $admin_id, $message);
    $stmt->execute();
    $stmt->close();
}
?>

<!-- Chat button -->
<div class="chat-button" id="chatButton">
    <span>💬</span>
</div>

<!-- Chat container -->
<div class="chat-container" id="chatContainer">
    <h1>Chat với Quản lý</h1>
    <div class="chat-box">
        <?php
        // Hiển thị tin nhắn giữa người dùng và quản lý
        $sql = "SELECT * FROM tinnhan WHERE (idtaikhoan = ? AND idnguoinhan = ?) OR (idnguoinhan = ? AND idtaikhoan = ?) ORDER BY thoigiangui";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $user_id, $admin_id, $user_id, $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo '<div class="message">';
            echo '<p><strong>' . ($row['idtaikhoan'] == $user_id ? 'Bạn' : 'Admin') . ':</strong> ' . htmlspecialchars($row['tinnhan']) . '</p>';
            echo '<p><small>' . $row['thoigiangui'] . '</small></p>';
            echo '</div>';
        }
        $stmt->close();
        ?>
    </div>
    <form method="post" action="">
        <textarea name="message" placeholder="Nhập tin nhắn của bạn..." required></textarea>
        <button type="submit">Gửi</button>
    </form>
</div>

<?php $conn->close(); ?>















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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        });
    });
</script>
<script src="../Js/main.js" defer></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="../Js/theodoichungtoi.js"></script> 
<script src="../Js/tinnhan.js"></script> 
<script src="../Js/posquangcao.js"></script> 
<script src="../Js/doimk.js"></script> 

</body>
</html>
