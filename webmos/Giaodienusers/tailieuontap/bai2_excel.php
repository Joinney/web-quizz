
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
    <link rel="stylesheet" href="../../Css/ontap.css">
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
                <form action="../../Giaodienusers/timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>
  <!-- phần main ở đây -->

<sectiont class="course row" id="course">
<h2>Bài 2 - Thao tác với bảng tính</h2>
    <div class="col-3-4 layout">
        <!--Nội dung bài-->
        <div class="row lession">
            <div class="lession-content">
                <!--Nội dung phần I-->
                <div id="I-LaMa">
                    <h5>
                        <span><strong>I. Thành phần và các thao tác cơ bản</strong></span>
                    </h5>
                    <!--Mục 1 nhỏ-->
                    <div>
                        <p class="sub-title-lession" id="muc-1">
                            <span><strong>1. Giao diện chính của bảng tính</strong></span>
                            <li class="list-item-l1">Trên máy tính Windows, nhấp vào nút Start (Bắt đầu).</li>
                            <li class="list-item-l1">Tìm và chọn Microsoft Excel từ danh sách các ứng dụng hoặc gõ "Excel" vào thanh tìm kiếm và chọn ứng dụng.</li>
                        </p>
                        <div id="muc-1-pg1">
                            <p><strong><em>a. Thanh công cụ và thanh Ribbon</em></strong></p>
                            <li class="list-item-l1">Chứa các công cụ và chức năng cơ bản như lưu, in, cắt, sao chép, và dán.</li>
                            <li class="list-item-l1">Cung cấp các tab chức năng như Home, Insert, Page Layout, Formulas, Data, Review, và View. Mỗi tab chứa nhóm các công cụ liên quan.</li>
                        </div>
                        <div id="muc-1-pg2">
                            <p><strong><em>b. Khu vực làm việc</em></strong></p>
                            <li class="list-item-l1">Là các phần tử cơ bản của bảng tính nơi bạn nhập và thao tác dữ liệu.</li>
                            <li class="list-item-l1">Được sử dụng để di chuyển qua các phần không nhìn thấy của bảng tính.</li>
                            <li class="list-item-l1">Được sử dụng để xác định các cột và hàng trong bảng tính.</li>
                        </div>
                    </div>
                </div>
                <!--Hết phần I-->

                <!--Phần II-->
                <div id="II-LaMa">
                    <h5>
                        <span><strong>II. Làm việc với ô (Cell)</strong></span>
                    </h5>
                    <!--Mục 1 nhỏ-->
                    <div>
                        <p class="sub-title-lession" id="muc-2">
                            <span><strong>1. Chọn và nhập dữ liệu vào ô</strong></span>
                        </p>
                        <div id="muc2-1-pg1">
                            <p><strong><em>a. Chọn ô</em></strong></p>
                            <li class="list-item-l1">Nhấp vào ô mà bạn muốn chọn để nó trở thành ô hoạt động. Ô này sẽ được đánh dấu bằng một viền đậm. Bạn có thể chọn một ô đơn lẻ hoặc nhiều ô bằng cách kéo chuột qua các ô cần chọn.</li>
                        </div>
                        <div id="muc2-1-pg2">
                            <p><strong><em>b. Nhập dữ liệu vào ô</em></strong></p>
                            <li class="list-item-l1">Nhập dữ liệu trực tiếp vào ô bằng cách chọn ô và gõ thông tin vào ô. Sau đó nhấn Enter hoặc Tab để lưu dữ liệu và chuyển sang ô tiếp theo. Bạn có thể nhập văn bản, số, ngày tháng hoặc công thức vào ô.</li>

                        </div>
                    </div>
                </div>
                <!--Hết phần II-->

                <!--Phần III-->
                <div id="III-LaMa">
                    <h5>
                        <span><strong>III. Làm việc với cột</strong></span>
                    </h5>
                    <!--Mục 1 nhỏ-->
                    <div>
                        <p class="sub-title-lession" id="muc-3">
                            <span><strong>1. Chọn và thao tác với cột</strong></span>
                        </p>
                        <div id="muc3-1-pg1">
                            <p><strong><em>a. Chọn cột</em></strong></p>
                            <li class="list-item-l1">Nhấp vào tiêu đề cột (chữ cái ở đầu cột) để chọn toàn bộ cột. Tiêu đề cột sẽ được tô sáng khi chọn. Bạn có thể chọn nhiều cột liên tiếp bằng cách giữ phím Shift và nhấp vào các tiêu đề cột, hoặc chọn các cột không liên tiếp bằng cách giữ phím Ctrl và nhấp vào các tiêu đề cột khác.</li>
                        </div>
                        <div id="muc3-1-pg2">
                            <p><strong><em>b. Thay đổi kích thước cột</em></strong></p>
                            <li class="list-item-l1">Kéo đường viền bên phải tiêu đề cột để thay đổi kích thước cột. Thả chuột khi đạt kích thước mong muốn. Bạn cũng có thể thay đổi kích thước cột cho tất cả các cột cùng một lúc bằng cách chọn nhiều cột và kéo đường viền của bất kỳ tiêu đề cột nào trong số đó.</li>

                        </div>
                    </div>
                </div>
                <!--Hết phần III-->

                <!--Phần IV-->
                <div id="IV-LaMa">
                    <h5>
                        <span><strong>IV. Làm việc với hàng (dòng)</strong></span>
                    </h5>
                    <!--Mục 1 nhỏ-->
                    <div>
                        <p class="sub-title-lession" id="muc-4">
                            <span><strong>1. Chọn và thao tác với hàng</strong></span>
                        </p>
                        <div id="muc4-1-pg1">
                            <p><strong><em>a. Chọn hàng</em></strong></p>
                            <li class="list-item-l1">Nhấp vào tiêu đề hàng (số ở đầu hàng) để chọn toàn bộ hàng. Tiêu đề hàng sẽ được tô sáng khi chọn. Bạn có thể chọn nhiều hàng liên tiếp bằng cách giữ phím Shift và nhấp vào các tiêu đề hàng, hoặc chọn các hàng không liên tiếp bằng cách giữ phím Ctrl và nhấp vào các tiêu đề hàng khác.</li>
                        </div>
                        <div id="muc4-1-pg2">
                            <p><strong><em>b. Thay đổi kích thước hàng</em></strong></p>
                            <li class="list-item-l1">Kéo đường viền dưới tiêu đề hàng để thay đổi kích thước hàng. Thả chuột khi đạt kích thước mong muốn. Để thay đổi kích thước nhiều hàng cùng một lúc, chọn các hàng cần thay đổi và kéo đường viền của bất kỳ tiêu đề hàng nào trong số đó.</li>
                        </div>
                    </div>
                </div>
                <!--Hết phần IV-->

                <!--Phần V-->
                <div id="V-LaMa">
                    <h5>
                        <span><strong>V. Một số thao tác khác</strong></span>
                    </h5>
                    <!--Mục 1 nhỏ-->
                    <div>
                        <p class="sub-title-lession" id="muc-5">
                            <span><strong>1. Sao chép và dán dữ liệu</strong></span>
                        </p>
                        <div id="muc5-1-pg1">
                            <p><strong><em>a. Sao chép dữ liệu</em></strong></p>
                            <li class="list-item-l1">Chọn ô hoặc phạm vi ô cần sao chép. Nhấp chuột phải và chọn Copy (Sao chép) hoặc nhấn Ctrl+C. Dữ liệu sẽ được lưu vào bộ nhớ tạm thời và sẵn sàng để dán.</li>
                        </div>
                        <div id="muc5-1-pg2">
                            <p><strong><em>b. Dán dữ liệu</em></strong></p>
                            <li class="list-item-l1">Chọn ô đích và nhấp chuột phải chọn Paste (Dán) hoặc nhấn Ctrl+V để dán dữ liệu. Dữ liệu sao chép sẽ xuất hiện tại ô đích và có thể được điều chỉnh thêm nếu cần.</li>
                        </div>
                    </div>
                </div>
                <!--Hết phần V-->

            
            </div>
            
        </div>
        
    </div>
     <!--Mục lục-->
    <div class="col-1-4 card-table-content">
        <div class="card-header">
            <h4 class="card-title">Mục lục</h4>
        </div>
        <div class="card-body">
            <div class="table-of-content">
                <div class="toc-container"></div>
                <navs class="toc-links">
                    <ul class="toc-list toc-list-level-1">
                        <a href="#I-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">I. Thành phần và các thao tác cơ bản</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-1" class="heading-1">1. Giao diện chính của bảng tính</a>
                            <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc-1-pg1">a.  Thanh công cụ và thanh Ribbon</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc-1-pg2">b.  Khu vực làm việc</a>
                                        </li>
                                        
                                    </ul>
                        </li>
                    </ul>
                    <ul class="toc-list toc-list-level-1">
                        <a href="#II-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">II. Làm việc với ô (Cell)</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-2" class="heading-1">1.  Chọn và nhập dữ liệu vào ô</a>
                            <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc2-1-pg1">a.  Chọn ô</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc2-1-pg2">b. Nhập dữ liệu vào ô</a>
                                        </li>
                                        
                                    </ul>
                        </li>
                    </ul>
                    <ul class="toc-list toc-list-level-1">
                        <a href="#III-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">III. Làm việc với cột</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-3" class="heading-1">1. Chọn và thao tác với cột</a>
                            <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc3-1-pg1">a.  Chọn cột</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc3-1-pg2">b. Thay đổi kích thước cột</a>
                                        </li>
                                        
                                    </ul>                        
                        </li>
                    </ul>
                    <ul class="toc-list toc-list-level-1">
                        <a href="#IV-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">IV. Làm việc với hàng (dòng)</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-4" class="heading-1">1. Chọn và thao tác với hàng</a>
                            <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc4-1-pg1">a.  Chọn hàng</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc4-1-pg2">b. Thay đổi kích thước hàng</a>
                                        </li>
                                        
                                    </ul>
                        </li>
                    </ul>
                    <ul class="toc-list toc-list-level-1">
                        <a href="#V-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">V.  Một số thao tác khác</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-5" class="heading-1">1. Sao chép và dán dữ liệu</a>
                            <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc3-1-pg1">a.  Sao chép dữ liệu</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc3-1-pg2">B.  Dán dữ liệu</a>
                                        </li>
                                        
                                        
                                    </ul>
                        </li>
                    </ul>
                    
                </navs>
            </div>
        </div>
    </div>
</sectiont>



<!-- phần end main -->

<section1 id="section__footer" class="body__section">
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
</section1>

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
