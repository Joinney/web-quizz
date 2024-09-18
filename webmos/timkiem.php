<?php
// Connect to your database
$mysqli = new mysqli("localhost", "root", "", "webmos");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get search query
$search_query = isset($_GET['query']) ? $mysqli->real_escape_string($_GET['query']) : '';

// SQL query to search exams by name, duration, and description
$sql = "SELECT * FROM dethi 
        WHERE tendethi LIKE '%$search_query%' 
        OR thoigian LIKE '%$search_query%' 
        OR mota LIKE '%$search_query%'";

$results = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="./Css/main.css">
    <link rel="stylesheet" href="./Css/kiemtras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <style>
        .containers {
    justify-content: center;
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
                    <img src="./img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
    
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="gioithieu.php">Giới Thiệu </a></li>            
                <li><a href="tailieu.php" class="active">Tài liệu</a></li>
                <li><a href="diendan.php" class="active">Diễn đàn</a></li>
                <li><a href="kiemtra.php">Kiểm Tra</a></li>
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


    <div class="containers">
        <section class="exams-section">
            <h2>Kết quả tìm kiếm</h2>
            <?php if ($results->num_rows > 0): ?>
                <div class="exams-list">
                    <?php while($exam = $results->fetch_assoc()): ?>
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
                <p>Không tìm thấy kết quả nào.</p>
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




</body>
</html>

<?php
// Close connection
$mysqli->close();
?>
