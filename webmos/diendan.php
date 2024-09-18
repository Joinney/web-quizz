
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS | Diễn đàn</title>
    <link rel="stylesheet" href="./Css/main.css">
    <link rel="stylesheet" href="./Css/diendann.css">
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
              
        </div>
    </nav>

    <!-- Thêm thanh tìm kiếm -->
    <div class="search-container">
                <form action="timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>

<!-- Form Đăng Bài -->
<div class="post-create">
    <form action="./login.php" method="post" enctype="multipart/form-data">
        <div class="post-header">
            <img src="./img/avt.png" alt="User Avatar" class="user-avatar">
            <input type="text" placeholder="Bạn đang nghĩ gì?" id="title" name="title" required>
        </div>
        <div class="post-body">
            <label for="image" class="upload-label">Thêm ảnh/video</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div class="post-footer">
            <button type="submit" name="submit_post">Đăng</button>
        </div>
    </form>
</div>


    <!-- Phần Hiển Thị Bài Đăng -->
<div class="posts">
    <?php
    require 'connection.php'; // Ensure proper error handling for this

    // Fetch posts along with user information from the database
    $sql = "SELECT baidang.idbaidang, baidang.tieude, baidang.image AS post_image, baidang.thoigian, 
                   taikhoan.hoten, taikhoan.image AS user_image
            FROM baidang
            JOIN taikhoan ON baidang.idtaikhoan = taikhoan.idtaikhoan
            ORDER BY baidang.thoigian DESC";
    $result = $conn->query($sql);

    while ($post = $result->fetch_assoc()) {
        $postId = $post['idbaidang'];
        $title = htmlspecialchars($post['tieude']);
        $dateTime = date('d M Y, H:i', strtotime($post['thoigian']));
        $postImagePath = htmlspecialchars($post['post_image']); // Path to the post image
        $userName = htmlspecialchars($post['hoten']); // User's name
        $userImagePath = htmlspecialchars($post['user_image']); // Path to the user's profile image
        

        // Fetch like count
        $likeSql = "SELECT COUNT(*) AS like_count FROM likes WHERE idbaidang = ?";
        $stmt = $conn->prepare($likeSql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $likeCount = $stmt->get_result()->fetch_assoc()['like_count'];

        // Check if user liked the post
        $liked = false;
        if (isset($_SESSION['idtaikhoan'])) {
            $userId = $_SESSION['idtaikhoan'];
            $likeCheckSql = "SELECT * FROM likes WHERE idtaikhoan = ? AND idbaidang = ?";
            $stmt = $conn->prepare($likeCheckSql);
            $stmt->bind_param("ii", $userId, $postId);
            $stmt->execute();
            $liked = $stmt->get_result()->num_rows > 0;
        }
    ?>
        <div class="post">
            <div class="post-header">
                <img src="./img/<?php echo $userImagePath; ?>" alt="User Image" class="user-image">
                <span class="user-name"><?php echo $userName; ?></span>
            </div>
            <p class="post-date"><?php echo $dateTime; ?></p>
            <h3><?php echo $title; ?></h3>
            <img src="./img/<?php echo $postImagePath; ?>" alt="Post Image" class="post-image">
            

            <!-- Nút Thích -->
            <div class="post-bottom">
                <form action="./login.php" method="post" style="display: inline;">
                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                    <button type="submit" name="like" class="action-button">
                        <?php echo $liked ? 'Bỏ Thích' : 'Thích'; ?>
                    </button>
                </form>
                <span><?php echo $likeCount; ?> lượt thích</span>
            </div>

            <!-- Phần Bình Luận -->
            <div class="comments">
                <form class="comment-form" action="./login.php" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                    <input type="text" name="comment_text" placeholder="Nhập bình luận" required>
                    <button type="submit" name="comment">Gửi</button>
                </form>

                <?php
                // Fetch comments from the database
                $commentSql = "SELECT binhluan.binhluan, binhluan.thoigian, taikhoan.hoten
                               FROM binhluan
                               JOIN taikhoan ON binhluan.idtaikhoan = taikhoan.idtaikhoan
                               WHERE binhluan.idbaidang = ?";
                $stmt = $conn->prepare($commentSql);
                $stmt->bind_param("i", $postId);
                $stmt->execute();
                $commentResult = $stmt->get_result();
                while ($comment = $commentResult->fetch_assoc()) {
                    echo '<div class="comment">';
                    echo '    <p><strong>' . htmlspecialchars($comment['hoten']) . '</strong>: ' . htmlspecialchars($comment['binhluan']) . '</p>';
                    echo '    <span class="time">' . date('d M Y, H:i', strtotime($comment['thoigian'])) . '</span>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
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
