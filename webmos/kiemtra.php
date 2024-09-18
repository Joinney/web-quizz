<?php


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
    <link rel="stylesheet" href="./Css/main.css">
    <link rel="stylesheet" href="./Css/kiemtras.css">
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
                <li class="logo-item">
                    <a href="#" class="logo">
                        <img src="./img/LogoMOS.jpg" alt="MOS Learning Logo">
                    </a>
                </li>
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="gioithieu.php">Giới Thiệu </a></li>            
                <li><a href="tailieu.php" class="active">Tài liệu</a></li>
                <li><a href="diendan.php" class="active">Diễn đàn</a></li>
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
                                echo '<li><a href="./kiemtra.php?id=' . $idDanhMuc . '">' . $tenDanhMuc . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found.</a></li>';
                        }

                        mysqli_close($conn3);
                        ?>
                    </ul>
                </li>
            </li>
                <li><a href="tintuc.php">Tin tức</a></li>
                <li><a href="lienhe.php" class="active">Liên hệ</a></li>
                <li><a href="login.php" class="btn">Đăng nhập</a></li>
                <li><a href="register.php" class="btn">Đăng ký</a></li>
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
                    <li class="category-item" href="?id=<?php echo $category['iddanhmuc']; ?>">
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
                            <img src="./img/<?php echo $exam['hinhanh']; ?>" alt="<?php echo $exam['tendethi']; ?>">
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
                                <a href="dethichitiet.php?id=<?php echo $exam['iddethi']; ?>" class="details-button">Xem chi tiết</a>
                                <a href="login.php?id=<?php echo $exam['iddethi']; ?>" class="start-button">Bắt đầu thi</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Không có đề thi nào.</p>
            <?php endif; ?>
        </section>
    </div>


    
    <section id="section__footer" class="body__section">
    <div id="block__logo" class="block__footer">
        <li class="logo-item">
            <a href="" class="logo">
                <img src="./img/LogoMOS.jpg" alt="MOS Learning Logo">
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
</section>

    <!-- Chân trang -->
    <footer>
        <div class="container">
            <p>&copy; 2024 MOSLearning. All rights reserved.</p>
            
        </div>
    </footer>

    <!-- Thêm liên kết JavaScript nếu cần -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(event) {
                event.preventDefault();
                var target = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 1000);
            });
        });
    </script>
</body>
</html>
