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
    <div class="lienhe-header" bis_skin_checked="1">MOS POWERPOINT</div> 
    <style>
        .lienhe-header {
            margin-top: 20px;
            height: auto;
            font-size: 24px;
            font-weight: bold;
            line-height: 40px;
            padding: 10px;
            background: #ff853b;
            border-radius: 10px 10px 0 0;
            text-align: center;
            color: black;
            }
    </style>
    <div id="blog-posts">
        
        <!-- Bài viết 1 -->
        <div class="post-item">
            <a href="https://ngoaingutinhocvungtau.com/luu-font-chu-su-dung-trong-slide/" class="plain">
                <div class="box box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-cover">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/04/luu-font-chu-su-dung-trong-slide-cua-ban-di-theo-file-powerpoint-300x164.jpg" alt="Lưu font chữ sử dụng trong slide của bạn đi theo file powerpoint" title="LƯU FONT CHỮ SỬ DỤNG TRONG SLIDE CỦA POWERPOINT">
                        </div>
                    </div>
                    <div class="box-text text-left">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large">LƯU FONT CHỮ SỬ DỤNG TRONG SLIDE CỦA POWERPOINT</h5>
                            <div class="is-divider"></div>
                            <p class="from_the_blog_excerpt">Việc này rất hữu ích khi Slide của bạn có soạn thảo bằng các font [...]</p>
                        </div>
                    </div>
                    <div class="badge post-date badge-square">
                        <div class="badge-inner">
                            <span class="post-date-day">18</span><br>
                            <span class="post-date-month is-xsmall">Th4</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Bài viết 2 -->
        <div class="post-item">
            <a href="https://ngoaingutinhocvungtau.com/cach-tao-hieu-ung-doi-mau-chu-trong-powerpoint/" class="plain">
                <div class="box box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-cover">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/02/tao-hieu-ung-doi-mau-chu-trong-power-point-300x176.jpg" alt="tạo hiệu ứng đổi mầu chữ trong powerpoint" title="Cách tạo hiệu ứng đổi màu chữ trong Powerpoint">
                        </div>
                    </div>
                    <div class="box-text text-left">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large">Cách tạo hiệu ứng đổi màu chữ trong Powerpoint</h5>
                            <div class="is-divider"></div>
                            <p class="from_the_blog_excerpt">Việc thêm hiệu ứng giúp bài thuyết trình Powerpoint của bạn thêm phần đẹp mắt, [...]</p>
                        </div>
                    </div>
                    <div class="badge post-date badge-square">
                        <div class="badge-inner">
                            <span class="post-date-day">25</span><br>
                            <span class="post-date-month is-xsmall">Th2</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Bài viết 3 -->
        <div class="post-item">
            <a href="https://ngoaingutinhocvungtau.com/hieu-ung-chuyen-slide-trong-powerpoint/" class="plain">
                <div class="box box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-cover">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/02/cach-chen-hieu-ung-chuyen-slide-trong-powerpoint-300x176.jpg" alt="cách chèn hiệu ứng chuyển slide trong powerpoint" title="Cách chèn hiệu ứng chuyển slide trong Powerpoint">
                        </div>
                    </div>
                    <div class="box-text text-left">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large">Cách chèn hiệu ứng chuyển slide trong Powerpoint</h5>
                            <div class="is-divider"></div>
                            <p class="from_the_blog_excerpt">Khi bạn đang ở chế độ trình chiếu slide, lúc chuyển tiếp giữa các slide [...]</p>
                        </div>
                    </div>
                    <div class="badge post-date badge-square">
                        <div class="badge-inner">
                            <span class="post-date-day">25</span><br>
                            <span class="post-date-month is-xsmall">Th2</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Bài viết 4 -->
        <div class="post-item">
            <a href="https://ngoaingutinhocvungtau.com/cach-chen-video-vao-powerpoint/" class="plain">
                <div class="box box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-cover">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/02/cach-chen-video-vao-powerpoint-300x176.jpg" alt="cách chèn video vào powerpoint" title="Cách chèn video vào Powerpoint">
                        </div>
                    </div>
                    <div class="box-text text-left">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large">Cách chèn video vào Powerpoint</h5>
                            <div class="is-divider"></div>
                            <p class="from_the_blog_excerpt">Việc chèn video vào bài thuyết trình Powerpoint giúp nâng cao sự hấp dẫn [...]</p>
                        </div>
                    </div>
                    <div class="badge post-date badge-square">
                        <div class="badge-inner">
                            <span class="post-date-day">30</span><br>
                            <span class="post-date-month is-xsmall">Th2</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>


 <!-- Bài viết 5-->
 <div class="post-item">
            <a href="https://ngoaingutinhocvungtau.com/cach-chen-video-vao-powerpoint/" class="plain">
                <div class="box box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-cover">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/02/cach-chen-video-vao-powerpoint-300x176.jpg" alt="cách chèn video vào powerpoint" title="Cách chèn video vào Powerpoint">
                        </div>
                    </div>
                    <div class="box-text text-left">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large">Cách chèn video vào Powerpoint</h5>
                            <div class="is-divider"></div>
                            <p class="from_the_blog_excerpt">Việc chèn video vào bài thuyết trình Powerpoint giúp nâng cao sự hấp dẫn [...]</p>
                        </div>
                    </div>
                    <div class="badge post-date badge-square">
                        <div class="badge-inner">
                            <span class="post-date-day">30</span><br>
                            <span class="post-date-month is-xsmall">Th2</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>





         <!-- Bài viết 6 -->
         <div class="post-item">
            <a href="https://ngoaingutinhocvungtau.com/cach-chen-video-vao-powerpoint/" class="plain">
                <div class="box box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-cover">
                            <img src="https://ngoaingutinhocvungtau.com/wp-content/uploads/2022/02/cach-chen-video-vao-powerpoint-300x176.jpg" alt="cách chèn video vào powerpoint" title="Cách chèn video vào Powerpoint">
                        </div>
                    </div>
                    <div class="box-text text-left">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large">Cách chèn video vào Powerpoint</h5>
                            <div class="is-divider"></div>
                            <p class="from_the_blog_excerpt">Việc chèn video vào bài thuyết trình Powerpoint giúp nâng cao sự hấp dẫn [...]</p>
                        </div>
                    </div>
                    <div class="badge post-date badge-square">
                        <div class="badge-inner">
                            <span class="post-date-day">30</span><br>
                            <span class="post-date-month is-xsmall">Th2</span>
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
