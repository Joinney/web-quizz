
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS | Diễn đàn</title>
    <link rel="stylesheet" href="./Css/main.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <style>
        body {
	font-family: 'Roboto', sans-serif;
	background-color: #f4f4f9;
	margin: 0;
	padding: 0;
}

/* Main container for news */
.news-container {
	max-width: 1200px;
	margin: 0 auto;
	padding: 20px;
}
a {
text-decoration: none;
}

/* Title styling */
.news-header {
	text-align: center;
	font-size: 36px;
	margin-bottom: 40px;
	color: #2c3e50;
	font-weight: 700;
}

/* Grid for news articles */
.news-grid {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
	gap: 30px;
}

/* Individual news article styling */
.news-item {
	background-color: white;
	border-radius: 10px;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
	overflow: hidden;
	transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.news-item:hover {
	transform: translateY(-5px);
	box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

/* Image inside the news card */
.news-item img {
	width: 100%;
	height: 200px;
	object-fit: cover;
}

/* Title of the news item */
.news-item h2 {
	font-size: 20px;
	color: #2c3e50;
	margin: 15px;
	font-weight: 600;
	line-height: 1.4;
	transition: color 0.3s ease;
}

.news-item h2:hover {
	color: #3498db;
}

/* Time and source info */
.news-item .news-info {
	font-size: 14px;
	color: #7f8c8d;
	margin: 0 15px 15px;
}

.news-item .news-info::before {
	content: "🕒 ";
	color: #3498db;
}

/* Divider */
.divider {
	height: 1px;
	background-color: #eaeaea;
	margin: 20px 0;
}

@media (max-width: 768px) {
	.news-container {
		padding: 10px;
	}

	.news-header {
		font-size: 28px;
	}
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
                    <img src="./img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
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
                <li><a href="tintuc.php">Tin tức</a></li>
                <li><a href="lienhe.php" class="active">Liên hệ</a></li>
                <li><a href="login.php" class="btn">Đăng nhập</a></li>
                <li><a href="register.php" class="btn">Đăng ký</a></li>
            </ul>
              

    </nav>
    <!-- Thêm thanh tìm kiếm -->
    <div class="search-container">
                <form action="timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>
        </div>

    <!-- Phần Hiển Thị thân -->


    
    <div class="news-container">
    <!-- Main title for the news page -->
    <h1 class="news-header">Trang Tin Tức Hôm Nay</h1>

    <div class="news-grid">
        <!-- Individual news articles -->
        <div class="news-item">
            <a href="https://thanhnien.vn/word-tren-web-thu-nghiem-tinh-nang-moi-1851040617.htm" target="_blank">
                <img src="https://thanhnien.mediacdn.vn/uploaded/nthanhluan/2021_02_25/600_XFKF.jpg">
                <h2>Word trên web thử nghiệm tính năng mới</h2>
            </a>
            <div class="news-info">Thanhnien &emsp; 3 giờ trước</div>
        </div>

        <div class="news-item">
            <a href="https://vnexpress.net/co-gai-day-microsoft-excel-kiem-2-trieu-usd-moi-nam-4553317.html" target="_blank">
                <img src="https://i1-kinhdoanh.vnecdn.net/2022/12/27/107161904-1670348616519-Kat-fi-7531-4727-1672131081.jpg?w=680&h=0&q=100&dpr=1&fit=crop&s=JztwWF0MuOG3biNNeoE_yA">
                <h2>Cô gái dạy Microsoft Excel kiếm 2 triệu USD mỗi năm</h2>
            </a>
            <div class="news-info">Sport9 &emsp; 6 giờ trước</div>
        </div>

        <div class="news-item">
            <a href="https://tuoitre.vn/nguoi-hoc-tro-vang-cua-tin-hoc-van-phong-the-gioi-20211118095811633.htm" target="_blank">
                <img src="https://cdn.tuoitre.vn/thumb_w/1200/2021/11/18/nguyenquochuy-1637204129639118752820.jpg">
                <h2>Người học trò vàng của tin học văn phòng thế giới</h2>
            </a>
            <div class="news-info">Tuoitre &emsp; 6 giờ trước</div>
        </div>

        <div class="news-item">
            <a href="https://video.vnexpress.net/tin-tuc/giao-duc/bon-meo-trong-microsoft-word-khong-phai-ai-cung-biet-3844690.html?_gl=1*1qzu1yv*_gcl_au*MTMzNTQ5Nzk1Mi4xNzI2NDIxOTU5" target="_blank">
                <img src="https://i1-vnexpress.vnecdn.net/2018/11/26/Word-1543200333-9674-1543200389.png?w=500&h=300&q=100&dpr=1&fit=crop&s=7IYWU4zaWSP1L0SPn30ZSg">
                <h2>Bốn mẹo trong Microsoft Word không phải ai cũng biết</h2>
            </a>
            <div class="news-info">Vnexpress &emsp; 13 giờ trước</div>
        </div>

        <div class="news-item">
            <a href="https://vnexpress.net/co-gai-viet-dat-giai-ba-cuoc-thi-tin-hoc-van-phong-the-gioi-3263873.html" target="_blank">
                <img src="https://nguoiduatin.mediacdn.vn/thumb_w/930/media/hoang-van-hung/2024/01/19/phat-hien-hang-tram-doi-giay-co-dau-hieu-gia-mao-nhan-hieu-nike-mlb.jpg">
                <h2>Cô gái Việt đạt giải Ba cuộc thi Tin học văn phòng thế giới</h2>
            </a>
            <div class="news-info">Vnexpress &emsp; 9 giờ trước</div>
        </div>
        <div class="news-item">
            <a href="https://vnexpress.net/khong-co-may-tinh-thay-giao-chau-phi-day-microsoft-word-tren-bang-den-3715364.html" target="_blank">
                <img src="https://i1-vnexpress.vnecdn.net/2018/02/26/thay-giao-chau-Phi-2-4714-1519611034.jpg?w=680&h=0&q=100&dpr=1&fit=crop&s=NeZS82mirsG12qjx85CI7g">
                <h2>Không có máy tính, thầy giáo châu Phi dạy Microsoft Word trên bảng đen</h2>
            </a>
            <div class="news-info">Vnexpress &emsp; 9 giờ trước</div>
        </div>
    </div>

    <!-- Divider for clarity -->
    <div class="divider"></div>

    <!-- Load more button -->
    <div style="text-align: center;">
        <button style="background-color: #3498db; color: white; padding: 12px 25px; border: none; border-radius: 25px; font-size: 16px; cursor: pointer;">Xem thêm tin tức</button>
    </div>
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

</body>
</html>
