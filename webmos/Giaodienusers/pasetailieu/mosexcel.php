
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
    <div class="lienhe-header" bis_skin_checked="1">MOS EXCEL</div> 
    <style>
        .lienhe-header {
            margin-top: 20px;
            height: auto;
            font-size: 24px;
            font-weight: bold;
            line-height: 40px;
            padding: 10px;
            background: #6dbe69;
            border-radius: 10px 10px 0 0;
            text-align: center;
            color: black;
            }
    </style>
        <div id="blog-posts">
            
            <!-- Bài viết 1 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/huong-dan-cach-ve-bieu-do-hinh-tron-trong-excel/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-ve-bieu-do-hinh-tron-trong-excel-300x185.jpg" alt="Cách vẽ biểu đồ hình tròn trong excel">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Hướng dẫn các cách vẻ biểu đồ hình tròn trong Excel nhanh nhất</h5>
                            <p class="from_the_blog_excerpt">Hôm nay, Trung tâm Ngoại ngữ Tin học Vũng Tàu sẽ hướng dẫn các bạn [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">22</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Bài viết 2 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/huong-dan-cac-buoc-ve-bieu-do-cot-trong-excel/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cach-ve-bieu-do-cot-trong-excel-300x185.jpg" alt="Hướng dẫn các bước vẽ biểu đồ cột trong Excel đơn giản đẹp mắt">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Hướng dẫn các bước vẽ biểu đồ cột trong Excel đơn giản đẹp mắt</h5>
                            <p class="from_the_blog_excerpt">Rất nhiều người quan tâm đến cách vẽ biểu đồ cột trong Excel được tiến [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">21</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Bài viết 3 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/cac-ham-trong-excel-can-ban-nhat-ma-bat-ky-ai-cung-phai-biet/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/cac-ham-excel-co-ban-thong-dung-cho-nguoi-moi-bat-dau-300x180.jpg" alt="Các hàm trong excel căn bản nhất mà bất kỳ ai cũng phải biết">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Các hàm trong excel căn bản nhất mà bất kỳ ai cũng phải biết</h5>
                            <p class="from_the_blog_excerpt">Hàm trong excel là gì? Vậy các hàm trong excel là gì? Tại sao hàm [...]</p>
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

            <!-- Bài viết 4 -->
            <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/ham-if-trong-excel-cach-su-dung-ham-if/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/ham-if-trong-excel-cach-su-dung-ham-if-qua-tung-vi-du-bai-tap-cu-the-300x185.jpg" alt="Hàm IF trong Excel - Cách sử dụng hàm IF qua từng ví dụ bài tập cụ thể">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Hàm IF trong Excel - Cách sử dụng hàm IF qua từng ví dụ bài tập cụ thể</h5>
                            <p class="from_the_blog_excerpt">Hàm IF trong Excel là một trong những hàm cơ bản và quan trọng, giúp người dùng [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">19</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

             <!-- Bài viết 5 -->
             <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/ham-if-trong-excel-cach-su-dung-ham-if/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/ham-if-trong-excel-cach-su-dung-ham-if-qua-tung-vi-du-bai-tap-cu-the-300x185.jpg" alt="Hàm IF trong Excel - Cách sử dụng hàm IF qua từng ví dụ bài tập cụ thể">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Hàm IF trong Excel - Cách sử dụng hàm IF qua từng ví dụ bài tập cụ thể</h5>
                            <p class="from_the_blog_excerpt">Hàm IF trong Excel là một trong những hàm cơ bản và quan trọng, giúp người dùng [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">19</span><br>
                                <span class="post-date-month">Th1</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




             <!-- Bài viết 6 -->
             <div class="post-item">
                <a href="https://ngoaingutinhocvungtau.com/ham-if-trong-excel-cach-su-dung-ham-if/" class="plain">
                    <div class="box">
                        <div class="box-image">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/01/ham-if-trong-excel-cach-su-dung-ham-if-qua-tung-vi-du-bai-tap-cu-the-300x185.jpg" alt="Hàm IF trong Excel - Cách sử dụng hàm IF qua từng ví dụ bài tập cụ thể">
                        </div>
                        <div class="box-text">
                            <h5 class="post-title">Hàm IF trong Excel - Cách sử dụng hàm IF qua từng ví dụ bài tập cụ thể</h5>
                            <p class="from_the_blog_excerpt">Hàm IF trong Excel là một trong những hàm cơ bản và quan trọng, giúp người dùng [...]</p>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span class="post-date-day">19</span><br>
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
