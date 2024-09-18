
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
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/gioithieu.css">
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

    <!-- Phần Hiển Thị thân -->

   
    <header>
        <h1>Giới Thiệu Về Trung Tâm G5TD</h1>
    </header>
    
    <section class="introduction">
        <img src="../img/LogoMOS.jpg" alt="logo">
        <p>Trung tâm luyện thi G5TD Việt Nam được thành lập vào tháng 7 năm 2024, với sứ mệnh tạo ra cộng đồng học tập lớn nhất tại Việt Nam, cung cấp kiến thức và kỹ năng thiết yếu cho sinh viên trong quá trình học tập và phát triển cá nhân. Chúng tôi không ngừng nỗ lực để tối ưu hóa quá trình luyện thi, mang lại những trải nghiệm học tập hàng đầu cho các sinh viên trên toàn quốc. Với triết lý phát triển dựa trên nhu cầu và sự trăn trở về các chứng chỉ đầu ra của sinh viên, G5TD luôn đồng hành và hỗ trợ các bạn giải quyết những khó khăn trong quá trình luyện thi, nâng cao chất lượng đầu ra, và tăng tối đa tỷ lệ đạt chứng chỉ lên đến 100%.</p>
    </section>

    <h2>Các Chức Năng Nổi Bật</h2>
    <section class="features">
        
        <div class="feature">
            
            <h3>Làm Bài Thi Trách Nhiệm</h3>
            <p>Chúng tôi cung cấp hệ thống làm bài thi trách nhiệm trực tuyến, giúp học viên kiểm tra và đánh giá kiến thức của mình theo các dạng bài thi khác nhau. Các bài thi được thiết kế sát với nội dung chương trình học và yêu cầu của các chứng chỉ đầu ra.</p>
        </div>

        <div class="feature">
            
            <h3>Ôn Tập Lý Thuyết</h3>
            <p>Hệ thống ôn tập lý thuyết của chúng tôi cung cấp các tài liệu học tập phong phú và dễ tiếp cận. Học viên có thể ôn tập các kiến thức cần thiết cho kỳ thi một cách hiệu quả, với các bài giảng và bài tập thực hành được thiết kế bài bản.</p>
        </div>

        <div class="feature">
           
            <h3>Hỗ Trợ Chatbox</h3>
            <p>Chúng tôi cung cấp dịch vụ hỗ trợ chatbox trực tuyến, giúp học viên có thể gửi câu hỏi và nhận trợ giúp từ đội ngũ giảng viên và trợ giảng bất cứ khi nào. Đây là công cụ hữu ích để giải đáp nhanh chóng các thắc mắc và hỗ trợ học viên trong quá trình học tập.</p>
        </div>

        <div class="feature">
            
            <h3>Diễn Đàn Thảo Luận</h3>
            <p>Diễn đàn thảo luận của chúng tôi là nơi học viên có thể trao đổi ý kiến, chia sẻ kinh nghiệm và học hỏi từ nhau. Đây là một cộng đồng học tập năng động, nơi các vấn đề học tập được thảo luận và giải quyết một cách hiệu quả.</p>
        </div>
    </section>
    
    <section class="vision">
        <h2>Tầm Nhìn</h2>
        
        <p>Với tầm nhìn trở thành biểu tượng niềm tin và uy tín hàng đầu trong việc luyện thi chứng chỉ đầu ra cho sinh viên các trường Đại học, Cao đẳng, Trung cấp,… G5TD mong muốn mang đến những giá trị đích thực và những trải nghiệm tốt nhất cho học viên. Chúng tôi hướng đến việc làm cho các môn học như Tin học và Tiếng Anh trở nên gần gũi, thực tế và dễ học hơn đối với đại đa số sinh viên.</p>
    </section>
    
    <section class="mission">
        <h2>Sứ Mệnh</h2>
        <p>Trung tâm luyện thi G5TD phát triển không ngừng và luôn mang trong mình sứ mệnh kiến tạo tri thức và văn hóa, phát triển toàn diện cho học viên. Chúng tôi cam kết đưa 100% học viên đạt chứng chỉ và các chỉ tiêu đề ra, giúp các bạn có một hành trang vững chắc để chính thức rời khỏi ghế nhà trường và bước vào thế giới rộng lớn hơn. Với hơn 5 năm kinh nghiệm luyện thi và đào tạo hơn 20.000 học viên, chúng tôi tự hào về phương châm “#100% Đạt chứng chỉ” và là địa chỉ tin cậy cho các chứng chỉ Tin học và Tiếng Anh.</p>
    </section>
    
    <section class="core-values">
        <h2>Giá Trị Cốt Lõi</h2>
        
        <ul>
            <li><strong>Tiên Phong:</strong> Luôn tiên phong đi trước và đón đầu xu hướng, Trung tâm luyện thi G5TD khẳng định tạo ra những giá trị khác biệt trong giáo dục bằng sự chân thành và sự cống hiến. Chúng tôi luôn đổi mới và cải tiến phong cách, văn hóa giảng dạy để giải quyết các vấn đề đầu ra của sinh viên.</li>
            <li><strong>Lắng Nghe & Cải Thiện:</strong> Đội ngũ giảng viên và trợ giảng của chúng tôi, với nhiều năm kinh nghiệm và chuyên môn cao, luôn sẵn sàng lắng nghe mọi ý kiến đóng góp từ học viên. Chúng tôi không ngừng nỗ lực cải thiện phương pháp giảng dạy để mang lại hiệu quả học tập tốt nhất.</li>
            <li><strong>Tâm Huyết:</strong> Tâm huyết là một trong những đặc điểm nổi bật của Trung tâm luyện thi G5TD. Chúng tôi chủ động tìm kiếm tài liệu sát với đề thi và phát triển các phương pháp giảng dạy hiệu quả và thú vị để học viên cảm thấy hiểu bài và yêu thích khóa học.</li>
            <li><strong>Kết Quả Thực:</strong> Chất lượng giáo dục và kết quả học tập là ưu tiên hàng đầu của chúng tôi. G5TD cam kết cung cấp đầy đủ kiến thức và hỗ trợ học viên đạt chứng chỉ và chỉ tiêu đề ra, đảm bảo rằng mọi học viên đều được trang bị hành trang vững chắc cho tương lai.</li>
        </ul>
    </section>
    
    <section class="team">
        <h2>Đội Ngũ Giảng Viên</h2>
        
        <p>Đội ngũ giảng viên của chúng tôi gồm những chuyên gia hàng đầu trong các lĩnh vực Tin học và Ngoại ngữ. Họ không chỉ được đào tạo bài bản mà còn tràn đầy nhiệt huyết và tâm huyết trong việc truyền đạt kiến thức. Chúng tôi cam kết rằng mỗi học viên sẽ nhận được sự chăm sóc và hướng dẫn tận tình nhất từ các giảng viên của chúng tôi.</p>
    </section>
    
    <section class="facilities">
        <h2>Cơ Sở Vật Chất</h2>
        
        <p>G5TD tự hào sở hữu cơ sở vật chất hiện đại và tiện nghi, tạo điều kiện tốt nhất cho học viên trong quá trình học tập. Chúng tôi liên tục cập nhật và cải tiến trang thiết bị để đảm bảo mỗi học viên đều có một môi trường học tập thoải mái và hiệu quả.</p>
    </section>





    









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
