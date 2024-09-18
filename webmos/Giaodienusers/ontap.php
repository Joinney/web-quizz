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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/ontap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="../Css/doimk.css">
    <script src="../Js/doimk.js"></script>
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
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://github.com" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://zalo.me" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
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
                                <a href="change_password.php">Đổi mật khẩu</a>
                               
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
                <form action="timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>
  <!-- phần main ở đây -->

  <section class="course row" id="course">
           <h1>ÔN TẬP LÝ THUYẾT</h1>
            <div class="col-3-4 layout">
                <!-- Bài WORD -->
                <div class="row subject-course">
                    <div class="course-title">
                        <!-- TÊN MÔN -->
                        <h3 class="subject-title">BÀI WORD</h3>
                    </div>
                    <!-- NỘI DUNG CỦA MỘT PHẦN ÔN TẬP GỒM CÁC BÀI ÔN -->
                    <!--BÀI ÔN 1-->
                    <div class="course-content">
                        <div class="course-title-document">
                            <p class="name-document">Bài 1: Làm quen với Microsoft Word 2013</p>
                            <span class="re-document"><a href="./tailieuontap/bai1_word.php"><button class="btn-Viewer">XEM</button></a></span>
                        </div>
                        
                    </div>
                    
                    <!-- BÀI ÔN 2-->
                    <div class="course-content">
                        <div class="course-title-document">
                            <p class="name-document">Bài 2: Soạn thảo văn bản </p>
                            <span class="re-document"><a href="./tailieuontap/bai2_word.php"><button class="btn-Viewer">XEM</button></a></span>
                        </div>
                    </div>
                    
                </div>

                <!-- Bài Excel-->
                <div class="subject-course">
                    <div class="course-title">
                        <!-- TÊN MÔN -->
                        <h3 class="subject-title">BÀI EXCEL</h3>
                    </div>
                    <!-- NỘI DUNG CỦA MỘT PHẦN ÔN TẬP GỒM CÁC BÀI ÔN -->
                    <!--BÀI ÔN 1-->
                    <div class="course-content">
                        <div class="course-title-document">
                            <p class="name-document">Bài 1: Khởi động làm quen giao diện Microsoft Excel</p>
                            <span class="re-document"><a href="./tailieuontap/bai1_excel.php"><button class="btn-Viewer">XEM</button></a></span>
                        </div>
                    </div>
                    
                    <!-- BÀI ÔN 2 -->
                    <div class="course-content">
                        <div class="course-title-document">
                            <p class="name-document">Bài 2: Các vùng kinh tế trọng điểm</p>
                            <span class="re-document"><a href="./tailieuontap/bai2_excel.php"><button class="btn-Viewer">XEM</button></a></span>
                        </div>
                    </div>

                </div>

                <!-- Bài Powerponit -->
                <div class="subject-course">
                    <div class="course-title">
                        <!-- TÊN MÔN -->
                        <h3 class="subject-title">BÀI POWERPOINT</h3>
                    </div>
                    <!-- NỘI DUNG CỦA MỘT PHẦN ÔN TẬP GỒM CÁC BÀI ÔN-->
                    <!--BÀI ÔN 1-->
                    
                    
                </div>
            </div>
            <div class="col-1-4 course-sub-content">
                <div class="container-sub-content">
                    <div class="sub-content-title">
                        <h3 class="sub-title">SÁCH NÂNG CAO</h3>
                    </div>
                    <div class="re-read">
                        <div class="img-book">
                            <img src="../img/word.jpg" alt="#" class="img-book-re-read">
                        </div>
                        <span><a href="https://drive.google.com/file/d/15766ZQ-QWcYQpjfrtHwo8plweMuXEHiX/view"><button class="btn-re-read">Xem ngay</button></a></span>
                        
                    </div>

                    <div class="re-read">
                        <div class="img-book">
                            <img src="../img/excel.png" alt="#" class="img-book-re-read">
                        </div>
                        <span><a href="https://drive.google.com/file/d/1w0WHpltyHORZl1HTgESBqxZziLQW3-vw/view"><button class="btn-re-read">Xem ngay</button></a></span>
                    </div>
                    <div class="re-read">
                        <div class="img-book">
                            <img src="../img/power.png" alt="#" class="img-book-re-read">
                        </div>
                        <span><a href="https://drive.google.com/file/d/1k2JoJNBHmumwmcNgm9_c_VQTyvsmHSiI/view"><button class="btn-re-read">Xem ngay</button></a></span>
                    </div>
                </div>
                
            </div>
        </section>









 <!-- phần end main -->
    
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
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://github.com" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://zalo.me" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
                <i class="fab fa-whatsapp"></i> <!-- Zalo icon is not available in Font Awesome, using WhatsApp as placeholder -->
            </a>
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

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
       <script src="Js/theodoichungtoi.js"></script> 

</body>
</html>
