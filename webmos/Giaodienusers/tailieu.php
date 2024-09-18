
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
    <title>Học MOS | Tài liệu</title>
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/tailieu.css">
    <link rel="stylesheet" href="../Css/doimk.css">
  


    <style>
        h1 {
    padding-top: 3rem;
    text-align: center;
    color: #F00;
    font-family: Arial;
    text-align: center;
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
                <form action="timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>

    <!-- Phần Hiển Thị thân -->



    <div id="content">
            <h1>Tài liệu tham khảo</h1>
            <div class="grid-container">
                <div>
                    <div class="row">
                        <img src="../img/wordethi.png" class="ti-book">
                    </div>
                    <div class="row">
                        <a href="https://file.vinatrain.com/uploads/GiaoTrinhWord2013.pdf">
                            <span>Tài Liệu [ Giáo Trình ] WORD – Microsoft Word từ cơ bản đến nâng cao PDF</span>
                        </a>
                    </div>
                </div>
                <!---->
                <div>
                    <div class="row">
                        <img src="../img/Excelethi.png" class="ti-book">
                    </div>
                    <div class="row">
                        <a href="https://file.vinatrain.com/uploads/Tai_lieu_Excel.pdf">
                            <span>Tài Liệu [ Giáo Trình ] Học Excel từ cơ bản đến nâng cao PDF</span>
                        </a>
                    </div>
                </div>
                <!---->
                <div>
                    <div class="row">
                        <img src="../img/powerlethi.png" class="ti-book">
                    </div>
                    <div class="row">
                        <a href="https://uet.vnu.edu.vn/~hoainam/Tai_lieu_PowerPoint.pdf">
                            <span>Tài Liệu [ Giáo Trình ] Học PowerPoint từ cơ bản đến nâng cao PDF</span>
                        </a>
                    </div>
                </div> 
                <!----> 
                <div>
                    <div class="row">
                        <img src="../img/Wordn.png" class="ti-book">
                    </div>
                    <div class="row">
                        <a href="https://unifinance-my.sharepoint.com/personal/share_financematerials_com/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fshare%5Ffinancematerials%5Fcom%2FDocuments%2FReports%2Fword%2D2021%2Dadvanced%2Dquick%2Dreference%2Epdf&parent=%2Fpersonal%2Fshare%5Ffinancematerials%5Fcom%2FDocuments%2FReports&ga=1">
                            <span>Tài liệu Word từ cơ bản đến nâng cao </span>
                        </a>
                    </div>
                </div>
                <!---->
                <div>
                    <div class="row">
                        <img src="../img/exceln.png" class="ti-book">
                    </div>
                    <div class="row">
                        <a href="https://unifinance-my.sharepoint.com/personal/share_financematerials_com/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fshare%5Ffinancematerials%5Fcom%2FDocuments%2FReports%2Fexcel%2D2021%2Dadvanced%2Dquick%2Dreference%2Epdf&parent=%2Fpersonal%2Fshare%5Ffinancematerials%5Fcom%2FDocuments%2FReports&ga=1">
                            <span>Tài liệu Excel từ cơ bản đến nâng cao</span>
                        </a>
                    </div>
                </div>
                <!---->
                <div>
                    <div class="row">
                        <img src="../img/powern.png" class="ti-book">
                    </div>
                    <div class="row">
                        <a href="https://unifinance-my.sharepoint.com/personal/share_financematerials_com/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fshare%5Ffinancematerials%5Fcom%2FDocuments%2FReports%2Fpowerpoint%2D2021%2Dintermediate%2Dquick%2Dreference%2Epdf&parent=%2Fpersonal%2Fshare%5Ffinancematerials%5Fcom%2FDocuments%2FReports&ga=1">
                            <span>Tài liệu PowerPoint từ cơ bản đến nâng cao</span>
                        </a>
                    </div>
                </div>
                <!---->   
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

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
       <script src="Js/theodoichungtoi.js"></script> 

</body>
</html>
    <script src="scripts.js"></script>
    <script src="../Js/doimk.js"></script>
</body>
</html>
