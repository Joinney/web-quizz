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
    <link rel="stylesheet" href="../../Css/main.css">
    <link rel="stylesheet" href="../../Css/mostailieu.css">
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
                                echo '<li><a href="../../Giaodienusers/kiemtra.php?id=' . $idDanhMuc . '">' . $tenDanhMuc . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found.</a></li>';
                        }

                        mysqli_close($conn3);
                        ?>
                    </ul>
                </li>
                <li><a href="../../Giaodienusers/tintuc.php">Tin tức</a></li>
                <li><a href="../../Giaodienusers/lienhe.php" class="active">Liên hệ</a></li>
                <?php if (isset($_SESSION['hoten'])): ?>
                        <li class="nav-user-info">
                            <span class="user-name">Xin chào, <?php echo $_SESSION['hoten']; ?>!</span>
                            <div class="user-dropdown">
                                <a href="../../Giaodienusers/thongtincanhan.php">Thông tin cá nhân</a>
                                <a href="change_password.php">Đổi mật khẩu</a>
                               
                            </div>
                            <a href="../../index.php?logout=true" class="btn">Đăng xuất</a>
                        </li>
                        
                    <?php else: ?>
                        <li><a href="login.php" class="btn">Đăng nhập</a></li>
                    <?php endif; ?>

            </ul>
        </div>
    </nav>
    <!-- Thêm thanh tìm kiếm -->
    <div class="search-container">
                <form action="../timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>

    <div class="container">
    <div class="lienhe-header" bis_skin_checked="1">MOS WORD</div> 
    <style>
        .lienhe-header {
            margin-top: 20px;
            height: auto;
            font-size: 24px;
            font-weight: bold;
            line-height: 40px;
            padding: 10px;
            background: #0056b3;
            border-radius: 10px 10px 0 0;
            text-align: center;
            color: black;
            }
    </style>
        <div id="blog-posts">
            <!-- Post Item 1 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cach-tao-su-dung-macro-trong-word/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/02/cach-tao-su-dung-macro-trong-word-300x164.jpg" alt="Cách tạo sử dụng macro trong word">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">CÁCH TẠO, SỬ DỤNG MACRO TRONG WORD</h5>
                            <p class="from_the_blog_excerpt">Việc tạo 1 trình tác vụ lặp đi lặp lại để sử dụng cho các [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">10</span><br>
                                <span class="post-date-month">Th2</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Post Item 2 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cach-danh-so-trang-trong-word/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-danh-so-trang-trong-word-compressed-300x180.jpg" alt="Cách đánh số trang trong word">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Cách đánh số trang trong word</h5>
                            <p class="from_the_blog_excerpt">Hướng dẫn cách đánh số trang trong word nhanh đơn giản nhất với mọi phiên [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">20</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Post Item 3 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cach-su-dung-tab-trong-word/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-su-dung-tab-trong-wrod-300x180.jpg" alt="Cách sử dụng tab trong word">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Cách sử dụng tab trong word và cách tạo dấu chấm (...)</h5>
                            <p class="from_the_blog_excerpt">Hướng dẫn cách sử dụng tab trong word và cách tạo dấu chấm đơn giản [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">15</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>






        <!-- Post Item 4 -->
        <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cach-in-van-ban-trong-word/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-in-van-ban-trong-word-nhanh-nhat-compressed-300x180.jpg" alt="Cách sử dụng tab trong word">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Cách in văn bản trong word</h5>
                            <p class="from_the_blog_excerpt">Chúng ta sử dụng Microsoft Word để soạn thảo văn bản, và phần lớn văn [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">20</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <!-- Post Item 4 -->
        <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cach-in-van-ban-trong-word/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-in-van-ban-trong-word-nhanh-nhat-compressed-300x180.jpg" alt="Cách sử dụng tab trong word">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Cách in văn bản trong word</h5>
                            <p class="from_the_blog_excerpt">Chúng ta sử dụng Microsoft Word để soạn thảo văn bản, và phần lớn văn [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">20</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Post Item 4 -->
        <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cach-in-van-ban-trong-word/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-in-van-ban-trong-word-nhanh-nhat-compressed-300x180.jpg" alt="Cách sử dụng tab trong word">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Cách in văn bản trong word</h5>
                            <p class="from_the_blog_excerpt">Chúng ta sử dụng Microsoft Word để soạn thảo văn bản, và phần lớn văn [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">20</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>





        </div>
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

</body>
</html>
