
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
// Giả sử bạn lưu id người dùng trong session
$userId = $_SESSION['idtaikhoan']; 

// Truy vấn cơ sở dữ liệu để lấy thông tin người dùng
$query = "SELECT image FROM taikhoan WHERE idtaikhoan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu người dùng tồn tại và lấy đường dẫn hình ảnh
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $avatarPath = htmlspecialchars($user['image']);
} else {
    $avatarPath = 'path/to/default-avatar.jpg'; // Đường dẫn hình ảnh mặc định nếu không tìm thấy người dùng
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/diendann.css">
    <link rel="stylesheet" href="../Css/doimk.css">
    
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

    
 <!-- Form Đăng Bài -->
<div class="post-create">
    <form action="../diendan/xulydangbinhluanlike.php" method="post" enctype="multipart/form-data">
        <div class="post-header">
           <!-- Hiển thị hình ảnh đại diện của người dùng -->
           <img src="../img/<?php echo $avatarPath; ?>" alt="User Avatar" class="user-avatar">
            <input type="text" placeholder="Bạn đang nghĩ gì?" id="title" name="title" required>
        </div>
        <div class="post-body">
            <label for="image" class="upload-label">Thêm ảnh</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div class="post-footer">
            <button type="submit" name="submit_post">Đăng</button>
        </div>
    </form>
</div>




<div class="posts">
<?php
    require '../connection.php'; // Ensure proper error handling for this

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
                <img src="../img/<?php echo $userImagePath; ?>" alt="User Image" class="user-image">
                <span class="user-name"><?php echo $userName; ?></span>
                <div class="post-actions">
                    <button class="more-options" onclick="toggleMenu(event)">⋯</button>
                    <div class="action-menu" style="display: none;">
                        <form action="../diendan/xulydangbinhluanlike.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                            <button type="submit" name="delete" class="delete-button">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
            <p class="post-date"><?php echo $dateTime; ?></p>
            <h3><?php echo $title; ?></h3>
            <?php if (!empty($postImagePath)) { // Check if the post has an image ?>
                <img src="../img/<?php echo $postImagePath; ?>" alt="Post Image" class="post-image">
            <?php } ?>
            
            <!-- Nút Thích -->
            <div class="post-bottom">
                <form action="../diendan/xulydangbinhluanlike.php" method="post" style="display: inline;">
                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                    <button type="submit" name="like" class="action-button">
                        <?php echo $liked ? 'Bỏ Thích' : 'Thích'; ?>
                    </button>
                </form>
                <span><?php echo $likeCount; ?> lượt thích</span>
            </div>

            <!-- Phần Bình Luận -->
            <div class="comments">
                <form class="comment-form" action="../diendan/xulydangbinhluanlike.php" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                    <input type="text" name="comment_text" placeholder="Nhập bình luận" required>
                    <button type="submit" name="comment">Gửi</button>
                </form>

                <?php
                // Fetch comments from the database
                $commentSql = "SELECT binhluan.idbinhluan, binhluan.binhluan, binhluan.thoigian, binhluan.idtaikhoan, taikhoan.hoten
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

                    // Chỉ hiển thị nút "Xóa" nếu người dùng là chủ sở hữu của bình luận
                    if ($comment['idtaikhoan'] == $_SESSION['idtaikhoan']) {
                        echo '<form action="../diendan/xulydangbinhluanlike.php" method="post" style="display:inline;">';
                        echo '    <input type="hidden" name="comment_id" value="' . $comment['idbinhluan'] . '">';
                        echo '    <button type="submit" name="delete_comment">Xóa</button>';
                        echo '</form>';
                    }

                    echo '</div>';
                }
                ?>
            </div>

        </div>
    <?php
    }
    ?>
</div>

</div>


<script>
function toggleMenu(event) {
    const menu = event.target.nextElementSibling;
    const isVisible = menu.style.display === 'block';
    document.querySelectorAll('.action-menu').forEach(el => el.style.display = 'none');
    menu.style.display = isVisible ? 'none' : 'block';
}

document.addEventListener('click', function(event) {
    if (!event.target.closest('.post-actions')) {
        document.querySelectorAll('.action-menu').forEach(el => el.style.display = 'none');
    }
});

 </script>


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
<script src="../Js/doimk.js"></script>

</body>
</html>
